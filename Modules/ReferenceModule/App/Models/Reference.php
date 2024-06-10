<?php

namespace Modules\ReferenceModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ReferenceModule\App\Models\Related;

class Reference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'code'];

    public function related()
    {
        return $this->hasMany(Related::class);
    }
}
