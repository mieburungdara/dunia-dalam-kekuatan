<!-- App Capsule -->
<div id="appCapsule">

    <!-- Reading Progress Bar -->
    <div id="readingProgressBar" style="height: 4px; background-color: #007bff; width: 0%; position: fixed; top: 0; left: 0; z-index: 1000;"></div>
    <!-- * Reading Progress Bar -->

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
                    $chapter_url = $app_base_url . '/novel/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name;
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

    <div class="section mt-2">
        <div class="row">
            <div class="col-6">
                <div class="btn-group" role="group" aria-label="Font size controls">
                    <button type="button" class="btn btn-outline-secondary" id="decreaseFontSize">A-</button>
                    <button type="button" class="btn btn-outline-secondary" id="increaseFontSize">A+</button>
                </div>
            </div>
            <div class="col-6 text-end">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input dark-mode-switch" id="sceneViewDarkModeSwitch">
                    <label class="custom-control-label" for="sceneViewDarkModeSwitch">Dark Mode</label>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- * App Capsule -->