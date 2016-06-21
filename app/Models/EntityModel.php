<?php

namespace App\Models;

use Auth;
use Eloquent;
use App\School\Libraries\Utils;

class EntityModel extends Eloquent
{
    public $timestamps = true;
    protected $hidden = ['id'];


    public function getActivityKey()
    {
        return '[' . $this->getEntityType().':'.$this->id.':'.$this->getDisplayName() . ']';
    }

    public function scopeScope($query, $Id = false)
    {
        if ($Id) {
            if (is_array($Id)) {
                $query->whereIn('id', $Id);
            } else {
                $query->whereId($Id);
            }
        }

        return $query;
    }

    public function scopeViewable($query)
    {
        if (Auth::check() && ! Auth::user()->hasPermission('view_all')) {
            $query->where($this->getEntityType(). 's.created_by', '=', Auth::user()->id);
        }

        return $query;
    }

    public function scopeWithArchived($query)
    {
        return $query->withTrashed()->where('is_deleted', '=', false);
    }

    public function getName()
    {
        return $this->id;
    }

    public function getDisplayName()
    {
        return $this->getName();
    }

    public static function getClassName($entityType)
    {
        return 'App\\Models\\' . ucwords(Utils::toCamelCase($entityType));
    }

    public static function getTransformerName($entityType)
    {
        return 'App\\School\\Transformers\\' . ucwords(Utils::toCamelCase($entityType)) . 'Transformer';
    }

    public function setNullValues()
    {
        foreach ($this->fillable as $field) {
            if (strstr($field, '_id') && !$this->$field) {
                $this->$field = null;
            }
        }
    }

    // converts "App\Models\Student" to "student_id"
    public function getKeyField()
    {
        $class = get_class($this);
        $parts = explode('\\', $class);
        $name = $parts[count($parts)-1];
        return strtolower($name) . '_id';
    }
}
