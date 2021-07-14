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
        if($response = $this->validateFields()){
            return $response;
        }

        $this->model->save($_POST['author'], $_POST['content']);

        return new Response('',  ['Location' =>'/'], 302);
    }   

    protected function validateFields(): ?Response {
        foreach($this->requiredFields as $field){
            if(empty($_POST[$field])){
                return new Response("Manca el camp $field",['Content-Type' => 'text/html'],400);
            }
        }
        return null;
    }
}