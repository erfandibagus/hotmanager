<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hotspot extends CI_Controller
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
		$data = [
			'resource' 		=> $this->system_model->resource(),
			'servers'		=> $this->hotspot_model->server(),
			'user_profile'	=> $this->hotspot_model->user_profiles(),
			'total_active' 	=> count($this->hotspot_model->active()),
			'total_users' 	=> count($this->hotspot_model->users()),
			'logs'			=> $this->hotspot_model->log()
		];
		$this->template->load('hotspot/home', $data);
	}

	public function user()
	{
		$data = [
			'servers'		=> $this->hotspot_model->server(),
			'user_profile'	=> $this->hotspot_model->user_profiles(),
			'users'			=> $this->hotspot_model->users()
		];
		$this->template->load('hotspot/user', $data);
	}

	public function user_add()
	{
		$query = $this->hotspot_model->user_add();
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user'));
		}
	}

	public function user_detail()
	{
		$id = $this->input->post('id', true);
		$data = $this->hotspot_model->user($id);
		echo json_encode($data);
	}

	public function user_update()
	{
		$id = $this->input->post('id', true);
		$query = $this->hotspot_model->user_update($id);
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user'));
		}
	}

	public function user_delete($id)
	{
		$query = $this->hotspot_model->user_delete(urldecode($id));
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user'));
		}
	}

	public function user_profile()
	{
		$data = [
			'user_profile' 	=> $this->hotspot_model->user_profiles(),
			'ip_pool' 		=> $this->system_model->ip_pool()
		];
		$this->template->load('hotspot/user_profile', $data);
	}

	public function user_profile_add()
	{
		$query = $this->hotspot_model->user_profile_add();
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user_profile'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user_profile'));
		}
	}

	public function user_profile_edit()
	{
		$id = $this->input->post('id', true);
		$data = $this->hotspot_model->user_profile($id);
		echo json_encode($data);
	}

	public function user_profile_update()
	{
		$id = $this->input->post('id', true);
		$query = $this->hotspot_model->user_profile_update($id);
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user_profile'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user_profile'));
		}
	}

	public function user_profile_delete($id)
	{
		$query = $this->hotspot_model->user_profile_delete(urldecode($id));
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user_profile'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user_profile'));
		}
	}

	public function active()
	{
		$data = [
			'active'	=> $this->hotspot_model->active(),
		];
		$this->template->load('hotspot/active', $data);
	}

	public function active_delete($id)
	{
		$query = $this->hotspot_model->active_delete(urldecode($id));
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/active'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/active'));
		}
	}

	public function host()
	{
		$data = [
			'host'	=> $this->hotspot_model->host(),
		];
		$this->template->load('hotspot/host', $data);
	}

	public function host_delete($id)
	{
		$query = $this->hotspot_model->host_delete(urldecode($id));
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/host'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/host'));
		}
	}

	public function ip_binding()
	{
		$data = [
			'ip_binding'	=> $this->hotspot_model->ip_binding(),
			'servers'		=> $this->hotspot_model->server(),
			'type'			=> ['regular', 'bypassed', 'blocked']
		];
		$this->template->load('hotspot/ip_binding', $data);
	}

	public function ip_binding_add()
	{
		$query = $this->hotspot_model->ip_binding_add();
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/ip_binding'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/ip_binding'));
		}
	}

	public function ip_binding_edit()
	{
		$id = $this->input->post('id', true);
		$data = $this->hotspot_model->binding($id);
		echo json_encode($data);
	}

	public function ip_binding_update()
	{
		$id = $this->input->post('id', true);
		$query = $this->hotspot_model->ip_binding_update($id);
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/ip_binding'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/ip_binding'));
		}
	}

	public function ip_binding_delete($id)
	{
		$query = $this->hotspot_model->ip_binding_delete(urldecode($id));
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/ip_binding'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/ip_binding'));
		}
	}

	public function user_generate()
	{
		$qty = $this->input->post('qty', true);
		$mode = $this->input->post('mode', true);
		$char = $this->input->post('character', true);
		$length = $this->input->post('length', true);

		if ($qty == 0 || $qty == NULL) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user'));
		} else {
			for ($x = 1; $x <= $qty; $x++) {
				$data = $this->user->generate($length, $char, $mode);
				$query = $this->hotspot_model->user_generate($data);
			}
		}

		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/user'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/user'));
		}
	}

	public function cookie()
	{
		$data['cookie'] = $this->hotspot_model->cookie();
		$this->template->load('hotspot/cookie', $data);
	}

	public function cookie_delete($id)
	{
		$query = $this->hotspot_model->cookie_delete(urldecode($id));
		if ($query) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Success</div>');
			redirect(base_url('hotspot/cookie'));
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Failed</div>');
			redirect(base_url('hotspot/cookie'));
		}
	}

	public function dhcp_lease()
	{
		$data['dhcp_lease'] = $this->system_model->ip_dhcp_lease();
		$this->template->load('dhcp_lease', $data);
	}
}
