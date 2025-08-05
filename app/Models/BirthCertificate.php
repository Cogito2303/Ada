<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
{
    protected $table = 'birth_certificate';
    protected $primaryKey = 'asking_number';
    public $incrementing = false;
    protected $fillable = [
    'asking_number',
    'child_name',
    'child_birthday',
    'father_name',
    'mother_name',
    'birth_certificate_num',
    'phone_num_1',
    'phone_num_2',
    'email',
    'residence',
    'neighborhood',
    'city',
    'municipal_office',
    'number_of_copies'
];

}
