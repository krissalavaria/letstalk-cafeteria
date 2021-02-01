<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	

	private $data = [];
	protected $session;
    public function __construct()
	{
		parent::__construct(); 
		$this->session = (object)get_userdata(USER);
		
		if(is_empty_object($this->session)){
			redirect(base_url().'dashboard/authentication', 'refresh');
		}

		$model_list = [
			'dashboard/Dashboard_model' => 'dModel'			
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['session'] =  $this->session;		        
		$this->data['content'] = 'index';
		$this->load->view('layout',$this->data);
	}	

	public function get_confirmed_order(){
		$this->data['data'] =  $this->dModel->get_confirmed_order();	        
		$this->data['content'] = 'grid/confirmed_order_grid';
		$this->load->view('layout',$this->data);
	}
	
	public function get_reserved_order(){
		$this->data['data'] =  $this->dModel->get_reserved_order();	        
		$this->data['content'] = 'grid/reserved_order_grid';
		$this->load->view('layout',$this->data);
	}

	public function get_cancelled_order(){
		$this->data['data'] =  $this->dModel->get_cancelled_order();	        
		$this->data['content'] = 'grid/reserved_order_grid';
		$this->load->view('layout',$this->data);
	}

	public function get_paid_order(){
		$this->data['data'] =  $this->dModel->get_paid_order();	        
		$this->data['content'] = 'grid/paid_order_grid';
		$this->load->view('layout',$this->data);
	}

	public function open_order(){
		
		$this->data['owner'] = $this->dModel->get_order_owner($this->input->get('order-no'));   
		$this->data['order'] = $this->dModel->order_no($this->input->get('order-no'));   
		$this->data['content'] = 'open';
		$this->load->view('layout',$this->data);   	
	}


}
