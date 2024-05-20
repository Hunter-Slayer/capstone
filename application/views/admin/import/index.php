<main id="main" class="main">

    <div class="pagetitle">
        <h1>Import Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item">Back Up</li>
            </ol>
        </nav>
    </div>
    <div>

    </div>
    <div class="row">

		
		
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Import Guide</h5>

					<?php if ($this->session->flashdata('fail')): ?>
				<div class="alert alert-danger"><?= $this->session->flashdata('fail') ?></div>
			<?php endif; ?>


				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
			<?php endif; ?>

                    <form action="<?=base_url('Imports/ImportStudent') ?>" method="POST" class="blogdesire-form" enctype="multipart/form-data">

                        <div class="col-md-12">
                            <label class="form-label">CSV File<span class="text-red"></span><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input required class="form-control" type="file"  name="data_upload" id="data_upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                            </div>
                        </div>
                        <p>

                            <li>Click and choose a CSV file you want to import.</li>
                            <li>Wait for the process to complete.</li>

                            <li class="text-danger">Please copy this format to avoid any error.</li>
							<img src="<?= base_url('assets/img/excelFormat.png') ?>" alt="Excel Image Sample" class="w-100">

                        </p>


                        <div class="d-flex justify-content-end mx-2 ">
                            <span class="text-sm mt-2 text-danger">Importing might take a while, please wait.</span>

                            <button name="submit" type="submit" class="btn btn-primary btn-md mx-2">
                                Import Students
                            </button>

                        </div>


                    </form>

                </div>
            </div>
        </div>



    </div>


</main>
