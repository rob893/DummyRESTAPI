<?php
declare(strict_types = 1);

class Response {

    private $statusCode;
    private $headers;
    private $body;


    public function setStatusCode(int $statusCode) {
        $this->statusCode = $statusCode;
    }

    public function setResponseBody(array $body) {
        $this->body = $body;
    }

    public function addHeader(string $header) {
        $this->headers[] = $header;
    }

    public function addHeaders(array $headers) {
        foreach($headers as $header) {
            $this->headers[] = $header;
        }
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function getBody(): array {
        return $this->body;
    }

    public function getBodyAsJSON(): string {
        return json_encode($this->body);
    }

    public function getHeaders(): array {
        return $this->headers;
    }
}