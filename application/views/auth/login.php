
<main>

  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <img src="<?= base_url('assets/img/dmmmsu.png') ?>" alt="DMMMSU Logo" class="w-25">



            <div class="d-flex justify-content-center py-4">
              <a href="" class="logo d-flex align-items-center w-auto">
                <span class="d-none d-lg-block">Scholarships System</span>
              </a>
            </div>


	
            <div class="card mb-3">
              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your email & password to login</p>
                </div>

								<?php if ($this->session->flashdata('error')) : ?>
								<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
							<?php endif; ?>
                <?php

                if (isset($_SESSION['success_message'])) {
                  echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';

                  unset($_SESSION['success_message']);
                }

                ?>

                <form class="g-3 row needs-validation" action="<?=base_url('auth/loginProcess') ?>" method="POST">


                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">

                      <input type="text" name="username"
                        class="form-control" id="yourUsername">
												
												
												
											</div>
											<span class="text-sm text-danger"><?= form_error('username') ?></span>

                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control " id="yourPassword">

										<span class="text-sm text-danger"><?= form_error('password') ?></span>

                  </div>


                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit" name="submit">Login</button>
                  </div>

                </form>

              </div>
            </div>





          </div>
        </div>
      </div>

    </section>

  </div>
</main>
