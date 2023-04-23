<?php

declare(strict_types=1);

namespace Soccer\Api\Controller;

class Error404Controller implements Controller
{
    public function processRequest(): void
    {
        http_response_code(404);   
    }

    public function store(): void
    {

    }
}
