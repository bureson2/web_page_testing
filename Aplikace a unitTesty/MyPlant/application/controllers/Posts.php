<?php
/*!
    \version ZWA version
    \brief Class Posts
    \author Olesia Cheremnykh
    \date 10.01.2021

    There are described methods for initializing pagination, displaying posts on a page from the database,
    creating, deleting and editing posts.
*/
class Posts extends CI_Controller
{
    ///Show posts with pagination

    public function index($offset = 0)
    {
        /// Pagination Config
        $config['base_url'] = base_url() . 'posts/index/';
        $config['total_rows'] = $this->db->count_all('posts');
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;
        $config['attributes'] = array('class' => 'pagination-link');

        /// Init Pagination
        $this->pagination->initialize($config);

        $data['title'] = 'Latest Posts';

        ///Get posts data from database with a limit of 3 on page
        $data['posts'] = $this->post_model->get_posts(FALSE, $config['per_page'], $offset);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');

    }

    ///Displaying a post with comments on a page
    public function view($slug = NULL)
    {
        $data['post'] = $this->post_model->get_posts($slug); ///Get post by slug from db
        $post_id = $data['post']['id'];
        $data['comments'] = $this->comment_model->get_comments($post_id); ///Get comments from db

        ///Check if empty
        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'];

        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }
    ///Create new post
    public function create()
    {
        /// Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['title'] = 'Create your post!';
        $data['categories'] = $this->post_model->get_categories(); //Get categories from db

        ///Setting validation rules -> (field, label, rules)
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() === FALSE) { ///If validation was unsuccessful
            ///Reload
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);

        } else {
            ///Upload Image
            ///Conditions
            $config['upload_path'] = './assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|png|PNG';
            $config['max_size'] = '2048';
            $config['max_width'] = '2000';
            $config['max_height'] = '2000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) { //If file wasn't uploaded
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.png';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = $_FILES['userfile']['name']; ///Name of the file on the client machine
            }

            $this->post_model->create_post($post_image); ///create post with uploaded(or not) image
            redirect('posts');
        }
    }
    ///Delete post
    public function delete($id)
    {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post_model->delete_post($id);
        redirect('posts');
    }
    ///Edit post view
    public function edit($slug)
    {
        $data['title'] = 'Edit Post';
        $data['post'] = $this->post_model->get_posts($slug); ///Get post by slug
        $data['categories'] = $this->post_model->get_categories(); ///Get all categories

        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        // Check user
        if ($this->session->userdata('user_id') != $this->post_model->get_posts($slug)['user_id']) {
            redirect('posts');
        }

        //Check if empty
        if (empty($data['post'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);

    }
    ///Updating post with new data
    public function update(){
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $slug = url_title($this->input->post('title')); ///Get slug from inputted title

        $data['post'] = $this->post_model->get_posts($slug); ///Get post by slug
        $data['categories'] = $this->post_model->get_categories(); ///Get all categories
        $data['title'] = 'Edit Post';

        ///Setting validation rules -> (field, label, rules)
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() === FALSE) { ///If validation was unsuccessful
            $this->load->view('templates/header');
            $this->load->view('posts/edit', $data);

        } else {
            $this->post_model->update_post();
            redirect('posts');
        }
    }

}