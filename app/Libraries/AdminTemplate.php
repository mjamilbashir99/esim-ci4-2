<?php
namespace App\Libraries;

class AdminTemplate
{
    protected $layout = 'layouts/admin_default';

    public function render($view, $data = [])
    {
        $data['content'] = view($view, $data);
        return view($this->layout, $data);
    }
}
