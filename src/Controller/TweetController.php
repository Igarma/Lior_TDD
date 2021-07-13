<?php

namespace Twitter\Controller;

use Twitter\Http\Response;
use Twitter\Model\TweetModel;

class TweetController {

    protected $model;

    public function __construct( TweetModel $model){
        $this->model = $model;
    }
    
    public function  saveTweet(): Response {

        $this->model->save($_POST['author'], $_POST['content']);

        return new Response('',  ['Location' =>'/'], 302);
    }
}