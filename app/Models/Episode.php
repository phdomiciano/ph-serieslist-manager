<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ProductInterface;

class Episode extends Model implements ProductInterface
{
    use HasFactory;

    protected $fillable = ['number', 'name'];

    public function season(){
        return $this->belongsTo(Season::class);
    }

    public function getColumns(){
        return $this->getAttributes();
    }

    public function getUserId(): int
    {
        return $this->season->serie->user_id;
    }
}
