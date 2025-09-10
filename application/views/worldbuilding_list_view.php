<div class="container mt-4">
    <h1>Dokumen Worldbuilding</h1>
    <p>Berikut adalah kumpulan dokumen yang menjelaskan berbagai aspek dunia Pecahan Dunia.</p>
    <div class="list-group">
        <?php foreach ($worldbuilding_files as $file): ?>
            <a href="<?= $BASE ?>/worldbuilding/<?= $file['slug'] ?>" class="list-group-item list-group-item-action">
                <?= $file['title'] ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>