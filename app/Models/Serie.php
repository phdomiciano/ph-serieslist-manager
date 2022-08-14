<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ProductInterface;

class Serie extends Model implements ProductInterface
{
    use HasFactory;

    // fillable for Eloquet understand such attributes can be auto updated when use ::create()
    protected $fillable = ['name', 'description'];

    // this is for always find seasons together with serie
    //protected $with = ['seasons']; 

    public function seasons(){
        return $this->hasMany(Season::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getColumns(){
        return $this->getAttributes();
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
