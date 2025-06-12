<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'bookings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'user_id',
        'bundle_id',
        'esim_reference',
        'quantity',
        'total_price',
        'currency',
        'status',
        'created_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // not used
    protected $deletedField  = ''; // not used

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

    // ✅ Example: Get all esim bookings with user info
   public function getBookingsWithUser()
{
    return $this->db->table('bookings')
        ->select('bookings.*, users.name as user_name, users.email as user_email')
        ->join('users', 'users.id = bookings.user_id', 'left')
        ->orderBy('bookings.id', 'DESC')
        ->get()
        ->getResultArray();
}
}
