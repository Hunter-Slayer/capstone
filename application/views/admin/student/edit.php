<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Edit Student</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Student</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/students') ?>" class="btn btn-danger">Back</a>
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
			<form class="row g-3" id="addStudentForm" action="<?= base_url('students/update/' . $student['id']) ?>"
				method="POST">

				<h5 class="card-title mx-2">Personal Information</h5>

				<div class="row">
					<div class="col-md-4">
						<label class="form-label">Student ID<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="student_id"
								value="<?= $student['student_id'] ?>" id="student_id" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label class="form-label">Campus<span class="text-danger">*</span></label>
						<select class="form-select" name="campus_id" required id="campus_id">
							<option value="" <?= ($student['campus_id'] == '') ? 'selected' : '' ?>>Choose from below
							</option>
							<?php foreach ($campus as $camp): ?>
							<option value="<?= $camp['id'] ?>"
								<?= ($camp['id'] == $student['campus_id']) ? 'selected' : '' ?>>
								<?= $camp['name'] ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<hr>
				<div class="row mb-2">
					<div class="col-md-3">
						<label class="form-label">Student type<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<select class="form-select" name="classification" id="student-type" required>
							<option value="">Choose from below</option>
							<option value="0" <?= ($student['classification'] == '0') ? 'selected' : '' ?>>New</option>
							<option value="1" <?= ($student['classification'] == '1') ? 'selected' : '' ?>>Continuing
							</option>
							<option value="2" <?= ($student['classification'] == '2') ? 'selected' : '' ?>>Returning
							</option>
						</select>
					</div>

					<div class="col-md-4" id="previous-school-div" style="display: none;">
						<label class="form-label">Name of School Last Attended:</label>
						<div class="input-group">
							<input class="form-control" type="text" name="previous_school"
								value="<?=$student['previous_school']?? "No Data" ?>" />
						</div>
					</div>
					<div class="col-md-4" id="previous-school-year-div" style="display: none;">
						<label class="form-label">Last School Year Attended:</label>
						<div class="input-group">
							<input class="form-control" type="text" name="previous_school_year"
								value="<?=$student['previous_school_year'] ?? "No Data" ?>" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label class="form-label">First Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="first_name"
								value="<?= $student['first_name'] ?>" />
						</div>
					</div>


					<div class="col-md-4">
						<label class="form-label">Middle Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="middle_name"
								value="<?= $student['middle_name'] ?>" />
						</div>
					</div>


					<div class="col-md-4">
						<label class="form-label">Last Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="last_name"
								value="<?= $student['last_name'] ?>" />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label class="form-label">Gender<span class="text-danger">*</span></label>
						<select class="form-select" name="gender">
							<option value="" <?= ($student['gender'] == '') ? 'selected' : '' ?>>Choose from below
							</option>
							<option value="0" <?= ($student['gender'] == '0') ? 'selected' : '' ?>>Male</option>
							<option value="1" <?= ($student['gender'] == '1') ? 'selected' : '' ?>>Female</option>
						</select>
					</div>


					<div class="col-md-3">
						<label class="form-label">Civil Status<span class="text-danger">*</span></label>
						<select class="form-select" name="civil_status">
							<option value="" <?= ($student['civil_status'] == '') ? 'selected' : '' ?>>Choose from below
							</option>
							<option value="0" <?= ($student['civil_status'] == '0') ? 'selected' : '' ?>>Single</option>
							<option value="1" <?= ($student['civil_status'] == '1') ? 'selected' : '' ?>>Married
							</option>
						</select>
					</div>


					<div class="col-md-3">
						<label class="form-label">Email<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="email" value="<?= $student['email'] ?>" />
						</div>
					</div>



					<div class="col-md-3">
						<label class="form-label">Contact Number</label>
						<div class="input-group">
							<input class="form-control" type="number" name="contact" id="contact"
								value="<?= $student['contact'] ?>" />
						</div>
						<span class="text-xs text-danger" id="alert-exist"></span>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label class="form-label">Province<span class="text-danger">*</span></label>
						<select class="form-select" name="province_id" required id="province_id">
							<option value="">Choose from below</option>
							<option value="<?= $student['provDesc'] ?>" selected><?= $student['provDesc'] ?></option>
							<?php foreach ($provinces as $province): ?>
							<option value="<?= $province['provCode']; ?>"><?= $province['provDesc']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="col-md-4">
						<label class="form-label">Municipality<span class="text-danger">*</span></label>
						<select class="form-select" name="municipal_id" required id="municipal_id">
							<option value="">Choose from below</option>
							<option selected value="<?= $student['citymunCode'] ?>"><?= $student['citymunDesc'] ?>
							</option>
						</select>
					</div>

					<div class="col-md-4">
						<label class="form-label">Barangay<span class="text-danger">*</span></label>
						<select class="form-select" name="barangay_id" required id="barangay_id">
							<option value="">Choose from below</option>
							<option selected value="<?= $student['brgyCode'] ?>"><?= $student['brgyDesc'] ?></option>
						</select>
					</div>
				</div>

				<div class="row">
					<h5 class="card-title mx-2">School Information</h5>
					<div class="col-md-2">
						<label class="form-label">Year Level<span class="text-danger">*</span></label>
						<select class="form-select" name="year_level">
							<option value="" <?= ($student['year_level'] == '') ? 'selected' : '' ?>>Choose from below
							</option>
							<option value="1" <?= ($student['year_level'] == '1') ? 'selected' : '' ?>>1</option>
							<option value="2" <?= ($student['year_level'] == '2') ? 'selected' : '' ?>>2</option>
							<option value="3" <?= ($student['year_level'] == '3') ? 'selected' : '' ?>>3</option>
							<option value="4" <?= ($student['year_level'] == '4') ? 'selected' : '' ?>>4</option>
							<option value="5" <?= ($student['year_level'] == '5') ? 'selected' : '' ?>>5</option>
						</select>
					</div>



					<div class="col-md-8">
						<label class="form-label">Course<span class="text-danger">*</span></label>
						<select class="form-select" name="course_id" id="course_id">
							<option value="">Choose from below</option>
							<option selected value="<?= $student['courseId'] ?>"><?= $student['courseName'] ?></option>

						</select>
					</div>

				</div>


				<div class="row">
					<h5 class="card-title mx-2">Parent Information</h5>

					<div class="col-md-6">
						<label class="form-label">Father Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="father_name"
								value="<?= $student['father_name'] ?>" />
						</div>
					</div>

					<div class="col-md-6">
						<label class="form-label">Mother Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control" type="text" name="mother_name"
								value="<?= $student['mother_name'] ?>" />
						</div>
					</div>
				</div>




				<div class="col-12 d-flex justify-content-start align-items-center">
					<button class="btn btn-primary mt-2 ml-2" type="submit" name="submit">Update Student</button>
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

		// campuis

	});

</script>
<script>
	$(document).ready(function () {
		function loadCourses(campus_id, selected_course_id = null) {
			$.ajax({
				url: "<?php echo base_url('students/getCourses'); ?>",
				type: "post",
				data: {
					campus_id: campus_id
				},
				success: function (response) {
					$('#course_id').html(response);
					if (selected_course_id) {
						$('#course_id').val(selected_course_id);
					}
				}
			});
		}

		$('#campus_id').change(function () {
			var campus_id = $(this).val();
			if (campus_id) {
				loadCourses(campus_id);
			} else {
				$('#course_id').html('<option value="">Choose from below</option>');
			}
		});

		var selectedCampusId = $('#campus_id').val();
		var selectedCourseId = "<?= $student['course_id'] ?>";
		if (selectedCampusId) {
			loadCourses(selectedCampusId, selectedCourseId);
		}
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
