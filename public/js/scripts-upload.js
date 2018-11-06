/**
 * Criado por PhpStorm.
 * Nome: Cristiano Polasso
 * Email: biggercode@gmail.com
 * DateTime: 20/01/2017 11:24
 */

$(document).ready(function ($) {
    var lista_imagens = new Array();
    var lista_length = 0;
    var i = 0;

    $("#files").change(function () {
        files = $(this).prop("files");

        $.each(files, function (i, data) {
            lista_imagens.push(data);
        });

        lista_length = lista_imagens.length;
        monta_tabela();
    });

    var upload = function (i) {
        data = lista_imagens[i];
        //token = lista_imagens[i]['token'];
        token = $('meta[name="csrf-token"]').attr('content');
        url = $("#uploadMultiploModal #uploadModalForm").attr("action");

        form = new FormData();
        form.append('file', data);
        form.append('_token', token);

        $.ajax({
            url: url,
            type: 'POST',
            data: form,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data) {
                if (data == 1) {
                    $("[data-pgb=" + i + "]").html("100% OK").addClass("progress-bar-success");
                } else {
                    $("[data-pgb=" + i + "]").html("0% ERRO").addClass("progress-bar-danger");
                }

                i++;
                if (i < lista_length) {
                    upload(i);
                } else {
                    lista_imagens = new Array();
                }
            },
            error: function () {
                $("[data-pgb=" + i + "]").html("0% ERRO").addClass("progress-bar-danger");
                i++;
                if (i < lista_length) {
                    upload(i);
                } else {
                    lista_imagens = new Array();
                }
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', function (data) {
                        if (data.lengthComputable) {
                            var percentComplete = data.loaded / data.total;
                            percent = Math.round(percentComplete * 100);
                            $("[data-pgb=" + i + "]").css({"width": percent + "%"}).html(percent + "%");
                        }
                    }, false);
                }
                return myXhr;
            }
        })
        ;
    };

    $('.btn-start-upload').click(function () {
        if (lista_length > 0 && i == 0) {
            upload(0);
        }
    });


    var monta_tabela = function () {
        $("#lista-files tbody").remove();
        tbody = $("<tbody/>");
        $.each(lista_imagens, function (i, data) {
            //renderImage(i, data);
            tr = $("<tr/>");
            progress = $("<div/>").addClass("progress");
            progressBar = $("<div/>").addClass("progress-bar progress-bar-striped active").css({"width": "0px"}).attr("data-pgb", i);
            progress.append(progressBar);

            td2 = $("<td/>").addClass("text-center").append(progress);
            td3 = $("<td/>").html(data.name);
            td4 = $("<td/>").addClass("text-center");

            //tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            tbody.append(tr);
        });
        $("#lista-files").append(tbody);
    };

    $(document).on('change', ':file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

});

// render the image in our view
function renderImage(i, file) {

    // generate a new FileReader object
    var reader = new FileReader();

    // inject an image with the src url
    reader.onload = function (event) {
        $("#image" + i).attr("src", event.target.result);
    }

    // when the file is read it triggers the onload event above.
    reader.readAsDataURL(file);
}