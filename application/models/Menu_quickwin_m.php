<?php 

class Menu_quickwin_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_quickwin';		// nama table
		$this->data['primary_key']	= 'id_quickwin';	// kolom primary key
	}
}

/* End of file Menu_quickwin_m.php */
/* Location: ./application/model/Menu_quickwin_m.php */
?>