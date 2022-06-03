<?php

namespace App\Controller;


use App\Models\Person;
use App\Services\PersonService;
use App\Services\ServiceInterface;
use Exception;
use App\StringUtils;
use mhndev\slimFileResponse\FileResponse;
use Slim\Http\Response;
use Slim\Http\Request;
use Slim\Http\UploadedFile;

class PersonController extends BaseController {
    
   protected ServiceInterface $service;
   
    public function __construct() {
        $this->service = new PersonService();
        parent::__construct($this->service);
    }


    protected function getModelClassName(): string {
        return Person::class;
    }

    public function getPhoto(Request $request, Response $response, $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;

        $personPhoto = $this->service->getPhoto($id);

        
        if ($personPhoto->Photo) {
            return $response->withHeader("Content-Type", $personPhoto->MimeType)->write($personPhoto->Photo);
        }

        throw new Exception("Foto não encontrada", 404);
    }

    public function deletePhoto(Request $request, Response $response, $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;

   
        return $response;
    }

    public function postPhoto(Request $request, Response $response, $args) {
        $id = array_key_exists('id', $args) ? $args['id'] : null;

        $uploadedFiles = $request->getUploadedFiles();

        

        foreach ($uploadedFiles as $uploadedFile) {
            /* @var $uploadedFile UploadedFile */
            $this->validateUploadedFile($uploadedFile);

            $ext = self::getExtensionFile($uploadedFile);

            //$uploadedFile->moveTo(self::PHOTO_DIRECTORY . "$id.$ext");
            $data = file_get_contents($uploadedFile->file);
            
           
       
            return $this->service->savePhoto($id, $uploadedFile->getClientMediaType(), $data);
        }
        return $response;
    }

   
    

    private function validateUploadedFile(UploadedFile $uploadedFile) {
        // UPLOAD_ERR_OK -> Código de erro do próprio PHP que informa que não houve erros no upload do arquivo. Retorna um int 0.
        if ($uploadedFile->getError() != UPLOAD_ERR_OK) {
            //tratativas do erro de upload irão aqui
            throw new AppException("Erro no upload do arquivo!", 500);
        }

        $mediaType = $uploadedFile->getClientMediaType();
        if (StringUtils::startsWith($mediaType, "image/") === false) {
            throw new AppException("O arquivo deve ser uma imagem", 400);
        }

        $size = $uploadedFile->getSize();
        $sizeLimit = 1024 * 1024; //1MB        
        if ($size > $sizeLimit) {
            throw new AppException("O arquivo deve ser menos que 1MB", 400);
        }
    }

    private static function getExtensionFile(UploadedFile $uploadedFile): string {

        $mimeType = $uploadedFile->getClientMediaType();

        switch ($mimeType) {
            case "image/jpeg":
            case "image/jpg":
                return "jpg";
            case "image/png":
                return "png";
            case "image/gif":
                return "gif";
            case "image/bmp":
                return "bmp";
            default :
                return "";
        }
    }
    

}
