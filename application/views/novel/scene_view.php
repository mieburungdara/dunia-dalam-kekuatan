<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h1 class="mt-4 mb-3"><?php echo htmlspecialchars($scene_slug); ?></h1>
    <h2 class="mb-3"><small class="text-muted">Chapter: <?php echo htmlspecialchars($chapter_slug); ?></small></h2>
    <h3 class="mb-4"><small class="text-muted">Arc: <?php echo htmlspecialchars($arc_slug); ?></small></h3>
    <h4 class="mb-4"><small class="text-muted">Novel: <?php echo htmlspecialchars($novel_slug); ?></small></h4>

    <div class="scene-content">
        <?php echo $scene_content; ?>
    </div>
</div>
