<main id="main" class="main">

	<div class="pagetitle">
		<h1>Courses</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="">Dashboard</a></li>
				<li class="breadcrumb-item">Courses</li>
			</ol>
		</nav>
	</div>


	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/courses/create') ?>" class="btn btn-primary mx-2">Add</a>

	</div>


	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">


						<h5 class="card-title">Courses Data</h5>

						<div class="table-responsive">

							<table class="table datatable table-striped table-hover" id="filteredStudentTable">
								<thead>
									<tr>

										<th>Courses Name</th>
										<th>Campus</th>
										<th>Status</th>
										<th>Manage</th>
									</tr>
								</thead>




								<tbody>
									<?php foreach ($courses as $course): ?>
										<tr>

											<td><?= $course['name'] ?></td>
											<td><?= $course['CampusName'] ?></td>
											<td class="text-center">
											<?php if ($course['status'] == 0): ?>
											<span class="badge bg-success rounded-pill">Active</span>
											<?php else: ?>
											<span class="badge bg-danger rounded-pill">Inactive</span>
											<?php endif; ?>
										</td>

											<td>
												<a href="<?= site_url('admin/courses/view/' . $course['courseId']) ?>"
													class="btn-primary text-dark btn btn-sm">View</a>
												<a href="<?= site_url('admin/courses/edit/' . $course['courseId']) ?>"
													class="btn-warning text-dark btn btn-sm">Edit</a>
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
