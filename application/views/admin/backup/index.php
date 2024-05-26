<main id="main" class="main">
	<div>
		<div class="pagetitle">
			<h1>Back Up</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Back Up</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="alert alert-success" id="message" style="display: none;">
	</div>

	<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
	<?php endif; ?>


	<div class="card col-md-6">
		<div class="card-body">


			<form class="row my-3" action="<?= base_url('backup/backupData') ?>" method="POST">


				<p>
					Creating regular backups of your database is crucial for data integrity and system recovery.
					In case of unexpected events or data loss, having a recent backup ensures that you can
					restore your system to a known, stable state. Please follow the steps below to perform a
					system backup:
				</p>
				<p>

					<li>Click the "Perform System Backup" button below.</li>
					<li>Wait for the backup process to complete.</li>
					<li>A notification will be show once complete.</li>
				</p>


				<div class="d-flex justify-content-end mx-2 ">

					<button name="backup" class="btn btn-primary btn-md mx-2">
						Backup
					</button>

				</div>


			</form>

		</div>
	</div>
	</div>
</main>
