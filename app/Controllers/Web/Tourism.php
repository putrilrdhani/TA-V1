<?php

namespace App\Controllers\Web;

use App\Controllers\Worship_place;
use CodeIgniter\Database\Config;
use \App\Models\TourismModel;
use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\Tourism_objectModel;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User as MythUser;





class Tourism extends ResourcePresenter
{
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
        header('Access-Control-Allow-Origin: *');
        $this->Model = new Tourism_objectModel(); //Set Default Models Of this Controler
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
        $this->autr   = service('authorization');







        $pager = \Config\Services::pager();
    }
    public function web()
    {



        if ($this->auth->check()) {

            $data = [
                'title' => 'Home',
                'log' => 'login',


            ];

            if (isset($_SESSION['redirect_urlX'])) {
                $id_user = $_SESSION['redirect_urlX'];
                $db = \Config\Database::connect();
                $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
                $query = $query->getFirstRow();
                if ($query->group_id == 1) {
                    // return view('web/home', $data);
                    return redirect()->to(site_url());
                } else {
                    return view('web/home', $data);
                }
            } else {
                $id_user = NULL;
                return view('web/home', $data);
            }
        } else {
            $data = [
                'title' => 'Home',
                'log' => 'logout'
            ];

            return view('web/home', $data);
        }
    }

    public function search_name_part($id)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object ');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataTourismAll(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'facility' => $this->Model->getFacility(),
            'worship' => $this->Model->getWorship(),
            'search' => $id,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/search_all', $data);
    }
    public function search_facility_part_all($id)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,tourism_object.id as id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_detail_facility ON tourism_object.id=tourism_detail_facility.id WHERE id_facility="' . $id . '"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }
    public function search_facility_part($id)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object ');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataTourismAll(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'facility' => $this->Model->getFacility(),
            'worship' => $this->Model->getWorship(),
            'search' => $id,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }

        return view('web/search_facility_part', $data);
    }

    public function select_selected()
    {


        $db = \Config\Database::connect();
        $query   = $db->query('SELECT * FROM tourism_facility');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',

                'properties' => array(
                    'id_facility' => $row['id_facility'],
                    'name' => $row['name'],

                )
            );
            array_push($hasil['features'], $features);
        }



        echo json_encode($hasil);
    }

    public function select_tourism($id)
    {


        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id="' . $id . '"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }



        echo json_encode($hasil);
    }


    public function list()
    {
        $db = \Config\Database::connect();


        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );


        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data

            'village' => $geom_village,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/list_agro', $data);
    }

    public function read_list_package($id_package)
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
            'data' => $this->Model->getDataPackage($id_package),
            'package_day' => $hasil4,

            'detail_package' => $hasil2,
            'detail_service_package' => $hasil3,
            'finalArray' => $finalArray,
            'log' => $log
            //find on data
        ];

        // var_dump($finalArray);
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/read_list_package', $data);
    }

    public function select_package_read($id_package)
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
            'data' => $this->Model->getDataPackage($id_package),
            'package_day' => $hasil4,

            'detail_package' => $hasil2,
            'detail_service_package' => $hasil3,
            'finalArray' => $finalArray,
            'log' => $log

        ];

        // var_dump($finalArray);


        echo json_encode($data);
    }

    public function cancel_booking($booking_date, $id_user, $id_package)
    {

        $db = \Config\Database::connect();
        $query   = $db->query("UPDATE `booking` SET `status` = '3' WHERE `date` = '" . $booking_date . "' AND `id`='" . $id_user . "' AND `id_package`='" . $id_package . "';");
        // echo "UPDATE `booking` SET `status` = '3' WHERE `date` = '" . $booking_date . "' AND `id`='" . $id_user . "' AND `id_package`='" . $id_package . "';";
        // return redirect()->to(base_url('booking'));
        echo 'masuk';
    }

    public function buy_package($id_package, $total_member, $comment, $date)
    {

        // Booking
        $db = \Config\Database::connect();


        // $queryX   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_booking , 'B', ''), '', '') as SIGNED)) as max from booking");
        // $count = $queryX->getNumRows();
        // $id = 0;
        // if ($count == 0) {
        //     $id = 1;
        // } else {
        //     $res = $queryX->getResult();
        //     $res = $res[0]->max;
        //     $id = $res + 1;
        // }

        // $id = "B" . $id;


        // $id_booking = $id;

        // Query untuk booking
        // $mythUser = var_dump($this->auth->check());


        // var_dump(user());
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
        } else {
            $id_user = NULL;
        }

        if ($id_user == NULL) {

            echo "NULL";
        } else {
            $save = $db->query("INSERT INTO `booking` ( `date`,`id`, `id_package`, `purchase_date`, `purchase_time`,  `total_member`, `status`, `comment`) VALUES ( '" . $date . "', '" . $id_user . "', '" . $id_package . "', NOW(), NOW(), '" . $total_member . "', '0', '" . $comment . "');");
            echo "SUCCESS";
        }

        // $booking = "INSERT INTO `booking` (`id_booking`, `id`, `id_package`, `purchase_date`, `purchase_time`, `date`, `total_member`, `status`, `comment`) VALUES ('" . $id_booking . "', '" . $id_user . "', '" . $id_package . "', NOW(), NOW(), '" . $date . "', '" . $total_member . "', '0', '" . $comment . "');";


    }

    public function detail_booking($id)
    {

        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
        } else {
            $id_user = NULL;
        }

        // Booking
        $db = \Config\Database::connect();


        // $queryX   = $db->query('SELECT * FROM booking WHERE id="' . $id_user . '"');

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }


        $data = [
            'AttributePage' => $this->PageData,
            'content' => 'List Booking',
            'data' => $this->Model->getDataBooking($id_user),
            'log' => $log
        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/detail_booking', $data);

        // Query untuk booking
        // $mythUser = var_dump($this->auth->check());
        $users = new \Myth\Auth\Models\UserModel();

        // var_dump(user());
        // $booking = "INSERT INTO `booking` (`id_booking`, `id`, `id_package`, `purchase_date`, `purchase_time`, `date`, `total_member`, `status`, `comment`) VALUES ('" . $id_booking . "', '" . $id . "', '" . $id_package . "', NOW(), NOW(), '" . $date . "', '" . $total_member . "', '0', '" . $comment . "');";
    }

    public function list_package()
    {

        $db = \Config\Database::connect();


        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

        $query   = $db->query('SELECT * FROM service_package');
        $hasil_service = array(
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
            array_push($hasil_service['features'], $features);
        }

        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataPackage(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'service_package' => $hasil_service,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }

        return view('web/list_package', $data);
    }



    public function custom_order()
    {
        if (isset($_SESSION['redirect_urlX'])) {
            // id_package di generate
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $nameVar = $this->request->getVar('nameHidden');
            $date = $this->request->getVar('date');
            //PUTRI   MASUKKAN NAMA USER KE NAMA PAKET BOOKING
            $name = $id_user;
            $total_member = $this->request->getVar('total_member');
            $comment = $this->request->getVar('comment');
            $min_capacity = 0;
            $contact_person = 0;
            $price = 0;


            $queryList = array();
            $m = 0;
            $dayArray = array();
            $dayArrayT = array();

            $nameVar = explode(",", $nameVar);
            // var_dump($nameVar);
            $count_query = count($nameVar);
            // echo $count_query;
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


            $id_package = $id;
            $user_name = $_SESSION['ses_name'];

            $description = 'Custom order by ' . $user_name;

            $query = $db->query("INSERT INTO `package` (`id_package`,`name`,`min_capaity`,`contact_person`,`description`,`price`,`custom`) VALUES ('" . $id_package . "','" . $user_name . "','" . $min_capacity . "','" . $contact_person . "','" . $description . "','" . $price . "','1');");


            // echo $statusUpload;

            // $query = $db->query("INSERT INTO `package` (`id_package`,`name`,`date`,`min_capaity`,`contact_person`,`description`,`brosur_url`,`price`) VALUES ('" . $id_package . "','" . $name . "','" . $date . "','" . $min_capacity . "','" . $contact_person . "','" . $description . "','" . $fileName . "','" . $price . "');");


            // Insert Package Query Here
            /* 
		
		Step:
		1. Insert package
		2.Insert package day [Looping]
		3. Insert detail Service package
		
		*/

            $activity_count = 0;
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

                    // var_dump($dayArrayT);
                    $query_Day = $db->query("INSERT INTO `package_day` (`id_package`, `day`, `description`) VALUES ('" . $id_package . "', '" . $getValue . "', 'USER INPUT');");
                    // echo "INSERT INTO `package_day` (`id_package`, `day`, `description`) VALUES ('" . $id_package . "', '" . $getValue . "', 'USER INPUT');";
                    // echo "<br/>";
                    // $queryList[$m] = $query_Day;
                    // $m++;
                } else if (str_contains($getData[$i], 'select_object_')) {
                    // echo "TEST SAJA" . "<br/>";
                    $textEx = explode("_", $getData[$i]);
                    $id_object = $this->request->getVar($getData[$i]);


                    // var_dump($textEx[2]);

                    if ($textEx[2] == $tempDay) {

                        $activity_count = $activity_count + 1;
                        // echo $activity_count . "<br/>";

                        // Disini harus ambil name

                        // Check if Objecy dahulu
                        if (str_contains($id_object, 'S')) {
                            $query = $db->query("SELECT * FROM `souvenir` WHERE id='" . $id_object . "' ");
                            $query = $query->getFirstRow();
                        } else if (str_contains($id_object, 'T')) {
                            $query = $db->query("SELECT * FROM `tourism_object` WHERE id='" . $id_object . "' ");
                            $query = $query->getFirstRow();
                        } else if (str_contains($id_object, 'W')) {
                            $query = $db->query("SELECT * FROM `worship_place` WHERE id='" . $id_object . "' ");
                            $query = $query->getFirstRow();
                        } else if (str_contains($id_object, 'H')) {
                            $query = $db->query("SELECT * FROM `homestay` WHERE id='" . $id_object . "' ");
                            $query = $query->getFirstRow();
                        } else if (str_contains($id_object, 'E')) {
                            $query = $db->query("SELECT * FROM `event` WHERE id='" . $id_object . "' ");
                            $query = $query->getFirstRow();
                        } else if (str_contains($id_object, 'C')) {
                            $query = $db->query("SELECT * FROM `culinary` WHERE id='" . $id_object . "' ");
                            $query = $query->getFirstRow();
                        }

                        $desc_auto = $query->name;




                        /*Logikanya
                        1. Harus dapat ID dari select object
                        2. Harus dapat kode dari select object
                        3.Select sesuai dengan id penanda select object
                        4. generate Query sesuai hasil
                        5. Buekan kode masing-masing place disiko tolong
                        Souvenir: S
                        Tourism : T
                        Worship : W
                        Homestay : H
                        Event : E
                        Culinary : C
                        Dulu lai yg id nyo ndk pake label ndak?
                    */


                        $query_DetailPackage = $db->query("INSERT INTO `detail_package` (`id_package`, `day`, `activity`, `id_object`, `description`) VALUES ('" . $id_package . "','" . $day . "','" . $activity_count . "','" . $id_object . "','" . $desc_auto . "');");
                        // echo "INSERT INTO `detail_package` (`id_package`, `day`, `activity`, `id_object`, `description`) VALUES ('" . $id_package . "','" . $day . "','" . $activity_count . "','" . $id_object . "','USER INPUT');";
                        // echo "<br/>";
                        // $queryList[$m] = $query_DetailPackage;
                        // $m++;
                    }
                } else if (str_contains($getData[$i], 'checkbox_service_package')) {
                    $getValue = $this->request->getVar($getData[$i]);
                    $query_ServicePackage = $db->query("INSERT INTO `detail_service_package` (`id_service_package`, `id_package`) VALUES ('" . $getValue . "', '" . $id_package . "');");
                    // $queryList[$m] = $query_ServicePackage;
                    // $m++;
                }






                $i++;
            }

            // $queryLength = count($queryList);
            // $i = 0;
            // while ($i < $queryLength) {
            //     // $query = $db->query($queryList[$i]);
            //     echo $queryList[$i] . "<br/>";
            //     $i++;
            // }

            // $queryX   = $db->query("select MAX(CAST(REPLACE(REPLACE(id_booking , 'B', ''), '', '') as SIGNED)) as max from booking");
            // $count = $queryX->getNumRows();
            // $id = 0;
            // if ($count == 0) {
            //     $id = 1;
            // } else {
            //     $res = $queryX->getResult();
            //     $res = $res[0]->max;
            //     $id = $res + 1;
            // }

            // $id = "B" . $id;


            // $id_booking = $id;
            $id_user = $_SESSION['redirect_urlX'];
            // PUTRI    DATE NYA MERAH
            // Query untuk booking
            // $booking = "INSERT INTO `booking` (`id_booking`, `id`, `id_package`, `purchase_date`, `purchase_time`, `date`, `total_member`, `status`, `comment`) VALUES ('" . $id_booking . "', '" . $id_user . "', '" . $id_package . "', NOW(), NOW(), '" . $date . "', '" . $total_member . "', '0', '" . $comment . "');";
            $query_b = $db->query("INSERT INTO `booking` ( `date`,`id`, `id_package`, `purchase_date`, `purchase_time`,  `total_member`, `status`, `comment`) VALUES ('" . $date . "','" . $id_user . "', '" . $id_package . "', NOW(), NOW(),  '" . $total_member . "', '0', '" . $comment . "');");
            // var_dump($queryList);
            // echo "<br/>";
            // var_dump($nameVar);
            return redirect()->to(base_url('web/list_package'));

            // echo $booking;
        } else {
            echo "<script>alert('Must Login')</script>";
            return redirect()->to(base_url('web/list_package'));
        }
    }

    public function search_name($key)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category="1" AND name LIKE "%' . $key . '%"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }


    public function search_name_all($key)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0" AND name LIKE "%' . $key . '%"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }
    public function search_name_tourism($key)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0" AND name LIKE "%' . $key . '%"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }

    public function detail($id)
    {

        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id = "' . $id . '"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
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
            'data' => $this->Model->getData($id), //find on data
            'geometry' => $hasil,
            'log' => $log,
            'data_facility' => $this->Model->getDataFacility($id)

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/read_detail_tourism', $data);
    }

    public function detail_package($id_package)
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


        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        $data = [
            'AttributePage' => $this->PageData,
            'content' => 'Package',
            'data' => $this->Model->getData(),
            'pager' => $this->Model->pager,
            'package_day' => $hasil,
            'service_package' => $hasil1,
            'detail_package' => $hasil2,
            'detail_service_package' => $hasil3,
            'log' => $log
        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/detail_package', $data);
    }

    public function detail_type($id, $type)
    {
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

        if ($type == "WORSHIP") {
            $db = \Config\Database::connect();
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id,address, area_size, building_size, last_renovation, capacity FROM worship_place WHERE id = "' . $id . '"');
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
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                    )
                );
                array_push($hasil['features'], $features);
            }
            $data = [
                'AttributePage' => $this->PageData,
                'type' => $type,
                'content' => 'Read',
                'data' => $this->Model->getWorshipId($id), //find on data
                'geometry' => $hasil,
                'log' => $log
            ];

            // var_dump($data);


        } else if ($type == "SOUVENIR") {

            $db = \Config\Database::connect();
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, address, contact_person, capacity, open, close, employee, owner FROM souvenir_place WHERE id = "' . $id . '"');
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
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                    )
                );
                array_push($hasil['features'], $features);
            }
            $data = [
                'AttributePage' => $this->PageData,
                'content' => 'Read',
                'type' => $type,
                'data' => $this->Model->getSouvenirId($id), //find on data
                'geometry' => $hasil,
                'log' => $log
            ];
        } else if ($type == "EVENT") {
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
                'type' => $type,
                'data' => $this->Model->getEventId($id), //find on data
                'geometry' => $hasil,
                'log' => $log
            ];
        } else if ($type == "CULINARY") {
            $db = \Config\Database::connect();
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom, St_X(ST_Centroid(geom)) as x, St_Y(ST_Centroid(geom)) as y,name,id, address, contact_person, capacity, open, close, employee, owner FROM culinary WHERE id = "' . $id . '"');
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
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                    )
                );
                array_push($hasil['features'], $features);
            }
            $data = [
                'AttributePage' => $this->PageData,
                'content' => 'Read',
                'type' => $type,
                'data' => $this->Model->getCulinaryId($id), //find on data
                'geometry' => $hasil,
                'log' => $log
            ];
        } else if ($type == "HOMESTAY") {
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
                'type' => $type,
                'data' => $this->Model->getHomestayId($id), //find on data
                'geometry' => $hasil,
                'log' => $log
            ];
        } else {
            $data = [

                'type' => "NULL",
                'log' => $log

            ];
            return view('web/read_detail_type', $data);
        }

        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/read_detail_type', $data);
    }

    public function search_name_only($key)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category="1" AND name LIKE "%' . $key . '%"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

        foreach ($query->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',

                'properties' => array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'address' => $row['address'],
                    'open' => $row['open'],
                    'close' => $row['close'],
                    'ticket_price' => $row['ticket_price'],
                    'contact_person' => $row['contact_person'],

                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }

    public function search_name_only_all($key)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0" AND name LIKE "%' . $key . '%"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        foreach ($query->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',

                'properties' => array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'address' => $row['address'],
                    'open' => $row['open'],
                    'close' => $row['close'],
                    'ticket_price' => $row['ticket_price'],
                    'contact_person' => $row['contact_person'],

                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }
    public function search_name_only_tourism($key)
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0" AND name LIKE "%' . $key . '%"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        foreach ($query->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',

                'properties' => array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'address' => $row['address'],
                    'open' => $row['open'],
                    'close' => $row['close'],
                    'ticket_price' => $row['ticket_price'],
                    'contact_person' => $row['contact_person'],

                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        echo json_encode($hasil);
    }

    public function search()
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category="1"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataTourismAgro(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'facility' => $this->Model->getFacility(),
            'worship' => $this->Model->getWorship(),
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/search_agro', $data);
    }

    public function select_facility($text, $gps, $radius)
    {
        if ($text == "|on") {
            $text = "|on|";
        }
        $text = explode("|", $text);
        $dataGPS = explode("A", $gps);

        $generate_query_facility = "";
        $generate_query_category = "";
        $generate_query_worship = "";
        $generate_query_souvenir = "";
        $generate_query_event = "";
        $generate_query_culinary = "";
        $generate_query_homestay = "";
        $count = count($text);
        $j = 0;
        while ($j < $count) {
            if (str_contains($text[$j], "F-")) {
                $generate_query_facility = $generate_query_facility . "id_facility='" . $text[$j] . "' OR ";
            } else {
                if ($text[$j] == "O-worship") {
                    $generate_query_worship =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,area_size,id_category, building_size,capacity,last_renovation FROM worship_place WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-souvenir") {
                    $generate_query_souvenir =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close, employee FROM souvenir_place WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-event") {
                    $generate_query_event =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,id_category,date_start,date_end,ticket_price, description,contact_person FROM event WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-culinary") {
                    $generate_query_culinary =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close, employee FROM culinary WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-homestay") {

                    $generate_query_homestay =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close FROM homestay WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                }
            }
            $j++;
        }

        $query_worship = $generate_query_worship;
        $query_souvenir = $generate_query_souvenir;
        $query_event = $generate_query_event;
        $query_culinary = $generate_query_culinary;
        $query_homestay = $generate_query_homestay;



        $generate_query = str_replace("id_facility='' OR id_facility='on'", "", $generate_query_facility);
        $generate_query = substr($generate_query, 0, -3);
        $generate_query = substr($generate_query, 3);
        $generate_query = str_replace("F-", "", $generate_query);

        $hasil_culinary = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $hasil_homestay = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_worship = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $hasil_souvenir = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_event = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $db = \Config\Database::connect();
        if ($generate_query_facility != "") {
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE  (' . 'id_' . $generate_query . ')');


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
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil['features'], $features);
            }
        }


        if ($query_worship != "") {
            $query   = $db->query($query_worship);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_worship['features'], $features);
            }
        }

        if ($query_souvenir != "") {
            $query   = $db->query($query_souvenir);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_souvenir['features'], $features);
            }
        }

        if ($query_event != "") {
            $query   = $db->query($query_event);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'date_start' => $row['date_start'],
                        'date_end' => $row['date_end'],
                        'description' => $row['description'],
                        'ticket_price' => $row['ticket_price'],
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_event['features'], $features);
            }
        }

        if ($query_culinary != "") {
            $query   = $db->query($query_culinary);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_culinary['features'], $features);
            }
        }

        if ($query_homestay != "") {
            $query   = $db->query($query_homestay);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_homestay['features'], $features);
            }
        }




        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }


        // 


        $data = [


            'culinary' => $hasil_culinary,
            'event' => $hasil_event,
            'souvenir' => $hasil_souvenir,
            'facility' => $hasil,
            'worship' => $hasil_worship,
            'homestay' => $hasil_homestay,
            'log' => $log










        ];


        // $data = [


        //     'list' => [
        //         'culinary' => $query_culinary,
        //         'event' => $query_event,
        //         'souvenir' => $query_souvenir,
        //         'facility' => $generate_query_facility,
        //         'worship' => $query_worship,





        //     ],



        // ];

        echo json_encode($data);

        // echo "Test saja";
        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE (id_category=2) AND (' . 'id_' . $generate_query . ')';

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        // $rowFound = $query->getNumRows();
        // if ($rowFound == 0) {
        //     echo "no";
        // } else {

        //     echo json_encode($hasil);
        // }
        // echo $generate_query_worship;

        // echo $generate_query;
        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE id_category=1 AND ' . $generate_query . '';
    }
    public function select_facility_all($text, $gps, $radius)
    {
        if ($text == "|on") {
            $text = "|on|";
        }
        $text = explode("|", $text);
        $dataGPS = explode("A", $gps);

        $generate_query_facility = "";
        $generate_query_category = "";
        $generate_query_worship = "";
        $generate_query_souvenir = "";
        $generate_query_event = "";
        $generate_query_culinary = "";
        $generate_query_homestay = "";
        $count = count($text);
        $j = 0;
        while ($j < $count) {
            if (str_contains($text[$j], "F-")) {
                $generate_query_facility = $generate_query_facility . "id_facility='" . $text[$j] . "' OR ";
            } else {
                if ($text[$j] == "O-worship") {
                    $generate_query_worship =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,area_size,id_category, building_size,capacity,last_renovation FROM worship_place WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-souvenir") {
                    $generate_query_souvenir =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close, employee FROM souvenir_place WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-event") {
                    $generate_query_event =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,id_category,date_start,date_end,ticket_price, description,contact_person FROM event WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-culinary") {
                    $generate_query_culinary =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close, employee FROM culinary WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-homestay") {

                    $generate_query_homestay =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close FROM homestay WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                }
            }
            $j++;
        }

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        $query_worship = $generate_query_worship;
        $query_souvenir = $generate_query_souvenir;
        $query_event = $generate_query_event;
        $query_culinary = $generate_query_culinary;
        $query_homestay = $generate_query_homestay;

        $generate_query = str_replace("id_facility='' OR id_facility='on'", "", $generate_query_facility);
        $generate_query = substr($generate_query, 0, -3);
        $generate_query = substr($generate_query, 3);
        $generate_query = str_replace("F-", "", $generate_query);

        $hasil_culinary = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_homestay = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_worship = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $hasil_souvenir = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_event = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $db = \Config\Database::connect();
        if ($generate_query_facility != "") {
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE (id_category!="0") AND (' . 'id_' . $generate_query . ')');


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
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil['features'], $features);
            }
        }


        if ($query_worship != "") {
            $query   = $db->query($query_worship);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_worship['features'], $features);
            }
        }

        if ($query_souvenir != "") {
            $query   = $db->query($query_souvenir);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_souvenir['features'], $features);
            }
        }

        if ($query_event != "") {
            $query   = $db->query($query_event);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'date_start' => $row['date_start'],
                        'date_end' => $row['date_end'],
                        'description' => $row['description'],
                        'ticket_price' => $row['ticket_price'],
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_event['features'], $features);
            }
        }

        if ($query_culinary != "") {
            $query   = $db->query($query_culinary);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_culinary['features'], $features);
            }
        }
        if ($query_homestay != "") {
            $query   = $db->query($query_homestay);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_homestay['features'], $features);
            }
        }






        // 


        $data = [


            'culinary' => $hasil_culinary,
            'event' => $hasil_event,
            'souvenir' => $hasil_souvenir,
            'facility' => $hasil,
            'worship' => $hasil_worship,
            'homestay' => $hasil_homestay,
            'log' => $log









        ];


        // $data = [


        //     'list' => [
        //         'culinary' => $query_culinary,
        //         'event' => $query_event,
        //         'souvenir' => $query_souvenir,
        //         'facility' => $generate_query_facility,
        //         'worship' => $query_worship,





        //     ],



        // ];

        echo json_encode($data);
        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE (id_category=2) AND (' . 'id_' . $generate_query . ')';

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        // $rowFound = $query->getNumRows();
        // if ($rowFound == 0) {
        //     echo "no";
        // } else {

        //     echo json_encode($hasil);
        // }
        // echo $generate_query_worship;

        // echo $generate_query;
        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE id_category=1 AND ' . $generate_query . '';
    }


    public function select_facility_agro($text, $gps, $radius)
    {
        if ($text == "|on") {
            $text = "|on|";
        }
        $text = explode("|", $text);
        $dataGPS = explode("A", $gps);

        $generate_query_facility = "";
        $generate_query_category = "";
        $generate_query_worship = "";
        $generate_query_souvenir = "";
        $generate_query_event = "";
        $generate_query_culinary = "";
        $generate_query_homestay = "";

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        $count = count($text);
        $j = 0;
        while ($j < $count) {
            if (str_contains($text[$j], "F-")) {
                $generate_query_facility = $generate_query_facility . "id_facility='" . $text[$j] . "' OR ";
            } else {
                if ($text[$j] == "O-worship") {
                    $generate_query_worship =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,area_size,id_category, building_size,capacity,last_renovation FROM worship_place WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-souvenir") {
                    $generate_query_souvenir =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close, employee FROM souvenir_place WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-event") {
                    $generate_query_event =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,id_category,date_start,date_end,ticket_price, description,contact_person FROM event WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-culinary") {
                    $generate_query_culinary =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close, employee FROM culinary WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                } else if ($text[$j] == "O-homestay") {
                    $generate_query_homestay =  'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,capacity, contact_person, owner, open, close FROM homestay WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' ';
                }
            }
            $j++;
        }

        $query_worship = $generate_query_worship;
        $query_souvenir = $generate_query_souvenir;
        $query_event = $generate_query_event;
        $query_culinary = $generate_query_culinary;
        $query_homestay = $generate_query_homestay;

        $generate_query = str_replace("id_facility='' OR id_facility='on'", "", $generate_query_facility);
        $generate_query = substr($generate_query, 0, -3);
        $generate_query = substr($generate_query, 3);
        $generate_query = str_replace("F-", "", $generate_query);

        $hasil_culinary = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_homestay = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_worship = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $hasil_souvenir = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        $hasil_event = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        $db = \Config\Database::connect();
        if ($generate_query_facility != "") {
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE (' . 'id_' . $generate_query . ')');


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
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil['features'], $features);
            }
        }


        if ($query_worship != "") {
            $query   = $db->query($query_worship);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_worship['features'], $features);
            }
        }

        if ($query_souvenir != "") {
            $query   = $db->query($query_souvenir);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_souvenir['features'], $features);
            }
        }

        if ($query_event != "") {
            $query   = $db->query($query_event);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'date_start' => $row['date_start'],
                        'date_end' => $row['date_end'],
                        'description' => $row['description'],
                        'ticket_price' => $row['ticket_price'],
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_event['features'], $features);
            }
        }

        if ($query_culinary != "") {
            $query   = $db->query($query_culinary);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_culinary['features'], $features);
            }
        }

        if ($query_homestay != "") {
            $query   = $db->query($query_homestay);


            foreach ($query->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'contact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'owner' => $row['owner'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_homestay['features'], $features);
            }
        }






        // 


        $data = [


            'culinary' => $hasil_culinary,
            'event' => $hasil_event,
            'souvenir' => $hasil_souvenir,
            'facility' => $hasil,
            'worship' => $hasil_worship,
            'homestay' => $hasil_homestay,
            'log' => $log









        ];


        // $data = [


        //     'list' => [
        //         'culinary' => $query_culinary,
        //         'event' => $query_event,
        //         'souvenir' => $query_souvenir,
        //         'facility' => $generate_query_facility,
        //         'worship' => $query_worship,





        //     ],



        // ];

        echo json_encode($data);
        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE (id_category=2) AND (' . 'id_' . $generate_query . ')';

        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category=1 AND name LIKE "%' . $key . '%"';

        // return view('web/list_agro', $data);

        // $rowFound = $query->getNumRows();
        // if ($rowFound == 0) {
        //     echo "no";
        // } else {

        //     echo json_encode($hasil);
        // }
        // echo $generate_query_worship;

        // echo $generate_query;
        // echo 'SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE id_category=1 AND ' . $generate_query . '';
    }

    public function search_all($id)
    {

        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        if ($id != "seacrh_all" && strpos($id, "NAME_") !== false) {
            $id = str_replace('NAME_', "", $id);
            $db = \Config\Database::connect();
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE name LIKE "%' . $id . '%"');
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
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil['features'], $features);
            }

            // 
            $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
            $geom_village = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_village->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom_village']),
                    'properties' => array()
                );
                array_push($geom_village['features'], $features);
            }

            // Worship Geom
            $query_w   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, area_size, building_size, capacity, last_renovation FROM worship_place ');
            $hasil_w = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_w->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_w['features'], $features);
            }

            // Souvenir All

            $query_s   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, capacity,contact_person,owner,employee,open,close FROM souvenir_place ');
            $hasil_s = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_s->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'capacity' => $row['capacity'],
                        'contact_person' => $row['contact_person'],
                        'owner' => $row['owner'],
                        'employee' => $row['employee'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'open' => $row['open'],
                        'close' => $row['close'],

                    )
                );
                array_push($hasil_s['features'], $features);
            }

            // Event

            $query_e   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,date_start,date_end,description,ticket_price,contact_person FROM event ');
            $hasil_e = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_e->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'date_start' => $row['date_start'],
                        'date_end' => $row['date_end'],
                        'description' => $row['description'],
                        'ticket_price' => $row['ticket_price'],
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y'],


                    )
                );
                array_push($hasil_e['features'], $features);
            }

            // Culinary All
            $query_c   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,contact_person,capacity,open,close,employee,owner FROM culinary ');
            $hasil_c = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_c->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'cotact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],


                    )
                );
                array_push($hasil_c['features'], $features);
            }

            // Homestay
            $query_h   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,contact_person,capacity,open,close,price,owner FROM homestay ');
            $hasil_h = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_h->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'cotact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'price' => $row['price'],
                        'owner' => $row['owner'],


                    )
                );
                array_push($hasil_h['features'], $features);
            }


            $data = [

                'data' => $this->Model->getDataTourismAll(), //find on data
                'geometry' => $hasil,
                'village' => $geom_village,
                'facility' => $this->Model->getFacility(),
                'worship' => $this->Model->getWorship(),
                'search' => $id,
                'log' => $log,
                'worship_geom' => $hasil_w,
                'souvenir_geom' => $hasil_s,
                'event_geom' => $hasil_e,
                'culinary_geom' => $hasil_c,
                'homestay_geom' => $hasil_h,
                'special' => 'yes'

            ];
            if (isset($_SESSION['redirect_urlX'])) {
                $id_user = $_SESSION['redirect_urlX'];
                $db = \Config\Database::connect();
                $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
                $query = $query->getFirstRow();
                if ($query->group_id == 1) {

                    return redirect()->to(site_url());
                } else {
                }
            } else {
                $id_user = NULL;
            }
            return view('web/search_all', $data);
        } else if ($id == "search_all") {
            $db = \Config\Database::connect();
            $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object ');
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
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil['features'], $features);
            }

            // 
            $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
            $geom_village = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_village->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom_village']),
                    'properties' => array()
                );
                array_push($geom_village['features'], $features);
            }

            // Worship Geom
            $query_w   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, area_size, building_size, capacity, last_renovation FROM worship_place ');
            $hasil_w = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_w->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_w['features'], $features);
            }

            // Souvenir All

            $query_s   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, capacity,contact_person,owner,employee,open,close FROM souvenir_place ');
            $hasil_s = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_s->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'capacity' => $row['capacity'],
                        'contact_person' => $row['contact_person'],
                        'owner' => $row['owner'],
                        'employee' => $row['employee'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'open' => $row['open'],
                        'close' => $row['close'],

                    )
                );
                array_push($hasil_s['features'], $features);
            }

            // Event

            $query_e   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,date_start,date_end,description,ticket_price,contact_person FROM event ');
            $hasil_e = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_e->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'date_start' => $row['date_start'],
                        'date_end' => $row['date_end'],
                        'description' => $row['description'],
                        'ticket_price' => $row['ticket_price'],
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y'],


                    )
                );
                array_push($hasil_e['features'], $features);
            }

            // Culinary All
            $query_c   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,contact_person,capacity,open,close,employee,owner FROM culinary ');
            $hasil_c = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_c->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'cotact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],


                    )
                );
                array_push($hasil_c['features'], $features);
            }

            // Homestay
            $query_h   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,contact_person,capacity,open,close,price,owner FROM homestay ');
            $hasil_h = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_h->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'cotact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'price' => $row['price'],
                        'owner' => $row['owner'],


                    )
                );
                array_push($hasil_h['features'], $features);
            }

            $data = [

                'data' => $this->Model->getDataTourismAll(), //find on data
                'geometry' => $hasil,
                'village' => $geom_village,
                'facility' => $this->Model->getFacility(),
                'worship' => $this->Model->getWorship(),
                'worship_geom' => $hasil_w,
                'souvenir_geom' => $hasil_s,
                'event_geom' => $hasil_e,
                'culinary_geom' => $hasil_c,
                'homestay_geom' => $hasil_h,
                'log' => $log,
                'special' => 'yes'

            ];
            if (isset($_SESSION['redirect_urlX'])) {
                $id_user = $_SESSION['redirect_urlX'];
                $db = \Config\Database::connect();
                $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
                $query = $query->getFirstRow();
                if ($query->group_id == 1) {

                    return redirect()->to(site_url());
                } else {
                }
            } else {
                $id_user = NULL;
            }

            // var_dump($data);
            return view('web/search_all', $data);
        } else if ($id != "seacrh_all" && strpos($id, "CHECK_") !== false) {
            $idx = $id;
            // Disini search by facility
            $id = str_replace('CHECK_', "", $id);
            $id = explode("|", $id);
            $length = count($id);
            $i = 0;
            $generate_query_facility = "";

            while ($i < $length) {
                $generate_query_facility = $generate_query_facility . "id_facility='" . $id[$i] . "' OR ";
                $i++;
            }
            $generate_query_facility = str_replace("OR id_facility='' OR ", "", $generate_query_facility);

            $hasil = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            $db = \Config\Database::connect();
            if ($generate_query_facility != "") {
                $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,tourism_object.name as name,id,address, open, close, ticket_price, contact_person FROM tourism_object LEFT JOIN tourism_facility ON tourism_object.id_category=tourism_facility.id_facility WHERE (' . '' . $generate_query_facility . ')');


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
                            'contact_person' => $row['contact_person'],
                            'x' => $row['x'],
                            'y' => $row['y']
                        )
                    );
                    array_push($hasil['features'], $features);
                }
            }

            // echo $generate_query_facility;


            $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
            $geom_village = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_village->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom_village']),
                    'properties' => array()
                );
                array_push($geom_village['features'], $features);
            }

            // Worship Geom
            $query_w   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, area_size, building_size, capacity, last_renovation FROM worship_place ');
            $hasil_w = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_w->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'area_size' => $row['area_size'],
                        'building_size' => $row['building_size'],
                        'capacity' => $row['capacity'],
                        'last_renovation' => $row['last_renovation'],
                        'x' => $row['x'],
                        'y' => $row['y']
                    )
                );
                array_push($hasil_w['features'], $features);
            }

            // Souvenir All

            $query_s   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, capacity,contact_person,owner,employee,open,close FROM souvenir_place ');
            $hasil_s = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_s->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'capacity' => $row['capacity'],
                        'contact_person' => $row['contact_person'],
                        'owner' => $row['owner'],
                        'employee' => $row['employee'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'open' => $row['open'],
                        'close' => $row['close'],

                    )
                );
                array_push($hasil_s['features'], $features);
            }

            // Event

            $query_e   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,date_start,date_end,description,ticket_price,contact_person FROM event ');
            $hasil_e = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_e->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'date_start' => $row['date_start'],
                        'date_end' => $row['date_end'],
                        'description' => $row['description'],
                        'ticket_price' => $row['ticket_price'],
                        'contact_person' => $row['contact_person'],
                        'x' => $row['x'],
                        'y' => $row['y'],


                    )
                );
                array_push($hasil_e['features'], $features);
            }

            // Culinary All
            $query_c   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,contact_person,capacity,open,close,employee,owner FROM culinary ');
            $hasil_c = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_c->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'cotact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'employee' => $row['employee'],
                        'owner' => $row['owner'],


                    )
                );
                array_push($hasil_c['features'], $features);
            }

            // Homestay
            $query_h   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address,contact_person,capacity,open,close,price,owner FROM homestay ');
            $hasil_h = array(
                'type'    => 'FeatureCollection',
                'features' => array()
            );

            foreach ($query_h->getResultArray() as $row) {
                $features = array(
                    'type' => 'Feature',
                    'geometry' => json_decode($row['geom']),
                    'properties' => array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'address' => $row['address'],
                        'cotact_person' => $row['contact_person'],
                        'capacity' => $row['capacity'],
                        'open' => $row['open'],
                        'close' => $row['close'],
                        'x' => $row['x'],
                        'y' => $row['y'],
                        'price' => $row['price'],
                        'owner' => $row['owner'],


                    )
                );
                array_push($hasil_h['features'], $features);
            }

            $data = [

                'data' => $this->Model->getDataTourismAll(), //find on data
                'geometry' => $hasil,
                'village' => $geom_village,
                'facility' => $this->Model->getFacility(),
                'worship' => $this->Model->getWorship(),
                'search' => $idx,
                'log' => $log,
                'worship_geom' => $hasil_w,
                'souvenir_geom' => $hasil_s,
                'event_geom' => $hasil_e,
                'culinary_geom' => $hasil_c,
                'homestay_geom' => $hasil_h,
                'special' => 'yes'


            ];
            if (isset($_SESSION['redirect_urlX'])) {
                $id_user = $_SESSION['redirect_urlX'];
                $db = \Config\Database::connect();
                $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
                $query = $query->getFirstRow();
                if ($query->group_id == 1) {

                    return redirect()->to(site_url());
                } else {
                }
            } else {
                $id_user = NULL;
            }
            return view('web/search_all', $data);
        }
    }

    public function search_tourism()
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataTourism(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'facility' => $this->Model->getFacility(),
            'worship' => $this->Model->getWorship(),
            'log' => $log


        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/search_tourism', $data);
    }

    public function list_agro()
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category="1"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataData(), //find on data
            'data_facility' => $this->Model->getDataFacility(),
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }

        // var_dump($this->Model->getData());
        return view('web/list_agro', $data);

        // var_dump($data);
    }

    public function list_tourism()
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getDataTourismAll(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/list_tourism', $data);
    }

    public function radius_tourism()
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category!="0"');
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }

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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/radius_tourism', $data);
    }

    public function radius()
    {
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE id_category="1"');
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }
        if ($this->auth->check()) {

            $log = "login";
        } else {
            $log = "logout";
        }
        // 
        $query_village   = $db->query('SELECT ST_AsGeoJSON(geom) as geom_village FROM village');
        $geom_village = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query_village->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom_village']),
                'properties' => array()
            );
            array_push($geom_village['features'], $features);
        }

        $data = [

            'data' => $this->Model->getData(), //find on data
            'geometry' => $hasil,
            'village' => $geom_village,
            'log' => $log

        ];
        if (isset($_SESSION['redirect_urlX'])) {
            $id_user = $_SESSION['redirect_urlX'];
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM `auth_groups_users` WHERE user_id='" . $id_user . "' ");
            $query = $query->getFirstRow();
            if ($query->group_id == 1) {

                return redirect()->to(site_url());
            } else {
            }
        } else {
            $id_user = NULL;
        }
        return view('web/radius_agro', $data);
    }

    public function radius_data_tourism($radius, $gps)
    {
        // echo $radius . $gps;
        $dataGPS = explode("A", $gps);
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . '');
        // echo 'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",100.656219," ", -0.7860799,")")) ) <=' . $radius . '';
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        echo json_encode($hasil);
    }

    public function radius_data($radius, $gps)
    {
        // echo $radius . $gps;
        $dataGPS = explode("A", $gps);
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) <=' . $radius . ' AND id_category="1"');
        // echo 'SELECT ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",' . $dataGPS[1] . '," ", ' . $dataGPS[0] . ',")")) ) as distance, ST_AsGeoJSON(geom) as geom,ST_X(ST_centroid(geom)) as x,ST_Y(ST_centroid(geom)) as y,name,id,address, open, close, ticket_price, contact_person FROM tourism_object WHERE ST_Distance_Sphere(ST_GeomFromText(CONCAT("POINT(",ST_X(ST_Centroid(geom))," ", ST_Y(ST_Centroid(geom)),")")) , ST_GeomFromText(CONCAT("POINT(",100.656219," ", -0.7860799,")")) ) <=' . $radius . '';
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
                    'contact_person' => $row['contact_person'],
                    'x' => $row['x'],
                    'y' => $row['y']
                )
            );
            array_push($hasil['features'], $features);
        }

        echo json_encode($hasil);
    }
}
