<?php

namespace App\Controllers;

/**
 * THIS CONTROLER CODEIGNITER 4
 * Codeigniter Version 4.x
 * Generated by LigatCode
 **/

use App\Models\Detail_packageModel;

class Detail_package extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Detail_packageModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'LigatCode | Detail_package',
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
		return view('detail_package/index_detail_package', $data);
	}

	//READ
	public function read($id)
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read Pages',
			'data' => $this->Model->find($id) //find on data
		];
		return view('detail_package/read_detail_package', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM package JOIN package_day ON package_day.id_package = package.id_package WHERE package.custom = "0"');

		$tourism_object   = $db->query('SELECT id, name FROM tourism_object');
		$culinary   = $db->query('SELECT id, name FROM culinary');
		$event   = $db->query('SELECT id, name FROM event');
		$homestay   = $db->query('SELECT id, name FROM homestay');
		$souvenir   = $db->query('SELECT id, name FROM souvenir_place');
		$worship   = $db->query('SELECT id, name FROM worship_place');
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'name' => $row['name'],
					'day' => $row['day'],
				)
			);
			array_push($hasil['features'], $features);
		}
		$hasil1 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($tourism_object->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => 'T',
				)
			);
			array_push($hasil1['features'], $features);
		}
		$hasil2 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($culinary->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => 'C',
				)
			);
			array_push($hasil2['features'], $features);
		}
		$hasil3 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($event->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => 'E',
				)
			);
			array_push($hasil3['features'], $features);
		}
		$hasil4 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($homestay->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => 'H',
				)
			);
			array_push($hasil4['features'], $features);
		}
		$hasil5 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($souvenir->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => 'S',
				)
			);
			array_push($hasil5['features'], $features);
		}
		$hasil6 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($worship->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => 'W',
				)
			);
			array_push($hasil6['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create ',
			'action' => site_url('detail_package/create_action'),
			'data' =>   [
				'id_package' => set_value('id_package'),
				'day' => set_value('day'),
				'activity' => set_value('activity'),
				'activity_type' => set_value('activity_type'),
				'id_object' => set_value('id_object'),
				'description' => set_value('description'),
			],
			'status' => 'Not Visible',
			'package_day' => $hasil,
			'tourism_object' => $hasil1,
			'culinary' => $hasil2,
			'event' => $hasil3,
			'homestay' => $hasil4,
			'souvenir' => $hasil5,
			'worship' => $hasil6
		];
		return view('detail_package/form_detail_package', $data);
	}

	//ACTION CREATE
	public function create_action()
	{


		$id_double = $this->request->getVar('id-double');

		$activity = $this->request->getVar('activity');
		$activity_type = $this->request->getVar('activity_type');
		$id_object = $this->request->getVar('id_object');
		$description = $this->request->getVar('description');

		$id_double = explode("-", $id_double);
		$id_package = $id_double[0];
		$day = $id_double[1];
		// $this->Model->save($data);
		$db = \Config\Database::connect();
		$query   = $db->query("INSERT INTO `detail_package` (`id_package`, `day`, `activity`, `activity_type`, `id_object`, `description`) VALUES ('" . $id_package . "', '" . $day . "', '" . $activity . "', '" . $activity_type . "', '" . $id_object . "', '" . $description . "');");
		// var_dump("INSERT INTO `detail_package` (`id_package`, `day`, `activity`, `activity_type`, `id_object`, `description`) VALUES ('" . $id_package . "', '" . $day . "', '" . $activity . "', '" . $activity_type . "', '" . $id_object . "', '" . $description . "');");
		// session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/package'));
	}

	//UPDATE
	public function update($id_package, $day, $activity)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM package_day');

		$tourism_object   = $db->query('SELECT id, name FROM tourism_object');
		$culinary   = $db->query('SELECT id, name FROM culinary');
		$event   = $db->query('SELECT id, name FROM event');
		$homestay   = $db->query('SELECT id, name FROM homestay');
		$souvenir   = $db->query('SELECT id, name FROM souvenir_place');
		$worship   = $db->query('SELECT id, name FROM worship_place');
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'description' => $row['description'],
				)
			);
			array_push($hasil['features'], $features);
		}
		$hasil1 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($tourism_object->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
				)
			);
			array_push($hasil1['features'], $features);
		}
		$hasil2 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($culinary->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
				)
			);
			array_push($hasil2['features'], $features);
		}
		$hasil3 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($event->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
				)
			);
			array_push($hasil3['features'], $features);
		}
		$hasil4 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($homestay->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
				)
			);
			array_push($hasil4['features'], $features);
		}
		$hasil5 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($souvenir->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
				)
			);
			array_push($hasil5['features'], $features);
		}
		$hasil6 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($worship->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
				)
			);
			array_push($hasil6['features'], $features);
		}
		$dataFind = $this->Model->getData($id_package, $day);
		if ($dataFind == false) {
			// return redirect()->to(base_url('/detail_package'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit ',
			'action' => 'detail_package/update_action',
			'data' => $this->Model->getData($id_package, $day, $activity),
			'status' => 'Visible',
			'package_day' => $hasil,
			'tourism_object' => $hasil1,
			'culinary' => $hasil2,
			'event' => $hasil3,
			'homestay' => $hasil4,
			'souvenir' => $hasil5,
			'worship' => $hasil6
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('detail_package/form_detail_package', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id_package');
		$row = $this->Model->find(['id_package' => $id]);

		$data = [
			'id_package' => $this->request->getVar('id_package'),
			'day' => $this->request->getVar('day'),
			'activity' => $this->request->getVar('activity'),
			'activity_type' => $this->request->getVar('activity_type'),
			'id_object' => $this->request->getVar('id_object'),
			'description' => $this->request->getVar('description'),
		];
		$id_package = $this->request->getVar('id_package');
		$day = $this->request->getVar('day');
		$activity = $this->request->getVar('activity');
		$activity_type = $this->request->getVar('activity_type');
		$id_object = $this->request->getVar('id_object');
		$description = $this->request->getVar('description');

		$db = \Config\Database::connect();
		$query = $db->query("UPDATE `detail_package` SET `activity_type` = '" . $activity_type . "', `id_object` = '" . $id_object . "', `description` = '" . $description . "' WHERE `detail_package`.`id_package` = '" . $id_package . "' AND `detail_package`.`day` = '" . $day . "' AND `detail_package`.`activity` = '" . $activity . "'; ");
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('package'));
	}

	//DELETE
	public function delete($id_package, $day, $activity)
	{
		$db = \Config\Database::connect();


		$query   = $db->query("DELETE FROM detail_package WHERE `id_package` = '" . $id_package . "' AND `day` = '" . $day . "' AND activity='" . $activity . "'");
		//If the exception is thrown, this text will not be shown


		return redirect()->to(base_url('/package'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('activity_type', 'activity type', 'trim|required');
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('description', 'description', 'trim|required');

		$this->form_validation->set_rules('id_package', 'id_package', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Detail_package.php */
 /* Location: ./app/controllers/Detail_package.php */
 /* Please DO NOT modify this information : */
 /* Generated by Ligatcode Codeigniter 4 CRUD Generator 2023-07-04 15:03:32 */