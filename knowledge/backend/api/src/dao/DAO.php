<?php 

    class DAO {

        protected static $columns = Array();
        protected static $tableName = 'TableName';

        public static function get($id) {
            return Database::getResultsFromQuery("SELECT ". implode(',', static::$columns). " FROM ". static::$tableName. " WHERE id=${id}");
        }

        public static function getAll() {
            return Database::getResultsFromQuery("SELECT ". implode(',', static::$columns). " FROM ". static::$tableName);
        }

        public static function delete($id) {
            return Database::getResultsFromQuery("DELETE FROM ". static::$tableName. " WHERE id=${id}");
        }
        
        public static function update($id, $object) {
            $set = 'SET';
            foreach ($object as $key => $value) {
                $set.=" ${key}=${value},";
            }
            $set[strlen($set)-1] = '';
            return Database::getResultsFromQuery("UPDATE ". static::$tableName. $set." WHERE id=${id}");
        }

        public static function insert($object) {
            $values = " VALUES(";
            foreach ($object as $key => $value) {
                $values.=static::getFormatedValue($value). ",";
            }
            $values[strlen($value)-1] = ')';
            return Database::getResultsFromQuery("INSERT INTO ". static::$tableName. "(". implode(',', static::$columns). ")". $values);
        }

        private static function getFormatedValue($value) {
            if(is_null($value)) {
                return "null";
            }
            elseif(gettype($value) === 'string') {
                return "'${value}'";
            }
            else {
                return $value;
            }
        }
    }

?>