<?php 

    class Category extends Model implements JsonSerializable {
        public $name, $parent, $path;

        public function __construct($data){
            parent::__construct($data);
        }

        public static function fromJson($json) {
            return new Category(json_decode($json, true));
        }

        public function toJson() {
            return json_encode(array_merge(parent::toArray(), get_object_vars($this)));
        }

        public function jsonSerialize() {
            return Array(
               'id' => (int) $this->id,
               'name' => $this->name,
               'parent' => (int) $this->parent,
               'path' => $this->path
            );
        }
    }
