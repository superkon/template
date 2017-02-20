<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    function __construct()
    {
        parent::__construct();

		$this->load->model('user_model');
		$this->page_content['page_title'] = lang("pagetitle_login");

		$this->load->model('log_model');
		$this->log_model->setModule("Login");
    }

	function index()
	{
		$this->error_msg = "";
		if ($this->session->userdata('login') != ""){
			redirect('dashboard','refresh');
		}

		if ($this->input->post()){
			$this->form_validation->set_error_delimiters('<p>', '</p>');
			$this->form_validation->set_rules('login', lang("login"), 'trim|required|min_length[5]');
			$this->form_validation->set_rules('password', lang("password") , 'trim|required|min_length[5]');

			if ($this->form_validation->run() == FALSE){
				$this->error_msg = validation_errors();
			}else{
				$login = $this->input->post('login');
				$password = $this->input->post('password');

				if ($this->user_model->checkLogin($login, $password)){
					//login success

					//** Logging *********************************************************************************************************
					$this->log_model->addLog(0, "Success");
					//********************************************************************************************************************

					return redirect('dashboard','refresh');
					exit();
				}else{
					$this->error_msg = lang("wrong_username_password");

					//** Logging *********************************************************************************************************
					$this->log_model->addLog(0, "Failure", "", "Login:" . $login);
					//********************************************************************************************************************
				}
			}
		}


		$this->page_content['content'] = $this->load->view('general/login', array(), true);
		return $this->load->view($this->template, $this->page_content);
	}

	function logout(){

		//** Logging *********************************************************************************************************
		$this->log_model->addLog(0, "Logout");
		//********************************************************************************************************************

		$this->session->set_userdata('login', '');
		$this->session->set_userdata('login_name', '');

		redirect('login','refresh');

	}

	/*
	function login(){
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

		 if ($this->form_validation->run() == FALSE)
		{
			return $this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(
					json_encode(
						array(
							"status"=>"0",
							"msg"=>validation_errors()
						)
					)
				);
		}
		else
		{
			$login = $this->input->post('login');
			$password = $this->input->post('password');

			if ($this->user_model->checkLogin($login, $password)){
				return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array("status"=>"1")));
			}else{
				return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(
						json_encode(
							array(
								"status"=>"0",
								"msg"=>"Wrong Username / password"
							)
						)
					);

			}
		}
	}
	*/
}
