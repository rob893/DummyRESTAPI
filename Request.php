<?php
declare(strict_types = 1);

class Request {

    private $params;
    private $requestType;


    public function __construct(array $params, string $requestType) {
        $this->params = $params;
        $this->requestType = $requestType;
    }

    public function getRequestParams(): array {
        return $this->params;
    }

    public function getRequestType(): string {
        return $this->requestType;
    }

    public function hasAttribute(string $attributeName): bool {
        return array_key_exists($attributeName, $this->params);
    }

    public function getAttribute(string $attributeName): array {
        if($this->hasAttribute($attributeName)) {
            return (array)$this->params[$attributeName];
        }
        else {
            throw new \Exception("Attribute not found.");
        }
    }
}