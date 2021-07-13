<?php

namespace Twitter\Controller;

use PDO;
use Twitter\Http\Response;
use Twitter\Model\TweetModel;

class TweetController {

    protected $pdo;
    protected $model;

    public function __construct(PDO $pdo, TweetModel $model){
        $this->pdo = $pdo;
        $this->model = $model;
    }
    
    public function  saveTweet(): Response {

        $this->model->save($_POST['author'], $_POST['content']);

        return new Response('',  ['Location' =>'/'], 302);
    }
}