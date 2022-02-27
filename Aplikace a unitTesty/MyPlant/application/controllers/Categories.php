<?php
    /*!
    \version ZWA version
    \brief Class Categories
    \author Olesia Cheremnykh
    \date 10.01.2021

    Here are the methods for finding categories and finding posts by a given category

    */
    class Categories extends CI_Controller{

        public function index(){

            $data['title'] = 'Categories';
            $data['categories'] = $this->category_model->get_categories();

            ///Load categories
            $this->load->view('templates/header');
            $this->load->view('categories/index', $data);
        }

        ///Search for posts by category
        public function posts($id){
            $data['title'] = $this->category_model->get_category($id)->name;
            $data['posts'] = $this->post_model->get_posts_by_category($id);

            ///Load posts with selected category
            $this->load->view('templates/header');
            $this->load->view('posts/index', $data);
            $this->load->view('templates/footer');
        }
    }
