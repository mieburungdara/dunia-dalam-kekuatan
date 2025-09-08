<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');
        $page = $this->input->get('page', TRUE);

        if (empty($page)) {
            $page = 'home'; // Halaman default
        }

        switch ($page) {
            case 'home':
                $this->_show_homepage();
                break;
            case 'baca':
                $this->_show_story_reader();
                break;
            case 'karakter':
            case 'novel':
            case 'glosarium':
            case 'faq':
                $this->_show_placeholder_page(ucfirst($page));
                break;
            default:
                show_404();
                break;
        }
    }

    private function _show_homepage()
    {
        $base_path = FCPATH . 'novel';
        $novel_slug = 'dunia-dalam-kekuatan'; // Hardcoded untuk sekarang
        $novel_path = $base_path;

        $arc_list = [];
        $arc_folders = glob($novel_path . '/Arc_*', GLOB_ONLYDIR);
        foreach($arc_folders as $arc_folder) {
            $arc_name = basename($arc_folder);
            $arc_slug = preg_replace('/^Arc_\d+_/', '', $arc_name);

            $chapter_list = [];
            $chapter_folders = glob($arc_folder . '/*', GLOB_ONLYDIR);
            foreach($chapter_folders as $chapter_folder) {
                $chapter_name = basename($chapter_folder);
                $chapter_slug = preg_replace('/^\d+_/', '', $chapter_name);

                $scene_list = [];
                $scene_files = glob($chapter_folder . '/*.json');
                foreach($scene_files as $scene_file) {
                    $scene_name = basename($scene_file, '.json');
                    $scene_slug = preg_replace('/^\d+_/', '', $scene_name);
                    $scene_list[] = [
                        'name' => str_replace('_', ' ', $scene_slug),
                        'url' => base_url('index.php?page=baca&novel=' . $novel_slug . '&path=' . $arc_slug . '/' . $chapter_slug . '/' . $scene_slug)
                    ];
                }
                $chapter_list[] = [
                    'name' => str_replace('_', ' ', $chapter_slug),
                    'scenes' => $scene_list
                ];
            }
            $arc_list[] = [
                'name' => str_replace('_', ' ', $arc_slug),
                'chapters' => $chapter_list
            ];
        }
        $data['novel_data'] = ['title' => 'Dunia dalam Kekuatan', 'arcs' => $arc_list];

        $this->load->view('templates/header');
        $this->load->view('home_view', $data);
        $this->load->view('templates/footer');
    }

    private function _show_story_reader()
    {
        // Logika untuk ini perlu diadaptasi dari controller Novel.php yang lama
        // Untuk sekarang, kita tampilkan placeholder
        $data['title'] = 'Pembaca Cerita';
        $data['content'] = 'Fitur untuk membaca cerita via query string akan diimplementasikan di sini.';
        $this->load->view('templates/header');
        $this->load->view('placeholder_view', $data);
        $this->load->view('templates/footer');
    }

    private function _show_placeholder_page($title)
    {
        $data['title'] = $title;
        $data['content'] = 'Konten untuk halaman ' . $title . ' akan segera hadir.';
        $this->load->view('templates/header');
        $this->load->view('placeholder_view', $data);
        $this->load->view('templates/footer');
    }
}