<?php

namespace Twitter\Http;


class Request{

    protected $data = array();

    public function __construct(array $data = []){
        $this->data = $data;
    }
    public function get(string $key){
        return $this->data[$key] ?? null;
    }
}