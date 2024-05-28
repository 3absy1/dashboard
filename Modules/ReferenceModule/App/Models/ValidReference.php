<?php

namespace Modules\ReferenceModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ReferenceModule\Database\factories\ValidReferenceFactory;

class ValidReference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'code','flag'];

    protected static function newFactory(): ValidReferenceFactory
    {
        //return ValidReferenceFactory::new();
    }
}
