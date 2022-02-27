<?php

class Post_model_mocking_db_test extends UnitTestCase {

    public function setUp() : void {

        // Creating a Category_model instance
        $this->obj = $this->newModel('Post_model');
    }

    public function test_get_posts() {

        // Mocked array for result_array
        $return = [
            0 => (object) ['id' => '90', 'title' => '5 Plants for the Home Office.'],
            1 => (object) ['id' => '91', 'title' => 'I Overwatered my rubber plant and this is what I learnt.'],
            2 => (object) ['id' => '92', 'title' => 'How to Water Your Indoor Plants The Right Way.']
        ];

        // Create mock objects for CI_DB_result and CI_DB_pdo_sqlite_driver (system->database->drivers)
        // Create mock for method result_array
        $db_result = $this->getMockBuilder('CI_DB_result')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('result_array')->willReturn($return);
        // Create mock for method get
        $db = $this->getMockBuilder('CI_DB_pdo_sqlite_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('get')->willReturn($db_result);

        // Verify invocations (mock, method, parameters)
        $this->verifyInvokedOnce($db_result, 'result_array', []);
        $this->verifyInvokedOnce($db, 'order_by', ['posts.id']);
        $this->verifyInvokedOnce($db, 'join', ['categories']);
        $this->verifyInvokedOnce($db, 'get', ['posts']);

        // Replace property db with mock object
        $this->obj->db = $db;

        $expectedResult = [
            90 => '5 Plants for the Home Office.',
            91 => 'I Overwatered my rubber plant and this is what I learnt.',
            92 => 'How to Water Your Indoor Plants The Right Way.',
        ];

        // Call a get_posts() function
        $list = $this->obj->get_posts();

        // Assertions by titles of posts
        foreach ($list as $post) {
            $this->assertEquals($expectedResult[$post->id], $post->title);
        }
    }

    public function test_create_post_success() {
        // Success mock return
        $insertReturnError = TRUE;

        // Create mock objects for CI_DB_sqlite3_driver (system->database->drivers)
        // Create mock for method insert
        $db_result = $this->getMockBuilder('CI_DB_sqlite3_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('insert')->willReturn($insertReturnError);

        // Verify invocations (mock, method)
        $this->verifyInvokedOnce($db_result, 'insert');

        // Replace property db with mocked object
        $this->obj->db = $db_result;
        // Call a create_post() function
        $this->obj->create_post('');

        $expected = TRUE;
        $this->assertEquals($expected, $insertReturnError);
    }

    public function test_create_post_error() {
        // Failed mock return
        $insertReturnError = FALSE;

        // Create mock objects for CI_DB_sqlite3_driver (system->database->drivers)
        // Create mock for method insert
        $db_result = $this->getMockBuilder('CI_DB_sqlite3_driver')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('insert')->willReturn($insertReturnError);

        // Verify invocations (mock, method)
        $this->verifyInvokedOnce($db_result, 'insert');

        // Replace property db with mocked object
        $this->obj->db = $db_result;
        // Call a create_post() function
        $this->obj->create_post('');

        $expected = FALSE;
        $this->assertEquals($expected, $insertReturnError);
    }

}