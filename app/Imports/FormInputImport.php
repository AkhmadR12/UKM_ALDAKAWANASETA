<?php

namespace App\Imports;

use App\Models\FormInput;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FormInputImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     return new FormInput([
    //         //
    //     ]);
    // }
    public function model(array $row)
    {
        return new FormInput([
            'kategori_id'       => $row['kategori_id'] ?? null,
            'nama'              => $row['nama'] ?? null,
            'organisasi'        => $row['organisasi'] ?? null,
            'nim'               => $row['nim'] ?? null,
            'semester'          => $row['semester'] ?? null,
            'program_studi'     => $row['program_studi'] ?? null,
            'fakultas'          => $row['fakultas'] ?? null,
            'alasan'            => $row['alasan'] ?? null,
            'jabatan'           => $row['jabatan'] ?? null,
            'jenis_anggota'     => $row['jenis_anggota'] ?? null,
            'nomor_anggota'     => $row['nomor_anggota'] ?? null,
            'alamat'            => $row['alamat'] ?? null,
            'kota'              => $row['kota'] ?? null,
            'provinsi'          => $row['provinsi'] ?? null,
            'nomor_telp'        => $row['nomor_telp'] ?? null,
            'email'             => $row['email'] ?? null,
            'usaha'             => $row['usaha'] ?? null,
            'bukti_tf'          => $row['bukti_tf'] ?? null,
            'dokumen_pendukung' => $row['dokumen_pendukung'] ?? null,
            'info'              => $row['info'] ?? null,
            'jenis_kelamin'     => $row['jenis_kelamin'] ?? null,
            'ttl'               => $row['ttl'] ?? null,
            'pekerjaan'         => $row['pekerjaan'] ?? null,
            'jenis_foto'        => $row['jenis_foto'] ?? null,
            'deskripsi'         => $row['deskripsi'] ?? null,
            'ukuran'            => $row['ukuran'] ?? null,
            'status'            => $row['status'] ?? 'OPEN',
            'validasi'          => $row['validasi'] ?? 'off',
            'validasi_bukti'    => $row['validasi_bukti'] ?? 'off',
            'portofolio'        => $row['portofolio'] ?? null,
        ]);
    }
}
