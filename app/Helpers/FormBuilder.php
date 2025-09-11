<?php

namespace App\Helpers;

use App\Models\Kategori;

class FormBuilder
{
    /**
     * Get active fields for a kategori
     */
    // public static function getActiveFields($kategoriId)
    // {
    //     $kategori = Kategori::find($kategoriId);

    //     if (!$kategori || !$kategori->hasActiveFields()) {
    //         return [];
    //     }

    //     return array_column($kategori->active_fields, 'name');
    // }
    public static function getActiveFields($kategoriId)
    {
        $kategori = Kategori::find($kategoriId);

        if (!$kategori || !$kategori->hasActiveFields()) {
            return [];
        }

        $fields = $kategori->active_fields;
        $fieldNames = [];

        foreach ($fields as $field) {
            if (is_string($field)) {
                $fieldNames[] = $field;
            } elseif (is_array($field) && isset($field['name'])) {
                $fieldNames[] = $field['name'];
            }
        }

        return $fieldNames;
    }

    /**
     * Get field rules for validation
     */
    public static function getFieldRules($kategoriId)
    {
        $kategori = Kategori::find($kategoriId);

        if (!$kategori || !$kategori->hasActiveFields()) {
            return [];
        }

        $rules = [];
        $fields = $kategori->active_fields;

        foreach ($fields as $field) {
            $fieldConfig = null;

            if (is_string($field)) {
                // Konversi string ke field object
                $fieldConfig = self::getFieldMapping($field);
            } elseif (is_array($field)) {
                $fieldConfig = $field;
            }

            if (!$fieldConfig || !isset($fieldConfig['name'])) {
                continue;
            }

            $fieldRules = [];

            // Add required rule if specified
            if (isset($fieldConfig['required']) && $fieldConfig['required']) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            // Add type-specific rules
            switch ($fieldConfig['type']) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    if (isset($fieldConfig['max_size'])) {
                        $fieldRules[] = 'max:' . $fieldConfig['max_size'];
                    }
                    if (isset($fieldConfig['accept'])) {
                        // Convert accept attribute to validation rule
                        $acceptTypes = explode(',', $fieldConfig['accept']);
                        $mimes = [];
                        foreach ($acceptTypes as $type) {
                            $type = trim($type);
                            if (strpos($type, 'image/') === 0) {
                                $mimes[] = str_replace('image/', '', $type);
                            } elseif (strpos($type, '.') === 0) {
                                $mimes[] = substr($type, 1);
                            }
                        }
                        if (!empty($mimes)) {
                            $fieldRules[] = 'mimes:' . implode(',', $mimes);
                        }
                    }
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'time':
                    $fieldRules[] = 'date_format:H:i';
                    break;
                case 'text':
                case 'textarea':
                    if (isset($fieldConfig['max_length'])) {
                        $fieldRules[] = 'max:' . $fieldConfig['max_length'];
                    }
                    break;
            }

            $rules[$fieldConfig['name']] = $fieldRules;
        }

        return $rules;
    }
    public static function getFieldMapping($fieldName)
    {
        $fieldMappings = [
            'nama' => [
                'name' => 'nama',
                'type' => 'text',
                'label' => 'Nama Lengkap',
                'required' => true
            ],
            'organisasi' => [
                'name' => 'organisasi',
                'type' => 'text',
                'label' => 'Organisasi',
                'required' => false
            ],
            'jenis_anggota' => [
                'name' => 'jenis_anggota',
                'type' => 'radio',
                'label' => 'Jenis Anggota',
                'required' => true,
                'options' => [
                    ['value' => 'Anggota Baru', 'label' => 'Anggota Baru'],
                    ['value' => 'Anggota Lama', 'label' => 'Anggota Lama']
                ]
            ],
            'alamat' => [
                'name' => 'alamat',
                'type' => 'textarea',
                'label' => 'Alamat',
                'required' => true
            ],
            'kota' => [
                'name' => 'kota',
                'type' => 'text',
                'label' => 'Kota',
                'required' => true
            ],
            'provinsi' => [
                'name' => 'provinsi',
                'type' => 'text',
                'label' => 'Provinsi',
                'required' => true
            ],
            'nomor_telp' => [
                'name' => 'nomor_telp',
                'type' => 'text',
                'label' => 'Nomor Telepon',
                'required' => true
            ],
            'email' => [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'required' => true
            ],
            'bukti_tf' => [
                'name' => 'bukti_tf',
                'type' => 'file',
                'label' => 'Bukti Transfer',
                'required' => true,
                'accept' => 'image/*,.pdf',
                'description' => 'Upload bukti transfer (JPG, PNG, PDF, max 2MB)'
            ],
            'dokumen_pendukung' => [
                'name' => 'dokumen_pendukung',
                'type' => 'file',
                'label' => 'Dokumen Pendukung',
                'required' => false,
                'accept' => 'image/*,.pdf',
                'description' => 'Upload dokumen pendukung jika ada'
            ],
            'jenis_kelamin' => [
                'name' => 'jenis_kelamin',
                'type' => 'radio',
                'label' => 'Jenis Kelamin',
                'required' => true,
                'options' => [
                    ['value' => 'Laki-laki', 'label' => 'Laki-laki'],
                    ['value' => 'Perempuan', 'label' => 'Perempuan']
                ]
            ],
            'ttl' => [
                'name' => 'ttl',
                'type' => 'date',
                'label' => 'Tanggal Lahir',
                'required' => true
            ],
            'pekerjaan' => [
                'name' => 'pekerjaan',
                'type' => 'text',
                'label' => 'Pekerjaan',
                'required' => true
            ],
            'ukuran' => [
                'name' => 'ukuran',
                'type' => 'select',
                'label' => 'Ukuran Baju',
                'required' => false,
                'options' => [
                    ['value' => 'S', 'label' => 'S (Small)'],
                    ['value' => 'M', 'label' => 'M (Medium)'],
                    ['value' => 'L', 'label' => 'L (Large)'],
                    ['value' => 'XL', 'label' => 'XL (Extra Large)'],
                    ['value' => 'XXL', 'label' => 'XXL (Double Extra Large)']
                ]
            ]
        ];

        return $fieldMappings[$fieldName] ?? null;
    }
    /**
     * Get default field configurations
     */
    public static function getDefaultFields()
    {
        return [
            [
                'name' => 'nama',
                'type' => 'text',
                'label' => 'Nama Lengkap',
                'required' => true,
                'max_length' => 255
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'required' => true
            ],
            [
                'name' => 'jenis_kelamin',
                'type' => 'radio',
                'label' => 'Jenis Kelamin',
                'required' => true,
                'options' => [
                    ['value' => 'Laki-laki', 'label' => 'Laki-laki'],
                    ['value' => 'Perempuan', 'label' => 'Perempuan']
                ]
            ],
            [
                'name' => 'pekerjaan',
                'type' => 'radio',
                'label' => 'Pekerjaan',
                'required' => true,
                'options' => [
                    ['value' => 'Profesi', 'label' => 'Profesi'],
                    ['value' => 'Hobi', 'label' => 'Hobi']
                ]
            ],
            [
                'name' => 'alamat',
                'type' => 'textarea',
                'label' => 'Alamat',
                'required' => true,
                'max_length' => 500
            ],
            [
                'name' => 'bukti_tf',
                'type' => 'file',
                'label' => 'Bukti Transfer',
                'required' => true,
                'accept' => 'image/*,.pdf',
                'max_size' => 2048,
                'description' => 'Upload bukti transfer (JPG, PNG, PDF, max 2MB)'
            ]
        ];
    }

    /**
     * Validate field configuration
     */
    public static function validateFieldConfig($field)
    {
        $required = ['name', 'type', 'label'];

        foreach ($required as $key) {
            if (!isset($field[$key]) || empty($field[$key])) {
                return false;
            }
        }

        $allowedTypes = ['text', 'email', 'number', 'textarea', 'radio', 'select', 'file', 'date', 'time'];

        if (!in_array($field['type'], $allowedTypes)) {
            return false;
        }

        // Validate radio and select options
        if (in_array($field['type'], ['radio', 'select'])) {
            if (!isset($field['options']) || !is_array($field['options']) || empty($field['options'])) {
                return false;
            }

            foreach ($field['options'] as $option) {
                if (!isset($option['value']) || !isset($option['label'])) {
                    return false;
                }
            }
        }

        return true;
    }
}
