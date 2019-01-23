<?php 

class Menu_tujuan_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_tujuan';		// nama table
		$this->data['primary_key']	= 'id_tujuan';	// kolom primary key
	}
}

/* End of file Menu_tujuan_m.php */
/* Location: ./application/model/Menu_tujuan_m.php */
?>