<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Bagage extends Model {

	public $table = 'bagage'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

    protected $fillable = ['idBagage', 'nom'];

}

?>
