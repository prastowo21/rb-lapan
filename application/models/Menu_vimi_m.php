<?php 

class Menu_vimi_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_vimi';		// nama table
		$this->data['primary_key']	= 'id_vimi';	// kolom primary key
	}
}

/* End of file Menu_vimi_m.php */
/* Location: ./application/model/Menu_vimi_m.php */
?>