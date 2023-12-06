<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use App\Core\MediaLib;

class Skill extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'media_id'
    ];

    public function media()
    {
        return $this->belongsTo(MediaFile::class, 'media_id', 'media_id');
    }
    public static function store($request, $id = null)
    {
        $skill = $request->only(['name', 'description']);
        if (filled($request->image)) {
            $skill['media_id'] = MediaLib::generateImageBase64($request->image);
        }
        $skill = self::updateOrCreate(['id' => $id], $skill);
        $subjects = request('subjects');
        $skill->subjects()->sync($subjects);
        return $skill;        
    }
    
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'skill_subjects')->withTimestamps();
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_skills')->withTimestamps();
    }

    public function scholarship(): HasMany
    {
        return $this->hasMany(ScholarShip::class);
    }
}
