<div class="container">
    <h1 class="mt-4 mb-3">Novel: <?php echo htmlspecialchars($this->get('novel_title')); ?></h1>

    <div class="list-group">
        <?php foreach ($this->get('arcs') as $arc): ?>
            <a href="<?php echo $arc['url']; ?>" class="list-group-item list-group-item-action">
                <?php echo htmlspecialchars($arc['name']); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
