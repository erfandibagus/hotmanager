<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mikrotik extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == FALSE) {
            redirect(base_url());
        }
    }

    public function reboot()
    {
        $this->system_model->reboot();
        redirect(base_url('auth/logout'));
    }

    public function shutdown()
    {
        $this->system_model->shutdown();
        redirect(base_url('auth/logout'));
    }

    public function setting()
    {
        $this->form_validation->set_rules('hotspot', 'hotspot', 'required');
        $this->form_validation->set_rules('dnsname', 'dnsname', 'required');
        if ($this->form_validation->run() == FALSE) {
            $checkdb = $this->data_model->check();
            if ($checkdb == true) {
                $data['setting'] = $this->data_model->read();
                $this->template->load('setting', $data);
            } else {
                $this->template->load('setting');
            }
        } else {
            $create = $this->data_model->create();
            if ($create == true) {
                $query = $this->data_model->write();
                if ($query == true) {
                    redirect(base_url('hotspot'));
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
                    redirect(base_url('mikrotik/setting'));
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
                redirect(base_url('mikrotik/setting'));
            }
        }
    }

    public function update_setting()
    {
        $query = $this->data_model->update();
        if ($query == true) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
            redirect(base_url('mikrotik/setting'));
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
            redirect(base_url('mikrotik/setting'));
        }
    }
}
