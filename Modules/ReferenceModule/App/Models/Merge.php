<?php

namespace Modules\ReferenceModule\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merge extends Model
{
    use HasFactory;


    protected $fillable = ['count'];

    protected $table = 'merge';
}
