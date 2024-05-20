x<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Student Information</h1>
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

	<div class="alert alert-success" id="message" style="display: none;">
	</div>

	<div class="card">
		<div class="card-body">
			<form class="row g-3" id="addStudentForm" action="<?=base_url('students/store') ?>" method="POST">
				<h5 class="card-title mx-2">Personal Information</h5>

				<div class="col-md-6">
					<label class="form-label">Student ID<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="student_id"
							value="<?=$student['student_id'] ?>" />
					</div>
				</div>


				<div class="col-md-6">
					<label class="form-label">Campus<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="campus_id" required id="campus_id">
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

				<hr>
				<div class="col-md-4">
					<label class="form-label">First Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="first_name"
							value="<?=$student['first_name'] ?>" />
					</div>
				</div>


				<div class="col-md-4">
					<label class="form-label">Middle Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="middle_name"
							value="<?=$student['middle_name'] ?>" />
					</div>
				</div>


				<div class="col-md-4">
					<label class="form-label">Last Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="last_name"
							value="<?=$student['last_name'] ?>" />
					</div>
				</div>

				<div class="col-md-6">
					<label class="form-label">Gender<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="gender" required>
						<option value="" <?= ($student['gender'] == '') ? 'selected' : '' ?>>Choose from below</option>
						<option value="0" <?= ($student['gender'] == '0') ? 'selected' : '' ?>>Male</option>
						<option value="1" <?= ($student['gender'] == '1') ? 'selected' : '' ?>>Female</option>
					</select>
				</div>


				<div class="col-md-6">
					<label class="form-label">Civil Status<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="civil_status" required>
						<option value="" <?= ($student['civil_status'] == '') ? 'selected' : '' ?>>Choose from below
						</option>
						<option value="0" <?= ($student['civil_status'] == '0') ? 'selected' : '' ?>>Single</option>
						<option value="1" <?= ($student['civil_status'] == '1') ? 'selected' : '' ?>>Married</option>
					</select>
				</div>


				<div class="col-md-6">
					<label class="form-label">Email<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="email"
							value="<?=$student['email'] ?>" />
					</div>
				</div>



				<div class="col-md-6">
					<label class="form-label">Contact Number</label>
					<div class="input-group">
						<input disabled class="form-control" type="number" name="contact" id="contact"
							value="<?=$student['contact'] ?>" />
					</div>
					<span class="text-xs text-danger" id="alert-exist"></span>

				</div>

				<div class="col-md-4">
					<label class="form-label">Province<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="province_id" required id="province_id">
						<option value="">Choose from below</option>
						<option value="<?= $student['provDesc'] ?>" selected><?= $student['provDesc'] ?></option>

						<?php foreach ($provinces as $province): ?>
						<option value="<?= $province['provCode']; ?>"><?= $province['provDesc']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-md-4">
					<label class="form-label">Municipality<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="municipal_id" required id="municipal_id">
						<option value="">Choose from below</option>
						<option selected value="<?= $student['citymunCode'] ?>"><?= $student['citymunDesc'] ?></option>

					</select>
				</div>

				<div class="col-md-4">
					<label class="form-label">Barangay<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="barangay_id" required id="barangay_id">
						<option value="">Choose from below</option>
						<option selected value="<?= $student['brgyCode'] ?>"><?= $student['brgyDesc'] ?></option>

					</select>
				</div>


				<h5 class="card-title mx-2">School Information</h5>
				<div class="col-md-6">
					<label class="form-label">Year Level<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="year_level" required>
						<option value="" <?= ($student['year_level'] == '') ? 'selected' : '' ?>>Choose from below
						</option>
						<option value="1" <?= ($student['year_level'] == '1') ? 'selected' : '' ?>>1</option>
						<option value="2" <?= ($student['year_level'] == '2') ? 'selected' : '' ?>>2</option>
						<option value="3" <?= ($student['year_level'] == '3') ? 'selected' : '' ?>>3</option>
						<option value="4" <?= ($student['year_level'] == '4') ? 'selected' : '' ?>>4</option>
						<option value="5" <?= ($student['year_level'] == '5') ? 'selected' : '' ?>>5</option>
					</select>
				</div>




				<div class="col-md-6">
					<label class="form-label">Course<span class="text-danger">*</span></label>
					<select disabled class="form-select" name="course_id" id="course_id">
						<option value="">Choose from below</option>
						<option selected value="<?= $student['courseId'] ?>"><?= $student['courseName'] ?></option>

					</select>
				</div>


				<h5 class="card-title mx-2">Parent Information</h5>

				<div class="col-md-6">
					<label class="form-label">Father Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="father_name"
							value="<?=$student['father_name'] ?>" />
					</div>
				</div>

				<div class="col-md-6">
					<label class="form-label">Mother Name<span class="text-red"></span><span
							class="text-danger">*</span></label>
					<div class="input-group">
						<input disabled class="form-control" type="text" required name="mother_name"
							value="<?=$student['mother_name'] ?>" />
					</div>
				</div>



			</form>

		</div>
	</div>
	</div>
</main>
