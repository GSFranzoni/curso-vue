<?php 

    class Controller {
        protected static $dao = 'DAO'; 
        protected static $model = 'MODEL';
        
        public static function get($id) {

            $result = static::$dao::get($id);
            
            if($result->num_rows > 0) {
                $object = new static::$model($result->fetch_assoc());
            } 
            return $object->toJson();
        }

        public static function getAll() {
            $result = static::$dao::getAll();
            $array = [];
            if($result->num_rows > 0) {
                while($object = $result->fetch_assoc()) {
                    array_push($array, (new static::$model($object)));
                }
            } 
            return json_encode($array);
        }
        
        public static function delete($id) {
            static::$dao::delete($id);
        }

        public static function insert($object) {
            static::$dao::insert($object);
        }
    }

?>