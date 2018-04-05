<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model {

	public $table = 'pays'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

    protected $fillable = ['idPays', 'nom', 'idMonnaie'];

}

?>
