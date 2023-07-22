<?php

namespace App\Controllers;



use App\Models\Souvenir_galleryModel;

class Souvenir_gallery extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Souvenir_galleryModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Souvenir_gallery',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Souvenir Gallery',
			'data' => $this->Model->paginate(5, 'paging'),
			'pager' => $this->Model->pager
		];
		return view('souvenir_gallery/index_souvenir_gallery', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->find($id) //find on data
		];
		return view('souvenir_gallery/read_souvenir_gallery', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('Souvenir_gallery/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'url' => set_value('url'),
			]
		];
		return view('souvenir_gallery/form_souvenir_gallery', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$data = [
			'id' => $this->request->getVar('id'),
			'url' => $this->request->getVar('url'),

		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/Souvenir_gallery'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/Souvenir_gallery'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'souvenir_gallery/update_action',
			'data' => $this->Model->find($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('souvenir_gallery/form_souvenir_gallery', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id');
		$row = $this->Model->find(['id' => $id]);

		$data = [
			'id' => $this->request->getVar('id'),
			'url' => $this->request->getVar('url'),
		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('souvenir_gallery'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/souvenir_gallery'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/souvenir_gallery'));
		}
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('url', 'url', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
