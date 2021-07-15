<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;


    protected $faillable =[  
         	'total_sales', 	'new_users', 	'total_orders',
    
        ];
    
}
