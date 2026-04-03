<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
            'nama_lengkap', 'username', 'password', 'telp', 'role_id'
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Helper untuk cek role di middleware nanti
    public function isAdmin() { return $this->role->nama_role === 'admin'; }
    public function isPetugas() { return $this->role->nama_role === 'petugas'; }
    public function isMasyarakat() { return $this->role->nama_role === 'masyarakat'; }

}
