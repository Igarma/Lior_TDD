<?php

namespace Twitter\Controller;

use Twitter\Http\Response;

class HelloController{

    public function Hello(): Response {
        $name = $_GET['name'];
        return new Response("Bon dia $name");
    }
}