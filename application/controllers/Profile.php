<?php
/*
-- ---------------------------------------------------------------
-- PROFILE --
-- JUA KOPI --
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
 public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
          $this->session->set_userdata('referred_from', current_url()); 
		cek_session();
    }
	public function index()
	{
		
		$data['title']= 'Home - '.title();
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id,date('Y-m-d'));
        // $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
		$data['row'] = $this->db->query("SELECT * FROM siswa  a JOIN subdomain b ON a.id_sd = b.id_sd WHERE id_siswa = '".$id."' ")->row_array();
 
		$this->template->load('/phpmu-tigo/template','/phpmu-tigo/profile/view_profile',$data);

		
	}
	function getData(){
		$id = $this->encrypt->decode($this->session->id_siswa,keys());
        $data = $this->db->query("SELECT * FROM siswa a JOIN subdomain b ON a.id_sd = b.id_sd WHERE id_siswa = '".$id."'")->row_array();
        // $data = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
		echo json_encode($data);
	}
	function getKuis(){
		$id = $this->encrypt->decode($this->session->id_siswa,keys());
		$data = $this->db->query("SELECT * FROM quiz_partisipasi a JOIN quiz_date b ON a.qp_date = b.id_qd WHERE a.id_siswa ='".$id."' ORDER BY id_qp DESC LIMIT 30");
		$output = null;
		if($data->num_rows() > 0){
			foreach($data->result_array() as $row){
				if($row['qp_done'] == 'y'){
					$done = 'Selesai';
				}else{
					$done = 'Belum Selesai';
				}
				if($row['qp_poin'] <= 100 AND $row['qp_poin'] >= 75){
					$text = 'text-success';
					$poin = "<span class='h4 my-0 text-success'>90<small class='text-muted d-block'> Poin</small></span>";
				}else if($row['qp_poin'] <= 74 AND $row['qp_poin'] >= 50){
					$poin = "<span class='h4 my-0 text-warning'>90<small class='text-muted d-block'> Poin</small></span>";
					$text = 'text-warning';
					
				}else{
					$text = 'text-danger';

					$poin = "<span class='h4 my-0 text-danger'>90<small class='text-muted d-block'> Poin</small></span>";

				}
				$output .= "<li>
						<a href='' class='item'>
							
							<div class='in'>
								<div class='d-flex'>
									<div class='mr-2 mt-3'>
									".$poin."
									</div>
									<div class='mr-2 mt-3'>
									<span class='h4 my-0 ".$text." '>
										".format_indo_1($row['tanggal'])."
										<label class='text-muted d-block'>".$done."</label>
									</span>
									</div>
									

								</div>
							</div>
						</a>
					</li>";
			}
					
					
		}else{
			$output = "<li>
						<a href='' class='item'>
							
							<div class='in'>
								<div>
								
									Tidak ada history kuis
								</div>
							</div>
						</a>
					</li>";
		}
		echo $output;
	}

	function updateImage(){
	
			$config['upload_path'] =  './asset/foto_siswa/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '20000';
			$config['encrypt_name'] = TRUE;
		 

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')){
		$status = "error";

		}
		else{
		$dataupload = $this->upload->data();
		$status = "success";

		$id = $this->encrypt->decode($this->session->id_siswa,keys());
		$data = array('foto'=>base_url('asset/foto_siswa/').$dataupload['file_name']);
		$where = array('id_siswa'=>$id);
		$this->model_app->update('siswa',$data,$where);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status)));
		
	}
	function editProfile(){
		cek_session();
		$email = $this->input->post('email');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$no_hp = $this->input->post('no_hp');
		

		$id = $this->encrypt->decode($this->session->id_siswa,keys());
		$row = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
		if(trim($row['email']) != trim($email)  ){
			$cekEm = $this->db->query("SELECT * FROM siswa WHERE email != '".$row['email']."' AND email = '".$email."' ")->num_rows();
			if($cekEm > 0){
				$status = false;
				$msg = 'Email Telah Digunakan';
			}else{
				$data = array('nama_lengkap'=>$nama_lengkap,'email'=>$email,'no_hp'=>$no_hp);
				$this->model_app->update('siswa',$data,array('id_siswa'=>$id));
				$status = true;
				$msg = 'Profil Berhasil diperbaharui';
			}

		}else if(trim($row['no_hp']) != trim($no_hp)){
			$cekHp= $this->db->query("SELECT * FROM siswa WHERE no_hp != '".$row['no_hp']."' AND no_hp = '".$no_hp."' ")->num_rows();
			if($cekHp > 0){
				$status = false;
				$msg = 'No. Hp Telah Digunakan';
			}else{
				$data = array('nama_lengkap'=>$nama_lengkap,'email'=>$email,'no_hp'=>$no_hp);

				
				$this->model_app->update('siswa',$data,array('id_siswa'=>$id));
				$status = true;
				$msg = 'Profil Berhasil diperbaharui';
			}
		}else{
			$data = array('nama_lengkap'=>$nama_lengkap,'email'=>$email,'no_hp'=>$no_hp);

			$this->model_app->update('siswa',$data,array('id_siswa'=>$id));
			$status = true;
			$msg = 'Profil Berhasil diperbaharui';
		}
		
		echo json_encode(array('status'=>$status,'msg'=>$msg));

	
	}
	function editPassword(){
		$old = $this->input->post('oldpass');
		$passold = $this->encrypt->encode($old,keys());
		$id = $this->encrypt->decode($this->session->id_siswa,keys());
		$row = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
		if(trim($this->encrypt->decode($row['password'],keys())) == $old){
			$newpass = $this->input->post('newpass');
			$repass = $this->input->post('repass');
			if(trim($newpass) != trim($repass)){
				$status = false;
				$msg = 'Kata Sandi Tidak Sama!';
			}else{
				$password = $this->encrypt->encode($newpass,keys());
				$this->model_app->update('siswa',array('password'=>$password),array('id_siswa'=>$id));
				$status = true;
				$msg = 'Kata Sandi Berhasil Dirubah!';
			}
		}else{
			$status = false;
			$msg = 'Kata Sandi Lama Anda Salah!';
		}
		echo json_encode(array('status'=>$status,'msg'=>$msg));


	}


}

	

