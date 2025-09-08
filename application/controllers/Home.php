<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');
        $base_path = FCPATH . 'novel';
        $data['novel_list'] = [];

        // Untuk saat ini, kita asumsikan hanya ada satu novel di root folder 'novel'
        // Nanti bisa dikembangkan untuk scan beberapa novel
        $novel_slug = 'dunia-dalam-kekuatan'; // Hardcoded untuk sekarang
        $novel_path = $base_path;

        // Scan untuk Arcs
        $arc_list = [];
        $arc_folders = glob($novel_path . '/Arc_*', GLOB_ONLYDIR);
        foreach($arc_folders as $arc_folder) {
            $arc_name = basename($arc_folder);
            $arc_display_name = preg_replace('/^Arc_\d+_/', '', $arc_name);
            $arc_display_name = str_replace('_', ' ', $arc_display_name);
            $arc_slug = preg_replace('/^Arc_\d+_/', '', $arc_name);

            // Scan untuk Chapters
            $chapter_list = [];
            $chapter_folders = glob($arc_folder . '/*', GLOB_ONLYDIR);
            foreach($chapter_folders as $chapter_folder) {
                $chapter_name = basename($chapter_folder);
                $chapter_display_name = preg_replace('/^\d+_/', '', $chapter_name);
                $chapter_display_name = str_replace('_', ' ', $chapter_display_name);
                $chapter_slug = preg_replace('/^\d+_/', '', $chapter_name);

                // Scan untuk Scenes
                $scene_list = [];
                $scene_files = glob($chapter_folder . '/*.json');
                foreach($scene_files as $scene_file) {
                    $scene_name = basename($scene_file, '.json');
                    $scene_display_name = preg_replace('/^\d+_/', '', $scene_name);
                    $scene_display_name = str_replace('_', ' ', $scene_display_name);
                    $scene_slug = preg_replace('/^\d+_/', '', $scene_name);
                    
                    $scene_list[] = [
                        'name' => $scene_display_name,
                        'url' => site_url($novel_slug . '/' . $arc_slug . '/' . $chapter_slug . '/' . $scene_slug)
                    ];
                }

                $chapter_list[] = [
                    'name' => $chapter_display_name,
                    'scenes' => $scene_list
                ];
            }

            $arc_list[] = [
                'name' => $arc_display_name,
                'chapters' => $chapter_list
            ];
        }
        $data['novel_data'] = ['title' => 'Dunia dalam Kekuatan', 'arcs' => $arc_list];

        $this->load->view('templates/header');
        $this->load->view('home_view', $data);
        $this->load->view('templates/footer');
    }
}
