<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PDO;
use TCPDF;

class MYPDF extends TCPDF
{
    public function Header()
    {
        $logoPath = FCPATH . 'dashboard/img/naujan-official-logo.png';

        $html = '<br><br><table style="width: 100%; text-align: center; border: none;">
                    <tr>
                        <td style="width: 40%; text-align: center; border: none;">
                            <img src="' . $logoPath . '" alt="Logo"   width="100">
                        </td>
                        <td style="width: 60%; text-align: left; border: none;">
                            <h5 style="margin: 0;">Republic of the Philippines</h5>
                            <h5 style="margin: 0;">Province of Oriental Mindoro</h5>
                            <h5 style="margin: 0;">Municipality of Naujan</h5>
                            <h5 style="margin: 0;">Municipal Agriculture Office</h5>
                        </td>
                    </tr>
                </table> <hr>';

        $this->writeHTML($html, true, false, true, false, '');
        $this->Ln(20);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

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
    private $damages;
    private $admin;
    private $trivia;
    private $reports;
    private $trainings;
    private $pest;
    private $disease;
    private $dis;


    public function __construct()
    {
        $this->users = new \App\Models\RegisterModel();
        $this->field = new \App\Models\VIewFieldsModel();
        $this->expense = new \App\Models\ExpensesModel();
        $this->harvest = new \App\Models\HarvestModel();
        $this->planting = new \App\Models\PlantingModel();
        $this->damages = new \App\Models\DamageModel();
        $this->worker = new \App\Models\WorkerModel();
        $this->variety = new \App\Models\VarietyModel();
        $this->fertilizers = new \App\Models\FertilizersModel();
        $this->equipment = new \App\Models\EquipmentModel();
        $this->prof = new \App\Models\FarmelProfileModel();
        $this->profiles = new \App\Models\FarmerProfilesModel();
        $this->admin = new \App\Models\AdminModel();
        $this->trivia = new \App\Models\TriviasModel();
        $this->reports = new \App\Models\ReportsModel();
        $this->trainings = new \App\Models\TrainingsModel();
        $this->pest = new \App\Models\PestModel();
        $this->disease = new \App\Models\DiseasesModel();
        $this->dis = new \App\Models\DiseaseModel();
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
            ->where('user_id', $userId)
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

        $validation = $this->validate([
            'farmer_name' => 'required',
            'field_name' => 'required',
            'field_address' => 'required',
            'field_total_area' => 'required',
        ]);

        if (!$validation) {
            return view('userfolder/viewfields', ['validation' => $this->validator]);
        }

        $selectedFarmerName = $this->request->getPost('farmer_name');
        $fimsCode = $this->profiles->where('fullname', $selectedFarmerName)->first()['fims_code'];

        $this->field->save([
            'farmer_name' => $selectedFarmerName,
            'fims_code' => $fimsCode,
            'field_name' => $this->request->getPost('field_name'),
            'field_owner' => $this->request->getPost('field_owner'),
            'field_address' => $this->request->getPost('field_address'),
            'field_total_area' => $this->request->getPost('field_total_area'),
            'user_id' => $userId,
        ]);

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
            'farmer_name' => $this->request->getPost('farmer_name'),
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

    // damages
    public function damages()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }
        $data = [
            'damages' => $this->damages->where('user_id', $userId)->findAll()
        ];
        return view('userfolder/damages', $data);
    }
    public function addnewdamage()
    {
        $userId = session()->get('leader_id');
        $fieldId = $this->request->getPost('field_id');
        $fieldAddress = $this->request->getPost('field_address');
        $fieldName = $this->request->getPost('field_name');
        $cropVariety = $this->request->getPost('crop_variety');
        $farmerName = $this->request->getPost('farmer_name');
        $fimsCode = $this->request->getPost('fims_code');
        $planting = $this->planting->find($fieldId);
        $validation = $this->validate([
            'field_name' => 'required',
        ]);

        if (!$validation) {
            return view('userfolder/damage', ['validation' => $this->validator]);
        }

        $this->damages->save([
            'field_id' => $fieldId,
            'field_address' => $fieldAddress,
            'field_name' => $fieldName,
            'crop_variety' => $cropVariety,
            'damage_type' => $this->request->getPost('damage_type'),
            'pest_type' => $this->request->getPost('pest_type'),
            'severity' => $this->request->getPost('severity'),
            'symptoms' => $this->request->getPost('symptoms'),
            'actions' => $this->request->getPost('actions'),
            'weather_events' => $this->request->getPost('weather_events'),
            'damage_descriptions' => $this->request->getPost('damage_descriptions'),
            'damage_severity' => $this->request->getPost('damage_severity'),
            'mitigation_measures' => $this->request->getPost('mitigation_measures'),
            'user_id' => $userId,
            'farmer_name' => $farmerName,
            'fims_code' => $fimsCode,
        ]);

        return redirect()->to('/damages')->with('success', 'Harvest added successfully');
    }
    public function editdamage($damage_id)
    {
        $damages = $this->damages->find($damage_id);

        return view('damages', ['damages' => $damages]);
    }
    public function updatedamage()
    {

        $damage_id = $this->request->getPost('damage_id');

        $dataToUpdate = [
            'pest_type' => $this->request->getPost('pest_type'),
            'severity' => $this->request->getPost('severity'),
            'symptoms' => $this->request->getPost('symptoms'),
            'actions' => $this->request->getPost('actions'),
            'weather_events' => $this->request->getPost('weather_events'),
            'damage_descriptions' => $this->request->getPost('damage_descriptions'),
            'damage_severity' => $this->request->getPost('damage_severity'),
            'mitigation_measures' => $this->request->getPost('mitigation_measures'),
        ];

        $this->damages->update($damage_id, $dataToUpdate);

        return redirect()->to('/damages')->with('success', 'Harvest updated successfully');
    }
    public function deletedamage($damage_id)
    {


        $damage = $this->damages->find($damage_id);

        if ($damage) {
            $this->harvest->delete($damage_id);

            return redirect()->to('/damages')->with('success', 'Harvest deleted successfully');
        } else {
            return redirect()->to('/damages')->with('error', 'harvest not found');
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

        $barangays = ['Santiago', 'Kalinisan',  'Mabini', 'Adrialuna', 'Antipolo', 'Apitong', 'Arangin', 'Aurora', 'Bacungan', 'Bagong Buhay', 'Bancuro', 'Barcenaga', 'Bayani', 'Buhangin', 'Concepcion', 'Dao', 'Del Pilar', 'Estrella', 'Evangelista', 'Gamao', 'General Esco', 'Herrera', 'Inarawan', 'Laguna', 'Andres Ilagan', 'Mahabang Parang', 'Malaya', 'Malinao', 'Malvar', 'Masagana', 'Masaguing', 'Melgar A', 'Melgar B', 'Metolza', 'Montelago', 'Montemayor', 'Motoderazo', 'Mulawin', 'Nag-Iba I', 'Nag-Iba II', 'Pagkakaisa', 'Paniquian', 'Pinagsabangan I', 'Pinagsabangan II', 'Pinahan', 'Poblacion I (Barangay I)', 'Poblacion II (Barangay II)', 'Poblacion III (Barangay III)', 'Sampaguita', 'San Agustin I', 'San Agustin II', 'San Andres', 'San Antonio', 'San Carlos', 'San Isidro', 'San Jose', 'San Luis', 'San Nicolas', 'San Pedro', 'Santa Isabel', 'Santa Maria', 'Santiago', 'Santo Nino', 'Tagumpay', 'Tigkan', 'Melgar B', 'Santa Cruz', 'Balite', 'Banuton', 'Caburo', 'Magtibay', 'Paitan'];
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

        $barangays = ['Santiago', 'Kalinisan', 'Mabini', 'Adrialuna', 'Antipolo', 'Apitong', 'Arangin', 'Aurora', 'Bacungan', 'Bagong Buhay', 'Bancuro', 'Barcenaga', 'Bayani', 'Buhangin', 'Concepcion', 'Dao', 'Del Pilar', 'Estrella', 'Evangelista', 'Gamao', 'General Esco', 'Herrera', 'Inarawan', 'Laguna', 'Andres Ilagan', 'Mahabang Parang', 'Malaya', 'Malinao', 'Malvar', 'Masagana', 'Masaguing', 'Melgar A', 'Melgar B', 'Metolza', 'Montelago', 'Montemayor', 'Motoderazo', 'Mulawin', 'Nag-Iba I', 'Nag-Iba II', 'Pagkakaisa', 'Paniquian', 'Pinagsabangan I', 'Pinagsabangan II', 'Pinahan', 'Poblacion I (Barangay I)', 'Poblacion II (Barangay II)', 'Poblacion III (Barangay III)', 'Sampaguita', 'San Agustin I', 'San Agustin II', 'San Andres', 'San Antonio', 'San Carlos', 'San Isidro', 'San Jose', 'San Luis', 'San Nicolas', 'San Pedro', 'Santa Isabel', 'Santa Maria', 'Santiago', 'Santo Nino', 'Tagumpay', 'Tigkan', 'Melgar B', 'Santa Cruz', 'Balite', 'Banuton', 'Caburo', 'Magtibay', 'Paitan'];

        $varietyData = [];
        $landAreaData = [];
        $markerColors = [];

        foreach ($barangays as $barangay) {
            $landAreaRecord = $this->field
                ->select('field_total_area')
                ->where('field_address', $barangay)
                ->get()
                ->getRow();

            if ($landAreaRecord) {
                $landAreaData[$barangay] = $landAreaRecord->field_total_area;

                $colorRanges = [
                    ['min' => 0, 'max' => 50, 'color' => '#ff7c80'],
                    ['min' => 51, 'max' => 100, 'color' => '#fad05c'],
                    ['min' => 101, 'max' => 150, 'color' => '#f59123'],
                ];

                foreach ($colorRanges as $range) {
                    if ($landAreaRecord->field_total_area >= $range['min'] && $landAreaRecord->field_total_area <= $range['max']) {
                        $markerColors[$barangay] = $range['color'];
                        break;
                    }
                }
            } else {
                $landAreaData[$barangay] = 0;
            }

            $varietyData[$barangay] = $this->planting
                ->select('crop_variety')
                ->where('field_address', $barangay)
                ->findAll();
        }

        $data = [
            'varietyData' => $varietyData,
            'landAreaData' => $landAreaData,
            'markerColors' => $markerColors
        ];

        return view('userfolder/map', $data);
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
    public function adminexpense()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'expense' => $this->expense->findAll()
            ];
            return view('adminfolder/jobs', $data);
        }
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
    public function admindamages()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }
        $data = [
            'damages' => $this->damages->findAll()
        ];
        return view('adminfolder/damage', $data);
    }

    public function searchFields()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('leader_id');
        $searchTerm = $this->request->getPost('search_term');

        $fields = $this->field->like('farmer_name', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();
        $profiles = [];
        foreach ($fields as $field) {
            $profile = $this->profiles->where('fims_code', $field['fims_code'])->first();
            if ($profile) {
                $profiles[] = $profile;
            }
        }

        $data = [
            'field' => $fields,
            'profiles' => $profiles,
        ];

        return view('userfolder/viewfields', $data);
    }
    public function searchCropplanting()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('leader_id');
        $searchTerm = $this->request->getPost('search_term');

        $plant = $this->planting->like('farmer_name', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'planting' => $plant,
        ];

        return view('userfolder/cropplanting', $data);
    }
    public function searchExpense()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('leader_id');
        $searchTerm = $this->request->getPost('search_term');

        $exp = $this->expense->like('expense_name', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'expense' => $exp,
        ];

        return view('userfolder/jobs', $data);
    }
    public function searchHarvest()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('leader_id');
        $searchTerm = $this->request->getPost('search_term');

        $har = $this->harvest->like('farmer_name', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'harvest' => $har,
        ];

        return view('userfolder/harvest', $data);
    }


    public function searchDamage()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('leader_id');
        $searchTerm = $this->request->getPost('search_term');

        $dam = $this->damages->like('farmer_name',  $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'damages' => $dam,
        ];

        return view('userfolder/cropplanting', $data);
    }
    public function searchfarmerprofiles()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('leader_id');
        $searchTerm = $this->request->getPost('search_term');

        $profiles = $this->profiles->like('fullname', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'profiles' => $profiles,
        ];

        return view('userfolder/farmerprofile', $data);
    }
    public function searchadminFields()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $searchTerm = $this->request->getPost('search_term');

        $fields = $this->field->like('farmer_name', $searchTerm)
            ->findAll();
        $profiles = [];
        foreach ($fields as $field) {
            $profile = $this->profiles->where('fims_code', $field['fims_code'])->first();
            if ($profile) {
                $profiles[] = $profile;
            }
        }

        $data = [
            'field' => $fields,
            'profiles' => $profiles,
        ];

        return view('adminfolder/fields', $data);
    }
    public function searchadminCropplanting()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $searchTerm = $this->request->getPost('search_term');

        $plant = $this->planting->like('farmer_name', $searchTerm)
            ->findAll();

        $data = [
            'planting' => $plant,
        ];

        return view('adminfolder/croprotation', $data);
    }
    public function searchadminExpense()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $searchTerm = $this->request->getPost('search_term');

        $exp = $this->expense->like('expense_name', $searchTerm)
            ->findAll();

        $data = [
            'expense' => $exp,
        ];

        return view('adminfolder/jobs', $data);
    }

    public function searchadminDamage()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $searchTerm = $this->request->getPost('search_term');

        $dam = $this->damages->like('farmer_name', $searchTerm)
            ->orLike('pest_type', $searchTerm)
            ->orLike('weather_events', $searchTerm)
            ->findAll();

        $data = [
            'damages' => $dam,
        ];

        return view('adminfolder/damage', $data);
    }

    public function searchadminHarvest()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $searchTerm = $this->request->getPost('search_term');

        $har = $this->harvest->like('farmer_name', $searchTerm)
            ->findAll();

        $data = [
            'harvest' => $har,
        ];

        return view('adminfolder/harvest', $data);
    }
    public function searchadminmanageaccounts()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        }

        $searchTerm = $this->request->getPost('search_term');

        $adm = $this->users->like('leader_name', $searchTerm)
            ->findAll();

        $data = [
            'users' => $adm,
        ];

        return view('adminfolder/manageaccounts', $data);
    }

    public function searchTrivia()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('id');
        $searchTerm = $this->request->getPost('search_term');

        $trivs = $this->trivia->like('trivia', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'trivia' => $trivs,
        ];

        return view('adminfolder/adtrivias', $data);
    }

    public function searchUserTrivia()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $searchTerm = $this->request->getPost('search_term');

        $trivs = $this->trivia->like('trivia', $searchTerm)
            ->findAll();

        $data = [
            'trivia' => $trivs,
        ];

        return view('userfolder/usertrivias', $data);
    }

    public function searchReports()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('id');
        $searchTerm = $this->request->getPost('search_term');

        $reps = $this->reports->like('description', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'reports' => $reps,
        ];

        return view('adminfolder/adreports', $data);
    }

    public function searchTrainings()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('id');
        $searchTerm = $this->request->getPost('search_term');

        $trains = $this->trainings->like('event_title', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'trainings' => $trains,
        ];

        return view('adminfolder/adtrainings', $data);
    }

    public function searchPest()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('id');
        $searchTerm = $this->request->getPost('search_term');

        $pestss = $this->pest->like('pest_name', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'pest' => $pestss,
        ];

        return view('adminfolder/adpest', $data);
    }

    public function searchUserPest()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $searchTerm = $this->request->getPost('search_term');

        $pestss = $this->pest->like('pest_name', $searchTerm)
            ->findAll();

        $data = [
            'pest' => $pestss,
        ];

        return view('userfolder/userpest', $data);
    }

    public function searchDisease()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $userId = session()->get('id');
        $searchTerm = $this->request->getPost('search_term');

        $diss = $this->disease->like('dis_name', $searchTerm)
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'disease' => $diss,
        ];

        return view('adminfolder/addisease', $data);
    }

    public function searchUserDisease()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $searchTerm = $this->request->getPost('search_term');

        $diss = $this->pest->like('dis_name', $searchTerm)
            ->findAll();

        $data = [
            'disease' => $diss,
        ];

        return view('userfolder/userdisease', $data);
    }

    public function exportToExcel()
    {
        $userId = session()->get('leader_id');
        $fields = $this->field->where('user_id', $userId)->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Field Data');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Field Owner');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Field Address');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Field Total Area');

        $row = 2;
        foreach ($fields as $field) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $field['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $field['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $field['field_owner']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $field['field_address']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $field['field_total_area']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="field_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }

    public function exportToExceldamage()
    {
        $userId = session()->get('leader_id');
        $damage = $this->damages->where('user_id', $userId)->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Damage Details');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Address');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'FIMS Code');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Crop Variety');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Damage Type');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Pest Type');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Severity');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Symptoms');
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'Actions');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Weather Events');
        $spreadsheet->getActiveSheet()->setCellValue('L1', 'Damage Descriptions');
        $spreadsheet->getActiveSheet()->setCellValue('M1', 'Damage Severity');
        $spreadsheet->getActiveSheet()->setCellValue('N1', 'Mitigation Measures');

        // Populate data
        $row = 2;
        foreach ($damage as $damages) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $damages['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $damages['field_address']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $damages['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $damages['fims_code']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $damages['crop_variety']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $damages['damage_type']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $damages['pest_type']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $damages['severity']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $damages['symptoms']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $damages['actions']);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $damages['weather_events']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $row, $damages['damage_descriptions']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $row, $damages['damage_severity']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $row, $damages['mitigation_measures']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="damage_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }
    public function exportToExcelplanting()
    {
        $userId = session()->get('leader_id');
        $plant = $this->planting->where('user_id', $userId)->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Planting Details');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Field Address');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Crop Variety');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Planting Date');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Season');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Start Date');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Notes');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'FIMS Code');

        // Populate data
        $row = 2;
        foreach ($plant as $planting) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $planting['field_address']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $planting['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $planting['crop_variety']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $planting['planting_date']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $planting['season']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $planting['start_date']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $planting['notes']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $planting['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $planting['fims_code']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="planting_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }
    public function exportToExcelharvest()
    {
        $userId = session()->get('leader_id');
        $harv = $this->harvest->where('user_id', $userId)->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Harvest Data');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Variety Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Harvest Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Total Revenue');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Harvest Date');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'FIMS Code');

        // Populate data
        $row = 2;
        foreach ($harv as $harvest) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $harvest['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $harvest['variety_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $harvest['harvest_quantity']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $harvest['total_revenue']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $harvest['harvest_date']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $harvest['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $harvest['fims_code']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="harvest_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }
    public function exportToExcelexpense()
    {
        $userId = session()->get('leader_id');
        $exp = $this->expense->where('user_id', $userId)->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('expenses Data');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Expense Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Finished Date');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Total Money Spent');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Notes');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'FIMS Code');

        $row = 2;
        foreach ($exp as $expense) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $expense['expense_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $expense['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $expense['finished_date']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $expense['total_money_spent']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $expense['notes']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $expense['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $expense['fims_code']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="expenses_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }
    public function exportToExcelfarmerprofiles()
    {
        $userId = session()->get('leader_id');
        $profiles = $this->profiles->where('user_id', $userId)->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('profiles Details');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'FIMS Code');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Address');

        // Populate data
        $row = 2;
        foreach ($profiles as $profiles) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $profiles['fims_code']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $profiles['fullname']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $profiles['address']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="farmer_profiles.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }

    public function exportToExceladminfields()
    {
        $userId = session()->get('leader_id');
        $fields = $this->field->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Field Data');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Field Owner');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Field Address');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Field Total Area');

        // Populate data
        $row = 2;
        foreach ($fields as $field) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $field['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $field['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $field['field_owner']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $field['field_address']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $field['field_total_area']);
            $row++;
        }

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="field_data.xlsx"');
        header('Cache-Control: max-age=0');

        // Create Excel writer object
        $writer = new Xlsx($spreadsheet);

        // Save Excel file to php://output (download)
        $writer->save('php://output');
    }
    public function exportToExceladminplanting()
    {
        $userId = session()->get('leader_id');
        $plant = $this->planting->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Planting Details');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Field Address');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Crop Variety');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Planting Date');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Season');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Start Date');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Notes');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'FIMS Code');

        // Populate data
        $row = 2;
        foreach ($plant as $planting) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $planting['field_address']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $planting['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $planting['crop_variety']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $planting['planting_date']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $planting['season']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $planting['start_date']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $planting['notes']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $planting['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $planting['fims_code']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="planting_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }
    public function exportToExceladminexpense()
    {
        $exp = $this->expense->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('expenses Data');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Expense Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Finished Date');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Total Money Spent');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Notes');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'FIMS Code');

        $row = 2;
        foreach ($exp as $expense) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $expense['expense_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $expense['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $expense['finished_date']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $expense['total_money_spent']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $expense['notes']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $expense['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $expense['fims_code']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="expenses_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }


    public function exportToExceladmindamage()
    {
        $damage = $this->damages->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Damage Details');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Field Address');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'FIMS Code');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Crop Variety');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Damage Type');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'Pest Type');
        $spreadsheet->getActiveSheet()->setCellValue('H1', 'Severity');
        $spreadsheet->getActiveSheet()->setCellValue('I1', 'Symptoms');
        $spreadsheet->getActiveSheet()->setCellValue('J1', 'Actions');
        $spreadsheet->getActiveSheet()->setCellValue('K1', 'Weather Events');
        $spreadsheet->getActiveSheet()->setCellValue('L1', 'Damage Descriptions');
        $spreadsheet->getActiveSheet()->setCellValue('M1', 'Damage Severity');
        $spreadsheet->getActiveSheet()->setCellValue('N1', 'Mitigation Measures');

        // Populate data
        $row = 2;
        foreach ($damage as $damages) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $damages['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $damages['field_address']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $damages['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $damages['fims_code']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $damages['crop_variety']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $damages['damage_type']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $damages['pest_type']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $damages['severity']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $damages['symptoms']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $damages['actions']);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $damages['weather_events']);
            $spreadsheet->getActiveSheet()->setCellValue('L' . $row, $damages['damage_descriptions']);
            $spreadsheet->getActiveSheet()->setCellValue('M' . $row, $damages['damage_severity']);
            $spreadsheet->getActiveSheet()->setCellValue('N' . $row, $damages['mitigation_measures']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="damage_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }

    public function exportToExceladminharvest()
    {
        $harv = $this->harvest->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->setTitle('Harvest Data');

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Field Name');
        $spreadsheet->getActiveSheet()->setCellValue('B1', 'Variety Name');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 'Harvest Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('D1', 'Total Revenue');
        $spreadsheet->getActiveSheet()->setCellValue('E1', 'Harvest Date');
        $spreadsheet->getActiveSheet()->setCellValue('F1', 'Farmer Name');
        $spreadsheet->getActiveSheet()->setCellValue('G1', 'FIMS Code');

        $row = 2;
        foreach ($harv as $harvest) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $harvest['field_name']);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $harvest['variety_name']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $harvest['harvest_quantity']);
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $harvest['total_revenue']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $harvest['harvest_date']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $harvest['farmer_name']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $harvest['fims_code']);
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="harvest_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);

        $writer->save('php://output');
    }


    // charts

    public function charts()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $topBarangays = $this->field
            ->select('field_address, SUM(field_total_area) as total_area')
            ->groupBy('field_address')
            ->orderBy('total_area', 'DESC')
            ->limit(10)
            ->findAll();

        $barangayNames = array_column($topBarangays, 'field_address');
        $totalAreas = array_column($topBarangays, 'total_area');


        $chartData = [
            'labels' => $barangayNames,
            'datasets' => [
                [
                    'label' => 'Total Field Area',
                    'backgroundColor' => ['rgb(250, 208, 92)', 'rgb(136, 196, 49)'],
                    'borderWidth' => 1,
                    'data' => $totalAreas,
                ],
            ],
        ];
        $cropVarietyCount = $this->planting
            ->select('crop_variety, COUNT(crop_variety) as variety_count')
            ->where('user_id', $userId)
            ->groupBy('crop_variety')
            ->orderBy('variety_count', 'DESC')
            ->limit(10)
            ->findAll();

        $varietyNames = array_column($cropVarietyCount, 'crop_variety');
        $varietyCounts = array_column($cropVarietyCount, 'variety_count');

        $chartData2 = [
            'labels' => $varietyNames,
            'datasets' => [
                [
                    'label' => 'Number of Crop Varieties',
                    'backgroundColor' => 'rgb(250, 208, 92)',
                    'borderColor' => 'rgb(250, 208, 92)',
                    'borderWidth' => 1,
                    'data' => $varietyCounts,
                ],
            ],
        ];

        $damageCounts = $this->damages
            ->select('pest_type, COUNT(*) as count')
            ->where('user_id', $userId)
            ->groupBy('pest_type')
            ->findAll();

        $pestTypes = array_column($damageCounts, 'pest_type');
        $damageCountsData = array_column($damageCounts, 'count');

        $chartData3 = [
            'labels' => $pestTypes,
            'datasets' => [
                [
                    'label' => 'Number of Damages',
                    'backgroundColor' => 'rgb(250, 108, 92)',
                    'borderColor' => 'rgb(250, 108, 92)',
                    'borderWidth' => 1,
                    'data' => $damageCountsData,
                ],
            ],
        ];
        $weatherEventCounts = $this->damages
            ->select('weather_events, COUNT(*) as count')
            ->where('user_id', $userId)
            ->groupBy('weather_events')
            ->findAll();

        $weatherEvents = array_column($weatherEventCounts, 'weather_events');
        $weatherEventCountsData = array_column($weatherEventCounts, 'count');

        $chartData4 = [
            'labels' => $weatherEvents,
            'datasets' => [
                [
                    'label' => 'Number of Damages',
                    'backgroundColor' => 'rgb(92, 182, 250)',
                    'borderColor' => 'rgb(92, 182, 250)',
                    'borderWidth' => 1,
                    'data' => $weatherEventCountsData,
                ],
            ],
        ];
        $harvestData = $this->harvest
            ->select('harvest_date, harvest_quantity')
            ->where('user_id', $userId)
            ->findAll();

        $harvestDates = array_column($harvestData, 'harvest_date');
        $harvestQuantities = array_column($harvestData, 'harvest_quantity');

        $chartData6 = [
            'labels' => $harvestDates,
            'datasets' => [
                [
                    'label' => 'Harvest Quantity',
                    'backgroundColor' => 'rgb(54, 162, 235)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'data' => $harvestQuantities,
                ],
            ],
        ];
        $data = [
            'chartData' => $chartData,
            'chartData2' => $chartData2,
            'chartData3' => $chartData3,
            'chartData4' => $chartData4,
            'chartData6' => $chartData6,
        ];
        return view('userfolder/charts', $data);
    }
    public function admincharts()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        }

        $topBarangays = $this->field
            ->select('field_address, SUM(field_total_area) as total_area')
            ->groupBy('field_address')
            ->orderBy('total_area', 'DESC')
            ->limit(10)
            ->findAll();

        $barangayNames = array_column($topBarangays, 'field_address');
        $totalAreas = array_column($topBarangays, 'total_area');


        $chartData = [
            'labels' => $barangayNames,
            'datasets' => [
                [
                    'label' => 'Total Field Area',
                    'backgroundColor' => ['rgb(250, 208, 92)', 'rgb(136, 196, 49)'],
                    'borderWidth' => 1,
                    'data' => $totalAreas,
                ],
            ],
        ];
        $cropVarietyCount = $this->planting
            ->select('crop_variety, COUNT(crop_variety) as variety_count')
            ->groupBy('crop_variety')
            ->orderBy('variety_count', 'DESC')
            ->limit(10)
            ->findAll();

        $varietyNames = array_column($cropVarietyCount, 'crop_variety');
        $varietyCounts = array_column($cropVarietyCount, 'variety_count');

        $chartData2 = [
            'labels' => $varietyNames,
            'datasets' => [
                [
                    'label' => 'Number of Crop Varieties',
                    'backgroundColor' => 'rgb(250, 208, 92)',
                    'borderColor' => 'rgb(250, 208, 92)',
                    'borderWidth' => 1,
                    'data' => $varietyCounts,
                ],
            ],
        ];

        $damageCounts = $this->damages
            ->select('pest_type, COUNT(*) as count')
            ->groupBy('pest_type')
            ->findAll();

        $pestTypes = array_column($damageCounts, 'pest_type');
        $damageCountsData = array_column($damageCounts, 'count');

        $chartData3 = [
            'labels' => $pestTypes,
            'datasets' => [
                [
                    'label' => 'Number of Damages',
                    'backgroundColor' => 'rgb(250, 108, 92)',
                    'borderColor' => 'rgb(250, 108, 92)',
                    'borderWidth' => 1,
                    'data' => $damageCountsData,
                ],
            ],
        ];
        $weatherEventCounts = $this->damages
            ->select('weather_events, COUNT(*) as count')
            ->groupBy('weather_events')
            ->findAll();

        $weatherEvents = array_column($weatherEventCounts, 'weather_events');
        $weatherEventCountsData = array_column($weatherEventCounts, 'count');

        $chartData4 = [
            'labels' => $weatherEvents,
            'datasets' => [
                [
                    'label' => 'Number of Damages',
                    'backgroundColor' => 'rgb(92, 182, 250)',
                    'borderColor' => 'rgb(92, 182, 250)',
                    'borderWidth' => 1,
                    'data' => $weatherEventCountsData,
                ],
            ],
        ];
        $harvestData = $this->harvest
            ->select('harvest_date, harvest_quantity')
            ->findAll();

        $harvestDates = array_column($harvestData, 'harvest_date');
        $harvestQuantities = array_column($harvestData, 'harvest_quantity');

        $chartData6 = [
            'labels' => $harvestDates,
            'datasets' => [
                [
                    'label' => 'Harvest Quantity',
                    'backgroundColor' => 'rgb(54, 162, 235)',
                    'borderColor' => 'rgb(54, 162, 235)',
                    'data' => $harvestQuantities,
                ],
            ],
        ];
        $data = [
            'chartData' => $chartData,
            'chartData2' => $chartData2,
            'chartData3' => $chartData3,
            'chartData4' => $chartData4,
            'chartData6' => $chartData6,
        ];
        return view('adminfolder/viewcharts', $data);
    }

    public function userreports()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'reports' => $this->reports->where('user_id', $userId)->findAll()
            ];
            return view('userfolder/userreports', $data);
        }
    }
    public function addnewuserreport()
    {
        $userId = session()->get('leader_id');
        $reportId = $this->request->getPost('report_id');
        $reports = $this->reports->find($reportId);
        $images = $this->request->getFile('images');
        $imagesName = $images->getRandomName();
        $images->move(ROOTPATH . 'public/uploads/report_img/', $imagesName);


        $this->reports->save([
            'report_id' => $this->request->getPost('report_id'),
            'title' => $this->request->getPost('title'),
            'images' => 'uploads/report_img/' . $imagesName,
            'description' => $this->request->getPost('description'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/userreports')->with('success', 'Report submitted successfully');
    }

    public function edituserreport($report_id)
    {
        $reports = $this->reports->find($report_id);

        return view('userreports', ['reports' => $reports]);
    }
    public function updateuserreport()
    {
        $report_id = $this->request->getPost('report_id');

        $dataToUpdate = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        $img = $this->request->getFile('images');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move('uploads/', $imgName);
            $dataToUpdate['images'] = 'uploads/' . $imgName;
        }

        $this->reports->update($report_id, $dataToUpdate);

        return redirect()->to('/userreports')->with('success', 'Report updated successfully');
    }

    public function deleteuserreport($report_id)
    {
        $reports = $this->reports->find($report_id);

        if ($reports) {
            $this->reports->delete($report_id);
            return redirect()->to('/userreports')->with('success', 'Report deleted successfully');
        } else {
            return redirect()->to('/userreports')->with('error', 'Report not found');
        }
    }
    public function userreportsreadmore($report_id)
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

    public function usertrainings()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'trainings' => $this->trainings->where('user_id', $userId)->findAll()
            ];
            return view('userfolder/usertrainings', $data);
        }
    }
    public function addusertrainings()
    {
        $userId = session()->get('leader_id');
        $trainingId = $this->request->getPost('training_id');
        $trainings = $this->trainings->find($trainingId);
        $image_training = $this->request->getFile('image_training');
        $image_trainingName = $image_training->getRandomName();
        $image_training->move(ROOTPATH . 'public/uploads/training_img/', $image_trainingName);

        $this->trainings->save([
            'training_id' => $this->request->getPost('training_id'),
            'image_training' => 'uploads/training_img/' . $image_trainingName,
            'event_title' => $this->request->getPost('event_title'),
            'date' => $this->request->getPost('date'),
            'time' => $this->request->getPost('time'),
            'speaker' => $this->request->getPost('speaker'),
            'place' => $this->request->getPost('place'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/usertrainings')->with('success', 'Trainings or Seminars added successfully');
    }
    public function editusertraining($training_id)
    {
        $trainings = $this->trainings->find($training_id);

        return view('trainings', ['trainings' => $trainings]);
    }
    public function updateusertraining()
    {

        $training_id = $this->request->getPost('training_id');

        $dataToUpdate = [
            'event_title' => $this->request->getPost('event_title'),
            'date' => $this->request->getPost('date'),
            'time' => $this->request->getPost('time'),
            'speaker' => $this->request->getPost('speaker'),
            'place' => $this->request->getPost('place'),
            'validity_training' => $this->request->getPost('validity_training'),
        ];

        $this->trainings->update($training_id, $dataToUpdate);

        return redirect()->to('/usertrainings')->with('success', 'Trainings or Seminars updated successfully');
    }
    public function deleteusertraining($training_id)
    {

        $trainings = $this->trainings->find($training_id);

        if ($trainings) {
            $this->trainings->delete($training_id);
            return redirect()->to('/usertrainings')->with('success', 'Trainings or Seminars deleted successfully');
        } else {
            return redirect()->to('/usertrainings')->with('error', 'Trainings or Seminars not found');
        }
    }

    //admintrivias
    public function adtrivias()
    {
        $userId = session()->get('id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'trivia' => $this->trivia->where('user_id', $userId)->findAll()
            ];
            return view('adminfolder/adtrivias', $data);
        }
    }

    public function addnewtrivia()
    {
        $userId = session()->get('id');
        $triviaId = $this->request->getPost('trivia_id');
        $trivia = $this->trivia->find($triviaId);

        $image = $this->request->getFile('image');
        $imageName = $image->getRandomName();
        $image->move(ROOTPATH . 'public/uploads/trivia_img/', $imageName);

        $this->trivia->save([
            'trivia_id' => $this->request->getPost('trivia_id'),
            'image' => 'uploads/trivia_img/' . $imageName,
            'triviatitle' => $this->request->getPost('triviatitle'),
            'trivia' => $this->request->getPost('trivia'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/adtrivias')->with('success', 'Trivia added successfully');
        //var_dump($image);
    }

    public function edittrivia($trivia_id)
    {
        $trivia = $this->trivia->find($trivia_id);

        return view('trivia', ['trivia' => $trivia]);
    }
    public function updatetrivia()
    {

        $trivia_id = $this->request->getPost('trivia_id');

        $dataToUpdate = [
            'triviatitle' => $this->request->getPost('triviatitle'),
            'trivia' => $this->request->getPost('trivia'),
        ];

        $this->trivia->update($trivia_id, $dataToUpdate);

        return redirect()->to('/adtrivias')->with('success', 'Trivia updated successfully');
    }
    public function deletetrivia($trivia_id)
    {

        $trivia = $this->trivia->find($trivia_id);

        if ($trivia) {
            $this->trivia->delete($trivia_id);
            return redirect()->to('/adtrivias')->with('success', 'Trivia deleted successfully');
        } else {
            return redirect()->to('/adtrivias')->with('error', 'Trivia not found');
        }
    }

    //adminreports
    public function adreports()
    {
        $userId = session()->get('id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        } else {
            $data = [
                'reports' => $this->reports->findAll()
            ];
            return view('adminfolder/adreports', $data);
        }
    }
    public function addnewreport()
    {
        $userId = session()->get('id');
        $reportId = $this->request->getPost('report_id');
        $reports = $this->reports->find($reportId);
        $images = $this->request->getFile('images');
        $imagesName = $images->getRandomName();
        $images->move(ROOTPATH . 'public/uploads/report_img/', $imagesName);


        $this->reports->save([
            'report_id' => $this->request->getPost('report_id'),
            'title' => $this->request->getPost('title'),
            'images' => 'uploads/report_img/' . $imagesName,
            'description' => $this->request->getPost('description'),
            'validity' => $this->request->getPost('validity'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/adreports')->with('success', 'Report submitted successfully');
    }
    public function editreport($report_id)
    {
        $reports = $this->reports->find($report_id);

        return view('adreports', ['reports' => $reports]);
    }

    public function updatereport()
    {
        $report_id = $this->request->getPost('report_id');

        $dataToUpdate = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'validity' => $this->request->getPost('validity'),
        ];
        $img = $this->request->getFile('images');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move('uploads/', $imgName);
            $dataToUpdate['images'] = 'uploads/' . $imgName;
        }
        $this->reports->update($report_id, $dataToUpdate);

        return redirect()->to('/adreports')->with('success', 'Report updated successfully');
    }

    public function deletereport($report_id)
    {

        $reports = $this->reports->find($report_id);

        if ($reports) {
            $this->reports->delete($report_id);
            return redirect()->to('/adreports')->with('success', 'Report deleted successfully');
        } else {
            return redirect()->to('/adreports')->with('error', 'Report not found');
        }
    }

    //admintrainings
    public function adtrainings()
    {
        $userId = session()->get('id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        } else {
            $data = [
                'trainings' => $this->trainings->where('user_id', $userId)->findAll()
            ];
            return view('adminfolder/adtrainings', $data);
        }
    }
    public function addnewtraining()
    {
        $userId = session()->get('id');
        $trainingId = $this->request->getPost('training_id');
        $trainings = $this->trainings->find($trainingId);
        $image_training = $this->request->getFile('image_training');
        $image_trainingName = $image_training->getRandomName();
        $image_training->move(ROOTPATH . 'public/uploads/training_img/', $image_trainingName);

        $this->trainings->save([
            'training_id' => $this->request->getPost('training_id'),
            'image_training' => 'uploads/training_img/' . $image_trainingName,
            'event_title' => $this->request->getPost('event_title'),
            'date' => $this->request->getPost('date'),
            'time' => $this->request->getPost('time'),
            'speaker' => $this->request->getPost('speaker'),
            'place' => $this->request->getPost('place'),
            'validity_training' => $this->request->getPost('validity_training'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/adtrainings')->with('success', 'Trainings or Seminars added successfully');
    }

    public function edittraining($training_id)
    {
        $trainings = $this->trainings->find($training_id);

        return view('trainings', ['trainings' => $trainings]);
    }
    public function updatetraining()
    {

        $training_id = $this->request->getPost('training_id');

        $dataToUpdate = [
            'event_title' => $this->request->getPost('event_title'),
            'date' => $this->request->getPost('date'),
            'time' => $this->request->getPost('time'),
            'speaker' => $this->request->getPost('speaker'),
            'place' => $this->request->getPost('place'),
            'validity_training' => $this->request->getPost('validity_training'),
        ];

        $this->trainings->update($training_id, $dataToUpdate);

        return redirect()->to('/adtrainings')->with('success', 'Trainings or Seminars updated successfully');
    }
    public function deletetraining($training_id)
    {

        $trainings = $this->trainings->find($training_id);

        if ($trainings) {
            $this->trainings->delete($training_id);
            return redirect()->to('/adtrainings')->with('success', 'Trainings or Seminars deleted successfully');
        } else {
            return redirect()->to('/adtrainings')->with('error', 'Trainings or Seminars not found');
        }
    }

    //usertrivias
    public function usertrivias()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'trivia' => $this->trivia->findAll()
            ];
            return view('userfolder/usertrivias', $data);
        }
    }

    //userpest
    public function userpest()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'pest' => $this->pest->findAll()
            ];
            return view('userfolder/userpest', $data);
        }
    }

    //userdisease
    public function userdisease()
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'disease' => $this->disease->findAll()
            ];
            return view('userfolder/userdisease', $data);
        }
    }

    //adminpest
    public function adpest()
    {
        $userId = session()->get('id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signinadmin');
        } else {
            $data = [
                'pest' => $this->pest->where('user_id', $userId)->findAll()
            ];
            return view('adminfolder/adpest', $data);
        }
    }

    public function addnewpest()
    {
        $userId = session()->get('id');
        $pestId = $this->request->getPost('pest_id');
        $pest = $this->pest->find($pestId);

        $pest_image = $this->request->getFile('pest_image');
        $pest_imageName = $pest_image->getRandomName();
        $pest_image->move(ROOTPATH . 'public/uploads/pest_img/', $pest_imageName);

        $this->pest->save([
            'pest_id' => $this->request->getPost('pest_id'),
            'pest_image' => 'uploads/pest_img/' . $pest_imageName,
            'pest_name' => $this->request->getPost('pest_name'),
            'pest_type' => $this->request->getPost('pest_type'),
            'pest_desc' => $this->request->getPost('pest_desc'),
            'pest_solutions' => $this->request->getPost('pest_solutions'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/adpest')->with('success', 'pest added successfully');
        //var_dump($image);
    }

    public function editpest($pest_id)
    {
        $pest = $this->pest->find($pest_id);

        return view('pest', ['pest' => $pest]);
    }
    public function updatepest()
    {

        $pest_id = $this->request->getPost('pest_id');

        $dataToUpdate = [
            'pest_id' => $this->request->getPost('pest_id'),
            //'pest_image' => 'uploads/pest_img/' . $pest_imageName,
            'pest_name' => $this->request->getPost('pest_name'),
            'pest_type' => $this->request->getPost('pest_type'),
            'pest_desc' => $this->request->getPost('pest_desc'),
            'pest_solutions' => $this->request->getPost('pest_solutions'),
        ];

        $this->pest->update($pest_id, $dataToUpdate);

        return redirect()->to('/adpest')->with('success', 'pest updated successfully');
    }
    public function deletepest($pest_id)
    {

        $pest = $this->pest->find($pest_id);

        if ($pest) {
            $this->pest->delete($pest_id);
            return redirect()->to('/adpest')->with('success', 'pest deleted successfully');
        } else {
            return redirect()->to('/adpest')->with('error', 'pest not found');
        }
    }

    //admindisease
    public function addisease()
    {
        $userId = session()->get('id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'disease' => $this->disease->where('user_id', $userId)->findAll()
            ];
            return view('adminfolder/addisease', $data);
        }
    }

    public function addnewdisease()
    {
        $userId = session()->get('id');
        $diseaseId = $this->request->getPost('disease_id');
        $disease = $this->disease->find($diseaseId);

        $dis_image = $this->request->getFile('dis_image');
        $dis_imageName = $dis_image->getRandomName();
        $dis_image->move(ROOTPATH . 'public/uploads/dis_img/', $dis_imageName);

        $this->disease->save([
            'dis_id' => $this->request->getPost('dis_id'),
            'dis_image' => 'uploads/dis_img/' . $dis_imageName,
            'dis_name' => $this->request->getPost('dis_name'),
            'dis_type' => $this->request->getPost('dis_type'),
            'dis_desc' => $this->request->getPost('dis_desc'),
            'dis_solutions' => $this->request->getPost('dis_solutions'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/addisease')->with('success', 'disease added successfully');
        //var_dump($image);
    }

    public function editdisease($disease_id)
    {
        $disease = $this->disease->find($disease_id);

        return view('disease', ['disease' => $disease]);
    }
    public function updatedisease()
    {

        $disease_id = $this->request->getPost('disease_id');

        $dataToUpdate = [
            'disease_id' => $this->request->getPost('disease_id'),
            //'dis_image' => 'uploads/disease_img/' . $dis_imageName,
            'dis_name' => $this->request->getPost('dis_name'),
            'dis_type' => $this->request->getPost('dis_type'),
            'dis_desc' => $this->request->getPost('dis_desc'),
            'dis_solutions' => $this->request->getPost('dis_solutions'),
        ];

        $this->disease->update($disease_id, $dataToUpdate);

        return redirect()->to('/addisease')->with('success', 'disease updated successfully');
    }
    public function deletedisease($disease_id)
    {

        $disease = $this->disease->find($disease_id);

        if ($disease) {
            $this->disease->delete($disease_id);
            return redirect()->to('/addisease')->with('success', 'disease deleted successfully');
        } else {
            return redirect()->to('/addisease')->with('error', 'disease not found');
        }
    }

    //pdf

    public function exportToPDF()
    {
        $fields = $this->field->findAll();

        $pdf = new MYPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Naujan Municipal Agriculture Office');
        $pdf->SetTitle('Field Data');
        $pdf->SetSubject('Field Data');
        $pdf->SetKeywords('TCPDF, PDF, field, data');

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 10);

        $html = '
        <br><br><br><br><br><br><br><br>
            <h1 style="text-align: center;">Field Data</h1>
            <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <th style="border: 1px solid black;"><b>Pangalan ng Magbubukid</b></th>
                <th style="border: 1px solid black;"><b>Pangalan ng Bukid</b></th>
                <th style="border: 1px solid black;"><b>May-ari ng Lupa</b></th>
                <th style="border: 1px solid black;"><b>Address ng Bukid</b></th>
                <th style="border: 1px solid black;"><b>Kabuuang Sukat</b></th>
            </tr>
        </thead>
                <tbody>';


        foreach ($fields as $field) {
            $html .= '<tr>
            <td style="border: 1px solid black;">' . htmlspecialchars($field['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($field['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($field['field_owner'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($field['field_address'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($field['field_total_area'], ENT_QUOTES, 'UTF-8') . '</td>
          </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('field_data.pdf', 'D');
        exit();
    }
    public function exportToPDFplanting()
    {
        $plantings = $this->planting->findAll();

        $pdf = new MYPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Naujan Municipal Agriculture Office');
        $pdf->SetTitle('Cultivation Data');
        $pdf->SetSubject('Field Data');
        $pdf->SetKeywords('TCPDF, PDF, planting, data');

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 10);

        $html = '
        <br><br><br><br><br><br><br><br><br>
            <h1 style="text-align: center;">Cultivation Data</h1>
            
            <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <th style="border: 1px solid black; text-align: center;" ><b>Pangalan ng Magbubukid</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>FIMS Code</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Pangalan ng Bukid</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Address ng Bukid</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Variety</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Araw ng Pagtatanim</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Season</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Simula ng Pagsasaka</b></th>
            </tr>
        </thead>
                <tbody>';


        foreach ($plantings as $planting) {
            $html .= '<tr>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['fims_code'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['field_address'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['crop_variety'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['planting_date'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['season'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($planting['start_date'], ENT_QUOTES, 'UTF-8') . '</td>
          </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('planting_data.pdf', 'D');
        exit();
    }
    public function exportToPDFexpenses()
    {
        $expenses = $this->expense->findAll();

        $pdf = new MYPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Naujan Municipal Agriculture Office');
        $pdf->SetTitle('Expenses Data');
        $pdf->SetSubject('Expenses Data');
        $pdf->SetKeywords('TCPDF, PDF, expense, data');

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 10);

        $html = '
        <br><br><br><br><br><br><br><br><br>
            <h1 style="text-align: center;">Expenses Data</h1>
            
            <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
        <thead>
            <tr>
                <th style="border: 1px solid black; text-align: center;" ><b>Pangalan ng Magbubukid</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>FIMS Code</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Pangalan ng Bukid</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Usage</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Completion Date</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Total Money Spent</b></th>
                <th style="border: 1px solid black; text-align: center;"><b>Notes</b></th>
            </tr>
        </thead>
                <tbody>';


        foreach ($expenses as $expense) {
            $html .= '<tr>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['fims_code'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['expense_name'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['finished_date'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['total_money_spent'], ENT_QUOTES, 'UTF-8') . '</td>
            <td style="border: 1px solid black;">' . htmlspecialchars($expense['notes'], ENT_QUOTES, 'UTF-8') . '</td>
          </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('expense_data.pdf', 'D');
        exit();
    }
    public function exportToPDFdamage()
    {
        $filter = $this->request->getGet('filter');

        if ($filter == 'pest') {
            $damages = $this->damages->where('damage_type', 'Pest Disease')->findAll();
        } elseif ($filter == 'weather') {
            $damages = $this->damages->where('damage_type', 'Weather Related')->findAll();
        } else {
            $damages = $this->damages->findAll();
        }

        $pdf = new MYPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Naujan Municipal Agriculture Office');
        $pdf->SetTitle('Damage Data');
        $pdf->SetSubject('Damage Data');
        $pdf->SetKeywords('TCPDF, PDF, damage, data');

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 10);

        $html = '<br><br><br><br><br><br><br><br><br><h1 style="text-align: center;">Damage Data</h1>';

        if ($filter == 'pest') {
            $html .= '
            <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; text-align: center;">Pangalan ng Magbubukid</th>
                        <th style="border: 1px solid black; text-align: center;">Pangalan ng Bukid</th>
                        <th style="border: 1px solid black; text-align: center;">Address ng Bukid</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Pananim</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Peste</th>
                        <th style="border: 1px solid black; text-align: center;">Tindi ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Sintomas</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Ginawang Hakbang</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($damages as $dam) {
                $html .= '<tr>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['field_address'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['crop_variety'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_type'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['pest_type'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['severity'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['symptoms'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['actions'], ENT_QUOTES, 'UTF-8') . '</td>
              </tr>';
            }
        } elseif ($filter == 'weather') {
            $html .= '
            <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; text-align: center;">Pangalan ng Magbubukid</th>
                        <th style="border: 1px solid black; text-align: center;">Pangalan ng Bukid</th>
                        <th style="border: 1px solid black; text-align: center;">Address ng Bukid</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Pananim</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Pangyayari sa Panahon</th>
                        <th style="border: 1px solid black; text-align: center;">Paglalarawan ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Tindi ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Paraan ng Pag-iwas</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($damages as $dam) {
                $html .= '<tr>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['field_address'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['crop_variety'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_type'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['weather_events'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_descriptions'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_severity'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['mitigation_measures'], ENT_QUOTES, 'UTF-8') . '</td>
              </tr>';
            }
        } else {
            $html .= '
            <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; text-align: center;">Pangalan ng Magbubukid</th>
                        <th style="border: 1px solid black; text-align: center;">Pangalan ng Bukid</th>
                        <th style="border: 1px solid black; text-align: center;">Address ng Bukid</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Pananim</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Uri ng Peste</th>
                        <th style="border: 1px solid black; text-align: center;">Tindi ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Sintomas</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Ginawang Hakbang</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Pangyayari sa Panahon</th>
                        <th style="border: 1px solid black; text-align: center;">Paglalarawan ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Tindi ng Pinsala</th>
                        <th style="border: 1px solid black; text-align: center;">Mga Paraan ng Pag-iwas</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($damages as $dam) {
                $html .= '<tr>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['field_address'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['crop_variety'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_type'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['pest_type'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['severity'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['symptoms'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['actions'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['weather_events'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_descriptions'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['damage_severity'], ENT_QUOTES, 'UTF-8') . '</td>
                <td style="border: 1px solid black;">' . htmlspecialchars($dam['mitigation_measures'], ENT_QUOTES, 'UTF-8') . '</td>
              </tr>';
            }
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('damage_data.pdf', 'D');

        exit();
    }
    public function exportToPDFharvest()
    {
        $harvests = $this->harvest->findAll();

        $pdf = new MYPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Naujan Municipal Agriculture Office');
        $pdf->SetTitle('Harvest Data');
        $pdf->SetSubject('Harvest Data');
        $pdf->SetKeywords('TCPDF, PDF, harvest, data');

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 10);

        $html = '
    <br><br><br><br><br><br><br><br><br>
        <h1 style="text-align: center;">Harvest Data</h1>
        
        <table style="border-collapse: collapse; width: 100%;" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th style="border: 1px solid black; text-align: center;"><b>Pangalan ng Magbubukid</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>FIMS Code</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>Pangalan ng Bukid</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>Variety Name</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>Harvest Quantity</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>Total Revenue</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>Harvest Date</b></th>
            <th style="border: 1px solid black; text-align: center;"><b>Notes</b></th>
        </tr>
    </thead>
            <tbody>';

        foreach ($harvests as $harvest) {
            $html .= '<tr>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['farmer_name'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['fims_code'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['field_name'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['variety_name'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['harvest_quantity'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['total_revenue'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['harvest_date'], ENT_QUOTES, 'UTF-8') . '</td>
        <td style="border: 1px solid black;">' . htmlspecialchars($harvest['notes'], ENT_QUOTES, 'UTF-8') . '</td>
      </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('harvest_data.pdf', 'D');
        exit();
    }
    public function showFieldDetails($field_id)
    {
        $userId = session()->get('leader_id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $plantingDetails = $this->planting->where('field_id', $field_id)->findAll();
            $expensesDetails = $this->expense->where('field_id', $field_id)->findAll();
            $harvestDetails = $this->harvest->where('field_id', $field_id)->findAll();

            $field = $this->field->find($field_id);

            if (!$field) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Field not found');
            }


            $data = [
                'field' => $field,
                'plantingDetails' => $plantingDetails,
                'expensesDetails' => $expensesDetails,
                'harvestDetails' => $harvestDetails,

            ];

            return view('userfolder/showfielddata', $data);
        }
    }
    public function addis()
    {
        $userId = session()->get('id');
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign_ins');
        } else {
            $data = [
                'dis' => $this->dis->where('user_id', $userId)->findAll()
            ];
            return view('userfolder/cropplanting', $data);
        }
    }
    public function addnewdis()
    {
        $userId = session()->get('leader_id');
        $fieldId = $this->request->getPost('field_id');
        $plantingId = $this->request->getPost('planting_id');
        $fieldAddress = $this->request->getPost('field_address');
        $fieldName = $this->request->getPost('field_name');
        $cropVariety = $this->request->getPost('crop_variety');
        $farmerName = $this->request->getPost('farmer_name');
        $fimsCode = $this->request->getPost('fims_code');
        $planting = $this->planting->find($fieldId);
        $validation = $this->validate([
            'field_name' => 'required',
        ]);
        if (!$validation) {
            return view('userfolder/croplanting', ['validation' => $this->validator]);
        }
        $dis_image = $this->request->getFile('dis_image');
        $dis_imageName = $dis_image->getRandomName();
        $dis_image->move(ROOTPATH . 'public/uploads/dis_img/', $dis_imageName);

        $this->dis->save([
            'field_id' => $fieldId,
            'planting_id' => $plantingId,
            'field_address' => $fieldAddress,
            'field_name' => $fieldName,
            'crop_variety' => $cropVariety,
            'user_id' => $userId,
            'farmer_name' => $farmerName,
            'fims_code' => $fimsCode,
            'dis_id' => $this->request->getPost('dis_id'),
            'dis_image' => 'uploads/dis_img/' . $dis_imageName,
            'dis_name' => $this->request->getPost('dis_name'),
            'dis_type' => $this->request->getPost('dis_type'),
            'dis_desc' => $this->request->getPost('dis_desc'),
            'dis_solutions' => $this->request->getPost('dis_solutions'),
            'user_id' => $userId,
        ]);

        return redirect()->to('/cropplanting')->with('success', 'disease added successfully');
        //var_dump($image);
    }
}
