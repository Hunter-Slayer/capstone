<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Campus Details</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Campus</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/campus') ?>" class="btn btn-primary">Back</a>
	</div>

	<div class="alert alert-success" id="message" style="display: none;">
	</div>

	<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>


	<div class="card">
		<div class="card-body">


			<form class="row g-3" id="addStudentForm" action="<?=base_url('campus/store') ?>" method="POST">
				<h5 class="card-title mx-2">Campus Data</h5>


				<div class="col-md-6">
					<label class="form-label">Campus<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="description" value="<?=$campus['description'] ?>" />
					</div>
				</div>
			
			
				<div class="col-md-6">
					<label class="form-label">Abbrevation<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="name"  value="<?=$campus['name'] ?>"  />
					</div>
				</div>

				<div class="col-md-6">

<label class="form-label">Status<span class="text-danger">*</span></label>
<select disabled class="form-select" name="status" required>
	<option selected value="">Choose from below</option>
	<option value="0" <?= ($campus['status'] == 0) ? 'selected' : '' ?>>Active</option>
	<option value="1" <?= ($campus['status'] == 1) ? 'selected' : '' ?>>Inactive</option>
</select>
</div>


		

			</form>

		</div>
	</div>
	</div>
</main>
