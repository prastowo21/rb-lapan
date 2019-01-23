<?php 

class Menu_monev_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_monev';		// nama table
		$this->data['primary_key']	= 'id_monev';	// kolom primary key
	}
}

/* End of file Menu_monev_m.php */
/* Location: ./application/model/Menu_monev_m.php */
?>