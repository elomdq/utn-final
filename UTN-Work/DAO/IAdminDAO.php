<?php

namespace DAO;

use Models\Admin as Admin;

interface IAdminDAO{

    public function add(Admin $admin);
    public function remove($userId);
    public function getAll();

}

?>