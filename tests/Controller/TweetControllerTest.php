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

    public function missingFieldsProvider(){
        //[ parametres a passar a un test]
        return [
            [['content' => "Test of tweet"],"Manca el camp author"]  ,
            [['author' => "Eric"]          ,"Manca el camp content"] ,
            [[]                            ,"Manquen els camps author, content"]
        ];

    }
    /**  @test
     *   @dataProvider missingFieldsProvider
    */
    public function itCanNotSaveATweetWhitMissingFields($postData, $errorMessage){
        //1:34:34 https://www.youtube.com/watch?v=h3_HzMgv1lQ&t=3685s
        $_POST = $postData;

        // al cridar al controlador
        $response = $this->controller->saveTweet();

        // espero una pagina d'error
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals($errorMessage, $response->getContent());

    }

}