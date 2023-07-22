<?php

namespace App\Controllers;



use App\Models\Culinary_facilityModel;

class Culinary_facility extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Culinary_facilityModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Culinary_facility',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Culinary Facility',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('culinary_facility/index_culinary_facility', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id) //find on data
		];
		return view('culinary_facility/read_culinary_facility', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('culinary_facility/create_action'),
			'data' =>   [
				'id_facility' => set_value('id_facility'),
				'name' => set_value('name'),
			]
		];
		return view('culinary_facility/form_culinary_facility', $data);
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

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_facility , 'F', ''), '', '') as SIGNED)) as max from culinary_facility");
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


		$query   = $db->query("INSERT INTO `culinary_facility` (`id_facility`, `name`) VALUES ('" . $id . "', '" . $name . "');");

		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/culinary_facility'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/Culinary_facility'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'culinary_facility/update_action',
			'data' => $this->Model->find($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('culinary_facility/form_culinary_facility', $data);
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

		return redirect()->to(base_url('culinary_facility'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/culinary_facility'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/culinary_facility'));
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
