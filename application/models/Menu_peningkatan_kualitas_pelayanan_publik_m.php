<?php 

class Menu_peningkatan_kualitas_pelayanan_publik_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'menu_peningkatan_kualitas_pelayanan_publik';		// nama table
		$this->data['primary_key']	= 'id_peningkatan_kualitas_pelayanan_publik';	// kolom primary key
	}
}

/* End of file Menu_peningkatan_kualitas_pelayanan_publik_m.php */
/* Location: ./application/model/Menu_peningkatan_kualitas_pelayanan_publik_m.php */
?>