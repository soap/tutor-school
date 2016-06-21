<?php

namespace App\Services;

class BaseService
{
    protected function getRepo()
    {
        return null;
    }

    public function bulk($ids, $action)
    {
        if ( ! $ids ) {
            return 0;
        }

        $entities = $this->getRepo()->findByPublicIdsWithTrashed($ids);

        foreach ($entities as $entity) {
            if(Auth::user()->can('edit', $entity)){
                $this->getRepo()->$action($entity);
            }
        }

        return count($entities);
    }
}
