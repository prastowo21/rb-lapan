<?php 

class Menu_peraturan_rb_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_peraturan_rb';		// nama table
		$this->data['primary_key']	= 'id_peraturan_rb';	// kolom primary key
	}
}

/* End of file Menu_peraturan_rb_m.php */
/* Location: ./application/model/Menu_peraturan_rb_m.php */
?>