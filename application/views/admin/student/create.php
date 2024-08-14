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
						<div id="searchResults"></div>
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
						<select class="form-select" name="classification" id="classification" required>
							<option selected value="">Choose from below</option>
							<option value="0">New</option>
							<option value="1">Continuing</option>
							<option value="2">Returning</option>
						</select>
					</div>
					<div class="col-md-4" id="previous-school" style="display: none;">
						<label class="form-label">Name of School Last Attended:</label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" name="previous_school" />
						</div>
					</div>
					<div class="col-md-4" id="previous-school-year" style="display: none;">
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
							<input class="form-control form-control-sm" id="first_name" type="text" required
								name="first_name" />
						</div>
					</div>


					<div class="col-md-4">
						<label class="form-label">Middle Name</label>
						<div class="input-group">
							<input class="form-control form-control-sm" id="middle_name" type="text"
								name="middle_name" />
						</div>
					</div>


					<div class="col-md-4">
						<label class="form-label">Last Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" id="last_name" required
								name="last_name" />
						</div>
					</div>
				</div>


				<div class="row mt-3">
					<div class="col-md-3">
						<label class="form-label">Gender<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" id="gender" name="gender" required>
							<option selected value="">Choose from below</option>
							<option value="0">Male</option>
							<option value="1">Female</option>
						</select>
					</div>

					<div class="col-md-3">
						<label class="form-label">Civil Status<span class="text-danger">*</span></label>
						<select class="form-select form-select-sm" id="civil_status" name="civil_status" required>
							<option selected value="">Choose from below</option>
							<option value="0">Single</option>
							<option value="1">Married</option>
						</select>
					</div>

					<div class="col-md-3">
						<label class="form-label">Email<span class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" id="email" type="email" required name="email" />
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
						<select class="form-select form-select-sm" name="year_level" id="year_level" required>
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
							<input class="form-control form-control-sm" type="text" required name="father_name"
								id="father_name" />
						</div>
					</div>

					<div class="col-md-6">
						<label class="form-label">Mother Name<span class="text-red"></span><span
								class="text-danger">*</span></label>
						<div class="input-group">
							<input class="form-control form-control-sm" type="text" required id="mother_name"
								name="mother_name" />
						</div>
					</div>
				</div>



				<div class="row mt-4">
					<div class="col-6 d-flex justify-content-start align-items-start">
						<button class="btn btn-success btn-md fw-semibold mx-2" type="submit" name="submit">Add
							Student</button>
						<a href="<?= base_url('admin/students') ?>" class="btn btn-danger btn-md fw-semibold">Back</a>
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
		$('#classification').change(function () {
			var selectedValue = $(this).val();
			if (selectedValue == '0') {
				$('#previous-school').show();
				$('#previous-school-year').show();
			} else {
				$('#previous-school').hide();
				$('#previous-school-year').hide();
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

<script>
	$(document).ready(function () {
		// Function to search for student IDs and populate possible names
		function searchStudent() {
			var studentId = $('#student_id').val();

			// Check if studentId is not empty
			if (studentId.trim() === '') {
				$('#searchResults').html('<div class="m-2"><small>Please enter a student ID</small></div>');
				return;
			}

			$.ajax({
				url: '<?php echo base_url("students/searchStudent"); ?>',
				type: 'post',
				data: {
					student_id: studentId
				},
				dataType: 'json',
				success: function (response) {
					if (response) {
						// Display possible names
						var resultsHtml = '';
						$.each(response, function (index, student) {
							resultsHtml +=
								'<div class="studentName" style="padding: 2px; margin-bottom: 2px; border: 1px solid #ccc; border-radius: 2px; background-color: none; cursor:pointer;" data-studentid="' +
								student.student_id + '">' + student.first_name + ' ' + student
								.last_name + '</div>';

						});
						$('#searchResults').html(resultsHtml);
					} else {
						$('#searchResults').html(
							'<div class="m-2"><small>No student found</small></div>');
					}
				},
				error: function (xhr, status, error) {
					console.error('Error:', error);
					$('#searchResults').html(
						'<div class="m-2"><small>Error searching for student</small></div>');
				}
			});
		}

		// Function to populate the form with student data
		function populateForm(studentId) {
			$.ajax({
				url: '<?php echo base_url("students/getStudentData"); ?>',
				type: 'post',
				data: {
					student_id: studentId
				},
				dataType: 'json',
				success: function (response) {
					if (response) {
						$('#student_id').val(response.student_id);
						$('#first_name').val(response.first_name);
						$('#middle_name').val(response.middle_name);
						$('#last_name').val(response.last_name);
						$('#gender').val(response.gender);
						$('#civil_status').val(response.civil_status);
						$('#email').val(response.email);
						$('#contact').val(response.contact);
						$('#province_id').val(response.province_id);
						$('#municipal_id').val(response.municipal_id);
						$('#barangay_id').val(response.barangay_id);
						$('#campus_id').val(response.campus_id);
						$('#year_level').val(response.year_level);
						$('#course_id').val(response.course_id);
						$('#father_name').val(response.father_name);
						$('#mother_name').val(response.mother_name);
						$('#classification').val(response.classification);
						$('#previous_school').val(response.previous_school);
						$('#previous_school_year').val(response.previous_school_year);
					} else {
						$('#searchResults').html(
							'<div class="m-2"><small>Error retrieving student data</small></div>');
					}
				},
				error: function (xhr, status, error) {
					console.error('Error:', error);
					$('#searchResults').html(
						'<div class="m-2"><small>Error retrieving student data</small></div>');
				}
			});
		}

		// Event listener for clicking on a student's name
		$(document).on('click', '.studentName', function () {
			var studentId = $(this).data('studentid');
			populateForm(studentId); // Populate form with student data
			$('#searchResults').html(''); // Clear the search results
		});

		// Event listener for typing in the student ID input field
		$('#student_id').on('input', function () {
			searchStudent(); // Call the searchStudent function
		});
	});

</script>
