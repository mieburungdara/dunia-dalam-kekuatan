<!-- App Capsule -->
<div id="appCapsule">

    <!-- Reading Progress Bar -->
    <div id="readingProgressBar" style="width: 0%;"></div>
    <!-- * Reading Progress Bar -->

    <div class="blog-post">
        <h1 class="title mb-2"><?= $scene_name ?></h1>

        <div class="story-meta">
            <div class="story-meta-item">
                <ion-icon name="book-outline"></ion-icon>
                <span>Novel: <?= $novel_title ?></span>
            </div>
            <div class="story-meta-item">
                <ion-icon name="layers-outline"></ion-icon>
                <span>Arc: <?= $arc_title ?></span>
            </div>
            <div class="story-meta-item">
                <ion-icon name="document-text-outline"></ion-icon>
                <span>Chapter: <?= $chapter_title ?></span>
            </div>
        </div>

        <?php if (!empty($chapter_summary)): ?>
        <div class="mb-4">
            <p class="lead mb-0 lh-base fst-italic">
                <?= $chapter_summary ?>
            </p>
        </div>
        <?php endif; ?>

        <div class="post-body mt-3">
            <?= $rendered_content ?>
        </div>
    </div>

    <div class="divider mt-4 mb-3"></div>

    <div class="section navigation-buttons">
        <div class="row">
            <div class="col text-start">
                <?php if ($prev_link): ?>
                    <a href="<?= $prev_link['url'] ?>" class="btn btn-secondary">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                        <?= $prev_link['title'] ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col text-center">
                <?php
                    $chapter_url = $app_base_url . '/novel/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name;
                ?>
                <a href="<?= $chapter_url ?>" class="btn btn-outline-primary">Kembali ke Bab</a>
            </div>
            <div class="col text-end">
                <?php if ($next_link): ?>
                    <a href="<?= $next_link['url'] ?>" class="btn btn-primary">
                        <?= $next_link['title'] ?>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
<!-- * App Capsule -->

<!-- Floating Action Button for Settings -->
<div class="fab-button animate bottom-right">
    <a href="#" class="fab" data-bs-toggle="modal" data-bs-target="#settingsModal">
        <ion-icon name="options-outline"></ion-icon>
    </a>
</div>
<!-- * Floating Action Button for Settings -->


<!-- Settings Modal (Action Sheet Style) -->
<div class="modal fade action-sheet" id="settingsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengaturan Tampilan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="listview simple-listview">
                    <li class="py-2">
                        <span>Ukuran Font</span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary" id="decreaseFontSize">A-</button>
                            <button type="button" class="btn btn-outline-secondary" id="increaseFontSize">A+</button>
                        </div>
                    </li>
                    <li class="py-2">
                        <span>Jenis Font</span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary font-btn" data-font="sans">Sans</button>
                            <button type="button" class="btn btn-outline-secondary font-btn" data-font="serif">Serif</button>
                        </div>
                    </li>
                    <li class="py-2">
                        <span>Mode Gelap</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="sceneViewDarkModeSwitch">
                            <label class="form-check-label" for="sceneViewDarkModeSwitch"></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- * Settings Modal -->

<!-- ========= JS & CSS ========= -->


<script>
document.addEventListener('DOMContentLoaded', function () {
    const postBody = document.querySelector('.post-body');
    if (!postBody) return;

    const increaseBtn = document.getElementById('increaseFontSize');
    const decreaseBtn = document.getElementById('decreaseFontSize');
    const darkModeSwitch = document.getElementById('sceneViewDarkModeSwitch');
    const fontButtons = document.querySelectorAll('.font-btn');
    const body = document.body;

    // --- Reading Progress Bar ---
    const progressBar = document.getElementById('readingProgressBar');
    const mainContent = document.querySelector('.blog-post');
    function updateProgressBar() {
        if (!mainContent) return;
        const contentBottom = mainContent.offsetTop + mainContent.scrollHeight;
        const viewportHeight = window.innerHeight;
        const scrollableHeight = contentBottom - viewportHeight;
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        let progress = 0;
        if (scrollableHeight > 0) {
            progress = (scrollTop / scrollableHeight) * 100;
        }
        if (progressBar) {
            progressBar.style.width = Math.min(100, progress) + '%';
        }
    }
    window.addEventListener('scroll', updateProgressBar, { passive: true });
    window.addEventListener('resize', updateProgressBar);
    setTimeout(updateProgressBar, 250);

    // --- Font Size Controls ---
    let currentFontSize = parseFloat(localStorage.getItem('novelFontSize')) || 16;
    const updateFontSize = () => {
        postBody.style.fontSize = currentFontSize + 'px';
        localStorage.setItem('novelFontSize', currentFontSize);
        updateProgressBar();
    };

    if (increaseBtn) {
        increaseBtn.addEventListener('click', () => {
            if (currentFontSize < 24) {
                currentFontSize += 1;
                updateFontSize();
            }
        });
    }
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', () => {
            if (currentFontSize > 12) {
                currentFontSize -= 1;
                updateFontSize();
            }
        });
    }

    // --- Font Family Controls ---
    let currentFontFamily = localStorage.getItem('novelFontFamily') || 'sans';
    const updateFontFamily = () => {
        postBody.style.fontFamily = currentFontFamily === 'serif'
            ? 'Georgia, "Times New Roman", Times, serif'
            : '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        localStorage.setItem('novelFontFamily', currentFontFamily);
        fontButtons.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.font === currentFontFamily);
        });
    };

    fontButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentFontFamily = button.dataset.font;
            updateFontFamily();
        });
    });

    // --- Dark Mode Control ---
    const sceneDarkModeSwitch = document.getElementById('sceneViewDarkModeSwitch');
    const globalDarkModeSwitch = document.getElementById('darkModeSwitch');
    const enableDarkMode = () => {
        body.classList.add('dark-mode');
        localStorage.setItem('novelDarkMode', 'enabled');
        if(sceneDarkModeSwitch) sceneDarkModeSwitch.checked = true;
        if(globalDarkModeSwitch) globalDarkModeSwitch.checked = true;
    };
    const disableDarkMode = () => {
        body.classList.remove('dark-mode');
        localStorage.setItem('novelDarkMode', 'disabled');
        if(sceneDarkModeSwitch) sceneDarkModeSwitch.checked = false;
        if(globalDarkModeSwitch) globalDarkModeSwitch.checked = false;
    };

    if (sceneDarkModeSwitch) {
        sceneDarkModeSwitch.addEventListener('change', () => {
            if (sceneDarkModeSwitch.checked) {
                enableDarkMode();
            } else {
                disableDarkMode();
            }
        });
    }

    // --- Swipe Navigation ---
    const swipeContainer = document.getElementById('appCapsule');
    let touchstartX = 0, touchstartY = 0, touchendX = 0, touchendY = 0;
    const prevUrl = '<?= $prev_link['url'] ?? '' ?>';
    const nextUrl = '<?= $next_link['url'] ?? '' ?>';

    function handleSwipe() {
        const thresholdX = 75, thresholdY = 50;
        const deltaX = touchendX - touchstartX;
        const deltaY = touchendY - touchstartY;

        if (Math.abs(deltaX) > thresholdX && Math.abs(deltaY) < thresholdY) {
            if (deltaX < 0 && nextUrl) window.location.href = nextUrl;
            else if (deltaX > 0 && prevUrl) window.location.href = prevUrl;
        }
    }

    swipeContainer.addEventListener('touchstart', e => {
        touchstartX = e.changedTouches[0].screenX;
        touchstartY = e.changedTouches[0].screenY;
    }, { passive: true });

    swipeContainer.addEventListener('touchend', e => {
        touchendX = e.changedTouches[0].screenX;
        touchendY = e.changedTouches[0].screenY;
        handleSwipe();
    }, { passive: true });


    // --- Load Saved Preferences ---
    if (localStorage.getItem('novelDarkMode') === 'enabled' ||
        (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && localStorage.getItem('novelDarkMode') !== 'disabled')) {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
    updateFontSize();
    updateFontFamily();
});
</script>