<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    private $field;
    private $harvest;
    private $planting;
    private $worker;
    private $variety;
    private $fertilizers;
    private $equipment;
    private $prof;
    private $users;
    private $expense;
    private $profiles;


    public function __construct()
    {
        $this->users = new \App\Models\RegisterModel();
        $this->field = new \App\Models\VIewFieldsModel();
        $this->expense = new \App\Models\ExpensesModel();
        $this->harvest = new \App\Models\HarvestModel();
        $this->planting = new \App\Models\PlantingModel();
        $this->worker = new \App\Models\WorkerModel();
        $this->variety = new \App\Models\VarietyModel();
        $this->fertilizers = new \App\Models\FertilizersModel();
        $this->equipment = new \App\Models\EquipmentModel();
        $this->prof = new \App\Models\FarmelProfileModel();
        $this->profiles = new \App\Models\FarmerProfilesModel();
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
    public function dashboards()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/logins');
        }

        $userId = session()->get('leader_id');

        // Fetch total harvest quantity
        $resultQuantity = $this->harvest
            ->selectSum('harvest_quantity', 'totalHarvestQuantity')
            ->where('user_id', $userId)
            ->get();
        $totalHarvestQuantity = $resultQuantity->getRow()->totalHarvestQuantity;

        // Fetch total revenue for the current year
        $currentYear = date('Y');
        $resultRevenue = $this->harvest
            ->selectSum('total_revenue', 'totalRevenueThisYear')
            ->where('user_id', $userId)
            ->where('YEAR(harvest_date)', $currentYear)
            ->get();
        $totalRevenueThisYear = $resultRevenue->getRow()->totalRevenueThisYear;

        // Fetch total money spent from jobs table
        $resultMoneySpent = $this->expense
            ->selectSum('total_money_spent', 'totalMoneySpent')
            ->where('user_id', $userId)
            ->get();
        $totalMoneySpent = $resultMoneySpent->getRow()->totalMoneySpent;

        /// Fetch monthly harvest quantity data
        $monthlyHarvest = $this->harvest
            ->select('YEAR(harvest_date) as year, MONTH(harvest_date) as month, SUM(harvest_quantity) as totalHarvestQuantity')
            ->where('user_id', $userId)
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
            ->where('user_id', $userId)
            ->countAllResults();

        $harvestData = $this->harvest->where('user_id', $userId)->findAll();
        $revenueData = $this->harvest->where('user_id', $userId)->findAll();

        $data = [
            'totalHarvestQuantity' => $totalHarvestQuantity,
            'totalRevenueThisYear' => $totalRevenueThisYear,
            'harvest' => $harvestData,
            'monthlyLabels' => $monthlyLabels,
            'monthlyHarvestData' => $monthlyHarvestData,
            'totalLandArea' => $totalLandArea,
            'totalNoofFarmers' => $totalNoofFarmers,
        ];

        return view('userfolder/dashboard', $data);
    }

    public function searchProfiles()
    {
        $searchTerm = $this->request->getPost('search');

        $profiles = $this->profiles->select('fullname, fims_code')
            ->like('fullname', $searchTerm)
            ->findAll();

        $responseData = [];
        foreach ($profiles as $profile) {
            // Store both fullname and fims_code in responseData array
            $responseData[] = [
                'fullname' => $profile['fullname'],
                'fims_code' => $profile['fims_code']
            ];
        }

        return $this->response->setJSON($responseData);
    }

    public function viewfields()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }
        $userId = session()->get('leader_id');
        $profile = $this->profiles->where('user_id', $userId)->findAll();
        $fie = $this->field->where('user_id', $userId)->findAll();

        $data = [
            'profiles' => $profile,
            'field' => $fie,
        ];
        return view('userfolder/viewfields', $data);
    }
    public function addnewfield()
    {
        $userId = session()->get('leader_id');

        // Validate form inputs
        $validation = $this->validate([
            'farmer_name' => 'required',
            'field_name' => 'required',
            'field_address' => 'required',
            'field_total_area' => 'required',
        ]);

        if (!$validation) {
            // If validation fails, return to the view with validation errors
            return view('userfolder/viewfields', ['validation' => $this->validator]);
        }

        // Fetch the fims_code corresponding to the selected farmer_name
        $selectedFarmerName = $this->request->getPost('farmer_name');
        $fimsCode = $this->profiles->where('fullname', $selectedFarmerName)->first()['fims_code'];

        // Save the new field along with fims_code
        $this->field->save([
            'farmer_name' => $selectedFarmerName,
            'fims_code' => $fimsCode,
            'field_name' => $this->request->getPost('field_name'),
            'field_owner' => $this->request->getPost('field_owner'),
            'field_address' => $this->request->getPost('field_address'),
            'field_total_area' => $this->request->getPost('field_total_area'),
            'user_id' => $userId,
        ]);

        // Redirect to the viewfields page with a success message
        return redirect()->to('/viewfields')->with('success', 'Field added successfully');
    }

    public function edit($field_id)
    {

        $field = $this->field->find($field_id);

        return view('field', ['field' => $field]);
    }
    public function update()
    {


        $field_id = $this->request->getPost('field_id');

        $dataToUpdate = [
            'farmer_name' => $this->request->getPost('farmer_name'),
            'field_name' => $this->request->getPost('field_name'),
            'field_owner' => $this->request->getPost('field_owner'),
            'field_address' => $this->request->getPost('field_address'),
            'field_total_area' => $this->request->getPost('field_total_area'),
        ];

        $this->field->update($field_id, $dataToUpdate);

        return redirect()->to('/viewfields')->with('success', 'Field updated successfully');
    }
    public function deleteProduct($field_id)
    {
        $field = $this->field->find($field_id);

        if ($field) {
            $this->field->delete($field_id);

            return redirect()->to('/viewfields')->with('success', 'field deleted successfully');
        } else {
            return redirect()->to('/viewfields')->with('error', 'field not found');
        }
    }

    //crop planting
    public function cropplanting()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'planting' => $this->planting->where('user_id', $userId)->findAll()
            ];
            return view('userfolder/cropplanting', $data);
        }
    }
    public function addnewplanting()
    {
        $userId = session()->get('leader_id');
        $fieldId = $this->request->getPost('field_id');
        $field = $this->field->find($fieldId);
        $validation = $this->validate([
            'field_name' => 'required',
            'crop_variety' => 'required',
        ]);

        if (!$validation) {
            return view('userfolder/viewfields', ['validation' => $this->validator]);
        }

        $this->planting->save([
            'field_id' => $this->request->getPost('field_id'),
            'field_name' => $this->request->getPost('field_name'),
            'crop_variety' => $this->request->getPost('crop_variety'),
            'planting_date' => $this->request->getPost('planting_date'),
            'season' => $this->request->getPost('season'),
            'start_date' => $this->request->getPost('start_date'),
            'notes' => $this->request->getPost('notes'),
            'user_id' => $userId,
            'farmer_name' => $field['farmer_name'],
            'fims_code' => $field['fims_code'],
            'field_address' => $field['field_address'],
        ]);

        return redirect()->to('/cropplanting')->with('success', 'Field added successfully');
    }

    public function editplanting($planting_id)
    {
        $planting = $this->planting->find($planting_id);

        return view('planting', ['planting' => $planting]);
    }
    public function updateplanting()
    {

        $planting_id = $this->request->getPost('planting_id');

        $dataToUpdate = [
            'farmer_name' => $this->request->getPost('field_name'),
            'field_name' => $this->request->getPost('field_name'),
            'crop_variety' => $this->request->getPost('crop_variety'),
            'planting_date' => $this->request->getPost('planting_date'),
            'season' => $this->request->getPost('season'),
            'start_date' => $this->request->getPost('start_date'),
            'notes' => $this->request->getPost('notes'),
        ];

        $this->planting->update($planting_id, $dataToUpdate);

        return redirect()->to('/cropplanting')->with('success', 'Field updated successfully');
    }
    public function deleteplanting($planting_id)
    {

        $planting = $this->planting->find($planting_id);

        if ($planting) {
            $this->planting->delete($planting_id);
            return redirect()->to('/cropplanting')->with('success', 'field deleted successfully');
        } else {
            return redirect()->to('/cropplanting')->with('error', 'field not found');
        }
    }

    //expense

    public function expenses()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'expense' => $this->expense->where('user_id', $userId)->findAll()
            ];
            return view('userfolder/jobs', $data);
        }
    }
    public function addnewjob()
    {

        $userId = session()->get('leader_id');
        $fieldId = $this->request->getPost('field_id');
        $field = $this->field->find($fieldId);

        $validation = $this->validate([
            'expense_name' => 'required',
            'finished_date' => 'required',
            'total_money_spent' => 'required',
            'notes' => 'required',
        ]);

        if (!$validation) {
            return view('userfolder/jobs', ['validation' => $this->validator]);
        }

        $this->expense->save([
            'field_id' => $this->request->getPost('field_id'),
            'field_name' => $this->request->getPost('field_name'),
            'expense_name' => $this->request->getPost('expense_name'),
            'finished_date' => $this->request->getPost('finished_date'),
            'total_money_spent' => $this->request->getPost('total_money_spent'),
            'notes' => $this->request->getPost('notes'),
            'user_id' => $userId,
            'farmer_name' => $field['farmer_name'],
            'fims_code' => $field['fims_code'],

        ]);

        return redirect()->to('/expenses')->with('success', 'Job added successfully');
    }


    public function editjob($job_id)
    {;
        $jobs = $this->expense->find($job_id);

        return view('jobs', ['jobs' => $jobs]);
    }
    public function updatejob()
    {


        $job_id = $this->request->getPost('job_id');

        $dataToUpdate = [
            'job_name' => $this->request->getPost('job_name'),
            'field_name' => $this->request->getPost('field_name'),
            'finished_date' => $this->request->getPost('finished_date'),
            'worker_name' => $this->request->getPost('worker_name'),
            'total_money_spent' => $this->request->getPost('total_money_spent'),
            'notes' => $this->request->getPost('notes'),
        ];

        $this->expense->update($job_id, $dataToUpdate);

        return redirect()->to('/jobs')->with('success', 'Job updated successfully');
    }
    public function deleteJob($job_id)
    {


        $jobs = $this->expense->find($job_id);

        if ($jobs) {
            $this->expense->delete($job_id);
            return redirect()->to('/jobs')->with('success', 'jobs deleted successfully');
        } else {
            return redirect()->to('/jobs')->with('error', 'jobs not found');
        }
    }

    //harvest

    public function harvest()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }
        $data = [
            'harvest' => $this->harvest->where('user_id', $userId)->findAll()
        ];
        return view('userfolder/harvest', $data);
    }
    public function addnewharvest()
    {
        $userId = session()->get('leader_id');
        $fieldId = $this->request->getPost('field_id');
        $field = $this->field->find($fieldId);

        $validation = $this->validate([
            'field_name' => 'required',
            'variety_name' => 'required',
            'harvest_quantity' => 'required',
            'total_revenue' => 'required',
            'harvest_date' => 'required',


        ]);

        if (!$validation) {
            return view('userfolder/harvest', ['validation' => $this->validator]);
        }

        $this->harvest->save([
            'field_id' => $this->request->getPost('field_id'),
            'field_name' => $this->request->getPost('field_name'),
            'variety_name' => $this->request->getPost('variety_name'),
            'harvest_quantity' => $this->request->getPost('harvest_quantity'),
            'total_revenue' => $this->request->getPost('total_revenue'),
            'harvest_date' => $this->request->getPost('harvest_date'),
            'notes' => $this->request->getPost('notes'),
            'user_id' => $userId,
            'farmer_name' => $field['farmer_name'],
            'fims_code' => $field['fims_code'],

        ]);

        return redirect()->to('/harvest')->with('success', 'Harvest added successfully');
    }


    public function editharvest($harvest_id)
    {
        $harvest = $this->harvest->find($harvest_id);

        return view('harvest', ['harvest' => $harvest]);
    }
    public function updateharvest()
    {

        $harvest_id = $this->request->getPost('harvest_id');

        $dataToUpdate = [
            'field_name' => $this->request->getPost('field_name'),
            'variety_name' => $this->request->getPost('variety_name'),
            'harvest_quantity' => $this->request->getPost('harvest_quantity'),
            'total_revenue' => $this->request->getPost('total_revenue'),
            'harvest_date' => $this->request->getPost('harvest_date'),
            'notes' => $this->request->getPost('notes'),
        ];

        $this->harvest->update($harvest_id, $dataToUpdate);

        return redirect()->to('/harvest')->with('success', 'Harvest updated successfully');
    }
    public function deleteHarvest($harvest_id)
    {


        $jobs = $this->harvest->find($harvest_id);

        if ($jobs) {
            $this->harvest->delete($harvest_id);

            return redirect()->to('/harvest')->with('success', 'Harvest deleted successfully');
        } else {
            return redirect()->to('/harvest')->with('error', 'harvest not found');
        }
    }
    // farmer profiles

    public function farmerprofiles()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }
        $userId = session()->get('leader_id');
        $profile = $this->profiles->where('user_id', $userId)->findAll();

        $data = [
            'profiles' => $profile,
        ];
        return view('userfolder/farmerprofile', $data);
    }
    public function addfarmerprofile()
    {
        $userId = session()->get('leader_id');

        $validation = $this->validate([
            'fims_code' => 'required',
            'fullname' => 'required',
            'address' => 'required',
        ]);

        if (!$validation) {
            return view('userfolder/farmerprofile', ['validation' => $this->validator]);
        }


        $this->profiles->save([
            'fims_code' => $this->request->getPost('fims_code'),
            'fullname' => $this->request->getPost('fullname'),
            'address' => $this->request->getPost('address'),
            'user_id' => $userId,
        ]);


        return redirect()->to('/farmerprofiles')->with('success', 'Profile added successfully');
    }
    public function editfarmer($id)
    {
        $profile = $this->profiles->find($id);

        return view('farmerprofiles', ['profiles' => $profile]);
    }
    public function updatefarmer()
    {
        $id = $this->request->getPost('id');

        $dataToUpdate = [
            'fims_code' => $this->request->getPost('fims_code'),
            'fullname' => $this->request->getPost('fullname'),
            'address' => $this->request->getPost('address'),
        ];

        $this->profiles->update($id, $dataToUpdate);

        return redirect()->to('/farmerprofiles')->with('success', 'Profile updated successfully');
    }
    public function deletefarmer($id)
    {
        $profile = $this->profiles->find($id);

        if ($profile) {
            $this->profiles->delete($id);

            return redirect()->to('/farmerprofiles')->with('success', 'Harvest deleted successfully');
        } else {
            return redirect()->to('/farmerprofiles')->with('error', 'harvest not found');
        }
    }
    public function myprofile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }
        $userId = session()->get('farmer_id');
        $prof = $this->prof->where('user_id', $userId)->findAll();


        $data = [
            'prof' => $prof
        ];
        return view('userfolder/myprofile', $data);
    }
    public function addleaderprofile()
    {
        $userId = session()->get('farmer_id');

        $validation = $this->validate([
            'fullname' => 'required',
            'idnumber' => 'required',
            'address' => 'required',
            'contactnumber' => 'required',
            'birthday' => 'required',
            'profile_picture' => 'uploaded[profile_picture]|max_size[profile_picture,1024]|is_image[profile_picture]',
        ]);

        if (!$validation) {
            return view('userfolder/addprofile', ['validation' => $this->validator]);
        }

        $profilePicture = $this->request->getFile('profile_picture');
        $newName = $profilePicture->getRandomName();
        $profilePicture->move(ROOTPATH . 'public/uploads/profile_pictures/', $newName);

        $this->prof->save([
            'user_id' => $userId,
            'fullname' => $this->request->getPost('fullname'),
            'idnumber' => $this->request->getPost('idnumber'),
            'address' => $this->request->getPost('address'),
            'contactnumber' => $this->request->getPost('contactnumber'),
            'birthday' => $this->request->getPost('birthday'),
            'profile_picture' => 'uploads/profile_pictures/' . $newName,
        ]);

        $prof = $this->prof->where('user_id', $userId)->findAll();

        $this->prof = $prof;
        $session = session();
        $session->set('prof', $prof);

        return redirect()->to('/addprofile')->with('success', 'Profile added successfully');
    }



    public function map()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $barangays = ['Santiago', 'Kalinisan',  'Mabini', 'Adrialuna', 'Antipolo', 'Apitong', 'Arangin', 'Aurora', 'Bacungan', 'Bagong Buhay', 'Bancuro', 'Barcenaga', 'Bayani', 'Buhangin', 'Concepcion', 'Dao', 'Del Pilar', 'Estrella', 'Evangelista', 'Gamao', 'General Esco', 'Herrera', 'Inarawan', 'Laguna', 'Mabini', 'Andres Ilagan', 'Mahabang Parang', 'Malaya', 'Malinao', 'Malvar', 'Masagana', 'Masaguing', 'Melgar A', 'Melgar B', 'Metolza', 'Montelago', 'Montemayor', 'Motoderazo', 'Mulawin', 'Nag-Iba I', 'Nag-Iba II', 'Pagkakaisa', 'Paniquian', 'Pinagsabangan I', 'Pinagsabangan II', 'Pinahan', 'Poblacion I (Barangay I)', 'Poblacion II (Barangay II)', 'Poblacion III (Barangay III)', 'Sampaguita', 'San Agustin I', 'San Agustin II', 'San Andres', 'San Antonio', 'San Carlos', 'San Isidro', 'San Jose', 'San Luis', 'San Nicolas', 'San Pedro', 'Santa Isabel', 'Santa Maria', 'Santiago', 'Santo Nino', 'Tagumpay', 'Tigkan', 'Melgar B', 'Santa Cruz', 'Balite', 'Banuton', 'Caburo', 'Magtibay', 'Paitan'];
        $varietyData = [];

        foreach ($barangays as $barangay) {
            $varietyData[$barangay] = $this->planting
                ->select('crop_variety')
                ->where('field_address', $barangay)
                ->findAll();
        }

        return view('adminfolder/map', ['varietyData' => $varietyData]);
    }
    public function farmermap()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $barangays = ['Santiago', 'Kalinisan',  'Mabini', 'Adrialuna', 'Antipolo', 'Apitong', 'Arangin', 'Aurora', 'Bacungan', 'Bagong Buhay', 'Bancuro', 'Barcenaga', 'Bayani', 'Buhangin', 'Concepcion', 'Dao', 'Del Pilar', 'Estrella', 'Evangelista', 'Gamao', 'General Esco', 'Herrera', 'Inarawan', 'Laguna', 'Mabini', 'Andres Ilagan', 'Mahabang Parang', 'Malaya', 'Malinao', 'Malvar', 'Masagana', 'Masaguing', 'Melgar A', 'Melgar B', 'Metolza', 'Montelago', 'Montemayor', 'Motoderazo', 'Mulawin', 'Nag-Iba I', 'Nag-Iba II', 'Pagkakaisa', 'Paniquian', 'Pinagsabangan I', 'Pinagsabangan II', 'Pinahan', 'Poblacion I (Barangay I)', 'Poblacion II (Barangay II)', 'Poblacion III (Barangay III)', 'Sampaguita', 'San Agustin I', 'San Agustin II', 'San Andres', 'San Antonio', 'San Carlos', 'San Isidro', 'San Jose', 'San Luis', 'San Nicolas', 'San Pedro', 'Santa Isabel', 'Santa Maria', 'Santiago', 'Santo Nino', 'Tagumpay', 'Tigkan', 'Melgar B', 'Santa Cruz', 'Balite', 'Banuton', 'Caburo', 'Magtibay', 'Paitan'];
        $varietyData = [];

        foreach ($barangays as $barangay) {
            $varietyData[$barangay] = $this->planting
                ->select('crop_variety')
                ->where('field_address', $barangay)
                ->findAll();
        }
        return view('userfolder/map', ['varietyData' => $varietyData]);
    }


    public function adminfields()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'field' => $this->field->findAll()
        ];
        return view('adminfolder/fields', $data);
    }
    public function admincropplanting()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'planting' => $this->planting->findAll()
        ];
        return view('adminfolder/croprotation', $data);
    }
    public function adminharvest()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'harvest' => $this->harvest->findAll()
        ];
        return view('adminfolder/harvest', $data);
    }
    /*public function editaccount($field_id)
    {
        $users = $this->users->find($field_id);

        return view('users', ['users' => $users]);
    }
    public function updateaccount()
    {
        $model = new VIewFieldsModel();

        $field_id = $this->request->getPost('field_id');

        $dataToUpdate = [
            'field_name' => $this->request->getPost('field_name'),
            'field_owner' => $this->request->getPost('field_owner'),
            'field_address' => $this->request->getPost('field_address'),
            'field_total_area' => $this->request->getPost('field_total_area'),
        ];

        $model->update($field_id, $dataToUpdate);

        return redirect()->to('/viewfields')->with('success', 'Field updated successfully');
    }
     
      

    public function addprofile()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }
        $userId = session()->get('farmer_id');
        $prof = $this->prof->where('user_id', $userId)->findAll();
        $currentYear = date('Y');


        // total na naani
        $resultQuantity = $this->harvest
            ->selectSum('harvest_quantity', 'totalHarvestQuantity')
            ->where('user_id', $userId)
            ->get();
        $totalHarvestQuantity = $resultQuantity->getRow()->totalHarvestQuantity;


        // kita ngayong taon
        $resultRevenue = $this->harvest
            ->selectSum('total_revenue', 'totalRevenueThisYear')
            ->where('user_id', $userId)
            ->where('YEAR(harvest_date)', $currentYear)
            ->get();
        $totalRevenueThisYear = $resultRevenue->getRow()->totalRevenueThisYear;

        // Count of binhi
        $totalVarieties = $this->variety
            ->selectSum('quantity', 'totalVarieties')
            ->where('user_id', $userId)
            ->get();
        $totalBinhiCount = $totalVarieties->getRow()->totalVarieties;

        // Total money spent from jobs table
        $resultMoneySpent = $this->jobs
            ->selectSum('total_money_spent', 'totalMoneySpent')
            ->where('user_id', $userId)
            ->get();
        $totalMoneySpent = $resultMoneySpent->getRow()->totalMoneySpent;

        $harvestData = $this->harvest->where('user_id', $userId)->findAll();
        $revenueData = $this->harvest->where('user_id', $userId)->findAll();
        $workerData = $this->worker->where('user_id', $userId)->findAll();


        $data = [
            'prof' => $prof,
            'totalHarvestQuantity' => $totalHarvestQuantity,
            'totalRevenueThisYear' => $totalRevenueThisYear,
            'harvest' => $harvestData,
            'totalBinhiCount' => $totalBinhiCount,
            'totalMoneySpent' => $totalMoneySpent,
            'worker' => $workerData,
            'field' => $this->field->where('user_id', $userId)->findAll()
        ];
        return view('userfolder/addprofile', $data);
    }
     
    public function adminfields()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'field' => $this->field->findAll()
        ];
        return view('adminfolder/fields', $data);
    }
    public function admincropplanting()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'planting' => $this->planting->findAll()
        ];
        return view('adminfolder/croprotation', $data);
    }
    public function adminharvest()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $data = [
            'harvest' => $this->harvest->findAll()
        ];
        return view('adminfolder/harvest', $data);
    }
    public function map()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $barangays = ['Santiago', 'Kalinisan',  'Mabini', 'Adrialuna', 'Antipolo', 'Apitong', 'Arangin', 'Aurora', 'Bacungan', 'Bagong Buhay', 'Bancuro', 'Barcenaga', 'Bayani', 'Buhangin', 'Concepcion', 'Dao', 'Del Pilar', 'Estrella', 'Evangelista', 'Gamao', 'General Esco', 'Herrera', 'Inarawan', 'Laguna', 'Mabini', 'Andres Ilagan', 'Mahabang Parang', 'Malaya', 'Malinao', 'Malvar', 'Masagana', 'Masaguing', 'Melgar A', 'Melgar B', 'Metolza', 'Montelago', 'Montemayor', 'Motoderazo', 'Mulawin', 'Nag-Iba I', 'Nag-Iba II', 'Pagkakaisa', 'Paniquian', 'Pinagsabangan I', 'Pinagsabangan II', 'Pinahan', 'Poblacion I (Barangay I)', 'Poblacion II (Barangay II)', 'Poblacion III (Barangay III)', 'Sampaguita', 'San Agustin I', 'San Agustin II', 'San Andres', 'San Antonio', 'San Carlos', 'San Isidro', 'San Jose', 'San Luis', 'San Nicolas', 'San Pedro', 'Santa Isabel', 'Santa Maria', 'Santiago', 'Santo Nino', 'Tagumpay', 'Tigkan', 'Melgar B', 'Santa Cruz', 'Balite', 'Banuton', 'Caburo', 'Magtibay', 'Paitan'];
        $varietyData = [];

        foreach ($barangays as $barangay) {
            $varietyData[$barangay] = $this->variety
                ->select('variety_name')
                ->where('barangay', $barangay)
                ->findAll();
        }

        return view('adminfolder/map', ['varietyData' => $varietyData]);
    }
    public function farmermap()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $barangays = ['Santiago', 'Kalinisan',  'Mabini', 'Adrialuna', 'Antipolo', 'Apitong', 'Arangin', 'Aurora', 'Bacungan', 'Bagong Buhay', 'Bancuro', 'Barcenaga', 'Bayani', 'Buhangin', 'Concepcion', 'Dao', 'Del Pilar', 'Estrella', 'Evangelista', 'Gamao', 'General Esco', 'Herrera', 'Inarawan', 'Laguna', 'Mabini', 'Andres Ilagan', 'Mahabang Parang', 'Malaya', 'Malinao', 'Malvar', 'Masagana', 'Masaguing', 'Melgar A', 'Melgar B', 'Metolza', 'Montelago', 'Montemayor', 'Motoderazo', 'Mulawin', 'Nag-Iba I', 'Nag-Iba II', 'Pagkakaisa', 'Paniquian', 'Pinagsabangan I', 'Pinagsabangan II', 'Pinahan', 'Poblacion I (Barangay I)', 'Poblacion II (Barangay II)', 'Poblacion III (Barangay III)', 'Sampaguita', 'San Agustin I', 'San Agustin II', 'San Andres', 'San Antonio', 'San Carlos', 'San Isidro', 'San Jose', 'San Luis', 'San Nicolas', 'San Pedro', 'Santa Isabel', 'Santa Maria', 'Santiago', 'Santo Nino', 'Tagumpay', 'Tigkan', 'Melgar B', 'Santa Cruz', 'Balite', 'Banuton', 'Caburo', 'Magtibay', 'Paitan'];
        $varietyData = [];

        foreach ($barangays as $barangay) {
            $varietyData[$barangay] = $this->variety
                ->select('variety_name')
                ->where('barangay', $barangay)
                ->findAll();
        }

        return view('userfolder/map', ['varietyData' => $varietyData]);
    }
    */
}
