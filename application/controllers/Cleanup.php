<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cleanup extends CI_Controller {
    public function clear_old_sessions() {
        $path = APPPATH . 'cache/session'; // Path penyimpanan session

        if (!is_dir($path)) {
            echo "Session directory not found.";
            return;
        }

        foreach (glob($path . "/ci_session*") as $file) {
            if (filemtime($file) < (time() - 7200)) { // Hapus jika lebih dari 2 jam
                unlink($file);
            }
        }

        echo "Expired sessions deleted!";
    }
}

// kalem urg pull deui, bieu cigana can ka commit jal
// sok coba ball
// geus aman, cigana bieu ijal karak git add can commit