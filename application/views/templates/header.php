<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dunia dalam Kekuatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php if (isset($_GET['dev']) && $_GET['dev'] === '1'): ?>
    <style>
        body { 
            /* Dihapus agar Bootstrap bisa mengontrol warna latar belakang */
        }
        .navbar { margin-bottom: 2rem; }
        .hide { display: none; }
    </style>

    <!-- Dark Mode Logic -->
    <script>
        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme')
            const setStoredTheme = theme => localStorage.setItem('theme', theme)

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme()
                if (storedTheme) {
                    return storedTheme
                }
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = theme => {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }

            setTheme(getPreferredTheme())

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector('#theme-toggle')
                const themeIcon = document.querySelector('#theme-icon')

                if (!themeSwitcher) {
                    return
                }

                if (theme === 'dark') {
                    themeIcon.textContent = '☀️' // Sun icon
                } else {
                    themeIcon.textContent = '🌙' // Moon icon
                }

                if (focus) {
                    themeSwitcher.focus()
                }
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme()
                if (!storedTheme) {
                    setTheme(getPreferredTheme())
                }
            })

            window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            setStoredTheme(theme)
                            setTheme(theme)
                            showActiveTheme(theme, true)
                        })
                    })
                
                const themeToggleButton = document.querySelector('#theme-toggle');
                if(themeToggleButton) {
                    themeToggleButton.addEventListener('click', () => {
                        const currentTheme = getStoredTheme() || getPreferredTheme();
                        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                        setStoredTheme(newTheme);
                        setTheme(newTheme);
                        showActiveTheme(newTheme, true);
                    });
                }
            })
        })()
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
                        <span id="theme-icon"></span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">