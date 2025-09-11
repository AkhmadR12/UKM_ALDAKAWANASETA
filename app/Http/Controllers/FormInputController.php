<?php

namespace App\Http\Controllers;

use App\Models\FormInput;
use App\Models\Kategori;
use App\Services\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FormInputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = FormInput::all();
        // $kategoris = Kategori::all(); // ambil semua kategori untuk dropdown
        $kategoris = Kategori::where('status', 'aktif')->get();

        return view('admin.form.index', compact('forms', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $forms = FormInput::all();
        return view('admin.form.create', compact('forms'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $kategori = Kategori::findOrFail($request->kategori_id);
        $activeFields = $kategori->active_fields ?? [];

        // Buat rules validasi dinamis
        $rules = ['kategori_id' => 'required|exists:kategoris,id'];

        $allRules = [
            'kategori_id' => 'required|exists:kategoris,id',
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

        foreach ($activeFields as $field) {
            if (isset($allRules[$field])) {
                $rules[$field] = $allRules[$field];
            }
        }

        $validated = $request->validate($rules);
        // Set default values
        $validated['status'] = 'OPEN';
        $validated['validasi'] = 'off';
        $validated['validasi_bukti'] = 'off';
        // Upload file hanya untuk field yang aktif
        $fileFields = array_intersect($activeFields, ['bukti_tf', 'dokumen_pendukung', 'portofolio']);
        // Upload file secara aman dan hanya jika ada
        // foreach (['bukti_tf', 'dokumen_pendukung', 'portofolio'] as $field) {
        //     if ($request->hasFile($field)) {
        //         $file = $request->file($field);
        //         $filename = time() . '_' . $file->getClientOriginalName();
        //         $destination = public_path("uploads/{$field}");
        //         if (!file_exists($destination)) {
        //             mkdir($destination, 0777, true);
        //         }
        //         $file->move($destination, $filename);
        //         $validated[$field] = "uploads/{$field}/{$filename}";
        //     }
        // }

        // // Simpan data ke database
        // FormInput::create($validated);
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path("uploads/{$field}");

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $validated[$field] = "uploads/{$field}/{$filename}";
            }
        }

        FormInput::create($validated);

        return redirect()->back()->with('success', 'Form berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $formInput = FormInput::findOrFail($id);

        // Jika tombol "Tolak" ditekan
        if ($request->has('reject')) {
            if ($formInput->status == 'INPG') {
                $formInput->update([
                    'status' => 'BATAL',
                    'validasi' => 'off',
                    'validasi_bukti' => 'off'
                ]);
                return redirect()->back()->with('success', 'Form berhasil ditolak.');
            } else {
                return redirect()->back()->with('error', 'Form tidak bisa ditolak pada status ini.');
            }
        }

        // Jika tombol "Finalisasi" ditekan
        switch ($formInput->status) {
            case 'OPEN':
                $formInput->update([
                    'status' => 'INPG',
                    'validasi' => 'on',
                    'validasi_bukti' => 'off'
                ]);
                break;

            case 'INPG':
                // Finalisasi hanya jika checkbox diisi
                if ($request->has('final_approve')) {
                    $formInput->update([
                        'status' => 'CLSD',
                        'validasi' => 'on',
                        'validasi_bukti' => 'on'
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Final approval harus dicentang.');
                }
                break;

            default:
                return redirect()->back()->with('error', 'Status tidak dapat diubah lagi.');
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formInput = FormInput::findOrFail($id);
        $kategoris = Kategori::all(); // Jika diperlukan untuk dropdown

        return view('admin.form.show', compact('formInput', 'kategoris'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $formInput = FormInput::findOrFail($id);

        // Jika status sudah CLSD, tidak bisa diedit lagi
        if ($formInput->status === 'CLSD') {
            return redirect()->route('form-input.index')
                ->with('error', 'Data yang sudah CLSD tidak dapat diubah.');
        }

        $kategoris = Kategori::all(); // Jika diperlukan untuk dropdown

        return view('admin.form.edit', compact('formInput', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $formInput = FormInput::findOrFail($id);

        // Validasi data input
        $validated = $request->validate([
            // 'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'nullable|string|max:255',
            // ... validasi lainnya sama seperti store ...
            'bukti_tf' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'portofolio' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'approve' => 'nullable|boolean', // Checkbox untuk approval
        ]);

        // Handle file uploads
        foreach (['bukti_tf', 'dokumen_pendukung', 'portofolio'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($formInput->$field) {
                    Storage::disk('public')->delete($formInput->$field);
                }
                $validated[$field] = $request->file($field)->store("uploads/{$field}", 'public');
            } else {
                // Pertahankan nilai yang sudah ada jika tidak diupdate
                unset($validated[$field]);
            }
        }

        // Handle status update jika checkbox approve dicentang
        // if ($request->has('approve') && $request->approve) {
        //     switch ($formInput->status) {
        //         case 'OPEN':
        //             $validated['status'] = 'INPG';
        //             $validated['validasi'] = 'on';
        //             $validated['validasi_bukti'] = 'off';
        //             break;

        //         case 'INPG':
        //             $validated['status'] = 'CLSD';
        //             $validated['validasi'] = 'on';
        //             $validated['validasi_bukti'] = 'off';
        //             break;
        //     }
        // }
        // Handle status changes
        if ($request->has('reject') && $request->reject && $formInput->status === 'OPEN') {
            $validated['status'] = 'BATAL';
            $validated['validasi'] = 'off';
            $validated['validasi_bukti'] = 'off';
        } elseif ($request->has('approve') && $request->approve && $formInput->status === 'OPEN') {
            $validated['status'] = 'INPG';
            $validated['validasi'] = 'on';
            $validated['validasi_bukti'] = 'off';
        }

        $formInput->update($validated);

        return redirect()->route('form_inputs.index')
            ->with('success', 'Data berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function public_create()
    // {
    //     // Ambil semua kategori yang aktif
    //     $kategoris = Kategori::where('status', 'aktif')->get();
    //     // Ambil satu kategori aktif pertama (opsional untuk tampil di atas)
    //     $kategori = $kategoris->first();

    //     return view('frontend.form', compact('kategoris', 'kategori'));
    // }
    public function public_index()
    {
        $kategoris = Kategori::active()->get();

        return view('frontend.form.form_index', compact('kategoris'));
    }
    // public function public_create()
    // {
    //     $kategoris = Kategori::where('status', 'aktif')->get();

    //     if ($kategoris->isEmpty()) {
    //         return view('frontend.form.form_create', ['kategoris' => [], 'kategori' => null]);
    //     }

    //     $kategori = $kategoris->first();

    //     return view('frontend.form.form_create', compact('kategoris', 'kategori'));
    // }
    public function public_create($id)
    {
        $kategori = Kategori::active()->findOrFail($id);
        $kategoris = Kategori::active()->get();

        // Cek apakah kategori memiliki active_fields
        if (!$kategori->active_fields || empty($kategori->active_fields)) {
            $kategori = null; // Set null untuk menampilkan pesan warning
        }

        return view('frontend.form.form_create', compact('kategori', 'kategoris'));
    }
    public function getFields($id)
    {
        try {
            $kategori = Kategori::active()->find($id);

            if (!$kategori) {
                return response()->json([
                    'fields' => [],
                    'error' => 'Kategori tidak ditemukan atau tidak aktif'
                ], 404);
            }

            // Debug: Log kategori data
            Log::info('Kategori data:', [
                'id' => $kategori->id,
                'nama' => $kategori->nama_kategori,
                'active_fields' => $kategori->active_fields
            ]);

            // Pastikan active_fields ada dan tidak kosong
            if (!$kategori->active_fields || empty($kategori->active_fields)) {
                return response()->json([
                    'fields' => [],
                    'message' => 'Tidak ada field aktif untuk kategori ini'
                ]);
            }

            // Cek apakah active_fields berupa array string atau array object
            $fields = $kategori->active_fields;
            $validFields = [];

            foreach ($fields as $field) {
                if (is_string($field)) {
                    // Jika berupa string, konversi ke format object dengan default values
                    $fieldObject = $this->convertStringToFieldObject($field);
                    if ($fieldObject) {
                        $validFields[] = $fieldObject;
                    }
                } elseif (is_array($field)) {
                    // Jika sudah berupa object, validasi properties
                    if (isset($field['name']) && isset($field['type']) && isset($field['label'])) {
                        $validFields[] = $field;
                    } else {
                        Log::warning('Invalid field found', ['field' => $field]);
                    }
                }
            }

            return response()->json([
                'fields' => $validFields,
                'message' => 'Fields berhasil dimuat',
                'total_fields' => count($validFields)
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getFields', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'fields' => [],
                'error' => 'Terjadi kesalahan internal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Convert string field name to field object with default configuration
     */
    private function convertStringToFieldObject($fieldName)
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



    // public function public_store(Request $request)
    // {
    //     // Validasi form input
    //     $validated = $request->validate([
    //         'kategori_id' => 'required|exists:kategoris,id',
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'pekerjaan' => 'required|in:Profesi,Hobi',
    //         'alamat' => 'required|string|max:255',
    //         'bukti_tf' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //         'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
    //         'organisasi' => 'nullable|string|max:255',
    //         'jabatan' => 'nullable|string|max:255',
    //         'jenis_anggota' => 'nullable|string|max:255',
    //         'nomor_anggota' => 'nullable|string|max:100',
    //         'kota' => 'nullable|string|max:100',
    //         'provinsi' => 'nullable|string|max:100',
    //         'nomor_telp' => 'nullable|string|max:20',
    //         'usaha' => 'nullable|string|max:255',
    //         'info' => 'nullable|string|max:255',
    //         'ttl' => 'nullable|string|max:255',
    //         'jenis_foto' => 'nullable|string|max:100',
    //         'deskripsi' => 'nullable|string',
    //         'ukuran' => 'nullable|in:S,M,L,XL,XXL,XXXL',
    //         'dokumen_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //         'portofolio' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    //     ]);

    //     // Proses upload file
    //     // foreach (['bukti_tf', 'dokumen_pendukung', 'portofolio'] as $field) {
    //     //     if ($request->hasFile($field)) {
    //     //         $validated[$field] = $request->file($field)->store("uploads/{$field}", 'public');
    //     //     }
    //     // }
    //     foreach (['bukti_tf', 'dokumen_pendukung', 'portofolio'] as $field) {
    //         if ($request->hasFile($field)) {
    //             $file = $request->file($field);
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             $destination = public_path("uploads/{$field}");
    //             if (!file_exists($destination)) {
    //                 mkdir($destination, 0777, true);
    //             }
    //             $file->move($destination, $filename);
    //             $validated[$field] = "uploads/{$field}/{$filename}";
    //         }
    //     }
    //     // Tambahan default nilai
    //     $validated['status'] = 'OPEN';
    //     $validated['validasi'] = 'off';
    //     $validated['validasi_bukti'] = 'off';

    //     // Simpan ke DB
    //     FormInput::create($validated);

    //     return redirect()->route('public.form-input.create')
    //         ->with('success', 'Form berhasil disimpan. Terima kasih telah mengisi formulir.');
    // }
    public function public_store(Request $request)
    {
        try {
            // Dapatkan rules validasi berdasarkan kategori menggunakan FormBuilder
            $rules = \App\Helpers\FormBuilder::getFieldRules($request->kategori_id);

            if (empty($rules)) {
                return redirect()->back()
                    ->with('error', 'Tidak ada field aktif untuk kategori ini.');
            }

            $validated = $request->validate($rules);

            // Set default values
            $validated['kategori_id'] = $request->kategori_id;
            $validated['status'] = 'OPEN';
            $validated['validasi'] = 'off';
            $validated['validasi_bukti'] = 'off';

            // Upload file hanya untuk field yang aktif
            $activeFields = \App\Helpers\FormBuilder::getActiveFields($request->kategori_id);
            $kategori = Kategori::find($request->kategori_id);

            foreach ($kategori->active_fields as $field) {
                if ($field['type'] === 'file' && $request->hasFile($field['name'])) {
                    $file = $request->file($field['name']);
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $destination = public_path("uploads/{$field['name']}");

                    if (!file_exists($destination)) {
                        mkdir($destination, 0777, true);
                    }

                    $file->move($destination, $filename);
                    $validated[$field['name']] = "uploads/{$field['name']}/{$filename}";
                }
            }

            // Hanya simpan field yang aktif
            $dataToSave = array_intersect_key($validated, array_flip(array_merge($activeFields, ['kategori_id', 'status', 'validasi', 'validasi_bukti'])));

            FormInput::create($dataToSave);

            return redirect()->route('public.form-input.create', $request->kategori_id)
                ->with('success', 'Form berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
    /**
     * Build validation rules based on active fields
     */
    private function buildValidationRules($activeFields)
    {
        $rules = [];

        foreach ($activeFields as $field) {
            $fieldRules = [];

            // Add required rule if specified
            if (isset($field['required']) && $field['required']) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }

            // Add type-specific rules
            switch ($field['type']) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'file':
                    $fieldRules[] = 'file';
                    if (isset($field['max_size'])) {
                        $fieldRules[] = 'max:' . $field['max_size'];
                    }
                    if (isset($field['accept'])) {
                        // Convert accept attribute to validation rule
                        $mimes = str_replace(['.', 'image/', 'application/'], '', $field['accept']);
                        $fieldRules[] = 'mimes:' . $mimes;
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
                    if (isset($field['max_length'])) {
                        $fieldRules[] = 'max:' . $field['max_length'];
                    }
                    break;
            }

            $rules[$field['name']] = $fieldRules;
        }

        return $rules;
    }

    /**
     * Handle file uploads for active fields
     */
    private function handleFileUploads($request, $validated, $activeFields)
    {
        foreach ($activeFields as $field) {
            if ($field['type'] === 'file' && $request->hasFile($field['name'])) {
                $file = $request->file($field['name']);
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path("uploads/{$field['name']}");

                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }

                $file->move($destination, $filename);
                $validated[$field['name']] = "uploads/{$field['name']}/{$filename}";
            }
        }

        return $validated;
    }


    /**
     * Filter data to only include active fields
     */
    private function filterActiveFields($validated, $activeFields)
    {
        $activeFieldNames = array_column($activeFields, 'name');
        $activeFieldNames[] = 'kategori_id'; // Always include kategori_id
        $activeFieldNames[] = 'status';
        $activeFieldNames[] = 'validasi';
        $activeFieldNames[] = 'validasi_bukti';

        return array_intersect_key($validated, array_flip($activeFieldNames));
    }

    public function showForm($kategoriId)
    {
        $kategori = Kategori::findOrFail($kategoriId);
        $kategoris = Kategori::where('status', 'aktif')->get();

        return view('frontend.form.form', compact('kategori', 'kategoris'));
    }

    public function getFieldsConfig($kategoriId)
    {
        $kategori = Kategori::find($kategoriId);

        if (!$kategori) {
            return response()->json(['fields' => []]);
        }

        $activeFields = $kategori->active_fields ?? [];
        $fieldConfigs = [];

        $allFields = [
            'nama' => ['type' => 'text', 'label' => 'Nama Lengkap', 'required' => true],
            'email' => ['type' => 'email', 'label' => 'Email', 'required' => true],
            'jenis_kelamin' => [
                'type' => 'radio',
                'label' => 'Jenis Kelamin',
                'required' => true,
                'options' => [
                    ['value' => 'Laki-laki', 'label' => 'Laki-laki'],
                    ['value' => 'Perempuan', 'label' => 'Perempuan']
                ]
            ],
            'pekerjaan' => [
                'type' => 'radio',
                'label' => 'Pekerjaan',
                'required' => true,
                'options' => [
                    ['value' => 'Profesi', 'label' => 'Profesi'],
                    ['value' => 'Hobi', 'label' => 'Hobi']
                ]
            ],
            'ukuran' => [
                'type' => 'radio',
                'label' => 'ukuran',
                'required' => true,
                'options' => [
                    ['value' => 'S', 'label' => 'S'],
                    ['value' => 'M', 'label' => 'M'],
                    ['value' => 'L', 'label' => 'L'],
                    ['value' => 'XL', 'label' => 'XL'],
                    ['value' => 'XXL', 'label' => 'XXL']
                ]
            ],
            'alamat' => ['type' => 'text', 'label' => 'Alamat', 'required' => true],
            'bukti_tf' => ['type' => 'file', 'label' => 'Bukti Transfer', 'required' => true],
            'organisasi' => ['type' => 'text', 'label' => 'Organisasi', 'required' => true],
            'jabatan' => ['type' => 'text', 'label' => 'Jabatan', 'required' => true],
            'jenis_anggota' => ['type' => 'text', 'label' => 'Jenis Anggota', 'required' => true],
            'kota' => ['type' => 'text', 'label' => 'Kota', 'required' => true],
            'provinsi' => ['type' => 'text', 'label' => 'Provinsi', 'required' => true],
            'nomor_telp' => ['type' => 'text', 'label' => 'Nomor Telp', 'required' => true],
            'usaha' => ['type' => 'text', 'label' => 'Usaha', 'required' => true],
            'dokumen_pendukung' => ['type' => 'file', 'label' => 'Dokumen Pendukung', 'required' => true],
            'info' => ['type' => 'text', 'label' => 'info', 'required' => true],
            'ttl' => ['type' => 'text', 'label' => 'Ttl', 'required' => true],
            'jenis_foto' => ['type' => 'text', 'label' => 'Jenis Foto', 'required' => true],
            'deskripsi' => ['type' => 'text', 'label' => 'Jeskripsi', 'required' => true],
            'portofolio' => ['type' => 'text', 'label' => 'Portofolio', 'required' => true],
            // Tambahkan field lainnya sesuai kebutuhan
        ];

        foreach ($activeFields as $field) {
            if (isset($allFields[$field])) {
                $fieldConfigs[] = array_merge(['name' => $field], $allFields[$field]);
            }
        }

        return response()->json(['fields' => $fieldConfigs]);
    }
    public function testActiveFields($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['error' => 'Kategori not found'], 404);
        }

        return response()->json([
            'kategori' => $kategori->nama_kategori,
            'status' => $kategori->status,
            'active_fields' => $kategori->active_fields,
            'has_active_fields' => $kategori->hasActiveFields(),
            'active_field_names' => \App\Helpers\FormBuilder::getActiveFields($id),
            'validation_rules' => \App\Helpers\FormBuilder::getFieldRules($id)
        ]);
    }
    public function seedSampleKategori()
    {
        $sampleFields = [
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
                'name' => 'umur',
                'type' => 'number',
                'label' => 'Umur',
                'required' => false
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

        $kategori = Kategori::create([
            'nama_kategori' => 'Workshop Fotografi 2025',
            'deskripsi' => 'Workshop fotografi untuk pemula dan menengah',
            'tanggal' => '2025-08-15',
            'jam' => '09:00',
            'lokasi' => 'Jakarta Convention Center',
            'description' => 'Workshop 2 hari dengan materi lengkap',
            'status' => true,
            'active_fields' => $sampleFields
        ]);

        return response()->json([
            'message' => 'Sample kategori created successfully',
            'kategori' => $kategori
        ]);
    }
}
