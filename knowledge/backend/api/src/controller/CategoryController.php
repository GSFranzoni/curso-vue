<?php 

class CategoryController extends Controller {

    static $dao = 'CategoryDAO';
    static $model = 'Category';
    
    public static function getTree() {
        if(static::count()==0) 
            return [];
        return (CategoryDAO::getTree());
    }

    public static function update($id, $category) {
        
        if(isset($category['parent']) and $category['parent'] === 0 or $category['parent'] === '') {
            $category['parent'] = null;
        }

        CategoryDAO::update($id, $category);
    }

    public static function getAll() {
        return CategoryDAO::getAll();
    }
}

?>