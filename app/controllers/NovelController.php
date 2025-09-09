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
        require_once __DIR__ . '/../helpers/CharacterHelper.php';

        $novel_slug = $params['novel_slug'];
        $arc_name = $params['arc_name'];
        $chapter_name = $params['chapter_name'];
        $scenes_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/scenes.json';
        $scene_list = [];

        if (file_exists($scenes_json_path)) {
            $json_content = file_get_contents($scenes_json_path);
            $decoded_scenes = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_scenes)) {
                foreach ($decoded_scenes as &$scene) { // Gunakan reference untuk modifikasi
                    // Tambahkan nama karakter POV jika ID ada
                    if (isset($scene['pov_character_id'])) {
                        $scene['pov_character_name'] = CharacterHelper::getCharacterNameById($scene['pov_character_id']);
                    } else {
                        $scene['pov_character_name'] = 'Tidak ditentukan'; // Default value
                    }
                    // Pastikan summary ada
                    if (!isset($scene['summary'])) {
                        $scene['summary'] = 'Ringkasan belum tersedia.'; // Default value
                    }
                }
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
        require_once __DIR__ . '/../helpers/ContentHelper.php';

        $novel_slug   = $params['novel_slug'];
        $arc_name     = $params['arc_name'];
        $chapter_name = $params['chapter_name'];
        $scene_name   = $params['scene_name'];

        // --- Start of Navigation Logic ---
        $prev_link = null;
        $next_link = null;

        // 1. Get current chapter's scenes
        $scenes_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/scenes.json';
        if (file_exists($scenes_json_path)) {
            $scenes_list = json_decode(file_get_contents($scenes_json_path), true);
            if (is_array($scenes_list)) {
                $current_scene_index = -1;
                foreach ($scenes_list as $index => $scene) {
                    if (isset($scene['slug']) && $scene['slug'] === $scene_name) {
                        $current_scene_index = $index;
                        break;
                    }
                }

                if ($current_scene_index !== -1) {
                    // Intra-chapter navigation
                    if ($current_scene_index > 0) {
                        $prev_scene_obj = $scenes_list[$current_scene_index - 1];
                        $prev_link = [
                            'url' => "{$f3->get('BASE')}/read/{$novel_slug}/{$arc_name}/{$chapter_name}/{$prev_scene_obj['slug']}",
                            'title' => $prev_scene_obj['title']
                        ];
                    }
                    if ($current_scene_index < count($scenes_list) - 1) {
                        $next_scene_obj = $scenes_list[$current_scene_index + 1];
                        $next_link = [
                            'url' => "{$f3->get('BASE')}/read/{$novel_slug}/{$arc_name}/{$chapter_name}/{$next_scene_obj['slug']}",
                            'title' => $next_scene_obj['title']
                        ];
                    }
                }
            }
        }

        // 2. Inter-chapter navigation (if needed)
        if ($prev_link === null || $next_link === null) {
            $chapters_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/chapters.json';
            if (file_exists($chapters_json_path)) {
                $chapters_list = json_decode(file_get_contents($chapters_json_path), true);
                if (is_array($chapters_list)) {
                    $current_chapter_index = -1;
                    foreach ($chapters_list as $index => $chapter) {
                        if (isset($chapter['slug']) && $chapter['slug'] === $chapter_name) {
                            $current_chapter_index = $index;
                            break;
                        }
                    }

                    if ($current_chapter_index !== -1) {
                        // Find NEXT chapter's first scene
                        if ($next_link === null && $current_chapter_index < count($chapters_list) - 1) {
                            $next_chapter_slug = $chapters_list[$current_chapter_index + 1]['slug'];
                            $next_chapter_scenes_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $next_chapter_slug . '/scenes.json';
                            if (file_exists($next_chapter_scenes_path)) {
                                $next_chapter_scenes = json_decode(file_get_contents($next_chapter_scenes_path), true);
                                if (!empty($next_chapter_scenes)) {
                                    $first_scene_obj = $next_chapter_scenes[0];
                                    $next_link = [
                                        'url' => "{$f3->get('BASE')}/read/{$novel_slug}/{$arc_name}/{$next_chapter_slug}/{$first_scene_obj['slug']}",
                                        'title' => $first_scene_obj['title']
                                    ];
                                }
                            }
                        }
                        // Find PREVIOUS chapter's last scene
                        if ($prev_link === null && $current_chapter_index > 0) {
                            $prev_chapter_slug = $chapters_list[$current_chapter_index - 1]['slug'];
                            $prev_chapter_scenes_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $prev_chapter_slug . '/scenes.json';
                            if (file_exists($prev_chapter_scenes_path)) {
                                $prev_chapter_scenes = json_decode(file_get_contents($prev_chapter_scenes_path), true);
                                if (!empty($prev_chapter_scenes)) {
                                    $last_scene_obj = end($prev_chapter_scenes);
                                    $prev_link = [
                                        'url' => "{$f3->get('BASE')}/read/{$novel_slug}/{$arc_name}/{$prev_chapter_slug}/{$last_scene_obj['slug']}",
                                        'title' => $last_scene_obj['title']
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
        // --- End of Navigation Logic ---

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

        $scene_contents = [];
        if (isset($scene_data['Chapters'][0]['Scenes'][0]['Contents'])) {
            $scene_contents = $scene_data['Chapters'][0]['Scenes'][0]['Contents'];
        }
        
        $rendered_content = ContentHelper::render($scene_contents);

        $chapter_index_path = $f3->get('ROOT') . $f3->get('BASE') .
            '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/index.json';
        $chapter_data = [];
        if (file_exists($chapter_index_path)) {
            $chapter_data = json_decode(file_get_contents($chapter_index_path), true);
        }

        $arc_index_path = $f3->get('ROOT') . $f3->get('BASE') .
            '/cerita/' . $novel_slug . '/' . $arc_name . '/index.json';
        $arc_data = [];
        if (file_exists($arc_index_path)) {
            $arc_data = json_decode(file_get_contents($arc_index_path), true);
        }

        $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
        $novel_data = [];
        if (file_exists($novel_index_path)) {
            $novel_data = json_decode(file_get_contents($novel_index_path), true);
        }

        $f3->set('novel_title', $novel_data['title'] ?? 'Novel Tidak Ditemukan');
        $f3->set('arc_title', $arc_data['title'] ?? 'Arc Tidak Ditemukan');
        $f3->set('chapter_title', $chapter_data['title'] ?? 'Chapter Tidak Ditemukan');
        $f3->set('chapter_summary', $chapter_data['summary'] ?? 'Ringkasan Tidak Ditemukan');
        $f3->set('scene_name', $scene_data['Chapters'][0]['Scenes'][0]['Meta']['Title'] ?? str_replace('_', ' ', $scene_name));
        
        $f3->set('rendered_content', $rendered_content);
        $f3->set('prev_link', $prev_link);
        $f3->set('next_link', $next_link);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('novel/scene_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }
}
