<?php
namespace Controllers;

use Config\SystemFunctions as SystemFunctions;

use \Exception as Exception;

use Models\Alert as Alert;
use Models\File as Archivo;
use DAO\CurriculumDAO as CurriculumDAO;
use DAO\StudentDAO as StudentDAO;

class FileController{

    private $fileDAO;
    private $filel;
    private $studentDAO;

    public function __construct()
    {
        $this->fileDAO = new CurriculumDAO;
        $this->studentDAO = new StudentDAO;
    }



    public function addView(Alert $alert = null){
        SystemFunctions::validateSession();
        require_once VIEWS_PATH."header.php";
        require_once VIEWS_PATH."nav.php";
        require_once VIEWS_PATH."file-add.php";
        require_once VIEWS_PATH."footer.php";
    }

    public function createFile() {
        $alert = new Alert();
        try{
            if($_FILES)
            {
                $target_dir = UPLOADS_PATH_CV;
                $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
                $uploadOk=$this->checkPDF($imageFileType);
    
                if($uploadOk == 1)
                {
                    $alert=$this->uploadFile($target_file, $alert);
                    $archivo = new Archivo();
    
                    $idUser = $_SESSION["loggedUser"]->getUserId();

                    $archivo->setUrl($target_file);
                    $archivo->setIdOwner($this->studentDAO->getStudentIdByIdUser($idUser));
    
                    $this->fileDAO->Add($archivo);
                    $this->addView($alert);
                } else {
                    $alert->setMessage("No es un PDF");
                    $alert->settype("danger");
                    $this->addView($alert);
                }
            }
        } catch(Exception $e){
            $alert->setMessage($e->getMessage());
            $alert->settype("danger");
            //$this->addView($alert);
            ViewController::erroConnectionView($alert);
        }
    }

    public function checkPDF($imageFileType) {
        $uploadOk = 1;
        if($imageFileType != "pdf") {
          $uploadOk = 0;
        }
        return $uploadOk;
    }

    private function uploadFile($target_file, Alert $alert){

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $alert->setMessage("Archivo subido con exito");
            $alert->setType("success");
          } else {
            $alert->setMessage("Error al subir el archivo");
            $alert->setType("danger");
          }
        return $alert;
    }

}

?>