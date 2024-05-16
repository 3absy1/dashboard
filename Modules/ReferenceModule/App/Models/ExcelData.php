<?php

namespace Modules\ReferenceModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ReferenceModule\Database\factories\ExcelDataFactory;

class ExcelData extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'code', 'reference_name','code2'];

    protected static function newFactory(): ExcelDataFactory
    {
        //return ExcelDataFactory::new();
    }
}
