<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Edit User</h1>
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

			<form class="row g-3" action="<?= base_url('users/update/' .$user['id']) ?>" method="POST">
				<h5 class="card-title mx-2">User Data</h5>

				<div class="col-md-6">
					<label class="form-label">Name<span class="text-danger">*</span></label>
					<input class="form-control" type="text" name="name" value="<?= $user['name'] ?>" />
					<span class="text-sm text-danger"><?= form_error('name') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Username<span class="text-danger">*</span></label>
					<input class="form-control" type="text" name="username" value="<?= $user['username'] ?>" />
					<span class="text-sm text-danger"><?= form_error('username') ?></span>
				</div>

				<div class="col-md-6">
					<label class="form-label">Email Address<span class="text-danger">*</span></label>
					<input class="form-control" type="email" name="email" value="<?= $user['email'] ?>" />
					<span class="text-sm text-danger"><?= form_error('email') ?></span>
				</div>

				<div class="col-md-6">
    <label class="form-label">User Type<span class="text-danger">*</span></label>
    <select class="form-select" name="type_id" id="user_type">
        <option value="" <?= ($user['type_id'] == '') ? 'selected' : '' ?>>Choose from below</option>
        <?php foreach ($userTypes as $type): ?>
            <option value="<?= $type['id'] ?>" <?= ($type['id'] == $user['type_id']) ? 'selected' : '' ?>>
                <?= $type['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span class="text-sm text-danger"><?= form_error('type_id') ?></span>
</div>

<div class="col-md-6">
    <label class="form-label">Campus<span class="text-danger">*</span></label>
    <select disabled class="form-select" name="campus_id" required id="campus_id">
        <option value="" <?= ($user['campus_id'] == '') ? 'selected' : '' ?>>Choose from below</option>
        <?php foreach ($campus as $camp): ?>
            <option value="<?= $camp['id'] ?>" <?= ($camp['id'] == $user['campus_id']) ? 'selected' : '' ?>>
                <?= $camp['name'] ?>
            </option>
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
					<button class="btn btn-primary mt-2 ml-2" type="submit" name="submit">Update User</button>
				</div>
			</form>

		</div>
	</div>
	</div>
</main>


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


<script>
	document.addEventListener('DOMContentLoaded', function() {
    var userTypeSelect = document.getElementById('user_type');
    var campusSelect = document.getElementById('campus_id');

    function toggleCampusSelect() {
        if (userTypeSelect.value == 4) { // Check if the value is 4
            campusSelect.disabled = false;
        } else {
            campusSelect.disabled = true;
        }
    }

    // Initial check in case the form is pre-filled
    toggleCampusSelect();

    // Add event listener to user type select element
    userTypeSelect.addEventListener('change', toggleCampusSelect);
});

</script>
