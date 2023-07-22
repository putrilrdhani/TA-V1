<?php

namespace App\Controllers;



use App\Models\UsersModel;

class Users extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new UsersModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Users',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'User',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('users/index_users', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->find($id) //find on data
		];
		return view('users/read_users', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('Users/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'email' => set_value('email'),
				'username' => set_value('username'),
				'password_hash' => set_value('password_hash'),
				'reset_hash' => set_value('reset_hash'),
				'reset_at' => set_value('reset_at'),
				'reset_expires' => set_value('reset_expires'),
				'activate_hash' => set_value('activate_hash'),
				'status' => set_value('status'),
				'status_message' => set_value('status_message'),
				'active' => set_value('active'),
				'force_pass_reset' => set_value('force_pass_reset'),
				'created_at' => set_value('created_at'),
				'updated_at' => set_value('updated_at'),
				'deleted_at' => set_value('deleted_at'),
			]
		];
		return view('users/form_users', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$data = [
			'id' => $this->request->getVar('id'),
			'email' => $this->request->getVar('email'),
			'username' => $this->request->getVar('username'),
			'password_hash' => $this->request->getVar('password_hash'),
			'reset_hash' => $this->request->getVar('reset_hash'),
			'reset_at' => $this->request->getVar('reset_at'),
			'reset_expires' => $this->request->getVar('reset_expires'),
			'activate_hash' => $this->request->getVar('activate_hash'),
			'status' => $this->request->getVar('status'),
			'status_message' => $this->request->getVar('status_message'),
			'active' => $this->request->getVar('active'),
			'force_pass_reset' => $this->request->getVar('force_pass_reset'),
			'created_at' => $this->request->getVar('created_at'),
			'updated_at' => $this->request->getVar('updated_at'),
			'deleted_at' => $this->request->getVar('deleted_at'),

		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/Users'));
	}

	//UPDATE
	public function update($id)
	{
		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/Users'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'users/update_action',
			'data' => $this->Model->find($id),
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('users/form_users', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id');
		$row = $this->Model->find(['id' => $id]);

		$data = [
			'id' => $this->request->getVar('id'),
			'email' => $this->request->getVar('email'),
			'username' => $this->request->getVar('username'),
			'password_hash' => $this->request->getVar('password_hash'),
			'reset_hash' => $this->request->getVar('reset_hash'),
			'reset_at' => $this->request->getVar('reset_at'),
			'reset_expires' => $this->request->getVar('reset_expires'),
			'activate_hash' => $this->request->getVar('activate_hash'),
			'status' => $this->request->getVar('status'),
			'status_message' => $this->request->getVar('status_message'),
			'active' => $this->request->getVar('active'),
			'force_pass_reset' => $this->request->getVar('force_pass_reset'),
			'created_at' => $this->request->getVar('created_at'),
			'updated_at' => $this->request->getVar('updated_at'),
			'deleted_at' => $this->request->getVar('deleted_at'),
		];
		$this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('users'));
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/users'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/users'));
		}
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password_hash', 'password hash', 'trim|required');
		$this->form_validation->set_rules('reset_hash', 'reset hash', 'trim|required');
		$this->form_validation->set_rules('reset_at', 'reset at', 'trim|required');
		$this->form_validation->set_rules('reset_expires', 'reset expires', 'trim|required');
		$this->form_validation->set_rules('activate_hash', 'activate hash', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		$this->form_validation->set_rules('status_message', 'status message', 'trim|required');
		$this->form_validation->set_rules('active', 'active', 'trim|required');
		$this->form_validation->set_rules('force_pass_reset', 'force pass reset', 'trim|required');
		$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
		$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');
		$this->form_validation->set_rules('deleted_at', 'deleted at', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
