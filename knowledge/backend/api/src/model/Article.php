<?php 

    class Article extends Model implements JsonSerializable {
        protected $name, $user, $category, $content, $image;

        public function __construct($data){
            parent::__construct($data);
        }

        public static function fromJson($json) {
            return new Article(json_decode($json, true));
        }

        public function toJson() {
            return json_encode(array_merge(parent::toArray(), get_object_vars($this)));
        }

        public function jsonSerialize() {
            return Array(
               'id' => (int) $this->id,
               'name' => $this->name,
               'user' => (int) $this->user,
               'category' => (int) $this->category,
               'content' => $this->content,
               'image' => $this->image
            );
        }
    }
