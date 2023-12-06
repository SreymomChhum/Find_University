<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeEducation extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];

    public function school():HasMany{
        return $this->hasMany(School::class);
    }
}
