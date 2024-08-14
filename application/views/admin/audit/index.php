<main id="main" class="main">
	<div class="pagetitle">
		<h1>Transaction Logs</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard')?>">Dashboard</a></li>
				<li class="breadcrumb-item">Transaction Logs</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Transaction Log</h5>
					<div class="table-responsive-lg">
						<table class="table datatable table-striped table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>User type</th>
									<th>Action Taken</th>
									<!-- <th>Data</th> -->
									<th>Campus</th>
									<th>Created at</th>
									<th>Updated at</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users as $user): ?>
								<tr>
									<td><?= htmlspecialchars($user['usersName'] ?? '') ?></td>
									<td><?= htmlspecialchars($user['userTypeName'] ?? '') ?></td>
									<td><?= htmlspecialchars($user['action'] ?? '') ?></td>
									<td><?= htmlspecialchars($user['campusName'] ?? 'All Campus') ?></td>
									<td><?= date('F j Y', strtotime($user['created_at'] ?? '')) ?></td>
									<td><?= date('F j Y', strtotime($user['updated_at'] ?? '')) ?></td>

								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
