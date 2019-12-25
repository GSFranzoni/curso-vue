<?php 

    abstract class Model {
        protected $id;

        public function __construct($data) {
            $this->loadFromArray($data);
        }

        public function loadFromArray($array) {
            if($array) {
                foreach ($array as $key => $value) {
                    $this->$key = $value;
                }
            }
        }

        public function __get($key) {
            return $this->values[$key];
        }
        public function __set($key, $value) {
            $this->values[$key] = $value;
        }

        public function toArray() {
            return get_object_vars($this);
        }

        public abstract function toJson();
    }
