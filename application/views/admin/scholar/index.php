<main id="main" class="main">

	<div class="pagetitle">
		<h1>Scholarships</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="">Dashboard</a></li>
				<li class="breadcrumb-item">Scholarships</li>
			</ol>
		</nav>
	</div>


	<div class="d-flex justify-content-end my-2">
		<a href="<?= base_url('admin/scholarships/create') ?>" class="btn btn-primary mx-2">Add</a>

	</div>


	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">


						<h5 class="card-title">Scholarships Data</h5>

						<div class="table-responsive">

							<table class="table datatable table-striped table-hover" id="filteredStudentTable">
								<thead>
									<tr>

										<th>Scholarship</th>
										<th>Abbrevation</th>
										<th>Type</th>
										<th>Status</th>
										<th>Manage</th>
									</tr>
								</thead>




								<tbody>
									<?php foreach ($scholarships as $scholar): ?>
										<tr>
											<?php
											if (!function_exists('limit_words')) {
												function limit_words($string, $word_limit)
												{
													$words = explode(" ", $string);
													return implode(" ", array_splice($words, 0, $word_limit));
												}
											}
											?>

											<td><?= limit_words($scholar['name'], 5) ?></td>


											<td><?= $scholar['code'] ?></td>
											<td><?= ($scholar['type'] == 0) ? 'Government' : 'Private' ?></td>
											<td><?= ($scholar['status'] == 0) ? 'Active' : 'Inactive' ?></td>

											<td>
												<a href="<?= site_url('admin/scholarship/view/' . $scholar['id']) ?>"
													class="btn-primary btn btn-sm">View</a>
												<a href="<?= site_url('admin/scholarship/edit/' . $scholar['id']) ?>"
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
