<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dunia dalam Kekuatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php if (isset($_GET['dev']) && $_GET['dev'] === '1'): ?>
    <style>
        .navbar { margin-bottom: 2rem; }
        .hide { display: none; }
    </style>

    <!-- Dark Mode Logic -->
    <script>
        const getStoredTheme = () => localStorage.getItem('theme');
        const setStoredTheme = theme => localStorage.setItem('theme', theme);

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme();
            if (storedTheme) {
                return storedTheme;
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const setTheme = theme => {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme);
            }
        };

        const showActiveTheme = (theme) => {
            const themeToggleButton = document.querySelector('#theme-toggle');
            if (!themeToggleButton) {
                return;
            }
            const themeIcon = document.querySelector('#theme-icon');
            if (!themeIcon) {
                return;
            }
            const activeTheme = theme || getPreferredTheme();

            if (activeTheme === 'dark') {
                themeIcon.classList.remove('bi-brightness-high-fill');
                themeIcon.classList.add('bi-moon-stars-fill');
            } else {
                themeIcon.classList.remove('bi-moon-stars-fill');
                themeIcon.classList.add('bi-brightness-high-fill');
            }
        };

        // Set theme immediately to prevent flash
        setTheme(getPreferredTheme());

        window.addEventListener('DOMContentLoaded', () => {
            // Set the icon on initial load
            showActiveTheme(getPreferredTheme());

            const themeToggleButton = document.querySelector('#theme-toggle');
            if (themeToggleButton) {
                themeToggleButton.addEventListener('click', () => {
                    const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    setStoredTheme(newTheme);
                    setTheme(newTheme);
                    showActiveTheme(newTheme);
                });
            }
        });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme();
            if (!storedTheme) { // Only change if no theme is explicitly set
                const newTheme = getPreferredTheme();
                setTheme(newTheme);
                showActiveTheme(newTheme);
            }
        });
    </script>
    <!-- End Dark Mode Logic -->
    <?php endif; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $app_base_url; ?>">Dunia dalam Kekuatan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/novel">Novel</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/karakter">Karakter</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/glosarium">Glosarium</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/faq">FAQ</a></li>
                <li class="nav-item">
                    <button id="theme-toggle" class="btn btn-outline-secondary ms-2" type="button" aria-label="Toggle theme">
                        <i class="bi" id="theme-icon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">