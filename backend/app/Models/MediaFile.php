<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    public static $staticMakeVisible;

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

        if (isset(self::$staticMakeVisible)){
            $this->makeVisible(self::$staticMakeVisible);
        }
    }

    public function __destruct()
    {
        self::$staticMakeVisible = null;
    }

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'media_file',
        'file_url',
        'file_name',
        'file_type',
        'size',
        'media_id',
    ];

    protected $hidden = [
        'id',
        'media_id',
        'laravel_through_key',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'media_id' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function media()
    {
        return $this->belongsTo(
            Media::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

    function getFileUrlAttribute($value) {
        return url('/') . $value;
    }
}

