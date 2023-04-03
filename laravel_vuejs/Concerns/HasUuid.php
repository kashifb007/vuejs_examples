<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasUuid
{
    /**
     * This will be run on every boot
     * where used by the model.
     */
    protected static function bootHasUuid()
    {
        static::creating(fn (Model $model) => $model->uuid = (string) \Str::uuid());
    }
}
