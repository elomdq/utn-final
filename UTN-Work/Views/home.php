<?php

use Models\Student as Student;
use DAO\StudentDAO as StudentDAO;

echo "HOME <br>";


/*
//Conexion a API alumnos
$url = "https://utn-students-api.herokuapp.com/api/Student" ;

$curlHandler = curl_init();
$header = array("x-api-key: 4f3bceed-50ba-4461-a910-518598664c08");

//seteo
curl_setopt($curlHandler, CURLOPT_URL, $url);
curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $header);

//ejecuto el curl handler y guardo el string que retorna
$response = curl_exec($curlHandler);

//decodifico el json en un array con los objetos
$arrayStudents = json_decode($response, true);

//genero un .json con los estudiantes
$studentDAO = new StudentDAO;

foreach($arrayStudents as $studentData)
{
    $student = new Student;

    $student->setStudentId($studentData['studentId']);
    $student->setCareerId($studentData['careerId']);
    $student->setFileNumber($studentData['fileNumber']);
    $student->setFirstName($studentData['firstName']);
    $student->setLastName($studentData['lastName']);
    $student->setDni($studentData['dni']);
    $student->setGender($studentData['gender']);
    $student->setPhoneNumber($studentData['phoneNumber']);
    $student->setBirthDate($studentData['birthDate']);
    $student->setEmail($studentData['email']);
    $student->setActive($studentData['active']);
                
    $studentDAO->add($student);
}
*/
?>


<div class="container">

    <div class="row">

        <div class="card col-3">
            <div class="card-body">
                <form>
                    <p>Empresas: </p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="companies" value="">
                        <label class="form-check-label" for="companies">Globant</label>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>