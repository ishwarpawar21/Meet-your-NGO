<?php if( !defined('BASEPATH')) exit('No direct script access alloed');

class Site_model extends CI_Model
{
		public function insertRecord($tbl_name,$data_array)
		{
			if($this->db->insert($tbl_name,$data_array))
			{return true;}
			else
			{return false;}
		}
		
		public function find_max_id($tbl_name)
		{
				$result=$this->db->query("select max(id) as 'maxid' from ".$tbl_name."")->row();
				if($result)
				{ return $result->maxid; }
				else
				{ return 0;}
		}
        
        public function change_password($user_col,$pwd_col,$table)
		{
			        $data=array(
				    	'user_password'=>md5($this->input->post('new_password')),
					);
										
										$this->db->where($user_col,$this->session->userdata('username'));
								     	$this->db->where($pwd_col,md5($this->input->post('current_password')));
										$result=$this->db->update($table,$data);
					 
					if($result)
					{
						echo $result;
                        exit();
                        $this->session->set_userdata('error_msg','Password change Sucessfully');
						$this->session->set_userdata('class','success');
						$this->session->set_userdata('error_state','1');
						return FALSE;
					}
					else
					{
					   
						echo $result;
                        exit();
						$this->session->set_userdata('error_msg','Enter password is invalid');
						$this->session->set_userdata('class','danger');
						$this->session->set_userdata('error_state','1');
						return FALSE;
					
					}
		}
        
        
        
         public function update($tbl_name,$data_array,$id)
		{			       
			$this->db->where('id',$id);							
		    if($this->db->update($tbl_name,$data_array))
			{return true;}
			else
			{return false;}
		}
        
}
?>