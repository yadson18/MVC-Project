<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?= getAppName() ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= $this->css("bootstrap.min.css") ?>
		<?= $this->css("font-awesome.min.css") ?>
		<?= $this->less("mixin.less") ?>
		
		<?= $this->script("jquery.min.js") ?>
		<?= $this->script("bootstrap.min.js") ?>
		<?= $this->script("input-mask.js") ?>
		<?= $this->script("functions.js") ?>
		<?= $this->script("HtmlMaker.js") ?>

		<?= $this->less("presentation-style.less") ?>
		<?= $this->script("less.min.js") ?>
	</head>
	<body>	
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
		            <ul class="nav navbar-nav navbar-right">
		                <li><a href="#" data-toggle="modal" data-target="#user-modal" class="link-login">Ver Mais</a></li>
		                <p class="navbar-text">ou</p>
		                <li><a href="#" data-toggle="modal" data-target="#user-modal" class="link-register">Nada Aqui</a></li>
		            </ul>
		        </div>
		    </div>
		</nav>
		<div class="content">
			<?= $this->fetchAll() ?>
		</div>
	</body>
</html>