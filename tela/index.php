<?php
	include_once("../php/conexao.php");
	include_once("../php/verifica_login.php");
	$usuario_cod = $_SESSION['usuario_cod'];
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
	</head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<body>
		<nav class="navbar navbar-expand-lg bg-dark">
			<a class="navbar-brand text-white" href="feed.php">NOSSA VOZ - GRAVATAÍ</a>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a data-toggle="modal" data-target="#cadastrarChamado" class="menu text-white icon">
					<i class="fa fa-plus-circle"></i>
					</a>
				</li>
				<li class="nav-item">
					<form class="" action="../php/usuario/logout.php" method="post">
						<button type="submit" name="button" class="menu text-white icon">
						<i class="fa fa-sign-out"></i>
						</button>
					</form>
				</li>
			</ul>
		</nav>
		<br>
		<section>
			<div class="container">
				<?php while($c = $select_chamado -> fetch_array()){
					$chamado_cod = $c['chamado_cod'];
					$chamado_titulo = $c['chamado_titulo'];
					$chamado_descricao = $c['chamado_descricao'];
					$chamado_bairro = $c['chamado_bairro'];
					$chamado_data_relato = $c['chamado_data_relato'];
						$chamado_data_acontecimento = $c['chamado_data_acontecimento'];
					$chamado_usuario = $c['chamado_usuario'];
					$select_nome = mysqli_query($conexao,"select usuario_nome from usuario where usuario_cod = '$chamado_usuario'");
					while ($u = $select_nome -> fetch_array()) {
						$usuario_nome = $u['usuario_nome'];
					}
					?>
				<div class="card">
					<div class="card-header">
						<div class="d-inline float-left text-black">
							<h3>#<?php echo $chamado_cod ?> - <?php echo $chamado_titulo ?></h3>
						</div>
						<?php if ($usuario_cod == $chamado_usuario): ?>
						<div class="d-inline float-right text-black">
							<a data-toggle="modal" data-target="#excluirChamado" class="icon" data-codigo="<?php echo $chamado_cod?>">
							<i class="fa fa-trash"></i>
							</a>
						</div>
						<div class="d-inline float-right text-black">
							<a data-toggle="modal" data-target="#editarChamado" class="icon" data-codigo="<?php echo $chamado_cod ?>" data-titulo ="<?php echo $chamado_titulo ?>" data-descricao ="<?php echo $chamado_descricao ?>" data-bairro ="<?php echo $chamado_bairro ?>" data-data ="<?php echo $chamado_data_acontecimento ?>">
							<i class="fa fa-edit"></i>
							</a>
						</div>
						<?php endif; ?>
						<div class="d-inline float-right text-black">
							<a href="chamado_especifico.php?cod=<?php echo $chamado_cod ?>" class="icon">
							<i class="fa fa-comment"></i>
							</a>
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
				<?php } ?>
			</div>
		</section>
		<div class="modal fade" id="cadastrarChamado">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="../php/chamado/cadastrar_chamado.php" method="post">
						<div class="modal-header">
							<h4 class="modal-title">Cadastrar chamado</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<label for="chamado_titulo">Título do chamado</label> <span class="obrigatorio">*</span> <br>
							<input type="text" name="chamado_titulo" class="form-control" value="" required>
							<br>
							<label for="chamado_descricao">Descrição do chamado</label> <span class="obrigatorio">*</span><br>
							<textarea name="chamado_descricao" rows="8" cols="80" class="form-control" value="" required></textarea>
							<br>
							<label for="chamado_bairro">Qual bairro foi afetado? <span class="obrigatorio">*</span> </label><br>
							<select class="form-control" name="chamado_bairro">
								<option value="Águas Mortas">Águas Mortas</option>
								<option value="Barnabé">Barnabé</option>
								<option value="Bom Fim">Bom Fim</option>
								<option value="Bom Princípio">Bom Princípio</option>
								<option value="Bom Sucesso">Bom Sucesso</option>
								<option value="Caça e Pesca">Caça e Pesca</option>
								<option value="Cadiz">Cadiz</option>
								<option value="Castelo Branco">Castelo Branco</option>
								<option value="Centro">Centro</option>
								<option value="">Centro</option>
								<option value="COHAB A">COHAB A</option>
								<option value="COHAB B">COHAB B</option>
								<option value="COHAB C">COHAB C</option>
								<option value="Cruzeiro">Cruzeiro</option>
								<option value="Distrito Industrial">Distrito Industrial</option>
								<option value="Diva Lessa de Jesus">Diva Lessa de Jesus</option>
								<option value="Dom Feliciano">Dom Feliciano</option>
								<option value="Dona Mercedes">Dona Mercedes</option>
								<option value="Garibaldina">Garibaldina</option>
								<option value="Girassol">Girassol</option>
								<option value="Jansen">Jansen</option>
								<option value="Jardim do Cedro">Jardim do Cedro</option>
								<option value="Jardim Figueira">Jardim Figueira</option>
								<option value="Loteamento Auxiliadora">Loteamento Auxiliadora</option>
								<option value="Loteamento Jardim Florença">Loteamento Jardim Florença</option>
								<option value="Loteamento Jardim Timbaúva">Loteamento Jardim Timbaúva</option>
								<option value="Loteamento Rural Palermo">Loteamento Rural Palermo</option>
								<option value="Loteamento Umbu">Loteamento Umbu</option>
								<option value="Loteamento Vila Rica">Loteamento Vila Rica</option>
								<option value="Marrocos">Marrocos</option>
								<option value="Mato Alto">Mato Alto</option>
								<option value="Monte Belo">Monte Belo</option>
								<option value="Morada do Vale I">Morada do Vale I</option>
								<option value="Morada do Vale II">Morada do Vale II</option>
								<option value="Morada do Vale III">Morada do Vale III</option>
								<option value="Morada Gaúcha">Morada Gaúcha</option>
								<option value="Moradas do Sobrado">Moradas do Sobrado</option>
								<option value="Morungava">Morungava</option>
								<option value="Natal">Natal</option>
								<option value="Neópolis">Neópolis</option>
								<option value="Nossa Chácara">Nossa Chácara</option>
								<option value="Novo Mundo">Novo Mundo</option>
								<option value="Orico">Orico</option>
								<option value="Padre Réus">Padre Réus</option>
								<option value="Parque do Itatiaia">Parque do Itatiaia</option>
								<option value="Parque dos Anjos">Parque dos Anjos</option>
								<option value="Parque dos Eucalíptos">Parque dos Eucalíptos</option>
								<option value="Parque Florido">Parque Florido</option>
								<option value="Parque Ipiranga">Parque Ipiranga</option>
								<option value="Parque Itacolomi">Parque Itacolomi</option>
								<option value="Parque Olinda">Parque Olinda</option>
								<option value="Passo da Caveira">Passo da Caveira</option>
								<option value="Passo das Pedras">Passo das Pedras</option>
								<option value="Passo do Hilário">Passo do Hilário</option>
								<option value="Passos dos Ferreiros">Passos dos Ferreiros</option>
								<option value="Recanto Corcunda">Recanto Corcunda</option>
								<option value="Rincão da Madalena">Rincão da Madalena</option>
								<option value="Sagrada Família">Sagrada Família</option>
								<option value="Salgado Filho">Salgado Filho</option>
								<option value="Santa Cruz">Santa Cruz</option>
								<option value="Santa Fé">Santa Fé</option>
								<option value="Santo Antônio">Santo Antônio</option>
								<option value="São Cristóvão">São Cristóvão</option>
								<option value="São Geraldo">São Geraldo</option>
								<option value="São Jerônimo">São Jerônimo</option>
								<option value="São Judas Tadeu">São Judas Tadeu</option>
								<option value="São Luiz">São Luiz</option>
								<option value="São Vicente">São Vicente</option>
								<option value="Sítio Gaúcho">Sítio Gaúcho</option>
								<option value="Sítio Sobrado">Sítio Sobrado</option>
								<option value="União">União</option>
								<option value="Vale Ville">Vale Ville</option>
								<option value="Vera Cruz">Vera Cruz</option>
								<option value="Vila Branca">Vila Branca</option>
								<option value="Vila Cledi">Vila Cledi</option>
								<option value="Vila Imperial">Vila Imperial</option>
							</select>
							<br>
							<label for="chamado_data">Início do relato <span class="obrigatorio">*</span> </label>
							<?php $hoje = date('Y-m-d'); ?>
							<input type="date" name="chamado_data" class="form-control" value="" required max="<?php echo $hoje?>">
							<br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-success">Confirmar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id="excluirChamado" role="dialog">
			<div class="modal-dialog">
				<form class="" action="../php/chamado/excluir_chamado.php" method="post">
					<div class="modal-content">
						<div class="modal-header">
							Excluir chamado
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control" name="chamado_cod" id="codigo" required>
							<center>
								<h1>⚠️</h1>
								<h3>Você deseja excluir o chamado?</h3>
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
		<div class="modal fade" id="editarChamado" role="dialog">
			<div class="modal-dialog">
				<form class="" action="../php/chamado/editar_chamado.php" method="post">
					<div class="modal-content">
						<div class="modal-header">
							Editar chamado
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control" name="chamado_cod" id="codigo" required>
							<label for="chamado_titulo">Título do chamado</label> <span class="obrigatorio">*</span> <br>
							<input type="text" name="chamado_titulo" class="form-control" value="" required id="titulo">
							<br>
							<label for="chamado_descricao">Descrição do chamado</label> <span class="obrigatorio">*</span><br>
							<textarea name="chamado_descricao" rows="8" cols="80" class="form-control" value="" required id="descricao"></textarea>
							<br>
							<label for="chamado_bairro">Qual bairro foi afetado? <span class="obrigatorio">*</span> </label><br>
							<label for="chamado_bairro_atual">Atual:</label>
							<input type="text" class="form-control" name="chamado_bairro_atual" value="" id="bairro" disabled>
							<input type="hidden" class="form-control" name="chamado_bairro_atual" value="" id="bairro">
							<br>
							<label for="chamado_bairro_novo">Mudar para:</label>
							<select class="form-control" name="chamado_bairro_novo">
								<option value="">Selecione</option>
								<option value="Águas Mortas">Águas Mortas</option>
								<option value="Barnabé">Barnabé</option>
								<option value="Bom Fim">Bom Fim</option>
								<option value="Bom Princípio">Bom Princípio</option>
								<option value="Bom Sucesso">Bom Sucesso</option>
								<option value="Caça e Pesca">Caça e Pesca</option>
								<option value="Cadiz">Cadiz</option>
								<option value="Castelo Branco">Castelo Branco</option>
								<option value="Centro">Centro</option>
								<option value="COHAB A">COHAB A</option>
								<option value="COHAB B">COHAB B</option>
								<option value="COHAB C">COHAB C</option>
								<option value="Cruzeiro">Cruzeiro</option>
								<option value="Distrito Industrial">Distrito Industrial</option>
								<option value="Diva Lessa de Jesus">Diva Lessa de Jesus</option>
								<option value="Dom Feliciano">Dom Feliciano</option>
								<option value="Dona Mercedes">Dona Mercedes</option>
								<option value="Garibaldina">Garibaldina</option>
								<option value="Girassol">Girassol</option>
								<option value="Jansen">Jansen</option>
								<option value="Jardim do Cedro">Jardim do Cedro</option>
								<option value="Jardim Figueira">Jardim Figueira</option>
								<option value="Loteamento Auxiliadora">Loteamento Auxiliadora</option>
								<option value="Loteamento Jardim Florença">Loteamento Jardim Florença</option>
								<option value="Loteamento Jardim Timbaúva">Loteamento Jardim Timbaúva</option>
								<option value="Loteamento Rural Palermo">Loteamento Rural Palermo</option>
								<option value="Loteamento Umbu">Loteamento Umbu</option>
								<option value="Loteamento Vila Rica">Loteamento Vila Rica</option>
								<option value="Marrocos">Marrocos</option>
								<option value="Mato Alto">Mato Alto</option>
								<option value="Monte Belo">Monte Belo</option>
								<option value="Morada do Vale I">Morada do Vale I</option>
								<option value="Morada do Vale II">Morada do Vale II</option>
								<option value="Morada do Vale III">Morada do Vale III</option>
								<option value="Morada Gaúcha">Morada Gaúcha</option>
								<option value="Moradas do Sobrado">Moradas do Sobrado</option>
								<option value="Morungava">Morungava</option>
								<option value="Natal">Natal</option>
								<option value="Neópolis">Neópolis</option>
								<option value="Nossa Chácara">Nossa Chácara</option>
								<option value="Novo Mundo">Novo Mundo</option>
								<option value="Orico">Orico</option>
								<option value="Padre Réus">Padre Réus</option>
								<option value="Parque do Itatiaia">Parque do Itatiaia</option>
								<option value="Parque dos Anjos">Parque dos Anjos</option>
								<option value="Parque dos Eucalíptos">Parque dos Eucalíptos</option>
								<option value="Parque Florido">Parque Florido</option>
								<option value="Parque Ipiranga">Parque Ipiranga</option>
								<option value="Parque Itacolomi">Parque Itacolomi</option>
								<option value="Parque Olinda">Parque Olinda</option>
								<option value="Passo da Caveira">Passo da Caveira</option>
								<option value="Passo das Pedras">Passo das Pedras</option>
								<option value="Passo do Hilário">Passo do Hilário</option>
								<option value="Passos dos Ferreiros">Passos dos Ferreiros</option>
								<option value="Recanto Corcunda">Recanto Corcunda</option>
								<option value="Rincão da Madalena">Rincão da Madalena</option>
								<option value="Sagrada Família">Sagrada Família</option>
								<option value="Salgado Filho">Salgado Filho</option>
								<option value="Santa Cruz">Santa Cruz</option>
								<option value="Santa Fé">Santa Fé</option>
								<option value="Santo Antônio">Santo Antônio</option>
								<option value="São Cristóvão">São Cristóvão</option>
								<option value="São Geraldo">São Geraldo</option>
								<option value="São Jerônimo">São Jerônimo</option>
								<option value="São Judas Tadeu">São Judas Tadeu</option>
								<option value="São Luiz">São Luiz</option>
								<option value="São Vicente">São Vicente</option>
								<option value="Sítio Gaúcho">Sítio Gaúcho</option>
								<option value="Sítio Sobrado">Sítio Sobrado</option>
								<option value="União">União</option>
								<option value="Vale Ville">Vale Ville</option>
								<option value="Vera Cruz">Vera Cruz</option>
								<option value="Vila Branca">Vila Branca</option>
								<option value="Vila Cledi">Vila Cledi</option>
								<option value="Vila Imperial">Vila Imperial</option>
							</select>
							<br>
							<center><label><b>Para garantir a vericidade dos chamados, não é possível alterar a data do início do relato</b></label></center>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>
							<button type="submit" class="btn btn-success">EDITAR</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			$('#excluirChamado').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget)
				var codigo = button.data('codigo')
				var modal = $(this)
				modal.find('#codigo').val(codigo)
				});

				$('#editarChamado').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget)
					var codigo = button.data('codigo')
					var titulo = button.data('titulo')
					var descricao = button.data('descricao')
					var bairro = button.data('bairro')
					var data = button.data('data')
					var modal = $(this)
					modal.find('#codigo').val(codigo)
					modal.find('#titulo').val(titulo)
					modal.find('#descricao').val(descricao)
					modal.find('#bairro').val(bairro)
					modal.find('#data').val(data)
					});

		</script>
	</body>
</html>
