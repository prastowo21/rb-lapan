<?php 

class Menu_penguatan_akuntabilitas_kinerja_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_penguatan_akuntabilitas_kinerja';		// nama table
		$this->data['primary_key']	= 'id_penguatan_akuntabilitas_kinerja';	// kolom primary key
	}
}

/* End of file Menu_penguatan_akuntabilitas_kinerja_m.php */
/* Location: ./application/model/Menu_penguatan_akuntabilitas_kinerja_m.php */
?>