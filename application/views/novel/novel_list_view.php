<div class="container">
    <h1 class="mt-4 mb-3">Daftar Novel</h1>

    <div class="list-group">
        <?php var_dump($novels); ?>
        <?php foreach ($novels as $novel): ?>
            <a href="<?php echo $novel['url']; ?>" class="list-group-item list-group-item-action">
                <?php echo $novel['title']; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>