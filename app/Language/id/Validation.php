<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language settings
return [
    // Core Messages
    'noRuleSets'      => 'Tidak ada aturan yang ditentukan dalam konfigurasi Validasi.',
    'ruleNotFound'    => '{0} bukan sebuah aturan yang valid.',
    'groupNotFound'   => '{0} bukan sebuah grup aturan validasi.',
    'groupNotArray'   => '{0} grup aturan harus berupa sebuah array.',
    'invalidTemplate' => '{0} bukan sebuah template Validasi yang valid.',

    // Rule Messages
    'alpha'                 => '{field} hanya boleh mengandung karakter alfabet.',
    'alpha_dash'            => '{field} hanya boleh berisi karakter alfanumerik, setrip bawah, dan tanda pisah.',
    'alpha_numeric'         => '{field} hanya boleh berisi karakter alfanumerik.',
    'alpha_numeric_punct'   => '{field} hanya boleh berisi karakter alfanumerik, spasi, dan karakter ~! # $% & * - _ + = | :..',
    'alpha_numeric_space'   => '{field} hanya boleh berisi karakter alfanumerik dan spasi.',
    'alpha_space'           => '{field} hanya boleh berisi karakter alfabet dan spasi.',
    'decimal'               => '{field} harus mengandung sebuah angka desimal.',
    'differs'               => '{field} harus berbeda dari {param}.',
    'equals'                => '{field} harus persis: {param}.',
    'exact_length'          => '{field} harus tepat {param} panjang karakter.',
    'greater_than'          => '{field} harus berisi sebuah angka yang lebih besar dari {param}.',
    'greater_than_equal_to' => '{field} harus berisi sebuah angka yang lebih besar atau sama dengan {param}.',
    'hex'                   => '{field} hanya boleh berisi karakter heksadesimal.',
    'in_list'               => '{field} harus salah satu dari: {param}.',
    'integer'               => '{field} harus mengandung bilangan bulat.',
    'is_natural'            => '{field} hanya boleh berisi angka.',
    'is_natural_no_zero'    => '{field} hanya boleh berisi angka dan harus lebih besar dari nol.',
    'is_not_unique'         => '{field} harus berisi nilai yang sudah ada sebelumnya dalam database.',
    'is_unique'             => '{field} harus mengandung sebuah nilai unik.',
    'less_than'             => '{field} harus berisi sebuah angka yang kurang dari {param}.',
    'less_than_equal_to'    => '{field} harus berisi sebuah angka yang kurang dari atau sama dengan {param}.',
    'matches'               => '{field} tidak cocok dengan {param}.',
    'max_length'            => '{field} tidak bisa melebihi {param} panjang karakter.',
    'min_length'            => '{field} setidaknya harus {param} panjang karakter.',
    'not_equals'            => '{field} tidak boleh: {param}.',
    'not_in_list'           => '{field} tidak boleh salah satu dari: {param}.',
    'numeric'               => '{field} hanya boleh mengandung angka.',
    'regex_match'           => '{field} tidak dalam format yang benar.',
    'required'              => '{field} harus diisi.',
    'required_with'         => '{field} harus diisi saat {param} hadir.',
    'required_without'      => '{field} harus diisi saat {param} tidak hadir.',
    'string'                => '{field} harus berupa string yang valid.',
    'timezone'              => '{field} harus berupa sebuah zona waktu yang valid.',
    'valid_base64'          => '{field} harus berupa sebuah string base64 yang valid.',
    'valid_email'           => '{field} harus berisi sebuah alamat email yang valid.',
    'valid_emails'          => '{field} harus berisi semua alamat email yang valid.',
    'valid_ip'              => '{field} harus berisi sebuah IP yang valid.',
    'valid_url'             => '{field} harus berisi sebuah URL yang valid.',
    'valid_date'            => '{field} harus berisi sebuah tanggal yang valid.',

    // Credit Cards
    'valid_cc_num' => '{field} tidak tampak sebagai sebuah nomor kartu kredit yang valid.',

    // Files
    'uploaded' => '{field} bukan sebuah berkas diunggah yang valid.',
    'max_size' => '{field} terlalu besar dari sebuah berkas.',
    'is_image' => '{field} bukan berkas gambar diunggah yang valid.',
    'mime_in'  => '{field} tidak memiliki sebuah tipe mime yang valid.',
    'ext_in'   => '{field} tidak memiliki sebuah ekstensi berkas yang valid.',
    'max_dims' => '{field} bukan gambar, atau terlalu lebar atau tinggi.',
];
