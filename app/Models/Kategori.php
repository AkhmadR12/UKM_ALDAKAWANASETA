<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kategori', 'status', 'gambar', 'tanggal', 'lokasi', 'jam', 'deskripsi', 'active_fields'];

    protected $casts = [
        'active_fields' => 'array' // cast ke array
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }
    public function forms()
    {
        return $this->hasMany(FormInput::class);
    }
    
    // Accessor untuk mendapatkan field yang aktif
    public function getActiveFieldsAttribute($value)
    {
        if (is_null($value)) {
            return [];
        }
        
        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }
        
        return $value;
    }

    // Mutator untuk menyimpan active_fields
    public function setActiveFieldsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['active_fields'] = json_encode($value);
        } else {
            $this->attributes['active_fields'] = $value;
        }
    }

    // Relasi dengan FormInput
    public function formInputs()
    {
        return $this->hasMany(FormInput::class);
    }

    // Method untuk mengecek apakah kategori memiliki field aktif
    public function hasActiveFields()
    {
        return !empty($this->active_fields);
    }

    // Method untuk mendapatkan field berdasarkan nama
    public function getFieldByName($fieldName)
    {
        if (!$this->hasActiveFields()) {
            return null;
        }

        foreach ($this->active_fields as $field) {
            if ($field['name'] === $fieldName) {
                return $field;
            }
        }

        return null;
    }

    // Method untuk mendapatkan field yang required
    public function getRequiredFields()
    {
        if (!$this->hasActiveFields()) {
            return [];
        }

        return array_filter($this->active_fields, function($field) {
            return isset($field['required']) && $field['required'] === true;
        });
    }
}
