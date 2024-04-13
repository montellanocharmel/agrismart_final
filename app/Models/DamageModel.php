<?php

namespace App\Models;

use CodeIgniter\Model;

class DamageModel extends Model
{
    protected $table            = 'damages';
    protected $primaryKey       = 'damage_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['damage_id', 'field_id', 'field_name', 'field_address', 'farmer_name', 'fims_code', 'crop_variety', 'damage_type', 'pest_type', 'severity', 'symptoms', 'actions', 'weather_events', 'damage_descriptions', 'damage_severity', 'mitigation_measures', 'user_id'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
