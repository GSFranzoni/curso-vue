<?php 

    class UserController {
        public static function get($id) {
            return (new User(
                Array(
                    'id' => 0,
                    'name' => 'José',
                    'age' => 22,
                    'email' => 'jose@email.com',
                    'password' => 'KLNMVD09njk0-924OJ3'
                )
            ))->toJson();
        }
    }

?>