<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolUser extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'skill_id',
        'school_id',
        'accept',
        'year',
        'study_level'
    ];
    public static function schoolUser($request, $id=null){
        $schoolUser = $request->only(['user_id','skill_id', 'school_id', 'accept', 'year', 'study_level']);
        $schoolUser = self::updateOrCreate(['id'=>$id], $schoolUser);
        return $schoolUser;
    }
    public function schools()
    {
        return $this->hasMany(School::class);
    }
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
