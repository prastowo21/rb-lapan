<?php 

class Menu_sasaran_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_sasaran';		// nama table
		$this->data['primary_key']	= 'id_sasaran';	// kolom primary key
	}
}

/* End of file Menu_sasaran_m.php */
/* Location: ./application/model/Menu_sasaran_m.php */
?>