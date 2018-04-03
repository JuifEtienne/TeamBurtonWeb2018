<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model {

	public $table = 'voyage'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

    protected $fillable = ['idVoyage', 'nom', 'dateDebut', 'dateFin'];

}

