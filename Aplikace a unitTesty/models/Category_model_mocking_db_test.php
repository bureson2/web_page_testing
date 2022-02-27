<?php

class Category_model_mocking_db_test extends UnitTestCase {

    public function setUp() : void {

        // Creating a Category_model instance
        $this->obj = $this->newModel('Category_model');
    }

    public function test_getAll_categories() {

        // Mocked array for result_array
        $return = [
            0 => (object) ['id' => '1', 'name' => 'Plant care'],
            1 => (object) ['id' => '2', 'name' => 'Lifehacks'],
            2 => (object) ['id' => '3', 'name' => 'Houseplants'],
            3 => (object) ['id' => '4', 'name' => 'Fertilizers'],
            4 => (object) ['id' => '5', 'name' => 'Plant diseases']
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
        $this->verifyInvokedOnce($db, 'order_by', ['name']);
        $this->verifyInvokedOnce($db, 'get', ['categories']);

        // Replace property db with mock object
        $this->obj->db = $db;

        $expectedResult = [
            1 => 'Plant care',
            2 => 'Lifehacks',
            3 => 'Houseplants',
            4 => 'Fertilizers',
            5 => 'Plant diseases',
        ];

        // Call a get_categories() function
        $list = $this->obj->get_categories();

        // Assertions by names of categories
        foreach ($list as $category) {
            $this->assertEquals($expectedResult[$category->id], $category->name);
        }
    }

    public function test_get_one_category() {

        // Array for row method
        $return = [
                'id' => '1',
                'name' => 'Plant care',
                'created_at' => '2020-12-22 15:19:24',
            ];

        // Create mock objects for CI_DB_result and CI_DB_query_builder (system->database->drivers)
        // Create mock for row method
        $db_result = $this->getMockBuilder('CI_DB_Result')
            ->disableOriginalConstructor()
            ->getMock();
        $db_result->method('row')->willReturn($return);
        // Create mock for get_where method
        $db = $this->getMockBuilder('CI_DB_query_builder')
            ->disableOriginalConstructor()
            ->getMock();
        $db->method('get_where')->willReturn($db_result);

        // Verify invocations (mock, method, parameters)
        $this->verifyInvokedOnce($db_result, 'row', []);
        $this->verifyInvokedOnce($db, 'get_where', ['categories', ['id' => '1']]);

        // Replace property db with mock object
        $this->obj->db = $db;

        $expectedResult = [
            'id' => '1',
            'name' => 'Plant care',
            'created_at' => '2020-12-22 15:19:24',
        ];
        // Call a get_category() function with id = '1'
        $output = $this->obj->get_category(1);
        // Assertion for category with id = '1'
        $this->assertEquals($expectedResult, $output);
    }
}