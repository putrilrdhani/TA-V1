<?php

namespace App\Controllers;


use App\Models\PackageModel;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User as MythUser;

class Package extends BaseController
{
	/**
	 * Class constructor.
	 */
	protected $PageData;
	protected $Model; //Default Models Of this Controler
	protected $pager;
	protected $auth;
	protected $user;
	protected $autr;

	/**
	 * @var AuthConfig
	 */
	protected $config;

	/**
	 * @var Session
	 */
	protected $session;
	public function __construct()
	{
		$this->Model = new PackageModel(); //Set Default Models Of this Controler
		$this->PageData = $this->attributePage(); //Attribute Of Page
		$pager = \Config\Services::pager();
		$this->session = service('session');

		$this->config = config('Auth');
		$this->auth   = service('authentication');
		$this->autr   = service('authorization');
	}

	//ATRIBUTE THIS PAGE
	private function attributePage()
	{
		return  [
			'title' => 'Package',
			'app' => '',
		];
	}

	//INDEX 
	public function index()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM package_day');
		$query1   = $db->query('SELECT * FROM service_package');
		$query2   = $db->query('SELECT * FROM detail_package');
		$query3   = $db->query('SELECT * FROM detail_service_package');

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
		foreach ($query1->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_service_package' => $row['id_service_package'],
					'name' => $row['name'],
				)
			);
			array_push($hasil1['features'], $features);
		}
		$hasil2 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query2->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'activity' => $row['activity'],
					'activity_type' => $row['activity_type'],
					'id_object' => $row['id_object'],
					'description' => $row['description'],
				)
			);
			array_push($hasil2['features'], $features);
		}
		$hasil3 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query3->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_service_package' => $row['id_service_package'],
					'id_package' => $row['id_package'],
					'status' => $row['status'],
				)
			);
			array_push($hasil3['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Package',
			'data' => $this->Model->getData(),
			'pager' => $this->Model->pager,
			'package_day' => $hasil,
			'service_package' => $hasil1,
			'detail_package' => $hasil2,
			'detail_service_package' => $hasil3
		];
		return view('package_all/index_package_all', $data);
	}

	//READ
	public function read($id_package)
	{

		$db = \Config\Database::connect();
		$query_filter   = $db->query('SELECT * FROM detail_package WHERE id_package="' . $id_package . '" ORDER BY CAST(activity AS SIGNED) ASC');
		$rows_total = $query_filter->getNumRows();
		$in = 0;

		$P = 0;
		$finalArray = array(
			'bulk' => array()
		);
		$hasil_pop = array(

			'data' => array()
		);


		while ($in < $rows_total) {

			$row = $query_filter->getResultArray();

			// Jika id_object dapat
			// Periksa tabel sesuai id object
			// var_dump($row[$in]['id_object']);
			if (str_contains($row[$in]['id_object'], "T")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN tourism_object ON detail_package.id_object=tourism_object.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "H")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN homestay ON detail_package.id_object=homestay.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "W")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN worship_place ON detail_package.id_object=worship_place.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "C")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN culinary ON detail_package.id_object=culinary.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "S")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN souvenir_place ON detail_package.id_object=souvenir_place.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			}
			$in++;
		}



		$query   = $db->query('SELECT id_package, name, min_capaity, contact_person, description, brosur_url, price FROM package WHERE id_package = "' . $id_package . '"');
		$query4   = $db->query('SELECT * FROM package_day WHERE id_package="' . $id_package . '"');
		$query2   = $db->query('SELECT * FROM detail_package WHERE id_package="' . $id_package . '"');
		$query3   = $db->query('SELECT id_package,detail_service_package.id_service_package as id_service_package, service_package.name as name FROM detail_service_package LEFT JOIN service_package ON detail_service_package.id_service_package=service_package.id_service_package WHERE id_package="' . $id_package . '" ');

		$hasil4 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query4->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'description' => $row['description'],
				)
			);
			array_push($hasil4['features'], $features);
		}

		$hasil2 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query2->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'activity' => $row['activity'],
					'activity_type' => $row['activity_type'],
					'id_object' => $row['id_object'],
					'description' => $row['description'],
				)
			);
			array_push($hasil2['features'], $features);
		}
		$hasil3 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query3->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_service_package' => $row['id_service_package'],
					'id_package' => $row['id_package'],

					'name' => $row['name']
				)
			);
			array_push($hasil3['features'], $features);
		}

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
					'min_capaity' => $row['min_capaity'],
					'contact_person' => $row['contact_person'],
					'description' => $row['description'],
					'brosur_url' => $row['brosur_url'],
					'price' => $row['price'],



				)
			);
			array_push($hasil['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id_package),
			'package_day' => $hasil4,

			'detail_package' => $hasil2,
			'detail_service_package' => $hasil3,
			'finalArray' => $finalArray
			//find on data
		];

		// var_dump($finalArray);


		return view('package/read_package', $data);
	}

	// Booking Read
	public function booking_read($id_package)
	{

		$db = \Config\Database::connect();
		$query_filter   = $db->query('SELECT * FROM detail_package WHERE id_package="' . $id_package . '" ORDER BY CAST(activity AS SIGNED) ASC');
		$rows_total = $query_filter->getNumRows();
		$in = 0;

		$P = 0;
		$finalArray = array(
			'bulk' => array()
		);
		$hasil_pop = array(

			'data' => array()
		);


		while ($in < $rows_total) {

			$row = $query_filter->getResultArray();

			// Jika id_object dapat
			// Periksa tabel sesuai id object
			// var_dump($row[$in]['id_object']);
			if (str_contains($row[$in]['id_object'], "T")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN tourism_object ON detail_package.id_object=tourism_object.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "H")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN homestay ON detail_package.id_object=homestay.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "W")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN worship_place ON detail_package.id_object=worship_place.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "C")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN culinary ON detail_package.id_object=culinary.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "S")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN souvenir_place ON detail_package.id_object=souvenir_place.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			}
			$in++;
		}



		$query   = $db->query('SELECT id_package, name, min_capaity, contact_person, description, brosur_url, price FROM package WHERE id_package = "' . $id_package . '"');
		$query4   = $db->query('SELECT * FROM package_day WHERE id_package="' . $id_package . '"');
		$query2   = $db->query('SELECT * FROM detail_package WHERE id_package="' . $id_package . '"');
		$query3   = $db->query('SELECT id_package,detail_service_package.id_service_package as id_service_package, service_package.name as name FROM detail_service_package LEFT JOIN service_package ON detail_service_package.id_service_package=service_package.id_service_package WHERE id_package="' . $id_package . '" ');

		$hasil4 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query4->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'description' => $row['description'],
				)
			);
			array_push($hasil4['features'], $features);
		}

		$hasil2 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query2->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'activity' => $row['activity'],
					'activity_type' => $row['activity_type'],
					'id_object' => $row['id_object'],
					'description' => $row['description'],
				)
			);
			array_push($hasil2['features'], $features);
		}
		$hasil3 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query3->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_service_package' => $row['id_service_package'],
					'id_package' => $row['id_package'],

					'name' => $row['name']
				)
			);
			array_push($hasil3['features'], $features);
		}

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
					'min_capaity' => $row['min_capaity'],
					'contact_person' => $row['contact_person'],
					'description' => $row['description'],
					'brosur_url' => $row['brosur_url'],
					'price' => $row['price'],



				)
			);
			array_push($hasil['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id_package),
			'package_day' => $hasil4,

			'detail_package' => $hasil2,
			'detail_service_package' => $hasil3,
			'finalArray' => $finalArray
			//find on data
		];

		// var_dump($finalArray);


		return view('booking/booking_read_package', $data);
	}
	// Detail Booking Read
	public function detail_booking_read($id_package)
	{

		$db = \Config\Database::connect();
		$query_filter   = $db->query('SELECT * FROM detail_package WHERE id_package="' . $id_package . '" ORDER BY CAST(activity AS SIGNED) ASC');
		$rows_total = $query_filter->getNumRows();
		$in = 0;

		$P = 0;
		$finalArray = array(
			'bulk' => array()
		);
		$hasil_pop = array(

			'data' => array()
		);

		if ($this->auth->check()) {

			$log = "login";
		} else {
			$log = "logout";
		}


		while ($in < $rows_total) {

			$row = $query_filter->getResultArray();

			// Jika id_object dapat
			// Periksa tabel sesuai id object
			// var_dump($row[$in]['id_object']);
			if (str_contains($row[$in]['id_object'], "T")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN tourism_object ON detail_package.id_object=tourism_object.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "H")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN homestay ON detail_package.id_object=homestay.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "W")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN worship_place ON detail_package.id_object=worship_place.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "C")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN culinary ON detail_package.id_object=culinary.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			} else if (str_contains($row[$in]['id_object'], "S")) {
				$query_pop = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y, id_package, day, activity, activity_type, description FROM detail_package INNER JOIN souvenir_place ON detail_package.id_object=souvenir_place.id WHERE id_object="' . $row[$in]['id_object'] . '" ');;
				$rows_totalT = $query_pop->getNumRows();
				$rowT = $query_pop->getResultArray();
				if ($rows_totalT > 0) {
					$features = array(
						'type' => 'Feature',
						'properties' => array(
							'id_package' => $rowT[0]['id_package'],
							'day' => $rowT[0]['day'],
							'activity' => $rowT[0]['activity'],
							'activity_type' => $rowT[0]['activity_type'],

							'description' => $rowT[0]['description'],
							'x' => $rowT[0]['x'],
							'y' => $rowT[0]['y']
						)
					);
					array_push($finalArray['bulk'], $features);
				} else {
					// Jangan lakukan apa-apa
				}
			}
			$in++;
		}



		$query   = $db->query('SELECT id_package, name, min_capaity, contact_person, description, brosur_url, price FROM package WHERE id_package = "' . $id_package . '"');
		$query4   = $db->query('SELECT * FROM package_day WHERE id_package="' . $id_package . '"');
		$query2   = $db->query('SELECT * FROM detail_package WHERE id_package="' . $id_package . '"');
		$query3   = $db->query('SELECT id_package,detail_service_package.id_service_package as id_service_package, service_package.name as name FROM detail_service_package LEFT JOIN service_package ON detail_service_package.id_service_package=service_package.id_service_package WHERE id_package="' . $id_package . '" ');

		$hasil4 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query4->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'description' => $row['description'],
				)
			);
			array_push($hasil4['features'], $features);
		}

		$hasil2 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query2->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_package' => $row['id_package'],
					'day' => $row['day'],
					'activity' => $row['activity'],
					'activity_type' => $row['activity_type'],
					'id_object' => $row['id_object'],
					'description' => $row['description'],
				)
			);
			array_push($hasil2['features'], $features);
		}
		$hasil3 = array(
			'type'    => 'FeatureCollection',
			'features' => array()
		);
		foreach ($query3->getResultArray() as $row) {
			$features = array(
				'type' => 'Feature',
				'properties' => array(
					'id_service_package' => $row['id_service_package'],
					'id_package' => $row['id_package'],

					'name' => $row['name']
				)
			);
			array_push($hasil3['features'], $features);
		}

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

					'min_capaity' => $row['min_capaity'],
					'contact_person' => $row['contact_person'],
					'description' => $row['description'],
					'brosur_url' => $row['brosur_url'],
					'price' => $row['price'],



				)
			);
			array_push($hasil['features'], $features);
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Read',
			'data' => $this->Model->getData($id_package),
			'package_day' => $hasil4,

			'detail_package' => $hasil2,
			'detail_service_package' => $hasil3,
			'finalArray' => $finalArray,
			'log' => $log
			//find on data
		];

		// var_dump($data);


		return view('booking/detail_booking_read_package', $data);
	}
	public function create_all()
	{
		$db = \Config\Database::connect();
		$query   = $db->query('SELECT * FROM service_package');
		$hasil = array(
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
			array_push($hasil['features'], $features);
		}

		$data = [
			'status' => 'Not Visible',
			'action' => 'package/create_action_all',
			'service_package' => $hasil
		];

		return view('package_all/form_package_all', $data);
	}

	public function create_action_all()
	{
		// id_package di generate
		$nameVar = $this->request->getVar('nameHidden');
		$name = $this->request->getVar('name');
		$min_capacity = $this->request->getVar('min_capacity');
		$contact_person = $this->request->getVar('contact_person');
		$price = $this->request->getVar('price');
		$description = $this->request->getVar('description');
		$image = $this->request->getVar('imageFile');
		$queryList = array();
		$m = 0;
		$dayArray = array();
		$dayArrayT = array();

		$nameVar = explode(",", $nameVar);
		$count_query = count($nameVar);
		$i = 0;
		$getData = array();
		$getData = $nameVar;
		$query_Day = "";
		$count = $count_query - 1;
		$tempDay = "";
		$query_Day = "";
		$query_DetailPackage = "";
		$day = "";
		$query_ServicePackage = "";
		// $query_Package = "INSERT INTO `package` (`id_package`, `name`, `date`, `min_capaity`, `contact_person`, `description`, `brosur_url`, `price`) VALUES ('P14', '" . $name . "', '" . $date . "', '" . $min_capacity . "', '" . $contact_person . "', '" . $description . "', '" . $image . "', '" . $price . "');";
		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_package , 'P', ''), '', '') as SIGNED)) as max from package");
		$count = $query->getNumRows();
		$id = 0;
		if ($count == 0) {
			$id = 1;
		} else {
			$res = $query->getResult();
			$res = $res[0]->max;
			$id = $res + 1;
		}

		$id = "P" . $id;

		if ($_FILES['imageFile']['error'] == 4 || ($_FILES['imageFile']['size'] == 0 && $_FILES['imageFile']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('imageFile');
			$fileName = $dataBerkas->getRandomName();
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$allowed = array('gif', 'png', 'jpg', 'mp4');

			if (!in_array($ext, $allowed)) {
				$statusUpload = "EMPTY";
			} else {
				// $dataBerkas->move('upload/', $fileName);
				$statusUpload = "SUCCESS";
			}
		}
		$id_package = $id;

		if ($statusUpload === "EMPTY") {
			$query = $db->query("INSERT INTO `package` (`id_package`,`name`,`min_capaity`,`contact_person`,`description`,`price`, `custom`) VALUES ('" . $id_package . "','" . $name .  "','" . $min_capacity . "','" . $contact_person . "','" . $description . "','" . $price . "', '0');");
		} else {
			$query = $db->query("INSERT INTO `package` (`id_package`,`name`,`min_capaity`,`contact_person`,`description`,`brosur_url`,`price`, `custom`) VALUES ('" . $id_package . "','" . $name .  "','" . $min_capacity . "','" . $contact_person . "','" . $description . "','" . $fileName . "','" . $price . "', '0');");
		}

		// echo $statusUpload;

		// $query = $db->query("INSERT INTO `package` (`id_package`,`name`,`date`,`min_capaity`,`contact_person`,`description`,`brosur_url`,`price`) VALUES ('" . $id_package . "','" . $name . "','" . $date . "','" . $min_capacity . "','" . $contact_person . "','" . $description . "','" . $fileName . "','" . $price . "');");


		// Insert Package Query Here
		/* 
		
		Step:
		1. Insert package
		2.Insert package day [Looping]
		3. Insert detail Service package
		
		*/
		$tempSatu = "";
		while ($i < $count_query) {
			if (str_contains($getData[$i], 'package_day')) {

				$tempDay = explode("_", $getData[$i]);
				$tempSatu = $tempDay[1];
				$tempDay = $tempDay[2];

				$getValue = $this->request->getVar($getData[$i]);
				$day = $getValue;
				$dayArray[$tempDay] = $day;
				$dayArrayT[$tempDay] = $tempDay;

				$query_Day = "INSERT INTO `package_day` (`id_package`, `day`, `description`) VALUES ('" . $id_package . "', '" . $getValue . "', '[" . $tempDay . "]');";
			} else if (str_contains($getData[$i], 'DAY-description')) {
				$tempDayDesc = explode("_", $getData[$i]);
				$tempDayDesc = $tempDayDesc[1];
				$getValue = $this->request->getVar($getData[$i]);
				if ($tempDay == $tempDayDesc) {
					$query_Day = str_replace("[" . $tempDayDesc . "]", $getValue, $query_Day);
					$queryList[$m] = $query_Day;
					$m++;
				}

				// Looping lagi
				$countIndex = count($nameVar);
				$x = 0;
				while ($x < $countIndex) {


					if (str_contains($getData[$x], 'activity_' . $tempDay)) {


						$tempActivity = explode("_", $getData[$x]);
						$tempActivityStart = $tempActivity[1];
						$tempActivityEnd = $tempActivity[2];
						$getValue = $this->request->getVar($getData[$x]);
						if (isset($dayArrayT[$tempActivityStart])) {


							if ($tempActivityStart == $dayArrayT[$tempActivityStart]) {
								$query_DetailPackage = "INSERT INTO `detail_package` (`id_package`, `day`, `activity`, `id_object`, `description`) VALUES ('" . $id_package . "', '" . $dayArray[$tempActivityStart] . "',  '" . $getValue . "', '[DETAIL-select|" . $tempActivityStart . "]', '[DETAIL-description|" . $tempActivityStart . "]');";
								// echo $query_DetailPackage . "<br/>";

							}
						}

						// $query_Day = str_replace("[" . $tempDayDesc . "]", $getValue, $query_Day);
						// $queryList[$m] = $query_Day;
						// $m++;

					} else if (str_contains($getData[$x], 'DETAIL-description_' . $tempDay)) {

						$tempActivity = explode("_", $getData[$x]);
						$tempActivityStart = $tempActivity[1];
						$tempActivityEnd = $tempActivity[2];
						$getValue = $this->request->getVar($getData[$x]);
						// echo $getValue . "<br/>";
						$seacrhString = "[DETAIL-description|" . $tempActivityStart . "]";
						// echo "[DETAIL-select|" . $tempActivityEnd . "]" . $getValue;
						// $queryTemp = str_replace($seacrhString, "TEST", $query_DetailPackage);
						$query_DetailPackage = str_replace($seacrhString, $getValue, $query_DetailPackage);
						// echo $seacrhString;
						// echo $query_DetailPackage . "<br/>";
						// echo "TEMP:" . $queryTemp . "<br/>";
						// $query_DetailPackage = str_replace("[DETAIL-select|" . $tempActivityEnd . "]", "TEST", $query_DetailPackage);
						// echo $query_DetailPackage . "<br/>";
						// $query_Day = str_replace("[" . $tempDayDesc . "]", $getValue, $query_Day);
						// $queryList[$m] = $query_Day;
						// $m++;

					} else if (str_contains($getData[$x], 'select_object_' . $tempDay)) {


						$tempActivity = explode("_", $getData[$x]);
						$tempActivityStart = $tempActivity[1];
						$tempActivityEnd = $tempActivity[2];
						$getValue = $this->request->getVar($getData[$x]);
						// echo $getValue . "<br/>";
						$seacrhString = "[DETAIL-select|" . $tempActivityEnd . "]";
						// echo "[DETAIL-select|" . $tempActivityEnd . "]" . $getValue;
						$queryTemp = str_replace($seacrhString, "TEST", $query_DetailPackage);
						$query_DetailPackage = str_replace($seacrhString, $getValue, $query_DetailPackage);
						// echo $query_DetailPackage . "<br/>";
						// echo "TEMP:" . $queryTemp . "<br/>";
						// $query_DetailPackage = str_replace("[DETAIL-select|" . $tempActivityEnd . "]", "TEST", $query_DetailPackage);
						// echo $query_DetailPackage . "<br/>";
						// $query_Day = str_replace("[" . $tempDayDesc . "]", $getValue, $query_Day);
						$queryList[$m] = $query_DetailPackage;
						$m++;
					}


					$x++;
				}
			} else if (str_contains($getData[$i], 'checkbox_service_package')) {

				$getValue = $this->request->getVar($getData[$i]);
				$query_ServicePackage = "INSERT INTO `detail_service_package` (`id_service_package`, `id_package`) VALUES ('" . $getValue . "', '" . $id_package . "');";
				$queryList[$m] = $query_ServicePackage;
				$m++;
			}






			$i++;
		}

		$queryLength = count($queryList);
		$i = 0;
		while ($i < $queryLength) {
			$query = $db->query($queryList[$i]);
			// echo $queryList[$i] . "<br/>";
			$i++;
		}

		// var_dump($queryList);
		// echo "<br/>";
		// var_dump($nameVar);
		return redirect()->to(base_url('/package'));

		// var_dump($nameVar);
	}

	public function get_object()
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
		$data = [

			'package_day' => $hasil,
			'tourism_object' => $hasil1,
			'culinary' => $hasil2,
			'event' => $hasil3,
			'homestay' => $hasil4,
			'souvenir' => $hasil5,
			'worship' => $hasil6
		];

		echo json_encode($data);
	}

	//CREATE
	public function create()
	{
		$db = \Config\Database::connect();
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Create Pages',
			'action' => site_url('package/create_action'),
			'data' =>   [
				'id_package' => set_value('id_package'),
				'name' => set_value('name'),
				'min_capaity' => set_value('min_capaity'),
				'contact_person' => set_value('contact_person'),
				'description' => set_value('description'),
				'brosur_url' => set_value('brosur_url'),
				'price' => set_value('price'),
			],
			'status' => "Visible",
		];
		return view('package/form_package', $data);
	}

	//ACTION CREATE
	public function create_action()
	{
		$db = \Config\Database::connect();

		$query   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_package , 'P', ''), '', '') as SIGNED)) as max from package");
		$count = $query->getNumRows();
		$id = 0;
		if ($count == 0) {
			$id = 1;
		} else {
			$res = $query->getResult();
			$res = $res[0]->max;
			$id = $res + 1;
		}

		$id = "P" . $id;
		$data = [
			'id_package' => $this->request->getVar('id_package'),
			'name' => $this->request->getVar('name'),
			'min_capaity' => $this->request->getVar('min_capaity'),
			'contact_person' => $this->request->getVar('contact_person'),
			'description' => $this->request->getVar('description'),
			'brosur_url' => $this->request->getVar('brosur_url'),
			'price' => $this->request->getVar('price'),

		];
		$id_package = $id;
		$name = $this->request->getVar('name');
		$min_capaity = $this->request->getVar('min_capaity');
		$contact_person = $this->request->getVar('contact_person');
		$description = $this->request->getVar('description');
		// $brosur_url = $this->request->getVar('brosur_url');
		$price = $this->request->getVar('price');

		if ($_FILES['brosur_url']['error'] == 4 || ($_FILES['brosur_url']['size'] == 0 && $_FILES['brosur_url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('brosur_url');
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

		$query = $db->query("INSERT INTO `package` (`id_package`,`name`,`min_capaity`,`contact_person`,`description`,`brosur_url`,`price`) VALUES ('" . $id_package . "','" . $name . "','" . $min_capaity . "','" . $contact_person . "','" . $description . "','" . $fileName . "','" . $price . "');");



		// $this->Model->save($data);
		session()->setFlashdata('message', 'Create Record Success');
		return redirect()->to(base_url('/package'));
	}

	//UPDATE
	public function update($id_package)
	{
		$dataFind = $this->Model->getData($id_package);
		if ($dataFind == false) {
			return redirect()->to(base_url('/package'));
		}
		$data = [
			'AttributePage' => $this->PageData,
			'content' => 'Edit ',
			'action' => 'package/update_action',
			'data' => $this->Model->getData($id_package),
			'status' => 'Visible'
		];
		session()->setFlashdata('message', 'Update Record Success');
		return view('package/form_package', $data);
	}

	//ACTION UPDATE
	public function update_action()
	{
		$id = $this->request->getVar('id_package');
		$row = $this->Model->getData(['id_package' => $id]);

		$data = [
			'id_package' => $this->request->getVar('id_package'),
			'name' => $this->request->getVar('name'),
			'min_capaity' => $this->request->getVar('min_capaity'),
			'contact_person' => $this->request->getVar('contact_person'),
			'description' => $this->request->getVar('description'),
			'brosur_url' => $this->request->getVar('brosur_url'),
			'price' => $this->request->getVar('price'),
		];

		$id_package = $this->request->getVar('id_package');
		$name = $this->request->getVar('name');
		$min_capaity = $this->request->getVar('min_capaity');
		$contact_person = $this->request->getVar('contact_person');
		$description = $this->request->getVar('description');
		$brosur_url = $this->request->getVar('brosur_url');
		$price = $this->request->getVar('price');

		if ($_FILES['brosur_url']['error'] == 4 || ($_FILES['brosur_url']['size'] == 0 && $_FILES['brosur_url']['error'] == 0)) {
			// cover_image is empty (and not an error), or no file was uploaded
			$statusUpload = "EMPTY";
		} else {
			$dataBerkas = $this->request->getFile('brosur_url');
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

		if ($statusUpload == "SUCCESS") {
			$db = \Config\Database::connect();
			$query = $db->query("UPDATE `package` SET `id_package` = '" . $id_package . "' ,`name` = '" . $name . "' ,`min_capaity` = '" . $min_capaity . "',`contact_person` = '" . $contact_person . "',`description` = '" . $description . "',`brosur_url` = '" . $fileName . "',`price` = '" . $price . "' WHERE id_package = '" . $id_package . "';");
		} else {
			$db = \Config\Database::connect();
			$query = $db->query("UPDATE `package` SET `id_package` = '" . $id_package . "' ,`name` = '" . $name . "' ,`min_capaity` = '" . $min_capaity . "',`contact_person` = '" . $contact_person . "',`description` = '" . $description . "',`price` = '" . $price . "' WHERE id_package = '" . $id_package . "';");
		}

		// $this->Model->save($data);
		// session()->setFlashdata('message', 'Update Record Success');
		// echo "UPDATE `package` SET `id_package` = '" . $id_package . "' ,`name` = '" . $name . "' ,`date` = '" . $date . "',`min_capaity` = '" . $min_capaity . "',`contact_person` = '" . $contact_person . "',`description` = '" . $description . "',`brosur_url` = '" . $fileName . "',`price` = '" . $price . "' WHERE id_package = '" . $id_package . "';";

		return redirect()->to(base_url('package'));
	}

	//DELETE
	public function delete($id_package)
	{
		// Delete 
		$db = \Config\Database::connect();
		// $query   = $db->query("DELETE FROM culinary_detail_facility WHERE id='" . $id . "'");

		$query   = $db->query("DELETE FROM detail_package WHERE id_package='" . $id_package . "'");
		$query   = $db->query("DELETE FROM package_day WHERE id_package='" . $id_package . "'");
		$query   = $db->query("DELETE FROM detail_service_package WHERE id_package='" . $id_package . "'");
		$query   = $db->query("DELETE FROM package WHERE id_package='" . $id_package . "'");
		$query   = $db->query("DELETE FROM booking WHERE id_package='" . $id_package . "'");
		session()->setFlashdata('message', 'Delete Record Success');
		return redirect()->to(base_url('/package'));
	}

	//RULES
	public function _rules()
	{
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('min_capaity', 'min capaity', 'trim|required|numeric');
		$this->form_validation->set_rules('contact_person', 'contact person', 'trim|required');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('brosur_url', 'brosur url', 'trim|required');
		$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');

		$this->form_validation->set_rules('id_package', 'id_package', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Package.php */
 /* Location: ./app/controllers/Package.php */
 /* Please DO NOT modify this information : */
 /* Generated by Ligatcode Codeigniter 4 CRUD Generator 2023-07-04 15:05:39 */