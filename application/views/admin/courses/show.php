<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Course Information</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Course</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/courses') ?>" class="btn btn-primary">Back</a>
	</div>

	<div class="alert alert-success" id="message" style="display: none;">
	</div>

	<?php if ($this->session->flashdata('success')): ?>
		<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
	<?php endif; ?>


	<div class="card">
		<div class="card-body">


			<form class="row g-3" id="addStudentForm" action="<?= base_url('courses/store') ?>" method="POST">
				<h5 class="card-title mx-2">Course Data</h5>


				<div class="col-md-6">
					<label class="form-label">Course Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<input disabled class="form-control" type="text" required name="name" value="<?=$course['name'] ?>" />
				</div>


				<div class="col-md-6">
					<label class="form-label">Abbrevation<span class="text-red"></span><span
							class="text-danger">*</span></label>

					<input disabled class="form-control" type="text" required name="abbrevation" value="<?=$course['abbrevation'] ?>" />

				</div>

				<div class="col-md-6">

    <label class="form-label">Campus<span class="text-danger">*</span></label>
    <select disabled class="form-select" name="campus_id" required>
        <option value="" <?= ($course['campus_id'] == '') ? 'selected' : '' ?>>Choose from below</option>
        <?php foreach ($campus as $camp): ?>
            <option value="<?=$camp['id']?>" <?= ($camp['id'] == $course['campus_id']) ? 'selected' : '' ?>><?=$camp['name']?></option>
        <?php endforeach; ?>
    </select>
</div>


				<div class="col-md-6">

<label class="form-label">Status<span class="text-danger">*</span></label>
<select disabled  class="form-select" name="status" required>
	<option selected value="">Choose from below</option>
	<option value="0" <?= ($course['status'] == 0) ? 'selected' : '' ?>>Active</option>
	<option value="1" <?= ($course['status'] == 1) ? 'selected' : '' ?>>Inactive</option>
</select>
</div>
		


			</form>

		</div>
	</div>
	</div>
</main>
