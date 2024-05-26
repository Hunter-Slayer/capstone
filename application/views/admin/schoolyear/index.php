<main class="main" id="main">
	<div class="pagetitle">
		<h1>Add School Year</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
				<li class="breadcrumb-item active">School Year</li>
			</ol>
		</nav>
	</div>

	<section class="p-2">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">
					<?php if ($this->session->flashdata('message')) : ?>
					<div class="alert alert-success" role="alert">
						<?php echo $this->session->flashdata('message'); ?>
					</div>
					<?php endif; ?>
					<?php if ($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger" role="alert">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php endif; ?>
					<div class="card shadow-sm">
						<div class="card-header text-center">
							<h3 class="card-title">School Year</h3>
							<p class="card-subtitle mb-2 text-muted">Enter the new school year to be added to the
								system.</p>
						</div>
						<form method="post" action="<?php echo site_url('school/store'); ?>">
						<div class="card-body p-3">
							<div class="mb-3">
								<label class="form-label">School Year</label>
								<input type="text" class="form-control form-control-md" name="year" id="year"
									maxlength="9" placeholder="e.g., 2020-2021">
								<small class="form-text text-muted">Note: <span class="text-danger">e.g.,
										(2020-2021)</span></small>
								<?php echo form_error('year'); ?>
							</div>
						</div>
						<div class="card-footer d-flex justify-content-start">
							<button type="submit" class="btn btn-md btn-primary btn-rounded">Save</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
