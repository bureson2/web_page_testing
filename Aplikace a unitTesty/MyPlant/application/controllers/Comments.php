<?php
/*!
    \version ZWA version
    \brief Class Comments
    \author Olesia Cheremnykh
    \date 10.01.2021

    Methods for creating comments and their validation are described here.
    */
class Comments extends CI_Controller{
    ///Create comment
    public function create($post_id){
        $slug = $this->input->post('slug');
        $data['post'] = $this->post_model->get_posts($slug);

        ///Setting validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('email', 'Email, valid_email|trim');
        $this->form_validation->set_rules('body', 'Body', 'required');


        if($this->form_validation->run() === FALSE){ ///If validation was unsuccessful -> reload
            $this->load->view('templates/header');
            $this->load->view('posts/view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->comment_model->create_comment($post_id);
            redirect('posts/'.$slug);
        }
    }
}