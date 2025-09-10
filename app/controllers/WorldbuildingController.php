<?php

class WorldbuildingController {

    public function index($f3) {
        $wb_path = $f3->get('ROOT') . '/novel_data/worldbuilding/';
        $files = [];
        if (is_dir($wb_path)) {
            $json_files = glob($wb_path . '*.json');
            foreach ($json_files as $file) {
                $filename = basename($file, '.json');
                $files[] = [
                    'slug' => $filename,
                    'title' => ucwords(str_replace('_', ' ', $filename))
                ];
            }
        }

        $f3->set('page_title', 'Worldbuilding');
        $f3->set('worldbuilding_files', $files);
        echo \Template::instance()->render('application/views/worldbuilding_list_view.php');
    }

    public function show($f3, $params) {
        $file_slug = $params['file'];
        $file_path = $f3->get('ROOT') . '/novel_data/worldbuilding/' . $file_slug . '.json';

        if (!file_exists($file_path)) {
            $f3->error(404);
            return;
        }

        $json_content = file_get_contents($file_path);
        $data = json_decode($json_content, true);

        $html_content = $this->jsonToHtml($data);

        $f3->set('page_title', ucwords(str_replace('_', ' ', $file_slug)));
        $f3->set('worldbuilding_content', $html_content);
        echo \Template::instance()->render('application/views/worldbuilding_detail_view.php');
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