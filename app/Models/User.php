<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Order;

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
        'role',
        'password',
        'subdep_kode',
        'withdrawn_amount',
        'contact',
        'ttl',
        'kelamin',
        'kota_id',
        'photo',
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
        'ttl' => 'date',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function subdep()
    {
        return $this->belongsTo(Subdep::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function member()
    {
        return $this->hasOne(Member::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            if ($user->role === 'member') {
                // You can add member-specific initialization here if needed
            }
        });
    }
    public function kota()
    {
        return $this->belongsTo(KabupatenKota::class, 'kota_id');
    }
    public function getGenderDisplayAttribute()
    {
        return $this->kelamin ? ucfirst($this->kelamin) : 'Not specified';
    }

    /**
     * Accessor untuk formatted date of birth
     */
    public function getTtlFormattedAttribute()
    {
        return $this->ttl ? $this->ttl->format('d F Y') : 'Not provided';
    }
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
