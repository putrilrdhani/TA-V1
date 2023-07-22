<?php

namespace App\Controllers;



use App\Models\VillagesModel;

class Villages extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	public function __construct()
	{
		$this->Model = new VillagesModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Villages',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Village',
			'data' => $this->Model->paginate(5, 'paging'),
			'pager' => $this->Model->pager
		];
		return view('villages/index_village', $data);
	}

	//READ
	public function read($id)
	{
		//Copy dari sini
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id,district FROM village WHERE id="' . $id . '"');
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);

		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'geometry' => json_decode($row['geom']),
				'properties' => array(
					'name' => $row['name'],
					'id' => $row['id'],
					'district' => $row['district']
				)
			);
			array_push($hasil['features'], $features);
		}

		// Sampai sini





		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->find($id),
			'geometry' => $hasil //tambahkan ini
		];
		return view('villages/read_village', $data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id,district FROM village');
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);

		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'geometry' => json_decode($row['geom']),
				'properties' => array(
					'name' => $row['name'],
					'id' => $row['id'],
					'district' => $row['district']
				)
			);
			array_push($hasil['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create',
			'action' => site_url('villages/create_action'),
			'data' =>   [
				'id' => set_value('id'),
				'name' => set_value('name'),
				'district' => set_value('district'),
				'geom' => set_value('geom'), //ini di comment
				//agar tidak ditampilkan geom di bagian itu
				// 'geom' => set_value(json_encode($hasil)),

			],
			'status' => "Not Visible",
			'geometry' => $hasil //tambahkan ini
		];
		return view('villages/form_village', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$data = [
			'id' => $this->request->getVar('id'),
			'name' => $this->request->getVar('name'),
			'district' => $this->request->getVar('district'),
			'geom' => $this->request->getVar('geom'),

		];
		// buat variabelnya
		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$districtx = $this->request->getVar('district');
		$geomx = $this->request->getVar('geom');

		// Ganti cara save datanya
		$db = \Config\Database::connect();
		$query   = $db->query("INSERT INTO `village` (`id`, `name`, `district`, `geom`) VALUES ('" . $idx . "', '" . $namex . "', '" . $districtx . "', ST_GeomFromText('" . $geomx . "',0));");
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/villages'));
	}

	//UPDATE
	public function update($id)
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id,district FROM village WHERE id="' . $id . '"');
		// $queryEdit = $db->query('SELECT ST_AsGeoJSON(geom) as geom FROM village WHERE id="' . $id . '"');
		// $row = $queryEdit->getRow();
		$hasil = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);


		foreach ($query->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'geometry' => json_decode($row['geom']),
				'properties' => array(
					'name' => $row['name'],
					'id' => $row['id'],
					'district' => $row['district']
				)
			);
			array_push($hasil['features'], $features);
		}

		$dataFind = $this->Model->find($id);
		if ($dataFind == false) {
			return redirect()->to(base_url('/villages'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit',
			'action' => 'villages/update_action',
			'data' => $this->Model->find($id),
			'geometry' => $hasil,
			'status' => "Visible"


		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('villages/form_village', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id');
		$row = $this->Model->find(['id' => $id]);

		$data = [
			'id' => $this->request->getVar('id'),
			'name' => $this->request->getVar('name'),
			'district' => $this->request->getVar('district'),

		];

		$idx = $this->request->getVar('id');
		$namex = $this->request->getVar('name');
		$districtx = $this->request->getVar('district');
		// $geomx = $this->request->getVar('geom');

		// Ganti cara save datanya
		$db = \Config\Database::connect();
		$query   = $db->query("UPDATE `village` SET  `name` = '" . $namex . "', `district` = '" . $districtx . "'  WHERE `id` = '" . $idx . "'");
		// $this->Model->save($data);
		// $this->Model->save($data);
		session()->setFlashdata('message', 'Update Record Success');

		return redirect()->to(base_url('villages'));
		// echo "UPDATE `village` SET  `name` = '" . $namex . "', `district` = '" . $districtx . "', `geom` = ST_GeomFromText('" . $geomx . "',0) WHERE `id` = '" . $idx . "'";
	}

	//DELETE
	public function delete($id)
	{
		$row = $this->Model->find(['id' => $id]);
		if ($row) {
			$this->Model->delete($id);
			session()->setFlashdata('message', 'Delete Record Success');
			return redirect()->to(base_url('/villages'));
		} else {
			session()->setFlashdata('message', 'Record Not Found');
			return redirect()->to(base_url('/villages'));
		}
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('district', 'district', 'trim|required');
		$this->form_validation->set_rules('geom', 'geom', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
