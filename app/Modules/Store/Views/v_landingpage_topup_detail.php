<!-- Game Detail Section -->
<div class="game-detail-section">
    <div class="container">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="<?= base_url('/top-up/games') ?>" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Semua Game
            </a>
        </div> <!-- Game Information -->
        <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="game-image-container">
                    <?php if (!empty($game['path_foto'])): ?>
                        <img src="<?= base_url('assets/images/games/' . $game['path_foto']) ?>"
                            alt="<?= $game['title'] ?>"
                            class="game-main-image">
                    <?php else: ?>
                        <div class="no-image-placeholder">
                            <i class="fas fa-gamepad"></i>
                            <p>No Image Available</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="game-info-container">
                    <div class="d-flex align-items-center gap-4">
                        <h1 class="game-title"><?= $game['title'] ?></h1>
                        <div class="game-developer ">
                            <i class="fas fa-code me-1"></i>
                            <span><?= $game['developer'] ?></span>
                        </div>
                    </div>

                    <!-- Top-Up Options -->
                    <div class="topup-options">
                        <h4 class="topup-options-title mb-3">
                            <i class="fas fa-gem me-2"></i>
                            Pilih Paket Diamond
                        </h4>

                        <?php if (!empty($topUpOptions)): ?>
                            <div class="row g-3">
                                <?php foreach ($topUpOptions as $option): ?>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="topup-card-inline" onclick="selectTopUpOption(<?= $option['id'] ?>, <?= $option['price'] ?>)">
                                            <div class="topup-inline-content">
                                                <div class="topup-icon-inline">
                                                    <?php if (!empty($option['path_foto'])): ?>
                                                        <img src="<?= base_url('assets/images/topup/' . $option['path_foto']) ?>"
                                                            alt="Diamond Package"
                                                            class="topup-image-inline">
                                                    <?php else: ?>
                                                        <i class="fas fa-gem"></i>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="topup-info-inline">
                                                    <div class="topup-price-inline">
                                                        Rp <?= number_format($option['price'], 0, ',', '.') ?> (<?= $option['qty'] ?>)
                                                    </div>
                                                </div>

                                                <div class="topup-select-btn">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </div>
                                            </div>

                                            <!-- Selected indicator -->
                                            <div class="selected-indicator-inline">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="no-options-inline">
                                <div class="no-options-content-inline">
                                    <i class="fas fa-gem text-muted me-2"></i>
                                    <span>Belum ada paket tersedia untuk game ini</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Game Detail Styles */
    .game-detail-section {
        padding-top: 100px;
        min-height: 100vh;
        /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
    }

    .game-image-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        background: white;
        padding: 20px;
    }

    .game-main-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 15px;
    }

    .no-image-placeholder {
        height: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 15px;
        color: #6c757d;
    }

    .no-image-placeholder i {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .game-info-container {
        padding: 20px 0;
    }

    .game-title {
        font-size: 3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .game-developer {
        font-size: 1.2rem;
        color: #718096;
        font-weight: 500;
    }

    .game-developer i {
        color: #667eea;
    }

    /* Top-Up Options Inline Styles */
    .topup-options-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
    }

    .topup-options-title i {
        color: #667eea;
    }

    .topup-card-inline {
        background: white;
        border-radius: 15px;
        padding: 20px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        margin-bottom: 15px;
    }

    .topup-card-inline:hover {
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        transform: translateY(-2px);
    }

    .topup-card-inline.selected {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
    }

    .topup-card-inline.selected .selected-indicator-inline {
        opacity: 1;
        transform: scale(1);
    }

    .topup-inline-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .topup-icon-inline {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .topup-icon-inline i {
        font-size: 2rem;
        color: #667eea;
    }

    .topup-image-inline {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 12px;
        transition: transform 0.3s ease;
    }

    .topup-card-inline:hover .topup-image-inline {
        transform: scale(1.1);
    }

    .topup-info-inline {
        flex: 1;
    }

    .topup-price-inline {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 4px;
    }

    .topup-status {
        font-size: 0.9rem;
        color: #28a745;
        font-weight: 500;
    }

    .topup-status i {
        color: #28a745;
    }

    .topup-select-btn {
        width: 40px;
        height: 40px;
        background: #667eea;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .topup-card-inline:hover .topup-select-btn {
        background: #5a6fd8;
        transform: scale(1.1);
    }

    .selected-indicator-inline {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 25px;
        height: 25px;
        background: #28a745;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
    }

    .no-options-inline {
        padding: 30px 0;
    }

    .no-options-content-inline {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        color: #6c757d;
        text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .game-detail-section {
            padding-top: 80px;
        }

        .game-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .topup-card {
            padding: 20px 15px;
        }

        .purchase-btn {
            padding: 12px 30px;
            font-size: 1.1rem;
        }
    }

    @media (max-width: 576px) {
        .game-title {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .topup-price {
            font-size: 1.3rem;
        }
    }
</style>

<script>
    let selectedOptionId = null;
    let selectedPrice = 0;

    function selectTopUpOption(optionId, price) {
        // Remove previous selection
        document.querySelectorAll('.topup-card-inline').forEach(card => {
            card.classList.remove('selected');
        });

        // Add selection to clicked card
        event.currentTarget.classList.add('selected');

        // Update selected values
        selectedOptionId = optionId;
        selectedPrice = price;

        // Add some visual feedback
        event.currentTarget.style.animation = 'selectPulse 0.5s ease-in-out';
        setTimeout(() => {
            event.currentTarget.style.animation = '';
        }, 500);

        // Optional: You can add a callback here for further processing
        console.log(`Selected option: ${optionId}, Price: ${price}`);
    }

    // Add select animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes selectPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
    `;
    document.head.appendChild(style);
</script>