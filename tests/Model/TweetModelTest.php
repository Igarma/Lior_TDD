<?php

use Twitter\Model\TweetModel;
use PHPUnit\Framework\TestCase;

class TweetModelTest extends TestCase {

    /** @test */
    public function itCanSaveATweet(){
        // setup:  buidem la taula tweet
        $pdo = new PDO('mysql:host=localhost; dbname=tdd; charset=utf8', 'eric','EricPwd145', [
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->query("DELETE FROM tweet");

        
        // Tenim un  autor i content
        $author = 'Ignasi';
        $content = "El tweet de  l'Ignasi";
        
        // quan el model es cridat per salvar
        $model = new TweetModel($pdo);
        $newTweetId = $model->save($author,$content);

        // espero trobar el id
        $this->assertNotNull($newTweetId);
        

        // espero trobar el tweet a la base de dades
        $tweet = $pdo->query("SELECT * FROM tweet WHERE id = " .$newTweetId . " Limit 1")->fetch();
        $this->assertNotFalse($tweet);
        
        $this->assertEquals($author, $tweet['author']);
        $this->assertEquals($content, $tweet['content']);
        
    }

}