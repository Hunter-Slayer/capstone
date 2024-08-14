
<?php
function limitWords($string, $word_limit) {
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        return implode(" ", array_slice($words, 0, $word_limit)) . '...';
    } else {
        return $string;
    }
}

?>

<main id="main" class="main">

	<div class="pagetitle">
		<h1>Students</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
				<li class="breadcrumb-item">Student</li>
			</ol>
		</nav>
	</div>


	<div class="d-flex justify-content-start  my-2">
		<a href="<?=base_url('admin/student/create') ?>" class="btn btn-primary mx-2">Add</a>
		<!-- import -->
		<a href="<?= base_url('admin/import') ?>" class="btn btn-success">
			Import
		</a>
		<!-- ends -->

	</div>

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Students Data</h5>
						<div class="table-responsive">
							<table class="table datatable table-striped table-hover" id="filteredStudentTable">
								<thead>
									<tr>
										<th>Student ID</th>
										<th>FullName</th>
										<th>Year Level</th>
										<th>Course</th>
										<th>Campus</th>
										<th>Status</th>
										<th>Manage</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($students as $student): ?>
									<tr>
										<td><?= $student['student_id'] ?></td>
										<td><?= $student['last_name'] .' '. $student['first_name'] ?></td>
										<td><?= $student['year_level'] ?></td>
										<td><?= limitWords($student['courseName'], 4) ?></td>
										<td><?= $student['campusName'] ?></td>
										<td class="text-center">
											<?php if ($student['status'] == 0): ?>
											<span class="badge bg-success rounded-pill">Active</span>
											<?php else: ?>
											<span class="badge bg-danger rounded-pill">Inactive</span>
											<?php endif; ?>
										</td>
										<td>
											<div class="dropdown text-center">
												<button class="btn btn-link p-0 border-0" type="button"
													id="dropdownMenuButton" data-bs-toggle="dropdown"
													aria-expanded="false">
													<i
														class="bi bi-three-dots-vertical text-decoration-none fw-bold"></i>
												</button>
												<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<li><a class="dropdown-item fw-bold"
															href="<?= site_url('admin/student/view/' . $student['studentId']) ?>">
															<i class="bi bi-eye"></i> View</a></li>
													<li><a class="dropdown-item fw-bold"
															href="<?= site_url('admin/student/edit/' . $student['studentId']) ?>">
															<i class="bi bi-pencil"></i> Edit</a></li>
													<li><a class="dropdown-item fw-bold"
															href="<?= site_url('admin/student/grante/' . $student['studentId']) ?>">
															<i class="bi bi-mortarboard"></i> Grantee</a></li>
												</ul>
											</div>
										</td>

									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
