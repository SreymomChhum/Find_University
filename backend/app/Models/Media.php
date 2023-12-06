<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    protected $table = 'medias';

    protected $fillable = [
        'media_type',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function file()
    {
        return $this->hasMany(
            MediaFile::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Static Method
    |--------------------------------------------------------------------------
    */

    public static function getMediaById($id)
    {
        return Media::where('media_id', $id)->with('file')->get()->first();
    }

    /**
     * get media id
     *
     * @param $id
     * @return mixed
     */
    public static function ID($id = null)
    {
        if ($id != null) {
            return Media::find($id)->id;
        }

        return null;

    }
}
