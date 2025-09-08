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

// Sertakan header halaman
require_once(__DIR__ . '/../application/views/templates/header.php'); // Adjusted path

// Sertakan template rendering cerita
require_once(__DIR__ . '/../templates/story_template.php'); // Adjusted path

// Fungsi untuk mendapatkan daftar cerita dari file JSON
function getStoryList($basePath) {
    $storyList = [];
    $storyDir = $basePath . '/cerita/';

    $directories = glob($storyDir . 'Arc_*_*', GLOB_ONLYDIR);

    foreach ($directories as $dir) {
        $folderName = basename($dir);
        $titleParts = explode('_', $folderName);
        $arcTitle = implode(' ', array_slice($titleParts, 2));

        $indexJsonPath = $dir . '/index.json';
        $pageParam = str_replace($basePath . '/', '', $dir) . '/index.json';

        $displayTitle = $arcTitle;

        if (file_exists($indexJsonPath)) {
            $json_content = file_get_contents($indexJsonPath);
            $storyData = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($storyData['Meta']['Title'])) {
                $displayTitle = $storyData['Meta']['Title'];
            }
        }

        $chapters = [];
        $chapterDirs = glob($dir . '/*', GLOB_ONLYDIR);

        foreach ($chapterDirs as $chapterDir) {
            $chapterFolderName = basename($chapterDir);
            $chapterTitleParts = explode('_', $chapterFolderName, 2);
            $chapterNumber = $chapterTitleParts[0];
            $chapterRawTitle = isset($chapterTitleParts[1]) ? $chapterTitleParts[1] : $chapterFolderName;
            $chapterDisplayTitle = str_replace('_', ' ', $chapterRawTitle);

            $chapterIndexJsonPath = $chapterDir . '/index.json';
            $chapterPageParam = str_replace($basePath . '/', '', $chapterDir) . '/index.json';

            if (file_exists($chapterIndexJsonPath)) {
                $chapterJsonContent = file_get_contents($chapterIndexJsonPath);
                $chapterData = json_decode($chapterJsonContent, true);

                if (json_last_error() === JSON_ERROR_NONE && isset($chapterData['Meta']['Title'])) {
                    $chapterDisplayTitle = $chapterData['Meta']['Title'];
                }
            }

            $chapters[] = [
                'number' => $chapterNumber,
                'title' => $chapterDisplayTitle,
                'page_param' => $chapterPageParam
            ];
        }

        usort($chapters, function($a, $b) {
            return $a['number'] <=> $b['number'];
        });

        $storyList[] = [
            'title' => $displayTitle,
            'page_param' => $pageParam,
            'chapters' => $chapters
        ];
    }

    return $storyList;
}

$storyList = getStoryList(BASE_PATH);
?>
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Daftar Cerita</h1>
        <p class="col-md-8 fs-4">Pilih cerita dari daftar di bawah ini:</p>
        <div class="row">
            <?php if (empty($storyList)): ?>
                <div class="col-12">
                    <p>Tidak ada cerita yang ditemukan. Pastikan folder arc (misal: `Arc_01_Nama_Arc`) ada di folder `cerita/`.</p>
                </div>
            <?php else: ?>
                <?php foreach ($storyList as $story): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($story['title']); ?></h5>
                                <?php if (!empty($story['chapters'])): ?>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($story['chapters'] as $chapter): ?>
                                            <li class="list-group-item">
                                                <a href="../chapter.php?chapter_path=<?php echo htmlspecialchars($chapter['page_param']); ?>">
                                                    <?php echo htmlspecialchars($chapter['number'] . '. ' . $chapter['title']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
      </div>
    </div>
<?php
// Sertakan footer
require_once(__DIR__ . '/../templates/footer.php'); // Adjusted path
?>