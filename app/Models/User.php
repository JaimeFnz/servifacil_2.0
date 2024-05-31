<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dni',
        'name',
        'surname',
        'email',
        'password',
        'id_empresa',
        ''
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
     * Generate DNI following the specified pattern.
     *
     * @param int $number
     * @param string $letter
     * @return string
     */
    public static function generateDNI()
    {
        static $lastDNI = '00000004D';

        $number = substr($lastDNI, 0, 8);
        $letter = substr($lastDNI, 8, 1);

        $number = str_pad((int) $number + 1, 8, '0', STR_PAD_LEFT);
        $letter = chr(ord($letter) + 1);
        if ($letter > 'Z') {
            $letter = 'A';
        }

        $lastDNI = $number . $letter;

        return $lastDNI;
    }

    /**
     * Returns the id of the company that this user is 
     * working for 
     */
    public function workingFor()
    {
        return $this->id_empresa;
    }

    /**
     * Checks the user role
     */
    public function giveRole()
    {
        return strtoupper($this->puesto);
    }
    
    public function isAdmin()
    {
        return $this->puesto === 'admin';
    }
    public function isBoss()
    {
        return $this->puesto === 'jefe';
    }
    public function isWaiter()
    {
        return $this->puesto === 'camarero';
    }
    public function isCook()
    {
        return $this->puesto === 'cocinero';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * AdminLTE panel configuration
     * 
     */
    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return 'Administrador';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }



}