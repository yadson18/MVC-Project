<div class="container-fluid" id="login-content">
	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="message">
			<?= $this->flashShowMessage() ?>
		</div>
		<form method="POST" action="/Users/login" enctype="multipart/form-data" class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="form-login">
			<div id="logo">
				<img src="/images/logo.gif">
			</div>
			<div class="form-group">
				<label>Usuário</label>
				<input type="text" name="usuario" class="form-control" placeholder="Ex: 12345678910111" required>
			</div>
			<div class="form-group">
				<label>Senha</label>
			    <input type="password" name="senha" class="form-control" placeholder="Ex: ******" required>
			</div>
			<div class="form-group">
			    <button type="submit" class="btn form-control btn-success input-lg" id="login-btn">
			    	Entrar <i class="fa fa-sign-in" aria-hidden="true"></i>
				</button>
			</div>
		</form>
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="companie">
			<p>&copy; SRI Automação</p>
		</div>
	</div>
</div>