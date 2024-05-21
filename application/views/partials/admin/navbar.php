<header id="header" class="header fixed-top d-flex align-items-center">

	<div class="d-flex align-items-center justify-content-between">
		<a href="index.html" class="logo d-flex align-items-center">
			<img class="w-40" src="<?= base_url('assets/images/updated.png') ?>" alt="">
			<span class="d-none d-lg-block">DMMMSU</span>
		</a>
		<i class="bi bi-list toggle-sidebar-btn"></i>
	</div><!-- End Logo -->

	<div class="search-bar">

	</div><!-- End Search Bar -->

	<nav class="header-nav ms-auto">
		<ul class="d-flex align-items-center">

			<?php if ( $user['type_id'] == 2 ): ?>
			<li class="nav-item dropdown">

				<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
					<i class="bi bi-bell"></i>

				</a><!-- End Notification Icon -->

				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
					<li class="dropdown-header">
						You have (counts) notifications
					</li>
					<li>
						<hr class="dropdown-divider">
					</li>

					<li class="notification-item">
						<div>
							<p>(counts) Grantee(s) has been added by (userRole for 3-campus)</p>
						</div>
					</li>

				</ul><!-- End Notification Dropdown Items -->

			</li><!-- End Notification Nav -->
			<?php endif; ?>

			<li class="nav-item dropdown pe-3">

				<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
					<span class="d-none d-md-block dropdown-toggle pe-5 fs-5"><?=$user['usersFullName'] ?></span>
				</a><!-- End Profile Iamge Icon -->

				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
					<li class="dropdown-header">
						<h6><?= $user['usersFullName'] ?></h6>
						<?php if ($user['type_id'] === 3): ?>
						<span><?= $user['userTypeName']  . '-' . $user['campusName'] ?></span>
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
