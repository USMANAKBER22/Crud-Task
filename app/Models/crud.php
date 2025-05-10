<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    use HasFactory;

    
    public $timestamps = false;

    
    protected $table = 'crud_operation';
    protected $fillable = [
        'name',
        'email'
    ];
}
