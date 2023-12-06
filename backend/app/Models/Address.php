<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;
    protected $fillable=[

        'name',
        'street',
        'link'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public static function address($request, $id=null){
        $address = $request->only(['name', 'street', 'link']);
        $address = self::updateOrCreate(['id'=>$id], $address);
        return $address;
    }
    public function school():BelongsTo{
        return $this->belongsTo(School::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function workshop():HasMany{
        return $this->hasMany(WorkShop::class);
    }

}
