<?php

class ArticleController extends Controller
{

    static $dao = 'ArticleDAO';
    static $model = 'Article';

    public static function getAllWithPagination($page)
    {
        $result = ArticleDAO::getAllWithPagination($page);
        $array = [];
        if ($result->num_rows > 0) {
            while ($object = $result->fetch_assoc()) {
                array_push($array, ($object));
            }
        }
        return ($array);
    }

    public static function getByCategory($category, $page) {
        $result = ArticleDAO::getByCategory($category, $page);
        $array = [];
        if($result->num_rows > 0) {
            while($object = $result->fetch_assoc()) {
                array_push($array, ($object));
            }
        } 
        return ($array);
    }

}
