<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h1 class="mt-4 mb-3">Arc: <?php echo htmlspecialchars($arc_title); ?></h1>
    <h2 class="mb-3"><small class="text-muted">Novel: <?php echo htmlspecialchars($novel_slug); ?></small></h2>

    <div class="list-group">
        <?php foreach ($chapters as $chapter): ?>
            <a href="<?php echo $chapter['url']; ?>" class="list-group-item list-group-item-action">
                <?php echo htmlspecialchars($chapter['name']); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>