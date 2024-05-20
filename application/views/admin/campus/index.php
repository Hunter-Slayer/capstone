<main id="main" class="main">

	<div class="pagetitle">
		<h1>Campus</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="">Dashboard</a></li>
				<li class="breadcrumb-item">Scholarships</li>
			</ol>
		</nav>
	</div>


	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/campus/create') ?>" class="btn btn-primary mx-2">Add</a>

	</div>


	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">


						<h5 class="card-title">Campus Data</h5>

						<div class="table-responsive">

							<table class="table datatable table-striped table-hover" id="filteredStudentTable">
								<thead>
									<tr>

										<th>Campus Name</th>
										<th>Abvr</th>
										<th>Status</th>
										<th>Manage</th>
									</tr>
								</thead>




								<tbody>
									<?php foreach ($campus as $camp): ?>
										<tr>
											
											<td><?= $camp['description'] ?></td>
											<td><?= $camp['name'] ?></td>
											<td><?= ($camp['status'] == 0) ? 'Active' : 'Inactive' ?></td>

											<td>
												<a href="<?= site_url('admin/campus/view/' . $camp['id']) ?>"
													class="btn-primary btn btn-sm">View</a>
												<a href="<?= site_url('admin/campus/edit/' . $camp['id']) ?>"
													class="btn-primary btn btn-sm">Edit</a>

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
