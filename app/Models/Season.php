<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ProductInterface;

class Season extends Model implements ProductInterface
{
    use HasFactory;

    protected $fillable = ['number', 'name'];
    //protected $with = ['episodes']; 

    public function episodes(){
        return $this->hasMany(Episode::class);
    }

    public function serie(){
        return $this->belongsTo(Serie::class);
    }

    public function getColumns(){
        return $this->getAttributes();
    }

    public function getUserId(): int
    {
        return $this->serie->user_id;
    }
}
