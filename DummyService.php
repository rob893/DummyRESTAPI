<?php
declare(strict_types = 1);


class DummyService {


    public function getAllData(Request $request, Response $response): Response {
        
        $dummyData = json_decode(file_get_contents("data.json"));

        if($dummyData != false) {
            $response->setResponseBody((array)$dummyData);
            $response->setStatusCode(200);
        }
        else {
            $response->setResponseBody(["message" => "Error opening data file."]);
            $response->setStatusCode(400);
        }
        
        $this->respondWithJSON($response);

        return $response;
    }

    public function getCustomer(Request $request, Response $response): Response {
        
        $dummyData = json_decode(file_get_contents("data.json"));

        if($dummyData != false) {
            $dataArray = get_object_vars($dummyData);

            if($request->hasAttribute("CustomerID") && array_key_exists("Customers", $dataArray)) {
                $customerID = $request->getAttribute("CustomerID")[0];
                $customers = $dataArray["Customers"];
                $customer = null;

                foreach($customers as $customerData) {
                    if($customerData->CustomerID == $customerID) {
                        $customer = get_object_vars($customerData);
                        break;
                    }
                }

                if($customer != null) {
                    $response->setResponseBody($customer);
                    $response->setStatusCode(200);
                }
                else {
                    $response->setResponseBody(["message" => "No customer exists with that id."]);
                    $response->setStatusCode(400);
                }
            }
            else {
                $response->setResponseBody(["message" => "Error obtaining customer information."]);
                $response->setStatusCode(400);
            }
        }
        else {
            $response->setResponseBody(["message" => "Error opening data file."]);
            $response->setStatusCode(400);
        }
        
        $this->respondWithJSON($response);

        return $response;
    }

    public function getDummyData(Request $request, Response $response): Response {
        $dummyData = json_decode(file_get_contents("data.json"));
        
        if($dummyData != false) {

            if($request->hasAttribute("DummyData")) {

                $response->setResponseBody(["DummyData" => $dummyData->DummyData]);
                $response->setStatusCode(200);
            }
            else {
                $response->setResponseBody(["message" => "The payload is missing the DummyData attribute."]);
                $response->setStatusCode(400);
            }
        }
        else {
            $response->setResponseBody(["message" => "Error opening data file."]);
            $response->setStatusCode(400);
        }
        
        $this->respondWithJSON($response);

        return $response;
    }

    public function postDummyData(Request $request, Response $response): Response {
        $dummyData = json_decode(file_get_contents("data.json"));

        if($dummyData != false) {

            if($request->hasAttribute("DummyData")) {
                $dummyData->DummyData = $request->getAttribute("DummyData");

                $data = json_encode($dummyData);
                file_put_contents("data.json", $data);

                $response->setResponseBody(["message" => "DummyData saved."]);
                $response->setStatusCode(200);
            }
            else {
                $response->setResponseBody(["message" => "The payload is missing the DummyData attribute."]);
                $response->setStatusCode(400);
            }
        }
        else {
            $response->setResponseBody(["message" => "Error opening data file."]);
            $response->setStatusCode(400);
        }
        
        $this->respondWithJSON($response);

        return $response;
    }

    private function respondWithJSON(Response $response) {
        $response->addHeader('Content-type: application/json');
        
        foreach($response->getHeaders() as $header) {
            header($header);
        }

        http_response_code($response->getStatusCode());

        echo $response->getBodyAsJSON();
    }
}