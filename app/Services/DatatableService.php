<?php

namespace App\Services;

use Datatables;
use App\School\Datatables\EntityDatatable;

class DatatableService
{
    public function createDatatable(EntityDatatable $datatable, $query)
    {
        $table = Datatables::queryBuilder($query);
        foreach ($datatable->columns() as $column) {
            // set visible to true by default
            if (count($column) == 2) {
                $column[] = true;
            }

            list($field, $value, $visible) = $column;

            if ($visible) {
                $table->addColumn($field, $value, true);
                //$orderColumns[] = $field;
            }
        }

        if (count($datatable->actions())) {
            $this->createDropdown($datatable, $table);
        }
        return $table->make(true);
    }


    private function createDropdown(EntityDatatable $datatable, $table)
    {
        $table->editColumn('action', function ($model) use ($datatable) {
            $hasAction = false;
            $str = '<div style="min-width:100px" align="left">';

            $can_edit =  true;//Auth::user()->hasPermission('edit_all') || (isset($model->user_id) && Auth::user()->id == $model->user_id);

            if (property_exists($model, 'is_deleted') && $model->is_deleted) {
                $str .= '<button type="button" class="btn btn-sm btn-danger tr-status">'.trans('strings.deleted').'</button>';
            } elseif ($model->deleted_at && $model->deleted_at !== '0000-00-00') {
                $str .= '<button type="button" class="btn btn-sm btn-warning tr-status">'.trans('strings.archived').'</button>';
            } else {
                $str .= '<div class="tr-status"></div>';
            }

            $dropdown_contents = '';

            $lastIsDivider = false;
            if (!$model->deleted_at || $model->deleted_at == '0000-00-00') {
                foreach ($datatable->actions() as $action) {
                    if (count($action)) {
                        if (count($action) == 2) {
                            $action[] = function() {
                                return true;
                            };
                        }
                        list($value, $url, $visible) = $action;
                        if ($visible($model)) {
                            if($value == '--divider--'){
                                $dropdown_contents .= "<li class=\"divider\"></li>";
                                $lastIsDivider = true;
                            }
                            else {
                                $urlVal = $url($model);
                                $urlStr = is_string($urlVal) ? $urlVal : $urlVal['url'];
                                $attributes = '';
                                if (!empty($urlVal['attributes'])) {
                                    $attributes = ' '.$urlVal['attributes'];
                                }

                                $dropdown_contents .= "<li><a href=\"$urlStr\"{$attributes}>{$value}</a></li>";
                                $hasAction = true;
                                $lastIsDivider = false;
                            }
                        }
                    } elseif ( ! $lastIsDivider) {
                        $dropdown_contents .= "<li class=\"divider\"></li>";
                        $lastIsDivider = true;
                    }
                }

                if ( ! $hasAction) {
                    return '';
                }

                if ( $can_edit && ! $lastIsDivider) {
                    $dropdown_contents .= "<li class=\"divider\"></li>";
                }

                if (($datatable->entityType != ENTITY_USER || $model->public_id) && $can_edit) {
                    $dropdown_contents .= "<li><a href=\"javascript:archiveEntity({$model->id})\">"
                        . trans("strings.archive_{$datatable->entityType}") . "</a></li>";
                }
            }

            if (property_exists($model, 'is_deleted') && !$model->is_deleted && $can_edit) {
                $dropdown_contents .= "<li><a href=\"javascript:deleteEntity({$model->id})\">"
                    . trans("strings.delete_{$datatable->entityType}") . "</a></li>";
            }

            if (!empty($dropdown_contents)) {
                $str .= '<div class="btn-group tr-action" style="height:auto">
                    <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" style="width:100px">
                        '.trans('strings.select').' <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">';
                $str .= $dropdown_contents . '</ul>';
            }

            return $str.'</div></div>';
        }, false);
    }
}