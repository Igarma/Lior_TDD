<?php

use PHPUnit\Framework\TestCase;

class TweerCotrollerTest extends TestCase {

    /** @test */
    public function userCanSaveATweet(){
        // setup:  buidem la taula tweet
        $pdo = new PDO('mysql:host=localhost; dbname=tdd; charset=utf8', 'eric','EricPwd145', [
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->query("DELETE FROM tweet");

        
        // Tenim una Request POST a /tweet.php 
        // la Request conté els paràmetres autor i contingut
        $_POST['author'] = 'Eric';
        $_POST['content'] = "El meu primer tweet";

        // quan el controller es cridat
        $controller = new \Twitter\Controller\TweetController($pdo);
        $response = $controller->saveTweet();

        // espero ser dirigit a /
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('Location', $response->getHeaders());
        $this->assertEquals('/',$response->getHeaders()['Location']);

        // espero trovar un tweet a la base de dades
        
        $result = $pdo->query('SELECT t.* FROM tweet AS t');
        $this->assertEquals(1, $result->rowCount());

        // espero que el tweet tingui el auto i el contingut passat



        
    }

}