<?php

namespace Twitter\Model;

use PDO;

class TweetModel {
    protected $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function save(string $author, string $content) {
        $query = $this->pdo->prepare("INSERT INTO tweet SET 
            content    = :content,
            author     = :author,
            created_at = NOW()");

        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        
        if ( $query->execute() ){
            $lastInsertId = $this->pdo->lastInsertId();
        }else{
            $lastInsertId = 0;
            echo $query->errorInfo()[2];
        }

        return $lastInsertId;
    }
}

