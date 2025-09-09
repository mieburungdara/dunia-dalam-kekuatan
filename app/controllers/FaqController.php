<?php

class FaqController {

    function show_faq($f3, $params) {
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

        $f3->set('faq_title', str_replace('_', ' ', $faq_name));
        $f3->set('faq_content', $html_content);

        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('faq_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function list_faq_categories($f3) {
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

        $f3->set('faq_categories', $categories);
        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('faq_category_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }

    function list_faqs_in_category($f3, $params) {
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

        $f3->set('category_slug', $category_slug);
        $f3->set('category_title', str_replace('_', ' ', $category_slug));
        $f3->set('faqs', $faqs);
        echo \Template::instance()->render('templates/header.php');
        echo \Template::instance()->render('faq_list_view.php');
        echo \Template::instance()->render('templates/footer.php');
    }
}
