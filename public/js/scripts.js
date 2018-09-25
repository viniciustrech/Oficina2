$(window).ready(function(){
    $(".btn-upload-modal").on("click", function () {
        $("#uploadModal .modal-body .sec-secondary").hide();
        $("#uploadModal").modal("show");
        $("#uploadModal #uploadModalForm").attr("action", $(this).attr("data-href"));
    });

    $(".btn-upload-multiplo-modal").on("click", function () {
        $("#uploadMultiploModal").modal("show");
        $("#uploadMultiploModal #uploadModalForm").attr("action", $(this).attr("data-href"));

        if($(this).attr("data-multiplo")){
            $("#uploadMultiploModal #uploadModalForm #files").prop("multiple",true);
        }else{
            $("#uploadMultiploModal #uploadModalForm #files").prop("multiple",false);
        }

        if($(this).attr("data-arquivo")){
            $("#uploadMultiploModal #uploadModalForm #files").attr("data-arquivo", 1);
        }else{
            $("#uploadMultiploModal #uploadModalForm #files").attr("data-arquivo", 0);
        }

    });

    $("#uploadModal #uploadModalForm").on('submit', function () {
        $("#uploadModal .modal-body .sec-primary").hide();
        $("#uploadModal .modal-body .sec-secondary").show();
    });

    $(".btn-destroy").click(function(e){
       if(!confirm("Deseja excluir esse Registro")){
           e.preventDefault();
           return false;
       }
    });

    $(".btn-liberado").click(function(e){
       if(!confirm("Deseja alterar esse Registro")){
           e.preventDefault();
           return false;
       }
    });

    $(".btn-upload-banco-imagens").on("click", function () {
        $("#modal-banco-imagens").modal("show");
    });

    function Validar(cpf) {

        if (cpf.value == "") {
            alert("Campo inválido. É necessário informar o CPF");
            cpf.focus();
            cpf.value = '';
            return (false);
        }
        if (((cpf.value.length == 11) && (cpf.value == 11111111111) || (cpf.value == 22222222222) || (cpf.value == 33333333333) || (cpf.value == 44444444444) || (cpf.value == 55555555555) || (cpf.value == 66666666666) || (cpf.value == 77777777777) || (cpf.value == 88888888888) || (cpf.value == 99999999999) || (cpf.value == 00000000000))) {
            alert("CPF inválido.");
            cpf.focus();
            cpf.value = '';
            return (false);
        }


        if (!((cpf.value.length == 11) || (cpf.value.length == 14))) {
            alert("CPF inválido.");
            cpf.focus();
            cpf.value = '';
            return (false);
        }

        var checkOK = "0123456789";
        var checkStr = cpf.value;
        var allValid = true;
        var allNum = "";
        for (i = 0; i < checkStr.length; i++) {
            ch = checkStr.charAt(i);
            for (j = 0; j < checkOK.length; j++)
                if (ch == checkOK.charAt(j))
                    break;
            if (j == checkOK.length) {
                allValid = false;
                break;
            }
            allNum += ch;
        }
        if (!allValid) {
            alert("Favor preencher somente com dígitos o campo CPF.");
            cpf.focus();
            cpf.value = '';
            return (false);
        }

        var chkVal = allNum;
        var prsVal = parseFloat(allNum);
        if (chkVal != "" && !(prsVal > "0")) {
            alert("CPF zerado !");
            cpf.focus();
            cpf.value = '';
            return (false);
        }

        if (cpf.value.length == 11) {
            var tot = 0;

            for (i = 2; i <= 10; i++)
                tot += i * parseInt(checkStr.charAt(10 - i));

            if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(9))) {
                alert("CPF inválido.");
                cpf.focus();
                cpf.value = '';
                return (false);
            }

            tot = 0;

            for (i = 2; i <= 11; i++)
                tot += i * parseInt(checkStr.charAt(11 - i));

            if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(10))) {
                alert("CPF inválido.");
                cpf.focus();
                cpf.value = '';
                return (false);
            }
        }
        else {
            var tot = 0;
            var peso = 2;

            for (i = 0; i <= 11; i++) {
                tot += peso * parseInt(checkStr.charAt(11 - i));
                peso++;
                if (peso == 10) {
                    peso = 2;
                }
            }

            if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(12))) {
                alert("CPF inválido.");
                cpf.focus();
                cpf.value = '';
                return (false);
            }

            tot = 0;
            peso = 2;

            for (i = 0; i <= 12; i++) {
                tot += peso * parseInt(checkStr.charAt(12 - i));
                peso++;
                if (peso == 10) {
                    peso = 2;
                }
            }

            if ((tot * 10 % 11 % 10) != parseInt(checkStr.charAt(13))) {
                alert("CPF inválido.");
                cpf.focus();
                cpf.value = '';
                return (false);
            }
        }

        $.ajax({
            url: "/cpfcnpj/" + cpf.value

        }).done(function (data) {
            if (data == 1) {
                alert("CPF já cadastrado, favor faça login ao lado!");
                cpf.value = '';
                return (false);
            } else {
                return (true);
            }
        });
    }

    function alturafixa() {
        if ($(".altura-fixa-auto").size() > 0) {
            altura1 = 0;
            $(".altura-fixa-auto").css({"height": "auto"});
            $(".altura-fixa-auto").each(function () {
                if ($(this).height() > altura1) {
                    altura1 = $(this).height();
                }
            });
            altura1 += 5;
            $(".altura-fixa-auto").css({"height": altura1 + "px"});
        }

        if ($(".altura-fixa-auto2").size() > 0) {
            altura2 = 0;
            $(".altura-fixa-auto2").css({"height": "auto"});
            $(".altura-fixa-auto2").each(function () {
                if ($(this).height() > altura2) {
                    altura2 = $(this).height();
                }
            });
            altura2 += 15;
            $(".altura-fixa-auto2").css({"height": altura2 + "px"});
        }

        if ($(".altura-fixa-auto3").size() > 0) {
            altura3 = 0;
            $(".altura-fixa-auto3").css({"height": "auto"});
            $(".altura-fixa-auto3").each(function () {
                if ($(this).height() > altura3) {
                    altura3 = $(this).height();
                }
            });
            $(".altura-fixa-auto3").css({"height": altura3 + "px"});
        }

        if ($(".altura-fixa-auto4").size() > 0) {
            altura4 = 0;
            $(".altura-fixa-auto4").css({"height": "auto"});
            $(".altura-fixa-auto4").each(function () {
                if ($(this).height() > altura4) {
                    altura4 = $(this).height();
                }
            });
            altura4 += 5;
            $(".altura-fixa-auto4").css({"height": altura4 + "px"});
        }
    }
    alturafixa();

    $("#usar-endereco").click(function () {
        if ($(this).is(':checked')) {

            $("input[name=endereco2]").val($("input[name=shippingAddressStreet]").val());
            $("input[name=numero2]").val($("input[name=shippingAddressNumber]").val());
            $("input[name=complemento2]").val($("input[name=shippingAddressComplement]").val());
            $("input[name=bairro2]").val($("input[name=shippingAddressDistrict]").val());
            $("input[name=pessoa2]").val($("input[name=senderName]").val());
            $("input[name=ddd2]").val($("input[name=senderAreaCode]").val());
            $("input[name=telefone2]").val($("input[name=senderPhone]").val());
            $("input[name=cep2]").val($("input[name=shippingAddressPostalCode]").val());

            $("select[name=municipio2] option").remove();
            $("select[name=shippingAddressCity] option").each(function () {
                _this = $(this).clone();
                _sel = $("select[name=shippingAddressCity] option:selected");

                if (_this.attr('value') == _sel.attr('value')){
                    _this = _this.prop('selected', true);
                }
                $("select[name=municipio2]").append(_this);
            })

            $("select[name=estado2] option").remove();
            $("select[name=shippingAddressState] option").each(function () {
                _this = $(this).clone();
                _sel = $("select[name=shippingAddressState] option:selected");

                if (_this.attr('value') == _sel.attr('value')){
                    _this = _this.prop('selected', true);
                }
                $("select[name=estado2]").append(_this);
            })
        }
    });

    if ($('#conteudo').size() > 0) {
        $('#conteudo img').each(function () {
            $(this).addClass('img-responsive').css({"height": "auto", "width": "auto"})
        });
    }

});