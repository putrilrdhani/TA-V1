<?php

namespace App\Controllers;



use App\Models\Souvenir_facilityModel;

class Souvenir_facility extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Souvenir_facilityModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Souvenir_facility',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Souvenir Place Facility',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('souvenir_facility/index_souvenir_facility', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->find($id) //find on data
		];
		return view('souvenir_facility/read_souvenir_facility', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('souvenir_facility/create_action'),
			'data' =>   [
				'id_facility' => set_value('id'),
				'name' => set_value('name'),
			]
		];
		return view('souvenir_facility/form_souvenir_facility', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$data = [
			'id_facility' => $this->request->getVar('id_facility'),
			'name' => $this->request->getVar('name'),

		];

		$id_facility = $this->request->getVar('id_facility');
		$name = $this->request->getVar('name');

		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_facility , 'F', ''), '', '') as SIGNED)) as max FROM souvenir_facility");
		$count = $query->getNumRows();
		$id = 0;
		if ($count == 0) {
			$id = 1;
		} else {
			$res = $query->getResult();
			$res = $res[0]->max;
			$id = $res + 1;
		}


		$id = $id;


		$query   = $db->query("INSERT INTO `souvenir_facility` (`id_facility`, `name`) VALUES ('" . $id . "', '" . $name . "');");

		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/souvenir_facility'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/souvenir_facility'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'souvenir_facility/update_action',
			'data' => $this->Model->find($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('souvenir_facility/form_souvenir_facility', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id_facility');
		$row = $this->Model->find(['id_facility' => $id]);

		$data = [
			'id_facility' => $this->request->getVar('id_facility'),
			'name' => $this->request->getVar('name'),
		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('souvenir_facility'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id_facility' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/souvenir_facility'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/souvenir_facility'));
		}
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
