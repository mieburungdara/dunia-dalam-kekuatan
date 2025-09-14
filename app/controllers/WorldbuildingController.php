<?php

namespace App\Controllers;

class WorldbuildingController {

    public function index($f3) {
        global $app_base_url;

        $wb_path = $f3->get('ROOT') . '/novel_data/worldbuilding/';
        $files = [];
        if (is_dir($wb_path)) {
            $all_files = glob($wb_path . '*.{json,md}', GLOB_BRACE);
            foreach ($all_files as $file) {
                $filename_with_ext = basename($file);
                $filename_no_ext = pathinfo($filename_with_ext, PATHINFO_FILENAME);
                $files[] = [
                    'slug' => $filename_with_ext,
                    'title' => ucwords(str_replace('_', ' ', $filename_no_ext))
                ];
            }
        }

        $view_data = [
            'page_title' => 'Worldbuilding',
            'worldbuilding_files' => $files,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/worldbuilding_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    public function show($f3, $params) {
        global $app_base_url;

        $file_slug = $params['file'];
        $file_path = $f3->get('ROOT') . '/novel_data/worldbuilding/' . $file_slug;

        if (!file_exists($file_path)) {
            $f3->error(404);
            return;
        }

        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        $file_content = file_get_contents($file_path);
        $html_content = '';

        if ($extension === 'json') {
            $data = json_decode($file_content, true);
            $html_content = $this->jsonToHtml($data);
        } elseif ($extension === 'md') {
            require_once $f3->get('ROOT') . '/vendor/erusev/parsedown/Parsedown.php';
            $Parsedown = new Parsedown();
            $html_content = '<div class="card"><div class="card-body">' . $Parsedown->text($file_content) . '</div></div>';
        }

        $view_data = [
            'page_title' => ucwords(str_replace('_', ' ', pathinfo($file_slug, PATHINFO_FILENAME))),
            'worldbuilding_content' => $html_content,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/worldbuilding_detail_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    private function jsonToHtml($data, $parentId = 'accordion') {
        if (empty($data)) {
            return '';
        }

        $html = '<div class="accordion" id="' . $parentId . '">';
        $itemIndex = 0;

        foreach ($data as $key => $value) {
            $itemId = $parentId . '-' . $itemIndex;
            $headerId = 'header-' . $itemId;
            $collapseId = 'collapse-' . $itemId;

            if (is_array($value)) {
                $html .= '<div class="accordion-item">';
                $html .= '<h2 class="accordion-header" id="' . $headerId . '">';
                $html .= '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
                $html .= ucwords(str_replace('_', ' ', is_numeric($key) ? 'Item ' . ($key + 1) : $key));
                $html .= '</button>';
                $html .= '</h2>';
                $html .= '<div id="' . $collapseId . '" class="accordion-collapse collapse" aria-labelledby="' . $headerId . '" data-bs-parent="#' . $parentId . '">';
                $html .= '<div class="accordion-body">';
                $html .= $this->jsonToHtml($value, $collapseId); // Recursive call
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            } else {
                $html .= '<div class="accordion-item">';
                $html .= '<div class="accordion-body">';
                $html .= '<strong>' . ucwords(str_replace('_', ' ', $key)) . ':</strong> ' . htmlspecialchars($value);
                $html .= '</div>';
                $html .= '</div>';
            }
            $itemIndex++;
        }

        $html .= '</div>';
        return $html;
    }
}