<?php

namespace Twitter\Controller;

use Twitter\Http\Response;
use Twitter\Model\TweetModel;

class TweetController {

    protected $model;
    protected $requiredFields = ['author', 'content'];

    public function __construct( TweetModel $model){
        $this->model = $model;
    }
    
    public function  saveTweet(): Response {
        foreach($this->requiredFields as $field){
            if(empty($_POST[$field])){
                return new Response("Manca el camp $field",[],400);
            }
        }
        $this->model->save($_POST['author'], $_POST['content']);

        return new Response('',  ['Location' =>'/'], 302);
    }
}