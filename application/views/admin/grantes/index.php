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
		<h1>Grantees</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item">Grantees</li>
			</ol>
		</nav>
	</div>

	<div class="d-flex justify-content-end my-2 ">
		<a href="<?=base_url('admin/student/create') ?>" class="btn text-dark btn-primary mx-2">Add</a>
		<a href="<?= base_url('grantes')?>" class="btn text-dark btn-warning mx-2">Reset</a>
	</div>
	<?php if ($this->session->flashdata('message')): ?>
	<div class="alert alert-info">
		<?= $this->session->flashdata('message'); ?>
	</div>
	<?php endif; ?>

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Grantees Data</h5>
						<div class="table-responsive">
							<table class="table datatable table-striped table-hover" id="filteredStudentTable">
								<thead>
									<tr>
										<th>Student ID</th>
										<th>Name</th>
										<th hidden>Address</th>
										<th hidden>Sex</th>
										<th hidden>Civil Status</th>
										<th hidden>Year Level</th>
										<th>Campus</th>
										<th>Scholarship</th>
										<th>Scholarship Type</th>
										<th hidden>Semester</th>
										<th hidden>School Year</th>
										<th>Manage</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($grantees as $grantee): ?>
									<tr>
										<td><?= $grantee['studentReference'] ?></td>
										<td><?= $grantee['fullName'] ?></td>
										<td hidden><?= $grantee['studentAddress'] ?></td>
										<td hidden><?= ($grantee['gender'] == 0 ) ? 'Male' : 'Female' ?></td>
										<td hidden><?= ($grantee['civil_status'] == 0 ) ? 'Single' : 'Married' ?></td>
										<td hidden><?= $grantee['year_level'] ?></td>
										<td><?= $grantee['campusName'] ?></td>
										<td><?= limitWords($grantee['scholarName'], 3) ?></td>
										<td><?= ($grantee['studentType'] == 0 ) ? 'Government' : 'Private' ?></td>
										<td hidden><?= $grantee['semester']?></td>
										<td hidden><?= $grantee['school_year']?></td>
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
															href="<?= site_url('admin/grante/view/' . $grantee['granteeId']) ?>">
															<i class="bi bi-eye text-primary fw-bold"></i> View</a></li>
													<li>
														<a class="dropdown-item fw-bold"
															href="<?= site_url('admin/grantes/delete/' . $grantee['granteeId']) ?>"
															onclick="return confirm('Are you sure you want to delete this grantee?');">
															<i class="bi bi-trash text-danger fw-bold"></i> Delete
														</a>
													</li>

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
