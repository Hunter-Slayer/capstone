<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Add User</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">User</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/users') ?>" class="btn btn-primary">Back</a>
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
					<input class="form-control" type="text"  name="name" value="<?= set_value('name') ?>" />
					<span class="text-sm text-danger"><?= form_error('name') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Username<span class="text-danger">*</span></label>
					<input class="form-control" type="text"  name="username" value="<?= set_value('username') ?>" />
					<span class="text-sm text-danger"><?= form_error('username') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Email Address<span class="text-danger">*</span></label>
					<input class="form-control" type="email"  name="email" value="<?= set_value('email') ?>" />
					<span class="text-sm text-danger"><?= form_error('email') ?></span>
				</div>

				<div class="col-md-6">
        <label class="form-label">User Type<span class="text-danger">*</span></label>
        <select class="form-select" name="user_type" id="user_type">
            <option selected value="">Choose from below</option>
            <option value="0" <?= set_select('user_type', '0') ?>>Staff</option>
            <option value="1" <?= set_select('user_type', '1') ?>>Admin</option>
            <option value="2" <?= set_select('user_type', '2') ?>>Campus In Charge</option>
        </select>
        <span class="text-sm text-danger"><?= form_error('user_type') ?></span>
    </div>

    <div class="col-md-6">
        <label class="form-label">Campus<span class="text-danger">*</span></label>
        <select disabled class="form-select" name="campus_id" id="campus_id">
            <option selected value="">Choose from below</option>
            <?php foreach ($campus as $camp): ?>
                <option value="<?= $camp['id'] ?>" <?= set_select('campus_id', $camp['id']) ?>><?= $camp['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <span class="text-sm text-danger"><?= form_error('campus_id') ?></span>
    </div>

				<div class="col-md-6">
					<label class="form-label">Password<span class="text-danger">*</span></label>
					<input class="form-control" type="password"  name="password" id="password"/>
					<span class="text-sm text-danger" id="passwordAlert"><?= form_error('password') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Password Confirmation<span class="text-danger">*</span></label>
					<input class="form-control" type="password"  name="password_confirm" id="password_confirm"/>
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userTypeSelect = document.getElementById('user_type');
        const campusSelect = document.getElementById('campus_id');

        userTypeSelect.addEventListener('change', function() {
            if (this.value == '2') {
                campusSelect.removeAttribute('disabled');
            } else {
                campusSelect.setAttribute('disabled', 'disabled');
                campusSelect.value = ''; // Reset campus selection when not Campus In Charge
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirm');
        const confirmPassAlert = document.getElementById('confirmPassAlert');

        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPassword = this.value;

            if (password !== confirmPassword) {
                confirmPassAlert.textContent = 'Password does not match';
                this.setCustomValidity('Password does not match');
            } else {
                confirmPassAlert.textContent = ''; 
                this.setCustomValidity('');
            }
        });
    });
</script>
