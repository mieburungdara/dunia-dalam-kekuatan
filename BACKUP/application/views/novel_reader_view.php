<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// Ambil data utama, dengan asumsi controller mengirim variabel $data
$chapter = $data['data']['Chapters'][0];
$scene = $chapter['Scenes'][0];
?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        <div class="text-center mb-4">
            <h2 class="mb-1"><?php echo htmlspecialchars($chapter['Title']); ?></h2>
            <p class="text-muted small">
                <span title="Lokasi">&#x1F4CD; <?php echo htmlspecialchars($scene['Location']['Name']); ?></span> &nbsp;&nbsp;
                <span title="Waktu">&#x23F0; <?php echo htmlspecialchars($scene['Time']); ?></span> &nbsp;&nbsp;
                <span title="Sudut Pandang">&#x1F441; POV: <?php echo htmlspecialchars($scene['POV']['CharacterName']); ?></span>
            </p>
        </div>

        <hr class="mb-4">

        <div class="story-content" style="font-size: 1.1rem; line-height: 1.7;">
            <?php foreach ($scene['Contents'] as $content): ?>
                <?php
                    $class = 'mb-3'; // margin-bottom-3
                    if ($content['Type'] === 'InnerThought') {
                        $class .= ' fst-italic text-body-secondary'; // italic, slightly muted color
                    }
                ?>
                <p class="<?php echo $class; ?>">
                    <?php echo nl2br(htmlspecialchars($content['Text'])); ?>
                </p>
            <?php endforeach; ?>
        </div>

        <hr class="mt-5">

        <nav aria-label="Navigasi Scene">
            <ul class="pagination justify-content-between">
                <li class="page-item disabled">
                    <a class="page-link"><span>&laquo;</span> Scene Sebelumnya</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Scene Berikutnya <span>&raquo;</span></a>
                </li>
            </ul>
        </nav>

    </div>
</div>
