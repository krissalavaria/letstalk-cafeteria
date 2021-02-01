<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Dashboard_model extends CI_Model
    {
        private $table = array(
            'user' => 'user_account',  
            'orderh' => 'orderhead',
            'orderl' => 'orderline',       
            'prod' => 'product',
            'cat' => 'product_category',
            'unit' => 'product_unit'
        );                

        public function __construct()
        {
            parent::__construct(); 
			$this->session = (object)get_userdata(USER);
			
			if(is_empty_object($this->session)){
				redirect(base_url().'dashboard/authentication', 'refresh');
			}
			$model_list = [               
            ];
            $this->load->model($model_list);
        }       
        
        public function get_confirmed_order(){
            $this->db->select(
                'oh.order_no,
                u.first_name,
                u.last_name
            ');
            $this->db->from($this->table['orderh'].' oh');
            $this->db->join($this->table['user'].' u','u.ID=oh.user_account_id');
            $this->db->where('oh.order_status_id', 1);
            return $this->db->get()->result();
        }

        public function get_reserved_order(){
            $this->db->select(
                'oh.order_no,
                u.first_name,
                u.last_name
            ');
            $this->db->from($this->table['orderh'].' oh');
            $this->db->join($this->table['user'].' u','u.ID=oh.user_account_id');
            $this->db->where('oh.order_status_id', 3);
            return $this->db->get()->result();
        }

        public function get_cancelled_order(){
            $this->db->select(
                'oh.order_no,
                u.first_name,
                u.last_name
            ');
            $this->db->from($this->table['orderh'].' oh');
            $this->db->join($this->table['user'].' u','u.ID=oh.user_account_id');
            $this->db->where('oh.order_status_id', 2);
            return $this->db->get()->result();
        }

        public function get_paid_order(){
            $this->db->select(
                'oh.order_no,
                u.first_name,
                u.last_name
            ');
            $this->db->from($this->table['orderh'].' oh');
            $this->db->join($this->table['user'].' u','u.ID=oh.user_account_id');
            $this->db->where('oh.order_status_id', 4);
            return $this->db->get()->result();
        }

        public function order_no($order_no){

            $this->db->select(
                'oh.order_no,
                p.product_name,
                c.product_category_name,
                u.unit_name,
                ol.qty,
                ol.product_price,
                ol.total_amount,
                ol.datetime_created,
                '
            );

            $this->db->from($this->table['orderh'].' oh');
            $this->db->join($this->table['orderl'].' ol','ol.order_no=oh.order_no', 'left');

            $this->db->join($this->table['prod'].' p','p.ID=ol.product_id', 'left');
            $this->db->join($this->table['cat'].' c','c.ID=ol.product_category_id', 'left');
            $this->db->join($this->table['unit'].' u','u.ID=ol.product_unit', 'left');
            
            $this->db->where('oh.order_no',$order_no);
            return $this->db->get()->result();
        }

        public function get_order_owner($order_no){
            $this->db->from($this->table['orderh'].' oh');
            $this->db->join($this->table['user'].' u','u.ID=oh.user_account_id', 'left');
            $this->db->where('oh.order_no',$order_no);
            return $this->db->get()->row();
        }

    }
?>