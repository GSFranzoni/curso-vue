<?php

class CategoryDAO extends DAO
{

    static $columns = array('id', 'name', 'parent');
    static $tableName = 'Category';

    public static function getTree()
    {
        return static::toTree(CategoryController::getAll());
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

    public static function getAll() {
        $result = Database::getResultsFromQuery("SELECT * FROM Category");
        $categories = [];
        if($result->num_rows > 0) {
            while($category = $result->fetch_assoc()) {
                $category['path'] = static::getPath($category, $categories, $category['name']);
                array_push($categories, $category);
            }
        }
        return $categories;
    }

    public static function getPath($category, $categories, $path) {
        if(!$category['parent']) {
            return $path!=''? $path: '';
        }
        $parent = array_filter($categories, function($c) use ($category) {
            return $category['parent'] === $c['id'];
        })[0];
        $path = $parent['name']. ' > '. $path;
        static::getPath($parent, $categories, $path);
        return $path;
    }

    public static function insert($category)
    {
        foreach (static::$columns as $column) {
            if(!isset($category[$column]) and $column!='id' and $column!='parent') {
                throw new Exception('O campo '. $column. ' é requerido!');
                return;
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
