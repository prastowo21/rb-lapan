<?php 

class Menu_penataan_sistem_manajemen_sdm_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_penataan_sistem_manajemen_sdm';		// nama table
		$this->data['primary_key']	= 'id_penataan_sistem_manajemen_sdm';	// kolom primary key
	}
}

/* End of file Menu_penataan_sistem_manajemen_sdm_m.php */
/* Location: ./application/model/Menu_penataan_sistem_manajemen_sdm_m.php */
?>