<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>FW - <?= $this->getTitle() ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= $this->css("bootstrap.min.css") ?>
		<?= $this->css("default.css") ?>
		<?= $this->css("font-awesome.min.css") ?>

		<?= $this->script("bootstrap.min.js") ?>
		<?= $this->script("HtmlMaker.js") ?>
	</head>
	<body>	
		<nav class="navbar navbar-inverse">
		  	<div class="container-fluid">
			    <div class="navbar-header">
		      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
		      		</button>
		      		<a class="navbar-brand" href="#">Brand</a>
		    	</div>
		    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		     		<ul class="nav navbar-nav navbar-right">
		        		<li><a href="#">Link</a></li>
		      		</ul>
		    	</div>
		  	</div>
		</nav>
		<div class="container">
			<?= $this->fetchAll() ?>
		</div>
	</body>
</html>