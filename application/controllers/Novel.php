<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novel extends CI_Controller {

    public function index()
    {
        // Halaman ini nantinya bisa menampilkan daftar semua Arc.
        $this->load->view('templates/header');
        $this->load->view('novel_view');
        $this->load->view('templates/footer');
    }

    /**
     * Fungsi ini menangani pembacaan cerita berdasarkan path yang diberikan oleh router.
     * Contoh path: slug-arc/slug-chapter/slug-scene
     */
    public function baca($path = '')
    {
        echo "DEBUG MODE: Path yang diterima oleh controller: ";
        var_dump($path);
        die();

        $path_segments = explode('/', $path);

        if (empty($path_segments) || empty($path))
        {
            show_404();
            return;
        }

        $real_path = $this->_find_real_path($path_segments);

        if ($real_path === FALSE || !file_exists($real_path))
        {
            show_404();
            return;
        }

        $json_content = file_get_contents($real_path);
        $data['data'] = json_decode($json_content, TRUE);

        if (json_last_error() !== JSON_ERROR_NONE) {
            show_error('Gagal mem-parsing file JSON cerita: ' . json_last_error_msg(), 500);
            return;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('novel_reader_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * Mencari path file/folder asli berdasarkan array slug.
     * Mengabaikan prefix angka seperti "01_" atau "1_".
     */
    private function _find_real_path($slugs)
    {
        $current_path = FCPATH . 'novel'; // FCPATH adalah root folder proyek

        foreach ($slugs as $index => $slug)
        {
            $found = FALSE;
            $is_last_segment = ($index === count($slugs) - 1);
            
            // Keamanan dasar untuk mencegah directory traversal
            $slug = basename($slug);

            // Pola pencarian: /path/sekarang/*_slug.json (jika terakhir) atau /path/sekarang/*_slug (jika folder)
            $search_pattern = $current_path . '/*_' . $slug . ($is_last_segment ? '.json' : '');
            
            $matches = glob($search_pattern);

            if (!empty($matches))
            {
                $current_path = $matches[0]; // Ambil hasil pertama yang cocok
                $found = TRUE;
            }

            if ( ! $found) {
                return FALSE; // Segmen path tidak ditemukan
            }
        }
        return $current_path;
    }
}
