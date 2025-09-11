<?php

namespace App\Services;

use App\Models\Kategori;

class FormBuilder
{
    public static function getFieldRules($kategoriId)
    {
        $kategori = Kategori::find($kategoriId);
        $activeFields = $kategori->active_fields ?? [];

        $allRules = [
            'nama' => 'nullable|string|max:255',
            'organisasi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'jenis_anggota' => 'nullable|string|max:255',
            'nomor_anggota' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'nomor_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'usaha' => 'nullable|string|max:255',
            'info' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'ttl' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|in:Profesi,Hobi',
            'jenis_foto' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'ukuran' => 'nullable|in:S,M,L,XL,XXL,XXXL',
            'bukti_tf' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'portofolio' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];

        $rules = ['kategori_id' => 'required|exists:kategoris,id'];

        foreach ($activeFields as $field) {
            if (isset($allRules[$field])) {
                $rules[$field] = $allRules[$field];
            }
        }

        return $rules;
    }

    public static function getActiveFields($kategoriId)
    {
        $kategori = Kategori::find($kategoriId);
        return $kategori->active_fields ?? [];
    }
    public static function buildFormFields($activeFields)
    {
        $allFields = [
            'nama' => ['type' => 'text', 'label' => 'Nama Lengkap'],
            'alamat' => ['type' => 'textarea', 'label' => 'Alamat'],
            'bukti_tf' => ['type' => 'file', 'label' => 'Bukti Transfer'],
            'organisasi' => ['type' => 'text', 'label' => 'Organisasi'],
            'jabatan' => ['type' => 'text', 'label' => 'Jabatan'],
            'jenis_anggota' => ['type' => 'text', 'label' => 'Jenis Anggota'],
            'nomor_anggota' => ['type' => 'text', 'label' => 'Nomor Anggota'],
            'kota' => ['type' => 'text', 'label' => 'Kota'],
            'provinsi' => ['type' => 'text', 'label' => 'Provinsi'],
            'nomor_telp' => ['type' => 'text', 'label' => 'Nomor Telp'],
            'email' => ['type' => 'text', 'label' => 'Email'],
            'usaha' => ['type' => 'text', 'label' => 'Usaha'],
            'dokumen_pendukung' => ['type' => 'file', 'label' => 'Dokumen Pendukung'],
            'info' => ['type' => 'text', 'label' => 'Info'],
        ];

        $result = [];
        foreach ($activeFields as $field) {
            if (isset($allFields[$field])) {
                $result[$field] = $allFields[$field];
            }
        }

        return $result;
    }
    public static function getFields($kategoriId)
    {
        $kategori = Kategori::find($kategoriId);
        if (!$kategori) {
            return response()->json(['fields' => []]);
        }

        // Asumsikan active_fields adalah array of field konfigurasi
        return response()->json([
            'fields' => $kategori->active_fields
        ]);
    }
}
