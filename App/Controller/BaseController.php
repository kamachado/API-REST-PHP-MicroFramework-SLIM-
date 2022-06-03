<?php

namespace App\Controller;

use Exception;
use RuntimeException;
use ReflectionObject;
use App\Services\ServiceInterface;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

abstract class BaseController implements ControllerInterface {

    protected ServiceInterface $service;

    function __construct(ServiceInterface $service) {
        $this->service = $service;
    }

   protected function writeJson(Response $response, $data, $code = null): Response {
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        if ($json === false) { // Ensure that the json encoding passed successfully
            throw new RuntimeException(json_last_error_msg(), json_last_error());
        }

        $response->getBody()->write($json);
        $responseWithJson = $response->withHeader('Content-Type', 'application/json');
        if (isset($code) && $code > 0) {
            return $responseWithJson->withStatus($code);
        }
        return $responseWithJson;
    }




     public function get(Request $request, Response $response, $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;
        $result = null;
        try {
            if ($id) {
                $result = $this->service->getById($id);
            } else {
                $result = $this->service->getList();
            }
            return $this->writeJson($response, $result);
        } catch (Exception $e) {
            $code = $e->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $e->getMessage()), $code);
        }
    }




    public function post(Request $request, Response $response) {
        $data = json_decode(file_get_contents('php://input'));
        try {
            $obj = self::cast($this->getModelClassName(), $data);
            $result = $this->service->insert($obj);
            return $this->writeJson($response, $result);
        } catch (Exception $ex) {
            $code = $ex->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $ex->getMessage()), $code);
        }
    }

    public function put(Request $request, Response $response, array $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;
        try {
            if (!$id) {
                throw new Exception("Invalid Id", 400);
            }

            $data = json_decode(file_get_contents('php://input'));
            $item = $this->service->getById($id);
            if (!$item) {
                throw new Exception("Item não encontrado", 404);
            }

            $obj = self::cast($item, $data);
            $result = $this->service->update($id, $obj);
            return $this->writeJson($response, $result);
        } catch (Exception $e) {
            $code = $e->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $e->getMessage()), $code);
        }
    }

    public function delete(Request $request, Response $response, array $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;
        try {
            if (!$id) {
                throw new Exception("Invalid Id", 400);
            }
            $result=$this->service->remove($id);
            
            return $this->writeJson($response->withStatus(200), $result);
        } catch (Exception $e) {
            $code = $e->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $e->getMessage()), $code);
        }
    }

    protected static function cast($destination, $sourceObject) {
        if (is_string($destination)) {
            $destination = new $destination();
        }
        $sourceReflection = new ReflectionObject($sourceObject);
        $destinationReflection = new ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination, $value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }

    protected abstract function getModelClassName(): string;
}
