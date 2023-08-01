<?php

namespace App\Controllers;

/**
 * THIS CONTROLER CODEIGNITER 4
 * Codeigniter Version 4.x
 * Generated by LigatCode
 **/

use App\Models\Package_dayModel;

class Package_day extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Package_dayModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'LigatCode | Package_day',
			'app' => 'LigatCode',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'data' => $this->Model->paginate(5, 'paging'),
			'pager' => $this->Model->pager
		];
		return view('package_day/index_package_day', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read Pages',
			'data' => $this->Model->find($id) //find on data
		];
		return view('package_day/read_package_day', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM package WHERE package.custom = "0"');
		$hasil_package = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);

		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',

				'properties' => array(
					'id_package' => $row['id_package'],
					'name' => $row['name'],

				)
			);
			array_push($hasil_package['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create ',
			'action' => site_url('package_day/create_action'),
			'data' =>   [
				'id_package' => set_value('id_package'),
				'day' => set_value('day'),
				'description' => set_value('description'),
			],
			'status' => 'Not Visible',
			'package' => $hasil_package
		];
		return view('package_day/form_package_day', $data);
	}

	//ACTION CREATE
	public function create_action()
	{


		$data = [
			'id_package' => $this->request->getVar('id_package'),
			'day' => $this->request->getVar('day'),
			'description' => $this->request->getVar('description'),

		];

		$id_package = $this->request->getVar('id_package');
		$day = $this->request->getVar('day');
		$description = $this->request->getVar('description');

		$db = \Config\Database::connect();
		$query   = $db->query("INSERT INTO `package_day` (`id_package`, `day`, `description`) VALUES ('" . $id_package . "', '" . $day . "', '" . $description . "');");
		var_dump($data);
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/package'));
	}

	//UPDATE
	public function update($id_package, $day)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM package ');
		$hasil_package = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);

		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',

				'properties' => array(
					'id_package' => $row['id_package'],
					'name' => $row['name'],

				)
			);
			array_push($hasil_package['features'], $features);
		}
		$dataFind = $this->Model->getSpecial($id_package, $day);
		if ($dataFind == false) {
			return redirect()->to(base_url('/Package_day'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit ',
			'action' => 'package_day/update_action',
			'data' => $this->Model->getSpecial($id_package, $day),
			'package' => $hasil_package,
			'status' => 'Visible'
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('package_day/form_package_day', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id_package = $this->request->getVar('id_package');
		$day = $this->request->getVar('day');
		$description = $this->request->getVar('description');

		echo "ID" . $id_package;





		$db = \Config\Database::connect();
		$query   = $db->query("UPDATE `package_day` SET `description` = '" . $description . "' WHERE `package_day`.`id_package` = '" . $id_package . "' AND `package_day`.`day` = '" . $day . "'; ");
		// echo "UPDATE `package_day` SET `description` = '" . $description . "' WHERE `package_day`.`id_package` = '" . $id_package . "' AND `package_day`.`day` = '" . $day . "'; ";
		return redirect()->to(base_url('package'));
	}

	//DELETE
	public function delete($id_package, $day)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM detail_package WHERE id_package='" . $id_package . "' AND day = '" . $day . "'");
		$query   = $db->query("DELETE FROM package_day WHERE id_package='" . $id_package . "' AND day = '" . $day . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/package'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('description', 'description', 'trim|required');

		$this->form_validation->set_rules('id_package', 'id_package', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Package_day.php */
 /* Location: ./app/controllers/Package_day.php */
 /* Please DO NOT modify this information : */
 /* Generated by Ligatcode Codeigniter 4 CRUD Generator 2023-07-04 15:05:49 */