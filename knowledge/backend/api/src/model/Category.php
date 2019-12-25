<?php 

    require_once MODEL_PATH. "/Category.php";

    class Category extends Model {
        private $name;

        public function __construct($data){
            parent::__construct($data);
        }

        public function toJson() {
            return json_encode(array_merge(parent::toArray(), get_object_vars($this)));
        }
    }
