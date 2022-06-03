<?php

namespace App\Controller;

use App\Services\RelDepartmentEmployeeService;
use App\Models\RelDepartmentEmployee;
use Slim\Http\Request;
use Slim\Http\Response;


class RelDepartmentEmployeeController extends BaseController {

    public function __construct() {
        parent::__construct(new RelDepartmentEmployeeService());
    }

    protected function getModelClassName(): string {
        return RelDepartmentEmployee::class;
    }

    public function getEmployees(Request $request, Response $response, $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;
        $result = null;
        try {
            $result = $this->service->getByDepartmentId($id);
            return $this->writeJson($response, $result);
        } catch (Exception $e) {
            $code = $e->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $e->getMessage()), $code);
        }
    }
    
     public function getDepartment(Request $request, Response $response, $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;
        $result = null;

        try {
            $result = $this->service->getByEmployeeId($id);
            return $this->writeJson($response, $result);
        } catch (Exception $e) {
            $code = $e->getCode();
            return $this->writeJson($response, array('status' => 'error', 'data' => $e->getMessage()), $code);
        }
    }
    
    

}
