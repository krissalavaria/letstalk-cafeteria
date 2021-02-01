<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Order_menu_model extends CI_Model
    {
        private $table = array(
            'catg' => 'product_category',        
            'unit' => 'product_unit',
            'prod' => 'product',    
            'stck' => 'stock' ,
            'user'  => 'user_account' ,  
            'salary' => 'salary_cycle',
            'orderh' => 'orderhead',
            'orderl' => 'orderline'
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

        public function by_category(){
            try{

                if(empty($this->category_id) ){
                    throw new Exception(ERROR_PROCESSING, true);
                }

                $this->db->select('
                *
                ');
                $this->db->from($this->table['prod']);
                $this->db->where('product_category_id', $this->category_id);
                return $this->db->get()->result();

                
            }
            catch(Exception $msg){
                echo json_encode(array('error_message'=>$msg->getMessage(), 'has_error'=>true));
            }
        }

        public function employee(){
            $this->db->select('
                employee_no,
                first_name,
                middle_name,
                last_name
            ');

            $filled_int = sprintf("%06d", $this->emply_no);
            $format_emply_no = 'LT-'.$filled_int;

            $this->db->from($this->table['user']);
            $this->db->where('employee_no', $format_emply_no);

            return $this->db->get()->result();
        }

        public function orderlist(){

            try{


                $filled_int = sprintf("%06d", $this->emply_no);
                $format_emply_no = 'LT-'.$filled_int;
                $ids = $this->orderlist[0];
                $qty = $this->orderlist[1];

                $this->db->select(
                    '
                    ID,
                    product_unit_id,
                    product_category_id,
                    price,
                    '
                );
                $this->db->from($this->table['prod']);
                $this->db->where_in('ID', $ids);
                $prod = $this->db->get()->result();

                $orderline = array();

                $this->db->select('ID');
                $this->db->from($this->table['user']);
                $this->db->where('employee_no', $format_emply_no);
                $user_id = $this->db->get()->row();
                
                $this->db->from($this->table['salary']);
                $this->db->where('user_account_id', $user_id->ID);
                $this->db->where('is_cleared', 0);
                $this->db->order_by('created_at', 'desc');
                $salary_id = $this->db->get()->row();


                $orderhead = array(
                    'user_account_id' => $user_id->ID,
                    'salary_cycle_id' => $salary_id->id,
                    'order_status_id' => 1,
                    'order_date' => date('Y-m-d H:i:s'),
                    'datetime_created' => date('Y-m-d H:i:s')
                );

                $this->db->trans_start();

                $this->db->insert($this->table['orderh'], $orderhead);
                $return_id = $this->db->insert_id();

                $order_no = order_number_gen($return_id);

                $this->db->where('ID', $return_id);
                $this->db->update($this->table['orderh'], array('order_no'=>$order_no));


                foreach($prod as $key=>$item){
                    $orderline = array(
                        'order_no'              =>  $order_no,
                        'product_id'            =>  $item->ID,
                        'qty'                   =>  (int)$qty[$key],
                        'product_unit'          =>  $item->product_unit_id,
                        'product_category_id'   =>  $item->product_category_id,
                        'product_price'         =>  $item->price,
                        'total_amount'          =>  (int)$qty[$key] * (float)$item->price,
                    );
                    $this->db->insert($this->table['orderl'], $orderline);
                }

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


            }catch(Exception $msg){
                echo json_encode(array('error_message'=>$msg->getMessage(), 'has_error'=>true));
            }
            

        }


    }
?>