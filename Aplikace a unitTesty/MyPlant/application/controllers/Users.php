<?php
/*!
    \version ZWA version
    \brief Class Users
    \author Olesia Cheremnykh
    \date 10.01.2021

    Here are the methods that allow the user to register in the system, log in with his username and log out.
    It also describes password hashing and validation for forms.
*/
class Users extends CI_Controller{
    /// Register user
    public function register(){
        $data['title'] = 'Sign Up';

        ///Setting validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|callback_check_username_exists|trim');
        $this->form_validation->set_rules('email', 'Email', 'callback_check_email_exists|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passwordConfirmation', 'Confirm Password', 'matches[password], required|min_length[5]');

        if($this->form_validation->run() === FALSE){ ///If validation was unsuccessful
            $this->load->view('templates/header');
            $this->load->view('users/register', $data);

        } else {
            ///Encrypt password
            $enc_password = md5($this->input->post('password'));

            $this->user_model->register($enc_password);

            ///Set message
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('home');
        }
    }

    ///Log in user
    public function login(){
        $data['title'] = 'Sign In';

        ///Setting validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);

        } else {

            ///Get username
            $username = $this->input->post('username');
            ///Get and encrypt the password
            $password = md5($this->input->post('password'));

            ///Login user
            $user_id = $this->user_model->login($username, $password);

            if($user_id){
                ///Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);

                ///Set message
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('home');

            } else {
                ///Set message
                $this->session->set_flashdata('login_failed', ' Invalid Login or password.');

                redirect('users/login');
            }
        }
    }

    ///Log user out
    public function logout(){
        ///Unset sessions
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        ///Set message
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');

        redirect('users/login');
    }

    ///Check if username exists
    public function check_username_exists($username){
        $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
        if($this->user_model->check_username_exists($username)){
            return true;
        } else {
            return false;
        }
    }

    ///Check if email exists
    public function check_email_exists($email){
        if($email == NULL){
            return true;
        }
        $this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
        if($this->user_model->check_email_exists($email)){
            return true;
        } else {
            return false;
        }
    }
}