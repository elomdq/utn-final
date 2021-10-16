<?php

namespace DAO;

use Models\Student as Student;

interface IStudentDAO{

    public function add(Student $student);
    public function remove($studentId);
    public function getAll();

}

?>