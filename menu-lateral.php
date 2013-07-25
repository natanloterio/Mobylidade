<?php require_once('sessao.php'); ?>
	 <!-- Menu lateral esquerda-->
		<script>
			
		</script>
		

		<style type="text/css">
			
			.profile_name{
				font-size: 28px;
				left: 0px;
				top: 0px;
				padding-top: 0px;
			}
			
			.profile_picture{
				height: 36px;
				width: 36px;
				background-size: 100%;
				background-image: url('image/profile.png');
				float: right;
				position: absolute;
				right: 0px;
				top: 0px;
				padding-top: 0px;
				margin: 10px;
			}
			
			.nome_e_imagem{
				float: left;
			}
			
		</style>
			
		<div class="ui-responsive-panel">
	
			<div data-role="panel" data-display="push"id="menu_panel" data-theme="a">
				<div class="nome_e_imagem">
					<div class="profile_name">
						<?php echo getUsuarioLogadoNomeCompleto();?>
					</div>
					
					<div class="profile_picture">
						
					</div>
				</div>
				<!-- panel content goes here -->
				<!-- <a href="#my-header" data-rel="close">Close panel</a>-->
				<br>
				
				<br>
				<br>
				<ul data-role="listview" data-theme="a">
					<li><a href="inicio.php" rel="external">Inicio</a></li>				
					<li><a href="pesquisa.php" rel="external">Procurar Veiculos</a></li>
					<li><a href="meus_veiculos.php" rel="external">Meus Veiculos</a></li>
					<li><a href="minhas_rotas.php" rel="external">Minhas Rotas</a></li>
					<li><a href="#" rel="external">Chat</a></li>
					<li><a href="logout.php" rel="external">Sair</a></li>
				</ul>			
			
			</div>
		</div>
		<script src="js/menu-lateral.js"></script>		
	  <!-- /panel -->		
	  