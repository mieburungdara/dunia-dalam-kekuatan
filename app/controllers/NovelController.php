<?php

class NovelController {

    function list_novels($f3) {
        $novels_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/novels.json';
        $novels = [];

        if (file_exists($novels_json_path)) {
            $json_content = file_get_contents($novels_json_path);
            $decoded_novels = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_novels)) {
                $novels = $decoded_novels;
            } else {
                error_log("NovelController: JSON decode error for " . $novels_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: novels.json DOES NOT exist at " . $novels_json_path);
        }

        $f3->set('novels', $novels);
        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/novel_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function show_novel_arcs($f3, $params) {
        $novel_slug = $params['novel_slug'];
        $arcs_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/arcs.json';
        $arc_list = [];

        if (file_exists($arcs_json_path)) {
            $json_content = file_get_contents($arcs_json_path);
            $decoded_arcs = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_arcs)) {
                $arc_list = $decoded_arcs;
            } else {
                error_log("NovelController: JSON decode error for " . $arcs_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: arcs.json DOES NOT exist at " . $arcs_json_path);
        }

        $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
        $novel_data = [];
        if (file_exists($novel_index_path)) {
            $novel_data = json_decode(file_get_contents($novel_index_path), true);
        }

        $f3->set('novel_title', $novel_data['title'] ?? 'Novel Tidak Ditemukan');
        $f3->set('novel_slug', $novel_slug);
        $f3->set('arcs', $arc_list);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/arc_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function show_arc_chapters($f3, $params) {
        $novel_slug = $params['novel_slug'];
        $arc_name = $params['arc_name'];
        $chapters_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/chapters.json';
        $chapter_list = [];

        if (file_exists($chapters_json_path)) {
            $json_content = file_get_contents($chapters_json_path);
            $decoded_chapters = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_chapters)) {
                $chapter_list = $decoded_chapters;
            } else {
                error_log("NovelController: JSON decode error for " . $chapters_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: chapters.json DOES NOT exist at " . $chapters_json_path);
        }

        $arc_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/index.json';
        $arc_data = [];
        if (file_exists($arc_index_path)) {
            $arc_data = json_decode(file_get_contents($arc_index_path), true);
        }

        $f3->set('novel_slug', $novel_slug);
        $f3->set('arc_title', $arc_data['title'] ?? 'Arc Tidak Ditemukan');
        $f3->set('arc_name', $arc_name);
        $f3->set('chapters', $chapter_list);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/chapter_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function show_chapter_scenes($f3, $params) {
        $novel_slug = $params['novel_slug'];
        $arc_name = $params['arc_name'];
        $chapter_name = $params['chapter_name'];
        $scenes_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/scenes.json';
        $scene_list = [];

        if (file_exists($scenes_json_path)) {
            $json_content = file_get_contents($scenes_json_path);
            $decoded_scenes = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_scenes)) {
                $scene_list = $decoded_scenes;
            } else {
                error_log("NovelController: JSON decode error for " . $scenes_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: scenes.json DOES NOT exist at " . $scenes_json_path);
        }

        $chapter_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/index.json';
        $chapter_data = [];
        if (file_exists($chapter_index_path)) {
            $chapter_data = json_decode(file_get_contents($chapter_index_path), true);
        }

        $f3->set('novel_slug', $novel_slug);
        $f3->set('arc_name', $arc_name);
        $f3->set('chapter_title', $chapter_data['title'] ?? 'Chapter Tidak Ditemukan');
        $f3->set('chapter_name', $chapter_name);
        $f3->set('scenes', $scene_list);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/scene_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

function show_scene($f3, $params) {
    $novel_slug   = $params['novel_slug'];
    $arc_name     = $params['arc_name'];
    $chapter_name = $params['chapter_name'];
    $scene_name   = $params['scene_name'];

    // Path ke file JSON scene
    $scene_json_path = $f3->get('ROOT') . $f3->get('BASE') .
        '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/' . $scene_name . '.json';

    if (!file_exists($scene_json_path)) {
        $f3->error(404);
        return;
    }

    $json_content = file_get_contents($scene_json_path);
    $scene_data   = json_decode($json_content, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($scene_data)) {
        error_log("NovelController: JSON decode error for " . $scene_json_path . ": " . json_last_error_msg());
        $f3->error(500, 'Error reading scene data.');
        return;
    }

    // Ambil contents langsung sebagai array
    $scene_contents = [];
    if (isset($scene_data['Chapters'][0]['Scenes'][0]['Contents'])) {
        $scene_contents = $scene_data['Chapters'][0]['Scenes'][0]['Contents'];
    }

    // Ambil data chapter
    $chapter_index_path = $f3->get('ROOT') . $f3->get('BASE') .
        '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/index.json';
    $chapter_data = [];
    if (file_exists($chapter_index_path)) {
        $chapter_data = json_decode(file_get_contents($chapter_index_path), true);
    }

    // Ambil data arc
    $arc_index_path = $f3->get('ROOT') . $f3->get('BASE') .
        '/cerita/' . $novel_slug . '/' . $arc_name . '/index.json';
    $arc_data = [];
    if (file_exists($arc_index_path)) {
        $arc_data = json_decode(file_get_contents($arc_index_path), true);
    }

    // Ambil data novel
    $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
    $novel_data = [];
    if (file_exists($novel_index_path)) {
        $novel_data = json_decode(file_get_contents($novel_index_path), true);
    }

    // Set variable untuk template
    $f3->set('novel_title', $novel_data['title'] ?? 'Novel Tidak Ditemukan');
    $f3->set('arc_title', $arc_data['title'] ?? 'Arc Tidak Ditemukan');
    $f3->set('chapter_title', $chapter_data['title'] ?? 'Chapter Tidak Ditemukan');
    $f3->set('chapter_summary', $chapter_data['summary'] ?? 'Ringkasan Tidak Ditemukan');
    $f3->set('scene_name', $scene_data['Chapters'][0]['Scenes'][0]['Meta']['Title'] ?? str_replace('_', ' ', $scene_name));
    $f3->set('scene_contents', $scene_contents);
    

    // Tambahkan baris ini agar template bisa mengakses array mentah
    $f3->set('scene_data', $scene_data);

    echo \Template::instance()->render('templates/header.php');
    echo \Template::instance()->render('novel/scene_view.php');
    echo \Template::instance()->render('templates/footer.php');

}

}
