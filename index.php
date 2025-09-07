<?php
// Sertakan file konfigurasi dan library Parsedown
require_once 'config.php';
require_once 'lib/Parsedown.php';

// Buat instance Parsedown
$Parsedown = new Parsedown();

// Sertakan header
require_once 'templates/header.php';

// Fungsi untuk memisahkan front matter dari konten Markdown
function parseFrontMatter($content) {
    $pattern = '/^---\s*\n(.*?)\n---\s*\n(.*)/s';
    if (preg_match($pattern, $content, $matches)) {
        // Saat ini kita hanya mengambil kontennya saja (grup 2)
        // Di masa depan, kita bisa mem-parse YAML di grup 1
        return $matches[2];
    }
    return $content; // Kembalikan konten asli jika tidak ada front matter
}


// Ambil path halaman dari parameter GET, jika ada
$page = isset($_GET['page']) ? $_GET['page'] : '';

if ($page) {
    // Keamanan: Pastikan path tidak mengandung '..' untuk mencegah directory traversal
    if (strpos($page, '..') !== false) {
        http_response_code(400);
        echo '<div class="alert alert-danger">Permintaan tidak valid.</div>';
    } else {
        // Bangun path file Markdown yang sebenarnya
        // Kita akan mencoba mencari di beberapa direktori koleksi Jekyll
        $possible_paths = [
            BASE_PATH . '/' . $page . '.md',
            BASE_PATH . '/_cerita/' . $page . '.md',
            BASE_PATH . '/_worldbuilding/' . $page . '.md',
            BASE_PATH . '/_skills/' . $page . '.md',
            BASE_PATH . '/_faq/' . $page . '.md',
            // Tambahkan path untuk file index di dalam folder
            BASE_PATH . '/' . $page . '/index.md',
            BASE_PATH . '/_cerita/' . $page . '/index.md',
        ];

        $file_found = false;
        foreach ($possible_paths as $path) {
            if (file_exists($path)) {
                // Baca konten file
                $markdown_content_with_frontmatter = file_get_contents($path);

                // Pisahkan front matter
                $markdown_content = parseFrontMatter($markdown_content_with_frontmatter);

                // Konversi Markdown ke HTML
                $html_content = $Parsedown->text($markdown_content);

                // Tampilkan konten
                echo $html_content;
                $file_found = true;
                break; // Hentikan loop jika file ditemukan
            }
        }

        if (!$file_found) {
            // Tampilkan pesan error jika file tidak ditemukan
            http_response_code(404);
            echo '<div class="alert alert-warning">Halaman ''. htmlspecialchars($page) .'' tidak ditemukan.</div>';
        }
    }
} else {
    // Jika tidak ada parameter 'page', tampilkan halaman sambutan
?>
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Dunia dalam Kekuatan</h1>
        <p class="col-md-8 fs-4">Situs ini sedang dalam proses migrasi dari Jekyll ke PHP native. Konten dari file Markdown sekarang dapat ditampilkan secara dinamis.</p>
        <p>Silakan coba salah satu tautan di bawah ini untuk melihat konten cerita:</p>
        <ul>
            <li><a href="?page=Arc_01_Awal_Perjalanan/01_terjatuh_ke_dunia_lain/index">Bab 1: Terjatuh ke Dunia Lain</a></li>
            <li><a href="?page=Arc_01_Awal_Perjalanan/02_menjelajah_belantara_asing/index">Bab 2: Menjelajah Belantara Asing</a></li>
        </ul>
      </div>
    </div>
<?php
}

// Sertakan footer
require_once 'templates/footer.php';
?>