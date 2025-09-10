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

    private function jsonToHtml($data, $level = 0) {
        if (empty($data)) {
            return '';
        }

        $html = '<div class="list-group list-group-flush">';

        foreach ($data as $key => $value) {
            $html .= '<div class="list-group-item">';
            $html .= '<div class="d-flex w-100 justify-content-between">';
            
            // Display key if it's not a numeric index for a simple array
            if (!is_numeric($key)) {
                $html .= '<h5 class="mb-1">' . ucwords(str_replace('_', ' ', $key)) . '</h5>';
            }

            $html .= '</div>';

            if (is_array($value)) {
                $html .= $this->jsonToHtml($value, $level + 1);
            } else {
                $html .= '<p class="mb-1">' . htmlspecialchars($value) . '</p>';
            }
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }
}