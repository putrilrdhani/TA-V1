<?php

namespace App\Controllers;

/**
 * THIS CONTROLER CODEIGNITER 4
 * Codeigniter Version 4.x
 * Generated by LigatCode
 **/

use App\Models\Service_packageModel;

class Service_package extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Service_packageModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'LigatCode | Service_package',
			'app' => 'LigatCode',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create Pages',
			'data' => $this->Model->paginate(5, 'paging'),
			'pager' => $this->Model->pager
		];
		return view('service_package/index_service_package', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read Pages',
			'data' => $this->Model->find($id) //find on data
		];
		return view('service_package/read_service_package', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM service_package ');
		$hasil_package = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',

				'properties' => array(
					'id_service_package' => $row['id_service_package'],
					'name' => $row['name'],

				)
			);
			array_push($hasil_package['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create Pages',
			'action' => site_url('service_package/create_action'),
			'data' =>   [
				'id_service_package' => set_value('id_service_package'),
				'name' => set_value('name'),
			],
			'status' => 'Not Visible',
			'package' => $hasil_package
		];
		return view('service_package/form_service_package', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$db = \Config\Database::connect();
		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_service_package , 'S', ''), '', '') as SIGNED)) as max from service_package");
		$count = $query->getNumRows();
		$id = 0;
		if ($count == 0) {
			$id = 1;
		} else {
			$res = $query->getResult();
			$res = $res[0]->max;
			$id = $res + 1;
		}

		$id =  "S" . $id;
		$data = [
			'id_service_package' => $this->request->getVar('id_service_package'),
			'name' => $this->request->getVar('name'),
		];


		$id_service_package = $id;
		$name = $this->request->getVar('name');
		// $this->Model->save($data);
		$query = $db->query("INSERT INTO `service_package` (`id_service_package`,`name`) VALUES ('" . $id_service_package . "','" . $name . "');");
		// var_dump($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/package'));
	}

	//UPDATE
	public function update($id_service_package)
	{
		$dataFind = $this->Model->find($id_service_package);
		if ($dataFind == false) {
			return redirect()->to(base_url('/package'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'service_package/update_action',
			'data' => $this->Model->find($id_service_package),
			'status' => "Visible"
		];
		// var_dump($data);
		session()->setFlashdata('message', 'Update Record Success');
		return view('service_package/form_service_package', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id_service_package = $this->request->getVar('id_service_package');
		$row = $this->Model->find(['id_service_package' => $id_service_package]);

		$data = [
			'id_service_package' => $this->request->getVar('id_service_package'),
			'name' => $this->request->getVar('name'),
		];

		$id_service_package = $this->request->getVar('id_service_package');
		$name = $this->request->getVar('name');
		$db = \Config\Database::connect();
		$query   = $db->query("UPDATE `service_package` SET `name` = '" . $name . "' WHERE `id_service_package` = '" . $id_service_package . "';");
		// $this->Model->save($data);
		// echo "UPDATE `service_package` SET `id_service_package` = '" . $id_service_package . "', `name` = '" . $name . "' WHERE `id_service_package` = '" . $id_service_package . "';";
		// session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('package'));
	}

	//DELETE
	public function delete($id)
	{

		$db = \Config\Database::connect();
		// $query   = $db->query("DELETE FROM culinary_detail_facility WHERE id='" . $id . "'");



		$query   = $db->query("DELETE FROM detail_service_package WHERE id_service_package='" . $id . "'");
		$query   = $db->query("DELETE FROM service_package WHERE id_service_package='" . $id . "'");;
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/package'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');

		$this->form_validation->set_rules('id_service_package', 'id_service_package', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Service_package.php */
 /* Location: ./app/controllers/Service_package.php */
 /* Please DO NOT modify this information : */
 /* Generated by Ligatcode Codeigniter 4 CRUD Generator 2023-07-04 15:06:09 */