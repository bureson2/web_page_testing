<?php


class Welcome_test extends TestCase
{
    public function test_index() {
        $output = $this->request('GET', 'welcome/index');
        $this->assertStringContainsString('<title>Welcome to CodeIgniter</title>', $output);
    }
}