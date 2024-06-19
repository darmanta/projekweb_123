<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmahasiswa extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $useAutoIncrement = true;

    // Field yang wajib di isi
    protected $allowedFields = ['nim', 'nama', 'tmplahir', 'tgllahir', 'jenkel'];
}
