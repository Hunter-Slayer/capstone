<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Generate Report</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Report</li>
				</ol>
			</nav>
		</div>
	</div>

	<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')): ?>
	<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
	<?php endif; ?>


	<div class="card">
		<div class="card-body">


			<form class="row g-3" action="<?=base_url('reports/generateReport') ?>" method="POST">
				<h5 class="card-title mx-2">Students Data</h5>

				<div class="row mb-2">
					<!-- address -->
					<div class="col-md-4">

						<label class="form-label">Province</label>
						<select class="form-select" name="province_id" id="province_id">
							<option selected value="">Choose from below</option>
							<?php foreach ($provinces as $province): ?>
							<option value="<?= $province['provCode']; ?>"><?= $province['provDesc']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-md-4">
						<label class="form-label">Municipality</label>
						<select class="form-select" name="municipal_id" id="municipal_id">
							<option selected value="">Choose from below</option>

						</select>
					</div>

					<div class="col-md-4">
						<label class="form-label">Barangay</label>
						<select class="form-select" name="barangay_id" id="barangay_id">
							<option selected value="">Choose from below</option>

						</select>
					</div>
					<!-- end -->
				</div>


				<div class="row mb-2">
					<!-- Campus -->
					<div class="col-md-4">
						<label class="form-label">Campus</label>
						<select class="form-select" name="campus_id" id="campus_id">
							<option selected value="">Choose from below</option>
							<?php foreach ($campus as $camp): ?>
							<option value="<?= $camp['id']?>"><?= $camp['name']?></option>
							<?php endforeach; ?>
						</select>
					</div>


					<div class="col-md-8">
						<label class="form-label">Course</label>
						<select id="course_id" class="form-select" name="course_id">
							<option selected value="">Choose from below</option>
						</select>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-4">
						<label class="form-label">Semester<span class="text-danger">*</span></label>

						<select class="form-select" name="semester">
							<option value="">Choose from below</option>
							<option value="1">1st</option>
							<option value="2">2nd</option>
						</select>

					</div>
					<div class="col-md-4">
						<label class="form-label">School Year<span class="text-danger">*</span></label>
						<select class="form-select" name="school_year">
							<option value="">Choose from below</option>
							<?php foreach ($years as $year) : ?>
							<option value="<?= $year['school_year'] ?>">
								<?= $year['school_year'] ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="row mt-2">
					<!-- sCholarship -->
					<div class="col-md-4">
						<label class="form-label">Scholarship Type</label>
						<select class="form-select" name="type2" id="type2">
							<option value="">Choose from below</option>
							<option value="0">Government</option>
							<option value="1">Private</option>
						</select>
					</div>

					<div class="col-md-8">
						<label class="form-label">Scholarship</label>
						<select class="form-select" name="scholarship_id2" id="scholarship_id2">
							<option value="">Choose from below</option>
						</select>
					</div>
				</div>







				<div class="col-12 d-flex justify-content-start align-items-center">

					<button class="btn btn-primary mt-2 ml-2" type="submit" name="submit">Generate Report</button>
				</div>


			</form>

		</div>
	</div>
	</div>
</main>


<script>
	$(document).ready(function () {
		$('#province_id').change(function () {
			var province_id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('students/getMunicipalities'); ?>", // Fixed PHP echo
				type: "post",
				data: {
					province_id: province_id
				},
				success: function (response) {
					$('#municipal_id').html(response);
				}
			});
		});

		$('#municipal_id').change(function () { // Event listener for Municipality dropdown
			var municipal_id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('students/getBarangays'); ?>", // URL to fetch Barangays
				type: "post",
				data: {
					municipal_id: municipal_id
				},
				success: function (response) {
					$('#barangay_id').html(response);
				}
			});
		});
		// courses
		$('#campus_id').change(function () {
			var campus_id = $(this).val();
			$.ajax({
				url: "<?php echo base_url('students/getCourses'); ?>", // Fixed PHP echo
				type: "post",
				data: {
					campus_id: campus_id
				},
				success: function (response) {
					$('#course_id').html(response);
				}
			});
		});



	});

</script>


<script>
	$(document).ready(function () {


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

		if ($('#type2').val() !== "") {
			$('#type2').trigger('change');
		}
	});

</script>
