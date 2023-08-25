<?php

namespace App\Controllers;



use App\Models\Souvenir_placeModel;

class Souvenir_place extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Souvenir_placeModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Souvenir_place',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Souvenir Place',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('souvenir_place/index_souvenir_place', $data);
	}

	//READ
	public function read($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, address, contact_person, open, close, owner FROM souvenir_place WHERE id = "' . $id . '"');
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
					// 'capacity' => $row['capacity'],
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
		return view('souvenir_place/read_souvenir_place', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id, address, contact_person, open, close, owner FROM souvenir_place');
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
					'address' => $row['address'],
					'contact_person' => $row['contact_person'],
					// 'capacity' => $row['capacity'],
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
			'content' => 'Create',
			'action' => site_url('souvenir_place/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'name' => set_value('name'),
				'address' => set_value('address'),
				// 'capacity' => set_value('capacity'),
				'contact_person' => set_value('contact_person'),
				'owner' => set_value('owner'),
				'geom' => set_value('geom'),
				// 'employee' => set_value('employee'),
				'open' => set_value('open'),
				'close' => set_value('close'),
			],

			'status' => "Not Visible",
			'geometry' => $hasil
		];
		return view('souvenir_place/form_souvenir_place', $data);
	}

	//ACTION CREATE
	public function create_action()
	{


		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'S', ''), '', '') as SIGNED)) as max from souvenir_place");
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
			// 'capacity' => $this->request->getVar('capacity'),
			'contact_person' => $this->request->getVar('contact_person'),
			'owner' => $this->request->getVar('owner'),
			'geom' => $this->request->getVar('geom'),
			// 'employee' => $this->request->getVar('employee'),
			'open' => $this->request->getVar('open'),
			'close' => $this->request->getVar('close'),

		];
		$idx = "SP" . $id;
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		// $capacityx = $this->request->getVar('capacity');
		$contact_personx = $this->request->getVar('contact_person');
		$ownerx = $this->request->getVar('owner');
		$geomx = $this->request->getVar('geom');
		// $employeex = $this->request->getVar('employee');
		$openx = $this->request->getVar('open');
		$closex = $this->request->getVar('close');

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
		$query   = $db->query("INSERT INTO `souvenir_place` (`id`, `name`, `address`, `contact_person`, `owner`, `geom`, `open`, `close`) VALUES ('" . $idx . "', '" . $namex . "', '" . $addressx . "', '" . $contact_personx . "', '" . $ownerx . "', ST_GeomFromText('" . $geomx . "',0),'" . $openx . "', '" . $closex . "');");

		if ($statusUpload == "EMPTY") {
		} else {
			$query2   = $db->query("INSERT INTO `souvenir_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}

		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/souvenir_place'));
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, name,id, address, contact_person, open, close, owner FROM souvenir_place WHERE id ="' . $id . '"');
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
					// 'capacity' => $row['capacity'],
					'open' => $row['open'],
					'close' => $row['close'],
					// 'employee' => $row['employee'],
					'owner' => $row['owner'],
				)
			);
			array_push($hasil['features'], $features);
		}

		// $selectData = $db->query('SELECT * FROM souvenir_facility WHERE souvenir_facility.name NOT IN (SELECT name FROM souvenir_facility RIGHT JOIN souvenir_detail_facility ON souvenir_facility.id_facility=souvenir_detail_facility.id_facility WHERE souvenir_detail_facility.id="' . $id . '")')->getResultArray();
		// $dataFacility = $db->query('SELECT * FROM souvenir_facility RIGHT JOIN souvenir_detail_facility ON souvenir_facility.id_facility=souvenir_detail_facility.id_facility WHERE souvenir_detail_facility.id="' . $id . '"')->getResultArray();


		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/souvenir_place'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'souvenir_place/update_action',
			'data' => $this->Model->getData($id),
			'status' => "Visible",
			'geometry' => $hasil,
			// 'selectData' => $selectData,
			// 'dataFacility' => $dataFacility,
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('souvenir_place/form_souvenir_place', $data);
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
			// 'capacity' => $this->request->getVar('capacity'),
			'contact_person' => $this->request->getVar('contact_person'),
			'owner' => $this->request->getVar('owner'),
			'geom' => $this->request->getVar('geom'),
			// 'employee' => $this->request->getVar('employee'),
			'open' => $this->request->getVar('open'),
			'close' => $this->request->getVar('close'),
		];
		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		// $capacityx = $this->request->getVar('capacity');
		$contact_personx = $this->request->getVar('contact_person');
		$ownerx = $this->request->getVar('owner');
		$geomx = $this->request->getVar('geom');
		// $employeex = $this->request->getVar('employee');
		$openx = $this->request->getVar('open');
		$closex = $this->request->getVar('close');
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
		$query   = $db->query("UPDATE `souvenir_place` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `contact_person` = '" . $contact_personx . "', `owner` = '" . $ownerx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `geom` = ST_GeomFromText('" . $geomx . "',0) WHERE `souvenir_place`.`id` = '" . $idx . "';");

		if ($statusUpload == "EMPTY") {
		} else {

			$query2   = $db->query("INSERT INTO `souvenir_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}
		// $query2   = $db->query("UPDATE `souvenir_gallery` SET `url` = '" . $fileName . "';");
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('souvenir_place'));
	}

	public function add_facility($id_souvenir, $id_facility)
	{
		$db = \Config\Database::connect();

		// $query   = $db->query("SELECT MAX(id) as max FROM souvenir_detail_facility");
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
		// echo $id_souvenir . $id_facility;
		// echo "INSERT INTO `souvenir_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_souvenir . "');";

		$query   = $db->query("INSERT INTO `souvenir_detail_facility` (`id_facility`, `id`) VALUES ( '" . $id_facility . "', '" . $id_souvenir . "');");
	}


	public function delete_facility($id, $id_facility)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM souvenir_detail_facility WHERE id='" . $id . "'  AND id_facility='" . $id_facility . "'");
		// redirect ke id_target
	}


	public function delete_image($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM souvenir_gallery WHERE id_gallery='" . $id . "'");
	}

	//DELETE
	public function delete($id)
	{

		$db = \Config\Database::connect();
		// $query   = $db->query("DELETE FROM souvenir_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM souvenir_gallery WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM souvenir_place WHERE id='" . $id . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/souvenir_place'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('capacity', 'capacity', 'trim|required|numeric');
		$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');
		$this->form_validation->set_rules('owner', 'owner', 'trim|required');
		$this->form_validation->set_rules('geom', 'geom', 'trim|required');
		$this->form_validation->set_rules('employee', 'employee', 'trim|required|numeric');
		$this->form_validation->set_rules('open', 'open', 'trim|required');
		$this->form_validation->set_rules('close', 'close', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
