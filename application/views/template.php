<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" sizes="any" href="<?= base_url('assets/images/icon.png'); ?>" type="image/png" />
	<title>Mikrotik Hotspot Manager</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" integrity="sha256-PF6MatZtiJ8/c9O9HQ8uSUXr++R9KBYu4gbNG5511WE=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="<?= base_url(); ?>">HOTMAN</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php $checkdb = $this->data_model->check(); ?>
		<?php if ($this->session->userdata('logged_in') == true) { ?>
			<div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="mr-2 nav-item <?php if (empty($this->uri->segment(2))) {
													echo 'active';
												} ?>">
						<a class="nav-link" href="<?= base_url('hotspot'); ?>"><i class="fas fa-home mr-1"></i> Home</a>
					</li>
					<?php if ($checkdb == true) { ?>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'user') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/user'); ?>"><i class="fas fa-users mr-1"></i> Users</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'user_profile') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/user_profile'); ?>"><i class="fas fa-id-card mr-1"></i> Profiles</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'active') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/active'); ?>"><i class="fas fa-wifi mr-1"></i> Active</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'host') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/host'); ?>"><i class="fas fa-desktop mr-1"></i> Hosts</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'ip_binding') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/ip_binding'); ?>"><i class="fas fa-random mr-1"></i> Bindings</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'cookie') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/cookie'); ?>"><i class="fas fa-cookie mr-1"></i> Cookies</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'dhcp_lease') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('hotspot/dhcp_lease'); ?>"><i class="fas fa-code-branch mr-1"></i> DHCP</a>
						</li>
						<li class="mr-2 nav-item <?php if ($this->uri->segment(2) == 'setting') {
														echo 'active';
													} ?>">
							<a class="nav-link" href="<?= base_url('mikrotik/setting'); ?>"><i class="fas fa-cogs mr-1"></i> Settings</a>
						</li>
					<?php } ?>
					<li class="mr-2 nav-item">
						<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
					</li>
				</ul>
			</div>
		<?php } ?>
	</nav>

	<div class="container mt-4">
		<?= $_content; ?>
	</div>

	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-dark text-white">
					<h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
					<button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Yes" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
					<a class="btn btn-dark" href="<?= base_url('auth/logout'); ?>">Yes</a>
				</div>
			</div>
		</div>
	</div>

	<footer class="py-4 mt-5 bg-light text-dark-50">
		<div class="container text-center text-muted">
			<p class="mb-0"><small>&copy; <?= date('Y'); ?> MIKROTIK HOTSPOT MANAGER</small></p>
			<p><small>By <a href="https://erfandibagus.com" target="_blank">erfandibagus.com</a></small></p>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="<?= base_url('assets/js/script.js') ?>"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url('assets/js/table.js') ?>"></script>
</body>

</html>