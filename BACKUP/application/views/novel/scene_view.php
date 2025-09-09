<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h1 class="mt-4 mb-3"><?php echo htmlspecialchars($scene_name); ?></h1>
    <h2 class="mb-3"><small class="text-muted">Chapter: <?php echo htmlspecialchars($chapter_title); ?></small></h2>
    <h3 class="mb-4"><small class="text-muted">Arc: <?php echo htmlspecialchars($arc_title); ?></small></h3>
    <h4 class="mb-4"><small class="text-muted">Novel: <?php echo htmlspecialchars($novel_title); ?></small></h4>

    <div class="scene-content">
        <?php echo $scene_content; ?>
    </div>
</div>