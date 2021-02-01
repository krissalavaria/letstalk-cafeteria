<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Stock_mngmt_model extends CI_Model
    {
        private $table = array(
            'catg' => 'product_category',        
            'unit' => 'product_unit',
            'prod' => 'product',    
            'stck' => 'stock'  
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
        
        public function get_product_category(){
            $this->db->from($this->table['catg']);                      
            return $this->db->get()->result();  
        }

        public function get_product_unit(){
            $this->db->from($this->table['unit']);                      
            return $this->db->get()->result();  
        }

        public function get_product(){
            $this->db->select('
            p.*,
            c.*,
            u.*,
            s.*
            ');
            $this->db->from($this->table['stck'].' s');
            $this->db->join($this->table['prod'].' p', 's.product_id = p.ID', 'left');
            $this->db->join($this->table['catg'].' c', 'c.ID = p.product_category_id', 'left');
            $this->db->join($this->table['unit'].' u', 'u.ID = p.product_unit_id', 'left');


            $this->db->order_by('p.product_name', "ASC");
            return $this->db->get()->result();
        }



        public function deduct_stock(){
            try{

                if(empty($this->stock_id)){
                    throw new Exception(ERROR_PROCESSING, true);
                }

                $this->db->select('qty');
                $this->db->from($this->table['stck']);
                $this->db->where('ID', $this->stock_id);
                $query = $this->db->get()->row();

                // var_dump($query->qty);

                if(empty($query->qty)){
                    throw new Exception(NO_STOCK_LEFT, true);
                }

                $this->db->trans_start();

                $new_qty = (int)$query->qty - 1;
                $this->db->set('qty', $new_qty);
                $this->db->set('datetime_last_update', date('Y-m-d H:i:s'));
                $this->db->where('ID', $this->stock_id);
                $result=$this->db->update($this->table['stck']);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    throw new Exception("Error Saving data. Transaction halted.", 1);	
                }else
                {
                    $this->db->trans_commit();
              
                }
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
                
            }
            catch(Exception $msg){
                echo json_encode(array('error_message'=>$msg->getMessage(), 'has_error'=>true));
            }
        }

        public function add_stock(){
            try{

                if(empty($this->stock_id)){
                    throw new Exception(ERROR_PROCESSING, true);
                }

                $this->db->select('qty');
                $this->db->from($this->table['stck']);
                $this->db->where('ID', $this->stock_id);
                $query = $this->db->get()->row();

                $this->db->trans_start();

                $new_qty = (int)$query->qty + 1;
                $this->db->set('qty', $new_qty);
                $this->db->set('datetime_last_update', date('Y-m-d H:i:s'));
                $this->db->where('ID', $this->stock_id);
                $result=$this->db->update($this->table['stck']);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    throw new Exception("Error Saving data. Transaction halted.", 1);	
                }else
                {
                    $this->db->trans_commit();
              
                }
            
                return array('message' => SAVED_SUCCESSFUL, 'has_error' => false);
                
            }
            catch(Exception $msg){
                echo json_encode(array('error_message'=>$msg->getMessage(), 'has_error'=>true));
            }
        }


    }
?>