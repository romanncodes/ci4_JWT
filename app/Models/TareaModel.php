<?php
namespace App\Models;

use CodeIgniter\Model;

class TareaModel extends Model{
    protected $table      = 'tarea';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['titulo', 'descripcion'];
}


