<?php

class NewsApi {
    private $api_key ;
    private $host;

    function __construct(){
        $this->api_key  =   '27fbd5368edc4c53820f87f8cb8f66bf';
        $this->host     =   'https://newsapi.org/v2/';
    }

    function getAllTopics(){
        $response = $this->createCurl('GET',[],'everything?q=agric');
        return $response;
    }

    function createCurl($requestType="GET",$data,$uri){
        $http_headers = array(
            "Content-Type: application/json"
        );
        $url = $this->host.$uri."&apiKey={$this->api_key}";
        // Set up the cURL request
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestType);
        curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $http_headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        $response = curl_exec($curl);
        if($response === false){
            // if the curl_exec() fails for reason, it means it could not even reach the aWhere server
            echo 'cURL Transport Error (HTTP request failed): '.curl_error($curl);
            die();
        } else {
            // curl_getinfo() returns information about the HTTP transaction, used
            // mainly here for getting the status code.
            $info = curl_getinfo($curl);
            $httpStatusCode = $info['http_code'];

            //The cURL settings above will include the HTTP headers in the response
            //This next command explodes the headers into one variable and the actual API response in another
            list($responseHeaders, $responseBody) = explode("\r\n\r\n", $response, 2);

            //Finally, we use json_decode to transform the API response into a native PHP object.
            $result = json_decode($responseBody);
        }
        curl_close($curl);
        return $result;
    }
}