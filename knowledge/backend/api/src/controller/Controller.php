<?php 

    class Controller {
        protected static $dao = 'DAO'; 
        protected static $model = 'MODEL';
        
        public static function get($id) {

            $result = static::$dao::get($id);
            
            if($result->num_rows > 0) {
                $object = new static::$model($result->fetch_assoc());
                return $object;
            } 
            throw new Exception('Registro não encontrado', 401);
        }

        public static function count() {
            return (static::$dao::count());
        }

        public static function getAll() {
            if(static::count()==0) {
                return [];
            }
            $result = static::$dao::getAll();
            $array = [];
            if($result->num_rows > 0) {
                while($object = $result->fetch_assoc()) {
                    array_push($array, (new static::$model($object)));
                }
            } 
            return ($array);
        }
        
        public static function delete($id) {
            static::$dao::delete($id);
        }

        public static function insert($object) {
            static::$dao::insert($object);
        }

        public static function stats() {
            return DAO::stats();
        }

        public static function update($id, $object) {
            static::$dao::update($id, $object);
        }
    }

?>