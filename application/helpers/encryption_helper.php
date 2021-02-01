<?php    
    function salt_generator($length)
    {
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789$11<>?!@#$%^&*()";
        $charArray = str_split($chars);
        
        for($i = 0; $i < $length; $i++)
        {
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
        
        return $result;
    }

    function uniqeid_generator($id = 1, $length = 50)
    {
        if (function_exists("random_bytes")) 
        {
            $bytes = random_bytes(ceil($length / 2));
        } 
        elseif (function_exists("openssl_random_pseudo_bytes")) 
        {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } 
        else 
        {
            throw new Exception(NO_CRYPTO);
        }

        $random = substr(bin2hex($bytes), 0, $length);
        $unique_id = sha1($random . uniqid() . $id . date('y-m-d:h:i:s') . $random);

        return $unique_id;
    }

    function encoder_username_generator($length, $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    /** formatting data to insert */
    function insert_encryted_data($table_name, $field_values = array(), $nonfield_values = array()){

        $CI =& get_instance();
        $enKEY = $CI->config->item('encryption_key');

        if(empty($table_name) || empty($field_values)){
            return false;
        }
        
        $field = "";
        $values = "";
        $counter = 0;
        $noncounter = 0;
        $comma_seperator = ","; 
        $noncomma_seperator = ","; 
        $len = count($field_values);
        $nonlen = count($nonfield_values);        

        foreach($field_values as $index=>$value){
            if ($counter == $len - 1) {
                $comma_seperator = ' '; 
            }
            if ($len==1){
                $comma_seperator = ',';
            }

            $values .= 'AES_ENCRYPT('.'"'.$value.'"'.','.'"'.$enKEY.'"'.')'.$comma_seperator;
            $field .= $index.$comma_seperator; 
            if(empty($nonfield_values)){
                $counter++;
            }
        }

        if(!empty($nonfield_values)){

            foreach($nonfield_values as $index=>$value){
                if(empty($nonfield_values[$index])){
                    unset($nonfield_values[$index]);
                    $nonlen = $nonlen - 1;
                }
            }

            foreach($nonfield_values as $index=>$value){

                if ($noncounter == $nonlen - 1) {
                    $noncomma_seperator = ' ';
                }
                if ($nonlen==1){
                    $noncomma_seperator = ',';
                }
                            
                $values .= '"'.$value.'"'.$noncomma_seperator;
                $field .= $index.$noncomma_seperator; 

                $noncounter++;
            }
        }        

        $CI->db->trans_start();            
        $sql = "INSERT INTO $table_name ($field) VALUES 
                ($values)";
       
        $CI->db->query($sql);
          
        $insertID = $CI->db->insert_id();

        $CI->db->trans_complete();                         

        if ($CI->db->trans_status() === false)
        {                
            $CI->db->trans_rollback();            
            throw new Exception('ERROR SAVING DATA', true);	
        }else
        {
            $CI->db->trans_commit();                
            return (array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false, 'insertID'=>$insertID));
        }
    }

    function endekey(){
        $CI =& get_instance();
        $enKEY = $CI->config->item('encryption_key');

        return $enKEY;
    }

    /** updating ecryption data */ 
    function update_table_encrypted_data($table_name, $field){    
        
        $CI =& get_instance();
        $CI->db->select('ID, '.$field);
        $data = $CI->db->get($table_name)->result();
        $secret_key = $CI->config->item('encryption_key');

        foreach($data as $enKey=>$item){
            $CI->db->trans_start();       

            $sql = 'UPDATE '.$table_name.' 
                    SET '.$field.' = AES_ENCRYPT('.'"'.(((array)$item)[$field]).'"'.','.'"'.$secret_key.'"'.') 
                    WHERE '.$table_name.'.`ID` = "'.$item->ID.'"';           
            $CI->db->query($sql);

            $CI->db->trans_complete();                         
        }    

        if ($CI->db->trans_status() === false)
        {                
            $CI->db->trans_rollback();
            throw new Exception('ERROR SAVING DATA', true);	
        }else
        {
            $CI->db->trans_commit();                
            echo json_encode(array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false));
        }
    }

    
    function update_row_encrypted_data($table_name, $field_values, $nonEncrepted, $colField, $where){
        $CI =& get_instance();
        $enKey = $CI->config->item('encryption_key');
        
        $data = $CI->db->get($table_name)->result();            
        
        foreach($field_values as $key=>$value){
            
            $CI->db->trans_start();

            $sql = 'UPDATE `'.$table_name.'` 
            SET '.$key.' = AES_ENCRYPT('.'"'.$value.'"'.','.'"'.$enKey.'"'.') 
            WHERE `'.$table_name.'`.`'.$colField.'` = "'.$where.'"';           

            $CI->db->query($sql);
            $CI->db->trans_complete();              
        }

        if(!empty($nonEncrepted)){
            foreach($nonEncrepted as $key=>$value){
            
                $CI->db->trans_start();
    
                $sql = 'UPDATE `'.$table_name.'` 
                SET '.$key.' = "'.$value.'" 
                WHERE `'.$table_name.'`.`'.$colField.'` = "'.$where.'"';           
    
                $CI->db->query($sql);
                $CI->db->trans_complete();                   
            }
        }

        if ($CI->db->trans_status() === false)
        {                
            $CI->db->trans_rollback();
            throw new Exception('ERROR SAVING DATA', true);	
        }else
        {
            $CI->db->trans_commit();                
            echo json_encode(array('message'=>SAVED_SUCCESSFUL, 'has_error'=>false));
        }              
    }    
?>
