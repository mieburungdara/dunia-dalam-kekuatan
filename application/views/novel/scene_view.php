<!-- App Capsule -->
<div id="appCapsule">

    <div class="blog-post">
        <h1 class="title"><?= $scene_name ?></h1>

        <div class="post-header">
            <div>
                Novel: <?= $novel_title ?> | Arc: <?= $arc_title ?> | Chapter: <?= $chapter_title ?>
            </div>
            <div class="text-muted mt-1">
                <?= $chapter_summary ?>
            </div>
        </div>

        <div class="post-body">
            <?= $rendered_content ?>
        </div>
    </div>

    <div class="divider mt-4 mb-3"></div>

    <div class="section">
        <div class="row">
            <div class="col text-start">
                <?php if ($prev_link): ?>
                    <a href="<?= $prev_link['url'] ?>" class="btn btn-secondary btn-block">&laquo; <?= $prev_link['title'] ?></a>
                <?php endif; ?>
            </div>
            <div class="col text-end">
                <?php if ($next_link): ?>
                    <a href="<?= $next_link['url'] ?>" class="btn btn-primary btn-block"><?= $next_link['title'] ?> &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<!-- * App Capsule -->