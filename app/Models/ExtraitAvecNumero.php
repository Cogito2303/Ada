<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraitAvecNumero extends Model
{
    //
    protected $table = 'extrait_avec_numero';
    protected $primaryKey = 'numero_demande';
    protected $attributes = [
        'numero_demande' => 'DEFAULT_VALUE', // Remplacez DEFAULT_VALUE par la valeur souhaitée
    ];
    public $incrementing = false;
    protected $fillable = [
        'nom_enfant',
        'date_naissance',
        'nom_pere',
        'nom_mere',
        'numero_extrait',
        'contact_1',
        'contact_2',
        'email',
        'lieu_habitation',
        'quartier',
        'ville_cible',
        'mairie_cible'
    ];
}
