<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormInput extends Model
{
    use HasFactory;
    protected $fillable = ['kategori_id','nama','organisasi','jabatan','jenis_anggota','nomor_anggota','alamat','kota','provinsi','nomor_telp','email','usaha','bukti_tf','dokumen_pendukung','info','jenis_kelamin','ttl','pekerjaan','jenis_foto','deskripsi','ukuran','status','validasi','validasi_bukti','portofolio'
    ];
    protected $attributes = [
        'status' => 'OPEN',
        'validasi' => 'off',
        'validasi_bukti' => 'off',
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function getActiveFieldsAttribute()
    {
        return $this->kategori->active_fields ?? [];
    }
}
