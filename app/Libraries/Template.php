<?php
namespace App\Libraries;

class Template
{
    protected $layout = 'layouts/default';

    public function render($view, $data = [])
    {
        $data['content'] = view($view, $data);
        
        return view($this->layout, $data);
    }
}
