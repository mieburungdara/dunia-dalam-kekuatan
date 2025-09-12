<!-- App Capsule -->
<div id="appCapsule">

    <div class="blog-post">
        <h1 class="title mb-2"><?= $scene_name ?></h1>

        <div class="post-header">
            <small class="text-muted">
                Novel: <?= $novel_title ?> <span class="mx-1">|</span> Arc: <?= $arc_title ?> <span class="mx-1">|</span> Chapter: <?= $chapter_title ?>
            </small>
            <p class="lead mt-1">
                <?= $chapter_summary ?>
            </p>
        </div>

        <div class="post-body mt-3">
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
            <div class="col text-center">
                <?php
                    // Assuming chapter_url is available in the view data
                    // If not, this will need to be passed from the controller
                    $chapter_url = $app_base_url . '/novel/' . $novel_slug . '/' . $arc_slug . '/' . $chapter_slug;
                ?>
                <a href="<?= $chapter_url ?>" class="btn btn-outline-primary btn-block">Kembali ke Bab</a>
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