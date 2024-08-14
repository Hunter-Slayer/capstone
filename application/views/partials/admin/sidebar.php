<aside id="sidebar" class="sidebar">

	<ul class="sidebar-nav" id="sidebar-nav">

		<li class="nav-item">
			<a class="nav-link<?php echo (current_url() == base_url('admin/dashboard')) ? '' : ' collapsed'; ?>"
				href="<?=base_url('admin/dashboard') ?>">
				<i class="bi bi-grid-fill"></i></i>
				<span>Dashboard</span>
			</a>
		</li>




		<li class="nav-item">
			<a class="nav-link<?php echo (current_url() == base_url('admin/students')) ? '' : ' collapsed'; ?>"
				href="<?=base_url('admin/students') ?>">
				<i class="bi bi-people-fill"></i>
				<span>Students</span>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link<?php echo (current_url() == base_url('admin/grantes')) ? '' : ' collapsed'; ?>"
				href="<?=base_url('admin/grantes') ?>">
				<i class="bi bi-file-earmark-break-fill"></i>
				<span>Grantees</span>
			</a>
		</li>



		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
				<i class="bi bi-gear-fill"></i><span>System Settings</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="charts-nav" class="nav-content collapse <?= ($this->uri->segment(2) == 'scholarships' || $this->uri->segment(2) == 'campus' || $this->uri->segment(2) == 'audit' || $this->uri->segment(2) == 'backup' 
		|| $this->uri->segment(2) == 'courses') || $this->uri->segment(2) == 'schoolYear' ? 'show' : '' ?>"
				data-bs-parent="#sidebar-nav">


				<?php if ( $user['type_id'] == 2 ): ?>
				<li>
					<a href="<?= base_url('admin/backup') ?>"
						class="<?= ($this->uri->segment(2) == 'backup') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>Backup</span>
					</a>
				</li>
				<?php endif; ?>
				<li>
					<?php if ($user['type_id'] == 1 || $user['type_id'] == 2): ?>
					<a href="<?= base_url('admin/campus') ?>"
						class="<?= ($this->uri->segment(2) == 'campus') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>Campus</span>
					</a>
					<?php endif; ?>
				</li>


				<li>
					<a href="<?= base_url('admin/courses') ?>"
						class="<?= ($this->uri->segment(2) == 'courses') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>Courses</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url('admin/schoolyear/index') ?>"
						class="<?= ($this->uri->segment(2) == 'schoolyear') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>School Year</span>
					</a>
				</li>
				<li>
					<a href="<?= base_url('admin/scholarships') ?>"
						class="<?= ($this->uri->segment(2) == 'scholarships') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>Scholarships</span>
					</a>
				</li>
				<li>
					<a href="<?= base_url('admin/audit/index') ?>"
						class="<?= ($this->uri->segment(2) == 'audit') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>Transaction Log</span>
					</a>
				</li>
			</ul>
		</li>

		<?php if ( $user['type_id'] == 2 ): ?>
		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
				<i class="bi bi-people-fill"></i>User Settings</span><i class="bi bi-chevron-down ms-auto"></i>
			</a>
			<ul id="users-nav" class="nav-content collapse <?= ($this->uri->segment(2) == 'users') ? 'show' : '' ?>"
				data-bs-parent="#sidebar-nav">
				<li>
					<a href="<?= base_url('admin/users') ?>"
						class="<?= ($this->uri->segment(2) == 'users') ? 'text-primary' : '' ?>">
						<i class="bi bi-circle"></i><span>Users</span>
					</a>
				</li>
			</ul>
		</li>
		<?php endif; ?>

		<li class="nav-item">
			<a class="nav-link<?php echo (current_url() == base_url('admin/report')) ? '' : ' collapsed'; ?>"
				href="<?=base_url('admin/report') ?>">
				<i class="bi bi-file-bar-graph"></i>
				<span>Reports</span>
			</a>
		</li>


		<li class="nav-item">
			<a class="nav-link collapsed" href="<?= base_url('auth/logout') ?>">
				<i class="bi bi-box-arrow-in-left"></i>
				<span>Log out</span>
			</a>
		</li>

	</ul>

</aside>
