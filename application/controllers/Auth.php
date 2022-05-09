<?php
/*
-- ---------------------------------------------------------------
-- MARKETPLACE MULTI BUYER MULTI SELLER + SUPPORT RESELLER SYSTEM
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-03-27
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	function city(){
		$state_id = $this->input->post('stat_id');
		$data['kota'] = $this->model_app->view_where_ordering('rb_kota',array('provinsi_id' => $state_id),'kota_id','DESC')->result_array();
		$this->load->view(template().'/view_city',$data);		
	}

	// public function register(){
	// 	if (isset($_POST['submit1'])){


			
	// 		$this->form_validation->set_rules('e','No Hp','required|is_unique[rb_konsumen.no_hp]');

	// 		if($this->form_validation->run() === FALSE){
    //      	$data['title'] = 'Formulir Pendaftaran';
	// 		$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
	// 		$this->load->view('phpmu-tigo/view_register',$data);
    //     	}else{
	//         $number = array('0','1','2','3','4','5','6','7','8','9');
	// 		shuffle($number);

			 

	// 	    $num_chars = 5;
	// 	    $token = '';

	// 	    for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len
	// 	        $token .= $number[mt_rand(0, $num_chars)];
	// 	    }
	// 	    $token = $token;
	// 		$data = array(
	//         			  'password'=>hash("sha512", md5($this->input->post('b'))),
	//         			  'nama_lengkap'=>$this->input->post('c'),
	        			
	        			 
	// 					  'no_hp'=>$this->input->post('e'),
	// 					  'kode_otp'=>$token,
	// 					  'active'=>'y',
	// 					  'tanggal_daftar'=>date('Y-m-d H:i:s'));

	// 		$this->model_app->insert('rb_konsumen',$data);
	// 		$id = $this->db->insert_id();
	// 		$this->session->set_userdata(array('id_konsumen'=>$id, 'level'=>'konsumen','no_hp'=>$this->input->post('e'),'kode_otp'=>$token,'no_h'=>$this->input->post('e')));

	

	// 			//redirect('auth/verifikasi');
				
	// 				redirect('kuis/', 'refresh');
			
	// 		}
		
	// 	}else{
	// 		$data['title'] = 'Formulir Pendaftaran';
	// 		$data['provinsi'] = $this->model_app->view_ordering('rb_provinsi','provinsi_id','ASC');
	// 		$this->load->view('phpmu-tigo/view_register',$data);
	// 	}
	// }
	public function register(){
		
			$data['title'] = 'User Login';
			$this->load->view('phpmu-tigo/view_register',$data);
		
	}
	public function login(){
		

			$cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
			if($cabang['status'] == 'sekolah'){
				$data['title'] = 'User Login';
				
			$this->load->view('phpmu-tigo/view_login',$data);
			}else{
				exit();
			}
			
		
	}

	function doRegister(){
		$this->form_validation->set_rules('no_hp','No.Hp','required|is_unique[siswa.no_hp]');
               
        $this->form_validation->set_rules('email','Email','required|is_unique[siswa.email]');
                 $config['upload_path']          = './asset/foto_siswa/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 10000;
                $config['encrypt_name'] = TRUE;
                
                
              
                
               

                $this->load->library('upload', $config);

              
                if ( ! $this->upload->do_upload('file')){
                
                 $foto = 'profile.svg';
                }else{
                    $f = $this->upload->data();
                 $foto = $f['file_name'];
                }

                if($this->form_validation->run() === FALSE){
                    
                    
                    $status=  false;
					$msg = 'Email atau No. Hp Telah Dgunakan';

                }else{
                    $status = true;
					$msg = '';
               
                $data = array('nama_lengkap'=>$this->input->post('nama_lengkap'),'email'=>$this->input->post('email'),'no_hp'=>$this->input->post('no_hp'),'kelas'=>$this->input->post('kelas'),'nama_sekolah'=>$this->input->post('nama_sekolah'),'nama_wali'=>$this->input->post('nama_wali'),'password'=>$this->encrypt->encode($this->input->post('password'),keys()),'foto_profile'=>$foto);            	           
                    
                $id = $this->model_app->insert_id('siswa',$data);
                update_session($id,date('Y-m-d'));
				$this->session->set_userdata(array('id_siswa'=>$this->encrypt->encode($id,keys()), 'level'=>'siswa','no_hp'=>$this->input->post('no_hp')));

               }
			   echo json_encode(array('status'=>$status,'msg'=>$msg));
	}
	function loginpegawai(){
		if (isset($_POST['login'])){
			$cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
			 $no_ktp = strip_tags($this->input->post('a'));
			 $password = hash("sha512", md5(strip_tags($this->input->post('b'))));
			 $cek = $this->db->query("SELECT * FROM pegawai where no_ktp='".$this->db->escape_str($no_ktp)."' AND password='".$this->db->escape_str($password)."'");
			 $row = $cek->row_array();
			 $total = $cek->num_rows();
			 if ($total > 0){
				 if($row['id_sd'] == $cabang['id_sd']){
					 $this->session->set_userdata(array('pegawai'=>array('id_pegawai'=>$row['id_pegawai'],'level'=>'pegawai','id_sd'=>$row['id_sd'])));
					
			 
				 $referred_from = $this->session->userdata('referred_from');
				 redirect($referred_from);
				
				 }else{
					 $data['title'] = 'Gagal Login';
					 $this->session->set_flashdata('message', 'Maaf, No KTP Anda Tidak Terdaftar pada Desa/Kelurahan ini!');
					 $this->load->view('phpmu-tigo/view_login_peg',$data);
				 }
					 
			 
			 }else{
				 $data['title'] = 'Gagal Login';
				 $this->session->set_flashdata('message', 'Maaf, No Ktp atau password salah!');
				 $this->load->view('phpmu-tigo/view_login_peg',$data);

				 
			 }
	 }else{
		 $data['title'] = 'User Login';
		 $this->load->view('phpmu-tigo/view_login_peg',$data);
	 }
	}
	function doLogin(){
		$cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
		if($cabang['status'] == 'sekolah'){
		$nohp = $this->input->post('nohp');
		$pass = $this->input->post('pass');
		$cek = $this->model_app->view_where('siswa',array('no_hp'=>$nohp,'id_sd'=>$cabang['id_sd']));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$ps = $this->encrypt->decode($row['password'],keys());
			if($row['active']== 'y'){
				if(trim($ps) == trim($pass)){
					$this->session->set_userdata(array('id_siswa'=>$this->encrypt->encode($row['id_siswa'],keys()), 'level'=>'siswa','no_hp'=>$row['no_hp']));
					$this->session->set_flashdata('welcome','Halo,');
					$username= $row['no_hp'];
					$id = $row['id_siswa'];
					update_session($row['id_siswa'],date('Y-m-d'));
					if(!$this->session->userdata('referred_from')){
						echo base_url('main');
					}else{
						echo $this->session->userdata('referred_from');
					}
					
				}else{
					echo 1;
				}
	
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
		}else{
			exit();
		}
	}
	public function verifikasi()
	{
		cek_session_members();

		if(isset($_POST['verif']))
		{
			$id = $this->input->post('id');
			$no_hp = $this->input->post('no_hp');
			$kode = $this->input->post('kode');

			$cek = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$id,'kode_otp'=>$kode))->num_rows();
			if($cek > 0)
			{
				$data = array('active'=>'y');
				$where = array('id_konsumen'=>$id);
				$this->model_app->update('rb_konsumen',$data,$where);
				$referred_from = $this->session->userdata('referred_from');
				redirect($referred_from, 'refresh');
			}else{
				$this->session->set_flashdata('message', 'Kode yang anda masukan Salah!');
				redirect('auth/verifikasi');
			}
		}else{
		$id = $this->session->id_konsumen;
		$no_hp = $this->session->no_hp;
		$kode_otp = $this->session->kode_otp;

		$data['id']= $id;
		$data['no_hp']=$no_hp;

		if($kode_otp == ''){
			
			 $number = array('0','1','2','3','4','5','6','7','8','9');
			shuffle($number);

			 

		    $num_chars = 5;
		    $token = '';

		    for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len
		        $token .= $number[mt_rand(0, $num_chars)];
		    }
		    $token = $token;

		    $this->model_app->update('rb_konsumen',array('kode_otp'=>$token),array('id_konsumen'=>$id));
			}

		$data['title'] = 'Verifikasi';
		
		
		$this->load->view('phpmu-tigo/view_verifiy',$data);
		}
		
		
	}
	public function cek_verif()
	{

	}
	public function loginmobile(){
		if (isset($_POST['login'])){
				$username = strip_tags($this->input->post('a'));
				$password = hash("sha512", md5(strip_tags($this->input->post('b'))));
				$cek = $this->db->query("SELECT * FROM rb_konsumen where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
			    $row = $cek->row_array();
			    $total = $cek->num_rows();
				if ($total > 0){
					$this->session->set_userdata(array('id_konsumen'=>$row['id_konsumen'], 'level'=>'konsumen'));
					if ($this->session->idp!=''){
						$data = array('kode_transaksi'=>$this->session->idp,
			        			  'id_pembeli'=>$row['id_konsumen'],
			        			  'id_penjual'=>$this->session->reseller,
			        			  'status_pembeli'=>'konsumen',
			        			  'status_penjual'=>'reseller',
			        			  'waktu_transaksi'=>date('Y-m-d H:i:s'),
			        			  'proses'=>'0');
						$this->model_app->insert('rb_penjualan',$data);
						$id = $this->db->insert_id();

						$query_temp = $this->db->query("SELECT * FROM rb_penjualan_temp where session='".$this->session->idp."'");
						foreach ($query_temp->result_array() as $r) {
							if($r['diskon'] == NULL )
							{
								$r['diskon'] = 0;
							}
							$data = array('id_penjualan'=>$id,
			        			  'id_produk'=>$r['id_produk'],
			        			  'jumlah'=>$r['jumlah'],
			        			  'diskon'=>$r['diskon'],
			        			  'harga_jual'=>$r['harga_jual'],
			        			  'satuan'=>$r['satuan']);
							$this->model_app->insert('rb_penjualan_detail',$data);
						}
						$this->db->query("DELETE FROM rb_penjualan_temp where session='".$this->session->idp."'");

						$this->session->unset_userdata('reseller');
						$this->session->unset_userdata('idp');
						$this->session->set_userdata(array('idp'=>$id));	
					}
					redirect('members/profile');
					
				}else{
					$data['title'] = 'Gagal Login';
					echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Maaf, Username atau password salah!</center></div>');
					redirect('auth/loginmobile');
				}
		}else{
			$data['title'] = 'User Login';
			$this->template->load(template().'/template',template().'/reseller/m_view_login',$data);
		}
	}
	public function lupa_password(){
		if(isset($_POST['kirim']))
		{
			$email = $this->input->post('a');
			$cek = $this->model_app->view_where('rb_konsumen',array('email'=>$email));

			if($cek->num_rows() >0){
			$row = $cek->row_array();
			$number = array('0','1','2','3','4','5','6','7','8','9');
			shuffle($number);

			 

		    $num_chars = 5;
		    $token = '';

		    for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len
		        $token .= $number[mt_rand(0, $num_chars)];
		    }
		    $token = $token;

		    $this->model_app->update('rb_konsumen',array('kode_reset'=>$token),array('email'=>$email));
				$msg = "<table width='100%'>
				   <tr>

				     <td>Tebak Angka Madam Cha</td>
				   </tr>
				   <tr>
				     <td><hr></td>
				   </tr>
				   <tr>
				     <td>Halo $row[nama_lengkap],</td>
				   </tr>
				   <tr>
				     <td>Kami menerima permintaan untuk mengatur ulang kata sandi Facebook Anda.
				Masukkan kode reset kata sandi berikut:</td>
				   </tr>
				   <tr>
				     <td width='100px' height='100px'><h1>$token</h1></td>
				   </tr>
				   <tr>
				    <td> Atau, anda bisa mengubah kata sandi secara langsung</td>
				   </tr>
				   <tr>
				     <td height='100px;'><a href='http://localhost/tebakangka/auth/resetpassword/?u=$row[id_konsumen]&n=$row[username]&e=$row[email]                                                                                                                                                               ' style='background-color:#15c;color: white;padding: 8px;'>Ubah Kata Sandi</a></td>
				   </tr>
				   <tr>
				    <td>
				     Jika anda tidak melakukan permintaan untuk mengatur ulang kata sandi anda, <font color='red'>Abaikan Email Ini</font>
				     </td>
				   </tr>
				   <tr>
				     <td></td>
				   </tr>
				   <tr>
				    <td>Terima Kasih <br> Toko Madam Cha</td>

				    </tr>
				 </table>";

		           $this->load->library('email');

				 


				    $mail_config['smtp_host'] = 'mail.tebakangkamadamcha.com';
					$mail_config['smtp_port'] = '587';
					$mail_config['smtp_user'] = 'support@tebakangkamadamcha.com';
					$mail_config['_smtp_auth'] = TRUE;
					$mail_config['smtp_pass'] = 'z_W_-HDB#T3(';
					$mail_config['smtp_crypto'] = 'tls';
					$mail_config['protocol'] = 'smtp';
					$mail_config['mailtype'] = 'html';
					$mail_config['send_multipart'] = FALSE;
					$mail_config['charset'] = 'utf-8';
					$mail_config['wordwrap'] = TRUE;
					$this->email->initialize($mail_config);
				


				    $this->email->from('support@tebakangkamadamcha.com', 'Tebak Angka Madam Cha');
				    $this->email->to($email); 
				    $subject = "Lupa Password | Kode : ".$token;
				    $this->email->subject($subject);
				    $this->email->message($msg);  

		          if($this->email->send()) {
		          	  $this->session->set_userdata('forget', $email); 
		          	  $data['title'] = 'Verifikasi Reset Password';
		              $this->load->view('phpmu-tigo/view_kode',$data);
		          }
		          else {
		               echo 'Email tidak berhasil dikirim';
		               echo '<br />';
		               echo $this->email->print_debugger();
		          }
			}else{
				$this->session->set_flashdata('message', 'Email tidak ditemukan!');
				redirect('auth/lupa_password');
			}
		}
		else{
			$data['title'] = 'Lupa Kata Sandi';
			$this->load->view('phpmu-tigo/view_sandi',$data);
		}
	}

	public function cek_kode()
	{
		if(isset($_POST['kirim'])){

				$kode = $this->input->post('kode');
				$email = $this->session->userdata('forget');

				$cek = $this->model_app->view_where('rb_konsumen',array('kode_reset'=>$kode,'email'=>$email));

				if($cek->num_rows() > 0 ){
					$row = $cek->row_array();
					$id = $row['id_konsumen'];
					$username = $row['username'];
					$email = $row['email'];

					redirect('auth/resetpassword/?u='.$id.'&n='.$username.'&e='.$email);
				}else{
					$this->session->set_flashdata('message', 'Kode Salah!');
					echo "gagal";
				}

		}else{
			 $data['title'] = 'Verifikasi Reset Password';
		     $this->load->view('phpmu-tigo/view_kode',$data);
		}
	}

	public function resetpassword()
	{

		if(isset($_POST['ubah'])){

				$pass = $this->input->post('password');
				$new_pass = hash("sha512", md5($pass));
				$id = $this->input->post('id');

				$this->model_app->update('rb_konsumen',array('password'=>$new_pass),array('id_konsumen'=>$id));
				$this->session->set_flashdata('message', 'Kata sandi berhasil diganti');
				redirect('auth/login');


		}else{
		$data['title'] = 'Reset Password';
		$id = $this->input->get('u');
		$username = $this->input->get('n');
		$email = $this->input->get('e');
		$data['id'] = $id;

		$cek = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$id,'username'=>$username,'email'=>$email));

		if($cek->num_rows()>0)
		{
			$data['title'] = 'Reset Password';
			$this->load->view('phpmu-tigo/view_reset',$data);
		}else{
			$this->session->set_flashdata('message', 'Format anda salah!');
			redirect('auth/login');
		}
		}



	}
	public function lupass(){
		if (isset($_POST['lupa'])){
			$email = strip_tags($this->input->post('a'));
			$cek = $this->db->query("SELECT * FROM rb_konsumen where email='".$this->db->escape_str($email)."'");
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$identitas = $this->db->query("SELECT * FROM identitas where id_identitas='1'")->row_array();
				$randompass = generateRandomString(10);
				$passwordbaru = hash("sha512", md5($randompass));
				$this->db->query("UPDATE rb_konsumen SET password='$passwordbaru' where email='".$this->db->escape_str($email)."'");

				if ($row['jenis_kelamin']=='Laki-laki'){ $panggill = 'Bpk.'; }else{ $panggill = 'Ibuk.'; }
				$email_tujuan = $row['email'];
				$tglaktif = date("d-m-Y H:i:s");
				$subject      = 'Permintaan Reset Password ...';
				$message      = "<html><body>Halooo! <b>$panggill ".$row['nama_lengkap']."</b> ... <br> Hari ini pada tanggal <span style='color:red'>$tglaktif</span> Anda Mengirimkan Permintaan untuk Reset Password
					<table style='width:100%; margin-left:25px'>
		   				<tr><td style='background:#337ab7; color:#fff; pading:20px' cellpadding=6 colspan='2'><b>Berikut Data Informasi akun Anda : </b></td></tr>
						<tr><td><b>Nama Lengkap</b></td>			<td> : ".$row['nama_lengkap']."</td></tr>
						<tr><td><b>Alamat Email</b></td>			<td> : ".$row['email']."</td></tr>
						<tr><td><b>No Telpon</b></td>				<td> : ".$row['no_hp']."</td></tr>
						
						<tr><td><b>Waktu Daftar</b></td>			<td> : ".$row['tanggal_daftar']."</td></tr>
					</table>
					<br> Username Login : <b style='color:red'>$row[username]</b>
					<br> Password Login : <b style='color:red'>$randompass</b>
					<br> Silahkan Login di : <a href='$identitas[url]'>$identitas[url]</a> <br>
					Admin, $identitas[nama_website] </body></html> \n";
				
				$this->email->from($identitas['email'], $identitas['nama_website']);
				$this->email->to($email_tujuan);
				$this->email->cc('');
				$this->email->bcc('');

				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();
				
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'utf-8';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);

				$data['email'] = $email;
				$data['title'] = 'Permintaan Reset Password Sudah Terkirim...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_success',$data);
			}else{
				$data['email'] = $email;
				$data['title'] = 'Email Tidak Ditemukan...';
				$this->template->load('phpmu-one/template','phpmu-one/view_lupass_error',$data);
			}
		}
	}
	function logoutpegawai(){
		cek_session_members();
		$this->CI->onlineusers->set_data('','');
		$this->session->sess_destroy();
		redirect('auth/loginpegawai');
	}
	function logout(){
		// cek_session_members();
		// $this->CI->onlineusers->set_data('','');
		$this->session->sess_destroy();

		redirect('auth/login');
	}
}
