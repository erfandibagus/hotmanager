<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
    }

    public function load($content, $data = null)
    {
        $data['_content'] = $this->_ci->load->view($content, $data, true);
        $this->_ci->load->view('template.php', $data);
    }
}
