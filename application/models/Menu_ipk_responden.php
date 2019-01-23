<?php 

class Menu_ipk_responden extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_ipk_responden';		// nama table
		$this->data['primary_key']	= 'id_responden';	// kolom primary key
	}
}

/* End of file Menu_ipk_responden.php */
/* Location: ./application/model/Menu_ipk_responden.php */
?>