<?php

class Posts_test extends TestCase {

    public function test_indexTitle() {
        // Act
        $output = $this->request('GET', 'posts/index');
        // Assert
        $this->assertStringContainsString('<h1>Latest Posts</h1>', $output);
    }

    public function test_indexDescription() {
        // Act
        $output = $this->request('GET', 'posts/index');
        // Assert
        $this->assertStringContainsString('<p class="description">Dont be shy, create your own post about your houseplant!</p>', $output);
    }
}