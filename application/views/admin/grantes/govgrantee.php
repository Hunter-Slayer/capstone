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
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item">Grantees</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-end my-2">
        <a href="<?= base_url('admin/student/create') ?>" class="btn btn-sm btn-primary mx-2">Add</a>
		<a href="<?= base_url('grantes')?>" class="btn btn-sm btn-warning mx-2">Reset</a>
    </div>

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
                                    <?php foreach($governments as $government): ?>
                                   <tr>
										<td><?= $government['studentReference'] ?></td>
										<td><?= $government['fullName'] ?></td>
										<td hidden><?= $government['studentAddress'] ?></td>
										<td hidden><?= ($government['gender'] == 0 ) ? 'Male' : 'Female' ?></td>
										<td hidden><?= ($government['civil_status'] == 0 ) ? 'Single' : 'Married' ?></td>
										<td hidden><?= $government['year_level'] ?></td>
										<td><?= $government['campusName'] ?></td>
										<td><?= limitWords($government['scholarName'], 3) ?></td>
										<td><?= ($government['studentType'] == 0 ) ? 'Government' : 'Private' ?></td>
										<td hidden><?= $government['semester']?></td>
										<td hidden><?= $government['school_year']?></td>
										<td>
											<a href="<?= site_url('admin/grante/view/' . $government['granteeId']) ?>"
												class="btn-primary btn btn-sm text-dark">View</a>
											<!-- <a href="<?= site_url('admin/grante/edit/' . $government['granteeId']) ?>" class="btn-warning btn btn-sm text-dark">Edit</a> -->
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
