<div class="row">
	<div class="col-md">
		<?= $this->session->flashdata('msg'); ?>
		<form action="" method="post">
			<div class="form-group">
				<input class="form-control" type="text" name="ip" id="ip" placeholder="Mikrotik IP" required>
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
			</div>
			<div class="form-group">
				<input class="form-control" type="password" name="password" id="password" placeholder="Password">
			</div>
			<button class="btn btn-dark" type="submit">Connect</button>
		</form>
	</div>
</div>
