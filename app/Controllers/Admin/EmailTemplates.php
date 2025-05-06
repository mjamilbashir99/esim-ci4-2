<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmailTemplateModel;
use App\Libraries\AdminTemplate;

class EmailTemplates extends BaseController
{
    protected $template;
    protected $model; // You defined it as $model

    public function __construct()
    {
        // Admin login check
        if (!session()->get('admin_logged_in') || session()->get('admin_data')['is_admin'] != 1) {
            return redirect()->to('/admin/login');
        }

        $this->template = new AdminTemplate();
        $this->model = new EmailTemplateModel(); // Initialized as $model
    }

    /**
     * Show all email templates (main listing)
     */
    public function index()
    {
        $data = [
            'templates' => $this->model->orderBy('created_at', 'DESC')->findAll(), // Changed to $this->model
            'title' => 'Email Templates'
        ];

        return $this->template->render('Admin/email_templates/index', $data);
    }

    /**
 * Show create new template form
 */
public function create()
{
    $data = [
        'title' => 'Create New Template'
    ];

    return $this->template->render('Admin/email_templates/create', $data);
}

/**
 * Store new template
 */
public function store()
{
    $rules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'subject' => 'required|min_length[3]|max_length[255]',
        'content' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // Handle variables
    $variables = $this->request->getPost('variables');
    $variablesArray = [];

    if (is_array($variables)) {
        $variablesArray = $variables;
    } elseif (is_string($variables) && !empty($variables)) {
        $variablesArray = array_map('trim', explode(',', $variables));
        $variablesArray = array_filter($variablesArray);
    }

    $data = [
        'name' => $this->request->getPost('name'),
        'slug' => url_title($this->request->getPost('name')),
        'subject' => $this->request->getPost('subject'),
        'content' => $this->request->getPost('content'),
        'variables' => json_encode($variablesArray)
    ];

    try {
        $this->model->save($data);
        return redirect()->to('/admin/email-templates')
            ->with('success', 'Template created successfully.');
    } catch (\Exception $e) {
        // Log the actual error for admin/devs
        log_message('error', 'Template save failed: ' . $e->getMessage());

        // Show friendly message to user
        return redirect()->back()
            ->withInput()
            ->with('error', 'Something went wrong while saving the template. Please try again later.');
    }
}


    /**
     * Edit template form
     */
    public function edit($id)
    {
        $template = $this->model->find($id); // Changed to $this->model

        if (!$template) {
            return redirect()->to('/admin/email-templates')
                ->with('error', 'Template not found');
        }

        $data = [
            'template' => $template,
            'title' => 'Edit Template'
        ];

        return $this->template->render('Admin/email_templates/edit', $data);
    }

    /**
     * Update template
     */
    public function update($id)
{
    $template = $this->model->find($id);

    if (!$template) {
        return redirect()->to('/admin/email-templates')
            ->with('error', 'Template not found');
    }

    $rules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'subject' => 'required|min_length[3]|max_length[255]',
        'content' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $this->model->update($id, [
        'name' => $this->request->getPost('name'),
        'subject' => $this->request->getPost('subject'),
        'content' => $this->request->getPost('content')
    ]);

    return redirect()->to('/admin/email-templates')
        ->with('success', 'Template updated successfully');
}

    /**
     * Delete template
     */
    public function delete($id)
    {
        $template = $this->model->find($id); // Changed to $this->model

        if (!$template) {
            return redirect()->to('/admin/email-templates')
                ->with('error', 'Template not found');
        }

        $this->model->delete($id); // Changed to $this->model

        return redirect()->to('/admin/email-templates')
            ->with('success', 'Template deleted successfully');
    }
}