<?php

namespace App\Middlewares;

use App\Core\AppException;

class ErrorHandlerMiddleware {

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next) {
        try {
            return $next($request, $response);
        } catch (AppException $e) {
            $code = $e->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $e->getMessage()), $code);
        }
    }

    /**
     * 
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param type $data
     * @param type $code
     * @return \Psr\Http\Message\ResponseInterface
     * @throws RuntimeException
     */
    protected function writeJson($response, $data, $code = null) {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        if ($json === false) { // Ensure that the json encoding passed successfully
            throw new RuntimeException(json_last_error_msg(), json_last_error());
        }

        $response->getBody()->write($json);
        $responseWithJson = $response->withHeader('Content-Type', 'application/json');
        if (isset($code)) {
            return $responseWithJson->withStatus($code);
        }
        return $responseWithJson;
    }

}
