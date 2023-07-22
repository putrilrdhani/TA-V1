<?php

namespace App\Controllers;



use App\Models\HomestayModel;

class Homestay extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new HomestayModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Homestay',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Homestay',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('homestay/index_homestay', $data);
	}

	//READ
	public function read($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, address, contact_person, capacity, open, close, price, owner FROM homestay WHERE id = "' . $id . '"');
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);

		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'geometry' => json_decode($row['geom']),
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'x' => $row['x'],
					'y' => $row['y'],
					'address' => $row['address'],
					'contact_person' => $row['contact_person'],
					'capacity' => $row['capacity'],
					'open' => $row['open'],
					'close' => $row['close'],
					'price' => $row['price'],
					'owner' => $row['owner'],
				)
			);
			array_push($hasil['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id), //find on data
			'geometry' => $hasil
		];
		return view('homestay/read_homestay', $data);
	}

	//CREATE
	public function create()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create Pages',
			'action' => site_url('homestay/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'name' => set_value('name'),
				'address' => set_value('address'),
				'contact_person' => set_value('contact_person'),
				'capacity' => set_value('capacity'),
				'open' => set_value('open'),
				'close' => set_value('close'),
				'price' => set_value('price'),
				'geom' => set_value('geom'),
				'owner' => set_value('owner'),


			],
			'status' => "Not Visible",
		];
		return view('homestay/form_homestay', $data);
	}

	//ACTION CREATE
	public function create_action()
	{

		$db = \Config\Database::connect();
		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'H', ''), '', '') as SIGNED)) as max from homestay");
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
		$name = $this->request->getVar('name');
		$address = $this->request->getVar('address');
		$contact_person = $this->request->getVar('contact_person');
		$capacity = $this->request->getVar('capacity');
		$open = $this->request->getVar('open');
		$close = $this->request->getVar('close');
		$price = $this->request->getVar('price');
		$geom = $this->request->getVar('geom');
		$owner = $this->request->getVar('owner');


		if ($_FILES['url']['error'] == 4 || ($_FILES['url']['size'] == 0 && $_FILES['url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('url');
			$fileName = $dataBerkas->getRandomName();
			$dataBerkas->move('upload/', $fileName);
			$statusUpload = "SUCCESS";
		}

		$db = \Config\Database::connect();
		$query   = $db->query("INSERT INTO `homestay` (`id`, `name`, `address`, `contact_person`, `capacity`, `open`, `close`, `price`, `geom`, `owner`) VALUES ('" . $id . "', '" . $name . "', '" . $address . "', '" . $contact_person . "', '" . $capacity . "', '" . $open . "', '" . $close . "', '" . $price . "', ST_GeomFromText('" . $geom . "',0), '" . $owner . "'); ");
		if ($statusUpload == "EMPTY") {
		} else {

			$query2   = $db->query("INSERT INTO `homestay_gallery` (`id`, `url`) VALUES ('" . $id . "', '" . $fileName . "');");
		}
		// Uplaod sampai sini
		$db = \Config\Database::connect();
		//$query   = $db->query("INSERT INTO `homestay` (`id`, `name`, `address`, `contact_person`, `capacity`, `open`, `close`, `employee`, `geom`, `owner`) VALUES ('" . $idx . "', '" . $namex . "', '" . $addressx . "', '" . $contact_personx . "', '" . $capacityx . "', '" . $openx . "', '" . $closex . "', '" . $employeex . "', ST_GeomFromText('" . $geomx . "',0), '" . $ownerx . "')");
		// Query Upload

		session()->setFlashdata('message', 'Create Record Success');


		return redirect()->to(base_url('/homestay'));
	}

	public function delete_image($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM homestay_gallery WHERE id_gallery='" . $id . "'");
	}

	// add facility
	public function add_facility($id_homestay, $id_facility)
	{
		$db = \Config\Database::connect();

		// $query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'E', ''), '', '') as int)) as max homestay_detail_facility");
		// $count = $query->getNumRows();
		// $id = 0;
		// if ($count == 0) {
		// 	$id = 1;
		// } else {
		// 	$res = $query->getResult();
		// 	$res = $res[0]->max;
		// 	$id = $res + 1;
		// }


		// $id = $id;
		// echo $id_homestay . $id_facility;
		// echo "INSERT INTO `homestay_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_homestay . "');";

		$query   = $db->query("INSERT INTO `homestay_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_homestay . "');");
	}

	public function delete_facility($id, $id_facility)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM homestay_detail_facility WHERE id='" . $id . "' AND id_facility='" . $id_facility . "'");
		// redirect ke id_target


	}

	public function facility($id)
	{
		$db = \Config\Database::connect();

		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id), //find on data

		];
		return view('homestay/facility_homestay', $data);
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, address, contact_person, capacity, open, close, price, owner FROM homestay WHERE id="' . $id . '"');
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);

		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'geometry' => json_decode($row['geom']),
				'properties' => array(
					'id' => $row['id'],
					'name' => $row['name'],
					'x' => $row['x'],
					'y' => $row['y'],
					'address' => $row['address'],
					'contact_person' => $row['contact_person'],
					'capacity' => $row['capacity'],
					'open' => $row['open'],
					'close' => $row['close'],
					'price' => $row['price'],
					'owner' => $row['owner'],
				)
			);
			array_push($hasil['features'], $features);
		}

		$selectData = $db->query('SELECT * FROM homestay_facility WHERE homestay_facility.name NOT IN (SELECT name FROM homestay_facility RIGHT JOIN homestay_detail_facility ON homestay_facility.id_facility=homestay_detail_facility.id_facility WHERE homestay_detail_facility.id="' . $id . '")')->getResultArray();
		$dataFacility = $db->query('SELECT * FROM homestay_facility RIGHT JOIN homestay_detail_facility ON homestay_facility.id_facility=homestay_detail_facility.id_facility WHERE homestay_detail_facility.id="' . $id . '"')->getResultArray();

		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/homestay'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'homestay/update_action',
			'data' => $this->Model->getData($id),
			'status' => "Visible",
			'geometry' => $hasil,
			'selectData' => $selectData,
			'dataFacility' => $dataFacility,
		];
		session()->setFlashdata('message', 'Update Record Success');

		return view('homestay/form_homestay', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id');
		$row = $this->Model->getData(['id' => $id]);

		$data = [
			'id' => $this->request->getVar('id'),
			'name' => $this->request->getVar('name'),
			'address' => $this->request->getVar('address'),
			'contact_person' => $this->request->getVar('contact_person'),
			'capacity' => $this->request->getVar('capacity'),
			'open' => $this->request->getVar('open'),
			'close' => $this->request->getVar('close'),
			'price' => $this->request->getVar('price'),
			'geom' => $this->request->getVar('geom'),
			'owner' => $this->request->getVar('owner'),
		];
		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		$contact_personx = $this->request->getVar('contact_person');
		$capacityx = $this->request->getVar('capacity');
		$openx = $this->request->getVar('open');
		$closex = $this->request->getVar('close');
		$price = $this->request->getVar('price');
		$geomx = $this->request->getVar('geom');
		$ownerx = $this->request->getVar('owner');
		if ($_FILES['url']['error'] == 4 || ($_FILES['url']['size'] == 0 && $_FILES['url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('url');
			$fileName = $dataBerkas->getRandomName();
			$dataBerkas->move('upload/', $fileName);
			$statusUpload = "SUCCESS";
		}
		// Upload dari sini
		// $dataBerkas = $this->request->getFile('url');
		// $fileName = $dataBerkas->getRandomName();

		// $dataBerkas->move('upload/', $fileName);
		// // Uplaod sampai sini
		// $this->Model->save($data);
		$db = \Config\Database::connect();
		$query   = $db->query("UPDATE `homestay` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `contact_person` = '" . $contact_personx . "', `capacity` = '" . $capacityx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `price` = '" . $price . "', `geom` = ST_GeomFromText('" . $geomx . "',0), `owner` = '" . $ownerx . "' WHERE `homestay`.`id` = '" . $idx . "';");
		if ($statusUpload == "EMPTY") {
		} else {

			$query2   = $db->query("INSERT INTO `homestay_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}
		// $query2   = $db->query("UPDATE `culinary_gallery` SET   `url`='" . $fileName . "' WHERE `id` = '" . $idx . "'");
		session()->setFlashdata('message', 'Update Record Success');
		// echo "UPDATE `culinary` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `contact_person` = '" . $contact_personx . "', `capacity` = '" . $capacityx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `employee` = '" . $employeex . "', `geom` = ST_GeomFromText('" . $geomx . "'), `owner` = '" . $ownerx . "' WHERE `culinary`.`id` = '" . $idx . "';";


		return redirect()->to(base_url('homestay'));
	}

	//DELETE
	public function delete($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM homestay_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM homestay_gallery WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM homestay WHERE id='" . $id . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/homestay'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');
		$this->form_validation->set_rules('capacity', 'capacity', 'trim|required|numeric');
		$this->form_validation->set_rules('open', 'open', 'trim|required');
		$this->form_validation->set_rules('close', 'close', 'trim|required');
		$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
		$this->form_validation->set_rules('geom', 'geom', 'trim|required');
		$this->form_validation->set_rules('owner', 'owner', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
