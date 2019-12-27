<?php 

    class UserController extends Controller {

        static $dao = 'UserDAO';
        static $model = 'User';
        
        public static function signin($email, $password) {
            return UserDAO::signin($email, $password);
        }

    }

?>