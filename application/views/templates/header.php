<!doctype html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Dunia dalam Kekuatan</title>
    <meta name="description" content="Dunia dalam Kekuatan - Novel Fantasi">
    <meta name="keywords" content="novel, fantasi, dunia, kekuatan, ardan, zodiak" />
    <link rel="icon" type="image/png" href="<?= $app_base_url ?>/assets/mobilekit/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $app_base_url ?>/assets/mobilekit/assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?= $app_base_url ?>/assets/mobilekit/assets/css/style.css">
    <link rel="manifest" href="<?= $app_base_url ?>/assets/mobilekit/__manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php if (isset($_GET['dev']) && $_GET['dev'] === '1'): ?>
    <style>
    </style>
    <?php else: ?>
    <style>
        .navbar { margin-bottom: 2rem; }
        .hide { display: none; }
    </style>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleButton = document.getElementById('theme-toggle');
            const darkmodesidebarCheckbox = document.getElementById('darkmodesidebar');

            if (themeToggleButton && darkmodesidebarCheckbox) {
                themeToggleButton.addEventListener('click', function() {
                    darkmodesidebarCheckbox.checked = !darkmodesidebarCheckbox.checked;
                    darkmodesidebarCheckbox.dispatchEvent(new Event('change'));
                });
            }
        });
    </script>

</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader bg-primary scrolled">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Dunia dalam Kekuatan
        </div>
        <div class="right">

            <button id="theme-toggle" class="headerButton btn dark-mode-switch" type="button" aria-label="Toggle theme">
                <ion-icon name="moon-outline"></ion-icon>
            </button>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Search Component -->
    <div id="search" class="appHeader">
        <form class="search-form">
            <div class="form-group searchbox">
                <input type="text" class="form-control" placeholder="Search...">
                <i class="input-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </i>
                <a href="javascript:;" class="ml-1 close toggle-searchbox">
                    <ion-icon name="close-circle"></ion-icon>
                </a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->

    <!-- App Capsule -->
    <div id="appCapsule">

    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">

                    <!-- profile box -->
                    <div class="profileBox">
                        <div class="in">
                            <strong>Dunia dalam Kekuatan</strong>
                            <div class="text-muted">
                                <ion-icon name="book-outline"></ion-icon>
                                Novel Fantasi
                            </div>
                        </div>
                        <a href="javascript:;" class="close-sidebar-button" data-dismiss="modal">
                            <ion-icon name="close"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->

                    <ul class="listview flush transparent no-line image-listview mt-2">
                        <li>
                            <a href="<?= $app_base_url ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Home
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $app_base_url ?>/novel" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="book-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Novel
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $app_base_url ?>/karakter" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="people-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Karakter
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $app_base_url ?>/glosarium" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="library-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Glosarium
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= $app_base_url ?>/faq" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="help-circle-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    FAQ
                                </div>
                            </a>
                        </li>
                        <li style="display:none;">
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="moon-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Dark Mode</div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input dark-mode-switch"
                                            id="darkmodesidebar">
                                        <label class="custom-control-label" for="darkmodesidebar"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->