<?php
/*!
    \version ZWA version
    \brief Class User_model
    \author Olesia Cheremnykh
    \date 10.01.2021

    This model receives data from the user and allows him to register in the system and log in.
    Also checks if the database already has users with the same nickname or email
 */
class User_model extends CI_Model{
    public function register($enc_password){
        $time = date('Y-m-d H:i:s');
        ///User data array
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
            'register_date' => $time
        );

        ///Insert user
        return $this->db->insert('users', $data);
    }

    ///Log user in
    public function login($username, $password){
        ///Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('users');

        if($result->num_rows() > 0){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function get_all_users() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('users');
        return $query->result_array();
    }

    ///Check if username exists
    public function check_username_exists($username){
        $query = $this->db->get_where('users', array('username' => $username));
        if(empty($query->row_array())){
            return true;
        } else {
            return false;
        }
    }

    /// Check if not email exists
    public function check_email_exists($email){
        $query = $this->db->get_where('users', array('email' => $email));
        if(empty($query->row_array())){
            return true;
        } else {
            return false;
        }
    }
}