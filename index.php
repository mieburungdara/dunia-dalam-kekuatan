<?php

// Muat autoloader Composer
require_once 'vendor/autoload.php';

// Inisialisasi framework
$f3 = \Base::instance();
$f3->set('BASE','');
$f3->set('SCHEME','https');
$f3->set('HOST','8080-cs-640544031456-default.cs-asia-southeast1-palm.cloudshell.dev');

// Set a global application base URL
$app_base_url = $f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE');

// Definisikan fungsi helper untuk kompatibilitas
if (!function_exists('base_url')) {
    function base_url($path = '') {
        global $f3;
        return rtrim($f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE'), '/') . '/' . ltrim($path, '/');
    }
}

// Konfigurasi
$f3->set('DEBUG', 3);

// Konfigurasi
$f3->set('UI', 'application/views/'); // Beri tahu F3 di mana folder view berada
$f3->set('AUTOLOAD', 'app/'); // Tambahkan folder app ke autoloader

// Rute untuk Novel
$f3->route('GET /novel', 'NovelController->list_novels');
$f3->route('GET /novel/@novel_slug', 'NovelController->show_novel_arcs');
$f3->route('GET /novel/@novel_slug/@arc_name', 'NovelController->show_arc_chapters');
$f3->route('GET /novel/@novel_slug/@arc_name/@chapter_name', 'NovelController->show_chapter_scenes');
$f3->route('GET /novel/@novel_slug/@arc_name/@chapter_name/@scene_name', 'NovelController->show_scene');

// Definisikan rute untuk halaman utama
$f3->route('GET /',
    function($f3) {
        // Logika ini diambil dari metode _show_homepage() di controller Home.php
        // FCPATH di CI3 adalah direktori index.php, jadi di sini adalah root
        $base_path = $f3->get('ROOT') . $f3->get('BASE');
        $novel_path = $base_path . '/cerita/dunia-dalam-kekuatan/';

        // Untuk saat ini, kita tidak akan memproses data novel dulu
        // Fokus untuk menampilkan view dengan benar
        $data['novel_data'] = ['title' => 'Dunia dalam Kekuatan', 'arcs' => []];

        // Teruskan data ke template
        $f3->set('data', $data);

        // Render view gabungan
        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('home_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }
);

// Jalankan framework
// Definisikan rute untuk halaman placeholder
$placeholder_pages = ['baca', 'karakter', 'novel', 'glosarium', 'faq'];
foreach ($placeholder_pages as $page) {
    $f3->route('GET /' . $page, function($f3, $params) use ($page) {
        $title = ucfirst($page);
        $content = 'Konten untuk halaman ' . $title . ' akan segera hadir.';

        $f3->set('title', $title);
        $f3->set('content', $content);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('placeholder_view.php');
        echo \Template::instance()->render('templates/footer.php');
    });
}

// Jalankan framework
$f3->run();
