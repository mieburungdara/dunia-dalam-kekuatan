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
        $base_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug;

        $arc_list = [];
        $arc_folders = glob($base_path . '/*', GLOB_ONLYDIR);
        foreach($arc_folders as $arc_folder) {
            $arc_name = basename($arc_folder);
            $index_path = $arc_folder . '/index.json';
            if (file_exists($index_path)) {
                $json_content = file_get_contents($index_path);
                $arc_data = json_decode($json_content, true);
                $arc_list[] = [
                    'name' => $arc_data['title'],
                    'url' => base_url('novel/' . $novel_slug . '/' . $arc_name)
                ];
            }
        }

        $novel_index_path = $base_path . '/index.json';
        $novel_data = json_decode(file_get_contents($novel_index_path), true);

        $f3->set('novel_title', $novel_data['title']);
        $f3->set('novel_slug', $novel_slug);
        $f3->set('arcs', $arc_list);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/arc_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function show_arc_chapters($f3, $params) {
        $novel_slug = $params['novel_slug'];
        $arc_name = $params['arc_name'];
        $base_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name;

        $chapter_list = [];
        $chapter_folders = glob($base_path . '/*', GLOB_ONLYDIR);
        foreach($chapter_folders as $chapter_folder) {
            $chapter_name = basename($chapter_folder);
            $index_path = $chapter_folder . '/index.json';
            if (file_exists($index_path)) {
                $json_content = file_get_contents($index_path);
                $chapter_data = json_decode($json_content, true);
                $chapter_list[] = [
                    'name' => $chapter_data['title'],
                    'url' => base_url('novel/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name)
                ];
            }
        }

        $arc_index_path = $base_path . '/index.json';
        $arc_data = json_decode(file_get_contents($arc_index_path), true);

        $f3->set('novel_slug', $novel_slug);
        $f3->set('arc_title', $arc_data['title']);
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
        $base_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name;

        $scene_list = [];
        $scene_files = glob($base_path . '/*.md');
        foreach($scene_files as $scene_file) {
            $scene_name = basename($scene_file, '.md');
            $scene_list[] = [
                'name' => str_replace('_', ' ', preg_replace('/^\d+_/', '', $scene_name)),
                'url' => base_url('novel/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/' . $scene_name)
            ];
        }

        $chapter_index_path = $base_path . '/index.json';
        $chapter_data = json_decode(file_get_contents($chapter_index_path), true);

        $f3->set('novel_slug', $novel_slug);
        $f3->set('arc_name', $arc_name);
        $f3->set('chapter_title', $chapter_data['title']);
        $f3->set('chapter_name', $chapter_name);
        $f3->set('scenes', $scene_list);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/scene_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function show_scene($f3, $params) {
        $novel_slug = $params['novel_slug'];
        $arc_name = $params['arc_name'];
        $chapter_name = $params['chapter_name'];
        $scene_name = $params['scene_name'];

        $base_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name;

        $scene_files = glob($base_path . '/*' . $scene_name . '.md');

        if (empty($scene_files)) {
            $f3->error(404);
            return;
        }

        $scene_file = $scene_files[0];

        $markdown_content = file_get_contents($scene_file);
        $html_content = (new \Parsedown())->text($markdown_content);

        $chapter_index_path = $base_path . '/index.json';
        $chapter_data = json_decode(file_get_contents($chapter_index_path), true);

        $arc_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/index.json';
        $arc_data = json_decode(file_get_contents($arc_index_path), true);

        $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
        $novel_data = json_decode(file_get_contents($novel_index_path), true);

        $f3->set('novel_title', $novel_data['title']);
        $f3->set('arc_title', $arc_data['title']);
        $f3->set('chapter_title', $chapter_data['title']);
        $f3->set('scene_name', str_replace('_', ' ', preg_replace('/^\d+_/', '', $scene_name)));
        $f3->set('scene_content', $html_content);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/scene_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }
}
