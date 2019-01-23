<?php 

class Pencapaian_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'pencapaian';		// nama table
		$this->data['primary_key']	= 'id_pencapaian';	// kolom primary key
	}

	
}

/* End of file Pencapaian_m.php */
/* Location: ./application/model/Pencapaian_m.php */
?>