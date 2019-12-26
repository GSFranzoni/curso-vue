<?php 

    class UserController {

        public static function get($id) {
            $result = UserDAO::get($id);
            if($result->num_rows > 0) {
                $user = new User($result->fetch_assoc());
            } 
            return $user->toJson();
        }

        public static function getAll() {
            $result = UserDAO::getAll();
            $users = [];
            if($result->num_rows > 0) {
                while($user = $result->fetch_assoc()) {
                    array_push($users, (new User($user)));
                }
            } 
            return json_encode($users);
        }
        
        public static function delete($id) {
            return json_encode(UserDAO::delete($id));
        }
        
    }

?>