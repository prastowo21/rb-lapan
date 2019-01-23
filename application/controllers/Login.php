<?php 
// require_once 'PHPMailerAutoload.php';
class Login extends MY_Controller
{
    protected $data;

    public function __construct()
    {
        parent::__construct();

        // jika sudah login, langsung redirect ke halaman lain
        $id_role = $this->session->userdata('id_role');
        if (isset($id_role))
        {
            switch ($id_role) {
                case 1:
                    redirect('admin');
                    break;
                case 2:
                    redirect('editor');
                    break;
                case 3:
                    redirect('dosen');
                    break;
                case 10:
                    redirect('mahasiswa');
                    break;
            }

            exit;
        }
    }

    public function index()
    {
        $this->load->model('login_m');

        // jika tombol login di-klik
        if ($this->POST('login'))
        {
            // jika username dan password diisi
            if ($this->login_m->validate_login())
            {
                // jika login berhasil
                if ($this->login_m->ceklogin($this->POST('username'), $this->POST('password')))
                {
                    redirect('login');
                    exit;
                }
            }
        }

        $this->load->view('login', array('title' => $this->title));

    }

    // url: localhost/login/documentation
    public function documentation()
    {
        $this->data['title']    = $this->title; // judul halaman web
        $this->data['content']  = 'documentation/blank_page'; // file tampilan pada folder view yang ingin di-load
        $this->template($this->data); // load view
    }

    function randomPassword()
    {
        // function untuk membuat password random 6 digit karakter

        $digit = 6;
        $karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

        srand((double)microtime()*1000000);
        $i = 0;
        $pass = "";
        while ($i <= $digit-1)
        {
            $num = rand() % 32;
            $tmp = substr($karakter,$num,1);
            $pass = $pass.$tmp;
            $i++;
        }
        return $pass;
    }

    public function resetPassword()
    {
        
        $this->load->model('admin_m');
        $this->load->model('user_m');

        if($this->POST('recover-submit')){
            $email = $this->admin_m->get_row(array('id_user' => $this->POST('username')))->email;
            $password = "Lapan123";

            if($this->user_m->get_row(array('id_user' => $this->POST('username'))) > 0){
                $data = array(
                    'password' => $this->bcrypt->hash_password($password)
                );

                $this->user_m->update($this->POST('username'), $data);
                $this->load->library('email');
                // $this->load->library('My_PHPMailer');
                // $mail = new PHPMailer();
                // $mail->IsSMTP(); 
                // $mail->SMTPAuth   = true; 
                // $mail->SMTPSecure = "ssl";  
                // $mail->Host       = "mail.lapan.go.id";      
                // $mail->Port       = 465;                   
                // $mail->Username   = "prastowo.dwi@lapan.go.id";  
                // $mail->Password   = "";            
                // $mail->SetFrom($mail->Username, "noreply - Admin RB Lapan");    
                // $mail->Subject    = "Password Reset";
                // $mail->Body       = "Password baru anda adalah: ".$password;
                // $mail->AltBody    = "Plain text message";
                // $mail->AddAddress($email, $email);

                $result = $this->email
                        ->from('prastowodwiatmoko@gmail.com', 'Admin RB Lapan')
                        ->to($email)
                        ->subject("Password Reset")
                        ->message("Password baru anda adalah: ".$password);
                        // $this->email->IsSMTP();

                if($this->email->send()){
                    $this->flashmsg('<i class="fa fa-check"></i> Password berhasil di reset, silahkan cek email/spam email Anda');
                    redirect('login/index');
                    exit;
                } else {
                    $this->flashmsg($this->email->print_debugger());
                    redirect('login/index');
                    exit;
                }
            } else {
                $this->flashmsg("Username Anda belum terdaftar",'danger');
                redirect('login/index');
                exit;
            }

            

            // $config = Array(
            // 'protocol' => 'smtp',
            //         'smtp_host' => 'ssl://smtp.gmail.com',
            //         'smtp_port' => 465,
            //         'smtp_user' => 'prastowodwiatmoko@gmail.com',
            //         'smtp_pass' => 'Malmst33n',
            //         'charset' => 'utf-8',
            //         'wordwrap' => TRUE
            //     ); 

            // $this->load->library('email', $config);

            // $this->email->from('prastowodwiatmoko@gmail.com', 'Prastowo Dwi Atmoko');
            // $this->email->to($email);

            // $this->email->subject('Email Test');
            // $this->email->message('You have requested the new password, Here is you new password:'. $this->randomPassword());

            // if($this->email->send()){
            //     $this->flashmsg('<i class="fa fa-check"></i> Anda telah berhasil mengubah password');
            //     redirect('login/index');
            //     exit;
            // } else {
            // $this->flashmsg("Ganti password gagal",'danger');
            //     redirect('login/index');
            //     exit;
            // }
            
        }
        
    }

    
}

/* End of file Login.php */
/* Location: ./application/controller/Login.php */