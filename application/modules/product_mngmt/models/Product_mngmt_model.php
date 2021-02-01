<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Product_mngmt_model extends CI_Model
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
            s.qty
            ');
            $this->db->from($this->table['prod'].' p');
            $this->db->join($this->table['catg'].' c', 'c.ID = p.product_category_id', 'left');
            $this->db->join($this->table['unit'].' u', 'u.ID = p.product_unit_id', 'left');
            $this->db->join($this->table['stck'].' s', 's.product_id = p.ID', 'left');
            $this->db->order_by('p.product_name', "ASC");
            return $this->db->get()->result();
        }

        public function save_product(){
            try{
                if(empty($this->product_name) || empty($this->product_unit_id) || empty($this->product_category_id ) || empty($this->price) ){
                    throw new Exception(ERROR_PROCESSING, true);
                }

                $data = array(
                    'auth_token'=>auth_token_product(10),
                    'product_name'=>$this->product_name,
                    'product_unit_id'=>$this->product_unit_id,
                    'product_category_id'=>$this->product_category_id,
                    'price'=>$this->price,
                    'datetime_created'=>$this->datetime_created
                );

                $this->db->trans_start();

                $this->db->insert($this->table['prod'], $data);
                $return_id = $this->db->insert_id();

                $data = array(
                    'product_id'=>$return_id,
                    'supplier_id'=>1,
                    'qty'=>0,
                    'datetime_created'=>$this->datetime_created
                );

                $this->db->insert($this->table['stck'], $data);
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

        public function update_product(){
            try{
                if(empty($this->product_name) || empty($this->product_unit_id) || empty($this->product_category_id ) || empty($this->price) ){
                    throw new Exception(ERROR_PROCESSING, true);
                }

                $data = array(
                    'product_name'=>$this->product_name,
                    'product_unit_id'=>$this->product_unit_id,
                    'product_category_id'=>$this->product_category_id,
                    'price'=>$this->price,
                    'datetime_last_update'=>$this->datetime_last_update
                );

                $this->db->trans_start();

                // var_dump($data);
                // return false;
                $this->db->where('auth_token', $this->prod_auth);
                $this->db->update($this->table['prod'], $data);


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


        public function prod_details($prod_auth){
            try{
                if(empty($prod_auth)){
                    throw new Exception(ERROR_PROCESSING, true);
                }

                $this->db->select('*');
                $this->db->from($this->table['prod']);
                $this->db->where('auth_token', $prod_auth);
                return $this->db->get()->row();

            }
            catch(Exception $msg){
                echo json_encode(array('error_message'=>$msg->getMessage(), 'has_error'=>true));
            }
        }


    }
?>