<?php 

class CategoryController extends Controller {

    static $dao = 'CategoryDAO';
    static $model = 'Category';
    
    public static function getTree() {
        if(static::count()==0) 
            return [];
        return json_encode(CategoryDAO::getTree());
    }
}

?>