<?php 

class Login_m extends MY_Model 
{

	var $user_fields = array('id_user', 'id_role', 'password');
	var $admin_fields = array('id_user', 'id_admin', 'nama', 'telepon', 'email');
	var $editor_fields = array('id_user','id_editor', 'nama', 'telepon', 'email');
	var $operator_fields = array('id_operator','id_user','id_program_studi','nama','telepon','email');

	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'user';		// nama table
		$this->data['primary_key']	= 'id_user';	// kolom primary key
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk validasi identitas user
	 *
	 * @return boolean 
	 * (true: ada, false: tidak)
	 * @param string Username & Password
	 **/
	public function ceklogin($username, $password){
		$where_query = array('id_user' => $username);
		$login = $this->get_row($where_query);

			if (empty($login)){
				$this->flashmsg('<i class="fa fa-warning"></i> Username atau password anda salah', 'danger');
			}
			else {
				//if (password_verify($password, $login->password)){
				if ($this->bcrypt->check_password($password, $login->password))
				{
				$this->session->set_userdata(array(
					'id_role' 	=> $login->id_role,
					'id_user'	=> $login->id_user,
				));

				return true;
				}
				//}
			}
		


		$this->flashmsg('<i class="fa fa-warning"></i> Username atau password anda salah', 'danger');

		return false;
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk validasi id_fakultas dari parameter, apakah
	 * ada termasuk dari fakultas yang terdaftar di sistem.
	 *
	 * @return boolean 
	 * (true: ada, false: tidak)
	 * @param objek actor dengan atribut id_fakultas.
	 **/
	private function cek_idfakultas($actor_obj){

		if($actor_obj->id_fakultas == '4'){
			return true;
		}				
		return false;
	}

	 /**
	 * @author M. Ryan Fadholi
	 * Method untuk validasi id_program_studi dari parameter, apakah
	 * ada di list program studi yang terdaftar di sistem.
	 *
	 * @return boolean 
	 * (true: ada, false: tidak)
	 * @param objek actor dengan atribut id_program_studi.
	 **/
	private function cek_idprogramstudi($actor_obj){
		$this->load->model('program_studi_m');
		$prodi_db_data = $this->program_studi_m->get(array('id_fakultas' => '4'));

		$list_prodi = array();
		foreach ($prodi_db_data as $data) {
			array_push($list_prodi, $data->id_program_studi);
		}

		if(in_array($actor_obj->id_program_studi, $list_prodi)){
			return true;
		}					
		return false;
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk mengambil nilai-nilai dari sebuah associative array,
	 * berdasarkan list nilai yang dibutuhkan.
	 *
	 * @return Associative Array
	 * @param Associative Array
	 * @param Array of String (hanya nilai dengan key yang 
	 * ada di param ini yang dimasukkan ke return Array).
	 **/
	private function extract_data($array, $fields){
		$result =array();
		foreach ($array as $key => $value) {
			if(in_array($key, $fields)){
				$result[$key] = $value;
			}
		}

		return $result;
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk mengambil objek dari sebuah Array of Objects
	 * yang hanya berisi satu Object.
	 *
	 * @return Object
	 * @param Array of Object
	 **/
	private function extract_single_obj($array_of_obj){
		foreach ($array_of_obj as $value) {
			$result = $value;
		}		
		return $result;
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk cloning data user dengan role admin
	 * dari dbproremun ke db simak-fk.
	 *
	 * @param Object hasil query dari dbproremun
	 **/
	private function clone_admin($admin_obj){
		//extract object dari array of object
		$insert_user_data = $this->extract_data((array) $admin_obj, $this->user_fields);
		$insert_admin_data = $this->extract_data((array) $admin_obj, $this->admin_fields);

		$this->insert($insert_user_data);
		$this->admin_m->insert($insert_admin_data);				
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk cloning data user dengan role dosen
	 * dari dbproremun ke db simak-fk.
	 *
	 * @param Object hasil query dari dbproremun
	 **/
	private function clone_dosen($dosen_obj){
		//extract object dari array of object
		$insert_user_data = $this->extract_data((array) $dosen_obj, $this->user_fields);
		$insert_dosen_data = $this->extract_data((array) $dosen_obj, $this->dosen_fields);

		$this->insert($insert_user_data);
		$this->dosen_m->insert($insert_dosen_data);
	}

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk cloning data user dengan role operator
	 * dari dbproremun ke db simak-fk.
	 *
	 * @param Object hasil query dari dbproremun
	 **/
	private function clone_operator($operator_obj){
		//extract object dari array of object
		$insert_user_data = $this->extract_data((array) $operator_obj, $this->user_fields);
		$insert_operator_data = $this->extract_data((array) $operator_obj, $this->operator_fields);

		$this->insert($insert_user_data);
		$this->operator_m->insert($insert_operator_data);
	} 

	/**
	 * @author M. Ryan Fadholi
	 * Method untuk validasi form login di controller Login
	 **/
	public function validate_login(){
			$config = array(
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required',
					'errors' => array(
						'required' => '%s harus diisi'
					)
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => array(
						'required' => '%s harus diisi'
					)
				)
			);

			return $this->validate($config);
	}


} //end of class

/* End of file Login_m.php */
/* Location: ./application/model/Login_m.php */
?>	