<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_member';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_member', 'user_id', 'name', 'phone', 'email', 'photo', 'barcode_path', 'status', 'kota_id', 'tanggal_bergabung', 'bukti_tf', 'payment_method', 'tanggal_berakhir', 'status_pembayaran'];

    public function kota()
    {
        return $this->belongsTo(KabupatenKota::class, 'kota_id');
    }
    protected $casts = [
        'tanggal_bergabung' => 'date',
        'tanggal_berakhir' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
