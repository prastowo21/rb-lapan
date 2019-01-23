<?php 

class User_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'user';		// nama table
		$this->data['primary_key']	= 'id_user';	// kolom primary key
	}

	
}

/* End of file User_m.php */
/* Location: ./application/model/User_m.php */
?>