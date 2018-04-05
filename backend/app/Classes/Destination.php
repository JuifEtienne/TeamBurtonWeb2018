<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model {

	public $table = 'destination'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

    protected $fillable = ['idDestination', 'ville', 'dateArrivee', 'dateDepart', 'idPays', 'idFuseau'];

}

?>
