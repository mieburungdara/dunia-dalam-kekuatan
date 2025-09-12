<?php

class NovelController {

    function list_novels($f3) {
        global $app_base_url; // Access the global variable

        $novels_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/novels.json';
        $novels = [];

        if (file_exists($novels_json_path)) {
            $json_content = file_get_contents($novels_json_path);
            $decoded_novels = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_novels)) {
                // Validate each novel entry and fetch summary from index.json
                foreach ($decoded_novels as $novel_entry) {
                    if (isset($novel_entry['title']) && isset($novel_entry['slug']) && isset($novel_entry['url'])) {
                        $novel_slug = $novel_entry['slug'];
                        $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
                        $novel_entry['summary'] = 'Ringkasan belum tersedia.'; // Default summary

                        if (file_exists($novel_index_path)) {
                            $index_content = file_get_contents($novel_index_path);
                            $decoded_index = json_decode($index_content, true);
                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_index) && isset($decoded_index['summary'])) {
                                $novel_entry['summary'] = $decoded_index['summary'];
                            } else {
                                error_log("NovelController: Invalid novel index data for " . $novel_slug . ". Missing summary or JSON decode error: " . json_last_error_msg());
                            }
                        } else {
                            error_log("NovelController: index.json for novel " . $novel_slug . " DOES NOT exist at " . $novel_index_path);
                        }
                        $novels[] = $novel_entry;
                    } else {
                        error_log("NovelController: Invalid novel entry found in " . $novels_json_path . ". Missing title, slug, or url.");
                    }
                }
            } else {
                error_log("NovelController: JSON decode error for " . $novels_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: novels.json DOES NOT exist at " . $novels_json_path);
        }

        // Collect variables for the view
        $view_data = [
            'novels' => $novels,
            'app_base_url' => $app_base_url, // Make app_base_url available
            'BASE' => $f3->get('BASE') // BASE is used in some views, so pass it
        ];
        extract($view_data); // Extract variables into the current scope

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/novel/novel_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function show_novel_index($f3, $params) {
        global $app_base_url;

        $novel_slug = $params['novel_slug'];
        $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
        $arcs_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/arcs.json';

        $novel_data = [];
        try {
            if (file_exists($novel_index_path)) {
                $json_content = file_get_contents($novel_index_path);
                if ($json_content === false) {
                    error_log("NovelController: Failed to read novel index.json at " . $novel_index_path);
                    $f3->error(500, 'Failed to read novel data.');
                    return;
                }
                $decoded_novel_data = json_decode($json_content, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_novel_data) && isset($decoded_novel_data['title']) && isset($decoded_novel_data['summary'])) {
                    $novel_data = $decoded_novel_data;
                } else {
                    error_log("NovelController: Invalid novel index data in " . $novel_index_path . ". Missing title or summary, or JSON decode error: " . json_last_error_msg() . ". Content: " . substr($json_content, 0, 200));
                    $f3->error(500, 'Invalid novel data structure.');
                    return;
                }
            } else {
                error_log("NovelController: Novel index.json DOES NOT exist at " . $novel_index_path);
                $f3->error(404, 'Novel not found.');
                return;
            }
        } catch (Exception $e) {
            error_log("NovelController: Exception while processing novel index.json: " . $e->getMessage());
            $f3->error(500, 'An unexpected error occurred while loading novel data.');
            return;
        }


        $arc_list = [];
        try {
            if (file_exists($arcs_json_path)) {
                $json_content = file_get_contents($arcs_json_path);
                if ($json_content === false) {
                    error_log("NovelController: Failed to read arcs.json at " . $arcs_json_path);
                    // Continue without arcs, don't fatal error
                } else {
                    $decoded_arcs = json_decode($json_content, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_arcs)) {
                        foreach ($decoded_arcs as $arc_entry) {
                            if (isset($arc_entry['title']) && isset($arc_entry['slug'])) {
                                $arc_list[] = $arc_entry;
                            } else {
                                error_log("NovelController: Invalid arc entry found in " . $arcs_json_path . ". Missing title or slug.");
                            }
                        }
                    }
                } else {
                    error_log("NovelController: JSON decode error for " . $arcs_json_path . ": " . json_last_error_msg() . ". Content: " . substr($json_content, 0, 200));
                }
            } else {
                error_log("NovelController: arcs.json DOES NOT exist at " . $arcs_json_path);
            }
        } catch (Exception $e) {
            error_log("NovelController: Exception while processing arcs.json: " . $e->getMessage());
            // Continue without arcs, don't fatal error
        }

        $view_data = [
            'novel_title' => $novel_data['title'] ?? 'Novel Tidak Ditemukan',
            'novel_summary' => $novel_data['summary'] ?? 'Ringkasan Tidak Ditemukan',
            'novel_slug' => $novel_slug,
            'arcs' => $arc_list,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/novel/novel_index_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function list_novel_arcs($f3, $params) {
        global $app_base_url;

        $novel_slug = $params['novel_slug'];
        $arcs_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/arcs.json';
        $arc_list = [];

        if (file_exists($arcs_json_path)) {
            $json_content = file_get_contents($arcs_json_path);
            $decoded_arcs = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_arcs)) {
                foreach ($decoded_arcs as $arc_entry) {
                    if (isset($arc_entry['title']) && isset($arc_entry['slug'])) {
                        $arc_list[] = $arc_entry;
                    } else {
                        error_log("NovelController: Invalid arc entry found in " . $arcs_json_path . ". Missing title or slug.");
                    }
                }
            } else {
                error_log("NovelController: JSON decode error for " . $arcs_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: arcs.json DOES NOT exist at " . $arcs_json_path);
        }

        $novel_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/index.json';
        $novel_data = [];
        if (file_exists($novel_index_path)) {
            $decoded_novel_data = json_decode(file_get_contents($novel_index_path), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_novel_data) && isset($decoded_novel_data['title']) && isset($decoded_novel_data['summary'])) {
                $novel_data = $decoded_novel_data;
            } else {
                error_log("NovelController: Invalid novel index data in " . $novel_index_path . ". Missing title or description, or JSON decode error: " . json_last_error_msg());
            }
        }

        $view_data = [
            'novel_title' => $novel_data['title'] ?? 'Novel Tidak Ditemukan',
            'novel_slug' => $novel_slug,
            'arcs' => $arc_list,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/novel/arc_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function show_arc_chapters($f3, $params) {
        global $app_base_url;

        $novel_slug = $params['novel_slug'];
        $arc_name = $params['arc_name'];
        $chapters_json_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/chapters.json';
        $chapter_list = [];

        if (file_exists($chapters_json_path)) {
            $json_content = file_get_contents($chapters_json_path);
            $decoded_chapters = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_chapters)) {
                foreach ($decoded_chapters as $chapter_entry) {
                    if (isset($chapter_entry['title']) && isset($chapter_entry['slug'])) {
                        $chapter_list[] = $chapter_entry;
                    } else {
                        error_log("NovelController: Invalid chapter entry found in " . $chapters_json_path . ". Missing title or slug.");
                    }
                }
            } else {
                error_log("NovelController: JSON decode error for " . $chapters_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: chapters.json DOES NOT exist at " . $chapters_json_path);
        }

        $arc_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/index.json';
        $arc_data = [];
        if (file_exists($arc_index_path)) {
            $decoded_arc_data = json_decode(file_get_contents($arc_index_path), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_arc_data) && isset($decoded_arc_data['title'])) {
                $arc_data = $decoded_arc_data;
            } else {
                error_log("NovelController: Invalid arc index data in " . $arc_index_path . ". Missing title, or JSON decode error: " . json_last_error_msg());
            }
        }

        $view_data = [
            'novel_slug' => $novel_slug,
            'arc_title' => $arc_data['title'] ?? 'Arc Tidak Ditemukan',
            'arc_name' => $arc_name,
            'chapters' => $chapter_list,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/novel/chapter_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function show_chapter_scenes($f3, $params) {
        global $app_base_url;
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
                    // Validate scene entry
                    if (isset($scene['slug']) && isset($scene['title'])) {
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
                        $scene_list[] = $scene;
                    } else {
                        error_log("NovelController: Invalid scene entry found in " . $scenes_json_path . ". Missing slug or title.");
                    }
                }
            } else {
                error_log("NovelController: JSON decode error for " . $scenes_json_path . ": " . json_last_error_msg());
            }
        } else {
            error_log("NovelController: scenes.json DOES NOT exist at " . $scenes_json_path);
        }

        $chapter_index_path = $f3->get('ROOT') . $f3->get('BASE') . '/cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name . '/index.json';
        $chapter_data = [];
        if (file_exists($chapter_index_path)) {
            $decoded_chapter_data = json_decode(file_get_contents($chapter_index_path), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_chapter_data) && isset($decoded_chapter_data['title']) && isset($decoded_chapter_data['summary'])) {
                $chapter_data = $decoded_chapter_data;
            } else {
                error_log("NovelController: Invalid chapter index data in " . $chapter_index_path . ". Missing title or summary, or JSON decode error: " . json_last_error_msg());
            }
        }

        $view_data = [
            'novel_slug' => $novel_slug,
            'arc_name' => $arc_name,
            'chapter_title' => $chapter_data['title'] ?? 'Chapter Tidak Ditemukan',
            'chapter_name' => $chapter_name,
            'scenes' => $scene_list,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/novel/scene_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function show_scene($f3, $params) {
        global $app_base_url;
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

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($scene_data) || !isset($scene_data['Meta']['Title'])) {
            error_log("NovelController: Invalid scene data in " . $scene_json_path . ". Missing expected structure or JSON decode error: " . json_last_error_msg() . ". Content: " . $json_content);
            $f3->error(500, 'Error reading scene data or invalid scene structure.');
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

        $view_data = [
            'novel_title' => $novel_data['title'] ?? 'Novel Tidak Ditemukan',
            'arc_title' => $arc_data['title'] ?? 'Arc Tidak Ditemukan',
            'chapter_title' => $chapter_data['title'] ?? 'Chapter Tidak Ditemukan',
            'chapter_summary' => $chapter_data['summary'] ?? 'Ringkasan Tidak Ditemukan',
            'scene_name' => $scene_data['Meta']['Title'] ?? str_replace('_', ' ', $scene_name),
            'rendered_content' => $rendered_content,
            'prev_link' => $prev_link,
            'next_link' => $next_link,
            'novel_slug' => $novel_slug, // Added for scene_list_view
            'arc_name' => $arc_name,     // Added for scene_list_view
            'chapter_name' => $chapter_name, // Added for scene_list_view
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/novel/scene_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function show_character_relationships($f3) {
        global $app_base_url;

        $character_data_path = $f3->get('ROOT') . 'novel_data/characters/';
        $nodes = [];
        $edges = [];
        $character_names = []; // To map ID to Name

        // First pass: Collect all character names and create nodes
        $files = scandir($character_data_path);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $content = file_get_contents($character_data_path . $file);
                $character = json_decode($content, true);
                if ($character && isset($character['ID']) && isset($character['Name'])) {
                    $charId_lowercase = strtolower($character['ID']);
                    $image_path = $f3->get('ROOT') . 'assets/images/characters/' . $charId_lowercase . '.png';
                    $image_url = '';

                    if (file_exists($image_path)) {
                        $image_url = $f3->get('BASE') . '/assets/images/characters/' . $charId_lowercase . '.png';
                    } else {
                        // Generate initials for placehold.co
                        $initials = '';
                        $words = explode(' ', $character['Name']);
                        foreach ($words as $word) {
                            if (!empty($word)) {
                                $initials .= strtoupper(substr($word, 0, 1));
                            }
                        }
                        $image_url = 'https://placehold.co/50x50/png?text=' . $initials;
                    }
                    $nodes[] = ['id' => $character['ID'], 'label' => $character['Name'], 'image' => $image_url];
                    $character_names[$character['ID']] = $character['Name'];
                }
            }
        }

        // Second pass: Create edges based on relationships
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $content = file_get_contents($character_data_path . $file);
                $character = json_decode($content, true);
                if ($character && isset($character['ID']) && isset($character['Relationships'])) {
                    foreach ($character['Relationships'] as $rel) {
                        if (isset($rel['TargetID']) && isset($rel['Type'])) {
                            // Ensure TargetID is a string for consistency with character IDs
                            $target_id = (string)$rel['TargetID']; 
                            // Only add edge if both characters exist as nodes
                            if (array_key_exists($character['ID'], $character_names) && array_key_exists($target_id, $character_names)) {
                                $edges[] = [
                                    'from' => $character['ID'],
                                    'to' => $target_id,
                                    'label' => $rel['Type'],
                                    'title' => $rel['Description'] ?? $rel['Type']
                                ];
                            }
                        }
                    }
                }
            }
        }

        $view_data = [
            'nodes' => json_encode($nodes),
            'edges' => json_encode($edges),
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/character_relationships_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }
}