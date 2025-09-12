<!-- App Capsule -->
<div id="appCapsule">

    <div class="section mt-2">
        <h1 class="mb-3">Daftar Novel</h1>
    </div>

    <?php if (!empty($novels)): ?>
        <?php foreach ($novels as $novel): ?>
            <div class="section mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $novel['title'] ?></h5>
                        <p class="card-text">
                            <?= $novel['summary'] ?? 'Ringkasan belum tersedia.' ?>
                        </p>
                        <a href="<?= $novel['url'] ?>" class="btn btn-primary btn-block">Baca Novel</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="section mt-2">
            <p>Belum ada novel yang tersedia.</p>
        </div>
    <?php endif; ?>

</div>
<!-- * App Capsule -->