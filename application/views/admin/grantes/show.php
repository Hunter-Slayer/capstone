<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>View Student Grantee</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Grantee</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="d-flex justify-content-end my-2">
		<button onclick="goBack()" class="btn btn-danger">Back</button>
	</div>



	<div class="card">
		<div class="card-body">


			<h5 class="card-title">Grantee Data</h5>

			<div class="row g-3">

				<div class="col-md-6">
					<label class="form-label">Student Name</label>
					<input disabled class="form-control" type="text" required name="name"
						value="<?= $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name'] ?>" />

				</div>




				<div class="col-md-6">
					<label class="form-label">Year Level</label>
					<select disabled class="form-select" name="year_level">
						<option value="" <?= ($student['year_level'] == '') ? 'selected' : '' ?>>Choose from below
						</option>
						<option value="1" <?= ($student['year_level'] == '1') ? 'selected' : '' ?>>1st</option>
						<option value="2" <?= ($student['year_level'] == '2') ? 'selected' : '' ?>>2nd</option>
						<option value="3" <?= ($student['year_level'] == '3') ? 'selected' : '' ?>>3rd</option>
						<option value="4" <?= ($student['year_level'] == '4') ? 'selected' : '' ?>>4th</option>
						<option value="5" <?= ($student['year_level'] == '5') ? 'selected' : '' ?>>5th</option>
						<option value="6" <?= ($student['year_level'] == '6') ? 'selected' : '' ?>>6th</option>
					</select>
				</div>


				<div class="col-md-7">
					<label class="form-label">Campus</label>
					<input type="text" class="form-select" name="campus_id" id="campus_id" disabled
						value="<?= $student['campusName'] ?>">
				</div>

				<div class="col-md-5">
					<label class="form-label">Course</label>

					<input disabled class="form-control" type="text" name="course_id"
						value="<?= $student['courses_name'] ?>" id="course_id" />
				</div>

				<form class="g-3 row" action="<?= base_url('students/addGrantee/' . $student['id']) ?>" method="POST">




					<div class="row">
						<div class="col-md-6">
							<label class="form-label">Scholarship Type<span class="text-danger">*</span></label>
							<select class="form-select" name="type" required id="type1" disabled>
								<option selected value="">Choose from below</option>
								<option value="0" <?= ($student['scholarship_type'] == 0) ? 'selected' : '' ?>>
									Government</option>
								<option value="1" <?= ($student['scholarship_type'] == 1) ? 'selected' : '' ?>>Private
								</option>
							</select>
						</div>

						<div class="col-md-6">
							<label class="form-label">Scholarship<span class="text-danger">*</span></label>
							<input class="form-control" name="scholarship_id1" id="scholarship_id1"
								value="<?= $student['scholarship_name']?>" disabled />
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label class="form-label">Semester<span class="text-danger">*</span></label>
							<select disabled class="form-select" name="year_level" required>
								<option value="" <?= ($student['semester'] == '') ? 'selected' : '' ?>>Choose from below
								</option>
								<option value="1" <?= ($student['semester'] == '1') ? 'selected' : '' ?>>1st</option>
								<option value="2" <?= ($student['semester'] == '2') ? 'selected' : '' ?>>2nd</option>
							</select>
						</div>


						<div class="col-md-6">
							<label class="form-label">School Year<span class="text-danger">*</span></label>
							<select class="form-select" name="school_year" required disabled>
								<option value="" <?= ($student['school_year'] == '') ? 'selected' : '' ?>>Choose from
									below
								</option>
								<?php foreach ($years as $year) : ?>
								<option value="<?= $year['school_year'] ?>"
									<?= ($year['school_year'] == $student['school_year']) ? 'selected' : '' ?>>
									<?= $year['school_year'] ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>


				</form>


			</div>
		</div>
	</div>
</main>
<script>
	 function goBack() {
        window.history.back();
    }
</script>
