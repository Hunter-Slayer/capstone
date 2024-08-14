<?php if ( $user['type_id'] == 1 ): ?>
<style>
	#header {
		background-color: rgb(189, 189, 92);
	}

</style>
<?php endif; ?>

<?php if ( $user['type_id'] == 2 ): ?>
<style>
	#header {
		background-color: rgba(231, 7, 14);
	}

</style>
<?php endif; ?>

<?php if ($user['type_id'] == 3): ?>
<?php
    $headerColor = '';
    switch ($user['campusType']) {
        case 1:
            $headerColor = 'green';
            break;
        case 2:
            $headerColor = 'maroon';
            break;
        case 3:
            $headerColor = 'blue';
            break;
        case 4:
            $headerColor = 'gray';
            break;
    }
    ?>
<?php if ($headerColor): ?>
<style>
	#header {
		background-color: <?php echo $headerColor;
		?>;
	}

</style>
<?php endif; ?>
<?php endif; ?>

<style>
	.logo-img {
        width: 25%;
        height: 100%;
    }
</style>

<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between p-2">
    <a href="<?= base_url('admin/dashboard') ?>" class="logo d-flex align-items-center">
        <img class="logo-img me-2" src="<?= base_url('assets/images/updated.png') ?>" alt="DMMMSU">
        <span class="d-none d-lg-block text-white fw-bold fs-3">DMMMSU</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn text-white fw-bolder"></i>
</div>
	<!-- End Logo -->

	<nav class="header-nav ms-auto">
		<ul class="d-flex align-items-center">

			<?php if ( $user['type_id'] == 2 ): ?>
			<li class="nav-item dropdown">
				<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
					<i class="bi bi-bell text-dark fw-bolder"></i>
					<span class="badge bg-primary badge-number"><?php echo count($notifications); ?></span>
				</a>

				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
					<li class="dropdown-header">
						You have <?php echo count($notifications); ?> notification(s)
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<?php foreach ($notifications as $notification): ?>
					<li class="notification-item">
						<div>
							<p><?php echo $notification['count']; ?> new grantee(s) has been added by the
								<?php echo $notification['data']; ?></p>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</li>
			<?php endif; ?>

			<li class="nav-item dropdown pe-3">

				<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
					<span
						class="d-none d-md-block dropdown-toggle pe-5 fs-5 text-white"><?=$user['usersFullName'] ?></span>
				</a><!-- End Profile Iamge Icon -->

				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
					<li class="dropdown-header">
						<h6><?= $user['usersFullName'] ?></h6>
						<?php if ($user['type_id'] == 3): ?>
						<span><?= $user['userTypeName']  . ' - ' . $user['campusName'] ?></span>
						<?php else: ?>
						<span><?= $user['userTypeName'] ?></span>
						<?php endif; ?>
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li>
						<a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/logout') ?>">
							<i class="bi bi-box-arrow-right"></i>
							<span>Sign Out</span>
						</a>
					</li>
				</ul>

			</li><!-- End Profile Nav -->

		</ul>
	</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
