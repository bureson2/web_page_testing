<?php
/*!
    \version ZWA version
    \brief Class Comment_model
    \author Olesia Cheremnykh
    \date 10.01.2021

    This model collects data from the user and allows to create a new comment
    and get all comments from the post.
 */
class Comment_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    ///Create comment on post
    public function create_comment($post_id){
        $time = date('Y-m-d H:i:s');

        $data = array(
            'post_id' => $post_id,
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'body' => $this->input->post('body'),
            'created_at' => $time
        );

        return $this->db->insert('comments', $data); ///Insert comment in comments table
    }

    ///Get all comments on post
    public function get_comments($post_id){
        $query = $this->db->get_where('comments', array('post_id' => $post_id));
        return $query->result_array();
    }
}