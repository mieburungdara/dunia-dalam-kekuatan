<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novel extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'cerita';

        $novels = [];
        $novel_folders = glob($base_path . '/*', GLOB_ONLYDIR);
        foreach($novel_folders as $novel_folder) {
            $novel_slug = basename($novel_folder);
            $index_path = $novel_folder . '/index.json';
            if (file_exists($index_path)) {
                $json_content = file_get_contents($index_path);
                $novel_data = json_decode($json_content, true);
                $novels[] = [
                    'title' => $novel_data['title'],
                    'slug' => $novel_slug,
                    'url' => base_url('novel/' . $novel_slug)
                ];
            }
        }

        $data['novels'] = $novels;

        $this->load->view('templates/header');
        $this->load->view('novel/novel_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function view($novel_slug)
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'cerita/' . $novel_slug;

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

        $data['novel_title'] = $novel_data['title'];
        $data['novel_slug'] = $novel_slug;
        $data['arcs'] = $arc_list;

        $this->load->view('templates/header');
        $this->load->view('novel/arc_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function arc($novel_slug, $arc_name)
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'cerita/' . $novel_slug . '/' . $arc_name;

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

        $data['novel_slug'] = $novel_slug;
        $data['arc_title'] = $arc_data['title'];
        $data['arc_name'] = $arc_name;
        $data['chapters'] = $chapter_list;

        $this->load->view('templates/header');
        $this->load->view('novel/chapter_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function chapter($novel_slug, $arc_name, $chapter_name)
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name;

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

        $data['novel_slug'] = $novel_slug;
        $data['arc_name'] = $arc_name;
        $data['chapter_title'] = $chapter_data['title'];
        $data['chapter_name'] = $chapter_name;
        $data['scenes'] = $scene_list;

        $this->load->view('templates/header');
        $this->load->view('novel/scene_list_view', $data);
        $this->load->view('templates/footer');
    }

    public function scene($novel_slug, $arc_name, $chapter_name, $scene_name)
    {
        $this->load->helper('url');
        $this->load->library('parsedown');

        $base_path = FCPATH . 'cerita/' . $novel_slug . '/' . $arc_name . '/' . $chapter_name;

        // Find the correct scene file, ignoring the number prefix
        $scene_files = glob($base_path . '/*' . $scene_name . '.md');

        if (empty($scene_files)) {
            show_404();
            return;
        }

        $scene_file = $scene_files[0];

        $markdown_content = file_get_contents($scene_file);
        $html_content = $this->parsedown->text($markdown_content);

        $chapter_index_path = $base_path . '/index.json';
        $chapter_data = json_decode(file_get_contents($chapter_index_path), true);

        $arc_index_path = FCPATH . 'cerita/' . $novel_slug . '/' . $arc_name . '/index.json';
        $arc_data = json_decode(file_get_contents($arc_index_path), true);

        $novel_index_path = FCPATH . 'cerita/' . $novel_slug . '/index.json';
        $novel_data = json_decode(file_get_contents($novel_index_path), true);

        $data['novel_title'] = $novel_data['title'];
        $data['arc_title'] = $arc_data['title'];
        $data['chapter_title'] = $chapter_data['title'];
        $data['scene_name'] = str_replace('_', ' ', preg_replace('/^\d+_/', '', $scene_name));
        $data['scene_content'] = $html_content;

        $this->load->view('templates/header');
        $this->load->view('novel/scene_view', $data);
        $this->load->view('templates/footer');
    }
}