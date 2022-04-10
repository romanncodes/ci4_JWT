<?php namespace App\Controllers;

use App\Models\TareaModel;

class Home extends Auth
{
	protected $model;

	public function __construct(){
		$this->model = new TareaModel();
	}

	public function index()	{
		return view('welcome_message');
	}

	//--------------------------------------------------------------------
	public function hello(){
		$saludo =$this->request->getPost('saludo');
		echo $saludo;
	}

	public function insertar(){		
			$data = [
				"titulo"	  => $this->request->getPost('titulo'),
				"descripcion" => $this->request->getPost('descripcion')
			];
			$this->model->insert($data);
			//echo json_encode(["msg"=>"creado"]);
			return $this->respond(['data'=>'creado'],200);		
	}
	
	public function getTareas(){			
		return $this->respond($this->model->findAll());		
	}

	public function getTareasEliminadas(){		
		echo json_encode($this->model->onlyDeleted()->findAll());
	}

	public function eliminar(){
		$id = $this->request->getPost('id');
		$res = $this->model->delete($id);		
		echo json_encode(["msg"=>$res]);
	}

	public function editar(){		
		$id  = $this->request->getPost('id');
		$data = [
					"titulo"	  => $this->request->getPost('titulo'),
					"descripcion" => $this->request->getPost('descripcion')
		];
		$res = $this->model->update($id, $data);
		echo json_encode(["msg"=>$res]);
	}

	public function buscar(){
		$id  = $this->request->getPost('id');
		echo json_encode($this->model->find($id));
	}

	public function tareasTitulo(){
		$db      = \Config\Database::connect();
		$builder = $db->table('tarea');
		$builder->select("titulo");
		$builder->where('deleted_at',NULL);
		$query = $builder->get();
		echo json_encode($query->getResult());
	}
}
