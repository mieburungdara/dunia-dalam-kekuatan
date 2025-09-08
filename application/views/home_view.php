<div class="container">
    <div class="px-4 py-5 mb-4 text-center">
        <h1 class="display-5 fw-bold"><?php echo htmlspecialchars($novel_data['title']); ?></h1>
        <div class="col-lg-8 mx-auto">
            <p class="lead mb-4">Selamat datang di daftar isi cerita. Silakan pilih Arc dan Chapter untuk mulai membaca.</p>
        </div>
    </div>

    <?php if (empty($novel_data['arcs'])) : ?>
        <div class="alert alert-warning" role="alert">
            Tidak ada Arc atau Chapter yang ditemukan. Pastikan struktur folder di dalam `novel/dunia-dalam-kekuatan/` sudah benar (contoh: `Arc_01_Nama_Arc/01_Nama_Chapter/1_Nama_Scene.json`).
        </div>
    <?php else : ?>
        <div class="accordion" id="novelAccordion">
            <?php foreach ($novel_data['arcs'] as $arc_index => $arc) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingArc<?php echo $arc_index; ?>">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseArc<?php echo $arc_index; ?>" aria-expanded="false" aria-controls="collapseArc<?php echo $arc_index; ?>">
                            Arc: &nbsp; <?php echo htmlspecialchars($arc['name']); ?>
                        </button>
                    </h2>
                    <div id="collapseArc<?php echo $arc_index; ?>" class="accordion-collapse collapse" aria-labelledby="headingArc<?php echo $arc_index; ?>">
                        <div class="accordion-body">
                            <?php if (empty($arc['chapters'])) : ?>
                                <p>Tidak ada chapter di dalam arc ini.</p>
                            <?php else : ?>
                                <?php foreach ($arc['chapters'] as $chapter) : ?>
                                    <h5 class="mt-3"><?php echo htmlspecialchars($chapter['name']); ?></h5>
                                    <ul class="list-group list-group-flush mb-3">
                                        <?php if (empty($chapter['scenes'])) : ?>
                                            <li class="list-group-item">Tidak ada scene di dalam chapter ini.</li>
                                        <?php else : ?>
                                            <?php foreach ($chapter['scenes'] as $scene) : ?>
                                                <li class="list-group-item">
                                                    <a href="<?php echo $scene['url']; ?>">
                                                        <?php echo htmlspecialchars($scene['name']); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
