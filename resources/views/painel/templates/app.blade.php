<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


	<![endif]-->
</head>
<body>
	@include("painel.includes.top")
	@yield('content')
	<div class="modal" id="uploadModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row sec-primary">
						<div class="col-sm-12 text-center" style="background-color: #F1F1F1;padding:15px;">
							<form id="uploadModalForm" action="" method="post" enctype="multipart/form-data">
								<div class="form-group text-center">
									<div class="col-sm-8 col-sm-offset-2">
										<input type="hidden" name="_token" value="{{csrf_token()}}">

										<h2>Arquivo</h2>
										<input type="file" id="file" name="file" placeholder="Arquivo"
											   required>
									</div>
								</div>
								<div class="form-group text-center">
									<div class="col-sm-8 col-sm-offset-2" style="padding:20px;">
										<button type="submit" class="btn btn-primary">Upload</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="row sec-secondary">
						<div class="col-sm-12 text-center">
							<i class="fa fa-spinner fa-pulse fa-3x"></i><br>
							<h3>Aguarde Carregando Arquivo</h3>
						</div>
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>


	<div class="modal" id="uploadMultiploModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12" style="background-color: #F1F1F1;padding:15px;">
							<form id="uploadModalForm" action="" method="post" enctype="multipart/form-data">
								<div class="form-group text-center">
									<div class="col-sm-8 col-sm-offset-2">
										<h2>Arquivos/Fotos</h2>
									</div>
								</div>
								<div class="form-group text-center">
									<div class="col-sm-8 col-sm-offset-2" style="padding:20px;">
										<a class="btn btn-default btn-file">
											Selecionar Arquivos <input type="file" id="files" name="files[]" multiple
																	   required>
										</a>
										<button type="button" class="btn btn-primary btn-start-upload">Upload</button>
										<a href="javascript:location.reload();" class="btn btn-danger">Fechar</a>
									</div>
								</div>
								<table class="table table-striped table-bordered table-condensed" id="lista-files">
									<thead>
									<tr>
										{{--<th class="text-center"><i class="fa fa-picture-o"></i></th>--}}
										<th class="col-sm-2 text-center">Status</th>
										<th class="col-sm-8 text-left">Nome</th>
										<th class="text-center">#</th>
									</tr>
									</thead>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.Modal Upload Multiplo-->


	<!-- jQuery 2.1.4 -->
	<script src="{{asset("plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="{{asset("bootstrap/js/bootstrap.min.js")}}"></script>
	<!-- DataTables -->
	<script src="{{asset("plugins/datatables/jquery.dataTables.min.js")}}"></script>
	<script src="{{asset("plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
	<!-- SlimScroll -->
	<script src="{{asset("plugins/slimScroll/jquery.slimscroll.min.js")}}"></script>
	<!-- FastClick -->
	<script src="{{asset("plugins/fastclick/fastclick.min.js")}}"></script>
	<!-- Input Mask -->
	<script src="{{asset("plugins/input-mask/jquery.inputmask.js")}}"></script>
	<script src="{{asset("plugins/input-mask/jquery.inputmask.extensions.js")}}"></script>
	<script src="{{asset("plugins/input-mask/jquery.inputmask.date.extensions.js")}}"></script>
	<script src="{{asset("plugins/input-mask/jquery.maskmoney.js")}}"></script>

	<script src="{{asset("plugins/datepicker/bootstrap-datepicker.js")}}"></script>
	<script src="{{asset("plugins/datepicker/locales/bootstrap-datepicker.pt-BR.js")}}"></script>

	<!-- iCheck 1.0.1 -->
	<script src="{{asset("plugins/iCheck/icheck.min.js")}}"></script>
	<!-- CKEDITOR -->
	<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="{{asset("plugins/morris/morris.min.js")}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset("dist/js/app.min.js")}}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{asset("dist/js/demo.js")}}"></script>
	<!-- Select2 -->
	<script src="{{asset("plugins/select2/select2.full.min.js")}}"></script>
	<script src="{{asset("js/scripts-upload.js")}}"></script>
	<script src="{{asset("js/scripts.js")}}"></script>

	<script>
		$(function(){
            $('.date').inputmask('99/99/9999');
            $('.hora').inputmask('99:99');
            $('.cep').inputmask('99999-999');
            $('.telefone').inputmask('(99) 9999-9999[9]');

            $('.legenda').change(function () {
                var id_fot = $(this).attr('data-id');
                var href = $(this).attr('data-href');
                var legenda = $(this).val();

                $.ajax({
                    type: "GET",
                    url: href,
                    data: {
                        legenda: legenda
                    }
                }).done(function (data) {

                    if (data == 1) {
                        $('.form' + id_fot).addClass('has-success')
                        setTimeout(function () {
                            $('.form' + id_fot).removeClass('has-success')
                        }, 3000);

                        $('.span' + id_fot).removeClass('hidden').html('Registro atualizado com sucesso!')
                        setTimeout(function () {
                            $('.span' + id_fot).addClass('hidden')
                        }, 3000);

                    } else {
                        $('.form' + id_fot).addClass('has-danger')
                        setTimeout(function () {
                            $('.form' + id_fot).removeClass('has-error')
                        }, 3000);

                        $('.span' + id_fot).removeClass('hidden').html('Erro ao atualizar registro!')
                        setTimeout(function () {
                            $('.span' + id_fot).addClass('hidden')
                        }, 3000);

                    }
                });
            });
		});

	</script>
</body>
</html>
