<!-- Hero Section -->
<!-- <section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4 text-gradient">
                    Top Up Diamond <span class="text-primary">Terpercaya</span>
                </h1>
                <p class="lead mb-4 text-muted">
                    Pilih game favoritmu dan top up diamond dengan mudah, cepat, dan aman. 
                    Dapatkan bonus menarik untuk setiap transaksi!
                </p>
                <div class="d-flex gap-3">
                    <button class="btn btn-primary btn-lg px-4 py-2">
                        <i class="fas fa-gamepad me-2"></i>Pilih Game
                    </button>
                    <button class="btn btn-outline-primary btn-lg px-4 py-2">
                        <i class="fas fa-info-circle me-2"></i>Cara Top Up
                    </button>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image">
                    <i class="fas fa-gem hero-icon"></i>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- Game Selection Section -->
<section class="games-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Pilih Game</h2>
            <p class="lead text-muted">Top up diamond untuk game</p>
        </div>
        
        <div class="row g-4">
            <!-- Mobile Legends -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="game-card">
                    <div class="game-image">
                        <img src="<?= base_url('assets/images/games/mobile-legends.jpg') ?>" alt="Mobile Legends" class="img-fluid">
                        <div class="game-overlay">
                            <div class="game-info">
                                <h5 class="game-title">Mobile Legends</h5>
                                <p class="game-developer">Moonton</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Free Fire -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="game-card">
                    <div class="game-image">
                        <img src="<?= base_url('assets/images/games/free-fire.jpg') ?>" alt="Free Fire" class="img-fluid">
                        <div class="game-overlay">
                            <div class="game-info">
                                <h5 class="game-title">Free Fire</h5>
                                <p class="game-developer">Garena</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PUBG Mobile -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="game-card">
                    <div class="game-image">
                        <img src="<?= base_url('assets/images/games/pubg-mobile.jpg') ?>" alt="PUBG Mobile" class="img-fluid">
                        <div class="game-overlay">
                            <div class="game-info">
                                <h5 class="game-title">PUBG Mobile</h5>
                                <p class="game-developer">Tencent Games</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Genshin Impact -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="game-card">
                    <div class="game-image">
                        <img src="<?= base_url('assets/images/games/genshin-impact.jpg') ?>" alt="Genshin Impact" class="img-fluid">
                        <div class="game-overlay">
                            <div class="game-info">
                                <h5 class="game-title">Genshin Impact</h5>
                                <p class="game-developer">miHoYo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="d-flex justify-content-center">
                <a href="<?= site_url('/games') ?>" class="btn btn-outline-info">Lihat lainnya</a>
            </div>
        </div>
    </div>
</section>

<!-- Payment Methods Section -->
<section class="payment-section py-5 bg-light mb-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Metode Pembayaran</h2>
            <p class="lead text-muted">Mendukung berbagai metode pembayaran</p>
        </div>

        <!-- Payment Methods Slider -->
        <div id="paymentCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/dana.png') ?>" alt="DANA" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/gopay.png') ?>" alt="GoPay" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/ovo.png') ?>" alt="OVO" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/shopeepay.png') ?>" alt="ShopeePay" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/linkaja.png') ?>" alt="LinkAja" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/bca.png') ?>" alt="BCA" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/mandiri.png') ?>" alt="Mandiri" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/bni.png') ?>" alt="BNI" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/bri.png') ?>" alt="BRI" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/cimb.png') ?>" alt="CIMB Niaga" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row justify-content-center">
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/visa.png') ?>" alt="Visa" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/mastercard.png') ?>" alt="Mastercard" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/paypal.png') ?>" alt="PayPal" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/indomaret.png') ?>" alt="Indomaret" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-2 col-md-1">
                            <div class="payment-card">
                                <img src="<?= base_url('assets/images/payments/alfamart.png') ?>" alt="Alfamart" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<!-- <section class="features-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Proses Cepat</h5>
                    <p class="text-muted">Diamond masuk ke akun Anda dalam hitungan menit setelah pembayaran berhasil</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Aman & Terpercaya</h5>
                    <p class="text-muted">Transaksi dijamin aman dengan sistem keamanan berlapis dan garansi uang kembali</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Support 24/7</h5>
                    <p class="text-muted">Tim customer service siap membantu Anda kapan saja jika ada kendala</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0 60px;
    margin-top: -76px;
    padding-top: 156px;
}

.text-gradient {
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-icon {
    font-size: 8rem;
    color: rgba(255, 255, 255, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* Game Cards */
.games-section {
    background: #f8f9fa;
}

.game-card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    background: white;
}

.game-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.game-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.game-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.game-card:hover .game-image img {
    transform: scale(1.1);
}

.game-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.game-card:hover .game-overlay {
    opacity: 1;
}

.game-info {
    text-align: center;
    color: white;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.game-card:hover .game-info {
    transform: translateY(0);
}

.game-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.game-developer {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 0;
}

/* Payment Methods */
.payment-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.payment-card {
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    margin: 0 5px;
}

.payment-card:hover {
    transform: translateY(-5px);
}

.payment-card img {
    max-height: 40px;
    width: auto;
}

/* Features Section */
.feature-card {
    padding: 2rem;
    border-radius: 15px;
    background: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 2rem;
}

/* Button Styles */
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-outline-primary {
    border: 2px solid white;
    color: white;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: white;
    color: #667eea;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        padding: 60px 0 40px;
        padding-top: 136px;
    }
    
    .hero-icon {
        font-size: 5rem;
    }
    
    .game-image {
        height: 150px;
    }
    
    .payment-card {
        margin: 5px 2px;
        padding: 10px;
    }
    
    .payment-card img {
        max-height: 30px;
    }
}

@media (max-width: 576px) {
    .display-4 {
        font-size: 2rem;
    }
    
    .display-5 {
        font-size: 1.8rem;
    }
    
    .game-image {
        height: 120px;
    }
}
</style>