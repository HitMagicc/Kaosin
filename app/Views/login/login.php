<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<main class="login-container">
    <section class="non-title-container">
        <section class="login-form">
            <section class="bungkusanbaru">
                <div class="title-form-bungkus">
                    <span class="title-login">
                        LOGIN
                    </span>
                </div>
                <form action="<?= base_url('login') ?>" method="POST">
                    <div class="input-group">
                        <label for="username">Username or Email</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <label for="" style="font-size: small;"><a href="">Lupa Password?</a> </label><br>  
                    <button type="submit" class="login-btn">LOGIN</button>

                </form>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <p style="text-align:center;">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar Sekarang Juga</a></p>
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
            <a  class="prevAuth">&#10094;</a>
            <a  class="nextAuth">&#10095;</a>
        </section>
    </section>
    
</main>
<?= $this->endSection() ?>

