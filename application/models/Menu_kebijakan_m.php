<?php 

class Menu_kebijakan_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_kebijakan';		// nama table
		$this->data['primary_key']	= 'id_kebijakan';	// kolom primary key
	}
}

/* End of file Menu_kebijakan_m.php */
/* Location: ./application/model/Menu_kebijakan_m.php */
?>