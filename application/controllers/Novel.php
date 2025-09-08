<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novel extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');

        // For now, we only have one novel, so we'll hardcode it.
        $novels = [
            [
                'title' => 'Dunia dalam Kekuatan',
                'slug' => 'dunia-dalam-kekuatan',
                'url' => base_url('novel/dunia-dalam-kekuatan')
            ]
        ];

        $data['novels'] = $novels;

        $this->load->view('templates/header');
        $this->load->view('novel/novel_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function view($novel_slug)
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'novel';

        $arc_list = [];
        $arc_folders = glob($base_path . '/Arc_*', GLOB_ONLYDIR);
        foreach($arc_folders as $arc_folder) {
            $arc_name = basename($arc_folder);
            $arc_slug = preg_replace('/^Arc_\d+_/', '', $arc_name);

            $arc_list[] = [
                'name' => str_replace('_', ' ', $arc_slug),
                'url' => base_url('novel/' . $novel_slug . '/' . $arc_slug)
            ];
        }

        $data['novel_slug'] = $novel_slug;
        $data['arcs'] = $arc_list;

        $this->load->view('templates/header');
        $this->load->view('novel/arc_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function arc($novel_slug, $arc_slug)
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'novel';

        $arc_path = $base_path . '/Arc_' . $arc_slug;

        $chapter_list = [];
        $chapter_folders = glob($arc_path . '/*', GLOB_ONLYDIR);
        foreach($chapter_folders as $chapter_folder) {
            $chapter_name = basename($chapter_folder);
            $chapter_slug = preg_replace('/^\d+_/', '', $chapter_name);

            $chapter_list[] = [
                'name' => str_replace('_', ' ', $chapter_slug),
                'url' => base_url('novel/' . $novel_slug . '/' . $arc_slug . '/' . $chapter_slug)
            ];
        }

        $data['novel_slug'] = $novel_slug;
        $data['arc_slug'] = $arc_slug;
        $data['chapters'] = $chapter_list;

        $this->load->view('templates/header');
        $this->load->view('novel/chapter_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function chapter($novel_slug, $arc_slug, $chapter_slug)
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'novel';

        $chapter_path = $base_path . '/Arc_' . $arc_slug . '/' . $chapter_slug;

        $scene_list = [];
        $scene_files = glob($chapter_path . '/*.md');
        foreach($scene_files as $scene_file) {
            $scene_name = basename($scene_file, '.md');
            $scene_slug = preg_replace('/^\d+_/', '', $scene_name);
            $scene_list[] = [
                'name' => str_replace('_', ' ', $scene_slug),
                'url' => base_url('novel/' . $novel_slug . '/' . $arc_slug . '/' . $chapter_slug . '/' . $scene_slug)
            ];
        }

        $data['novel_slug'] = $novel_slug;
        $data['arc_slug'] = $arc_slug;
        $data['chapter_slug'] = $chapter_slug;
        $data['scenes'] = $scene_list;

        $this->load->view('templates/header');
        $this->load->view('novel/scene_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function scene($novel_slug, $arc_slug, $chapter_slug, $scene_slug)
    {
        $this->load->helper('url');
        $this->load->library('parsedown');

        $base_path = FCPATH . 'novel';

        // Find the correct scene file, ignoring the number prefix
        $scene_files = glob($base_path . '/Arc_' . $arc_slug . '/' . $chapter_slug . '/*' . $scene_slug . '.md');

        if (empty($scene_files)) {
            show_404();
            return;
        }

        $scene_file = $scene_files[0];

        $markdown_content = file_get_contents($scene_file);
        $html_content = $this->parsedown->text($markdown_content);

        $data['novel_slug'] = $novel_slug;
        $data['arc_slug'] = $arc_slug;
        $data['chapter_slug'] = $chapter_slug;
        $data['scene_slug'] = $scene_slug;
        $data['scene_content'] = $html_content;

        $this->load->view('templates/header');
        $this->load->view('novel/scene_view', $data);
        $this->load->view('templates/footer');
    }
}
