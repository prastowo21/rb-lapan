<?php 

class Menu_ikm_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_ikm';		// nama table
		$this->data['primary_key']	= 'id_ikm';	// kolom primary key
	}
}

/* End of file Menu_ikm_m.php */
/* Location: ./application/model/Menu_ikm_m.php */
?>