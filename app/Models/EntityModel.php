<?php

namespace App\Models;

use Auth;
use Eloquent;
use App\School\Libraries\Utils;

class EntityModel extends Eloquent
{
    public $timestamps = true;
    protected $hidden = ['id'];

    public static function createNew($context = null)
    {
        $className = get_called_class();
        $entity = new $className();

        if(method_exists($className, 'withTrashed')){
            $lastEntity = $className::withTrashed()
                ->scope(false);
        } else {
            $lastEntity = $className::scope(false);
        }

        $lastEntity = $lastEntity->orderBy('public_id', 'DESC')
            ->first();

        if ($lastEntity) {
            $entity->public_id = $lastEntity->public_id + 1;
        } else {
            $entity->public_id = 1;
        }

        return $entity;
    }

    public static function getPrivateId($publicId)
    {
        $className = get_called_class();

        return $className::scope($publicId)->withTrashed()->value('id');
    }

    public function getActivityKey()
    {
        return '[' . $this->getEntityType().':'.$this->public_id.':'.$this->getDisplayName() . ']';
    }

    public function scopeScope($query, $publicId = false)
    {
        if ($publicId) {
            if (is_array($publicId)) {
                $query->whereIn('public_id', $publicId);
            } else {
                $query->wherePublicId($publicId);
            }
        }

        return $query;
    }

    public function scopeViewable($query)
    {
        if (Auth::check() && ! Auth::user()->hasPermission('view_all')) {
            $query->where($this->getEntityType(). 's.user_id', '=', Auth::user()->id);
        }

        return $query;
    }

    public function scopeWithArchived($query)
    {
        return $query->withTrashed()->where('is_deleted', '=', false);
    }

    public function getName()
    {
        return $this->public_id;
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
