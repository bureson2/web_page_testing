<?php

class Post_Model_test extends TestCase {

    public function setUp() :void {

        // Creating a Post_model instance
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->model('Post_model');
    }

//    public function test_get_posts_emptySlug() {
//
//        // Arrange
//        $expectedCount = 48;
//        // Act
//        $result = $this->CI->Post_model->get_posts();
//        // Assert
//        $this->assertCount($expectedCount, $result);
//    }

    public function test_get_posts_with_slug() {

        // Arrange
        $expectedTitle = 'SlugTest';
        // Act
        $result = $this->CI->Post_model->get_posts("SlugTest", FALSE, FALSE);
        // Assert
        $this->assertEquals($expectedTitle, $result['title']);
    }

//    public function test_create_post() {
//
//        // Arrange
//        $data = array(
//            'title' => "testTitle",
//            'slug' => "testTitle",
//            'body' => "testBody",
//            'category_id' => "1",
//            'user_id' => "13",
//            'post_image' => "noimage.png",
//            'created_at' => "2021-05-06 22:27:15"
//        );
//        // Act
//        $result = $this->CI->db->insert('posts', $data);
//        // Assert
//        $this->assertEquals(TRUE, $result);
//    }

}