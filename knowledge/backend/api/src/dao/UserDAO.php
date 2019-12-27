<?php 

    class UserDAO extends DAO {

        static $columns = array('id', 'name', 'email', 'password', 'admin');
        static $tableName = 'User';

        public static function signin($email, $password) {
            if(!(int)Database::getResultsFromQuery("SELECT COUNT(*) FROM User WHERE email=". static::getFormatedValue($email))->fetch_array()[0]) {
                throw new Exception('Email não cadastrado!');
            }
            if(!(int)Database::getResultsFromQuery(
                "SELECT COUNT(*) FROM User WHERE email=". static::getFormatedValue($email). " AND password=". static::getFormatedValue($password))->fetch_array()[0]
            ) {
                throw new Exception('Email ou senha não correspondem!');
            }
            return Auth::generateToken($email);
        }
        
    }

?>