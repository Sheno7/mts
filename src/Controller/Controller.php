<?php

namespace Mts\Controller;

use Mts\Response\Response;

class Controller
{
    protected $response;

    public function __construct()
    {
        $this->response = new Response();
    }
}