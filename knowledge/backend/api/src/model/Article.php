<?php 

    require_once MODEL_PATH. "/Model.php";

    class Article extends Model {
        private $name, $user, $category, $content;

        public function __construct($data){
            parent::__construct($data);
        }

        public function toJson() {
            return json_encode(array_merge(parent::toArray(), get_object_vars($this)));
        }
    }
