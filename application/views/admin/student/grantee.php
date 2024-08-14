<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Add Student Grantee</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Grantee</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/students') ?>" class="btn btn-danger">Back</a>
	</div>


	<?php if ($this->session->flashdata('success')) : ?>
	<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('error')) : ?>
	<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
	<?php endif; ?>



	<div class="card">
		<div class="card-body">


			<h5 class="card-title">Grantee Data</h5>

			<div class="row g-3">

				<div class="row m-2">
					<div class="col-md-4">
						<label class="form-label">Student Name</label>
						<input disabled class="form-control" type="text" required name="name"
							value="<?= $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name'] ?>" />

					</div>


					<div class="col-md-2">
						<label class="form-label">Year Level</label>
						<select disabled class="form-select" name="year_level">
							<option value="" <?= ($student['year_level'] == '') ? 'selected' : '' ?>>Choose from below
							</option>
							<option value="1" <?= ($student['year_level'] == '1') ? 'selected' : '' ?>>1</option>
							<option value="2" <?= ($student['year_level'] == '2') ? 'selected' : '' ?>>2</option>
							<option value="3" <?= ($student['year_level'] == '3') ? 'selected' : '' ?>>3</option>
							<option value="4" <?= ($student['year_level'] == '4') ? 'selected' : '' ?>>4</option>
							<option value="5" <?= ($student['year_level'] == '5') ? 'selected' : '' ?>>5</option>
							<option value="6" <?= ($student['year_level'] == '6') ? 'selected' : '' ?>>6</option>
						</select>
					</div>
				</div>


				<div class="row m-2">
					<div class="col-md-4">
						<label class="form-label">Campus</label>
						<select disabled class="form-select" name="campus_id" required id="campus_id">
							<option value="" <?= ($student['campus_id'] == '') ? 'selected' : '' ?>>Choose from below
							</option>
							<?php foreach ($campus as $camp) : ?>
							<option value="<?= $camp['id'] ?>"
								<?= ($camp['id'] == $student['campus_id']) ? 'selected' : '' ?>>
								<?= $camp['name'] ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label">Course</label>
						<input disabled class="form-control" type="text" required name="abbrevation"
							value="<?= $student['courseName'] ?>" />
					</div>

				</div>
				<div class="row">
					<h5 class="card-title mx-2">Add Scholarship</h5>

					<form class="row" action="<?= base_url('students/addGrantee/' . $student['id']) ?>" method="POST">

						<?php 
						$scholarships = isset($student['scholarships']) ? count($student['scholarships']) : 0;

						if ($scholarships == 0) : ?>
						<h6 class="text-muted mb-2">Scholarship (1)</h6>
						<div class="row mb-2">
							<div class="col-md-6">
								<label class="form-label">Semester<span class="text-danger">*</span></label>
								<select class="form-select" name="semester1">
									<option value="">Choose from below</option>
									<option value="1">1st</option>
									<option value="2">2nd</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">School Year<span class="text-danger">*</span></label>
								<select class="form-select" name="school_year1">
									<option value="">Choose from below</option>
									<?php foreach ($years as $year) : ?>
									<option value="<?= $year['school_year'] ?>"><?= $year['school_year'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="form-label">Scholarship Type<span class="text-danger">*</span></label>
								<select class="form-select" name="type1" id="type1">
									<option value="">Choose from below</option>
									<option value="0">Government</option>
									<option value="1">Private</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Scholarship<span class="text-danger">*</span></label>
								<select class="form-select" name="scholarship_id1" id="scholarship_id1">
									<option value="">Choose from below</option>
								</select>
							</div>
						</div>

						<hr class="m-3">
						<h6 class="text-muted mb-2">Scholarship (2)</h6>
						<div class="row mb-2">
							<div class="col-md-6">
								<label class="form-label">Semester<span class="text-danger">*</span></label>
								<select class="form-select" name="semester2">
									<option value="">Choose from below</option>
									<option value="1">1st</option>
									<option value="2">2nd</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">School Year<span class="text-danger">*</span></label>
								<select class="form-select" name="school_year2">
									<option value="">Choose from below</option>
									<?php foreach ($years as $year) : ?>
									<option value="<?= $year['school_year'] ?>"><?= $year['school_year'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="form-label">Scholarship Type<span class="text-danger">*</span></label>
								<select class="form-select" name="type2" id="type2">
									<option value="">Choose from below</option>
									<option value="0">Government</option>
									<option value="1">Private</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Scholarship<span class="text-danger">*</span></label>
								<select class="form-select" name="scholarship_id2" id="scholarship_id2">
									<option value="">Choose from below</option>
								</select>
							</div>
						</div>
						<div class="col-12 d-flex justify-content-start align-items-center">
							<button class="btn btn-primary mt-4 ml-2" type="submit" name="submit">Add
								Scholarship</button>
						</div>

						<?php elseif ($scholarships == 1) : ?>
						<h6 class="text-muted mb-2">Scholarship (2)</h6>
						<div class="row mb-2">
							<div class="col-md-6">
								<label class="form-label">Semester<span class="text-danger">*</span></label>
								<select class="form-select" name="semester2">
									<option value="">Choose from below</option>
									<option value="1">1st</option>
									<option value="2">2nd</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">School Year<span class="text-danger">*</span></label>
								<select class="form-select" name="school_year2">
									<option value="">Choose from below</option>
									<?php foreach ($years as $year) : ?>
									<option value="<?= $year['school_year'] ?>"><?= $year['school_year'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="form-label">Scholarship Type<span class="text-danger">*</span></label>
								<select class="form-select" name="type2" id="type2">
									<option value="">Choose from below</option>
									<option value="0">Government</option>
									<option value="1">Private</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="form-label">Scholarship<span class="text-danger">*</span></label>
								<select class="form-select" name="scholarship_id2" id="scholarship_id2">
									<option value="">Choose from below</option>
								</select>
							</div>
						</div>
						<div class="col-12 d-flex justify-content-start align-items-center">
							<button class="btn btn-primary mt-4 ml-2" type="submit" name="submit">Add
								Scholarship</button>
						</div>

						<?php else : ?>
						<h3 class="text-muted mb-2">Scholarship Limit Reached</h3>
						<h5 class="text-danger">This Grantee has already reached the maximum limit of scholarships.</h5>
						<?php endif; ?>

					</form>



				</div>

			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function () {
		// Populate scholarship options for the first scholarship type
		$('#type1').change(function () {
			var type1 = $(this).val();
			$.ajax({
				url: "<?php echo base_url('students/getScholars'); ?>",
				type: "post",
				data: {
					type: type1
				},
				success: function (response) {
					$('#scholarship_id1').html(response);
				}
			});
		});

		// Populate scholarship options for the second scholarship type
		$('#type2').change(function () {
			var type2 = $(this).val();
			$.ajax({
				url: "<?php echo base_url('students/getScholarsTwo'); ?>",
				type: "post",
				data: {
					type: type2
				},
				success: function (response) {
					$('#scholarship_id2').html(response);
				}
			});
		});

		// Load scholarship options on page load if types are already selected
		if ($('#type1').val() !== "") {
			$('#type1').trigger('change');
		}
		if ($('#type2').val() !== "") {
			$('#type2').trigger('change');
		}
	});

</script>
