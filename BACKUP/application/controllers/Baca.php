<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baca extends CI_Controller {

    public function index($novel_name, $path)
    {
        // Here, you would have the logic to load the content
        // based on the novel name and path.
        // For now, let's just display the parameters.
        echo "Novel Name: " . $novel_name;
        echo "<br>";
        echo "Path: " . $path;
    }
}
