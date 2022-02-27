<?php

class User_model_mocking_db_test extends UnitTestCase {

    public function setUp() : void {

        // Creating a Category_model instance
        $this->obj = $this->newModel('User_model');
    }

    public function test_login() {
        // Mocked array for result_array
        $return = [
            0 => (object) ['id' => '1', 'name' => 'Olesia', 'email' => 'chereole@fel.cvut.cz', 'username' => 'oles', 'password' => 'password1', 'register_date' => '2020-12-27 21:46:11'],
            1 => (object) ['id' => '2', 'name' => 'Ondrej', 'email' => 'bureson@fel.cvut.cz', 'username' => 'ondra', 'password' => 'password2', 'register_date' => '2020-12-28 21:46:11'],
            2 => (object) ['id' => '3', 'name' => 'Milan', 'email' => 'milan@fel.cvut.cz', 'username' => 'mila','password' => 'password3', 'register_date' => '2020-12-29 21:46:11']
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
        $this->verifyInvokedOnce($db, 'order_by', ['id']);
        $this->verifyInvokedOnce($db, 'get', ['users']);

        // Replace property db with mock object
        $this->obj->db = $db;

        $expectedResult = [
            1 => 'oles',
            2 => 'ondra',
            3 => 'mila',
        ];

        // Call a get_categories() function
        $list = $this->obj->get_all_users();

        // Assertions by usernames
        foreach ($list as $user) {
            $this->assertEquals($expectedResult[$user->id], $user->username);
        }
    }

}