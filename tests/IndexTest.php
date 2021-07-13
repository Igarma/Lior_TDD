<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase{

    /*
    public function testProvemElIndex(){
        // donana una situació
        $_GET['name']= "Eric";

        // passa op fem  X acció
        ob_start();
        include "index.php";
        $resultat = ob_get_clean();

        // Esperem obtenri
        $this->assertEquals("Bon dia Eric", $resultat); 
    }
    */
    public function test_homepage_says_hello(){
        // Given
        $_GET['name'] = "Eric";
        
        // When
        $controller = new \Twitter\Controller\HelloController();
        $response = $controller->Hello();
        
        // Then
        $this->assertEquals("Bon dia Eric", $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());

        $contenHeader = $response->getHeaders()['Content-Type'] ?? null;
        $this->assertEquals('text/html', $contenHeader);
    }
}
