<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;
use App\Models\VillageModel;
use CodeIgniter\API\ResponseTrait as APIResponseTrait;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use ResponseTrait;


class Home extends BaseController
{
    use APIResponseTrait;

    protected $auth;

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
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }



    public function index()
    {
        $db = db_connect();
        $content = [
            'Platform' => $db->getPlatform(),
            'Version' => $db->getVersion(),
            'Database' => $db->getDatabase(),
        ];
        $response = [
            'data' => $content,
            'status' => 200,
            'message' => [
                "Successfully Connected to Database"
            ]
        ];
        return $this->respond($response);
    }

    public function village()
    {

        // $dataVillage = new VillageModel();
        // $geom = $dataVillage->findAll();
        $db = \Config\Database::connect();
        $query   = $db->query('SELECT ST_AsGeoJSON(geom) as geom,name,id,district FROM village');
        // $results = $query->getResultArray();
        $hasil = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach ($query->getResultArray() as $row) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($row['geom']),
                'properties' => array(
                    'nama' => $row['name'],
                    'id' => $row['id'],
                    'district' => $row['district']
                )
            );
            array_push($hasil['features'], $features);
        }






        // $db = \Config\Database::connect();
        // $db = db_connect();
        // $geom = $db->query('SELECT ST_AsGeoJSON(geom) FROM `village`');
        $data = [
            'title' => 'Home',
            'geom' =>  $hasil,

        ];


        return view('web/admin', $data);
    }

    public function landingPage()
    {
        // if ($this->auth->check()) {
        //     $redirectURL = session('redirect_url') ?? site_url('/villages');
        //     unset($_SESSION['redirect_url']);

        //     return redirect()->to($redirectURL);
        // }
        if ($this->auth->check()) {
            return redirect()->route('villages');
        } else {
            return view('landing_page');
        }


        // if (isset($_SESSION)) {
        //     var_dump($_SESSION);
        // } else {

        // }
    }

    public function error403()
    {
        return view('errors/html/error_403');
    }

    // public function login()
    // {
    //     $data = [
    //         'title' => 'Login',
    //     ];
    //     return view('auth/login', $data);
    // }

    // public function register()
    // {
    //     $data = [
    //         'title' => 'Register',
    //     ];
    //     return view('auth/register', $data);
    // }

    public function web()
    {
        $data = [
            'title' => 'Home',
        ];

        return view('web/home', $data);
    }

    public function object()
    {
        $data = [
            'title' => 'Object',
        ];
        return view('web/list_object', $data);
    }

    public function objectDetail()
    {
        $data = [
            'title' => 'Detail Object',
            'data' => ['id' => 'Detail'],
        ];
        return view('web/detail_object', $data);
    }

    public function prediction()
    {
        return view('web/prediction');
    }

    public function profile()
    {
        $data = [
            'title' => 'My Profile',
        ];
        return view('profile/manage_profile', $data);
    }

    // public function update()
    // {
    //     $data = [
    //         'title' => 'Update Profile',
    //     ];
    //     return view('profile/update_profile', $data);
    // }

    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
        ];
        return view('profile/change_password', $data);
    }
}
