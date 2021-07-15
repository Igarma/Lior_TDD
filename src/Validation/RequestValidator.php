<?php

namespace Twitter\Validation;

use Twitter\Http\Request;
use Twitter\Http\Response;

class RequestValidator {
    public function validateFields(Request $request, array $requiredFields): ?Response {
        $invalidfields = [];
        foreach($requiredFields as $field){
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
