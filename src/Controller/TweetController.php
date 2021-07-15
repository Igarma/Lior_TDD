<?php

namespace Twitter\Controller;

use Twitter\Http\Request;
use Twitter\Http\Response;
use Twitter\Model\TweetModel; 
use Twitter\Validation\RequestValidator;


class TweetController {

    protected $model;
    protected $requiredFields = ['author', 'content'];

    public function __construct( TweetModel $model){
        $this->model = $model;
    }
    
    public function  saveTweet(Request $request): Response {

        $validator = new RequestValidator();
        if($response = $validator->validateFields($request, $this->requiredFields)){
            return $response;
        }

        $this->model->save($request->get('author'), $request->get('content'));

        return new Response('',  ['Location' =>'/'], 302);
    }   


}