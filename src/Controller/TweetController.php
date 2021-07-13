<?php

namespace Twitter\Controller;

use PDO;
use Twitter\Http\Response;

class TweetController {
    
    public function  saveTweet(): Response {
        $pdo = new PDO('mysql:host=localhost; dbname=tdd; charset=utf8', 'eric','EricPwd145', [
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION
        ]);

        $query = $pdo->prepare("INSERT INTO tweet SET 
            content    = :content,
            author     = :author,
            created_at = NOW()");
        $query->execute([
            'content'  => $_POST['content'],
            'author'   => $_POST['author']
        ]);
        return new Response('',  ['Location' =>'/'], 302);
    }
}