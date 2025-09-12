<?php

// Muat autoloader Composer
require_once 'vendor/autoload.php';

// Explicitly include NovelController for debugging
require_once 'app/controllers/NovelController.php';
require_once 'app/controllers/FaqController.php';

// Inisialisasi framework
$f3 = \Base::instance();
$f3->set('BASE','');
$f3->set('SCHEME', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http'));
$f3->set('HOST', $_SERVER['HTTP_HOST']);

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
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Konfigurasi
$f3->set('UI', 'application/views/'); // Beri tahu F3 di mana folder view berada
$f3->set('AUTOLOAD', 'app/'); // Tambahkan folder app ke autoloader

// Rute untuk Novel
$f3->route('GET /novel', 'NovelController->list_novels');
$f3->route('GET /novel/@novel_slug', 'NovelController->show_novel_index');
$f3->route('GET /novel/@novel_slug/arcs', 'NovelController->list_novel_arcs');
$f3->route('GET /novel/@novel_slug/@arc_name', 'NovelController->show_arc_chapters');
$f3->route('GET /novel/@novel_slug/@arc_name/@chapter_name', 'NovelController->show_chapter_scenes');

// Rute baru untuk membaca adegan dengan URL yang lebih bersih
$f3->route('GET /read/@novel_slug/@arc_name/@chapter_name/@scene_name', 'NovelController->show_scene');

// Definisikan rute untuk halaman utama
$f3->route('GET /',
    function($f3) {
        global $app_base_url; // Access the global variable

        // Logika ini diambil dari metode _show_homepage() di controller Home.php
        // FCPATH di CI3 adalah direktori index.php, jadi di sini adalah root
        $base_path = $f3->get('ROOT') . $f3->get('BASE');
        $novel_path = $base_path . '/cerita/lima-jiwa-di-bumi-lain/';

        // Untuk saat ini, kita tidak akan memproses data novel dulu
        // Fokus untuk menampilkan view dengan benar
        $data['novel_data'] = ['title' => 'Pecahan Dunia', 'arcs' => []];

        // Collect variables for the view
        $view_data = [
            'data' => $data, // Pass the data array
            'app_base_url' => $app_base_url, // Make app_base_url available
            'BASE' => $f3->get('BASE') // BASE is used in some views, so pass it
        ];
        extract($view_data); // Extract variables into the current scope

        // Render view gabungan
        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/home_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }
);

// Jalankan framework
// Definisikan rute untuk halaman placeholder
$f3->route('GET /faq', 'FaqController->list_faq_categories');
$f3->route('GET /faq/@category', 'FaqController->list_faqs_in_category');
$f3->route('GET /faq/@category/@faq_name', 'FaqController->show_faq');

// Rute untuk Worldbuilding
$f3->route('GET /worldbuilding', 'WorldbuildingController->index');
$f3->route('GET /worldbuilding/@file', 'WorldbuildingController->show');

// Rute untuk Visualisasi Relasi Karakter
$f3->route('GET /character-relationships', 'NovelController->show_character_relationships');

$placeholder_pages = ['baca', 'karakter', 'glosarium'];
foreach ($placeholder_pages as $page) {
    $f3->route('GET /' . $page, function($f3, $params) use ($page) {
        global $app_base_url; // Access the global variable

        $title = ucfirst($page);
        $content = 'Konten untuk halaman ' . $title . ' akan segera hadir.';

        // Collect variables for the view
        $view_data = [
            'title' => $title,
            'content' => $content,
            'app_base_url' => $app_base_url, // Make app_base_url available
            'BASE' => $f3->get('BASE') // BASE is used in some views, so pass it
        ];
        extract($view_data); // Extract variables into the current scope

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/placeholder_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    });
}

// Jalankan framework
$f3->run();