<?php 

class Menu_manajemen_perubahan_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_manajemen_perubahan';		// nama table
		$this->data['primary_key']	= 'id_manajemen_perubahan';	// kolom primary key
	}
}

/* End of file Menu_manajemen_perubahan_m.php */
/* Location: ./application/model/Menu_manajemen_perubahan_m.php */
?>