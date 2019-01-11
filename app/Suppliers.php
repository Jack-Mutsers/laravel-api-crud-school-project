<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table = 'suppliers';
	protected $fillable = [
        'CompanyName',  // varchar(40)
        'ContactName',  // varchar(30)
        'ContactTitle', // varchar(30)
        'Address',      // varchar(60)
        'City',         // varchar(15)
        'Region',       // varchar(15)
        'PostalCode',   // varchar(10)
        'Country',      // varchar(15)
        'Phone',        // varchar(24)
        'Fax',          // varchar(24)
        'HomePage',     // varchar(255)
    ];
    protected $primaryKey = 'SupplierID';
    public $timestamps = false;
}
