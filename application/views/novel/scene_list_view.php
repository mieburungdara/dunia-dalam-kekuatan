<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h1 class="mt-4 mb-3">Chapter: <?php echo htmlspecialchars($chapter_slug); ?></h1>
    <h2 class="mb-3"><small class="text-muted">Arc: <?php echo htmlspecialchars($arc_slug); ?></small></h2>
    <h3 class="mb-4"><small class="text-muted">Novel: <?php echo htmlspecialchars($novel_slug); ?></small></h3>

    <div class="list-group">
        <?php foreach ($scenes as $scene): ?>
            <a href="<?php echo $scene['url']; ?>" class="list-group-item list-group-item-action">
                <?php echo htmlspecialchars($scene['name']); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
