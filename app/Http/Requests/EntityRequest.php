<?php

namespace App\Http\Requests;

use Input;
use App\School\Libraries\Utils as Utils;
use App\Http\Requests\Request;

class EntityRequest extends Request
{
    protected $entityType;

    private $entity;

    /**
     * Get entity object
     */
    public function entity()
    {
        if ($this->entity) {
            return $this->entity;
        }

        // The entity id can appear as invoices, invoice_id, public_id or id
        $publicId = false;
        foreach (['_id', 's'] as $suffix) {
            $field = $this->entityType . $suffix;
            if ($this->$field) {
                $publicId= $this->$field;
            }
        }

        if ( ! $publicId) {
            $publicId = Input::get('public_id') ?: Input::get('id');
        }

        if ( ! $publicId) {
            $publicId = $this->route('public_id') ?: $this->route('id');
        }

        if ( ! $publicId) {
            return null;
        }

        $class = Utils::getEntityClass($this->entityType);

        if (method_exists($class, 'withTrashed')) {
            $this->entity = $class::scope($publicId)->withTrashed()->firstOrFail();
        } else {
            $this->entity = $class::scope($publicId)->firstOrFail();
        }

        return $this->entity;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
