<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Pengguna.php');

class Editor extends Pengguna {

	private $base_filedir;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->base_filedir = realpath(APPPATH . "../doc_file/");
		$id_role = $this->session->userdata('id_role');
		if ($id_role != 2)
		{
			$this->session->unset_userdata('id_role');
			$this->session->unset_userdata('id_user');
			$this->flashmsg('<i class="fa fa-warning"></i> Anda harus login sebagai user', 'warning');
			redirect('login');
			exit;
		}

		$this->load->model('user_m');
		$this->load->model('editor_m');
		$this->load->model('pageview_m');
		$this->load->model('berita_m');
		$this->load->model('pencapaian_m');

		$year  = date("Y");
		$month = date("m");
		$day   = date("d");

		$this->data['editor'] = $this->editor_m->get_row(array('id_user' => $this->session->userdata('id_user')));
		$this->data['total_user'] = $this->user_m->affected_rows();
		$this->data['total_visitor_day'] = $this->pageview_m->affected_rows(array('day' => $day, 'month' => $month, 'year' => $year));
		$this->data['total_visitor'] = $this->pageview_m->affected_rows();
		$this->data['total_news'] = $this->berita_m->affected_rows();
		$this->data['Pencapaian'] = $this->pencapaian_m->get();
		$this->data['Pencapaian_urut'] = $this->pencapaian_m->get_by_order('nilai', 'DESC');

		$this->cekPrivilege();

		$temp_edt = $this->data['editor'];
		$img_filedir = array(
					'pas_foto'			=> FCPATH . 'doc_file' . DIRECTORY_SEPARATOR . 'pas_foto' . DIRECTORY_SEPARATOR
				);
		$file_ext = array('bmp', 'jpg', 'png');
				if (isset($temp_edt))
				{
					foreach ($file_ext as $ext)
					{
						if (file_exists($img_filedir['pas_foto'] . $temp_edt->id_editor . '.' . $ext)){
							$this->data['foto'] = $temp_edt->id_editor . '.' . $ext;
						}
						else if (file_exists($img_filedir['pas_foto'] . $temp_edt->id_editor . '.' . strtoupper($ext))){
							$this->data['foto'] = $temp_edt->id_editor . '.' . strtoupper($ext);
						}
					}
				}
	}

	public function index(){

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/index';
		$this->template_admin($this->data);
	}

	public function profile(){
		$id_user = $this->uri->segment(3);

		if (isset($id_user)){
			$data = $this->editor_m->get_row(array('id_user'=> $id_user));
			echo json_encode($data);
			exit;
		}

		if ($this->POST('submit')){

			// $foto_lama = $this->admin_m->get_row(array('id_user' => $this->session->userdata('id_user')))->pas_foto;
			// unlink($this->base_filedir . "/pas_foto/" . $foto_lama);

			// $config = array();
			// $config['file_name'] = $this->admin_m->get_row(array('id_user' => $this->session->userdata('id_user')))->id_admin;
		 //    $config['upload_path'] = $this->base_filedir . "/pas_foto/";
		 //    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
		 //    $config['max_size'] = '100000';

		 //    $this->load->library('upload', $config, 'up_foto_baru'); //Custom pasfoto upload config.

		 //    if(!$this->up_foto_baru->do_upload('foto_baru'))
		 //    {
		 //    	//show error messages
		 //    	$this->flashmsg("Error on pas foto file:" . $this->up_foto_baru->display_errors(),'danger');
			// 	redirect('admin/index');
			// 	exit;
		 //    }

		 //    //Store pas foto data array on a variable
		 //    $foto_baru = $this->up_foto_baru->data();
			
			$data = array(
				'nama'		=> $this->POST('nama_baru'),
				'telepon'	=> $this->POST('telepon_baru'),
				'email'		=> $this->POST('email_baru')
			);

			if($this->editor_m->update($this->data['editor']->id_editor, $data))
			$this->flashmsg('<i class="fa fa-check"></i> Profile Anda berhasil diperbaharui');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal edit profile', 'danger');
			redirect('editor/index');
			exit;
		}

		if($this->POST('changePassword')){
			$old_password = $this->user_m->get_row(array('id_user' => $this->POST('id_user_psw')))->password;
			$old_password_input = $this->POST('old_password_input');
			$new_password = $this->POST('new_password');
			$repeat_password = $this->POST('rpt_password');
			$options = array('cost' => 10);

			if ($new_password != $repeat_password)
			{
				$this->flashmsg("Ganti password gagal, password tidak sama",'danger');
				redirect('editor/index');
				exit;
			}
			elseif ($this->bcrypt->check_password($old_password_input, $old_password))
			{
				$data = array(
					//'password'		=> password_hash($this->POST('new_password'), PASSWORD_DEFAULT, $options)
					'password'		=> $this->bcrypt->hash_password($this->POST('new_password'))
				);

				if ($this->user_m->update($this->POST('id_user_psw'),$data))
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengubah password');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal mengubah password', 'danger');
				redirect('editor/index');
				exit;
				
			}
			else {
				$this->flashmsg("Ganti password gagal, password lama yang anda masukan salah",'danger');
				redirect('editor/index');
				exit;
			}
		}

		if($this->POST('changePhoto')){
			$config = array();
			$config['file_name'] = $this->editor_m->get_row(array('id_user' => $this->session->userdata('id_user')))->id_editor;
		    $config['upload_path'] = $this->base_filedir . "/pas_foto/";
		    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
		    $config['max_size'] = '100000';

		    $this->load->library('upload', $config, 'up_foto_baru'); //Custom pasfoto upload config.
			if(!$this->up_foto_baru->do_upload('foto_baru'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_foto_baru->display_errors(),'danger');
				redirect('editor/index');
				exit;
		    }

			$foto_lama = $this->editor_m->get_row(array('id_user' => $this->session->userdata('id_user')))->pas_foto;
			unlink($this->base_filedir . "/pas_foto/" . $foto_lama);

			$this->up_foto_baru->do_upload('foto_baru');

		    //Store pas foto data array on a variable
		    $foto_baru = $this->up_foto_baru->data();

		    $data = array(
				'pas_foto'	=> $this->up_foto_baru->data('file_name')
			);

			if($this->editor_m->update($this->data['editor']->id_editor, $data))
			$this->flashmsg('<i class="fa fa-check"></i> Profile Anda berhasil diperbaharui');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal edit profile', 'danger');
			redirect('editor/index');
			exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/index';
		$this->template_admin($this->data);
	}

	public function cekPrivilege(){
		$this->load->model('user_m');
		$this->load->model('privilege_m');

		$pri_news = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->news;
		$pri_user = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->user;
		$pri_banner = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->banner;
		$pri_menu = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->menu;
		$pri_diagram = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->diagram;
		$pri_capaian = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->capaian;
		$pri_ikm = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->ikm;
		$pri_ipk = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->ipk;
		$pri_pub_news = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->pub_news;
		$pri_pub_banner = $this->privilege_m->get_row(array('id_user' => $this->session->userdata('id_user')))->pub_banner;

		if($pri_news == "on"){
			$this->data['news'] = "on";
		}else{
			$this->data['news'] = "off";
		}
		if($pri_user == "on"){
			$this->data['user'] = "on";
		}else{
			$this->data['user'] = "off";
		}
		if($pri_banner == "on"){
			$this->data['banner'] = "on";
		}else{
			$this->data['banner'] = "off";
		}
		if($pri_menu == "on"){
			$this->data['menu'] = "on";
		}else{
			$this->data['menu'] = "off";
		}
		if($pri_diagram == "on"){
			$this->data['diagram'] = "on";
		}else{
			$this->data['diagram'] = "off";
		}
		if($pri_capaian == "on"){
			$this->data['capaian'] = "on";
		}else{
			$this->data['capaian'] = "off";
		}
		if($pri_ikm == "on"){
			$this->data['ikm'] = "on";
		}else{
			$this->data['ikm'] = "off";
		}
		if($pri_ipk == "on"){
			$this->data['ipk'] = "on";
		}else{
			$this->data['ipk'] = "off";
		}
		if($pri_pub_news == "on"){
			$this->data['pub_news'] = "on";
		}else{
			$this->data['pub_news'] = "off";
		}
		if($pri_pub_banner == "on"){
			$this->data['pub_banner'] = "on";
		}else{
			$this->data['pub_banner'] = "off";
		}
	}

	public function news_management(){
		$this->load->model('berita_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_berita = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);

		$this->data['id_berita'] = $id_berita;
		$this->data['berita'] = $this->berita_m->get_by_order('tanggal_berita', 'DESC');
		$this->data['creator'] = $this->berita_m->get_row(array('id_berita' => $id_berita));


		if (isset($id_berita)) 
		{
			$id_role = $this->user_m->get_row(array('id_user' => $id_user))->id_role;
			$data_berita = $this->berita_m->get_row(array('id_berita'=>$id_berita));

			if ($id_role == 1){
				$data_berita->creator = $this->admin_m->get_row(array('id_user' => $data_berita->id_user))->nama;
			} elseif ($id_role == 2){
			 	$data_berita->creator = $this->editor_m->get_row(array('id_user' => $data_berita->id_user))->nama;
			}

			echo json_encode($data_berita);
			exit;
		}

		if($this->POST('tambah')){
			$tanggal_berita = $this->POST('tanggal_berita');
			$judul_berita = $this->POST('judul_berita');
			$deskripsi_berita = $this->POST('deskripsi_berita');
			$slug = url_title($judul_berita, '-', TRUE);	
			$required = array('tanggal_berita', 'judul_berita', 'deskripsi_berita');

			if (!$this->berita_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/news-management');
				exit;
			}

				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/berita/";

			    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_news_img'); //Custom pasfoto upload config.

			    if(!$this->up_news_img->do_upload('news_img'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_news_img->display_errors(),'danger');
					redirect('editor/news-management');
					exit;
			    }

			    //Store pas foto data array on a variable
			    $news_img = $this->up_news_img->data();

			    if($this->berita_m->affected_rows(array('slug' => $slug)) > 0)
			    {
			    	$slug = $slug . '-' . $this->berita_m->get_by_order_limit('id_berita', 'DESC')->id_berita;
			    }
			
				$data = array(
					'id_user'			=> $this->data['editor']->id_user,
					'tanggal_berita' 	=> $this->POST('tanggal_berita'),
					'judul_berita'		=> $this->POST('judul_berita'),
					'slug'				=> $slug,
					'deskripsi_berita'	=> $this->POST('deskripsi_berita'),
					'gambar_berita'		=> $this->up_news_img->data('file_name')
				);
				
				if ($this->berita_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil menambah berita');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah berita', 'danger');
				redirect('editor/news-management');
				exit;
			
		}

		if($this->POST('edit')){
			$id_user = $this->POST('id_user');
			$id_berita = $this->POST('id_berita_baru');
			// $judul_berita = $this->POST('judul_berita_baru');
			// $slug = url_title($judul_berita, '-', TRUE);

			if (!empty($id_berita))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/berita/";

			    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_news_img'); //Custom pasfoto upload config.

			    if(!$this->up_news_img->do_upload('news_img_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_news_img->display_errors(),'danger');
					redirect('editor/news-management');
					exit;
			    }

			    $gambar_lama = $this->berita_m->get_row(array('id_berita' => $id_berita))->gambar_berita;
				unlink($this->base_filedir . "/berita/" . $gambar_lama);

			    $this->up_news_img->do_upload('news_img_baru');

			    //Store pas foto data array on a variable
			    $news_img = $this->up_news_img->data();

			    if($this->berita_m->affected_rows(array('slug' => $slug)) > 0)
			    {
			    	$slug = $slug . '-' . $this->berita_m->get_by_order_limit('id_berita', 'DESC')->id_berita;
			    }

				$data = array(
					'id_berita'			=> $id_berita,
					'id_user'			=> $this->session->userdata('id_user'),
					'tanggal_berita'	=> $this->POST('tanggal_berita_baru'),
					'judul_berita'		=> $this->POST('judul_berita_baru'),
					// 'slug'				=> $slug,
					'deskripsi_berita'	=> $this->POST('deskripsi_berita_baru'),
					'gambar_berita'		=> $this->up_news_img->data('file_name')
				);
				
				$this->berita_m->update($this->POST('id_berita_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit berita');
				redirect('editor/news-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit berita', 'danger');
				redirect('editor/news-management');
				exit;
			}
		}

		if ($this->POST('delete')){
				$id_berita = $this->POST('id_berita_del');
				$gambar_lama = $this->berita_m->get_row(array('id_berita' => $id_berita))->gambar_berita;
				unlink($this->base_filedir . "/berita/" . $gambar_lama);

				if ($this->berita_m->delete($this->POST('id_berita_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus berita');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus berita', 'danger');
				redirect('editor/news-management');
				exit;
		}

		if ($this->POST('publish'))
		{
			$data = array(
				'status'	=> 1
			);

			if($this->berita_m->update($this->POST('id_berita_pub'), $data))
			$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil publish berita');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal publish berita', 'danger');
			redirect('editor/news-management');
			exit;
		}

		if ($this->POST('unpublish'))
		{
			$data = array(
				'status'	=> 0
			);

			if($this->berita_m->update($this->POST('id_berita_unpub'), $data))
			$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil unpublish berita');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal unpublish berita', 'danger');
			redirect('editor/news-management');
			exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/news_management';
		$this->template_admin($this->data);
	}

	public function banner_management(){
		$this->load->model('banner_m');

		$this->data['banners'] = $this->banner_m->get_by_order('tanggal_banner', 'DESC');

		$id_banner = $this->uri->segment(3);

		if (isset($id_banner)) 
		{
			$data = $this->banner_m->get_row(array('id_banner' => $id_banner));
			echo json_encode($data);
			exit;
		}

		if ($this->POST('tambah')){
			$judul_banner = $this->POST('judul_banner');
			$gambar = $this->POST('banner_img');

			if (!empty($judul_banner))
			{

				//Upload config pasfoto
			    $config = array();
			    $config['upload_path'] = $this->base_filedir . "/banner/";

			    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_banner_img'); //Custom pasfoto upload config.

			    if(!$this->up_banner_img->do_upload('banner_img'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_banner_img->display_errors(),'danger');
					redirect('editor/banner-management');
					exit;
			    }

			    //Store pas foto data array on a variable
			    $banner_img = $this->up_banner_img->data();

				$data = array(
					'tanggal_banner'	=> date("Y-m-d H:i:s"),
					'judul' 		=> $this->POST('judul_banner'),
					'deskripsi'		=> $this->POST('deskripsi_banner'),
					'gambar'		=> $this->up_banner_img->data('file_name')
				);

				
				$this->banner_m->insert($data); 
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil menambah banner');
				redirect('editor/banner-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah banner', 'danger');
				redirect('editor/banner-management');
				exit;
			}
		}

		if($this->POST('edit')){
			$id_banner = $this->POST('id_banner_baru');

			if (!empty($id_banner))
			{	
				//Upload config pasfoto
			    $config = array();
			    $config['upload_path'] = $this->base_filedir . "/banner/";

			    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_banner_img'); //Custom pasfoto upload config.

			    if(!$this->up_banner_img->do_upload('banner_img_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_banner_img->display_errors(),'danger');
					redirect('editor/banner-management');
					exit;
			    }

			    $gambar_lama = $this->banner_m->get_row(array('id_banner' => $id_banner))->gambar;
				unlink($this->base_filedir . "/banner/" . $gambar_lama);

			    $this->up_banner_img->do_upload('banner_img_baru');

			    //Store pas foto data array on a variable
			    $banner_img = $this->up_banner_img->data();

				$data = array(
					'id_banner'		=> $id_banner,
					'judul'			=> $this->POST('judul_banner_baru'),
					'deskripsi'		=> $this->POST('deskripsi_banner_baru'),
					'gambar'		=> $this->up_banner_img->data('file_name')
				);
				

				$this->banner_m->update($id_banner,$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit banner');
				redirect('editor/banner-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit banner', 'danger');
				redirect('editor/banner-management');
				exit;
			}
		}

		if ($this->POST('delete')){
				$id_banner = $this->POST('id_banner_del');
				$gambar_lama = $this->banner_m->get_row(array('id_banner' => $id_banner))->gambar;
				unlink($this->base_filedir . "/banner/" . $gambar_lama);

				if ($this->banner_m->delete($id_banner))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus banner');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus banner', 'danger');

				redirect('editor/banner-management');
				exit;
		}

		if ($this->POST('publish'))
		{
			$data = array(
				'status'	=> 1
			);

			if($this->banner_m->update($this->POST('id_banner_pub'), $data))
			$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil publish banner');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal publish banner', 'danger');
			redirect('editor/banner-management');
			exit;
		}

		if ($this->POST('unpublish'))
		{
			$data = array(
				'status'	=> 0
			);

			if($this->banner_m->update($this->POST('id_banner_unpub'), $data))
			$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil unpublish banner');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal unpublish banner', 'danger');
			redirect('editor/banner-management');
			exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/banner_management';
		$this->template_admin($this->data);
	}

	public function vimi_management(){
		$this->load->model('menu_vimi_m');

		$this->data['vimis'] = $this->menu_vimi_m->get();

		$id_vimi = $this->uri->segment(3);

		if (isset($id_vimi)) 
		{
			$data = $this->menu_vimi_m->get_row(array('id_vimi' => $id_vimi));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_vimi_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/vimi-management');
				exit;
			}

			
				$data = array(
					'title' 	=> $this->POST('title'),
					'isi'		=> $this->POST('isi')
				);
				
				if ($this->menu_vimi_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/vimi-management');
				exit;
			
		}

		if($this->POST('edit')){
			$id_vimi = $this->POST('id_vimi_baru');
			
			if (!empty($id_vimi))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_vimi'	=> $id_vimi,
					'title'		=> $this->POST('title_baru'),
					'isi'		=> $this->POST('isi_baru')
				);
				
				$this->menu_vimi_m->update($this->POST('id_vimi_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/vimi-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/vimi-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			
				if ($this->menu_vimi_m->delete($this->POST('id_vimi_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
				redirect('editor/vimi-management');
				exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/vimi_management';
		$this->template_admin($this->data);
	}

	public function tujuan_management(){
		$this->load->model('menu_tujuan_m');

		$this->data['tujuans'] = $this->menu_tujuan_m->get();

		$id_tujuan = $this->uri->segment(3);

		if (isset($id_tujuan)) 
		{
			$data = $this->menu_tujuan_m->get_row(array('id_tujuan' => $id_tujuan));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_tujuan_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/tujuan-management');
				exit;
			}

			
				$data = array(
					'title' 	=> $this->POST('title'),
					'isi'		=> $this->POST('isi')
				);
				
				if ($this->menu_tujuan_m->insert($data)) 
					$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else 
					$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
					redirect('editor/tujuan-management');
					exit;
			
		}

		if($this->POST('edit')){
			$id_tujuan = $this->POST('id_tujuan_baru');
			
			if (!empty($id_tujuan))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_tujuan'	=> $id_tujuan,
					'title'		=> $this->POST('title_baru'),
					'isi'		=> $this->POST('isi_baru')
				);
				
				$this->menu_tujuan_m->update($this->POST('id_tujuan_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/tujuan-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/tujuan-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			
				if ($this->menu_tujuan_m->delete($this->POST('id_tujuan_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
				redirect('editor/tujuan-management');
				exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/tujuan_management';
		$this->template_admin($this->data);
	}

	public function sasaran_management(){
		$this->load->model('menu_sasaran_m');

		$this->data['sasarans'] = $this->menu_sasaran_m->get();

		$id_sasaran = $this->uri->segment(3);

		if (isset($id_sasaran)) 
		{
			$data = $this->menu_sasaran_m->get_row(array('id_sasaran' => $id_sasaran));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_sasaran_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/sasaran-management');
				exit;
			}

			
				$data = array(
					'title' 	=> $this->POST('title'),
					'isi'		=> $this->POST('isi')
				);
				
				if ($this->menu_sasaran_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/sasaran-management');
				exit;
			
		}

		if($this->POST('edit')){
			$id_sasaran = $this->POST('id_sasaran_baru');
			
			if (!empty($id_sasaran))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_sasaran'	=> $id_sasaran,
					'title'		=> $this->POST('title_baru'),
					'isi'		=> $this->POST('isi_baru')
				);
				
				$this->menu_sasaran_m->update($this->POST('id_sasaran_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/sasaran-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/sasaran-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			
				if ($this->menu_sasaran_m->delete($this->POST('id_sasaran_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
				redirect('editor/sasaran-management');
				exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/sasaran_management';
		$this->template_admin($this->data);
	}

	public function peraturanrb_management(){
		$this->load->model('menu_peraturan_rb_m');

		$this->data['Peraturan_rb'] = $this->menu_peraturan_rb_m->get();

		$id_peraturan_rb = $this->uri->segment(3);

		if (isset($id_peraturan_rb)) 
		{
			$data = $this->menu_peraturan_rb_m->get_row(array('id_peraturan_rb' => $id_peraturan_rb));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_peraturan_rb_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/peraturanrb-management');
				exit;
			}

			
				$data = array(
					'title' 	=> $this->POST('title'),
					'isi'		=> $this->POST('isi')
				);
				
				if ($this->menu_peraturan_rb_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/peraturanrb-management');
				exit;
			
		}

		if($this->POST('edit')){
			$id_peraturan_rb = $this->POST('id_peraturan_rb_baru');
			
			if (!empty($id_peraturan_rb))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_peraturan_rb'	=> $id_peraturan_rb,
					'title'		=> $this->POST('title_baru'),
					'isi'		=> $this->POST('isi_baru')
				);
				
				$this->menu_peraturan_rb_m->update($this->POST('id_peraturan_rb_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/peraturanrb-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/peraturanrb-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			
				if ($this->menu_peraturan_rb_m->delete($this->POST('id_peraturan_rb_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
				redirect('editor/peraturanrb-management');
				exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/peraturan_rb_management';
		$this->template_admin($this->data);
	}

	public function quickwin_management(){
		$this->load->model('menu_quickwin_m');

		$this->data['quickwins'] = $this->menu_quickwin_m->get();

		$id_quickwin = $this->uri->segment(3);

		if (isset($id_quickwin)) 
		{
			$data = $this->menu_quickwin_m->get_row(array('id_quickwin' => $id_quickwin));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_quickwin_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/quickwin-management');
				exit;
			}

			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/quickwin/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '100000';
		    $this->load->library('upload', $config, 'up_quickwin_file'); //Custom pasfoto upload config.

		    if(!$this->up_quickwin_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_quickwin_file->display_errors(),'danger');
				redirect('editor/quickwin-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $quickwin_file = $this->up_quickwin_file->data();

			$data = array(
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->POST('isi'),
				'dokumen'	=> $this->up_quickwin_file->data('file_name')
			);
			
			if ($this->menu_quickwin_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/quickwin-management');
				exit;
			
		}

		if($this->POST('edit')){
			$id_quickwin = $this->POST('id_quickwin_baru');
			
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/quickwin/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '100000';
		    $this->load->library('upload', $config, 'up_quickwin_file'); //Custom pasfoto upload config.

		    if(!$this->up_quickwin_file->do_upload('dokumen_baru'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_quickwin_file->display_errors(),'danger');
				redirect('editor/quickwin-management');
				exit;
		    }

		    $file_lama = $this->menu_quickwin_m->get_row(array('id_quickwin' => $id_quickwin))->dokumen;
			unlink($this->base_filedir . "/quickwin/" . $file_lama);

		    $this->up_quickwin_file->do_upload('dokumen_baru');

		    //Store pas foto data array on a variable
		    $quickwin_file = $this->up_quickwin_file->data();
			
			if (!empty($id_quickwin))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_quickwin'	=> $id_quickwin,
					'title'			=> $this->POST('title_baru'),
					'isi'			=> $this->POST('isi_baru'),
					'dokumen'		=> $this->up_quickwin_file->data('file_name')
				);
				
				$this->menu_quickwin_m->update($id_quickwin,$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/quickwin-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/quickwin-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_quickwin = $this->POST('id_quickwin_del');
			$file_lama = $this->menu_roadmap_m->get_row(array('id_quickwin' => $id_quickwin))->dokumen;
			unlink($this->base_filedir . "/quickwin/" . $file_lama);
						
			if ($this->menu_quickwin_m->delete($id_quickwin))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus berita');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus berita', 'danger');
			redirect('editor/quickwin-management');
			exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/quickwin_management';
		$this->template_admin($this->data);
	}

	public function kebijakan_management(){
		$this->load->model('menu_kebijakan_m');

		$this->data['Kebijakan'] = $this->menu_kebijakan_m->get();

		$id_kebijakan = $this->uri->segment(3);

		if (isset($id_kebijakan)) 
		{
			$data = $this->menu_kebijakan_m->get_row(array('id_kebijakan' => $id_kebijakan));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_kebijakan_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/kebijakan-management');
				exit;
			}

			
				$data = array(
					'title' 	=> $this->POST('title'),
					'isi'		=> $this->POST('isi')
				);
				
				if ($this->menu_kebijakan_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/kebijakan-management');
				exit;
			
		}

		if($this->POST('edit')){
			$id_kebijakan = $this->POST('id_kebijakan_baru');
			
			if (!empty($id_kebijakan))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_kebijakan'	=> $id_kebijakan,
					'title'		=> $this->POST('title_baru'),
					'isi'		=> $this->POST('isi_baru')
				);
				
				$this->menu_kebijakan_m->update($this->POST('id_kebijakan_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/kebijakan-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/kebijakan-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			
				if ($this->menu_kebijakan_m->delete($this->POST('id_kebijakan_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
				redirect('editor/kebijakan-management');
				exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/kebijakan_management';
		$this->template_admin($this->data);
	}

	public function roadmap_management(){
		$this->load->model('menu_roadmap_m');

		$this->data['Roadmap'] = $this->menu_roadmap_m->get();

		$id_roadmap = $this->uri->segment(3);

		if (isset($id_roadmap)) 
		{
			$data = $this->menu_roadmap_m->get_row(array('id_roadmap' => $id_roadmap));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$title = $this->POST('title');
			$isi = $this->POST('isi');			

			$required = array('title', 'isi');

			if (!$this->menu_roadmap_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/roadmap-management');
				exit;
			}

			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/roadmap/";
		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '100000';
		    $this->load->library('upload', $config, 'up_roadmap_file'); //Custom pasfoto upload config.

		    if(!$this->up_roadmap_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_roadmap_file->display_errors(),'danger');
				redirect('editor/roadmap-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $roadmap_file = $this->up_roadmap_file->data();

			
				$data = array(
					'title' 	=> $this->POST('title'),
					'isi'		=> $this->POST('isi'),
					'dokumen'	=> $this->up_roadmap_file->data('file_name')
				);
				
				if ($this->menu_roadmap_m->insert($data)) 
					$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else 
					$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
					redirect('editor/roadmap-management');
					exit;
			
		}

		if($this->POST('edit')){
			$id_roadmap = $this->POST('id_roadmap_baru');
			
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/roadmap/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '100000';
		    $this->load->library('upload', $config, 'up_roadmap_file'); //Custom pasfoto upload config.

		    if(!$this->up_roadmap_file->do_upload('dokumen_baru'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_roadmap_file->display_errors(),'danger');
				redirect('editor/roadmap-management');
				exit;
		    }

		    $file_lama = $this->menu_roadmap_m->get_row(array('id_roadmap' => $id_roadmap))->dokumen;
			unlink($this->base_filedir . "/roadmap/" . $file_lama);

		    $this->up_roadmap_file->do_upload('dokumen_baru');

		    //Store pas foto data array on a variable
		    $roadmap_file = $this->up_roadmap_file->data();
			
			if (!empty($id_roadmap))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_roadmap'	=> $id_roadmap,
					'title'			=> $this->POST('title_baru'),
					'isi'			=> $this->POST('isi_baru'),
					'dokumen'		=> $this->up_roadmap_file->data('file_name')
				);
				
				$this->menu_roadmap_m->update($id_roadmap,$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/roadmap-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/roadmap-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_roadmap = $this->POST('id_roadmap_del');
			$file_lama = $this->menu_roadmap_m->get_row(array('id_roadmap' => $id_roadmap))->dokumen;
			unlink($this->base_filedir . "/roadmap/" . $file_lama);
			
			if ($this->menu_roadmap_m->delete($id_roadmap))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/roadmap-management');
			exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/roadmap_management';
		$this->template_admin($this->data);	
	}

	public function diagram_management(){
		$this->load->model('pencapaian_m');

		$this->data['Pencapaian'] = $this->pencapaian_m->get();

		$id_pencapaian = $this->uri->segment(3);

		if (isset($id_pencapaian)) 
		{
			$data = $this->pencapaian_m->get_row(array('id_pencapaian' => $id_pencapaian));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah'))
		{
			$nama = $this->POST('nama');
			$nilai = $this->POST('nilai');			

			$required = array('nama', 'nilai');

			if (!$this->pencapaian_m->required_input($required))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/diagram-management');
				exit;
			}

			
				$data = array(
					'nama' 	=> $this->POST('nama'),
					'nilai'	=> $this->POST('nilai')
				);
				
				if ($this->pencapaian_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/diagram-management');
				exit;
		}

		if($this->POST('edit'))
		{
			$id_pencapaian = $this->POST('id_pencapaian_baru');
			
			if (!empty($id_pencapaian))
			{	
				// $this->data['id_blok_kuliah'] = $this->kelas_kuliah_m->get_row(array('id_kelas_kuliah' => $id_kelas_kuliah))->id_blok_kuliah;
				$data = array(
					'id_pencapaian'	=> $id_pencapaian,
					'nama'		=> $this->POST('nama_baru'),
					'nilai'		=> $this->POST('nilai_baru')
				);
				
				$this->pencapaian_m->update($this->POST('id_pencapaian_baru'),$data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengedit data');
				redirect('editor/diagram-management');
				exit;
			}
			else
			{
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/diagram-management');
				exit;
			}
		}

		if($this->POST('delete'))
		{
			if ($this->pencapaian_m->delete($this->POST('id_pencapaian_del')))
				$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			
			redirect('editor/diagram-management');
			exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/diagram_management';
		$this->template_admin($this->data);
	}

	public function manajemen_perubahan_management(){
		$this->load->model('menu_manajemen_perubahan_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_manajemen_perubahan = $this->uri->segment(3);

		$this->data['MP'] = $this->menu_manajemen_perubahan_m->get(array('id_manajemen_perubahan'));

		if (isset($id_manajemen_perubahan)) 
		{
			$data = $this->menu_manajemen_perubahan_m->get_row(array('id_manajemen_perubahan' => $id_manajemen_perubahan));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Manajemen Perubahan/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_mp_file'); //Custom pasfoto upload config.

		    if(!$this->up_mp_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_mp_file->display_errors(),'danger');
				redirect('editor/manajemen-perubahan-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $mp_file = $this->up_mp_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_mp_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_manajemen_perubahan_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/manajemen-perubahan-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_manajemen_perubahan = $this->POST('id_manajemen_perubahan_baru');
			

			if (!empty($id_manajemen_perubahan)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Manajemen Perubahan/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_mp_file'); //Custom pasfoto upload config.

			    if(!$this->up_mp_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_mp_file->display_errors(),'danger');
					redirect('editor/manajemen-perubahan-management');
					exit;
			    }

			    $file_lama = $this->menu_manajemen_perubahan_m->get_row(array('id_manajemen_perubahan' => $id_manajemen_perubahan))->isi;
				unlink($this->base_filedir . "/capaian/Manajemen Perubahan/" . $file_lama);

			    $this->up_mp_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $mp_file = $this->up_mp_file->data();

				$data = array(
					'id_manajemen_perubahan'	=> $id_manajemen_perubahan,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_mp_file->data('file_name')
				);

				$this->menu_manajemen_perubahan_m->update($id_manajemen_perubahan, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/manajemen-perubahan-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/manajemen-perubahan-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_manajemen_perubahan = $this->POST('id_manajemen_perubahan_del');
			$file_lama = $this->menu_manajemen_perubahan_m->get_row(array('id_manajemen_perubahan' => $id_manajemen_perubahan))->isi;
			unlink($this->base_filedir . "/capaian/Manajemen Perubahan/" . $file_lama);

			if ($this->menu_manajemen_perubahan_m->delete($this->POST('id_manajemen_perubahan_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/manajemen-perubahan-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/manajemen_perubahan_management';
		$this->template_admin($this->data);
	}

	public function penataan_peraturan_uu_management(){
		$this->load->model('menu_penataan_peraturan_uu_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_penataan_peraturan_uu = $this->uri->segment(3);

		$this->data['PPUU'] = $this->menu_penataan_peraturan_uu_m->get(array('id_penataan_peraturan_uu'));

		if (isset($id_penataan_peraturan_uu)) 
		{
			$data = $this->menu_penataan_peraturan_uu_m->get_row(array('id_penataan_peraturan_uu' => $id_penataan_peraturan_uu));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan Peraturan UU/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_ppuu_file'); //Custom pasfoto upload config.

		    if(!$this->up_ppuu_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_ppuu_file->display_errors(),'danger');
				redirect('editor/penataan-peraturan-uu-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $ppuu_file = $this->up_ppuu_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_ppuu_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_penataan_peraturan_uu_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-peraturan-uu-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_penataan_peraturan_uu = $this->POST('id_penataan_peraturan_uu_baru');
			$file_lama = $this->menu_penataan_peraturan_uu_m->get_row(array('id_penataan_peraturan_uu' => $id_penataan_peraturan_uu))->isi;
			unlink($this->base_filedir . "/capaian/Penataan Peraturan UU/" . $file_lama);

			if (!empty($id_penataan_peraturan_uu)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan Peraturan UU/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_ppuu_file'); //Custom pasfoto upload config.

			    if(!$this->up_ppuu_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_ppuu_file->display_errors(),'danger');
					redirect('editor/penataan-peraturan-uu-management');
					exit;
			    }

			    $file_lama = $this->menu_penataan_peraturan_uu_m->get_row(array('id_penataan_peraturan_uu' => $id_penataan_peraturan_uu))->isi;
				unlink($this->base_filedir . "/capaian/Penataan Peraturan UU/" . $file_lama);

			    $this->up_ppuu_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $ppuu_file = $this->up_ppuu_file->data();

				$data = array(
					'id_penataan_peraturan_uu'	=> $id_penataan_peraturan_uu,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_ppuu_file->data('file_name')
				);

				$this->menu_penataan_peraturan_uu_m->update($id_penataan_peraturan_uu, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/penataan-peraturan-uu-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-peraturan-uu-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_penataan_peraturan_uu = $this->POST('id_penataan_peraturan_uu_del');
			$file_lama = $this->menu_penataan_peraturan_uu_m->get_row(array('id_penataan_peraturan_uu' => $id_penataan_peraturan_uu))->isi;
			unlink($this->base_filedir . "/capaian/Penataan Peraturan UU/" . $file_lama);

			if ($this->menu_penataan_peraturan_uu_m->delete($this->POST('id_penataan_peraturan_uu_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/penataan-peraturan-uu-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/penataan_peraturan_uu_management';
		$this->template_admin($this->data);
	}

	public function penataan_dan_penguatan_organisasi_management(){
		$this->load->model('menu_penataan_dan_penguatan_organisasi_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_penataan_dan_penguatan_organisasi = $this->uri->segment(3);

		$this->data['PPO'] = $this->menu_penataan_dan_penguatan_organisasi_m->get(array('id_penataan_dan_penguatan_organisasi'));

		if (isset($id_penataan_dan_penguatan_organisasi)) 
		{
			$data = $this->menu_penataan_dan_penguatan_organisasi_m->get_row(array('id_penataan_dan_penguatan_organisasi' => $id_penataan_dan_penguatan_organisasi));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan dan Penguatan Organisasi/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_ppo_file'); //Custom pasfoto upload config.

		    if(!$this->up_ppo_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_ppo_file->display_errors(),'danger');
				redirect('editor/penataan-dan-penguatan-organisasi-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $ppo_file = $this->up_ppo_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_ppo_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_penataan_dan_penguatan_organisasi_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-dan-penguatan-organisasi-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_penataan_dan_penguatan_organisasi = $this->POST('id_penataan_dan_penguatan_organisasi_baru');
			

			if (!empty($id_penataan_dan_penguatan_organisasi)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan dan Penguatan Organisasi/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_ppo_file'); //Custom pasfoto upload config.

			    if(!$this->up_ppo_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_ppo_file->display_errors(),'danger');
					redirect('editor/penataan-dan-penguatan-organisasi-management');
					exit;
			    }

			    $file_lama = $this->menu_penataan_dan_penguatan_organisasi_m->get_row(array('id_penataan_dan_penguatan_organisasi' => $id_penataan_dan_penguatan_organisasi))->isi;
				unlink($this->base_filedir . "/capaian/Penataan dan Penguatan Organisasi/" . $file_lama);

			    $this->up_ppo_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $ppo_file = $this->up_ppo_file->data();

				$data = array(
					'id_penataan_dan_penguatan_organisasi'	=> $id_penataan_dan_penguatan_organisasi,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_ppo_file->data('file_name')
				);

				$this->menu_penataan_dan_penguatan_organisasi_m->update($id_penataan_dan_penguatan_organisasi, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/penataan-dan-penguatan-organisasi-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-dan-penguatan-organisasi-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_penataan_dan_penguatan_organisasi = $this->POST('id_penataan_dan_penguatan_organisasi_del');
			$file_lama = $this->menu_penataan_dan_penguatan_organisasi_m->get_row(array('id_penataan_dan_penguatan_organisasi' => $id_penataan_dan_penguatan_organisasi))->isi;
			unlink($this->base_filedir . "/capaian/Penataan dan Penguatan Organisasi/" . $file_lama);

			if ($this->menu_penataan_dan_penguatan_organisasi_m->delete($this->POST('id_penataan_dan_penguatan_organisasi_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/penataan-dan-penguatan-organisasi-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/penataan_dan_penguatan_organisasi_management';
		$this->template_admin($this->data);
	}

	public function penataan_tatalaksana_management(){
		$this->load->model('menu_penataan_tatalaksana_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_penataan_tatalaksana = $this->uri->segment(3);

		$this->data['PT'] = $this->menu_penataan_tatalaksana_m->get(array('id_penataan_tatalaksana'));

		if (isset($id_penataan_tatalaksana)) 
		{
			$data = $this->menu_penataan_tatalaksana_m->get_row(array('id_penataan_tatalaksana' => $id_penataan_tatalaksana));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan Tatalaksana/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_pt_file'); //Custom pasfoto upload config.

		    if(!$this->up_pt_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_pt_file->display_errors(),'danger');
				redirect('editor/penataan-tatalaksana-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $pt_file = $this->up_pt_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_pt_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_penataan_tatalaksana_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-tatalaksana-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_penataan_tatalaksana = $this->POST('id_penataan_tatalaksana_baru');
			

			if (!empty($id_penataan_tatalaksana)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan Tatalaksana/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_pt_file'); //Custom pasfoto upload config.

			    if(!$this->up_pt_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_pt_file->display_errors(),'danger');
					redirect('editor/penataan-tatalaksana-management');
					exit;
			    }

			    $file_lama = $this->menu_penataan_tatalaksana_m->get_row(array('id_penataan_tatalaksana' => $id_penataan_tatalaksana))->isi;
				unlink($this->base_filedir . "/capaian/Penataan Tatalaksana/" . $file_lama);

			    $this->up_pt_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $pt_file = $this->up_pt_file->data();

				$data = array(
					'id_penataan_tatalaksana'	=> $id_penataan_tatalaksana,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_pt_file->data('file_name')
				);

				$this->menu_penataan_tatalaksana_m->update($id_penataan_tatalaksana, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/penataan-tatalaksana-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-tatalaksana-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_penataan_tatalaksana = $this->POST('id_penataan_tatalaksana_del');
			$file_lama = $this->menu_penataan_tatalaksana_m->get_row(array('id_penataan_tatalaksana' => $id_penataan_tatalaksana))->isi;
			unlink($this->base_filedir . "/capaian/Penataan Tatalaksana/" . $file_lama);

			if ($this->menu_penataan_tatalaksana_m->delete($this->POST('id_penataan_tatalaksana_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/penataan-tatalaksana-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/penataan_tatalaksana_management';
		$this->template_admin($this->data);
	}

	public function penataan_sistem_manajemen_sdm_management(){
		$this->load->model('menu_penataan_sistem_manajemen_sdm_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_penataan_sistem_manajemen_sdm = $this->uri->segment(3);

		$this->data['PSMS'] = $this->menu_penataan_sistem_manajemen_sdm_m->get(array('id_penataan_sistem_manajemen_sdm'));

		if (isset($id_penataan_sistem_manajemen_sdm)) 
		{
			$data = $this->menu_penataan_sistem_manajemen_sdm_m->get_row(array('id_penataan_sistem_manajemen_sdm' => $id_penataan_sistem_manajemen_sdm));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan Sistem Manajemen SDM/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_psms_file'); //Custom pasfoto upload config.

		    if(!$this->up_psms_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_psms_file->display_errors(),'danger');
				redirect('editor/penataan-sistem-manajemen-sdm-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $psms_file = $this->up_psms_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_psms_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_penataan_sistem_manajemen_sdm_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-sistem-manajemen-sdm-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_penataan_sistem_manajemen_sdm = $this->POST('id_penataan_sistem_manajemen_sdm_baru');	

			if (!empty($id_penataan_sistem_manajemen_sdm)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Penataan Sistem Manajemen SDM/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_psms_file'); //Custom pasfoto upload config.

			    if(!$this->up_psms_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_psms_file->display_errors(),'danger');
					redirect('editor/penataan-sistem-manajemen-sdm-management');
					exit;
			    }

			    $file_lama = $this->menu_penataan_sistem_manajemen_sdm_m->get_row(array('id_penataan_sistem_manajemen_sdm' => $id_penataan_sistem_manajemen_sdm))->isi;
				unlink($this->base_filedir . "/capaian/Penataan Sistem Manajemen SDM/" . $file_lama);

			    $this->up_psms_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $psms_file = $this->up_psms_file->data();

				$data = array(
					'id_penataan_sistem_manajemen_sdm'	=> $id_penataan_sistem_manajemen_sdm,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_psms_file->data('file_name')
				);

				$this->menu_penataan_sistem_manajemen_sdm_m->update($id_penataan_sistem_manajemen_sdm, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/penataan-sistem-manajemen-sdm-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penataan-sistem-manajemen-sdm-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_penataan_sistem_manajemen_sdm = $this->POST('id_penataan_sistem_manajemen_sdm_del');
			$file_lama = $this->menu_penataan_sistem_manajemen_sdm_m->get_row(array('id_penataan_sistem_manajemen_sdm' => $id_penataan_sistem_manajemen_sdm))->isi;
			unlink($this->base_filedir . "/capaian/Penataan Sistem Manajemen SDM/" . $file_lama);

			if ($this->menu_penataan_sistem_manajemen_sdm_m->delete($this->POST('id_penataan_sistem_manajemen_sdm_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/penataan-sistem-manajemen-sdm-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/penataan_sistem_manajemen_sdm_management';
		$this->template_admin($this->data);
	}

	public function penguatan_pengawasan_management(){
		$this->load->model('menu_penguatan_pengawasan_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_penguatan_pengawasan = $this->uri->segment(3);

		$this->data['PP'] = $this->menu_penguatan_pengawasan_m->get(array('id_penguatan_pengawasan'));

		if (isset($id_penguatan_pengawasan)) 
		{
			$data = $this->menu_penguatan_pengawasan_m->get_row(array('id_penguatan_pengawasan' => $id_penguatan_pengawasan));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Penguatan Pengawasan/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_pp_file'); //Custom pasfoto upload config.

		    if(!$this->up_pp_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_pp_file->display_errors(),'danger');
				redirect('editor/penguatan-pengawasan-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $pp_file = $this->up_pp_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_pp_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_penguatan_pengawasan_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penguatan-pengawasan-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_penguatan_pengawasan = $this->POST('id_penguatan_pengawasan_baru');
			

			if (!empty($id_penguatan_pengawasan)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Penguatan Pengawasan/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_pp_file'); //Custom pasfoto upload config.

			    if(!$this->up_pp_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_pp_file->display_errors(),'danger');
					redirect('editor/penguatan-pengawasan-management');
					exit;
			    }

			    $file_lama = $this->menu_penguatan_pengawasan_m->get_row(array('id_penguatan_pengawasan' => $id_penguatan_pengawasan))->isi;
				unlink($this->base_filedir . "/capaian/Penguatan Pengawasan/" . $file_lama);

				$this->up_pp_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $pp_file = $this->up_pp_file->data();

				$data = array(
					'id_penguatan_pengawasan'	=> $id_penguatan_pengawasan,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_pp_file->data('file_name')
				);

				$this->menu_penguatan_pengawasan_m->update($id_penguatan_pengawasan, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/penguatan-pengawasan-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penguatan-pengawasan-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_penguatan_pengawasan = $this->POST('id_penguatan_pengawasan_del');
			$file_lama = $this->menu_penguatan_pengawasan_m->get_row(array('id_penguatan_pengawasan' => $id_penguatan_pengawasan))->isi;
			unlink($this->base_filedir . "/capaian/Penguatan Pengawasan/" . $file_lama);

			if ($this->menu_penguatan_pengawasan_m->delete($this->POST('id_penguatan_pengawasan_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/penguatan-pengawasan-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/penguatan_pengawasan_management';
		$this->template_admin($this->data);
	}

	public function penguatan_akuntabilitas_kinerja_management(){
		$this->load->model('menu_penguatan_akuntabilitas_kinerja_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_penguatan_akuntabilitas_kinerja = $this->uri->segment(3);

		$this->data['PAK'] = $this->menu_penguatan_akuntabilitas_kinerja_m->get(array('id_penguatan_akuntabilitas_kinerja'));

		if (isset($id_penguatan_akuntabilitas_kinerja)) 
		{
			$data = $this->menu_penguatan_akuntabilitas_kinerja_m->get_row(array('id_penguatan_akuntabilitas_kinerja' => $id_penguatan_akuntabilitas_kinerja));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Penguatan Akuntabilitas Kinerja/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_pak_file'); //Custom pasfoto upload config.

		    if(!$this->up_pak_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_pak_file->display_errors(),'danger');
				redirect('editor/penguatan-akuntabilitas-kinerja-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $pak_file = $this->up_pak_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_pak_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_penguatan_akuntabilitas_kinerja_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penguatan-akuntabilitas-kinerja-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_penguatan_akuntabilitas_kinerja = $this->POST('id_penguatan_akuntabilitas_kinerja_baru');
			$file_lama = $this->menu_penguatan_akuntabilitas_kinerja_m->get_row(array('id_penguatan_akuntabilitas_kinerja' => $id_penguatan_akuntabilitas_kinerja))->isi;
			unlink($this->base_filedir . "/capaian/Penguatan Akuntabilitas Kinerja/" . $file_lama);

			if (!empty($id_penguatan_akuntabilitas_kinerja)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Penguatan Akuntabilitas Kinerja/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_pak_file'); //Custom pasfoto upload config.

			    if(!$this->up_pak_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_pak_file->display_errors(),'danger');
					redirect('editor/penguatan-akuntabilitas-kinerja-management');
					exit;
			    }

			    $file_lama = $this->menu_penguatan_akuntabilitas_kinerja_m->get_row(array('id_penguatan_akuntabilitas_kinerja' => $id_penguatan_akuntabilitas_kinerja))->isi;
				unlink($this->base_filedir . "/capaian/Penguatan Akuntabilitas Kinerja/" . $file_lama);

				$this->up_pak_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $pak_file = $this->up_pak_file->data();

				$data = array(
					'id_penguatan_akuntabilitas_kinerja'	=> $id_penguatan_akuntabilitas_kinerja,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_pak_file->data('file_name')
				);

				$this->menu_penguatan_akuntabilitas_kinerja_m->update($id_penguatan_akuntabilitas_kinerja, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/penguatan-akuntabilitas-kinerja-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/penguatan-akuntabilitas-kinerja-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_penguatan_akuntabilitas_kinerja = $this->POST('id_penguatan_akuntabilitas_kinerja_del');
			$file_lama = $this->menu_penguatan_akuntabilitas_kinerja_m->get_row(array('id_penguatan_akuntabilitas_kinerja' => $id_penguatan_akuntabilitas_kinerja))->isi;
			unlink($this->base_filedir . "/capaian/Penguatan Akuntabilitas Kinerja/" . $file_lama);

			if ($this->menu_penguatan_akuntabilitas_kinerja_m->delete($this->POST('id_penguatan_akuntabilitas_kinerja_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/penguatan-akuntabilitas-kinerja-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/penguatan_akuntabilitas_kinerja_management';
		$this->template_admin($this->data);
	}

	public function peningkatan_kualitas_pelayanan_publik_management(){
		$this->load->model('menu_peningkatan_kualitas_pelayanan_publik_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_peningkatan_kualitas_pelayanan_publik = $this->uri->segment(3);

		$this->data['PKPB'] = $this->menu_peningkatan_kualitas_pelayanan_publik_m->get(array('id_peningkatan_kualitas_pelayanan_publik'));

		if (isset($id_peningkatan_kualitas_pelayanan_publik)) 
		{
			$data = $this->menu_peningkatan_kualitas_pelayanan_publik_m->get_row(array('id_peningkatan_kualitas_pelayanan_publik' => $id_peningkatan_kualitas_pelayanan_publik));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/capaian/Peningkatan Kualitas Pelayanan Publik/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '200000';
		    $this->load->library('upload', $config, 'up_pkpb_file'); //Custom pasfoto upload config.

		    if(!$this->up_pkpb_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_pkpb_file->display_errors(),'danger');
				redirect('editor/peningkatan-kualitas-pelayanan-publik-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $pkpb_file = $this->up_pkpb_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'isi'		=> $this->up_pkpb_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_peningkatan_kualitas_pelayanan_publik_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/peningkatan-kualitas-pelayanan-publik-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_peningkatan_kualitas_pelayanan_publik = $this->POST('id_peningkatan_kualitas_pelayanan_publik_baru');
			

			if (!empty($id_peningkatan_kualitas_pelayanan_publik)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/capaian/Peningkatan Kualitas Pelayanan Publik/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_pkpb_file'); //Custom pasfoto upload config.

			    if(!$this->up_pkpb_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_pkpb_file->display_errors(),'danger');
					redirect('editor/peningkatan-kualitas-pelayanan-publik-management');
					exit;
			    }

			    $file_lama = $this->menu_peningkatan_kualitas_pelayanan_publik_m->get_row(array('id_peningkatan_kualitas_pelayanan_publik' => $id_peningkatan_kualitas_pelayanan_publik))->isi;
				unlink($this->base_filedir . "/capaian/Peningkatan Kualitas Pelayanan Publik/" . $file_lama);

				$this->up_pkpb_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $pkpb_file = $this->up_pkpb_file->data();

				$data = array(
					'id_peningkatan_kualitas_pelayanan_publik'	=> $id_peningkatan_kualitas_pelayanan_publik,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'isi'						=> $this->up_pkpb_file->data('file_name')
				);

				$this->menu_peningkatan_kualitas_pelayanan_publik_m->update($id_peningkatan_kualitas_pelayanan_publik, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/peningkatan-kualitas-pelayanan-publik-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/peningkatan-kualitas-pelayanan-publik-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_peningkatan_kualitas_pelayanan_publik = $this->POST('id_peningkatan_kualitas_pelayanan_publik_del');
			$file_lama = $this->menu_peningkatan_kualitas_pelayanan_publik_m->get_row(array('id_peningkatan_kualitas_pelayanan_publik' => $id_peningkatan_kualitas_pelayanan_publik))->isi;
			unlink($this->base_filedir . "/capaian/Peningkatan Kualitas Pelayanan Publik/" . $file_lama);

			if ($this->menu_peningkatan_kualitas_pelayanan_publik_m->delete($this->POST('id_peningkatan_kualitas_pelayanan_publik_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/peningkatan-kualitas-pelayanan-publik-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/peningkatan_kualitas_pelayanan_publik_management';
		$this->template_admin($this->data);
	}

	public function buletin_management(){
		$this->load->model('menu_buletin_m');

		$this->data['Buletin'] = $this->menu_buletin_m->get();

		$id_buletin = $this->uri->segment(3);

		if (isset($id_buletin)){
			$data = $this->menu_buletin_m->get_row(array('id_buletin' => $id_buletin));
			echo json_encode($data);
			exit;
		}

		if ($this->POST('tambah')){
			$cover_name = $this->session->userdata('cover_name');
			$dokumen_name = $this->session->userdata('dokumen_name');

			$required = array($cover_name, $dokumen_name);

			if (empty($cover_name) && empty($dokumen_name))
			{
				$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
				redirect('editor/buletin-management');
				exit;
			}

			$data = array(
				'title' 		=> $this->POST('title'),
				'deskripsi'		=> $this->POST('deskripsi'),
				'tahun'			=> $this->POST('tahun'),
				'cover'			=> $this->session->userdata('cover_name'),
				'dokumen'		=> $this->session->userdata('dokumen_name')
			);
			
			$this->session->unset_userdata('cover_name');
			$this->session->unset_userdata('dokumen_name');

			if ($this->menu_buletin_m->insert($data))	
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/buletin-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_buletin = $this->POST('id_buletin_baru');
			// $cover_lama = $this->menu_buletin_m->get_row(array('id_buletin' => $id_buletin))->cover;
			// $dokumen_lama = $this->menu_buletin_m->get_row(array('id_buletin' => $id_buletin))->dokumen;
			// unlink($this->base_filedir . "/buletin/cover/" . $cover_lama);
			// unlink($this->base_filedir . "/buletin/dokumen/" . $dokumen_lama);

			if (!empty($id_buletin)){
				$cover_name = $this->session->userdata('cover_name');
				$dokumen_name = $this->session->userdata('dokumen_name');

				$required = array($cover_name, $dokumen_name);

				if (empty($cover_name) && empty($dokumen_name))
				{
					$this->flashmsg("<i class='fa fa-warning'></i> Penambahan data gagal, anda harus mengisi data dengan lengkap",'warning');
					redirect('editor/buletin-management');
					exit;
				}
				$data = array(
					'title' 		=> $this->POST('title_baru'),
					'deskripsi'		=> $this->POST('deskripsi_baru'),
					'tahun'			=> $this->POST('tahun_baru'),
					'cover'			=> $this->session->userdata('cover_name'),
					'dokumen'		=> $this->session->userdata('dokumen_name')
				);

				$this->session->unset_userdata('cover_name');
				$this->session->unset_userdata('dokumen_name');
			
				$this->menu_buletin_m->update($id_buletin, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Anda berhasil mengedit data');
				redirect('editor/buletin-management');
				exit;
				
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal mengedit data', 'danger');
				redirect('editor/buletin-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_buletin = $this->POST('id_buletin_del');
			$cover_lama = $this->menu_buletin_m->get_row(array('id_buletin' => $id_buletin))->cover;
			$dokumen_lama = $this->menu_buletin_m->get_row(array('id_buletin' => $id_buletin))->dokumen;
			unlink($this->base_filedir . "/buletin/cover/" . $cover_lama);
			unlink($this->base_filedir . "/buletin/dokumen/" . $dokumen_lama);

			if ($this->menu_buletin_m->delete($this->POST('id_buletin_del'), $data))
				$this->flashmsg('<i class="fa fa-check"></i> Anda berhasil menghapus data');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
				redirect('editor/buletin-management');
				exit;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/buletin_management';
		$this->template_admin($this->data);
	}

	public function coverUploader(){
		$name_file = $_FILES['cover']['name'];
		if (file_exists($this->base_filedir . "/buletin/cover/" . $name_file)){
	    	unlink($this->base_filedir . "/buletin/cover/" . $name_file);
	    }
		$config = array();
	    $config['upload_path'] = $this->base_filedir . "/buletin/cover/";
	    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
	    $config['max_size'] = '100000';
	    $this->load->library('upload', $config, 'up_cover_file'); //Custom pasfoto upload config.	    

	    if(!$this->up_cover_file->do_upload('cover'))
	    {
	    	$data['error'] = 'The following error occured : '.$this->up_cover_file->display_errors().'Click on "Remove" and try again!';
            echo json_encode($data);
	    } else {
            echo json_encode("success"); 
        }

	    //Store pas foto data array on a variable
	    $cover_name = array('cover_name'=>$this->up_cover_file->data('file_name'));
	    $this->session->set_userdata($cover_name);
	}

	public function coverEditUploader(){
		$name_file = $_FILES['cover_baru']['name'];
		if (file_exists($this->base_filedir . "/buletin/cover/" . $name_file)){
	    	unlink($this->base_filedir . "/buletin/cover/" . $name_file);
	    }
		$config = array();
	    $config['upload_path'] = $this->base_filedir . "/buletin/cover/";
	    $config['allowed_types'] = 'jpeg|jpg|png|bmp';
	    $config['max_size'] = '100000';
	    $this->load->library('upload', $config, 'up_cover_file'); //Custom pasfoto upload config.	    

	    if(!$this->up_cover_file->do_upload('cover_baru'))
	    {
	    	$data['error'] = 'The following error occured : '.$this->up_cover_file->display_errors().'Click on "Remove" and try again!';
            echo json_encode($data);
	    }else{
            echo json_encode("success"); 
        }

	    //Store pas foto data array on a variable
	    $cover_name = array('cover_name'=>$this->up_cover_file->data('file_name'));
	     $this->session->set_userdata($cover_name);
	}

	public function dokumenUploader(){
		$name_file = $_FILES['dokumen']['name'];
		if (file_exists($this->base_filedir . "/buletin/dokumen/" . $name_file)){
	    	unlink($this->base_filedir . "/buletin/dokumen/" . $name_file);
	    }
		$config = array();
	    $config['upload_path'] = $this->base_filedir . "/buletin/dokumen/";
	    $config['allowed_types'] = 'pdf';
	    $config['max_size'] = '1000000';
	    $this->load->library('upload', $config, 'up_dok_file'); //Custom pasfoto upload config.	    

	    if(!$this->up_dok_file->do_upload('dokumen'))
	    {
	    	$data['error'] = 'The following error occured : '.$this->up_dok_file->display_errors().'Click on "Remove" and try again!';
            echo json_encode($data);
	    }else{
            echo json_encode("success"); 
        }

	    //Store pas foto data array on a variable
	    $dokumen_name = array('dokumen_name'=>$this->up_dok_file->data('file_name'));
	     $this->session->set_userdata($dokumen_name);
	}

	public function dokumenEditUploader(){
		$name_file = $_FILES['dokumen_baru']['name'];
		if (file_exists($this->base_filedir . "/buletin/dokumen/" . $name_file)){
	    	unlink($this->base_filedir . "/buletin/dokumen/" . $name_file);
	    }
		$config = array();
	    $config['upload_path'] = $this->base_filedir . "/buletin/dokumen/";
	    $config['allowed_types'] = 'pdf';
	    $config['max_size'] = '1000000';
	    $this->load->library('upload', $config, 'up_dok_file'); //Custom pasfoto upload config.	    

	    if(!$this->up_dok_file->do_upload('dokumen_baru'))
	    {
	    	$data['error'] = 'The following error occured : '.$this->up_dok_file->display_errors().'Click on "Remove" and try again!';
            echo json_encode($data);
	    }else{
            echo json_encode("success"); 
        }

	    //Store pas foto data array on a variable
	    $dokumen_name = array('dokumen_name'=>$this->up_dok_file->data('file_name'));
	     $this->session->set_userdata($dokumen_name);
	}

	public function ikm_management()
	{
		$this->load->model('menu_ikm_m');
		$this->load->model('user_m');
		$this->load->model('admin_m');

		$id_ikm = $this->uri->segment(3);

		$this->data['IKM'] = $this->menu_ikm_m->get(array('id_ikm'));

		if (isset($id_ikm)) 
		{
			$data = $this->menu_ikm_m->get_row(array('id_ikm'=>$id_ikm));
			echo json_encode($data);
			exit;
		}

		if($this->POST('tambah')){
			$config = array();
		    $config['upload_path'] = $this->base_filedir . "/ikm/";

		    $config['allowed_types'] = 'pdf';
		    $config['max_size'] = '100000';
		    $this->load->library('upload', $config, 'up_ikm_file'); //Custom pasfoto upload config.

		    if(!$this->up_ikm_file->do_upload('dokumen'))
		    {
		    	//show error messages
		    	$this->flashmsg("Error on pas foto file:" . $this->up_ikm_file->display_errors(),'danger');
				redirect('editor/ikm-management');
				exit;
		    }

		    //Store pas foto data array on a variable
		    $ikm_file = $this->up_ikm_file->data();

			$data = array(
				'id_user'	=> $this->data['editor']->id_user,
				'title' 	=> $this->POST('title'),
				'tahun' 	=> $this->POST('tahun'),
				'isi'		=> $this->up_ikm_file->data('file_name'),
				'tanggal'	=> date("Y-m-d H:i:s")
			);
			
			if ($this->menu_ikm_m->insert($data)) 
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
			else 
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/ikm-management');
				exit;
		}

		if ($this->POST('edit')){
			$id_ikm = $this->POST('id_ikm_baru');
			$file_lama = $this->menu_ikm_m->get_row(array('id_ikm' => $id_ikm))->isi;

			if (!empty($id_ikm)) {
				$config = array();
			    $config['upload_path'] = $this->base_filedir . "/ikm/";

			    $config['allowed_types'] = 'pdf';
			    $config['max_size'] = '100000';
			    $this->load->library('upload', $config, 'up_ikm_file'); //Custom pasfoto upload config.

			    if(!$this->up_ikm_file->do_upload('dokumen_baru'))
			    {
			    	//show error messages
			    	$this->flashmsg("Error on pas foto file:" . $this->up_ikm_file->display_errors(),'danger');
					redirect('editor/ikm-management');
					exit;
			    }

			    unlink($this->base_filedir . "/ikm/" . $file_lama);

			    $this->up_ikm_file->do_upload('dokumen_baru');

			    //Store pas foto data array on a variable
			    $ikm_file = $this->up_ikm_file->data();

				$data = array(
					'id_ikm'	=> $id_ikm,
					'id_user'					=> $this->data['editor']->id_user,
					'title'					 	=> $this->POST('title_baru'),
					'tahun' 					=> $this->POST('tahun_baru'),
					'isi'						=> $this->up_ikm_file->data('file_name')
				);

				$this->menu_ikm_m->update($id_ikm, $data);
				$this->flashmsg('<i class="fa fa-check"></i> Data Anda berhasil disimpan');
				redirect('editor/ikm-management');
				exit;
			} else {
				$this->flashmsg('<i class="fa fa-warning"></i> Gagal menambah data', 'danger');
				redirect('editor/ikm-management');
				exit;
			}
		}

		if ($this->POST('delete')){
			$id_ikm = $this->POST('id_ikm_del');
			$file_lama = $this->menu_ikm_m->get_row(array('id_ikm' => $id_ikm))->isi;
			unlink($this->base_filedir . "/ikm/" . $file_lama);

			if ($this->menu_ikm_m->delete($this->POST('id_ikm_del')))
			$this->flashmsg('<i class="fa fa-check"></i> Berhasil menghapus data');
			else $this->flashmsg('<i class="fa fa-warning"></i> Gagal menghapus data', 'danger');
			redirect('editor/ikm-management');
			exit;
		} 

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/ikm_management';
		$this->template_admin($this->data);
	}

	public function ipk_management()
	{
		$this->load->model('menu_ipk_responden');
		$this->load->model('menu_ipk_kuisioner');

		$this->data['IPK'] = $this->menu_ipk_responden->get();
		$this->data['ipk_total'] = $this->menu_ipk_kuisioner->get_ipk();
		
		$_ipk = $this->menu_ipk_responden->get(array('id_responden'));
		
		foreach($_ipk as $ipk)
		{	
			$ipk_by_id[$ipk->id_responden] = $this->menu_ipk_kuisioner->get_ipk_by_id($ipk->id_responden);
			$this->data['ipk_by_id'] = 	$ipk_by_id;
		}

		$this->data['title']	= $this->title;
		$this->data['content']	= 'editor/ipk_management';
		$this->template_admin($this->data);
	}

	public function getDataResponden()
	{
		$this->load->model('menu_ipk_responden');
		$this->load->model('menu_ipk_kuisioner');

		$this->data['IPK'] = $this->menu_ipk_responden->get();
		$this->data['ipk_total'] = $this->menu_ipk_kuisioner->get_ipk();

		foreach ($this->menu_ipk_responden->get() as $value) {
			# code...
			if($value->status == 1){
				$array[]= array(
			   		$value->id_responden,
	           		$value->nama,
	           		$value->jabatan,
	           		$value->nama_instansi,
	           		$value->alm_instansi,
	           		$value->tlp_instansi,
	           		$value->kota,
	           		$value->tanggal,
	           		'<b><span class="label label-default">'.number_format($this->menu_ipk_kuisioner->get_ipk_by_id($value->id_responden),2).'</span></b>',
           			'<div class="btn-group" role="group" aria-label="...">
                    <a data-id="'.$value->id_responden.'" class="btn btn-xs btn-default unpublish"><i class="fa fa-times-circle-o"></i> Unpublish</a>
                 	</div>');
				$output= array_values($array);
			} else {
				$array[]= array(
			   		$value->id_responden,
	           		$value->nama,
	           		$value->jabatan,
	           		$value->nama_instansi,
	           		$value->alm_instansi,
	           		$value->tlp_instansi,
	           		$value->kota,
	           		$value->tanggal,
	           		'<b><span class="label label-default">'.number_format($this->menu_ipk_kuisioner->get_ipk_by_id($value->id_responden),2).'</span></b>',
           			'<div class="btn-group" role="group" aria-label="...">
           			<a data-id="'.$value->id_responden.'" class="btn btn-xs btn-primary publish"><i class="fa fa-times-circle-o"></i> Publish</a>
                 	</div>');
				$output= array_values($array);
			}
		}
		echo json_encode(array('data'=> $output));
	}

	public function getDataPublished()
	{
		$this->load->model('menu_ipk_responden');
		$this->load->model('menu_ipk_kuisioner');

		$this->data['IPK'] = $this->menu_ipk_responden->get();
		$this->data['ipk_total'] = $this->menu_ipk_kuisioner->get_ipk();

		foreach ($this->menu_ipk_responden->get(array('status' => 1)) as $value) {
			# code...
			if($value->status == 1){
				$array[]= array(
			   		$value->id_responden,
	           		$value->nama,
	           		$value->jabatan,
	           		$value->nama_instansi,
	           		$value->alm_instansi,
	           		$value->tlp_instansi,
	           		$value->kota,
	           		$value->tanggal,
	           		'<b><span class="label label-default">'.number_format($this->menu_ipk_kuisioner->get_ipk_by_id($value->id_responden),2).'</span></b>',
           			'<div class="btn-group" role="group" aria-label="...">
                    <a data-id="'.$value->id_responden.'" class="btn btn-xs btn-default unpublish"><i class="fa fa-times-circle-o"></i> Unpublish</a>
                 	</div>');
				$output= array_values($array);
			} else {
				$array[]= array(
			   		$value->id_responden,
	           		$value->nama,
	           		$value->jabatan,
	           		$value->nama_instansi,
	           		$value->alm_instansi,
	           		$value->tlp_instansi,
	           		$value->kota,
	           		$value->tanggal,
	           		'<b><span class="label label-default">'.number_format($this->menu_ipk_kuisioner->get_ipk_by_id($value->id_responden),2).'</span></b>',
           			'<div class="btn-group" role="group" aria-label="...">
           			<a data-id="'.$value->id_responden.'" class="btn btn-xs btn-primary publish"><i class="fa fa-times-circle-o"></i> Publish</a>
                 	</div>');
				$output= array_values($array);
			}
		}
		echo json_encode(array('data'=> $output));
	}

	public function publishDataResponden()
	{
		$this->load->model('menu_ipk_responden');
		$this->load->model('menu_ipk_kuisioner');

		$id = $this->POST('id_responden');
		// $this->menu_ipk_responden->set_publish($id);

		if ($this->POST('publish')){
			$data_responden = array(
				'status'	=> 1
			);

			$data_kuisioner = array(
				'status'	=> 1
			);

			$this->menu_ipk_responden->update($id, $data_responden);
			$this->menu_ipk_kuisioner->update_where(array('id_responden' => $id), $data_kuisioner);
		} 
		elseif ($this->POST('unpublish')) {
			$data_responden = array(
				'status'	=> 0
			);

			$data_kuisioner = array(
				'status'	=> 0
			);

			$this->menu_ipk_responden->update($id, $data_responden);
			$this->menu_ipk_kuisioner->update_where(array('id_responden' => $id), $data_kuisioner);
		}	
	}

	public function data_ipk()
	{
		$this->load->model('menu_ipk_kuisioner');

		echo json_encode(array(
			'ipk'=> number_format($this->menu_ipk_kuisioner->get_ipk(),2)
		));
	}
}
