<?php

class ClearApi {
    private $api_key ;
    private $api_secret ;
    private $access_token;
    private $host ;

    /**
     * constructor.
     * Api id ,Api Key, access_token and host is set here
     */
    public function __construct(){
        //put your API Key and Secret in these two variables.
        $this->api_key      = "9Pmt5nnNT5fb1METsXry8eeEI1pkG8lD";
        $this->api_secret   = "1GibMh2kBCYLrF75";
        $this->access_token = $this->generateAuthToken();
        $this->host         = "https://api.awhere.com";
    }

    function generateAuthToken(){
        $ch = curl_init("https://api.awhere.com/oauth/token");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic ".base64_encode($this->api_key.":".$this->api_secret)
        ));

        $result = curl_exec($ch);
        $result = json_decode($result);
        if(isset($result->access_token)){
            $this->access_token =$result->access_token;
            return $result->access_token;
        }
        return NULL;
    }

    function getSingleField($fieldId){
        $data =  $this->createCurl('GET',[],"/v2/fields/{$fieldId}");
        return $data;
    }

    function getAllFields(){
        //Get all field
        $data =  $this->createCurl('GET',[],'/v2/fields');
        return $data;
    }

    function createField($fieldDetails){
        //Name and acres optional
        // id || farm id is generated because it must be unique
        // example data format
        $fieldDetails = [
            'id'      =>   'oluwas',
            'name'    =>   'sammie',
            'farmId'  =>   'farmid01',
            'acres'   =>    '44',
            'centerPoint' => [
                'latitude'   =>   '6.616865',
                'longitude'  =>   '3.508072'
            ]
        ];
        $response = $this->createCurl('POST',$fieldDetails,'/v2/fields');
        if($response[''])
            print_r($response);
        //Save to Database on success
    }

    function updateField($fieldId){

    }

    function createCurl($requestType="GET",$data,$uri){
        $http_headers = array(
            "Authorization: Bearer {$this->access_token} ",
            "Content-Type: application/json"
        );
        $url = $this->host.$uri;
        //die();
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
            // and the function returns FALSE
            if($response['statusCode']==401){
                $this->generateAuthToken();
                $this->createCurl($requestType,$data,$url);
            }
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

    function getWeatherForecastForToday($latitude,$longitude){
        $currentDate = date("Y-m-d",time());
        $response = $this->createCurl('GET',[
            "conditionsType" => "standard"
        ],
            "/v2/weather/locations/{$latitude},{$longitude}/forecasts/{$currentDate}/"
        );
        if(isset($response->statusCode)){
            if($response->statusCode ==401)
                $this->generateAuthToken();
            $this->getWeatherForecastForToday($latitude,$longitude);
        }
            return $response;
    }
}
$weatherApi = new ClearApi();

