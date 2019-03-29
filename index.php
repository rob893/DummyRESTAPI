<?php
//This is a dummy API for testing
declare(strict_types = 1);

header('Access-Control-Allow-Origin: *');
header('Accept: application/json');


require("Response.php");
require("Request.php");
require("DummyService.php");


if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET)) {
    $request = new Request($_GET, "GET");
    $response = new Response();
    $dummyService = new DummyService();
    
    if($request->hasAttribute('CustomerID')) {
        $dummyService->getCustomer($request, $response);
    }
    else if($request->hasAttribute('Customers')) {
        $dummyService->getCustomers($request, $response);
    }
    else if($request->hasAttribute('DummyData')) {
        $dummyService->getDummyData($request, $response);
    }
    else if($request->hasAttribute('ProductID')) {
        $dummyService->getProduct($request, $response);
    }
    else if($request->hasAttribute('Products')) {
        $dummyService->getProducts($request, $response);
    }
    else {
        $dummyService->getAllData($request, $response);
    }
}
else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)) {
    $request = new Request($_POST, "POST");
    $response = new Response();
    $dummyService = new DummyService();
    
    $dummyService->postDummyData($request, $response);
}
else {
    http_response_code(400);
}

unset($_REQUEST);
unset($_GET);
unset($_POST);
