<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
    ];

    const OCCUPATION = array(
        0 => "ADMIN",
        1 => "KINESIOLOGO",
        2 => "NUTRICIONISTA"
    );

    const IDENTIFIER = array(
        0 => "Adm.",
        1 => "Klgo.",
        2 => "Nutri."
    );

    public function records(){
        return $this
            ->hasMany(Record::class);
    }

    public function getUserFriendlyIdentifier()
    {
        $occupation = $this->occupation;
        $key = array_search($occupation, User::OCCUPATION);
        
        return User::IDENTIFIER[$key];
    }

    public function isAdmin()
    {
        $occupation = $this->occupation;
        if ($occupation == "ADMIN") {
            return true;
        } else {
            return false;
        }
    }
}
