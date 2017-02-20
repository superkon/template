<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Cms_Controller {

    function __construct()
    {
		parent::__construct();
    }

	public function index()
	{
    redirect('module/page/edit/1','refresh');
    /*
		$this->page_content['page_title'] = lang("pagetitle_dashboard");
		//$this->page_content['content'] = lang("layout_dashboard");

		$this->content['content'] = lang("pagetitle_dashboard");
		$this->page_content['content'] = $this->load->view("general/dashboard", $this->content, true);
		return $this->load->view($this->template, $this->page_content);
    */
	}
}
