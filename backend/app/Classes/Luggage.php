<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class Luggage extends Model {

	public $table = 'luggage'; //  Spécifie le nom de la table (par défaut un 's' est ajouté sinon et ça fout la merde) !

	public $timestamps = false; // Empêche le comportement par défaut de Lumen qui ajoute des champs "created_at" et "updated_at" lors de l'ajout ou de l'update d'un élément dans la table

    protected $fillable = ['id', 'name'];

}

?>
