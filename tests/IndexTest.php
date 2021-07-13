<?php

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase{


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
    
}
