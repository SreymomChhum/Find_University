<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolSkill extends Model
{
    use HasFactory;
    protected $fillable=[
        'school_id',
        'skill_id'
    ];
}
