<?php

namespace Twitter\Controller;

use PDO;
use Twitter\Http\Response;
use Twitter\Model\TweetModel;

class TweetController {

    protected $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    
    public function  saveTweet(): Response {

        $model = new TweetModel($this->pdo);
        $model->save($_POST['author'], $_POST['content']);

        return new Response('',  ['Location' =>'/'], 302);
    }
}