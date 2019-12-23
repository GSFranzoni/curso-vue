<?php 

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR.utf-8', 'portuguese');
define('MODEL_PATH', realpath(dirname(__FILE__). '/../model'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__). '/../controller'));
define('DAO_PATH', realpath(dirname(__FILE__). '/../dao'));

require_once(realpath(MODEL_PATH. '/Model.php'));
require_once(realpath(MODEL_PATH. '/Category.php'));
require_once(realpath(MODEL_PATH. '/Article.php'));
require_once(realpath(MODEL_PATH. '/User.php'));

require_once(realpath(CONTROLLER_PATH. '/UserController.php'));
