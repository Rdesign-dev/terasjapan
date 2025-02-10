<?php

class Brand extends CI_Controller {

    public function detail() 
    {
        $brandName = $this->input->get('brand_name');

        
        // TODO: check view is exist or not
        // $filePath = 'home/popup/' . $brandName;
        // $view = __DIR__ .'../views/' . $filePath . '.php';

        // var_dump(file_exists($view));
        // var_dump($view);
        // var_dump(APPPATH);
        // die();

        // if(file_exists($view)) {
        //     $this->load->view($filePath);
        // }

        $this->load->view('home/popup/' . $brandName);

    }

}