<?php 

class Berita_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'news';		// nama table
		$this->data['primary_key']	= 'id_berita';	// kolom primary key
	}
}

/* End of file Berita_m.php */
/* Location: ./application/model/Berita_m.php */
?>