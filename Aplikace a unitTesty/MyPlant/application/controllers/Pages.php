<?php
/*!
    \version ZWA version
    \brief Class Pages
    \author Olesia Cheremnykh
    \date 10.01.2021

    The view method for displaying pages (if they exists) is described here.
*/
class Pages extends CI_Controller{
    ///Setting pages
    public function view($page = 'home'){
        ///Check if page exists
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }

        ///Make a string's first character uppercase
        $data['title'] = ucfirst($page);

        ///Load views
        $this->load->view('templates/header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }
}