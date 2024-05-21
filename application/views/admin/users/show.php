<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Users Information</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">User</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/users') ?>" class="btn btn-danger">Back</a>
	</div>

	<div class="alert alert-success" id="message" style="display: none;">
	</div>

	<?php if ($this->session->flashdata('success')) : ?>
		<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('error')) : ?>
		<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
	<?php endif; ?>


	<div class="card">
		<div class="card-body">

			<form class="row g-3" action="<?= base_url('users/store') ?>" method="POST">
				<h5 class="card-title mx-2">User Data</h5>

				<div class="col-md-6">
					<label class="form-label">Name<span class="text-danger">*</span></label>
					<input class="form-control" type="text" name="name" value="<?= $users['name'] ?>" />
					<span class="text-sm text-danger"><?= form_error('name') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Username<span class="text-danger">*</span></label>
					<input class="form-control" type="text" name="username" value="<?= $users['username'] ?>" />
					<span class="text-sm text-danger"><?= form_error('username') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Email Address<span class="text-danger">*</span></label>
					<input class="form-control" type="email" name="email" value="<?= $users['email'] ?>" />
					<span class="text-sm text-danger"><?= form_error('email') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">User Type<span class="text-danger">*</span></label>

					<select class="form-select" name="user_type" id="user_type">
					<option value="" <?= ($users['type_id'] == '') ? 'selected' : '' ?>>Choose from below</option>
						<?php foreach ($userTypes as $type): ?>
							<option value="<?= $type['id'] ?>" <?= ($type['id'] == $users['type_id']) ? 'selected' : '' ?>>
								<?= $type['name'] ?>
							</option>
						<?php endforeach; ?>
					</select>
					<span class="text-sm text-danger"><?= form_error('user_type') ?></span>
				</div>

				
				<div class="col-md-6">
					<label class="form-label">Campus<span class="text-danger">*</span></label>
					<select  class="form-select" name="campus_id" required id="campus_id">
						<option value="" <?= ($users['campus_id'] == '') ? 'selected' : '' ?>>Choose from below</option>
						<?php foreach ($campus as $camp): ?>
							<option value="<?= $camp['id'] ?>" <?= ($camp['id'] == $users['campus_id']) ? 'selected' : '' ?>>
								<?= $camp['name'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-md-6">
					<label class="form-label">Password<span class="text-danger">*</span></label>
					<input class="form-control" type="password" name="password" id="password" />
					<span class="text-sm text-danger" id="passwordAlert"><?= form_error('password') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Password Confirmation<span class="text-danger">*</span></label>
					<input class="form-control" type="password" name="password_confirm" id="password_confirm" />
					<span class="text-sm text-danger" id="confirmPassAlert"><?= form_error('password_confirm') ?></span>

				</div>

				<div class="col-12 d-flex justify-content-end align-items-center">
					<button class="btn btn-primary mt-2 ml-2" type="submit" name="submit">Add User</button>
				</div>
			</form>

		</div>
	</div>
	</div>
</main>
