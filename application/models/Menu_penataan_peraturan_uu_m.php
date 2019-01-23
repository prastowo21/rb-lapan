<?php 

class Menu_penataan_peraturan_uu_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_penataan_peraturan_uu';		// nama table
		$this->data['primary_key']	= 'id_penataan_peraturan_uu';	// kolom primary key
	}
}

/* End of file Menu_penataan_peraturan_uu_m.php */
/* Location: ./application/model/Menu_penataan_peraturan_uu_m.php */
?>