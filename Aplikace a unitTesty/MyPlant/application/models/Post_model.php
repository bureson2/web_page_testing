<?php
/*!
    \version ZWA version
    \brief Class Post_model
    \author Olesia Cheremnykh
    \date 10.01.2021

    This model allows to find all posts in the database according to the specified parameters,
    get data from the user and create a new post with adding a picture.
    Also removes a post from the database and allows user to edit it.
 */
class Post_model extends CI_Model{
    public function __construct(){
        $this->load->database(); ///Load the database library
    }
    ///Searches for a post with the specified parameters
    public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE){
        if($limit){
            $this->db->limit($limit, $offset);
        }
        if($slug === FALSE){
            $this->db->order_by('posts.id', 'DESC'); ///Posts.id in descending order
            $this->db->join('categories', 'categories.id = posts.category_id'); ///Combine columns
            $query = $this->db->get('posts'); ///Retrieve all records from a 'posts' table
            return $query->result_array();
        }
        $query = $this->db->get_where('posts', array('slug' => $slug)); ///The sql where clause
        return $query->row_array();
    }

    ///Adding post with image to db
    public function create_post($post_image){
        $time = date('Y-m-d H:i:s');
        $slug = url_title($this->input->post('title'));
        ///Get array by inputted data
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
            'user_id' => $this->session->userdata('user_id'),
            'post_image' => $post_image,
            'created_at' => $time
        );

        return $this->db->insert('posts', $data); ///Add to db
    }

    ///Delete post and image
    public function delete_post($id){
        $image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
        $cwd = getcwd(); ///Gets the current working directory
        $image_file_path = $cwd."\\assets\\images\\posts\\";
        chdir($image_file_path); ///Change directory

        ///Delete image file
        if($image_file_name != 'noimage.png'){
            unlink($image_file_name);
        }

        chdir($cwd); ///Restore the previous working directory

        //Delete post from db
        $this->db->where('id', $id);
        $this->db->delete('posts');
        return true;
    }

    ///Update post with new data
    public function update_post(){
        $slug = url_title($this->input->post('title'));
        $time = date('Y-m-d H:i:s');


        ///Get array by inputted data
        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'body' => $this->input->post('body'),
            'category_id' => $this->input->post('category_id'),
            'created_at' => $time
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }
    ///Searches for a category
    public function get_categories(){
        $this->db->order_by('name');
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    ///Searches for posts by category
    public function get_posts_by_category($category_id){
        $this->db->order_by('posts.id', 'DESC'); ///Posts.id in descending order
        $this->db->join('categories', 'categories.id = posts.category_id'); ///Combine columns
        $query = $this->db->get_where('posts', array('category_id' => $category_id));
        return $query->result_array();
    }

}