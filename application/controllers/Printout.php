<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Printout extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') == FALSE) {
			redirect(base_url());
		}
		if ($this->data_model->check() == FALSE) {
			redirect(base_url('mikrotik/setting'));
		}
	}

	public function index()
	{
		$by = $this->input->get('by');
		if ($by == 'users') {
			$data = [
				'data' => $this->data_model->read(),
				'prints' => $this->print_model->byUsers()
			];
		} else {
				$data = [
					'data' => $this->data_model->read(),
					'prints' => $this->print_model->byUser(urldecode($by))
				];
		}
		$this->load->view('print', $data);
	}
}
