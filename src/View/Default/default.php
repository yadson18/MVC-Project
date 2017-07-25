<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>AverbePorto - <?= $this->getTitle() ?></title>
		<link rel="icon" type="image/x-icon" href="/images/logo-icone.jpg">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= $this->css("bootstrap.min.css") ?>
		<?= $this->css("pages.css") ?>
		<?= $this->css("font-awesome.min.css") ?>

		<?= $this->script("jquery-3.2.1.min.js") ?>
		<?= $this->script("bootstrap.min.js") ?>
		<?= $this->script("pages.js") ?>
	</head>
	<body>
		<?php if($this->getLoggedUser() && $this->getTitle() != "Login"): ?>
			<nav class="navbar navbar-default" id="menu">
	  			<div class="container-fluid">
		    		<div class="navbar-header">
		    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        	<span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				      	</button>
				      	<a class="navbar-brand" href="#">
				      		<img src="/images/logo.gif">
				      	</a>
				    </div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      				<ul class="nav navbar-nav navbar-right">
	      					<li class="visible-xs">
	        					<a href="/AverbePorto/index">
	        						<i class="fa fa-home" aria-hidden="true"></i> Home
	        					</a>
	        				</li>
	        				<li class="visible-xs">
	        					<a href="/AverbePorto/sendFile">
	        						<i class="fa fa-upload" aria-hidden="true"></i> Envio de arquivo
	        					</a>
	        				</li>
	        				<li class="dropdown">
					          	<a href="#" class="dropdown-toggle text-capitalize" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					          		<?= strtolower($this->getLoggedUser("name")) ?> 
					          		<i class="fa fa-caret-down" aria-hidden="true"></i>
					          	</a>
					          	<ul class="dropdown-menu">
					            	<li>
					            		<a href="/Users/logout" class="hidden-xs">
	        								Sair <i class="fa fa-sign-out" aria-hidden="true"></i>
	        							</a>
	        							<a href="/Users/logout" class="visible-xs">
	        								<i class="fa fa-sign-out" aria-hidden="true"></i> Sair
	        							</a>
					            	</li>
					          	</ul>
					        </li>
	      				</ul>
	    			</div>
	  			</div>
			</nav>
			<nav class="col-md-2 col-sm-3 hidden-xs" id="menu-left">
	  			<div>
					<div>
	      				<ul class="nav navbar-nav navbar-left">
					        <li>
					        	<a href="/AverbePorto/index">
					        		<i class="fa fa-home" aria-hidden="true"></i> Home
					        	</a>
					        </li>
	      				</ul>
	      				<ul class="nav navbar-nav navbar-left">
					        <li>
					        	<a href="/AverbePorto/sendFile">
					        		<i class="fa fa-upload" aria-hidden="true"></i> Envio de arquivo
					        	</a>
					        </li>
	      				</ul>
	    			</div>
	  			</div>
			</nav>
		<?php endif; ?>
		<div id="content">
			<?= $this->fetchAll() ?>
		</div>
	</body>
</html>