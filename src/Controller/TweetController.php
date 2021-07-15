<?php

namespace Twitter\Controller;

use Twitter\Http\Request;
use Twitter\Http\Response;
use Twitter\Model\TweetModel; 

class TweetController {

    protected $model;
    protected $requiredFields = ['author', 'content'];

    public function __construct( TweetModel $model){
        $this->model = $model;
    }
    
    public function  saveTweet(Request $request): Response {
        if($response = $this->validateFields($request)){
            return $response;
        }

        $this->model->save($request->get('author'), $request->get('content'));

        return new Response('',  ['Location' =>'/'], 302);
    }   

    protected function validateFields(Request $request): ?Response {
        $invalidfields = [];
        foreach($this->requiredFields as $field){
            if($request->get($field) === null){
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