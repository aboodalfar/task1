<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserPrefixnameEnum;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'photo',
        'type',
        'email',
        'password',
    ];

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
        'prefixname'=>UserPrefixnameEnum::class
    ];
    /**
     * get full name of user
     */
    public function getFullnameAttribute():string{
        return "{$this->firstname} {$this->middlename} {$this->lastname}";
    }
    public function getPhotoAttribute($value):string{
        return $value ? asset('storage/avatars/'.$value) : 'http://www.gravatar.com/avatar/3b3be63a4c2a439b013787725dfce802?d=identicon';
    }

    public function getMiddleinitialAttribute():string{
       return preg_split("/[\s,_-]+/",explode(' ',$this->fullname)[0])[0];
    }
    /**
     * Get the details for the user.
     */
    public function details(): HasMany
    {
        return $this->hasMany(Detail::class);
    }
}
