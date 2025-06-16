<!-- Game Selection Section -->
<section class="games-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Pilih Game</h2>
            <p class="lead text-muted">Top up diamond untuk game</p>
        </div>

        <div class="row g-4">
            <!-- Mobile Legends -->
            <?php if (!isset($games)) { ?>
                <div class="col-12 d-flex justify-content-center">
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:" width="30" height="30">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            Belum ada pilihan game
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php foreach ($games as $game) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="<?= site_url('/top-up/games/' . $game['slug']) ?>">
                            <div class="game-card">
                                <div class="game-image">
                                    <img src="<?= base_url('assets/images/games/' . $game['path_foto']) ?>" alt="<?= $game['title'] ?>" class="img-fluid">
                                    <div class="game-overlay">
                                        <div class="game-info">
                                            <h5 class="game-title"><?= $game['title'] ?></h5>
                                            <p class="game-developer"><?= $game['developer'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <?php if (isset($games)) { ?>
            <div class="row mt-4">
                <div class="d-flex justify-content-center">
                    <a href="<?= site_url('/top-up/games') ?>" class="btn btn-outline-info">Lihat lainnya</a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<style>
    .hero-section {
        background: linear-gradient(135deg,rgba(102, 126, 234, 0.45) 0%,rgba(118, 75, 162, 0.57) 100%);
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

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

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
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.52), rgba(75, 162, 153, 0.6));
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