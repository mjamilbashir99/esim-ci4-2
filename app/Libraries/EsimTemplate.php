<?php
namespace App\Libraries;

class EsimTemplate
{
    protected $layout = 'layouts/esim_default';

    public function render($view, $data = [])
    {
        $data['session'] = session();
        $data['content'] = view($view, $data);
        return view($this->layout, $data);
    }
}
