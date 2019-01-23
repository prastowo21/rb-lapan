<?php 

class Menu_ipk_kuisioner extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_ipk_kuisioner';		// nama table
		$this->data['primary_key']	= 'id_kuisioner';	// kolom primary key
	}
}

/* End of file Menu_ipk_kuisioner.php */
/* Location: ./application/model/Menu_ipk_kuisioner.php */
?>