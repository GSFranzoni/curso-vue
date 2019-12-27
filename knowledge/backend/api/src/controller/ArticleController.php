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
                array_push($array, (new static::$model($object)));
            }
        }
        return json_encode($array);
    }

    public static function getByCategory($category) {
        $result = ArticleDAO::getByCategory($category);
        $array = [];
        if($result->num_rows > 0) {
            while($object = $result->fetch_assoc()) {
                array_push($array, (new static::$model($object)));
            }
        } 
        return ($array);
    }
}
