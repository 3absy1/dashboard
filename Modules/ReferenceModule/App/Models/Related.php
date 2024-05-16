<?php

namespace Modules\ReferenceModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ReferenceModule\Database\factories\RelatedFactory;
use Modules\ReferenceModule\App\Models\Reference;

class Related extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'reference_id','code'];

    protected static function newFactory(): RelatedFactory
    {
        //return RelatedFactory::new();
    }
    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }
}
