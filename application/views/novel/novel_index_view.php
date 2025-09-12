<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $app_base_url ?>/">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $app_base_url ?>/novel">Novel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $novel_title ?></li>
        </ol>
    </nav>

    <h1 class="mb-3"><?= $novel_title ?></h1>
    <p class="lead"><?= $novel_summary ?></p>

    <h2 class="mt-4">Daftar Arc</h2>
    <?php if (!empty($arcs)): ?>
        <div class="list-group">
            <?php foreach ($arcs as $arc): ?>
                <a href="<?= $app_base_url ?>/novel/<?= $novel_slug ?>/<?= $arc['slug'] ?>" class="list-group-item list-group-item-action">
                    <?= $arc['title'] ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Belum ada arc untuk novel ini.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>