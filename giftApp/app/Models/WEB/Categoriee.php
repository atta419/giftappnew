<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriee extends Model
{
    use HasFactory;
     
    protected $faillable =[  
        'categoriee',
        'product_id',
        
    
        ];
    
            
    
}
