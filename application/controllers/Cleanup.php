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

// di urg ge sarua da jal terakhir commit na 9.04
// tapi urang commit pas ngabran iqbal naha teu muncul nya?
