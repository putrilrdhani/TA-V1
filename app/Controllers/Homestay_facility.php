<?php

namespace App\Controllers;


use App\Models\Homestay_facilityModel;

class Homestay_facility extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Homestay_facilityModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Homestay_facility',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Homestay Facility',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('homestay_facility/index_homestay_facility', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read Pages',
			'data' => $this->Model->find($id) //find on data
		];
		return view('homestay_facility/read_homestay_facility', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('homestay_facility/create_action'),
			'data' =>   [
				'id_facility' => set_value('id_facility'),
				'name' => set_value('name'),
			]
		];
		session()->setFlashdata('message', 'Create Record Success');
		return view('homestay_facility/form_homestay_facility', $data);
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

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_facility , 'F', ''), '', '') as SIGNED)) as max FROM homestay_facility");
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


		$query   = $db->query("INSERT INTO `homestay_facility` (`id_facility`, `name`) VALUES ('" . $id . "', '" . $name . "');");

		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/homestay_facility'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/Homestay_facility'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edite Pages',
			'action' => 'homestay_facility/update_action',
			'data' => $this->Model->find($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('homestay_facility/form_homestay_facility', $data);
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

		return redirect()->to(base_url('homestay_facility'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id_facility' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/homestay_facility'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/homestay_facility'));
		}
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');

		$this->form_validation->set_rules('id_facility', 'id_facility', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
