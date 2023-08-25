<?php

namespace App\Controllers;


use App\Models\CulinaryModel;

class Culinary extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new CulinaryModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Culinary',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Culinary',
			// 'data' => $this->Model->paginate(5, 'paging'),
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager,
			// 'data1' => $this->Model->getData()
		];
		return view('culinary/index_culinary', $data);
	}

	//READ
	public function read($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, address, contact_person, capacity, open, close, owner FROM culinary WHERE id = "' . $id . '"');
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
					// 'employee' => $row['employee'],
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
		return view('culinary/read_culinary', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		// $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id, address, contact_person, capacity, open, close, employee, owner FROM culinary');
		// $hasil = array(
		// 	'type'    => 'FeatureCollection',
		// 	'features' => array()
		// );

		// foreach ($query->getResultArray() as $row) {
		// 	$features = array(
		// 		'type' => 'Feature',
		// 		'geometry' => json_decode($row['geom']),
		// 		'properties' => array(
		// 			'id' => $row['id'],
		// 			'name' => $row['name'],
		// 			'address' => $row['address'],
		// 			'contact_person' => $row['contact_person'],
		// 			'capacity' => $row['capacity'],
		// 			'open' => $row['open'],
		// 			'close' => $row['close'],
		// 			'employee' => $row['employee'],
		// 			'owner' => $row['owner'],
		// 		)
		// 	);
		// 	array_push($hasil['features'], $features);
		// }
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('culinary/create_action'),
			// 'data' =>   [
			// 	'id' => set_value('id'),
			// 	'name' => set_value('name'),
			// 	'address' => set_value('address'),
			// 	'contact_person' => set_value('contact_person'),
			// 	'capacity' => set_value('capacity'),
			// 	'open' => set_value('open'),
			// 	'close' => set_value('close'),
			// 	'employee' => set_value('employee'),
			// 	'geom' => set_value('geom'),
			// 	'owner' => set_value('owner'),
			// ],
			'status' => "Not Visible",
			// 'geometry' => $hasil
		];
		return view('culinary/form_culinary', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$db = \Config\Database::connect();
		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'C', ''), '', '') as SIGNED)) as max from culinary");
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

		$data = [
			'id' => $this->request->getVar('id'),
			'name' => $this->request->getVar('name'),
			'address' => $this->request->getVar('address'),
			'contact_person' => $this->request->getVar('contact_person'),
			'capacity' => $this->request->getVar('capacity'),
			'open' => $this->request->getVar('open'),
			'close' => $this->request->getVar('close'),
			// 'employee' => $this->request->getVar('employee'),
			'geom' => $this->request->getVar('geom'),
			'owner' => $this->request->getVar('owner'),

		];

		$idx = "C" . $id;
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		$contact_personx = $this->request->getVar('contact_person');
		$capacityx = $this->request->getVar('capacity');
		$openx = $this->request->getVar('open');
		$closex = $this->request->getVar('close');
		// $employeex = $this->request->getVar('employee');
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




		// Uplaod sampai sini

		$query   = $db->query("INSERT INTO `culinary` (`id`, `name`, `address`, `contact_person`, `capacity`, `open`, `close`, `geom`, `owner`) VALUES ('" . $idx . "', '" . $namex . "', '" . $addressx . "', '" . $contact_personx . "', '" . $capacityx . "', '" . $openx . "', '" . $closex . "', ST_GeomFromText('" . $geomx . "',0), '" . $ownerx . "')");
		// Query Upload
		if ($statusUpload == "EMPTY") {
		} else {

			$query2   = $db->query("INSERT INTO `culinary_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/culinary'));
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, name,id, address, contact_person, capacity, open, close, owner FROM culinary WHERE id="' . $id . '"');
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
					// 'employee' => $row['employee'],
					'owner' => $row['owner'],
				)
			);
			array_push($hasil['features'], $features);
		}

		// $selectData = $db->query('SELECT * FROM culinary_facility WHERE culinary_facility.name NOT IN (SELECT name FROM culinary_facility RIGHT JOIN culinary_detail_facility ON culinary_facility.id_facility=culinary_detail_facility.id_facility WHERE culinary_detail_facility.id="' . $id . '")')->getResultArray();
		// $dataFacility = $db->query('SELECT * FROM culinary_facility RIGHT JOIN culinary_detail_facility ON culinary_facility.id_facility=culinary_detail_facility.id_facility WHERE culinary_detail_facility.id="' . $id . '"')->getResultArray();

		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/culinary'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'culinary/update_action',
			'data' => $this->Model->getData($id),
			'status' => "Visible",
			'geometry' => $hasil,
			// 'selectData' => $selectData,
			// 'dataFacility' => $dataFacility,
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('culinary/form_culinary', $data);
	}
	// Copy ke semua controller yg ada delete image

	public function delete_image($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM culinary_gallery WHERE id_gallery='" . $id . "'");
	}

	// add facility
	// public function add_facility($id_culinary, $id_facility)
	// {
	// 	$db = \Config\Database::connect();

	// 	// $query   = $db->query("SELECT MAX(id) as max FROM culinary_detail_facility");
	// 	// $count = $query->getNumRows();
	// 	// $id = 0;
	// 	// if ($count == 0) {
	// 	// 	$id = 1;
	// 	// } else {
	// 	// 	$res = $query->getResult();
	// 	// 	$res = $res[0]->max;
	// 	// 	$id = $res + 1;
	// 	// }


	// 	// $id = $id;
	// 	// echo $id_culinary . $id_facility;
	// 	// echo "INSERT INTO `culinary_detail_facility` ( `id_facility`, `id`) VALUES ( '" . $id_facility . "', '" . $id_culinary . "');";

	// 	$query   = $db->query("INSERT INTO `culinary_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_culinary . "');");
	// }

	// public function delete_facility($id, $id_facility)
	// {
	// 	$db = \Config\Database::connect();
	// 	$query   = $db->query("DELETE FROM culinary_detail_facility WHERE id='" . $id . "' AND id_facility='" . $id_facility . "'");
	// 	// redirect ke id_target


	// }

	// public function facility($id)
	// {
	// 	$db = \Config\Database::connect();

	// 	$data = [
	// 		'AttributePage' => $this->PageData,
	// 		'content' => 'Read',
	// 		'data' => $this->Model->getData($id), //find on data

	// 	];
	// 	return view('culinary/facility_culinary', $data);
	// }

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
			// 'employee' => $this->request->getVar('employee'),
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
		// $employeex = $this->request->getVar('employee');
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
		$query   = $db->query("UPDATE `culinary` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `contact_person` = '" . $contact_personx . "', `capacity` = '" . $capacityx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `geom` = ST_GeomFromText('" . $geomx . "',0), `owner` = '" . $ownerx . "' WHERE `culinary`.`id` = '" . $idx . "';");
		if ($statusUpload == "EMPTY") {
		} else {

			$query2   = $db->query("INSERT INTO `culinary_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}
		// $query2   = $db->query("UPDATE `culinary_gallery` SET   `url`='" . $fileName . "' WHERE `id` = '" . $idx . "'");
		session()->setFlashdata('message', 'Update Record Success');
		// echo "UPDATE `culinary` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `contact_person` = '" . $contact_personx . "', `capacity` = '" . $capacityx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `employee` = '" . $employeex . "', `geom` = ST_GeomFromText('" . $geomx . "'), `owner` = '" . $ownerx . "' WHERE `culinary`.`id` = '" . $idx . "';";

		return redirect()->to(base_url('culinary'));
	}

	//DELETE
	public function delete($id)
	{
		$db = \Config\Database::connect();
		// $query   = $db->query("DELETE FROM culinary_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM culinary_gallery WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM culinary WHERE id='" . $id . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/culinary'));
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
		$this->form_validation->set_rules('employee', 'employee', 'trim|required|numeric');
		$this->form_validation->set_rules('geom', 'geom', 'trim|required');
		$this->form_validation->set_rules('owner', 'owner', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
