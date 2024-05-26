<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Add Student</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Student</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="card">
		<div class="m-2">
			<?php if ($this->session->flashdata('success')) : ?>
			<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('error')) : ?>
			<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
			<?php endif; ?>
		</div>
		<div class="card-body">
			<form class="row g-3" id="addStudentForm" action="<?=base_url('students/store') ?>" method="POST">
				<h5 class="card-title mx-2">Personal Information</h5>

				<div class="row">

					<div class="col-md-4">
						<label class="form-label">Student ID<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" id="student_id" required
								name="student_id" />
						</div>
						<span class="text-sm text-danger"><?= form_error('student_id') ?></span>
					</div>

					<div class="row mt-2">
						<div class="col-md-4">
							<label class="form-label">Campus<span class="text-danger">*</span></label>
							<select class="form-select" name="campus_id" required id="campus_id">
								<option selected value="">Choose from below</option>
								<?php foreach ($campus as $camp): ?>
								<option value="<?= $camp['id']?>"><?= $camp['name']?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<hr class="m-4">
				</div>

				<div class="row mb-2">
					<div class="col-md-3">
						<label class="form-label">Student type<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<select class="form-select" name="classification" id="student-type" required>
							<option selected value="">Choose from below</option>
							<option value="0">New</option>
							<option value="1">Continuing</option>
							<option value="2">Returning</option>
						</select>
					</div>
					<div class="col-md-4" id="previous-school-div" style="display: none;">
						<label class="form-label">Name of School Last Attended:</label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" name="previous_school" />
						</div>
					</div>
					<div class="col-md-4" id="previous-school-year-div" style="display: none;">
						<label class="form-label">Last School Year Attended:</label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" name="previous_school_year" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label class="form-label">First Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" required name="first_name" />
						</div>
					</div>


					<div class="col-md-4">
						<label class="form-label">Middle Name</label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" name="middle_name" />
						</div>
					</div>


					<div class="col-md-4">
						<label class="form-label">Last Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" required name="last_name" />
						</div>
					</div>
				</div>


				<div class="row mt-3">
					<div class="col-md-3">
						<label class="form-label">Gender<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" name="gender" required>
							<option selected value="">Choose from below</option>
							<option value="0">Male</option>
							<option value="1">Female</option>
						</select>
					</div>

					<div class="col-md-3">
						<label class="form-label">Civil Status<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" name="civil_status" required>
							<option selected value="">Choose from below</option>
							<option value="0">Single</option>
							<option value="1">Married</option>
						</select>
					</div>

					<div class="col-md-3">
						<label class="form-label">Email<span class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="email" required name="email" />
						</div>
					</div>


					<div class="col-md-3">
						<label class="form-label">Contact Number<span class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" name="contact" id="contact"
								minlength="11" maxlength="11" />
						</div>
						<span class="text-xs text-danger" id="alert-exist"></span>

					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-4">

						<label class="form-label">Province<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" name="province_id" required id="province_id">
							<option selected value="">Choose from below</option>
							<?php foreach ($provinces as $province): ?>
							<option value="<?= $province['provCode']; ?>"><?= $province['provDesc']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-md-4">
						<label class="form-label">Municipality<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" name="municipal_id" required id="municipal_id">
							<option selected value="">Choose from below</option>

						</select>
					</div>

					<div class="col-md-4">
						<label class="form-label">Barangay<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" name="barangay_id" required id="barangay_id">
							<option selected value="">Choose from below</option>

						</select>
					</div>
				</div>




				<h5 class="card-title mx-2">School Information</h5>

				<div class="row">
					<div class="col-md-4">
						<label class="form-label">Year Level<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" name="year_level" required>
							<option selected value="">Choose from below</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
						</select>
					</div>


					<div class="col-md-8">
						<label class="form-label">Course<span class="text-danger">*</span></label>
						<select id="course_id" class="form-select form-select-sm" name="course_id" required>
							<option selected value="">Choose from below</option>
						</select>
					</div>
				</div>



				<h5 class="card-title mx-2">Parent Information</h5>
				<div class="row">
					<div class="col-md-6">
						<label class="form-label">Father Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" required name="father_name" />
						</div>
					</div>

					<div class="col-md-6">
						<label class="form-label">Mother Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" required name="mother_name" />
						</div>
					</div>
				</div>



				<div class="row mt-4">
					<div class="col-6 d-flex justify-content-start align-items-start">
						<button class="btn btn-success btn-md text-black fw-semibold mx-2" type="submit"
							name="submit">Add
							Student</button>
						<a href="<?= base_url('admin/students') ?>"
							class="btn btn-danger btn-md text-black fw-semibold">Back</a>
					</div>
					<div class="col-6">
						<?php if ($this->session->flashdata('success')) { ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
						<?php } ?>
					</div>

				</div>





			</form>
		</div>

	</div>
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
		$('#student-type').change(function () {
			var selectedValue = $(this).val();
			if (selectedValue == '0') {
				$('#previous-school-div').show();
				$('#previous-school-year-div').show();
			} else {
				$('#previous-school-div').hide();
				$('#previous-school-year-div').hide();
			}
		});
	});

</script>
<script>
	document.addEventListener("DOMContentLoaded", function () {
		const studentIdInput = document.getElementById("student_id");
		studentIdInput.addEventListener("input", function () {
			let inputText = this.value.replace(/\D/g, "").substring(0, 10);
			let formattedText = inputText.replace(/(\d{3})(\d{4})(\d{1,2})/, "$1-$2-$3");
			this.value = formattedText;
		});
	});

</script>
