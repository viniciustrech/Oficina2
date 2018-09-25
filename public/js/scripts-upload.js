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
        arquivo = $(this).attr("data-arquivo");

        if (!$("#files").prop("multiple")) {
            lista_imagens = new Array();
        }
        files = $(this).prop("files");

        $.each(files, function (i, data) {
            data["arquivo"] = arquivo;
            lista_imagens.push(data);
            lista_length = lista_imagens.length;
            monta_tabela();
        });
    });

    var ajaxUpload = function (resizedImage) {
        //token = lista_imagens[i]['token'];
        token = $('meta[name="csrf-token"]').attr('content');
        url = $("#uploadMultiploModal #uploadModalForm").attr("action");

        //console.log(window.URL.createObjectURL(resizedImage));
        //return false;

        form = new FormData();
        form.append('file', resizedImage);
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
        });
    };


    var upload = function (i) {
        data = lista_imagens[i];

        if (data["arquivo"] == "true") {

            ajaxUpload(data);
        } else {

            var file = resizeImage({
                file: data,
                maxSize: 1600
            }).then(function (resizedImage) {
                ajaxUpload(resizedImage);
            }).catch(function (err) {
                console.error(err);
            });

        }


    };


    var resizeImage = function (settings) {
        var file = settings.file;
        var maxSize = settings.maxSize;
        var reader = new FileReader();
        var image = new Image();
        var canvas = document.createElement('canvas');

        var dataURItoBlob = function (dataURI) {
            var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
                atob(dataURI.split(',')[1]) :
                unescape(dataURI.split(',')[1]);
            var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
            var max = bytes.length;
            var ia = new Uint8Array(max);
            for (var i = 0; i < max; i++)
                ia[i] = bytes.charCodeAt(i);
            return new Blob([ia], {type: 'image/png'});
        };

        var resize = function () {
            var width = image.width;
            var height = image.height;
            if (width > height) {
                if (width > maxSize) {
                    height *= maxSize / width;
                    width = maxSize;
                }
            } else {
                if (height > maxSize) {
                    width *= maxSize / height;
                    height = maxSize;
                }
            }
            canvas.width = width;
            canvas.height = height;

            canvas.getContext('2d').drawImage(image, 0, 0, width, height);
            var dataUrl = canvas.toDataURL('image/png');
            return dataURItoBlob(dataUrl);
        };
        return new Promise(function (ok, no) {
            //if (!file.type.match(/image.*/)) {
            //no(new Error("Not an image"));
            //return "";
            //}
            reader.onload = function (readerEvent) {
                image.onload = function () {
                    return ok(resize());
                };
                image.src = readerEvent.target.result;
            };
            reader.readAsDataURL(file);
        });
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