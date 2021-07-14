<?php

use PDO;
use Twitter\Model\TweetModel;
use PHPUnit\Framework\TestCase;
use Twitter\Controller\TweetController;

class TweetControllerTest extends TestCase {
    protected  $pdo;
    protected  $model;
    protected  $controller;

    protected function setUp(): void {
        // setup:  buidem la taula tweet
        $this->pdo = new PDO('mysql:host=localhost; dbname=tdd; charset=utf8', 'eric','EricPwd145', [
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION
        ]);
        
        $this->model = new TweetModel($this->pdo);
        $this->controller =  new TweetController($this->model);
        
        // setup:  buidem la taula tweet
        $this->pdo->query("DELETE FROM tweet");
        //netegem les globals
        $_POST=[];
        $_GET=[];
    }

    /** @test */
    public function userCanSaveATweet(){


        // Tenim una Request POST a /tweet.php 
        // la Request conté els paràmetres autor i contingut
        $_POST['author'] = 'Eric';
        $_POST['content'] = "El meu primer tweet";

        // quan el controller es cridat
        $response = $this->controller->saveTweet();

        // espero ser dirigit a /
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('Location', $response->getHeaders());
        $this->assertEquals('/',$response->getHeaders()['Location']);

        // espero trobar un tweet a la base de dades
        $result = $this->pdo->query('SELECT t.* FROM tweet AS t');
        $this->assertEquals(1, $result->rowCount());

        // espero que el tweet tingui el auto i el contingut passat

    }

    /**   @test    */
    public function itCanNotSaveATweetWhithoutAuthor(){
        // Tenim $_POST però sense author 
        $_POST['content'] = "Tweet de prova";

        // al cridar al controlador
        $response = $this->controller->saveTweet();

        // espero una pagina d'error
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals("Manca el camp author", $response->getContent());
    }

    /**   @test    */
    public function itCanNotSaveATweetWhithoutContent(){
        // Tenim $_POST però sense content 
        $_POST['author'] = "Eric";

        // al cridar al controlador
        $response = $this->controller->saveTweet();

        // espero una pagina d'error
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals("Manca el camp content", $response->getContent());
    }
}