<?php

namespace Grofie;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    
    protected $table = 'stores';
    protected $primaryKey  = 'store_id';
    protected $fillable = ['store_name', 'lat', 'long', ];
    protected $dates = ['created_at','updated_at'];
}
