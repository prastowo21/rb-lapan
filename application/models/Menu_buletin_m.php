<?php 

class Menu_buletin_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'buletin';		// nama table
		$this->data['primary_key']	= 'id_buletin';	// kolom primary key
	}
}

/* End of file Menu_buletin_m.php */
/* Location: ./application/model/Menu_buletin_m.php */
?>