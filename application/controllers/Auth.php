<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PEAR2\Net\RouterOS;

class Auth extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect(base_url('hotspot'));
		} else {
			$this->form_validation->set_rules('ip', 'ip', 'required');
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->template->load('login');
			} else {
				try {
					new RouterOS\Client($this->input->post('ip', true), $this->input->post('username', true), $this->input->post('password', true));
					$data = [
						'ip'		=> $this->input->post('ip', true),
						'username'	=> $this->input->post('username', true),
						'password'	=> $this->input->post('password', true),
						'logged_in'	=> TRUE
					];
					$this->session->set_userdata($data);
					$checkdb = $this->data_model->check();
					if ($checkdb == true) {
						redirect(base_url('hotspot'));
					} else {
						redirect(base_url('mikrotik/setting'));
					}
				} catch (Exception $e) {
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Could not connect to Mikrotik router!</div>');
					redirect(base_url());
				}
			}
		}
	}

	public function logout()
	{
		$data = array('ip', 'username', 'password', 'logged_in');
		$this->session->unset_userdata($data);
		redirect(base_url());
	}
}
