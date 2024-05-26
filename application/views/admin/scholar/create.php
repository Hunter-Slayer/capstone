<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Add Scholarship</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Scholarship</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<<button onclick="goBack()" class="btn-sm btn btn-danger">Back</button>
	</div>

	<div class="alert alert-success" id="message" style="display: none;">
	</div>

	<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
	<?php endif; ?>


	<div class="card">
		<div class="card-body">


			<form class="row g-3" id="addStudentForm" action="<?=base_url('scholarships/store') ?>" method="POST">
				<h5 class="card-title mx-2">Scholarship Data</h5>


				<div class="col-md-6">
					<label class="form-label">Scholarship Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input class="form-control" type="text" required name="name" />
					</div>
				</div>

				<div class="col-md-6">
					<label class="form-label">Abbrevation<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input class="form-control" type="text" required name="code" />
					</div>
				</div>

				<div class="col-md-6">
					<label class="form-label">Type<span class="text-danger">*</span></label>
					<select class="form-select" name="type" required>
						<option selected value="">Choose from below</option>
						<option value="0">Government</option>
						<option value="1">Private</option>
					</select>
				</div>




				<div class="col-12 d-flex justify-content-end align-items-center">

					<button class="btn btn-primary mt-2 ml-2" type="submit" name="submit">Add Scholarship</button>
				</div>


			</form>

		</div>
	</div>
	</div>
</main>
