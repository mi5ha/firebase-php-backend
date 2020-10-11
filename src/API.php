<?php

namespace FirebaseBackend;

class API
{
    public static function response($success, $data = null, $errorMessages = null)
    {
        $response = [
            "success" => $success
        ];

        if (isset($data)) $response["data"] = $data;
        if (isset($errorMessages)) $response["errorMessages"] = $errorMessages;

        header('Content-Type: application/json');
        print_r(json_encode($response));
    }

    public static function getPostParams()
    {
        $jsonRequest = json_decode(file_get_contents('php://input'));
        return $jsonRequest ? $jsonRequest : null;
    }
}
