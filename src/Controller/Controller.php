<?php

declare(strict_types=1);

namespace Soccer\Api\Controller;

interface Controller
{
    public function processRequest(): void;
    public function store(): void;
}
