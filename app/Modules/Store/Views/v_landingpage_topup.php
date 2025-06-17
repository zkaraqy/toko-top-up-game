<!-- All Games Section -->
<div class="all-games-section">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header text-center">
            <h1 class="page-title">
                <i class="fas fa-gamepad me-3"></i>
                Semua Game
            </h1>
        </div>
        
        <!-- Games Grid -->
        <div class="row g-4">
            <?php if (isset($games) && !empty($games)): ?>
                <?php foreach ($games as $game): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="<?= base_url('/top-up/games/' . $game['slug']) ?>" class="text-decoration-none">
                            <div class="game-card">
                                <div class="game-image-wrapper">
                                    <?php if (!empty($game['path_foto'])): ?>
                                        <img src="<?= base_url('assets/images/games/' . $game['path_foto']) ?>"
                                            alt="<?= $game['title'] ?>"
                                            class="game-image">
                                    <?php else: ?>
                                        <div class="no-image">
                                            <i class="fas fa-gamepad"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="game-card-body">
                                    <h5 class="game-card-title"><?= $game['title'] ?></h5>
                                    <p class="game-card-developer">
                                        <i class="fas fa-code me-2"></i>
                                        <?= $game['developer'] ?>
                                    </p>

                                    <?php if ($game['total_options'] > 0) { ?>
                                        <div class="game-card-footer">
                                            <span class="game-badge">
                                                <i class="fas fa-gem me-1"></i>
                                                Top-Up Available
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 mb-5">
                    <div class="no-games-container">
                        <div class="no-games-content">
                            <i class="fas fa-gamepad no-games-icon"></i>
                            <h3>Belum Ada Game Tersedia</h3>
                            <p class="text-muted">Game sedang dalam proses penambahan. Silakan kembali lagi nanti!</p>
                            <a href="<?= base_url('/') ?>" class="btn btn-secondary">
                                <i class="fas fa-home me-2"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Back to Homepage -->
        <div class="text-center my-5">
            <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<style>
    /* All Games Section Styles */
    .all-games-section {
        padding-top: 50px;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-title i {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        font-size: 1.2rem;
        color: #718096;
        margin: 0;
    }

    /* Game Card Styles */
    .game-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        transform: translateY(0);
    }

    .game-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .game-image-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .game-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .game-card:hover .game-image {
        transform: scale(1.1);
    }

    .no-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #6c757d;
    }

    .no-image i {
        font-size: 3rem;
    }


    .overlay-content {
        text-align: center;
        color: white;
        transform: translateY(20px);
        transition: transform 0.4s ease;
    }

    .game-card:hover .overlay-content {
        transform: translateY(0);
    }

    .play-icon {
        font-size: 3rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .overlay-text {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    /* Game Card Body */
    .game-card-body {
        padding: 1.5rem;
    }

    .game-card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .game-card-developer {
        color: #718096;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .game-card-developer i {
        color: #667eea;
    }

    .game-card-footer {
        border-top: 1px solid #e2e8f0;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .game-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    /* No Games */
    .no-games-container {
        text-align: center;
        padding: 80px 20px;
    }

    .no-games-icon {
        font-size: 6rem;
        color: #cbd5e0;
        margin-bottom: 2rem;
    }

    .no-games-content h3 {
        color: #4a5568;
        margin-bottom: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .all-games-section {
            padding-top: 80px;
        }

        .page-title {
            font-size: 2.2rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
        }

        .game-image-wrapper {
            height: 180px;
        }

        .game-card-body {
            padding: 1.2rem;
        }
    }

    @media (max-width: 576px) {
        .page-title {
            font-size: 2rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .game-image-wrapper {
            height: 160px;
        }

        .game-card-title {
            font-size: 1.2rem;
        }

        .play-icon {
            font-size: 2.5rem;
        }
    }
</style>