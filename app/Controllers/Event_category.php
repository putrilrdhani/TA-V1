<?php

namespace App\Controllers;


use App\Models\Event_categoryModel;

class Event_category extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Event_categoryModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Event_category',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Event Category ',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('event_category/index_event_category', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->find($id) //find on data
		];
		return view('event_category/read_event_category', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('event_category/create_action'),
			'data' =>   [
				'id_category' => set_value('id_category'),
				'name' => set_value('name'),
			]
		];
		return view('event_category/form_event_category', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$data = [
			'id_category' => $this->request->getVar('id_category'),
			'name' => $this->request->getVar('name'),

		];

		$id_category = $this->request->getVar('id_category');
		$name = $this->request->getVar('name');

		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_category , 'EC', ''), '', '') as SIGNED)) as max from event_category");
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


		$query   = $db->query("INSERT INTO `event_category` (`id_category`, `name`) VALUES ('" . $id . "', '" . $name . "');");
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/event_category'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/event_category'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'event_category/update_action',
			'data' => $this->Model->getData($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('event_category/form_event_category', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id_category');
		$row = $this->Model->getData(['id_category' => $id]);

		$data = [
			'id_category' => $this->request->getVar('id_category'),
			'name' => $this->request->getVar('name'),
		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('event_category'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id_category' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/event_category'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/event_category'));
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
