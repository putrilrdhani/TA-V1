<?php

namespace App\Controllers;



use App\Models\Worship_placeModel;

class Worship_place extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Worship_placeModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Worship_place',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Worship Place',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('worship_place/index_worship_place', $data);
	}

	//READ
	public function read($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id,address, capacity FROM worship_place WHERE id = "' . $id . '"');
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
					// 'area_size' => $row['area_size'],
					// 'building_size' => $row['building_size'],
					'capacity' => $row['capacity'],
					// 'last_renovation' => $row['last_renovation'],
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
		return view('worship_place/read_worship_place', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id,address, capacity FROM worship_place');
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
					// 'area_size' => $row['area_size'],
					// 'building_size' => $row['building_size'],
					'capacity' => $row['capacity'],
					// 'last_renovation' => $row['last_renovation'],
				)
			);
			array_push($hasil['features'], $features);
		}
		// //SELECT * FROM `worship_category` disini query select category
		$selectCategory = $db->query("SELECT * FROM `worship_category`")->getResultArray(); // tambahkan untuk kategori
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('worship_place/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'name' => set_value('name'),
				'address' => set_value('address'),
				// 'area_size' => set_value('area_size'),
				// 'building_size' => set_value('building_size'),
				'capacity' => set_value('capacity'),
				// 'last_renovation' => set_value('last_renovation'),
				'geom' => set_value('geom'),
			],
			'status' => "Not Visible",
			'geometry' => $hasil,
			'category' => $selectCategory //tambahkan ini di setiap crewat dan update untuk kategori
		];
		return view('worship_place/form_worship_place', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'W', ''), '', '') as SIGNED)) as max from worship_place");
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
			// 'area_size' => $this->request->getVar('area_size'),
			// 'building_size' => $this->request->getVar('building_size'),
			'capacity' => $this->request->getVar('capacity'),
			// 'last_renovation' => $this->request->getVar('last_renovation'),
			'geom' => $this->request->getVar('geom'),

		];

		$idx = "W" . $id;
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		// $area_sizex = $this->request->getVar('area_size');
		// $building_sizex = $this->request->getVar('building_size');
		$capacityx = $this->request->getVar('capacity');
		// $last_renovationx = $this->request->getVar('last_renovation');
		$geomx = $this->request->getVar('geom');


		// khusus kategori dan sejenisnya
		$categoryx = $this->request->getVar('category');
		if ($_FILES['url']['error'] == 4 || ($_FILES['url']['size'] == 0 && $_FILES['url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('url');
			$fileName = $dataBerkas->getRandomName();
			$dataBerkas->move('upload/', $fileName);
			$statusUpload = "SUCCESS";
		}

		$categoryx = $this->request->getVar('category');

		$db = \Config\Database::connect();
		$query   = $db->query("INSERT INTO `worship_place` (`id`, `name`, `address`, `capacity`, `geom`) VALUES ('" . $idx . "', '" . $namex . "', '" . $addressx . "', '" . $capacityx . "', ST_GeomFromText('" . $geomx . "',0));");
		if ($statusUpload == "EMPTY") {
		} else {
			// $query2   = $db->query("UPDATE `worship_gallery` SET `url` = '" . $fileName . "';");
			$query2   = $db->query("INSERT INTO `worship_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}




		// echo $query;
		// $this->Model->save($data);
		// session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/worship_place'));
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id,address, capacity FROM worship_place WHERE id="' . $id . '"');
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
					// 'area_size' => $row['area_size'],
					// 'building_size' => $row['building_size'],
					'capacity' => $row['capacity'],
					// 'last_renovation' => $row['last_renovation'],
				)
			);
			array_push($hasil['features'], $features);
		}
		$selectCategory = $db->query("SELECT * FROM `worship_category`")->getResultArray();

		// $selectData = $db->query('SELECT * FROM worship_facility WHERE worship_facility.name NOT IN (SELECT name FROM worship_facility RIGHT JOIN worship_detail_facility ON worship_facility.id_facility=worship_detail_facility.id_facility WHERE worship_detail_facility.id="' . $id . '")')->getResultArray();
		// $dataFacility = $db->query('SELECT * FROM worship_facility RIGHT JOIN worship_detail_facility ON worship_facility.id_facility=worship_detail_facility.id_facility WHERE worship_detail_facility.id="' . $id . '"')->getResultArray();

		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/worship_place'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'worship_place/update_action',
			'data' => $this->Model->getData($id),
			'status' => "Visible",
			'geometry' => $hasil,
			'category' => $selectCategory,
			// 'selectData' => $selectData,
			// 'dataFacility' => $dataFacility,
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('worship_place/form_worship_place', $data);
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
			// 'area_size' => $this->request->getVar('area_size'),
			// 'building_size' => $this->request->getVar('building_size'),
			'capacity' => $this->request->getVar('capacity'),
			// 'last_renovation' => $this->request->getVar('last_renovation'),
			'geom' => $this->request->getVar('geom'),
		];
		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		// $area_sizex = $this->request->getVar('area_size');
		// $building_sizex = $this->request->getVar('building_size');
		$capacityx = $this->request->getVar('capacity');
		// $last_renovationx = $this->request->getVar('last_renovation');
		$geomx = $this->request->getVar('geom');
		if ($_FILES['url']['error'] == 4 || ($_FILES['url']['size'] == 0 && $_FILES['url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('url');
			$fileName = $dataBerkas->getRandomName();
			$dataBerkas->move('upload/', $fileName);
			$statusUpload = "SUCCESS";
		}

		$categoryx = $this->request->getVar('category');

		$db = \Config\Database::connect();
		$query   = $db->query("UPDATE `worship_place` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `capacity` = '" . $capacityx . "', `geom` = ST_GeomFromText('" . $geomx . "', 0) WHERE `worship_place`.`id` = '" . $idx . "' ");
		if ($statusUpload == "EMPTY") {
		} else {
			// $query2   = $db->query("UPDATE `worship_gallery` SET `url` = '" . $fileName . "';");
			$query2   = $db->query("INSERT INTO `worship_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
		}

		// $this->Model->save($data);

		session()->setFlashdata('message', 'Update Record Success');
		// echo $statusUpload;

		return redirect()->to(base_url('worship_place'));
	}


	public function delete_image($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM worship_gallery WHERE id_gallery='" . $id . "'");
	}

	// public function add_facility($id_worship, $id_facility)
	// {
	// 	$db = \Config\Database::connect();

	// 	$query   = $db->query("SELECT MAX(id) as max FROM worship_detail_facility");
	// 	$count = $query->getNumRows();
	// 	$id = 0;
	// 	if ($count == 0) {
	// 		$id = 1;
	// 	} else {
	// 		$res = $query->getResult();
	// 		$res = $res[0]->max;
	// 		$id = $res + 1;
	// 	}


	// 	$id = $id;
	// 	echo $id_worship . $id_facility;
	// 	echo "INSERT INTO `worship_detail_facility` (`id`, `id_facility`, `id`) VALUES ('" . $id . "', '" . $id_facility . "', '" . $id_worship . "');";

	// 	$query   = $db->query("INSERT INTO `worship_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_worship . "');");
	// }

	// public function delete_facility($id, $id_facility)
	// {
	// 	$db = \Config\Database::connect();
	// 	$query   = $db->query("DELETE FROM worship_detail_facility WHERE id='" . $id . "' AND id_facility='" . $id_facility . "'");
	// 	// redirect ke id_target
	// }

	//DELETE
	public function delete($id)
	{
		$db = \Config\Database::connect();
		// $query   = $db->query("DELETE FROM worship_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM worship_gallery WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM worship_place WHERE id='" . $id . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/worship_place'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('area_size', 'area size', 'trim|required|numeric');
		$this->form_validation->set_rules('building_size', 'building size', 'trim|required|numeric');
		$this->form_validation->set_rules('capacity', 'capacity', 'trim|required|numeric');
		$this->form_validation->set_rules('last_renovation', 'lat renovation', 'trim|required');
		$this->form_validation->set_rules('geom', 'geom', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
