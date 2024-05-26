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
	<div class="card">
		<div class="card-body">

			<form class="row g-3" action="<?= base_url('users/store') ?>" method="POST">
				<h5 class="card-title mx-2">User Data</h5>
				<div class="row">
					<div class="col-md-4">
						<label class="form-label">Name<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="name" value="<?= $users['name'] ?>" disabled />
						<span class="text-sm text-danger"><?= form_error('name') ?></span>
					</div>

					<div class="col-md-4">
						<label class="form-label">Username<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="username" value="<?= $users['username'] ?>"
							disabled />
						<span class="text-sm text-danger"><?= form_error('username') ?></span>
					</div>

					<div class="col-md-4">
						<label class="form-label">Email Address<span class="text-danger">*</span></label>
						<input class="form-control" type="email" name="email" value="<?= $users['email'] ?>" disabled />
						<span class="text-sm text-danger"><?= form_error('email') ?></span>
					</div>
				</div>

				<div class="col-md-6">
					<label class="form-label">User Type<span class="text-danger">*</span></label>

					<select class="form-select" name="user_type" id="user_type" disabled>
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
					<select class="form-select" name="campus_id" required id="campus_id" disabled>
						<option value="" <?= ($users['campus_id'] == '') ? 'selected' : '' ?>>Choose from below</option>
						<?php foreach ($campus as $camp): ?>
						<option value="<?= $camp['id'] ?>"
							<?= ($camp['id'] == $users['campus_id']) ? 'selected' : '' ?>>
							<?= $camp['name'] ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>

			</form>

		</div>
	</div>
	</div>
</main>
