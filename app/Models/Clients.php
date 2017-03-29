<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];

    protected $fillable = ['name' , 'url', 'logo', 'street', 'city', 'suburb', 'postcode', 'country'];
}
