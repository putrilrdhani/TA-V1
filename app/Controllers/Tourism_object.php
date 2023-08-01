<?php

namespace App\Controllers;



use App\Models\Tourism_objectModel;

class Tourism_object extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new Tourism_objectModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Tourism_object',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Tourism Object',
			'data' => $this->Model->getDataAll(),
			'pager' => $this->Model->pager
		];
		return view('tourism_object/index_tourism_object', $data);
	}

	//READ
	public function read($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id = "' . $id . '"');
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
					'open' => $row['open'],
					'close' => $row['close'],
					'ticket_price' => $row['ticket_price'],
					'contact_person' => $row['contact_person']
				)
			);
			array_push($hasil['features'], $features);
		}

		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id),
			'data_facility' => $this->Model->getDataFacility($id),
			'geometry' => $hasil

		];
		return view('tourism_object/read_tourism_object', $data);

		// var_dump($data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT  ST_AsGeoJSON(geom) as geom,name,id,address, open, close, ticket_price, contact_person FROM tourism_object');
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
					'open' => $row['open'],
					'close' => $row['close'],
					'ticket_price' => $row['ticket_price'],
					'geom' => $row['geom'],
					'contact_person' => $row['contact_person'],
				)
			);
			array_push($hasil['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('tourism_object/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'name' => set_value('name'),
				'address' => set_value('address'),
				'open' => set_value('open'),
				'close' => set_value('close'),
				'ticket_price' => set_value('ticket_price'),
				'geom' => set_value('geom'),
				'contact_person' => set_value('contact_person'),
			],

			'status' => "Not Visible",
			'geometry' => $hasil
		];
		return view('tourism_object/form_tourism_object', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$db = \Config\Database::connect();
		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'T', ''), '', '') as SIGNED)) as max from tourism_object");
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
			'open' => $this->request->getVar('open'),
			'close' => $this->request->getVar('close'),
			'ticket_price' => $this->request->getVar('ticket_price'),
			'geom' => $this->request->getVar('geom'),
			'contact_person' => $this->request->getVar('contact_person'),

		];


		$idx = "T" . $id;
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		$openx = $this->request->getVar('open');
		$closex = $this->request->getVar('close');
		$ticket_pricex = $this->request->getVar('ticket_price');
		$geomx = $this->request->getVar('geom');
		$contact_personx = $this->request->getVar('contact_person');

		if ($_FILES['url']['error'] == 4 || ($_FILES['url']['size'] == 0 && $_FILES['url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('url');
			$fileName = $dataBerkas->getRandomName();
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$allowed = array('gif', 'png', 'jpg', 'mp4');

			if (!in_array($ext, $allowed)) {
				$statusUpload = "EMPTY";
			} else {
				$dataBerkas->move('upload/', $fileName);
				$statusUpload = "SUCCESS";
			}
		}


		$db = \Config\Database::connect();
		$query   = $db->query("INSERT INTO `tourism_object` (`id`,`id_category`, `name`, `address`, `open`, `close`, `ticket_price`, `geom`, `contact_person`) VALUES ('" . $idx . "',2, '" . $namex . "', '" . $addressx . "', '" . $openx . "', '" . $closex . "', '" . $ticket_pricex . "', ST_GeomFromText('" . $geomx . "',0), '" . $contact_personx . "')");

		if ($statusUpload == "EMPTY") {
		} else {
			if ($ext == "mp4") {

				// echo "INSERT INTO `event_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');";
				$query2   = $db->query("INSERT INTO `tourism_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			} else {
				$query2   = $db->query("INSERT INTO `tourism_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			}
		}


		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/tourism_object'));
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT  ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id = "' . $id . '"');
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
					'open' => $row['open'],
					'close' => $row['close'],
					'ticket_price' => $row['ticket_price'],
					'geom' => $row['geom'],
					'contact_person' => $row['contact_person'],
				)
			);
			array_push($hasil['features'], $features);
		}

		$selectData = $db->query('SELECT * FROM tourism_facility WHERE tourism_facility.name NOT IN (SELECT name FROM tourism_facility RIGHT JOIN tourism_detail_facility ON tourism_facility.id_facility=tourism_detail_facility.id_facility WHERE tourism_detail_facility.id="' . $id . '")')->getResultArray();
		$dataFacility = $db->query('SELECT * FROM tourism_facility RIGHT JOIN tourism_detail_facility ON tourism_facility.id_facility=tourism_detail_facility.id_facility WHERE tourism_detail_facility.id="' . $id . '"')->getResultArray();

		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/tourism_object'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'tourism_object/update_action',
			'data' => $this->Model->getData($id),
			'status' => "Visible",
			'geometry' => $hasil,
			'selectData' => $selectData,
			'dataFacility' => $dataFacility,
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('tourism_object/form_tourism_object', $data);
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
			'open' => $this->request->getVar('open'),
			'close' => $this->request->getVar('close'),
			'ticket_price' => $this->request->getVar('ticket_price'),
			'geom' => $this->request->getVar('geom'),
			'contact_person' => $this->request->getVar('contact_person'),
		];
		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$addressx = $this->request->getVar('address');
		$openx = $this->request->getVar('open');
		$closex = $this->request->getVar('close');
		$ticket_pricex = $this->request->getVar('ticket_price');
		$geomx = $this->request->getVar('geom');
		$contact_personx = $this->request->getVar('contact_person');
		if ($_FILES['url']['error'] == 4 || ($_FILES['url']['size'] == 0 && $_FILES['url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('url');
			$fileName = $dataBerkas->getRandomName();
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$allowed = array('gif', 'png', 'jpg', 'mp4');

			if (!in_array($ext, $allowed)) {
				$statusUpload = "EMPTY";
			} else {
				$dataBerkas->move('upload/', $fileName);
				$statusUpload = "SUCCESS";
			}
		}
		$db = \Config\Database::connect();
		$query   = $db->query("UPDATE `tourism_object` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `ticket_price` = '" . $ticket_pricex . "', `geom` = ST_GeomFromText('" . $geomx . "',0), `contact_person` = '" . $contact_personx . "' WHERE `tourism_object`.`id` = '" . $idx . "';");

		if ($statusUpload == "EMPTY") {
		} else {
			if ($ext == "mp4") {

				// echo "INSERT INTO `event_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');";
				$query2   = $db->query("INSERT INTO `tourism_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			} else {
				$query2   = $db->query("INSERT INTO `tourism_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			}
		}
		// $query2   = $db->query("UPDATE `tourism_gallery` SET `url` = '" . $fileName . "';");
		// $this->Model->save($data); 
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('tourism_object'));
		// echo "UPDATE `tourism_object` SET `name` = '" . $namex . "', `address` = '" . $addressx . "', `open` = '" . $openx . "', `close` = '" . $closex . "', `ticket_price` = '" . $ticket_pricex . "', `geom` = ST_GeomFromText('" . $geomx . "',0), `contact_person` = '" . $contact_personx . "' WHERE `tourism_object`.`id` = '" . $idx . "';";
	}


	public function delete_image($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM tourism_gallery WHERE id_gallery='" . $id . "'");
	}

	public function delete_video($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM tourism_video WHERE id_video='" . $id . "'");
	}



	public function add_facility($id_tourism, $id_facility)
	{
		$db = \Config\Database::connect();

		// $query   = $db->query("SELECT MAX(id) as max FROM tourism_detail_facility");
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
		// echo $id_tourism . $id_facility;
		// echo "INSERT INTO `tourism_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_tourism . "');";

		$query   = $db->query("INSERT INTO `tourism_detail_facility` (`id_facility`, `id`) VALUES ('" . $id_facility . "', '" . $id_tourism . "');");
	}

	public function delete_facility($id, $id_facility)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM tourism_detail_facility WHERE id='" . $id . "' AND id_facility='" . $id_facility . "'");
		// redirect ke id_target
	}

	//DELETE
	public function delete($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM tourism_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM tourism_gallery WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM tourism_video WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM tourism_object WHERE id='" . $id . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/tourism_object'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('address', 'address', 'trim|required');
		$this->form_validation->set_rules('open', 'open', 'trim|required');
		$this->form_validation->set_rules('close', 'close', 'trim|required');
		$this->form_validation->set_rules('ticket_price', 'ticket pricce', 'trim|required|numeric');
		$this->form_validation->set_rules('geom', 'geom', 'trim|required');
		$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
