<?php 

    require_once MODEL_PATH. "/Model.php";

    class User extends Model implements JsonSerializable {
        protected $name, $admin, $email, $password;

        public function __construct($data){
            parent::__construct($data);
        }

        public function toJson() {
            return json_encode(array_merge(parent::toArray(), get_object_vars($this)));
        }

        public function jsonSerialize() {
            return Array(
               'id' => $this->id,
               'name' => $this->name,
               'email' => $this->email,
               'password' => $this->password,
               'admin' => $this->admin
            );
        }
    }
