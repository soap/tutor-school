<?php

namespace App\School\Libraries;

class Utils
{
    public static function toArray($data)
    {
        return json_decode(json_encode((array) $data), true);
    }

    public static function toSpaceCase($string)
    {
        return preg_replace('/([a-z])([A-Z])/s', '$1 $2', $string);
    }

    public static function toSnakeCase($string)
    {
        return preg_replace('/([a-z])([A-Z])/s', '$1_$2', $string);
    }

    public static function toCamelCase($string)
    {
        return lcfirst(static::toClassCase($string));
    }

    public static function toClassCase($string)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }

    public static function getEntityRowClass($model)
    {
        $str = '';

        if (property_exists($model, 'is_deleted')) {
            $str = $model->is_deleted || ($model->deleted_at && $model->deleted_at != '0000-00-00') ? 'DISABLED ' : '';

            if ($model->is_deleted) {
                $str .= 'ENTITY_DELETED ';
            }
        }

        if ($model->deleted_at && $model->deleted_at != '0000-00-00') {
            $str .= 'ENTITY_ARCHIVED ';
        }

        return $str;
    }

    public static function getEntityClass($entityType)
    {
        return 'App\\Models\\' . static::getEntityName($entityType);
    }

    public static function getEntityName($entityType)
    {
        return ucwords(Utils::toCamelCase($entityType));
    }
}