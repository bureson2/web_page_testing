<?php

/*!
    \version ZWA version
    \brief Class Category_model
    \author Olesia Cheremnykh
    \date 10.01.2021

    This model gets all category data from the database.

 */

class Category_model extends CI_Model{
    public function __construct(){
        $this->load->database(); ///Load the database library
    }

    ///Searches for a categories
    public function get_categories(){
        $this->db->order_by('name');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    ///Search for a category by id
    public function get_category($id){
        $query = $this->db->get_where('categories', array('id' => $id));
        return $query->row();
    }
}
