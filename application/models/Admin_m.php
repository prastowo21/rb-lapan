<?php 

class Admin_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'admin';		// nama table
		$this->data['primary_key']	= 'id_admin';	// kolom primary key
	}

	public function getAll_IdAdmin()
	{
		
		$this->db->select('id_admin');
		$query = $this->db->get($this->data['table_name']);

		return $query->result();
	}

	public function idExists($id_admin)
	{
		foreach ($this->getAll_IdAdmin() as $userdata) {
			if($userdata->id_admin == $id_admin){
				return true;
			}
		}
		return false;
	}
}

/* End of file Admin_m.php */
/* Location: ./application/model/Admin_m.php */
?>