<?php
	include_once("../php/conexao.php");
	include_once("../php/verifica_login.php");
	$usuario_cod = $_SESSION['usuario_cod'];
	$chamado_cod = $_GET['cod'];
	$select_chamado_especifico = mysqli_query($conexao,"select * from chamado where chamado_cod = $chamado_cod");
	while ($c = $select_chamado_especifico -> fetch_array()) {
		$chamado_cod = $c['chamado_cod'];
		$chamado_titulo = $c['chamado_titulo'];
		$chamado_descricao = $c['chamado_descricao'];
		$chamado_bairro = $c['chamado_bairro'];
		$chamado_data_relato = $c['chamado_data_relato'];
		$chamado_data_acontecimento = $c['chamado_data_acontecimento'];
		$chamado_usuario = $c['chamado_usuario'];
		$select_nome = mysqli_query($conexao,"select * from usuario where usuario_cod = '$chamado_usuario'");
		while ($u = $select_nome -> fetch_array()) {
			$usuario_nome = $u['usuario_nome'];
		}
	}

	?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>NOSSA VOZ</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<link rel="stylesheet" href="../css/feed.css">
		<link rel="stylesheet" href="../css/geral.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg bg-dark">
			<a class="navbar-brand text-white" href="index.php">NOSSA VOZ - GRAVATAÍ</a>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a href="index.php" class="menu text-white icon">
					<i class="fa fa-arrow-left"></i>
					</a>
				</li>
			</ul>
		</nav>
		<br>
		<section>
			<div class="container">
				<div class="card">
					<div class="card-header">
						<div class="d-inline float-left text-black">
							<h3>#<?php echo $chamado_cod ?> - <?php echo $chamado_titulo ?></h3>
						</div>
					</div>
					<div class="card-body">
						<p><b>Relato por:</b><?php echo $usuario_nome	; ?></p>
						<p><b>Relato registrado em:</b> <?php echo date("d/m/Y", strtotime($chamado_data_relato)) ?></p>
						<p><b>Acontecendo desde:</b> <?php echo date("d/m/Y", strtotime($chamado_data_acontecimento)) ?></p>
						<p><b>Bairro afetado:</b> <?php echo $chamado_bairro ?></p>
						<hr>
						<?php echo nl2br($chamado_descricao); ?>
					</div>
				</div>
				<br>
			</div>
			<div class="container">
				<div class="card comentario">
					<form action="../php/comentario/cadastrar_comentario.php" method="post">
						<div class="card-body">
							<input type="hidden" name="chamado_cod" value="<?php echo $chamado_cod ?>">
							<label for="chamado_comentario"><b>Novo comentário</b></label> <span class="obrigatorio">*</span><br>
							<textarea name="comentario_descricao" rows="3" cols="60" class="form-control" value="" required></textarea>
							<br>
							<button type="submit" class="btn btn-success float-right">Comentar</button>
							<br>
						</div>
					</form>
				</div>
				<br>
				<?php
					$select_comentario = mysqli_query($conexao,"select * from comentario where comentario_chamado = $chamado_cod");

					if (mysqli_num_rows($select_comentario) != 0) {
						while ($cc = $select_comentario -> fetch_array()) {
							$comentario_cod = $cc['comentario_cod'];
							$comentario_descricao = $cc['comentario_descricao'];
							$comentario_data = $cc['comentario_data'];
							$comentario_usuario = $cc['comentario_usuario'];
							$select_nome = mysqli_query($conexao,"select usuario_nome from usuario where usuario_cod = '$comentario_usuario'");
							while ($u = $select_nome -> fetch_array()) {
								$usuario_nome = $u['usuario_nome'];
							}
						?>
				<div class="comentario card">
					<div class="card-body">
						<p><b><?php echo $usuario_nome ?> - <?php echo date("d/m/Y", strtotime($comentario_data)) ?></b> <?php if($usuario_cod == $comentario_usuario){ ?> <span class="float-right cursor-pointer" data-toggle="modal" data-target="#excluirComentario" data-codigo="<?php echo $comentario_cod?>" data-chamado="<?php echo $chamado_cod?>">EXCLUIR</span><?php } ?></p>
						<br>
						<p><?php echo $comentario_descricao ?></p>
					</div>
				</div>
				<?php
					}
					}
					?>
				<br>
			</div>
		</section>
		<div class="modal fade" id="excluirComentario" role="dialog">
			<div class="modal-dialog">
				<form class="" action="../php/comentario/excluir_comentario.php" method="post">
					<div class="modal-content">
						<div class="modal-header">
							Excluir comentário
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control" name="comentario_cod" id="codigo" required>
							<input type="hidden" class="form-control" name="comentario_chamado" id="chamado" required>
							<center>
								<h1>⚠️</h1>
								<h3>Você deseja excluir o comentário?</h3>
							</center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
							<button type="submit" class="btn btn-danger">REMOVER</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			$('#excluirComentario').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget)
				var codigo = button.data('codigo')
				var chamado = button.data('chamado')
				var modal = $(this)
				modal.find('#codigo').val(codigo)
				modal.find('#chamado').val(chamado)
				});
		</script>
	</body>
</html>
