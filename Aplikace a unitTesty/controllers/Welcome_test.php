<?php

class Welcome_test extends TestCase {

    // Test to get title from welcome page
	public function test_index() {
        // Act
		$output = $this->request('GET', 'welcome/index');
        // Assert
		$this->assertStringContainsString('<title>Welcome to CodeIgniter</title>', $output);
	}

	// Test to get a 404 code from a non-existent page
	public function test_method_404() {
        // Act
		$this->request('GET', 'welcome/method_not_exist');
        // Assert
		$this->assertResponseCode(404);
	}

	// Test to compare application folder path (configured and valid)
	public function test_APPPATH() {
        // Arrange
		$actual = realpath(APPPATH); // Path to application
		$expected = realpath(__DIR__ . '/../..');
        // Assert
		$this->assertEquals($expected, $actual,
			'Your APPPATH seems to be wrong' // Message
		);
	}
}
