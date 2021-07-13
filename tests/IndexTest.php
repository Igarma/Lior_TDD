<?php

use PHPUnit\Framework\TestCase;
use Twitter\Controller\HelloController;

class IndexTest extends TestCase{

    protected function setUp(): void{ // sobrecarragem la funció de TestCase
        $this->controller = new HelloController();
    }

    public function test_homepage_says_hello(){
        // Given
        $_GET['name'] = "Eric";
        
        // When
        $response = $this->controller->Hello();
        
        // Then
        $this->assertEquals("Bon dia Eric", $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());

        $contenHeader = $response->getHeaders()['Content-Type'] ?? null;
        $this->assertEquals('text/html', $contenHeader);
    }

    /** @test */
    public function testItWorksEvenIfNoNameInGet(){
        // Given
        $_GET = []; // buidem les superglobals

        // When
        $response = $this->controller->Hello();
        
        // Then
        $this->assertEquals("Bon dia a tots", $response->getContent());

    }
}
