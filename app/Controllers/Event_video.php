<?php

namespace App\Controllers;


use App\Models\Event_videoModel;

class Event_video extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Event_videoModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Event_video',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Event Video',
			'data' => $this->Model->paginate(5, 'paging'),
			'pager' => $this->Model->pager
		];
		return view('event_video/index_event_video', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->find($id) //find on data
		];
		return view('event_video/read_event_video', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('Event_video/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'url' => set_value('url'),
				'duration' => set_value('duration'),
				'view' => set_value('view'),
			]
		];
		return view('event_video/form_event_video', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$data = [
			'id' => $this->request->getVar('id'),
			'url' => $this->request->getVar('url'),
			'duration' => $this->request->getVar('duration'),
			'view' => $this->request->getVar('view'),

		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/Event_video'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/Event_video'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'event_video/update_action',
			'data' => $this->Model->find($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('event_video/form_event_video', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id');
		$row = $this->Model->find(['id' => $id]);

		$data = [
			'id' => $this->request->getVar('id'),
			'url' => $this->request->getVar('url'),
			'duration' => $this->request->getVar('duration'),
			'view' => $this->request->getVar('view'),
		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('event_video'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/event_video'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/event_video'));
		}
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('url', 'url', 'trim|required');
		$this->form_validation->set_rules('duration', 'duration', 'trim|required');
		$this->form_validation->set_rules('view', 'view', 'trim|required|numeric');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
