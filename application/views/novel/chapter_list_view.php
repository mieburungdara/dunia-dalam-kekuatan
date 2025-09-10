<div class="container">
    <h1 class="mt-4 mb-3">Arc: <?= $arc_title ?></h1>

    <div class="list-group">
        <?php foreach ($chapters as $chapter): ?>
            <a href="<?= $chapter['url'] ?>" class="list-group-item list-group-item-action">
                <?= $chapter['title'] ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
