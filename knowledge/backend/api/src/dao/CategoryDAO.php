<?php

class CategoryDAO extends DAO
{

    static $columns = array('path', 'id', 'name', 'parent');
    static $tableName = 'Category';

    public static function getTree()
    {
        $categories = json_decode(CategoryController::getAll(), true);
        return static::toTree($categories);
    }

    public static function toTree($categories, $tree = null)
    {
        if (!$tree) {
            $tree = array_filter($categories, function ($category) {
                return !$category['parent'];
            });
        }
        $tree = array_values(array_map(function ($parent) use ($categories) {
            $children = array_filter($categories, function ($node) use ($parent) {
                return $node['parent'] == $parent['id'];
            });
            $parent['children'] = count($children) > 0 ? array_values(static::toTree($categories, $children)) : [];
            return $parent;
        }, $tree));
        return $tree;
    }

    public static function insert($category)
    {
        $category->path = $category->name;
        if($category->parent) {
            try {
                $category->path = Category::fromJson(CategoryController::get($category->parent))->path. " > ". $category->path;
            }
            catch(Error $err) {
                throw new Exception('A categoria pai informada não existe!');
            }
        }
        $cols = " (";
        $values = " VALUES(";
        foreach ($category as $key => $value) {
            $cols.= $key. ",";
            $values .= parent::getFormatedValue($value) . ",";
        }
        $cols[strlen($cols)-1] = ')';
        $values[strlen($values) - 1] = ')';
        Database::getResultsFromQuery("INSERT INTO " . static::$tableName . $cols. $values);
    }
}
