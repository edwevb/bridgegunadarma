<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    
    //Custom Validation
    'alpha_spaces' => ':attribute may only contain letters and spaces.',
    
    //Default
    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => ':attribute may only contain letters.',
    'alpha_dash' => ':attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => ':attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => ':attribute must be between :min and :max.',
        'file' => ':attribute must be between :min and :max kilobytes.',
        'string' => ':attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => ':attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => ':attribute must be :digits digits.',
    'digits_between' => ':attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => ':attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => ':attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => ':attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ':attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute may not be greater than :max.',
        'file' => ':attribute may not be greater than :max kilobytes.',
        'string' => ':attribute may not be greater than :max characters.',
        'array' => ':attribute may not have more than :max items.',
    ],
    'mimes' => ':attribute must be a file of type: :values.',
    'mimetypes' => ':attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute must be at least :min.',
        'file' => ':attribute must be at least :min kilobytes.',
        'string' => ':attribute must be at least :min characters.',
        'array' => ':attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attribute must be a number.',
    'password' => 'Password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => ':attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => ':attribute and :other must match.',
    'size' => [
        'numeric' => ':attribute must be :size.',
        'file' => ':attribute must be :size kilobytes.',
        'string' => ':attribute must be :size characters.',
        'array' => ':attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => ':attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ':attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => ':attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'discipline' => [
            'between' => ':attribute must be between 1 - 10',
        ],
        'bidding' => [
            'between' => ':attribute must be between 1 - 10',
        ],
        'play' => [
            'between' => ':attribute must be between 1 - 10',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'nik'   => 'NIK/NPM',
        'atlet_name' => 'Nama',
        'tgl_lahir' => 'Tanggal Lahir',
        'telp' => 'Telp',
        'email' => 'Email',
        'gender' => 'Jenis Kelamin',
        'alamat' => 'Alamat',
        'fakultas' => 'Fakultas',
        'jurusan' => 'Jurusan',
        'angkatan' => 'Angkatan',
        'fb' => 'Facebook',
        'twt' => 'Twitter',
        'ig' => 'Instagram',
        'img_atlet' => 'Image / Picture',
        'eve_title' => 'Judul',
        'eve_isi' => 'Deskripsi',
        'eve_date' => 'Tanggal',
        'eve_loc' => 'Lokasi',
        'eve_url' => 'URL',
        'prizepool' => 'Prizepool',
        'fee_team_open' => 'Biaya Open',
        'fee_team_mhs' => 'Biaya Mahasiswa / U-26',
        'fee_team_u21' => 'Biaya Pelajar / U-21',
        'fee_pas_open' => 'Biaya Open',
        'fee_pas_mhs' => 'Biaya Mahasiswa / U-26',
        'fee_pas_u21' => 'Biaya Pelajar / U-21',
        'img_eve' => 'Image / Picture',
        'hist_title' => 'Judul',
        'hist_date' => 'Tanggal',
        'hist_loc' => 'Lokasi',
        'hist_dist' => 'File / Document',
        'hist_keterangan' => 'Deskripsi',
        'hist_loc' => 'Lokasi',
        'sk_tahun' => 'Tahun Ajaran',
        'sk_date' => 'Tanggal',
        'sk_bayar' => 'Jumlah Tunai',
        'p_date' => 'Tanggal',
        'p_biaya' => 'Biaya',
        'p_biaya' => 'Biaya',
        'atlet_id' => 'Nama Atlet',
        'discipline' => 'Kedisplinan',
        'bidding' => 'Penguasaan Sistem',
        'play' => 'Teknik Play',
        'mat_title' => 'Judul',
        'mat_date' => 'Tanggal',
        'file_mat' => 'File / Dokumen',
        'pre_title' => 'Nama Tournament / Event',
        'pre_date' => 'Tanggal',
        'pre_isi' => 'Deskripsi',
        'img_pre' => 'Image / Picture',
        'p_biaya' => 'Biaya',
        'name'  => 'Nama',
        'username' => 'Username',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
    ],

];
