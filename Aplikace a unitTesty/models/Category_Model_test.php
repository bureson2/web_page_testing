<?php

class Category_Model_test extends TestCase
{
    protected $CI;

    public function setUp() :void {

        // Creating a Category_model instance
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->model('Category_model');

    }

    public function testGetsAllCategories() {

        // Arrange
        $expectedCount = 5;
        // Act
        $allCategories = $this->CI->Category_model->get_categories();
        // Assert
        $this->assertCount($expectedCount, $allCategories);
    }

    public function testGetCategory() {

        // Arrange
        $categoryID = 2;
        $expectedName = "Lifehacks";
        // Act
        $category = $this->CI->Category_model->get_category($categoryID);
        // Assert
        $this->assertEquals($expectedName, $category->name);
    }

}