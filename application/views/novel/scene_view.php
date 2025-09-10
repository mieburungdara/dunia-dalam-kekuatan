<div class="container py-4">
    <h1 class="mb-3">Scene: <?= $scene_name ?></h1>
    <p class="text-muted">Novel: <?= $novel_title ?> | Arc: <?= $arc_title ?> | Chapter: <?= $chapter_title ?></p>
    <p class="fst-italic mb-4"><?= $chapter_summary ?></p>

    <div class="story-content">
        <?= $rendered_content ?>
    </div>

    <hr class="my-4">

    <div class="row">
        <div class="col text-start">
            <?php if ($prev_link): ?>
                <a href="<?= $prev_link['url'] ?>" class="btn btn-secondary">&laquo; <?= $prev_link['title'] ?></a>
            <?php endif; ?>
        </div>
        <div class="col text-end">
            <?php if ($next_link): ?>
                <a href="<?= $next_link['url'] ?>" class="btn btn-primary"><?= $next_link['title'] ?> &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</div>