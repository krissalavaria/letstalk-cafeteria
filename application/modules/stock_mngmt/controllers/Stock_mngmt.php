<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_mngmt extends MY_Controller {
	

	private $data = [];
	protected $session;
    public function __construct()
	{
		parent::__construct(); 
		$this->session = (object)get_userdata(USER);
		
		if(is_empty_object($this->session)){
			redirect(base_url().'login/authentication', 'refresh');
		}

		$model_list = [
			// 'product_mngnt/Product_mngnt_model' => 'pmodel'		
			'stock_mngmt/Stock_mngmt_model' => 'pmodel'			

		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		$this->data['session'] =  $this->session;	
		$this->data['prod_category'] = $this->pmodel->get_product_category();	
		$this->data['prod_unit'] = $this->pmodel->get_product_unit();	        
		$this->data['content'] = 'index';
		$this->load->view('layout',$this->data);
	}	

	public function get_product(){
		$this->data['prod'] = $this->pmodel->get_product();	    
		$this->data['content'] = 'grid/product_grid';
		$this->load->view('layout',$this->data);    
	}

}
