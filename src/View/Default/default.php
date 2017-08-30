<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?= getAppName() . " - " . $this->getTitle() ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= $this->css("bootstrap.min.css") ?>
		<?= $this->css("font-awesome.min.css") ?>
		<?= $this->less("mixin.less") ?>
		
		<?= $this->script("jquery.min.js") ?>
		<?= $this->script("bootstrap.min.js") ?>
		<?= $this->script("HtmlMaker.js") ?>

		<?php if($this->getTitle() === "Início"): ?>
			<?= $this->less("presentation-style.less") ?>
		<?php else: ?>
			<?= $this->less("pages-style.less") ?>
		<?php endif; ?>

		<?= $this->script("less.min.js") ?>
	</head>
	<body>	
		<?php if($this->getTitle() !== "Início"): ?>
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
					   		<li class="text-capitalize">
					   			<a href="" class="dropdown-toggle" type="button" data-toggle="dropdown">
					   				<?= mb_strtolower($this->getLoggedUser("NOME"), "UTF-8") ?> <span class="caret"></span>
					   			</a>
								<ul class="dropdown-menu">
								   	<li>
								   		<a href="/User/logout">
					   						Sair <i class="fa fa-sign-out" aria-hidden="true"></i>
					   					</a>
					   				</li>
								</ul>
					   		</li>
					  	</ul>
					</div>
				</div>
			</nav>
		<?php endif; ?>
		<div>
			<?= $this->fetchAll() ?>
		</div>
		<?php if($this->getTitle() === "Início"): ?>
			<?= $this->script("presentation-scripts.js") ?>
		<?php else: ?>
			<?= $this->script("pages-scripts.js") ?>
		<?php endif; ?>
	</body>
</html>