<nav class="navbar navbar-default navbar-fixed-top" id="home-nav">
	<div class="container-fluid">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#responsive-menu" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
		    </button>
		</div>
		<div class="collapse navbar-collapse" id="responsive-menu">
		   	<ul class="nav navbar-nav navbar-right hidden-xs">
		   		<li><a href="#" data-toggle="modal" data-target="#user-modal" class="link-login">Faça o Login</a></li>
		   		<p class="navbar-text">ou</p>
		   		<li><a href="#" data-toggle="modal" data-target="#user-modal" class="link-register">Registre-se</a></li>
		  	</ul>
		  	<ul class="nav navbar-nav navbar-right visible-xs">
		   		<li>
		   			<a href="#" data-toggle="modal" data-target="#user-modal" class="link-login">
		   				<i class="fa fa-sign-in" aria-hidden="true"></i> Login
		   			</a>
		   		</li>
		   		<li>
		   			<a href="#" data-toggle="modal" data-target="#user-modal" class="link-register">
		   				<i class="fa fa-user-plus" aria-hidden="true"></i> Registre-se
		   			</a>
		   		</li>
		  	</ul>
		</div>
	</div>
</nav>
<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="col-md-4 col-md-offset-4 modal-box" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<i class="fa fa-times close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></i>
	    		<div id="breadcrumb">
					<ul class="nav nav-tabs">
					  <li role="breadcrumb-item" id="change-form-login" class="link-login"><a>Login</a></li>
					  <li role="breadcrumb-item" id="change-form-register" class="link-register"><a>Registro</a></li>
					</ul>
				</div>
      		</div>
      		<div class="modal-body">
        		<form id="login-form">
        			<div class="message-box"></div>
					<div class="form-group">
						<label>Digite seu usuário</label>
						<input type="text" name="login" class="form-control" placeholder="Ex: marcos" required>
					</div>
					<div class="form-group">
						<label>Digite sua senha</label>
					    <input type="password" name="senha" class="form-control" placeholder="Ex: ******" required>
					</div>
					<div class="form-group">
					</div>
	      			<div class="modal-footer row">
					    <button id="button-login" type="button" class="btn form-control btn-success input-lg">
					    	Entrar <i class="fa fa-sign-in" aria-hidden="true"></i>
						</button>
	      			</div>
				</form>
				<form id="register-form">
        			<div class="message-box"></div>
					<div class="form-group">
						<label>Nome de usuário</label>
						<input type="text" name="userName" class="form-control" placeholder="Ex: marcos" required>
					</div>
					<div class="form-group">
						<label>Crie uma senha</label>
					    <input type="password" class="form-control" placeholder="Ex: ******" required>
					</div>
					<div class="form-group">
						<label>Confirmar senha</label>
					    <input type="password" name="password" class="form-control" placeholder="Ex: ******" required>
					</div>
					<div class="form-group">
					</div>
	      			<div class="modal-footer row">
					    <button type="button" class="btn form-control btn-success input-lg">
					    	Registrar-se <i class="fa fa-sign-in" aria-hidden="true"></i>
						</button>
	      			</div>
				</form>
				<div>
					<p>&copy; SRI Automação</p>
				</div>
      		</div>
    	</div>
  	</div>
</div>
<div id="home-container" class="col-md-12">
	<div class="row banner">
		<h1 class="banner-title">Sistema de Cotação Sri</h1>
		<img src="/images/notebook.png" class="banner-image">
	</div>
	<div class="features">
		<h1 class="features-title">Funcionalidades</h1>
		<div class="row">
  			<div class="col-sm-6 col-md-4">
    			<div class="thumbnail">
      				<div class="icon">
      					<i class="fa fa-bar-chart" aria-hidden="true"></i>
      				</div>
      				<div class="caption">
        				<h3>Exemplo</h3>
        				<p>
        					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat felis est, et sollicitudin nibh sollicitudin ac. Mauris non porttitor massa. Quisque ut lobortis augue, sit amet malesuada lacus. Etiam a dapibus elit.
        				</p>
        				<p>
        					<a href="#" class="btn btn-primary" role="button">Button</a> 
        					<a href="#" class="btn btn-default" role="button">Button</a>
        				</p>
      				</div>
    			</div>
  			</div>
  			<div class="col-sm-6 col-md-4">
    			<div class="thumbnail">
      				<div class="icon">
      					<i class="fa fa-bar-chart" aria-hidden="true"></i>
      				</div>
      				<div class="caption">
        				<h3>Exemplo</h3>
        				<p>
        					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat felis est, et sollicitudin nibh sollicitudin ac. Mauris non porttitor massa. Quisque ut lobortis augue, sit amet malesuada lacus. Etiam a dapibus elit.
        				</p>
        				<p>
        					<a href="#" class="btn btn-primary" role="button">Button</a> 
        					<a href="#" class="btn btn-default" role="button">Button</a>
        				</p>
      				</div>
    			</div>
  			</div>
  			<div class="col-sm-6 col-md-4">
    			<div class="thumbnail">
      				<div class="icon">
      					<i class="fa fa-bar-chart" aria-hidden="true"></i>
      				</div>
      				<div class="caption">
        				<h3>Exemplo</h3>
        				<p>
        					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat felis est, et sollicitudin nibh sollicitudin ac. Mauris non porttitor massa. Quisque ut lobortis augue, sit amet malesuada lacus. Etiam a dapibus elit.
        				</p>
        				<p>
        					<a href="#" class="btn btn-primary" role="button">Button</a> 
        					<a href="#" class="btn btn-default" role="button">Button</a>
        				</p>
      				</div>
    			</div>
  			</div>
		</div>
	</div>
</div>
<footer id="home-footer" class="col-md-12 col-sm-12 col-xs-12">
	<div class="col-md-3">
		<a href="https://www.google.com.br/maps/place/SRI+Automa%C3%A7%C3%A3o+Servi%C3%A7os+e+Inform%C3%A1tica/@-8.0488812,-34.9107408,17z/data=!3m1!4b1!4m5!3m4!1s0x7ab18edef29eb7b:0x5faf2019ffd343f6!8m2!3d-8.0488865!4d-34.9085521" target="blank">
			<p>
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				Encontre-nos
			</p> 
		</a>
	</div>
	<div class="col-md-3">
		<a href="https://www.facebook.com/" target="blank">
			<p>
				<i class="fa fa-facebook-square" aria-hidden="true"></i>
				Facebook
			</p> 
		</a>
	</div>
	<div class="col-md-3">
		<p class="padding">
			<i class="fa fa-envelope" aria-hidden="true"></i>
			email@email.com
		</p> 
	</div>
	<div class="col-md-3">
		<p class="padding">
			<i class="fa fa-phone-square" aria-hidden="true"></i>
			(81) 99999-9999
		</p> 
	</div>
</footer>