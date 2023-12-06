<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Core\MediaLib;

class ScholarShip extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'post_date',
        'expired_date',
        'school_id',
        'skill_id',
        'media_id',
        'user_number'

    ];
    public function media()
    {
        return $this->belongsTo(MediaFile::class, 'media_id', 'media_id');
    }
    public static function store($request, $id = null)
    {
        $scholarship = $request->only(['name','user_number','description','school_id','skill_id','post_date','expired_date']);
        if (filled($request->image)) {
            $scholarship['media_id'] = MediaLib::generateImageBase64($request->image);
        }
        $scholarship = self::updateOrCreate(['id' => $id], $scholarship);
        return $scholarship;        
    }
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function skill():BelongsTo{
        return $this->belongsTo(Skill::class);
    }

    public function school():BelongsTo{
        return $this->belongsTo(School::class);
    }

    public function users():HasMany{
        return $this->hasMany(User::class);
    }
}
