<?php

namespace App\Models\WEB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;


    protected $faillable =[  


           
            ('user_id'),
            ('gift_id'),
            ('total_amount'),
            ('bank_transaction_id'), 
        
        ];
    




}
