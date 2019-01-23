<?php 

class Menu_penguatan_pengawasan_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_penguatan_pengawasan';		// nama table
		$this->data['primary_key']	= 'id_penguatan_pengawasan';	// kolom primary key
	}
}

/* End of file Menu_penguatan_pengawasan_m.php */
/* Location: ./application/model/Menu_penguatan_pengawasan_m.php */
?>