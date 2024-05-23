<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use App\Controllers\BaseController;
use App\Models\AdminModel;

class LoginController extends BaseController
{

    private $field;
    private $jobs;
    private $harvest;
    private $user;
    private $planting;
    private $worker;
    private $profiles;
    private $users;
    private $variety;
    private $admin;
    private $trivia;
    private $reports;
    private $training;
    private $disease;
    private $pest;

    public function __construct()
    {
        $this->field = new \App\Models\VIewFieldsModel();
        $this->harvest = new \App\Models\HarvestModel();
        $this->user = new \App\Models\RegisterModel();
        $this->planting = new \App\Models\PlantingModel();
        $this->worker = new \App\Models\WorkerModel();
        $this->variety = new \App\Models\VarietyModel();
        $this->users = new \App\Models\RegisterModel();
        $this->profiles = new \App\Models\FarmerProfilesModel();
        $this->admin = new \App\Models\AdminModel();
        $this->trivia = new \App\Models\TriviasModel();
        $this->reports = new \App\Models\ReportsModel();
        $this->training = new \App\Models\TrainingsModel();
        $this->disease = new \App\Models\DiseasesModel();
        $this->pest = new \App\Models\PestModel();
    }

    public function index()
    {
        return view('index');
    }

    public function register()
    {

        helper(['form']);

        $rules = [
            'leader_name' => 'required|min_length[1]|max_length[100]',
            'idnumber' => 'required|min_length[1]|max_length[100]|is_unique[users.idnumber]',
            'barangay' => 'required|min_length[1]|max_length[100]',
            'position' => 'required|min_length[1]|max_length[100]',
            'password' => 'required|min_length[8]|max_length[100]',
            'repeat_password' => 'matches[password]'

        ];

        if ($this->validate($rules)) {
            $registermodel = new RegisterModel();

            $data = [
                'leader_name' => $this->request->getVar('leader_name'),
                'idnumber' => $this->request->getVar('idnumber'),
                'barangay' => $this->request->getVar('barangay'),
                'position' => $this->request->getVar('position'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            dd($registermodel);

            dd($registermodel->save($data));

            return redirect()->to('/sign_ins');
        } else {
            $data['validation'] = $this->validator;
            return view('signin-signup/register', $data);
        }
    }
    public function loginauth()
    {
        $session = session();
        $registermodel = new RegisterModel();
        $leader_name = $this->request->getVar('leader_name');
        $password = $this->request->getVar('password');

        $data = $registermodel->where('leader_name', $leader_name)->first();

        if ($data) {
            // Check if the account is restricted
            if ($data['accountstatus'] === 'restricted') {
                $session->setFlashdata('msg', 'This account is restricted.');
                return redirect()->to('/sign_ins');
            }

            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);

            if ($authenticatePassword) {
                $ses_data = [
                    'leader_id' => $data['leader_id'],
                    'leader_name' => $data['leader_name'],
                    'isLoggedIn' => TRUE,
                    'usertype' => $data['usertype'],
                ];

                $session->set($ses_data);

                if ($data['usertype'] === 'Admin') {
                    return redirect()->to('/admindashboard');
                } else if ($data['usertype'] === 'Farmer') {
                    return redirect()->to('/dashboards');
                }
            } else {
                $session->setFlashdata('msg', 'Name or Password is incorrect.');
                return redirect()->to('/sign_ins');
            }
        } else {
            $session->setFlashdata('msg', 'Name or Password is incorrect.');
            return redirect()->to('/sign_ins');
        }
    }

    public function login()
    {
        session()->remove(['leader_id', 'leadername', 'idnumber', 'isLoggedIn', 'usertype']);
        helper(['form']);
        return view('signin-signup/login');
    }
    public function registerview()
    {
        helper(['form']);
        $data = [];
        return view('signin-signup/register', $data);
    }
    public function admindashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        } else {
            // Fetch total harvest quantity
            $resultQuantity = $this->harvest
                ->selectSum('harvest_quantity', 'totalHarvestQuantity')
                ->get();
            $totalHarvestQuantity = $resultQuantity->getRow()->totalHarvestQuantity;

            // Fetch total revenue for the current year
            $currentYear = date('Y');
            $resultRevenue = $this->harvest
                ->selectSum('total_revenue', 'totalRevenueThisYear')
                ->where('YEAR(harvest_date)', $currentYear)
                ->get();
            $totalRevenueThisYear = $resultRevenue->getRow()->totalRevenueThisYear;

            /// Fetch monthly harvest quantity data
            $monthlyHarvest = $this->harvest
                ->select('YEAR(harvest_date) as year, MONTH(harvest_date) as month, SUM(harvest_quantity) as totalHarvestQuantity')
                ->groupBy('YEAR(harvest_date), MONTH(harvest_date)')
                ->findAll();

            // Extracting labels and data for the chart
            $monthlyLabels = array_map(function ($item) {
                return date('F Y', strtotime($item['year'] . '-' . $item['month'] . '-01'));
            }, $monthlyHarvest);

            $monthlyHarvestData = array_column($monthlyHarvest, 'totalHarvestQuantity');


            // Fetch total land area of the barangay
            $totalLandArea = $this->field
                ->selectSum('field_total_area', 'totalLandArea')
                ->get()
                ->getRow()
                ->totalLandArea;

            // Fetch total number of farmers
            $totalNoofFarmers = $this->profiles
                ->countAllResults();

            $data = [
                'totalHarvestQuantity' => $totalHarvestQuantity,
                'totalRevenueThisYear' => $totalRevenueThisYear,
                'monthlyLabels' => $monthlyLabels,
                'monthlyHarvestData' => $monthlyHarvestData,
                'totalLandArea' => $totalLandArea,
                'totalNoofFarmers' => $totalNoofFarmers,
            ];

            return view('adminfolder/dashboard', $data);
        }
    }


    // admin

    public function adminloginauth()
    {
        $session = session();
        $adminmodel = new AdminModel();
        $fullname = $this->request->getVar('fullname');
        $password = $this->request->getVar('password');

        $data = $adminmodel->where('fullname', $fullname)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);

            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'fullname' => $data['fullname'],
                    'isLoggedIn' => true,
                ];

                $session->set($ses_data);
                log_message('info', 'User logged in successfully: ' . $fullname);

                return redirect()->to('/admindashboard');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                log_message('error', 'Failed login attempt for user: ' . $fullname);
                return redirect()->to('/signinadmin');
            }
        } else {
            $session->setFlashdata('msg', 'User does not exist.');
            log_message('error', 'Failed login attempt for non-existent user: ' . $fullname);
            return redirect()->to('/signinadmin');
        }
    }

    public function registeradmin()
    {
        helper(['form']);
        $data = [];
        return view('signin-signup/adminregister', $data);
    }

    public function sendMail($to, $subject, $message)
    {
        $email = \Config\Services::email();
        $email->setMailType("html");
        $email->setTo($to);
        $email->setFrom('marymaetolentino03@gmail.com', $subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo 'email sent successfully';
        } else {
            $data = $email->printDebugger(['headers']);
            print($data);
        }
    }
    public function token($length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length);
    }
    public function signups()
    {
        helper('form');
        $rules = [
            'fullname' => 'required|min_length[1]|max_length[100]',
            'idnumber' => 'required|min_length[1]|max_length[100]',
            'email' => 'required|min_length[1]|max_length[100]|is_unique[admin.email]',
            'password' => 'required|min_length[8]|max_length[100]',
            'repeat_password' => 'matches[password]',
            'usertype' => 'required|min_length[1]|max_length[100]',

        ];

        if ($this->validate($rules)) {
            $adminmodel = new AdminModel();
            $token = $this->token(100);
            $to = $this->request->getVar('email');

            $data = [
                'fullname' => $this->request->getVar('fullname'),
                'idnumber' => $this->request->getVar('idnumber'),
                'email' => $to,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'usertype' => $this->request->getVar('usertype'),
                'token' => $token,
                'status' => 'inactive'
            ];

            $adminmodel->save($data);

            $subject = 'Please confirm your registration';
            $message = '
                        <html>
                        <head>
                            <style>
                                .card {
                                    background-color: #eff1f7;
                                    border-radius: 10px;
                                    padding: 10px;
                                    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
                                    max-width: 800px;
                                    margin: auto;
                                    text-align: center;
                                }
                                .button {
                                    background: black;
                                    border: none;
                                    color: white;
                                    padding: 10px 20px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 14px;
                                    margin-top: 10px;
                                    cursor: pointer;
                                    border-radius: 5px;
                                }
                                .button:hover {
                                    background-color: #f28123;
                                }
                            </style>
                        </head>
                        <body>
                            
                            <div class="card">
                                <p>Hi, ' . $this->request->getVar('fullname') . '! Welcome to our website!</p>
                                <p>To continue with your registration, please confirm your account by clicking this <br><a href="' . base_url('verify/' . $token) . '" class="button">link</a>.</p>
                            </div>
                        </body>
                        </html>';
            $this->sendMail($to, $subject, $message);

            return redirect()->to('signinadmin');
        } else {
            $data['validation'] = $this->validator;
            return view('signin-signup/adminregister', $data);
        }
    }
    public function verify($id = null)
    {
        $ac = new AdminModel();
        $acc = $ac->where('token', $id)->first();

        if ($acc) {
            $data = [
                'token' => $this->token(100),
                'status' => 'active'
            ];

            $ac->set($data)->where('token', $id)->update();
            $session = session();
            $session->setFlashdata('msg', 'Account was verified');
        }

        return redirect()->to('signinadmin');
    }
    public function loginadmin()
    {
        session()->remove(['id', 'fullname', 'isLoggedIn']);
        helper(['form']);
        return view('signin-signup/adminlogin');
    }

    // see your stats
    public function farmerstats()
    {

        $profiles = [];
        $fields = [];
        $planting = [];
        $harvestData = [];
        $monthlyLabels = [];
        $monthlyHarvestData = [];

        $data = [
            'profiles' => $profiles,
            'field' => $fields,
            'planting' => $planting,
            'harvest' => $harvestData,
            'monthlyLabels' => $monthlyLabels,
            'monthlyHarvestData' => $monthlyHarvestData,
        ];

        return view('statistics', $data);
    }

    public function searchFarmerProfiles()
    {
        $searchTerm = $this->request->getPost('search_term');

        $profiles = $this->profiles->where('fims_code', $searchTerm)->findAll();
        $fields = [];
        $planting = [];
        $harvestData = [];
        $monthlyLabels = [];
        $monthlyHarvestData = [];
        if (empty($profiles)) {
            $data = [
                'profiles' => $profiles,
                'field' => $fields,
                'planting' => $planting,
                'harvest' => $harvestData,
                'monthlyLabels' => $monthlyLabels,
                'monthlyHarvestData' => $monthlyHarvestData,
                'error' => 'No farmer profiles found with the provided FIMS Code.'
            ];
            return view('statistics', $data);
        }
        $fields = $this->field->where('fims_code', $searchTerm)->findAll();
        $planting = $this->planting->where('fims_code', $searchTerm)->findAll();

        $harvestData = $this->harvest->where('fims_code', $searchTerm)->findAll();

        $monthlyLabels = [];
        $monthlyHarvestData = [];

        foreach ($harvestData as $data) {
            $month = date('M', strtotime($data['harvest_date']));
            $monthlyLabels[] = $month;

            $monthlyHarvestData[] = $data['harvest_quantity'];
        }

        $data = [
            'profiles' => $profiles,
            'field' => $fields,
            'planting' => $planting,
            'harvest' => $harvestData,
            'monthlyLabels' => $monthlyLabels,
            'monthlyHarvestData' => $monthlyHarvestData,
        ];

        return view('statistics', $data);
    }

    // admin

    public function manageaccounts()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'users' => $this->users->findAll()
        ];
        return view('adminfolder/manageaccounts', $data);
    }

    // manage accounts
    public function editpassword($leader_id)
    {
        $users = $this->users->find($leader_id);

        return view('users', ['users' => $users]);
    }
    public function updatepassword()
    {
        $leader_id = $this->request->getPost('leader_id');
        $password = $this->request->getPost('password');

        if (is_array($password)) {
            $password = reset($password);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $dataToUpdate = [
            'password' => $hashedPassword,
        ];

        $this->users->update($leader_id, $dataToUpdate);

        return redirect()->to('/manageaccounts')->with('success', 'Password updated successfully');
    }
    public function restrictAccount($leader_id)
    {
        $this->users->update($leader_id, ['accountstatus' => 'restricted']);
        return redirect()->to('/manageaccounts')->with('success', 'Account restricted successfully');
    }

    public function unrestrictAccount($leader_id)
    {
        $this->users->update($leader_id, ['accountstatus' => 'unrestricted']);
        return redirect()->to('/manageaccounts')->with('success', 'Account unrestricted successfully');
    }
    public function adminaccounts()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'admin' => $this->admin->findAll()
        ];
        return view('adminfolder/adminaccounts', $data);
    }
    public function editadminpassword($id)
    {
        $admin = $this->admin->find($id);

        return view('admin', ['admin' => $admin]);
    }
    public function updateadminpassword()
    {
        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');

        if (is_array($password)) {
            $password = reset($password);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $dataToUpdate = [
            'password' => $hashedPassword,
        ];

        $this->admin->update($id, $dataToUpdate);

        return redirect()->to('/manageaccounts')->with('success', 'Password updated successfully');
    }
    public function editaccount($leader_id)
    {
        $users = $this->users->find($leader_id);

        return view('users', ['users' => $users]);
    }
    public function updateaccount()
    {

        $leader_id = $this->request->getPost('leader_id');


        $dataToUpdate = [
            'leader_name' => $this->request->getPost('leader_name'),
            'idnumber' => $this->request->getPost('idnumber'),
            'position' => $this->request->getPost('position'),
        ];

        $this->users->update($leader_id, $dataToUpdate);

        return redirect()->to('/manageaccounts')->with('success', 'Field updated successfully');
    }

    public function about()
    {
        return view('about_sec');
    }

    public function trivias()
    {
        $data = [
            'trivia' => $this->trivia->findAll()
        ];
        return view('trivias_sec', $data);
    }

    public function reports()
    {
        $data = [
            'reports' => $this->reports->findAll()
        ];
        return view('reports_sec', $data);
    }

    public function trainings()
    {
        $data = [
            'training' => $this->training->findAll()
        ];
        return view('trainings_sec', $data);
    }
    public function triviareadmore($trivia_id)
    {
        $trivia = $this->trivia->find($trivia_id);

        if (!$trivia) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Trivia not found: ' . $trivia_id);
        }

        $data = [
            'trivia' => $trivia
        ];

        return view('readmoretrivia', $data);
    }
    public function reportsreadmore($report_id)
    {
        $reports = $this->reports->find($report_id);

        if (!$reports) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('reports not found: ' . $report_id);
        }

        $data = [
            'reports' => $reports
        ];

        return view('readmorereport', $data);
    }

    public function pest()
    {
        $data = [
            'pest' => $this->pest->findAll()
        ];
        return view('pest_sec', $data);
    }

    public function disease()
    {
        $data = [
            'disease' => $this->disease->findAll()
        ];
        return view('disease_sec', $data);
    }

    public function diseasereadmore($disease_id)
    {
        $disease = $this->disease->find($disease_id);

        if (!$disease) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('disease not found: ' . $disease_id);
        }

        $data = [
            'disease' => $disease
        ];

        return view('readmoredisease', $data);
    }

    public function pestreadmore($pest_id)
    {
        $pest = $this->pest->find($pest_id);

        if (!$pest) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('pest not found: ' . $pest_id);
        }

        $data = [
            'pest' => $pest
        ];

        return view('readmorepest', $data);
    }
}
