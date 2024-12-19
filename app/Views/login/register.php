<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<main class="login-container">
    <section class="non-title-container">
        <section class="login-form">
            <section class="bungkusanbaru">
                <div class="title-form-bungkus">
                    <span class="title-login">
                        REGISTER
                    </span>
                </div>
                <form action="<?= base_url("register") ?>" method="POST">
                    <div class="input-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="username">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="confirm_password">Confirm Password </label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php elseif (session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('validation') ?>
                        </div>
                    <?php endif; ?>
                    <label for="" style="font-size: small;"><a href="">Baca Ketentuan</a> </label>
                    <button type="submit" class="login-btn">DAFTAR</button>
                </form>
                <p style="text-align:center;">Sudah ada akun? <a href="<?= base_url('login') ?>">Login Sekarang</a></p>
            </section>
        </section>
        <div class="vertical-line"></div>
        <section class="image-carousel">
            <section class="bungkuscarousel">
                <section class="login-carousel-slide active">
                    <img src="<?= base_url('uploads/photo1.png') ?>" alt="Image 1">
                </section>
                <section class="login-carousel-slide">
                    <img src="<?= base_url('uploads/photo2.png') ?>" alt="Image 2">
                </section>
                <section class="login-carousel-slide">
                    <img src="<?= base_url('uploads/photo3.png') ?>" alt="Image 3">
                </section>
            </section>
            <a class="prevAuth">&#10094;</a>
            <a class="nextAuth">&#10095;</a>
        </section>
    </section>
</main>
<?= $this->endSection() ?>