<?php

namespace App\Controllers;


use App\Models\EventModel;

class Event extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new EventModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Event and Attraction',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Event and Attraction',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager
		];
		return view('event/index_event', $data);
	}

	//READ
	public function read($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, description, contact_person, date_start, date_end, ticket_price FROM event WHERE id = "' . $id . '"');
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
					'description' => $row['description'],
					'date_start' => $row['date_start'],
					'date_end' => $row['date_end'],
					'ticket_price' => $row['ticket_price'],
					'contact_person' => $row['contact_person'],


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
		return view('event/read_event', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$selectCategory = $db->query("SELECT * FROM `event_category`")->getResultArray(); // tambahkan untuk kategori
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('event/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'name' => set_value('name'),
				'date_start' => set_value('date_start'),
				'date_end' => set_value('date_end'),
				'description' => set_value('description'),
				'ticket_price' => set_value('ticket_price'),
				'contact_person' => set_value('contact_person'),
			],
			'status' => "Visible",
			'category' => $selectCategory //tambahkan ini di setiap crewat dan update untuk kategori
		];

		return view('event/form_event', $data);
	}

	//ACTION CREATE
	public function create_action()
	{

		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id , 'E', ''), '', '') as SIGNED)) as max from event");
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
			'date_start' => $this->request->getVar('date_start'),
			'date_end' => $this->request->getVar('date_end'),
			'description' => $this->request->getVar('description'),
			'ticket_price' => $this->request->getVar('ticket_price'),
			'contact_person' => $this->request->getVar('contact_person'),

		];

		$idx = "E" . $id;
		$namex = $this->request->getVar('name');
		$date_startx = $this->request->getVar('date_start');
		$date_endx = $this->request->getVar('date_end');
		$descriptionx = $this->request->getVar('description');
		$ticket_pricex = $this->request->getVar('ticket_price');
		$contact_personx = $this->request->getVar('contact_person');
		$geom = $this->request->getVar('geom');
		$categoryx = $this->request->getVar('category');


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


		$query   = $db->query("INSERT INTO `event` (`id`, `name`, `date_start`, `date_end`, `description`, `ticket_price`, `contact_person`, `id_category`, `geom` ) VALUES ('" . $idx . "', '" . $namex . "', '" . $date_startx . "', '" . $date_endx . "', '" . $descriptionx . "', '" . $ticket_pricex . "', '" . $contact_personx . "', '" . $categoryx . "', ST_GeomFromText('" . $geom . "',0));");


		if ($statusUpload == "EMPTY") {
		} else {
			if ($ext == "mp4") {

				// echo "INSERT INTO `event_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');";
				$query2   = $db->query("INSERT INTO `event_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			} else {
				$query2   = $db->query("INSERT INTO `event_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			}
		}
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/event'));
	}


	public function delete_video($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM event_video WHERE id_video='" . $id . "'");
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, name,id,date_start, date_end, description, ticket_price, contact_person FROM event WHERE id="' . $id . '"');
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
					'date_start' => $row['date_start'],
					'date_end' => $row['date_end'],
					'description' => $row['description'],
					'ticket_price' => $row['ticket_price'],
					'contact_person' => $row['contact_person'],
				)
			);
			array_push($hasil['features'], $features);
		}
		$selectCategory = $db->query("SELECT * FROM `event_category`")->getResultArray();

		$dataFind = $this->Model->getData($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/event'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'event/update_action',
			'data' => $this->Model->getData($id),
			'status' => "Visible",
			'geometry' => $hasil,
			'category' => $selectCategory,

		];

		session()->setFlashdata('message', 'Update Record Success');
		return view('event/form_event', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id');
		$row = $this->Model->getData(['id' => $id]);


		$data = [
			'id' => $this->request->getVar('id'),
			'name' => $this->request->getVar('name'),
			'date_start' => $this->request->getVar('date_start'),
			'date_end' => $this->request->getVar('date_end'),
			'description' => $this->request->getVar('description'),
			'ticket_price' => $this->request->getVar('ticket_price'),
			'contact_person' => $this->request->getVar('contact_person'),
		];

		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$date_startx = $this->request->getVar('date_start');
		$date_endx = $this->request->getVar('date_end');
		$descriptionx = $this->request->getVar('description');
		$ticket_pricex = $this->request->getVar('ticket_price');
		$contact_personx = $this->request->getVar('contact_person');

		$categoryx = $this->request->getVar('category');

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
		$query   = $db->query("UPDATE `event` SET `id_category` = '" . $categoryx . "',`name` = '" . $namex . "', `date_start` = '" . $date_startx . "', `date_end` = '" . $date_endx . "', `description` = '" . $descriptionx . "', `ticket_price` = '" . $ticket_pricex . "', `contact_person` = '" . $contact_personx . "' WHERE `event`.`id` = '" . $idx . "';");

		// $query2   = $db->query("UPDATE `event_gallery` SET `url` = '" . $fileName . "';");
		if ($statusUpload == "EMPTY") {
		} else {
			if ($ext == "mp4") {

				// echo "INSERT INTO `event_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');";
				$query2   = $db->query("INSERT INTO `event_video` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			} else {
				$query2   = $db->query("INSERT INTO `event_gallery` (`id`, `url`) VALUES ('" . $idx . "', '" . $fileName . "');");
			}
		}

		// echo ("UPDATE `event` SET `name` = '" . $namex . "', `date_start` = '" . $date_startx . "', `date_end` = '" . $date_endx . "', `description` = '" . $descriptionx . "', `ticket_price` = '" . $ticket_pricex . "', `contact_person` = '" . $contact_personx . "' WHERE `event.id` = '" . $idx . "';");
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');



		return redirect()->to(base_url('event'));
	}


	public function delete_image($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query("DELETE FROM event_gallery WHERE id_gallery='" . $id . "'");
	}


	//DELETE
	public function delete($id)
	{
		$db = \Config\Database::connect();
		// $query   = $db->query("DELETE FROM event_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM event_gallery WHERE id='" . $id . "'");
		$query   = $db->query("DELETE FROM event WHERE id='" . $id . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/event'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('date_start', 'date start', 'trim|required');
		$this->form_validation->set_rules('date_end', 'date end', 'trim|required');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('ticket_price', 'ticket price', 'trim|required|numeric');
		$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
