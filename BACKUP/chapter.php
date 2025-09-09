<?php
// Helper function to create a URL-friendly slug
function create_slug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text;
}

// Sertakan file konfigurasi

$chapterPath = isset($_GET['chapter_path']) ? $_GET['chapter_path'] : '';

// Handle error condition before any output
if (!$chapterPath) {
    http_response_code(400);
}

// Sertakan header halaman
require_once 'templates/header.php';

// Sertakan template rendering cerita (untuk menampilkan konten jalan cerita)
require_once 'templates/story_template.php';

// Fungsi untuk mendapatkan daftar jalan cerita (scenes/parts) dari sebuah chapter
function getStoryPartsForChapter($basePath, $chapterRelativePath) {
    $storyParts = [];
    $chapterDirRelative = dirname($chapterRelativePath);
    $chapterDirAbsolute = $basePath . '/' . $chapterDirRelative;

    // Extract arc and chapter slugs from chapterRelativePath
    // Example: cerita/Arc_01_Awal_Perjalanan/01_terjatuh_ke_dunia_lain/index.json
    $pathParts = explode('/', $chapterRelativePath);
    // Assuming pathParts[1] is Arc_XX_ArcName and pathParts[2] is YY_ChapterName
    $arcFolderName = $pathParts[1];
    $chapterFolderName = $pathParts[2];

    // Derive arcSlug
    $arcTitle = '';
    $arcIndexJsonPath = $basePath . '/cerita/' . $arcFolderName . '/index.json';
    if (file_exists($arcIndexJsonPath)) {
        $arcIndexContent = file_get_contents($arcIndexJsonPath);
        $arcIndexData = json_decode($arcIndexContent, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($arcIndexData['Meta']['Title'])) {
            $arcTitle = $arcIndexData['Meta']['Title'];
        }
    }
    $arcSlug = create_slug($arcTitle);

    // Derive chapterSlug
    $chapterDisplayTitle = '';
    $chapterIndexJsonPath = $basePath . '/' . $chapterRelativePath;
    if (file_exists($chapterIndexJsonPath)) {
        $chapterIndexContent = file_get_contents($chapterIndexJsonPath);
        $chapterIndexData = json_decode($chapterIndexContent, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($chapterIndexData['Meta']['Title'])) {
            $chapterDisplayTitle = $chapterIndexData['Meta']['Title'];
        }
    }
    $chapterSlug = create_slug($chapterDisplayTitle);


    if (!is_dir($chapterDirAbsolute)) {
        return $storyParts;
    }

    $jsonFiles = glob($chapterDirAbsolute . '/*.json');

    foreach ($jsonFiles as $filePath) {
        $fileName = basename($filePath);
        if ($fileName === 'index.json') {
            continue;
        }

        $fileContent = file_get_contents($filePath);
        $fileData = json_decode($fileContent, true);

        $displayTitle = $fileName; // Default to filename if title not found

        if (json_last_error() === JSON_ERROR_NONE && isset($fileData['Meta']['Title'])) {
            $displayTitle = $fileData['Meta']['Title'];
        }

        $sceneSlug = create_slug($displayTitle);
        $prettyUrl = $arcSlug . '/' . $chapterSlug . '/' . $sceneSlug;

        $storyParts[] = [
            'title' => $displayTitle,
            'page_param' => $prettyUrl // Now this is the pretty URL
        ];
    }

    usort($storyParts, function($a, $b) {
        return strcmp($a['page_param'], $b['page_param']);
    });

    return $storyParts;
}

if ($chapterPath) {
    $storyParts = getStoryPartsForChapter(BASE_PATH, $chapterPath);

    // Get chapter title from its index.json
    $chapterTitle = "Daftar Jalan Cerita"; // Default title
    $chapterIndexJsonAbsolute = BASE_PATH . '/' . $chapterPath;
    if (file_exists($chapterIndexJsonAbsolute)) {
        $chapterIndexContent = file_get_contents($chapterIndexJsonAbsolute);
        $chapterIndexData = json_decode($chapterIndexContent, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($chapterIndexData['Meta']['Title'])) {
            $chapterTitle = $chapterIndexData['Meta']['Title'];
        }
    }
?>
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><?php echo htmlspecialchars($chapterTitle); ?></h1>
        <p class="col-md-8 fs-4">Pilih bagian cerita dari daftar di bawah ini:</p>
        <div class="row">
            <?php if (empty($storyParts)): ?>
                <div class="col-12">
                    <p>Tidak ada jalan cerita ditemukan untuk bab ini.</p>
                </div>
            <?php else: ?>
                <div class="col-md-8">
                    <ul class="list-group">
                        <?php foreach ($storyParts as $part): ?>
                            <li class="list-group-item">
                                <a href="index.php/<?php echo htmlspecialchars($part['page_param']); ?>">
                                    <?php echo htmlspecialchars($part['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
      </div>
    </div>
<?php
} else {
    echo '<div class="alert alert-danger">Parameter chapter_path tidak ditemukan.</div>';
}

// Sertakan footer
require_once 'templates/footer.php';
?>