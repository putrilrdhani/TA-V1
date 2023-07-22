<?= $this->extend('auth/index'); ?>

<?= $this->section('content'); ?>
<div class="row justify-content-center align-items-center h-100" style="background-color: #2d499d">
    <div class="col-xl-4 col-lg-5 col-10">
        <div class="card">
            <div class="card-content">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?= base_url(); ?>"><img src="<?= base_url('media/icon/logo.svg'); ?>" alt="Logo" /></a>
                    </div>
                    <h1 class="auth-title text-center">Login</h1>
                    <p class="auth-subtitle mb-4 text-center">
                        Log in with your data that you entered during registration.
                    </p>

                    <form action="" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="login" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" class="form-control" placeholder="Username" name="login" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check d-flex align-items-start">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault" name="remember" />
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Remember Me
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block shadow mt-5" type="submit">
                            Login
                        </button>
                    </form>
                    <div class="text-center mt-4 text-lg">
                        <p class="text-gray-600">
                            Need an account?
                            <a href="<?= route_to('register') ?>" class="font-bold">Register</a> <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>