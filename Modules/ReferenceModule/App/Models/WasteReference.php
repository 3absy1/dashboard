<?php

namespace Modules\ReferenceModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ReferenceModule\Database\factories\WasteReferenceFactory;

class WasteReference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','code','reason'];

    protected static function newFactory(): WasteReferenceFactory
    {
        //return WasteReferenceFactory::new();
    }
}
