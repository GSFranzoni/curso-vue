<?php 

    class ArticleDAO extends DAO {

        static $columns = array('id', 'name', 'category', 'user', 'description', 'content', 'image');
        static $tableName = 'Article';
        
        public static function getAllWithPagination($page) {
            return Database::getResultsFromQuery("SELECT ". implode(',', static::$columns). " FROM ". static::$tableName. " LIMIT 10 OFFSET ". ($page*(9)));
        }

        public static function getByCategory($category) {
            return Database::getResultsFromQuery("SELECT a.* FROM ". static::$tableName. " a, Category c WHERE c.id = a.category AND c.id=".static::getFormatedValue($category));
        }
    }

?>