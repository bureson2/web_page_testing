<?php

class User_Model_test extends TestCase {

    public function setUp() :void {

        // Creating a User_model instance
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->model('User_model');
    }

    public function test_registration() {

        // Arrange
        $data = array(
            'name' => "Olesia",
            'email' => "chereole@fel.cvut.cz",
            'username' => "chereole",
            'password' => "Hello12!",
            'register_date' => "2021-05-06 22:27:15"
        );
        // Act
        $result = $this->CI->db->insert('users', $data);
        // Assert
        $this->assertEquals(TRUE, $result);
    }

    public function test_correct_login() {

        // Arrange
        $username = "chereole";
        $password = "Hello12!";
        $expectedID = 38;
        // Act
        $resultID = $this->CI->User_model->login($username, $password); //return user id
        // Assert
        $this->assertEquals($expectedID, $resultID);
    }

    public function test_incorrect_login() {

        // Arrange
        $username = "chereole";
        $password = "wrongPass!";
        // Act
        $result = $this->CI->User_model->login($username, $password);
        // Assert
        $this->assertEquals(false, $result);
    }

    public function test_email_doesnt_exists() {

        // Arrange
        $notExistsEmail = "fake@mail.cz";
        // Act
        $InCorrectResult = $this->CI->User_model->check_email_exists($notExistsEmail);
        // Asserts
        $this->assertEquals(true, $InCorrectResult);
    }

    public function test_email_exists() {

        // Arrange
        $existsEmail = "chereole@fel.cvut.cz";
        // Act
        $CorrectResult = $this->CI->User_model->check_email_exists($existsEmail);
        // Asserts
        $this->assertNotEquals(true, $CorrectResult);
    }


    public function test_check_username_doesnt_exists() {

        // Arrange
        $notExistsUsername = "NotChereole";
        // Act
        $InCorrectResult = $this->CI->User_model->check_username_exists($notExistsUsername);
        // Asserts
        $this->assertEquals(true, $InCorrectResult);

    }

    public function test_check_username_exists() {

        // Arrange
        $existsUsername = "chereole";
        // Act
        $CorrectResult = $this->CI->User_model->check_username_exists($existsUsername);
        // Asserts
        $this->assertnotEquals(true, $CorrectResult);

    }


}