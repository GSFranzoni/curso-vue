<?php 

    class ArticleDAO extends DAO {

        static $columns = array('id', 'name', 'category', 'user', 'description', 'content', 'image');
        static $tableName = 'Article';
        
    }

?>