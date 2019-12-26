<?php 

class CategoryController extends Controller {

    static $dao = 'CategoryDAO';
    static $model = 'Category';
    
    public static function getTree() {
        return json_encode(CategoryDAO::getTree());
    }
}

?>