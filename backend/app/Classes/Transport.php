<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model {

	public $table = 'transport'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

    protected $fillable = ['idTransport', 'nom'];

}

?>
