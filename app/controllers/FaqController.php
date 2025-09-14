<?php

namespace App\Controllers;

class FaqController {

    function show_faq($f3, $params) {
        global $app_base_url;

        $category = $params['category'];
        $faq_name = $params['faq_name'];

        $faq_md_path = $f3->get('ROOT') . $f3->get('BASE') . '/novel_data/faq/' . $category . '/' . $faq_name . '.md';

        if (!file_exists($faq_md_path)) {
            $f3->error(404, 'FAQ not found.');
            return;
        }

        $markdown_content = file_get_contents($faq_md_path);

        // Load Parsedown
        require_once $f3->get('ROOT') . $f3->get('BASE') . '/vendor/erusev/parsedown/Parsedown.php';
        $Parsedown = new Parsedown();
        $html_content = $Parsedown->text($markdown_content);

        $view_data = [
            'faq_title' => str_replace('_', ' ', $faq_name),
            'faq_content' => $html_content,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/faq_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function list_faq_categories($f3) {
        global $app_base_url;

        $faq_base_path = $f3->get('ROOT') . $f3->get('BASE') . '/novel_data/faq/';
        $categories = [];

        if (is_dir($faq_base_path)) {
            $dirs = array_filter(glob($faq_base_path . '*'), 'is_dir');
            foreach ($dirs as $dir) {
                $category_slug = basename($dir);
                $category_title = str_replace('_', ' ', $category_slug);
                $categories[] = [
                    'slug' => $category_slug,
                    'title' => $category_title
                ];
            }
        }

        $view_data = [
            'faq_categories' => $categories,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/faq_category_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }

    function list_faqs_in_category($f3, $params) {
        global $app_base_url;

        $category_slug = $params['category'];
        $faq_category_path = $f3->get('ROOT') . $f3->get('BASE') . '/novel_data/faq/' . $category_slug . '/';
        $faqs = [];

        if (is_dir($faq_category_path)) {
            $files = glob($faq_category_path . '*.md');
            foreach ($files as $file) {
                $faq_filename = basename($file, '.md');
                if ($faq_filename === 'index') { // Skip index.md if it's just for category summary
                    continue;
                }
                $faq_title = str_replace('_', ' ', $faq_filename);
                $faqs[] = [
                    'slug' => $faq_filename,
                    'title' => $faq_title
                ];
            }
        }

        $view_data = [
            'category_slug' => $category_slug,
            'category_title' => str_replace('_', ' ', $category_slug),
            'faqs' => $faqs,
            'app_base_url' => $app_base_url,
            'BASE' => $f3->get('BASE')
        ];
        extract($view_data);

        include $f3->get('ROOT') . '/application/views/templates/header.php';
        include $f3->get('ROOT') . '/application/views/faq_list_view.php';
        include $f3->get('ROOT') . '/application/views/templates/footer.php';
    }
}
