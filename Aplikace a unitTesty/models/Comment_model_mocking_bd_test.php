<?php


class Comment_model_mocking_bd_test extends UnitTestCase {

    public function setUp() : void {

        // Creating a Category_model instance
        $this->obj = $this->newModel('Comment_model');
    }

    public  function test_get_comments() {

        $result = [
            0 => (object) ['id' => '1', 'post_id' => '11','name' => 'olesia', 'email' => 'chereole@fel.cvut.cz', 'body' => 'hello'],
            1 => (object) ['id' => '2', 'post_id' => '11','name' => 'dmitrii', 'email' => 'dmitrii@fel.cvut.cz', 'body' => 'hello2'],
            2 => (object) ['id' => '3', 'post_id' => '11','name' => 'tomas', 'email' => 'tomas@fel.cvut.cz', 'body' => 'hello3'],
        ];

        // Create mock objects for CI_DB_result and CI_DB_query_builder (system->database->drivers)
        // Create mock for method result_array
        $db_result = $this->getMockBuilder('CI_DB_Result')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('result_array')->willReturn($result);
        // Create mock for method get
        $db = $this->getMockBuilder('CI_DB_query_builder')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('get_where')->willReturn($db_result);

        // Verify invocations (mock, method, parameters)
        $this->verifyInvokedOnce($db_result, 'result_array', []);
        $this->verifyInvokedOnce($db, 'get_where', ['comments', ['post_id' => '11']]);

        // Replace property db with mock object
        $this->obj->db = $db;

        $expectedResult = [
            1 => 'hello',
            2 => 'hello2',
            3 => 'hello3',
        ];

        // Call a get_comments() function
        $list = $this->obj->get_comments(11);

        // Assertions by bodies of comments
        foreach ($list as $comment) {
            $this->assertEquals($expectedResult[$comment->id], $comment->body);
        }

    }


}