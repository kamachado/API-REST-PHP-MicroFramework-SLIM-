<?php


namespace App\Controller;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

interface ControllerInterface {

    public function get(Request $request, Response $response, array $args);

    public function post(Request $request, Response $response);

    public function put(Request $request, Response $response, array $args);

    public function delete(Request $request, Response $response, array $args);
}
