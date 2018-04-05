<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Papier extends Model {

	public $table = 'papier'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

    protected $fillable = ['idPapier', 'nom', 'description'];

}

?>
