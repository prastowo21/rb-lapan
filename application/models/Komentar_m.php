<?php 

class Komentar_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'komentar';		// nama table
		$this->data['primary_key']	= 'id_komentar';	// kolom primary key
	}
}

/* End of file Komentar_m.php */
/* Location: ./application/model/Komentar_m.php */
?>