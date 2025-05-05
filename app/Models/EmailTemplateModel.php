<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailTemplateModel extends Model
{
    protected $table            = 'email_templates';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'slug', 'subject', 'content', 'variables'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // protected array $casts = [
    //     'variables' => 'json-array'  // Changed from 'json' to 'json-array'
    // ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'    => 'required|min_length[3]|max_length[255]',
        'slug'    => 'required|alpha_dash|is_unique[email_templates.slug,id,{id}]',
        'subject' => 'required|min_length[3]|max_length[255]',
        'content' => 'required'
    ];
    
    protected $validationMessages   = [
        'name' => [
            'required' => 'Template name is required',
            'min_length' => 'Template name must be at least 3 characters',
            'max_length' => 'Template name cannot exceed 255 characters'
        ],
        'slug' => [
            'is_unique' => 'This template slug is already in use'
        ]
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['generateSlug'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Automatically generate slug from name if not provided
     */
    protected function generateSlug(array $data)
    {
        if (!isset($data['data']['slug']) || empty($data['data']['slug'])) {
            helper('text');
            $data['data']['slug'] = url_title(
                convert_accented_characters($data['data']['name']),
                '-',
                true
            );
        }
        return $data;
    }
}