<?php
use Twitter\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase{
    /** @test */
    public function we_can_instantiate_a_request(){
       $request = new Request([
           'author' => 'Eric',
           'content' => 'Un contingut qualsevol'
       ]);

       $this->assertEquals('Eric', $request->get('author'));
       $this->assertNull($request->get('inexistent'));

    }
}