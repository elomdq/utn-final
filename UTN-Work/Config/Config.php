<?php

namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "http://localhost/lab4/tp-final/utn-final/UTN-Work/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("VENDOR_PATH", FRONT_ROOT.VIEWS_PATH . "vendor/");

define("UPLOADS_PATH_CV","Uploads/CV/");
define("UPLOADS_PATH_IMG","Uploads/IMG/");
define("UPLOADS_PATH_PROFILE_PICTURE","Uploads/Profile-Pictures/");

define("DB_HOST", "localhost");
define("DB_NAME", "tp_final");
define("DB_USER", "root");
define("DB_PASS", "");

?>