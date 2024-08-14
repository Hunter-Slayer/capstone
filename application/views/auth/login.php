<main>
    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-10">
                    <div class="card shadow-lg rounded">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <img src="<?= base_url('assets/images/updated.png') ?>" alt="DMMMSU Logo" class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body p-4">
                                    <?php if ($this->session->flashdata('error')) : ?>
                                        <div class="alert alert-danger text-center"><?= $this->session->flashdata('error') ?></div>
                                    <?php endif; ?>
                                    <?php if ($this->session->flashdata('success')) : ?>
                                        <div class="alert alert-success text-center"><?= $this->session->flashdata('success') ?></div>
                                    <?php endif; ?>
                                    <form action="<?= base_url('auth/loginProcess') ?>" method="POST">
                                        <div class="mb-3">
                                            <h4 class="text-2xl fw-bold text-center mx-4 my-5">STUDENT SCHOLARSHIP MONITORING SYSTEM</h4>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group">
                                                <input type="text" name="username" id="username" class="form-control">
                                                <?php if (isset($validation) && $validation->hasError('username')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('username') ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="input-group-text">
                                                    <i class="icon bi bi-person fw-bold"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" class="form-control">
                                                <?php if (isset($validation) && $validation->hasError('password')) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('password') ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="input-group-text">
													<i class="icon bi bi-eye fw-bold"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" id="showPass" name="showPass">
                                            <label class="form-check-label" for="showPass">Show password</label>
                                        </div>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const showPassCheckbox = document.getElementById('showPass');

        function togglePasswordVisibility() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }

        showPassCheckbox.addEventListener('change', togglePasswordVisibility);
    });
</script>
