<?php

namespace Twitter\Http;

class Response{
    protected  $content = '';
    protected  $headers = [];
    protected  $statusCode = 200;

    public function __construct(string $content = '', 
                                array $headers = ['Content-Type' => 'text/html'], 
                                int $statusCode = 200){
        $this->content = $content;
        $this->headers = $headers;
        $this->statusCode = $statusCode;
        
    }
 
    /**
     * Get the value of content
     */ 
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of headers
     */ 
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return  self
     */ 
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get the value of statusCode
     */ 
    public function getStatusCode() : int
    {
            return $this->statusCode;
    }

    /**
     * Set the value of statusCode
     *
     * @return  self
     */ 
    public function setStatusCode($statusCode)
    {
            $this->statusCode = $statusCode;

            return $this;
    }

    public function send()  {
        // enviar capceleres
        foreach ($this->headers as $key => $value){
            header("$key: $value");
        }

        // enviar statusCode
        http_response_code($this->statusCode);


        // Enviar contingut
        echo $this->content;
    }


    
}