<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h1 class="mt-4 mb-3">Daftar Novel</h1>

    <?php var_dump($novels); // Debugging: Check content of $novels ?>

    <div class="list-group">
        <?php if (empty($novels)): ?>
            <p>No novels found.</p>
        <?php else: ?>
            <?php foreach ($novels as $novel): ?>
                <a href="<?php echo $novel['url']; ?>" class="list-group-item list-group-item-action">
                    <?php echo htmlspecialchars($novel['title']); ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>