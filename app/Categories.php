<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
	
    protected $primaryKey = 'CategoryID';
    
	protected $fillable = [
        'CategoryName',     // varchar(15)
        'Description',      // mediumtext
        'Picture',          // varchar(50)
    ];

    public $timestamps = false;
}
