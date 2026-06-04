<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Tambahkan ini
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama', 
        'email',
        'password',
        'role',
        'nis',
        'nip',
        'status',
        'avatar',
        'no_telp',
        'alamat',
        'xyz',
        'kelas_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public function kelasJoined(): BelongsTo
    {
        return $this->belongsTo(KelasUser::class, 'kelas_id');
    }

    /**
     * Relasi untuk Guru: Mengetahui daftar kelas yang dibuat oleh guru ini
     */
    public function kelasCreated(): HasMany
    {
        return $this->hasMany(KelasUser::class, 'teacher_id');
    }
}
