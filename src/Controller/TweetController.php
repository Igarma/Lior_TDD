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
        $invalidfields = [];
        foreach($this->requiredFields as $field){
            if(empty($_POST[$field])){
                $invalidfields[] = $field;
            }
        }
        if(empty($invalidfields)){
            return null;
        }
        if(count($invalidfields) === 1){
            $field = $invalidfields[0];
            return new Response("Manca el camp $field",['Content-Type' => 'text/html'],400);
        }

        return new Response(
            sprintf('Manquen els camps %s',implode(', ',$invalidfields)),
            ['Content-Type' => 'text/html'],
            400
        );
    }
}