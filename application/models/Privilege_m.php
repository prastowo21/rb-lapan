<?php 

class Privilege_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'privilege';		// nama table
		$this->data['primary_key']	= 'id_user';	// kolom primary key
	}
}

/* End of file Privilege_m.php */
/* Location: ./application/model/Privilege_m.php */
?>