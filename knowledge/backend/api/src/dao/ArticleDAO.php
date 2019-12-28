<?php 

    class ArticleDAO extends DAO {

        static $columns = array('id', 'name', 'category', 'user', 'description', 'content', 'image');
        static $tableName = 'Article';
        const limit = 5;
        
        public static function getAllWithPagination($page) {
            return Database::getResultsFromQuery("SELECT ". implode(',', static::$columns). " FROM ". static::$tableName. " LIMIT ". ArticleDAO::limit. " OFFSET ". (($page-1)*ArticleDAO::limit));
        }

        public static function getByCategory($category, $page) {
            return Database::getResultsFromQuery("SELECT a.* FROM ". static::$tableName. " a, Category c WHERE c.id = a.category AND c.id=".static::getFormatedValue($category). " LIMIT ". ArticleDAO::limit. " OFFSET ". (($page-1)*ArticleDAO::limit));
        }
    }

?>