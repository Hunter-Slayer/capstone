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


  <div class="d-flex justify-content-end my-2">
    <a href="<?=base_url('admin/student/create') ?>" class="btn btn-primary mx-2">Add</a>
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
                  <th>Campus</th>
                  <th>Scholarship</th>
                  <th>Scholarship Type</th>
                  <th>Status</th>
                  <th>Manage</th>
                </tr>
              </thead>
						
			<tbody>
			<?php foreach($grantees as $grantee): ?>
    <tr>
        <td><?= $grantee['studentRefference'] ?></td>
        <td><?= $grantee['fullName'] ?></td>
        <td><?= $grantee['campusName'] ?></td>
				<td><?= limitWords($grantee['scholarName'], 5) ?></td>
        <td><?= ($grantee['studentType'] == 0 ) ? 'Government' : 'Private' ?></td>
				<td><?= ($grantee['studentStatus'] == 0) ? 'Active' : 'Inactive' ?></td>
			
				<td>
				<a href="<?= site_url('admin/grante/view/' . $grantee['granteeId']) ?>" class="btn-primary btn btn-sm text-dark">View</a>
				<!-- <a href="<?= site_url('admin/grante/edit/' . $grantee['granteeId']) ?>" class="btn-warning btn btn-sm text-dark">Edit</a> -->
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
