<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'seats',
        'date',
        'price',
        'type',
        'image',
        'status',
        'category_id',
        'created_by',
    ];

    protected $dates = ['deleted_at'];

    public function Categories(){
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
