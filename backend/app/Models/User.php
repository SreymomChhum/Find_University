<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'role_id',
        'address_id',
        'school_id',
        'phone',
        'gender'
    ];

    public static function store($request, $id = null)
    {
        $user = $request->only([
            'name',
            'email',
            'password',
            'phone',
            'gender',
            'role_id',
            'address_id',
            'school_id',
            'phone',
            'gender'
        ]);
        $user['password'] = Hash::make($user['password']);

        $user = self::create($user);
        $id = $user->$id;

        return $user;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function scholarships(): HasMany
    {
        return $this->hasMany(ScholarShip::class);
    }

    public function workshops(): HasMany
    {
        return $this->hasMany(WorkShop::class);
    }
    
    public function schoolUser(): HasMany
    {
        return $this->hasMany(SchoolUser::class);
    }

    public function school(): HasOne
    {
        return $this->hasOne(School::class);
    }
}
