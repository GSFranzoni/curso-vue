<?php 

    class UserDAO extends DAO {

        static $columns = array('id', 'name', 'email', 'password', 'admin');
        static $tableName = 'User';
        
    }

?>