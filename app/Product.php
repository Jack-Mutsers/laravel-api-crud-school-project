<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
	
    protected $primaryKey = 'ProductID';
    
	protected $fillable = [
        'ProductName',      // varchar(40)
        'SupplierID',       // int(10)
        'CategoryID',       // tinyint(5)
        'QuantityPerUnit',  // varchar(20)
        'UnitPrice',        // double
        'UnitsInStock',     // smallint(51)
        'UnitsOnOrder',     // smallint(51)
        'ReorderLevel',     // smallint(51)
        'Discontinued',     // enum (y,n)
    ];

    public $timestamps = false;
}
