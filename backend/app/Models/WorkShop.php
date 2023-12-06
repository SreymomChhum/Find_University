<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use App\Core\MediaLib;

class WorkShop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'media_id',
        'address_id',
        'school_id',
        'description',
        'user_number',
        'full',
        'start_date',
        'expired_date',
        'time',

    ];
    
    public function media()
    {
        return $this->belongsTo(MediaFile::class, 'media_id', 'media_id');
    }
    public static function store($request, $id = null)
    {
        $workshop = $request->only(['name','description','address_id','school_id','description','user_number','start_date','expired_date','time']);
        if (filled($request->image)) {
            $workshop['media_id'] = MediaLib::generateImageBase64($request->image);
        }
        $workshop = self::updateOrCreate(['id' => $id], $workshop);
        return $workshop;        
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
    public function address():BelongsTo{
        return $this->belongsTo(Address::class);
    }
}
