<?php

namespace App\Models;

use App\Core\MediaLib;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
class School extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable=[
        'name',
        'media_id',
        'description',
        'type_education_id',
        'address_id',

    ];
    public function media()
    {
        return $this->belongsTo(MediaFile::class, 'media_id', 'media_id');
    }
    public static function school($request, $id=null){
        $school = $request->only(['name', 'description', 'type_education_id', 'address_id']);
        if (filled($request->image)) {
            $school['media_id'] = MediaLib::generateImageBase64($request->image);
        }
        $school = self::updateOrCreate(['id'=>$id], $school);
        $skills = request('skills');
        $school->skills()->sync($skills);
        return $school;
    }
  
    public function scholarship():HasMany{
        return $this->hasMany(ScholarShip::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'school_skills')->withTimestamps();
    }


    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeEducation::class, "type_education_id", "id");
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function workshops(): HasMany
    {

        return $this->hasMany(WorkShop::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function schoolUser(): HasMany
    {
        return $this->hasMany(SchoolUser::class);
    }
}
