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

class Administrator extends CI_Controller {
     public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        $this->key = "sdnpolewaliencryptsecure2021abcdef045623189122132741729321395+61235612412130.";
    }
	function index(){
		if (isset($_POST['submit'])){
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array(); 
          $username = $this->input->post('a');
    			$password = hash("sha512", md5($this->input->post('b')));
    			$cek = $this->model_app->cek_login($username,$password,'users',$cabang['id_sd']);
    		    $row = $cek->row_array();
    		    $total = $cek->num_rows();
    			if ($total > 0){
    				$this->session->set_userdata('upload_image_file_manager',true);
    				$this->session->set_userdata(array('username'=>$row['username'],
    								   'level'=>$row['level'],
                                       'id_session'=>$row['id_session']));
    				redirect($this->uri->segment(1).'/home');
    			}else{
                    echo $this->session->set_flashdata('message', '<div class="alert alert-danger"><center>Username dan Password Salah!!</center></div>');
    				redirect($this->uri->segment(1).'/index');
    			}
            
		}else{
            if ($this->session->level!=''){
              redirect($this->uri->segment(1).'/home');
            }else{
                
    			$data['title'] = 'Administrator &rsaquo; Log In';
    			$this->load->view('administrator/view_login',$data);
            }
		}
	}
    function grafikPegawai(){
      if($this->input->method() == 'post'){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $status = $this->input->post('status');
          if($status == 'hari'){
              $start = date('Y-m-d');
              $end = date('Y-m-d');
          }else if($status == 'minggu'){
            $start = date('Y-m-d', strtotime( 'monday this week' ));
            $end = date('Y-m-d', strtotime( 'sunday this week' ));
          }else if($status == 'bulan'){
            $start = date('Y-m-01');
            $end = date('Y-m-t');
          }else{
            $start = date('Y-m-d', strtotime( 'monday this week' ));
            $end = date('Y-m-d', strtotime( 'sunday this week' ));
          }
          $startTime = new DateTime($start);
          $endTime = new DateTime($end);
          $xTotal = array();
          $arrTanggal = array();
          $data = null;
          $arrAbsen = array();
          $arrTidak = array();
          $arrDL = array();
          $arrTL = array();
     
          $pegawai = $this->model_app->view_where('pegawai',array('id_sd'=>$cabang['id_sd'],'aktif'=>'y'))->num_rows();
          for($a=$startTime;$a<=$endTime;$a->modify('+1 day')){
            // $dt = date('Y').'-'.$bulan.'-'.$a;
            // $tanggal = $start;
            $date =$a->format("Y-m-d");
            $cek = $this->db->query("SELECT* FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai  WHERE id_sd = '".$cabang['id_sd']."' AND a.tanggal = '".$date."'  AND status_absen = 'pegawai'");
            $cekAbsen = $this->db->query("SELECT* FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai  WHERE id_sd = '".$cabang['id_sd']."' AND a.tanggal = '".$date."' AND ket='absen' AND status_absen = 'pegawai'");
            $cekDL = $this->db->query("SELECT* FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai  WHERE id_sd = '".$cabang['id_sd']."' AND a.tanggal = '".$date."' AND ket='dinas' AND status_absen = 'pegawai'");
            $cekTL = $this->db->query("SELECT* FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai  WHERE id_sd = '".$cabang['id_sd']."' AND a.tanggal = '".$date."' AND ket='tugas' AND status_absen = 'pegawai'");
            


            
            $arrTanggal[] = format_indow($date);
            $arrAbsen[] = $cekAbsen->num_rows();
            $arrTidak[] = $pegawai - $cek->num_rows();
            $arrDL[] = $cekDL->num_rows();
            $arrTL[] = $cekTL->num_rows();
           
            


            
            
            // $data[] = array('y'=>$cek->num_rows(),'x'=>format_indow($date));

          }
          $data = array('tanggal'=>$arrTanggal,'absen'=>$arrAbsen,'tidak'=>$arrTidak,'dl'=>$arrDL,'tl'=>$arrTL);
        
          echo json_encode($data);
      }
    }
    function grafikGuru(){
      if($this->input->method() == 'post'){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $status = $this->input->post('status');
          if($status == 'hari'){
              $start = date('Y-m-d');
              $end = date('Y-m-d');
          }else if($status == 'minggu'){
            $start = date('Y-m-d', strtotime( 'monday this week' ));
            $end = date('Y-m-d', strtotime( 'sunday this week' ));
          }else if($status == 'bulan'){
            $start = date('Y-m-01');
            $end = date('Y-m-t');
          }else{
            $start = date('Y-m-d', strtotime( 'monday this week' ));
            $end = date('Y-m-d', strtotime( 'sunday this week' ));
          }
          $startTime = new DateTime($start);
          $endTime = new DateTime($end);
          $arrTotal = array();
          $arrTanggal = array();
          $data = null;
          if($cabang['status'] == 'sekolah'){
              $id_sd = $cabang['id_sd'];
          }else{
            $sekolah = $this->input->post('sekolah');
            if($sekolah == null){
              $dt = $this->db->query("SELECT * FROM subdomain WHERE status = 'sekolah' ORDER BY id_sd DESC LIMIT 1")->row_array();
              $id_sd = $dt['id_sd'];
            }else{
              $id_sd = decode($sekolah);

            }
          }
          $arrAbsen = array();
          $arrTidak = array();
          $arrDL = array();
          $arrTL = array();
          $pegawai = $this->model_app->view_where('guru',array('id_sd'=>$id_sd,'status'=>'active'))->num_rows();

          for($a=$startTime;$a<=$endTime;$a->modify('+1 day')){
            // $dt = date('Y').'-'.$bulan.'-'.$a;
            // $tanggal = $start;
            $date =$a->format("Y-m-d");
            $cek = $this->db->query("SELECT* FROM absensi a JOIN guru b ON a.id_pegawai = b.id_guru  WHERE id_sd = '".$id_sd."' AND a.tanggal = '".$date."'  AND status_absen = 'guru'");
            $cekAbsen = $this->db->query("SELECT* FROM absensi a JOIN guru b ON a.id_pegawai = b.id_guru  WHERE id_sd = '".$id_sd."' AND a.tanggal = '".$date."' AND ket='absen' AND status_absen = 'guru'");
            $cekDL = $this->db->query("SELECT* FROM absensi a JOIN guru b ON a.id_pegawai = b.id_guru  WHERE id_sd = '".$id_sd."' AND a.tanggal = '".$date."' AND ket='dinas' AND status_absen = 'guru'");
            $cekTL = $this->db->query("SELECT* FROM absensi a JOIN guru b ON a.id_pegawai = b.id_guru  WHERE id_sd = '".$id_sd."' AND a.tanggal = '".$date."' AND ket='tugas' AND status_absen = 'guru'");
            


            
            $arrTanggal[] = format_indow($date);
            $arrAbsen[] = $cekAbsen->num_rows();
            $arrTidak[] = $pegawai - $cek->num_rows();
            $arrDL[] = $cekDL->num_rows();
            $arrTL[] = $cekTL->num_rows();
           
            


            
            
            // $data[] = array('y'=>$cek->num_rows(),'x'=>format_indow($date));

          }
          $data = array('tanggal'=>$arrTanggal,'absen'=>$arrAbsen,'tidak'=>$arrTidak,'dl'=>$arrDL,'tl'=>$arrTL);
        
          echo json_encode($data);
      }
    }
    function chartData(){
        $start = date('Y-m-d 00:00:00',strtotime("-6 Days"));
        $end = date('Y-m-d 00:00:00');
        $startTime = new DateTime($start);
        $endTime = new DateTime($end);
        // $count = intval(selisihdate($start,$end));
        $output = null;
        $quiz = array();
        $date = array();
       
        
        for($a=$startTime;$a<=$endTime;$a->modify('+1 day')){
            // $dt = date('Y').'-'.$bulan.'-'.$a;
            // $tanggal = $start;
            $date =$a->format("Y-m-d");
            $startTime1 = date('Y-m-d H:i:s',strtotime($date. '00:00:00'));
            $endTime1 = date('Y-m-d H:i:s',strtotime($date. '23:59:59'));

            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status'] == 'dinas'){
              $where = ' ';
            }else{
              $where = 'AND id_sd = "'.$cabang['id_sd'].'"';
            }
            $data = $this->db->query("SELECT COUNT(id_qp) as tot,a.created_at FROM quiz_partisipasi  a JOIN siswa b ON a.id_siswa = b.id_siswa WHERE a.created_at >= '".$startTime1."' AND a.created_at <= '".$endTime1."' $where GROUP BY DAY(a.created_at) ORDER BY a.created_at ASC")->num_rows();
            $quiz[] = array('quiz'=>$data,'date'=>format_indow($date));
        }
      
      
        

        echo json_encode($quiz);
    }   
    function kehadiranToday(){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();

        $absensi = $this->db->query("SELECT * FROM absensi a JOIN pegawai b ON a.id_pegawai = b.id_pegawai WHERE id_sd ='".$cabang['id_sd']."' AND a.tanggal = '".date('Y-m-d')."' AND status_absen = 'pegawai' ")->num_rows();
        $pegawai = $this->model_app->view_where('pegawai',array('id_sd'=>$cabang['id_sd'],'aktif'=>'y'))->num_rows();
        $tidak = $pegawai - $absensi;
        $persen = round($absensi/$pegawai*100,0);
        echo json_encode(array('absensi'=>$absensi,'tidak'=>$tidak,'persen'=>$persen));

    }
    function dataPeringkat(){
        $kelas =  $this->input->post('kelas');
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $skh = $this->input->post('sekolah');
        if($skh == 'all'){
          $sekolah ='all';
        }else{
          $sekolah = decode($skh);
        }
        $data = $this->model_app->getPeringkat($kelas,$limit,$start,$end,$sekolah);
        $output = null;
        $no = 1;
        foreach($data->result_array() as $row){
            $total = $row['poin']/$row['tot'];
            $output .= "<tr><td>".$no."</td><td><img src='".$row['foto']."' srcset='' class='img-fluid rounded-circle' style='height:50px;width:50px'></td><td>".$row['nama_lengkap']."</td><td>".$row['kelas']."</td><td>".$row['nama_sekolah']."</td><td>".$total."</td></tr>";
            $no++;
            
        }
        echo $output;
    }
    function dataTop(){
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array(); 
        $kelas =  $this->input->post('kelas');
        $limit = $this->input->post('limit');
   
        $data = $this->model_app->getTopSiswa($kelas,$limit,$cabang['id_sd']);
        $output = null;
        $no = 1;
        foreach($data->result_array() as $row){
            $total = $row['poin']/$row['tot'];
            $output .= "<tr><td>".$no."</td><td>".$row['nama_lengkap']."</td><td>".$row['kelas']."</td><td>".$row['tot']."</td><td>".$total."</td></tr>";
            $no++;
            
        }
        echo $output;
    }
    function dataTop5(){
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array(); 

        $kelas =  $this->input->post('kelas');
        $data = $this->model_app->getTopSiswa('all',5,$cabang['id_sd']);
        $output = null;
        $no = 1;
        foreach($data->result_array() as $row){
            $total = round($row['poin']/$row['tot'],1);
            if($total <= 100 AND $total >= 75){
                $poin = "<span class='badge badge-success-inverse float-right font-14'>".$total."</span>";
            }else if($total <= 74 AND $total >= 50){
                $poin = "<span class='badge badge-warning-inverse float-right font-14'>".$total."</span>";
            }else{
                $poin = "<span class='badge badge-danger-inverse float-right font-14'>".$total."</span>";
                
            }
            if($row['foto_profile']){
                $img = $row['foto_profile'];
            }else{
                $img = base_url('asset/foto_siswa/profile.svg');
            }
            $output .= "<li class='media my-2'>
                            <img class='mr-2 rounded-circle' style='height:30px;width:30px' src='".$img."' alt='".$row['nama_profile']."'>
                            <div class='media-body'>
                            <h5 class='mt-0 mb-1 font-12'>".nama($row['nama_lengkap'])." ".$poin."</h5>
                            <p class='mb-0 font-10'>Kelas ".$row['kelas']."</p>
                            </div>
                        </li>
                                        ";
            $no++;
            
        }
        echo $output;
    }
    function reset_password(){
        if (isset($_POST['submit'])){
            $usr = $this->model_app->edit('users', array('id_session' => $this->input->post('id_session')));
            if ($usr->num_rows()>=1){
                if ($this->input->post('a')==$this->input->post('b')){
                    $data = array('password'=>hash("sha512", md5($this->input->post('a'))));
                    $where = array('id_session' => $this->input->post('id_session'));
                    $this->model_app->update('users', $data, $where);

                    $row = $usr->row_array();
                    $this->session->set_userdata('upload_image_file_manager',true);
                    $this->session->set_userdata(array('username'=>$row['username'],
                                       'level'=>$row['level'],
                                       'id_session'=>$row['id_session']));
                    redirect($this->uri->segment(1).'/home');
                }else{
                    $data['title'] = 'Password Tidak sama!';
                    $this->load->view('administrator/view_reset',$data);
                }
            }else{
                $data['title'] = 'Terjadi Kesalahan!';
                $this->load->view('administrator/view_reset',$data);
            }
        }else{
            $this->session->set_userdata(array('id_session'=>$this->uri->segment(3)));
            $data['title'] = 'Reset Password';
            $this->load->view('administrator/view_reset',$data);
        }
    }

    function lupapassword(){
        if (isset($_POST['lupa'])){
            $email = strip_tags($this->input->post('email'));
            $cekemail = $this->model_app->edit('users', array('email' => $email))->num_rows();
            if ($cekemail <= 0){
                $data['title'] = 'Alamat email tidak ditemukan';
                $this->load->view('administrator/view_login',$data);
            }else{
                $iden = $this->model_app->edit('identitas', array('id_identitas' => 1))->row_array();
                $usr = $this->model_app->edit('users', array('email' => $email))->row_array();
                $this->load->library('email');

                $tgl = date("d-m-Y H:i:s");
                $subject      = 'Lupa Password ...';
                $message      = "<html><body>
                                    <table style='margin-left:25px'>
                                        <tr><td>Halo $usr[nama_lengkap],<br>
                                        Seseorang baru saja meminta untuk mengatur ulang kata sandi Anda di <span style='color:red'>$iden[url]</span>.<br>
                                        Klik di sini untuk mengganti kata sandi Anda.<br>
                                        Atau Anda dapat copas (Copy Paste) url dibawah ini ke address Bar Browser anda :<br>
                                        <a href='".base_url().$this->uri->segment(1)."/reset_password/$usr[id_session]'>".base_url().$this->uri->segment(1)."/reset_password/$usr[id_session]</a><br><br>

                                        Tidak meminta penggantian ini?<br>
                                        Jika Anda tidak meminta kata sandi baru, segera beri tahu kami.<br>
                                        Email. $iden[email], No Telp. $iden[no_telp]</td></tr>
                                    </table>
                                </body></html> \n";
                
                $this->email->from($iden['email'], $iden['nama_website']);
                $this->email->to($usr['email']);
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

                $data['title'] = 'Password terkirim ke '.$usr['email'];
                $this->load->view('administrator/view_login',$data);
            }
        }else{
            redirect($this->uri->segment(1));
        }
    }

	function home(){
        if ($this->session->level=='admin' or $this->session->level == 'user'){
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            $data['title'] = 'Dashboard -'.title();
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Dashboard</a></li>';
            $data['breadcumb2']= ' ';
            $data['breadcumb3']= ' ';
            $data['page'] = strtoupper(title());

            // $data['breadcumb2'] = ' <li class="breadcrumb-item"><a href="'.base_url('').'">Home</a></li>';
         
          if($cabang['status'] == 'sekolah'){
              $data['cabang']= $cabang;
		         $this->template->load('administrator/template','administrator/view_home_admin',$data);

          }else if($cabang['status'] == 'dinas'){
            $data['cabang']= $cabang;
            $this->template->load('administrator/template','administrator/view_home_dinas',$data);
          }
        }
        else{
            $this->session->sess_destroy();
             redirect('administrator');
        }
	}

	//kelas//
  function roomClass(){
		cek_session_akses('administrator/roomClass',$this->session->id_session);
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
    if($cabang['status']  != 'sekolah'){
        $cbg = 'all';
    }else {
        $cbg = $cabang['id_sd'];
    }
    $data['status'] = $cabang['status'];
    $data['kelurahan'] = $cabang['kelurahan'];
    $data['kabupaten'] = $cabang['kabupaten'];
    $data['kecamatan'] = $cabang['kecamatan'];

    if(isset($_POST['filter'])){
     
    
      $data['cabang'] = $this->input->post('cabang');
    }else{
     
    
     
      $data['cabang'] = $cbg;
    }
    $data['title'] = 'Kelas - '.title();
    $data['page'] = 'Daftar Kelas';
    $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Kelas</li>';
    $data['breadcumb2']= ' ';
    $data['breadcumb3']= '';
     
    $data['record'] = $this->model_app->filterKelas($data['cabang']);
  		$this->template->load('administrator/template','administrator/mod_kelas/view_kelas',$data);

    

  }
  
  function addRoomClass(){
    cek_session_akses('administrator/addRoomClass',$this->session->id_session);

         
          
    $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
      if($cabang['status']  != 'sekolah'){
          $cbg = 'all';
        
      }else {
          
          $cbg = $cabang['id_sd'];
      }
      $data['jenis'] = $cabang['jenis_sekolah'];
      $data['status'] = $cabang['status'];
      $data['kelurahan'] = $cabang['kelurahan'];
      $data['kabupaten'] = $cabang['kabupaten'];
      $data['kecamatan'] = $cabang['kecamatan'];
      $data['title'] = 'Kelas - '.title();
      $data['page'] = 'Tambah Kelas';
      $data['cabang'] = $cbg;
      $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/roomClass').'">Kelas</a></li>';
      $data['breadcumb2']= '  <li class="breadcrumb-item active " >Tambah</li>';
      $data['breadcumb3']= '';
 
   
   $this->template->load('administrator/template','administrator/mod_kelas/view_kelas_add',$data);
  }
  function detailRoomClass(){
    $id = decode($this->input->get('id'));
    $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
    if($cek->num_rows() > 0){
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
      if($cabang['status']  != 'sekolah'){
          $cbg = 'all';
        
      }else {
          
          $cbg = $cabang['id_sd'];
      }
      $data['row']= $cek->row_array();
      $data['jenis'] = $cabang['jenis_sekolah'];
      $data['status'] = $cabang['status'];
      $data['kelurahan'] = $cabang['kelurahan'];
      $data['kabupaten'] = $cabang['kabupaten'];
      $data['kecamatan'] = $cabang['kecamatan'];
      $data['title'] = 'Kelas - '.title();
      $data['page'] = 'Detail Kelas';
      $data['cabang'] = $cbg;
      $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/roomClass').'">Kelas</a></li>';
      $data['breadcumb2']= '  <li class="breadcrumb-item active " >Detail</li>';
      $data['breadcumb3']= '';
 
   
      $this->template->load('administrator/template','administrator/mod_kelas/view_kelas_detail',$data); 
    }else{
      $this->session->set_flashdata('message','Kelas tidak ditemukan!');
      redirect('administrator/roomClass');
    }
}
  function createMeeting(){
    if($this->input->method() == 'post'){
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
      if($cek->num_rows() > 0){
          $data = array('rkm_rk_id'=>$id,
                        'rkm_title'=>$this->input->post('judul'),
                        'rkm_desc'=>$this->input->post('deskripsi'),
                        'rkm_date'=>date('Y-m-d',strtotime($this->input->post('date'))),
                        'rkm_start'=>date('H:i:s',strtotime($this->input->post('start'))),
                        'rkm_end'=>date('H:i:s',strtotime($this->input->post('end'))),
                        
                        'rkm_url'=>$this->input->post('url'),

                      );
          $this->model_app->insert('ruang_kelas_meeting',$data);
          $status = true;
          $msg = 'Meeting Berhasil dibuat!';
      }else{
        $status = false;
        $msg = 'Kelas tidak ditemukan!';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }
  function detailMateri(){
    if($this->input->method() == 'post'){
      $id = decode($this->input->post('id'));
      $arr = null;
      $cek = $this->model_app->view_where('ruang_kelas_materi',array('rke_id'=>$id));
      if($cek->num_rows() > 0){
          $row = $cek->row_array();
          $arr = array('id'=>encode($row['rke_id']),'title'=>$row['rke_title'],'desc'=>$row['rke_desc']);
          $status = true;
          $msg = null;
      }else{
        $status = false;
        $msg = 'Materi tidak ditemukan!';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg,'arr'=>$arr));
    }
  }
  function updateMateri(){
    if($this->input->method() == 'post'){
      $id = $this->session->id_session;

     $create= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/updateMateri'")->num_rows();
     if($create > 0){
        $rk_id = decode($this->input->post('id'));
        $rke_id = decode($this->input->post('rke'));
        $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$rk_id));
        $output = null;
        if($cek->num_rows() > 0){
          $cekK = $this->model_app->view_where('ruang_kelas_materi',array('rke_id'=>$rke_id));
          if($cekK->num_rows() > 0 ){
            $row = $cekK->row_array();
            $config['upload_path']          = './asset/upload_kelas/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|excel|xls|xlsx|ppt|pptx';
            $config['max_size']             = 5000;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('file')){
              $fileName = $row['rke_file_name'];
              $file = $row['rke_file'];
            }else{
              $upload= $this->upload->data();
              if(file_exists('./asset/upload_kelas/'.$row['rke_file'])){
                unlink('./asset/upload_kelas/'.$row['rke_file']);
              }

              $file = $upload['file_name'];
              $fileName = $_FILES['file']['name']; 
  
             
            }
            $data =array('rke_title'=>$this->input->post('judul'),'rke_desc'=>$this->input->post('deskripsi'),'rke_file'=>$file,'rke_file_name'=>$fileName);
            $this->model_app->update('ruang_kelas_materi',$data,array('rke_id'=>$rke_id));
            $status= true;
            $msg = 'Materi berhasil diupload!';
          }else{
            $status = false;
            $msg = 'Materi tidak ditemukan!';
          }
         
        }else{
          $status = false;
          $msg= 'Ruang kelas tidak ditemukan!';
        }
     }else{
       $status = false;
       $msg = 'Anda tidak dapat mengakses fungsi ini';
     }
     echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }
  function deleteMateri(){
    if($this->input->method() == 'post'){
      $id = $this->session->id_session;

      $create= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/deleteMateri'")->num_rows();
      if($create > 0){
        $rke= decode($this->input->post('id'));
        $cek = $this->model_app->view_where('ruang_kelas_materi',array('rke_id'=>$rke));
        if($cek->num_rows()  > 0){
          $row = $cek->row_array();
          if(file_exists('./asset/upload_kelas/'.$row['rke_file'])){
            unlink('./asset/upload_kelas/'.$row['rke_file']);
          }
          $this->model_app->delete('ruang_kelas_materi',array('rke_id'=>$rke));
          $status = true;
          $msg = 'Materi berhasil dihapus!';
        }else{
          $status = false;
          $msg = 'Materi tidak ditemukan!';
        }
      }else{
        $status = false;
        $msg = 'Anda tidak dapat mengakses fungsi ini';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }
  function createMateri(){
    if($this->input->method() == 'post'){
      $id = $this->session->id_session;

     $create= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/createMateri'")->num_rows();
     if($create > 0){
        $rk_id = decode($this->input->post('id'));
        $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$rk_id));
        $output = null;
        if($cek->num_rows() > 0){
          $config['upload_path']          = './asset/upload_kelas/';
          $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx|excel|xls|xlsx|ppt|pptx';
          $config['max_size']             = 5000;
          $config['encrypt_name'] = TRUE;
          $this->load->library('upload', $config);
          if (! $this->upload->do_upload('file')){
            $msg = $this->upload->display_errors();
            $status = false;
          }else{
            $upload= $this->upload->data();
            $file = $upload['file_name'];
            $fileName = $_FILES['file']['name']; 

            $data =array('rke_rk_id'=>$rk_id,'rke_title'=>$this->input->post('judul'),'rke_desc'=>$this->input->post('deskripsi'),'rke_file'=>$file,'rke_file_name'=>$fileName,'rke_upload_level'=>'admin','rke_upload_by'=>$this->session->username);
            $this->model_app->insert('ruang_kelas_materi',$data);
            $status= true;
            $msg = 'Materi berhasil diupload!';
          }
        }else{
          $status = false;
          $msg= 'Ruang kelas tidak ditemukan!';
        }
     }else{
       $status = false;
       $msg = 'Anda tidak dapat mengakses fungsi ini';
     }
     echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }
  function dataMateri(){
    if($this->input->method() == 'post'){
      $rk_id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$rk_id));
      $output = null;
      if($cek->num_rows() > 0){
        $id = $this->session->id_session;
 
    
     $edit= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/updateMateri'")->num_rows();
     $delete= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/deleteMateri'")->num_rows();
     


        $output .= '  <div class="table-responsive">
                      <table class="table table-bordered" id="tableData1" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th width="15%">No </th>
                                  <th>Title</th>
                                  <th>File</th>
                                  <th>Upload By</th>
                                
                                
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>';
        $data = $this->model_app->view_where_ordering('ruang_kelas_materi',array('rke_rk_id'=>$rk_id),'rke_id','DESC');
        $status = true;
        if($data->num_rows() > 0){
          $no = 1;
          
          foreach ($data->result_array() as $row) {
            if(file_exists('asset/upload_kelas/'.$row['rke_file'])){
              $file = "<a href='".base_url('asset/upload_kelas/').$row['rke_file']."'>".$row['rke_file_name']."</a>";
            }else{
              $file = 'File not exits';
            }
            if($row['rke_upload_level'] == 'guru'){
              $guru =  $this->model_app->view_where('guru',array('id_guru'=>$row['rke_upload_by']))->row_array();
              $nama = $guru['nama_guru'];
            }else{
              $admin = $this->model_app->view_where('users',array('username'=>$row['rke_upload_by']))->row_array();
              $nama = $admin['nama_lengkap'];
            }
            $output .= '<tr>
                          <td>'.$no.'</td>
                          <td>'.$row['rke_title'].'</td>
                          <td>'.$file.'</td>
                          <td>'.$nama.'</td>
                         
                          <td>';
                          if($edit > 0){
                            $output .= '<button data-id="'.encode($row['rke_id']).'" class="m-1 btn btn-primary btn-round editMateri"><i class="fa fa-edit"></i></button>';
                          }
                          if($delete > 0){
                            $output .= '<button data-id="'.encode($row['rke_id']).'" class="m-1 btn btn-danger btn-round deleteMateri"><i class="fa fa-trash"></i></button>';
                          }
                         
                          $output .= '</td>
                        </tr>';
            $no++;
          }
        }
        $output .= "</tbody>
        </table>";

      }else{
        $status = false;
        $output = null;

      }
      echo json_encode(array('status'=>$status,'output'=>$output));

    }
  }
  function dataMeeting(){
    if($this->input->method() == 'post'){
      $rk_id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$rk_id));
      $output = null;
      if($cek->num_rows() > 0){
        $id = $this->session->id_session;
 
    
     $edit= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editMeeting'")->num_rows();
     $delete= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/deleteMeeting'")->num_rows();
     $detail= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/detailMeeting'")->num_rows();


        $output .= '  <div class="table-responsive">
                      <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th width="15%">No </th>
                                  <th>Judul</th>
                                  <th>Tanggal</th>
                                  <th>Jam</th>
                                
                                
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>';
        $data = $this->model_app->view_where_ordering('ruang_kelas_meeting',array('rkm_rk_id'=>$rk_id),'rkm_id','DESC');
        $status = true;
        if($data->num_rows() > 0){
          $no = 1;
          
          foreach ($data->result_array() as $row) {
            $output .= '<tr>
                          <td>'.$no.'</td>
                          <td>'.$row['rkm_title'].'</td>
                          <td>'.date('d-m-Y',strtotime($row['rkm_date'])).'</td>
                          <td>'.date('H:i',strtotime($row['rkm_start'])).' - '.date('H:i',strtotime($row['rkm_end'])).'</td>
                         
                          <td>';
                          if($edit > 0){
                            $output .= '<button data-id="'.encode($row['rkm_id']).'" class="btn btn-primary btn-round edit m-1"><i class="fa fa-edit"></i></button>';
                          }
                          if($delete > 0){
                            $output .= '<button data-id="'.encode($row['rkm_id']).'" class="btn btn-danger btn-round delete m-1"><i class="fa fa-trash"></i></button>';
                          }
                          if($detail > 0){
                            $output .= '<a href="'.base_url('administrator/detailMeeting?id='.encode($row['rkm_id']).'&kelas='.encode($row['rkm_rk_id'])).'" class="btn btn-info btn-round m-1"><i class="fa fa-info"></i></a>';
                          }
                          $output .= '</td>
                        </tr>';
            $no++;
          }
        }
        $output .= "</tbody>
        </table>";

      }else{
        $status = false;
        $output = null;

      }
      echo json_encode(array('status'=>$status,'output'=>$output));

    }
  }
  function deleteMeeting(){
    if($this->input->method() == 'post'){
        $id = decode($this->input->post('id'));
        $cek = $this->model_app->view_where('ruang_kelas_meeting',array('rkm_id'=>$id));
        if($cek->num_rows() > 0){
          $this->model_app->delete('ruang_kelas_meeting',array('rkm_id'=>$id));
          $status = true;
          $msg = 'Meeting Berhasil dihapus!';
        }else{
          $status = false;
          $msg = 'Meeting tidak ditemukan!';
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg));
    }else{
        $status = false;
        $msg = 'Meeting tidak ditemukan';
    }
  }
  function editMeeting(){
    if($this->input->method() == 'post'){
   
    
       
       
          $id = decode($this->input->post('id'));
          $cek = $this->model_app->view_where('ruang_kelas_meeting',array('rkm_id'=>$id));
          $data = null;
          $msg = null;
          if($cek->num_rows() > 0){
            $row = $cek->row_array();
            
            $data = array('rkm_title'=>$row['rkm_title'],
                          'rkm_desc'=>$row['rkm_desc'],
                          'rkm_id'=>encode($row['rkm_id']),
                          'rkm_date'=>date('Y-m-d',strtotime($row['rkm_date'])),
                          'rkm_start'=>date('H:i:s',strtotime($row['rkm_start'])),
                          'rkm_end'=>date('H:i:s',strtotime($row['rkm_end'])),
                          'rkm_url'=>$row['rkm_url'],
                          );
            $status = true;
          }else{
            $status = false;
            $msg = 'Meeting Kelas tidak ditemukan!';
          }
          echo json_encode(array('status'=>$status,'msg'=>$msg,'data'=>$data));
        }
      
      
    
  }
  function updateMeeting(){
    if($this->input->method() == 'post'){
      $rkm_id = decode($this->input->post('meet_id'));
      $cek = $this->model_app->view_where('ruang_kelas_meeting',array('rkm_id'=>$rkm_id));
      if($cek->num_rows() > 0 ){
        $data = array(
        'rkm_title'=>$this->input->post('judul'),
        'rkm_desc'=>$this->input->post('deskripsi'),
        'rkm_date'=>date('Y-m-d',strtotime($this->input->post('date'))),
        'rkm_start'=>date('H:i:s',strtotime($this->input->post('start'))),
        'rkm_end'=>date('H:i:s',strtotime($this->input->post('end'))),
       
        'rkm_url'=>$this->input->post('url'),

        );
        $this->model_app->update('ruang_kelas_meeting',$data,array('rkm_id'=>$rkm_id));
        $status = true;
        $msg = 'Meeting Berhasil diubah!';
      }else{
          $status = false;
          $msg = 'Meeting Kelas tidak ditemukan!';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }
  function detailMeeting(){
    $id = decode($this->input->get('id'));
    $rk_id = $this->input->get('kelas');
    $cek = $this->model_app->join_where_order('ruang_kelas_meeting','ruang_kelas','rkm_rk_id','rk_id',array('rkm_id'=>$id),'rkm_id','DESC');
    if($cek->num_rows() > 0){
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();

      $row = $cek->row_array();
      $data['row']= $cek->row_array();
      $data['title'] = 'Kelas - '.title();
      $data['page'] = 'Edit Kelas';
      $data['cabang'] = $cabang;
      $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/roomClass').'">Kelas</a></li>';
      $data['breadcumb2']= '  <li class="breadcrumb-item  " ><a href="'.base_url('administrator/detailRoomClass?id=').encode($row['rk_id']).'">Detail</a></li>';
      $data['breadcumb3']= ' <li class="breadcrumb-item active " >Meeting </li>';
 
   
      $this->template->load('administrator/template','administrator/mod_kelas/view_meeting_detail',$data); 

    }else{
      $this->session->set_flashdata('message','Meeting Kelas Tidak Ditemukan!');
      redirect('administrator/detailRoomKelas?id='.$rk_id);
    }
  }
  function editRoomClass(){
      $id = decode($this->input->get('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
      if($cek->num_rows() > 0){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        if($cabang['status']  != 'sekolah'){
            $cbg = 'all';
          
        }else {
            
            $cbg = $cabang['id_sd'];
        }
        $data['row']= $cek->row_array();
        $data['jenis'] = $cabang['jenis_sekolah'];
        $data['status'] = $cabang['status'];
        $data['kelurahan'] = $cabang['kelurahan'];
        $data['kabupaten'] = $cabang['kabupaten'];
        $data['kecamatan'] = $cabang['kecamatan'];
        $data['title'] = 'Kelas - '.title();
        $data['page'] = 'Edit Kelas';
        $data['cabang'] = $cbg;
        $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/roomClass').'">Kelas</a></li>';
        $data['breadcumb2']= '  <li class="breadcrumb-item active " >Edit</li>';
        $data['breadcumb3']= '';
   
     
        $this->template->load('administrator/template','administrator/mod_kelas/view_kelas_edit',$data); 
      }else{
        $this->session->set_flashdata('message','Kelas tidak ditemukan!');
        redirect('administrator/roomClass');
      }
  }
  function updateClass(){
    if($this->input->method() == 'post'){
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
      if($cek->num_rows() > 0){
        $row = $cek->row_array();
        $config['upload_path']          = './asset/upload_kelas/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['encrypt_name'] = TRUE;
        
        
      
        
       

        $this->load->library('upload', $config);


        if (! $this->upload->do_upload('icon')){
       
          $icon = $row['rk_icon'];
        }else{
            $foto = $this->upload->data();
            
            $icon = base_url('asset/upload_kelas/').$foto['file_name'];
        }
        $data = array('rk_id_sd' =>$this->input->post('id_sd'),
                    'rk_code' =>$this->input->post('code'),
                    'rk_kelas'=>$this->input->post('kelas'),
                    'rk_mapel'=>decode($this->input->post('mapel')),
                    'rk_title'=>$this->input->post('judul'),
                    'rk_desc'=>$this->input->post('deskripsi'),
                    'rk_id_guru'=>decode($this->input->post('guru')),
                    'rk_icon'=>$icon,
                    'rk_acc'=>$this->input->post('accept'),
                  
                    );
            $this->model_app->update('ruang_kelas',$data,array('rk_id'=>$id));
            $status = true;
            $msg = 'Kelas Berhasil Diubah';
      }else{
        $status = false;
        $msg = 'Kelas tidak ditemukan!';
      }
     
      

      
      echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }
  function deleteRoomClass(){
    $id = decode($this->input->get('id'));
    $cek = $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
    if($cek->num_rows() >0){
      $this->model_app->delete('ruang_kelas',array('rk_id'=>$id));
      $this->session->set_flashdata('success','Kelas Berhasil dihapus');

    }else{
      $this->session->set_flashdata('message','Kelastidak ditemukan');
    }
    redirect('administrator/roomClass');
  }
  function storeClass(){
    if($this->input->method() == 'post'){
      $this->form_validation->set_rules('code','Kode Kelas','required|is_unique[ruang_kelas.rk_code]|max_length[10]');
      if($this->form_validation->run() === false){
            $msg = validation_errors();
            $status = false;
      }else{
        $config['upload_path']          = './asset/upload_kelas/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['encrypt_name'] = TRUE;
        
        
      
        
       

        $this->load->library('upload', $config);


        if (! $this->upload->do_upload('icon')){
       
          $icon = base_url('asset/upload_kelas/blank.png');
        }else{
            $foto = $this->upload->data();
            
            $icon = base_url('asset/upload_kelas/').$foto['file_name'];
        }
        $data = array('rk_id_sd' =>$this->input->post('id_sd'),
                    'rk_code' =>$this->input->post('code'),
                    'rk_kelas'=>$this->input->post('kelas'),
                    'rk_mapel'=>decode($this->input->post('mapel')),
                    'rk_title'=>$this->input->post('judul'),
                    'rk_desc'=>$this->input->post('deskripsi'),
                    'rk_id_guru'=>decode($this->input->post('guru')),
                    'rk_icon'=>$icon,
                    'rk_acc'=>$this->input->post('accept'),
                    'rk_created_by'=> $this->session->username
                    );
            $this->model_app->insert('ruang_kelas',$data);
            $status = true;
            $msg = 'Kelas Berhasil Ditambah';

      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  }

	// Controller Modul User

	function manajemenuser(){
		cek_session_akses('administrator/manajemenuser',$this->session->id_session);
         $data['title'] = 'Manajemen User -'.title();
            $data['page'] = 'Manajemen User';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item active"><a href="'.base_url('administrator/manajemenuser').'"> User Manajemen</a></li>';
            $data['breadcumb3']= '';
		$data['record'] = $this->model_app->view_ordering('users','username','DESC');
		$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
	}

	 function tambah_manajemenuser(){
    cek_session_akses('administrator/tambah_manajemenuser',$this->session->id_session);
    $id = $this->session->username;
    if (isset($_POST['submit'])){
        $this->form_validation->set_rules('a','Username','required|is_unique[users.username]');
        $this->form_validation->set_rules('b','Email','required|is_unique[users.email]');
           
         if($this->form_validation->run() === FALSE){
          $this->session->set_flashdata('message',validation_errors());
          redirect('administrator/tambah_manajemenuser');
         }else{
          $config['upload_path'] = 'asset/foto_user/';
          $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
          $config['max_size'] = '1000'; // kb
          $this->load->library('upload', $config);
          $this->upload->do_upload('f');
          $hasil=$this->upload->data();
          if ($hasil['file_name']==''){
                  $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                  'password'=>hash("sha512", md5($this->input->post('b'))),
                                  'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                  'email'=>$this->db->escape_str($this->input->post('d')),
                                  'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                  'id_sd'=>decode($this->input->post('id_sd')),
                                  'blokir'=>'N',
                                  'level' =>$this->input->post('level'),
                                
                                  'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
          }else{
                  $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                  'password'=>hash("sha512", md5($this->input->post('b'))),
                                  'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                  'email'=>$this->db->escape_str($this->input->post('d')),
                                  'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                  'foto'=>base_url('asset/foto_user/').$hasil['file_name'],
                                  'id_sd'=>decode($this->input->post('id_sd')),
                                  'blokir'=>'N',
                                  'level' =>$this->input->post('level'),
                            
                                  'id_session'=>md5($this->input->post('a')).'-'.date('YmdHis'));
          }
          $this->model_app->insert('users',$data);

            $mod=count($this->input->post('modul'));
            $modul=$this->input->post('modul');
            $sess = md5($this->input->post('a')).'-'.date('YmdHis');
            for($i=0;$i<$mod;$i++){
              $modus = explode('-',$modul[$i]);
              $sub = $modus[1];
              $modu = $modus[0];
              $datam = array('id_session'=>$sess,
                            'id_modul'=>$modu,'id_sm'=>$sub);
              $this->model_app->insert('users_modul',$datam);
            }

    redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('a'));
         }

        
           
    }else{
            $data['title'] = 'Tambah Manajemen User -'.title();
            $data['page'] = 'Tambah Manajemen User';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemenuser').'">User Manajemen</a></li>';
            $data['breadcumb3']= '<li class="breadcrumb-item active" aria-current="page">Tambah User Manajemen</a></li>';
            $data['sekolah'] = $this->db->query("SELECT * FROM subdomain ORDER BY status DESC");
            $data['record'] = $this->db->query("SELECT * FROM modul  ORDER BY urutan ASC");
            $data['cabang'] = cabang();
            $data['cabang_level'] = cabang_level();
             
          
      $this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
    }
  }

  function edit_manajemenuser(){
     cek_session_akses('administrator/edit_manajemenuser',$this->session->id_session);
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
      $config['upload_path'] = 'asset/foto_user/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('f');
            $hasil=$this->upload->data();
            if ($hasil['file_name']=='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'level' =>$this->input->post('level'),
                                   
                                    
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') ==''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                    
                                    'level' =>$this->input->post('level'),
                                   
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']=='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                   
                                    'level' =>$this->input->post('level'),
                                    
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }elseif ($hasil['file_name']!='' AND $this->input->post('b') !=''){
                    $data = array('username'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>hash("sha512", md5($this->input->post('b'))),
                                    'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                                    'email'=>$this->db->escape_str($this->input->post('d')),
                                    'no_telp'=>$this->db->escape_str($this->input->post('e')),
                                    'foto'=>$hasil['file_name'],
                                     
                                    'level' =>$this->input->post('level'),
                                   
                                    'blokir'=>$this->db->escape_str($this->input->post('h')));
            }
            $where = array('username' => $this->input->post('id'));
            $this->model_app->update('users', $data, $where);

              $mod=count($this->input->post('modul'));
              $modul=$this->input->post('modul');
              for($i=0;$i<$mod;$i++){
                $modus = explode('-',$modul[$i]);
                $sub = $modus[1];
                $modu = $modus[0];
                $datam = array('id_session'=>$this->input->post('ids'),
                              'id_modul'=>$modu,'id_sm'=>$sub);
              
                $this->model_app->insert('users_modul',$datam);
              }

      redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->input->post('id'));
    }else{
            if ($this->session->username==$this->uri->segment(3) OR $this->session->level=='admin'){
                $data['title'] = 'Ubah Manajemen User -'.title();
                $data['page'] = 'Ubah Manajemen User';
                $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemenuser').'">User Manajemen</a></li>';
                $data['breadcumb3']= '<li class="breadcrumb-item active" aria-current="page">Ubah User Manajemen</a></li>';
                $row =  $this->model_app->edit('users', array('username' => $id))->row_array();
                $data['rows'] = $row;
                $data['sekolah'] = $this->db->query("SELECT * FROM subdomain ORDER BY status DESC");
               
                $data['cabang'] = cabang();
                $data['cabang_level'] = cabang_level();
                $data['akses'] = $this->model_app->view_join_where('users_modul','submodul','id_sm', array('id_session' => $row['id_session']),'id_umod','DESC');
               
                $data['record'] = $this->db->query("SELECT * FROM modul  ORDER BY urutan ASC");
                
          $this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
            }else{
                redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->session->username);
            }
    }
  }

  function delete_manajemenuser(){
        cek_session_akses('administrator/delete_manajemenuser',$this->session->id_session);
    $id = array('username' => $this->uri->segment(3));
        $this->model_app->delete('users',$id);
    redirect($this->uri->segment(1).'/manajemenuser');
  }

    function delete_akses(){
        cek_session_akses('administrator/delete_akses',$this->session->id_session);
        $id = array('id_umod' => $this->uri->segment(3));
        $this->model_app->delete('users_modul',$id);
        redirect($this->uri->segment(1).'/edit_manajemenuser/'.$this->uri->segment(4));
    }

	
  // Sekolah //
  function mataPelajaran(){
      if($this->uri->segment('3') == 'add'){
        cek_session_akses('administrator/mataPelajaran/add',$this->session->id_session);
        if(isset($_POST['submit'])){
              $data = array('mapel'=>$this->input->post('mata_pelajaran'),'mapel_kelas'=>$this->input->post('kelas'));
              $this->model_app->insert('mata_pelajaran',$data);
              $this->session->set_flashdata('success','Mata Pelajaran berhasil ditambah');
              redirect('administrator/mataPelajaran/add');
        }else{
          $data['title'] = 'Mata Pelajaran -'.title();
          $data['page'] = 'Tambah';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Sekolah</a></li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item "><a href="'.base_url('administrator/mataPelajaran').'">Mata Pelajaran</a></li>';
          $data['breadcumb3']= '<li class="breadcrumb-item active " aria-current="page">Tambah</a></li>';
          $this->template->load('administrator/template','administrator/mod_sekolah/view_mapel_add',$data);

        }
      
      }else if($this->uri->segment('3') == 'edit'){
        cek_session_akses('administrator/mataPelajaran/edit',$this->session->id_session);
        if(isset($_POST['submit'])){
          $id = decode($this->input->post('id'));
          $cek = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$id));
          if($cek->num_rows() > 0){
            $data = array('mapel'=>$this->input->post('mata_pelajaran'),'mapel_kelas'=>$this->input->post('kelas'));
            $this->model_app->update('mata_pelajaran',$data,array('mapel_id'=>$id));
            $this->session->set_flashdata('success','Mata Pelajaran berhasil diubah');
            redirect('administrator/mataPelajaran');
          }else{
            $this->session->set_flashdata('message','Mata Pelajaran tidak ditemukan');
            redirect('administrator/mataPelajaran');
          }
          
        }else{
          $id = decode($this->input->get('id'));
          $cek = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$id));
          if($cek->num_rows() > 0){
            $data['row'] = $cek->row_array();
            $data['title'] = 'Mata Pelajaran - '.title();
            $data['page'] = 'Edit ';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Sekolah</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item "><a href="'.base_url('administrator/mataPelajaran').'">Mata Pelajaran</a></li>';
            $data['breadcumb3']= '<li class="breadcrumb-item active " aria-current="page">Edit</a></li>';
            $this->template->load('administrator/template','administrator/mod_sekolah/view_mapel_edit',$data);
          }else{
            $this->session->set_flashdata('message','Mata Pelajaran tidak ditemukan');
            redirect('administrator/mataPelajaran');
          }
         

        }
      }elseif($this->uri->segment('3') == 'hapus'){
        cek_session_akses('administrator/mataPelajaran/hapus',$this->session->id_session);
        $id = decode($this->input->get('id'));
        $cek = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$id));
        if($cek->num_rows() > 0){
          $this->model_app->delete('mata_pelajaran',array('mapel_id'=>$id));
          $this->session->set_flashdata('success','Mata Pelajaran berhasil dihapus');
            redirect('administrator/mataPelajaran');
        }else{
          $this->session->set_flashdata('message','Mata Pelajaran tidak ditemukan');
          redirect('administrator/mataPelajaran');
        }
       
        
      }else{
        cek_session_akses('administrator/mataPelajaran',$this->session->id_session);

        $data['title'] = 'Mata Pelajaran -'.title();
        $data['page'] = 'Mata Pelajaran ';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Sekolah</a></li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active"><a href="'.base_url('administrator/mataPelajaran').'">Mata Pelajaran</a></li>';
        $data['breadcumb3']= '';
        $data['record'] = $this->model_app->view_order('mata_pelajaran','mapel_id','DESC');
        $this->template->load('administrator/template','administrator/mod_sekolah/view_mapel',$data);

      }
  }
  // Sekolah //
	// Controller Modul Modul

    function manajemenmodul(){
    cek_session_akses('administrator/manajemenmodul',$this->session->id_session);
    if($this->session->level == 'admin'){
   
        if ($this->session->level=='admin'){
            $data['record'] = $this->model_app->view_ordering('modul','urutan','ASC');
        }else{
            $data['record'] = $this->model_app->view_where_ordering('modul',array('username'=>$this->session->username),'id_modul','DESC');
        }
        $data['title'] = 'Manajemen Modul -'.title();
        $data['page'] = 'Manajemen Modul';
        $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemenmodul').'">Manajemen Modul</a></li>';
        $data['breadcumb3']= ' ';

            // $data['breadcumb2'] = ' <li class="breadcrumb-item"><a href="'.base_url('').'">Home</a></li>';
    $this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
    }else{
       $this->session->set_flashdata('message','Anda Tidak Bisa Mengakses Halaman Ini !');
           redirect('administrator/home');
    }
  }
    function icon(){
         $data['title'] = 'Icon -'.title();
            $data['page'] = 'Icon';
            
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Icon</a></li>';
            $data['breadcumb2']= '';
            $data['breadcumb3']= '';
            $this->template->load('administrator/template','administrator/view_icon',$data);
    }
	function tambah_manajemenmodul(){
		 cek_session_akses('administrator/tambah_manajemenmodul',$this->session->id_session);
    if (isset($_POST['submit'])){
      $data = array('nama_modul'=>$this->db->escape_str($this->input->post('modul')),
                        
                        'icon'=>$this->input->post('icon'),
                        'urutan'=>$this->input->post('urutan'),
                        'link'=>$this->input->post('link'),
                        );
            $this->model_app->insert('modul',$data);
        redirect($this->uri->segment(1).'/manajemenmodul');
		}else{
            $data['title'] = 'Tambah Manajemen Modul -'.title();
            $data['page'] = 'Tambah Manajemen Modul';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemenmodul').'">Manajemen Modul</a></li>';
            $data['breadcumb3']= '<li class="breadcrumb-item active" aria-current="page">Tambah Manajemen Modul</a></li>';
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah',$data);
		}
	}

	function edit_manajemenmodul(){
	 cek_session_akses('administrator/edit_manajemenmodul',$this->session->id_session);
    $id = $this->uri->segment(3);
    if (isset($_POST['submit'])){
           $data = array('nama_modul'=>$this->db->escape_str($this->input->post('modul')),
                        
                        'icon'=>$this->input->post('icon'),
                        'urutan'=>$this->input->post('urutan'),
                        'link'=>$this->input->post('link'),
                        );
            $where = array('id_modul' => $this->input->post('id'));
            $this->model_app->update('modul', $data, $where);
      redirect($this->uri->segment(1).'/manajemenmodul');
    }else{
          
            $data['row'] = $this->model_app->edit('modul', array('id_modul' => $id))->row_array();
            $data['title'] = 'Edit Manajemen Modul -'.title();
            $data['page'] = 'Edit Manajemen Modul';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemenmodul').'">Manajemen Modul</a></li>';
            $data['breadcumb3']= '<li class="breadcrumb-item active" aria-current="page">Edit Manajemen Modul</a></li>';
            // $data = array('row' => $proses);
            $this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
    }
	}
     function delete_manajemenmodul(){
        cek_session_akses('administrator/delete_manajemenmodul',$this->session->id_session);
 
            $id = array('id_modul' => $this->uri->segment(3));
        
        $this->model_app->delete('modul',$id);
    redirect($this->uri->segment(1).'/manajemenmodul');
    }

    function manajemensubmodul(){
    if($this->session->level == 'admin'){
    cek_session_akses('administrator/manajemensubmodul',$this->session->id_session);
             $data['title'] = ' Manajemen Sub Modul -'.title();
            $data['page'] = ' Manajemen Sub Modul';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemensubmodul').'">Manajemen Sub Modul</a></li>';
            $data['breadcumb3']= '';
           
            $data['record'] = $this->db->query("SELECT a.submodul,a.id_sm,a.link,a.publish,b.nama_modul FROM submodul a JOIN modul b ON a.id_modul = b.id_modul ORDER BY id_sm DESC");
        
    $this->template->load('administrator/template','administrator/mod_modul/view_sub_modul',$data);
    }else{
       $this->session->set_flashdata('message','Anda Tidak Bisa Mengakses Halaman 1Ini !');
           redirect('administrator/home');
    }
  }
  function tambah_manajemensubmodul(){
    cek_session_akses('administrator/tambah_manajemensubmodul',$this->session->id_session);
    if (isset($_POST['submit'])){
        $sub = $this->input->post('submodul');
        $link = $this->input->post('link');
        $publish = $this->input->post('publish');
        $modul = $this->input->post('modul');
        $count = count($sub);

        for($a=0;$a<$count;$a++){
            $data = array('id_modul'=>$modul,'submodul'=>$sub[$a],'link'=>$link[$a],'publish'=>$publish[$a]);
            $this->model_app->insert('submodul',$data);
        }
      redirect($this->uri->segment(1).'/manajemensubmodul');
    }else{
            $data['title'] = 'Tambah Manajemen Sub Modul -'.title();
            $data['page'] = 'Tambah Manajemen Sub Modul';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemensubmodul').'">Manajemen Sub Modul</a></li>';
            $data['breadcumb3']= '<li class="breadcrumb-item active" aria-current="page">Tambah Manajemen Sub Modul</a></li>';
         $data['modul'] = $this->model_app->view_ordering('modul','urutan','asc');
     $this->template->load('administrator/template','administrator/mod_modul/view_submodul_tambah',$data);
    }
  }
     function edit_manajemensubmodul(){
        cek_session_akses('administrator/edit_manajemensubmodul',$this->session->id_session);
        if (isset($_POST['submit'])){
            $sub = $this->input->post('submodul');
            $link = $this->input->post('link');
            $publish = $this->input->post('publish');
            $modul = $this->input->post('modul');
            $id_sm = $this->input->post('id_sm');
            $data = array('id_modul'=>$modul,'submodul'=>$sub,'link'=>$link,'publish'=>$publish);
            $where = array('id_sm'=>$id_sm);
            $this->model_app->update('submodul',$data,$where);
          redirect($this->uri->segment(1).'/manajemensubmodul');
        }else{
        $id = $this->uri->segment('3');
           $data['title'] = 'Ubah Manajemen Sub Modul -'.title();
            $data['page'] = 'Ubah Manajemen Sub Modul';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current="page">Manajemen User</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item"><a href="'.base_url('administrator/manajemensubmodul').'">Manajemen Sub Modul</a></li>';
            $data['breadcumb3']= '<li class="breadcrumb-item active" aria-current="page">Ubah Manajemen Sub Modul</a></li>';
        $data['row'] = $this->model_app->view_where('submodul',array('id_sm'=>$id))->row_array();
        $data['modul'] = $this->model_app->view_ordering('modul','urutan','asc');
         $this->template->load('administrator/template','administrator/mod_modul/view_submodul_edit',$data);
        }
      }

	function delete_manajemensubmodul(){
        cek_session_akses('administrator/delete_manajemensubmodul',$this->session->id_session);

            $id = array('id_sm' => $this->uri->segment(3));
      
         
        $this->model_app->delete('submodul',$id);
    redirect($this->uri->segment(1).'/manajemensubmodul');
  }
  function insert_history($link,$akses,$modul){
    $username = $this->session->username;
    $ip = $_SERVER['REMOTE_ADDR'];
   
    $data = array('username'=>$username,'modul'=>$modul,'link'=>$link,'akses'=>$akses,'ip'=>$ip);
    $this->model_app->insert('users_history',$data);
  }

  //bag//
  function bagian(){
       
    if($this->uri->segment('3')=='edit'){
      cek_session_akses('administrator/bagian/edit',$this->session->id_session);
        if(isset($_POST['submit'])){
               $data=array('nama_bagian'=>$this->input->post('nama_bagian'),'kepala_bagian'=>$this->input->post('kepala_bagian'),'nip'=>$this->input->post('nip'));
                $where = array('id_bagian'=>$this->input->post('id'));
                $this->model_app->update('bagian',$data,$where);
                $link = base_url('administrator/bagian/edit/').$this->input->post('id');
        $this->insert_history($link,'edit','bagian');
                $this->session->set_flashdata('success', 'Bagian Berhasil Diubah');
                redirect('administrator/bagian');

        }else{
            $id = $this->uri->segment('4');
            $cek = $this->model_app->view_where('bagian',array('id_bagian'=>$id));
            if($cek->num_rows() > 0){
                $data['title'] = 'Bidang - '.title();
                $data['page'] = 'Edit Bidang';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/bagian').'">Bidang</a></li> ';
                $data['breadcumb3']= '<li class="breadcrumb-item active " >Edit</li>';
                 $data['row'] = $cek->row_array();
                 $this->template->load('administrator/template','administrator/mod_divisi/view_divisi_edit',$data);
            }else{
                $this->session->set_flashdata('message','Bidang tidak ditemukan!');
                redirect('administrator/bagian');
            }
           
        }
    }elseif($this->uri->segment('3')=='add'){
       cek_session_akses('administrator/bagian/add',$this->session->id_session);
        if(isset($_POST['submit'])){
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();

                $data=array('nama_bagian'=>$this->input->post('nama_bagian'),'kepala_bagian'=>$this->input->post('kepala_bagian'),'nip'=>$this->input->post('nip'),'id_sd'=>$cabang['id_sd']);
                $id = $this->model_app->insert_id('bagian',$data);
                $link = base_url('administrator/bagian/edit/').$id;
                $this->insert_history($link,'tambah','bagian');
                $this->session->set_flashdata('success', 'Bagian Berhasil Ditambah');
                redirect('administrator/bagian');

        }else{
            $data['title'] = 'Bidang - '.title();
            $data['page'] = 'Tambah Bidang';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/bagian').'">Bidang</a></li> ';
            $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
             $this->template->load('administrator/template','administrator/mod_divisi/view_divisi_tambah',$data);
        }

    }elseif($this->uri->segment('3')=='hapus'){
       cek_session_akses('administrator/bagian/hapus',$this->session->id_session);
        $where = array('id_bagian'=>$this->uri->segment('4'));
        $this->model_app->delete('bagian',$where);

         $where = array('id_bagian'=>$this->uri->segment('4'));
        $this->model_app->delete('sub_bagian',$where);
        $link = base_url('administrator/bagian/');
        $this->insert_history($link,'delete','bagian');
         $this->session->set_flashdata('success', 'Bagian Berhasil Dihapus');
        redirect('administrator/bagian');
    }else{
       cek_session_akses('administrator/bagian',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $data['title'] = 'Bidang - '.title();
        $data['page'] = 'Data Bidang';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/bagian').'">Bidang</a></li> ';
        $data['breadcumb3']= '';
        $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
         $this->template->load('administrator/template','administrator/mod_divisi/view_divisi',$data);
    }

}

 function sub_bagian(){
   
    if($this->uri->segment('3')=='edit'){
      cek_session_akses('administrator/sub_bagian/edit',$this->session->id_session);
        if(isset($_POST['submit'])){
               $data=array('nama_sub_bagian'=>$this->input->post('nama_sub_bagian'),'kepala_sub_bagian'=>$this->input->post('kepala_sub_bagian'),'id_bagian'=>$this->input->post('bagian'),'nip'=>$this->input->post('nip'),'pangkat'=>$this->input->post('pangkat'));
                $where = array('id_sub_bagian'=>$this->input->post('id'));
                $this->model_app->update('sub_bagian',$data,$where);
                $link = base_url('administrator/sub_bagian/edit/').$this->input->post('id');
                $this->insert_history($link,'edit','sub_bagian');
                $this->session->set_flashdata('success', 'Sub Bagian Berhasil Diubah');
                redirect('administrator/sub_bagian');

        }else{
            $data['title'] = 'Sub Bidang - '.title();
            $data['page'] = 'Edit Sub Bidang';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/sub_bagian').'">Sub Bidang</a></li> ';
            $data['breadcumb3']= '<li class="breadcrumb-item active " >Edit</li>';
             $data['bagian'] = $this->model_app->view('bagian');
             $data['rows'] = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$this->uri->segment('4')))->row_array();
             $this->template->load('administrator/template','administrator/mod_subbagian/view_subbagian_edit',$data);
        }
    }elseif($this->uri->segment('3')=='add'){
      cek_session_akses('administrator/sub_bagian/add',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();

        if(isset($_POST['submit'])){

                $data=array('nama_sub_bagian'=>$this->input->post('nama_sub_bagian'),'kepala_sub_bagian'=>$this->input->post('kepala_sub_bagian'),'id_bagian'=>$this->input->post('bagian'),'nip'=>$this->input->post('nip'),'pangkat'=>$this->input->post('pangkat'),'id_sd'=>$cabang['id_sd']);
               $id =  $this->model_app->insert_id('sub_bagian',$data);
                $link = base_url('administrator/sub_bagian/edit/').$id;
                $this->insert_history($link,'tambah','sub_bagian');
                $this->session->set_flashdata('success', 'Sub Bagian Berhasil Ditambah');
                redirect('administrator/sub_bagian');

        }else{
            $data['title'] = 'Sub Bidang - '.title();
            $data['page'] = 'Tambah Sub Bidang';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/sub_bagian').'">Sub Bagian</a></li> ';
            $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
             $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
             $this->template->load('administrator/template','administrator/mod_subbagian/view_subbagian_tambah',$data);
        }

    }elseif($this->uri->segment('3')=='hapus'){
      cek_session_akses('administrator/sub_bagian/hapus',$this->session->id_session);
        
         $where = array('id_sub_bagian'=>$this->uri->segment('4'));
        $this->model_app->delete('sub_bagian',$where);
         $link = base_url('administrator/sub_bagian/');
                $this->insert_history($link,'hapus','sub_bagian');

         $this->session->set_flashdata('success', 'Sub Bagian Berhasil Dihapus');
        redirect('administrator/sub_bagian');
    }else{
      cek_session_akses('administrator/sub_bagian',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $data['title'] = 'Sub Bidang - '.title();
        $data['page'] = 'Data Sub Bidang';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/sub_bagian').'">Sub Bidang</a></li> ';
        $data['breadcumb3']= '';
        $data['record'] = $this->db->query("SELECT *,`bagian`.`nip` as nip_bagian, `sub_bagian`.`nip` as nip FROM `sub_bagian` JOIN `bagian` ON `sub_bagian`.`id_bagian`=`bagian`.`id_bagian` WHERE sub_bagian.id_sd = '".$cabang['id_sd']."' ORDER BY `id_sub_bagian` DESC");
         $this->template->load('administrator/template','administrator/mod_subbagian/view_subbagian',$data);
    }

}
function sub(){
    $id_bagian = $this->input->post('id_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian' => $id_bagian),'id_sub_bagian','DESC');
    $this->load->view('administrator/view_sub_bagian',$data);    
  }
   function sk(){
    $id_sub_bagian = $this->input->post('id_sub_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_kegiatan',array('id_sub_bagian' => $id_sub_bagian),'id_sub_kegiatan','DESC');
    $this->load->view('administrator/view_sub_kegiatan',$data);    
  }
  function sub_kegiatan(){
   $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
   
    if($this->uri->segment('3')=='edit'){
      cek_session_akses('administrator/sub_kegiatan/edit',$this->session->id_session);
       if(isset($_POST['submit'])){
               $data=array('id_sub_bagian'=>$this->input->post('sub_bagian'),'nama_kegiatan'=>$this->input->post('nama_kegiatan'),'id_kb'=>$this->input->post('kepalabiro'),'id_pptk'=>$this->input->post('pptk'),'target_lat'=>$this->input->post('target_lat'),'target_long'=>$this->input->post('target_long'));
                $where = array('id_sub_kegiatan'=>$this->input->post('id'));
                $this->model_app->update('sub_kegiatan',$data,$where);
                $link = base_url('administrator/sub_kegiatan/edit/').$this->input->post('id');
                $this->insert_history($link,'edit','sub_kegiatan');
                $this->session->set_flashdata('success', 'Sub Kegiatan Berhasil Diubah');
                redirect('administrator/sub_kegiatan');

        }else{
           $ip = $_SERVER['REMOTE_ADDR'];
            $details = json_decode(file_get_contents("https://ipinfo.io/$ip/json"));
            $loc =  $details->loc; // -> "Mountain View"
            $lok =explode(',', $loc);
            $data['lat'] = $lok[0];
            $data['long'] = $lok[1];
             $data['bagian'] = $this->model_app->view('bagian');
             $data['pptk'] = $this->model_app->view_ordering('pptk','id_pptk','DESC');
             $data['kepalabiro'] = $this->model_app->view_ordering('kepala_biro','id_kb','DESC');
             $data['title'] = 'Sub Kegiatan - '.title();
             $data['page'] = 'Tambah Sub Kegiatna';
             $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
             $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/sub_kegiatan').'">Sub Kegiatan</a></li> ';

             $data['breadcumb3']= '<li class="breadcrumb-item active " >Edit</li>';
             $data['rows'] = $this->model_app->view_where('sub_kegiatan',array('id_sub_kegiatan'=>$this->uri->segment('4')))->row_array();
             $this->template->load('administrator/template','administrator/mod_subbagian/view_subkegiatan_edit',$data);
        }
    }elseif($this->uri->segment('3')=='add'){
      cek_session_akses('administrator/sub_kegiatan/add',$this->session->id_session);
        if(isset($_POST['submit'])){
                $data=array('id_sub_bagian'=>$this->input->post('sub_bagian'),'nama_kegiatan'=>$this->input->post('nama_kegiatan'),'id_kb'=>$this->input->post('kepalabiro'),'id_pptk'=>$this->input->post('pptk'),'target_lat'=>$this->input->post('target_lat'),'target_long'=>$this->input->post('target_long'),'id_sd'=>$cabang['id_sd']);
                $this->model_app->insert('sub_kegiatan',$data);
                $this->session->set_flashdata('success', 'Sub Bagian Berhasil Ditambah');
                redirect('administrator/sub_kegiatan');

        }else{
            $data['title'] = 'Sub Kegiatan - '.title();
            $data['page'] = 'Tambah Sub Kegiatan';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/sub_kegiatan').'">Sub Kegiatan</a></li> ';

            $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
             $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
             $data['pptk'] = $this->model_app->view_where_ordering('pptk',array('id_sd'=>$cabang['id_sd']),'id_pptk','DESC');
             $data['kepalabiro'] = $this->model_app->view_where_ordering('kepala_biro',array('id_sd'=>$cabang['id_sd']),'id_kb','DESC');
             $this->template->load('administrator/template','administrator/mod_subbagian/view_subkegiatan_tambah',$data);
        }

    }elseif($this->uri->segment('3')=='hapus'){
      cek_session_akses('administrator/sub_kegiatan/hapus',$this->session->id_session);
        
         $where = array('id_sub_kegiatan'=>$this->uri->segment('4'));
        $this->model_app->delete('sub_kegiatan',$where);

         $this->session->set_flashdata('success', 'Sub Bagian Berhasil Dihapus');
        redirect('administrator/sub_kegiatan');
    }else{
      cek_session_akses('administrator/sub_kegiatan',$this->session->id_session);
      $data['title'] = 'Sub Kegiatan - '.title();
      $data['page'] = 'Data Sub Kegiatan';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
      $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/sub_kegiatan').'">Sub Kegiatan</a></li> ';
      $data['breadcumb3']= '';
        $data['record'] = $this->db->query("SELECT *, c.nama as nama_pptk, d.nama as nama_kb FROM sub_kegiatan a JOIN  sub_bagian b ON a.id_sub_bagian = b.id_sub_bagian JOIN pptk c ON a.id_pptk = c.id_pptk JOIN kepala_biro d ON a.id_kb = d.id_kb JOIN bagian e ON b.id_bagian = e.id_bagian WHERE a.id_sd = ".$cabang['id_sd']." ORDER BY a.id_sub_kegiatan DESC");
         $this->template->load('administrator/template','administrator/mod_subbagian/view_subkegiatan',$data);
    }

}
function seeLocation(){
  $id = decode($this->input->post('id'));
  $cek = $this->model_app->view_where('location_absen',array('loc_id_sd'=>$id));
  if($cek->num_rows() > 0){
    $row = $cek->row_array();
    $lati = $row['loc_latitude'];
    $longi = $row['loc_longitude'];
  }else{
    $lati = '';
    $longi = '';
  }
  echo json_encode(array('lati'=>$lati,'longi'=>$longi));
}
function setLocation(){
          cek_session_akses('administrator/setLocation',$this->session->id_session);
           $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            $data['title'] = 'Set Lokasi - '.title();
            $data['page'] = 'Set Lokasi';
            $data['breadcumb1'] = ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/setLocation').'">Absen Lokasi</a></li>';
            $data['breadcumb2']= '';

            $data['breadcumb3']= '';

            if($cabang['status'] == 'dinas'){
              // $data['sekolah'] = $this->model_app->view_where('')
              
            

            }else{
              $location = $this->model_app->view_where('location_absen',array('loc_id_sd'=>$cabang['id_sd']));
            
              $data['location']= $location;
            }
            $data['status'] = $cabang['status'];
            $data['cabang'] = encode($cabang['id_sd']);
             $this->template->load('administrator/template','administrator/mod_sekolah/view_location',$data);
}
function updateLocation(){
  cek_session_akses('administrator/updateLocation',$this->session->id_session);
  $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
  if($cabang['status'] == 'dinas'){
    $sekolah = decode($this->input->post('sekolah'));
  }else{
    $sekolah = $cabang['id_sd'];
  }
  $cek = $this->model_app->view_where('location_absen',array('loc_id_sd'=>$sekolah));
  $status = true;
  if($cek->num_rows() > 0){
    $row = $cek->row_array();
      $data = array('loc_latitude'=>$this->input->post('target_lat'),'loc_longitude'=>$this->input->post('target_long'));
      $this->model_app->update('location_absen',$data,array('loc_id'=>$row['loc_id']));
      
      $msg = 'Lokasi berhasil diubah';
  }else{
    $data = array('loc_latitude'=>$this->input->post('target_lat'),'loc_longitude'=>$this->input->post('target_long'),'loc_id_sd'=>$sekolah);
    $this->model_app->insert('location_absen',$data);
    $msg = 'Lokasi berhasil ditambah';

  }
  echo json_encode(array('status'=>$status,'msg'=>$msg));
}
function pptk(){
   
    if($this->uri->segment('3')=='edit'){
      cek_session_akses('administrator/pptk/edit',$this->session->id_session);
        if(isset($_POST['submit'])){
                 $data=array('nama'=>$this->input->post('nama'),'pangkat'=>$this->input->post('pangkat'),'nip'=>$this->input->post('nip'));
                $where = array('id_pptk'=>$this->input->post('id'));
                $this->model_app->update('pptk',$data,$where);
                $this->session->set_flashdata('success', 'PPTK Berhasil Diubah');
             
               
                redirect('administrator/pptk');

        }else{
            $data['title'] = ' PPTK - '.title();
            $data['page'] = 'Tambah PPTK';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/pptk').'">PPTK</a></li> ';
            $data['breadcumb3']= ' <li class="breadcrumb-item active" >Edit </li>';
             $data['row'] = $this->model_app->view_where('pptk',array('id_pptk'=>$this->uri->segment('4')))->row_array();
             $this->template->load('administrator/template','administrator/mod_subbagian/view_pptk_edit',$data);
        }
    }elseif($this->uri->segment('3')=='add'){
      cek_session_akses('administrator/pptk/add',$this->session->id_session);
        if(isset($_POST['submit'])){
             $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                $data=array('nama'=>$this->input->post('nama'),'pangkat'=>$this->input->post('pangkat'),'nip'=>$this->input->post('nip'),'id_sd'=>$cabang['id_sd']);
                $this->model_app->insert('pptk',$data);
                $this->session->set_flashdata('success', 'PPTK Berhasil Ditambah');
                redirect('administrator/pptk');

        }else{
            $data['title'] = ' PPTK - '.title();
            $data['page'] = 'Tambah PPTK';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/pptk').'">PPTK</a></li> ';
            $data['breadcumb3']= ' <li class="breadcrumb-item active" >Tambah</li>';
             $this->template->load('administrator/template','administrator/mod_subbagian/view_pptk_tambah',$data);
        }

    }elseif($this->uri->segment('3')=='hapus'){
      cek_session_akses('administrator/pptk/hapus',$this->session->id_session);
        
         $where = array('id_pptk'=>$this->uri->segment('4'));
        $this->model_app->delete('pptk',$where);

         $this->session->set_flashdata('success', 'Sub Bagian Berhasil Dihapus');
        redirect('administrator/pptk');
    }else{
      cek_session_akses('administrator/pptk',$this->session->id_session);
     $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
     $data['title'] = 'PPTK - '.title();
     $data['page'] = 'Data PPTK';
     $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
     $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/pptk').'">PPTK</a></li> ';
     $data['breadcumb3']= '';
        $data['record'] = $this->model_app->view_where_ordering('pptk',array('id_sd'=>$cabang['id_sd']),'id_pptk','DESC');
         $this->template->load('administrator/template','administrator/mod_subbagian/view_pptk',$data);
    }

}
function kepalabiro(){
   
    if($this->uri->segment('3')=='edit'){
      cek_session_akses('administrator/kepalabiro/edit',$this->session->id_session);
        if(isset($_POST['submit'])){
                 $data=array('nama'=>$this->input->post('nama'),'pangkat'=>$this->input->post('pangkat'),'nip'=>$this->input->post('nip'));
                $where = array('id_kb'=>$this->input->post('id'));
                $this->model_app->update('kepala_biro',$data,$where);
                $this->session->set_flashdata('success', 'Kepala Biro Berhasil Diubah');
             
               
                redirect('administrator/kepalabiro');

        }else{
            $data['title'] = 'Edit Kepala Biro - '.title();
            $data['page'] = 'Data Kepala Biro';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/kepala_biro').'">Kepala Biro</a></li> ';
            $data['breadcumb3']= ' <li class="breadcrumb-item active" >Edit</li>';
             $data['row'] = $this->model_app->view_where('kepala_biro',array('id_kb'=>$this->uri->segment('4')))->row_array();
             $this->template->load('administrator/template','administrator/mod_subbagian/view_kb_edit',$data);
        }
    }elseif($this->uri->segment('3')=='add'){
      cek_session_akses('administrator/kepalabiro/add',$this->session->id_session);
        if(isset($_POST['submit'])){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();

                $data=array('nama'=>$this->input->post('nama'),'pangkat'=>$this->input->post('pangkat'),'nip'=>$this->input->post('nip'),'id_sd'=>$cabang['id_sd']);
                $this->model_app->insert('kepala_biro',$data);
                $this->session->set_flashdata('success', 'Kepala Biro Berhasil Ditambah');
                redirect('administrator/kepalabiro');

        }else{
            $data['title'] = 'Tambah Kepala Biro - '.title();
            $data['page'] = 'Data Kepala Biro';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/kepala_biro').'">Kepala Biro</a></li> ';
            $data['breadcumb3']= ' <li class="breadcrumb-item active" >Tambah</li>';
             $this->template->load('administrator/template','administrator/mod_subbagian/view_kb_tambah',$data);
        }

    }elseif($this->uri->segment('3')=='hapus'){
      cek_session_akses('administrator/kepalabiro/hapus',$this->session->id_session);
        
         $where = array('id_kb'=>$this->uri->segment('4'));
        $this->model_app->delete('kepala_biro',$where);

         $this->session->set_flashdata('success', 'Kepala Biro Berhasil Dihapus');
        redirect('administrator/kepalabiro');
    }else{
      cek_session_akses('administrator/kepalabiro',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $data['title'] = 'Kepala Biro - '.title();
        $data['page'] = 'Data Kepala Biro';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/kepala_biro').'">Kepala Biro</a></li> ';
        $data['breadcumb3']= '';
        $data['record'] = $this->model_app->view_where_ordering('kepala_biro',array('id_sd'=>$cabang['id_sd']),'id_kb','DESC');
         $this->template->load('administrator/template','administrator/mod_subbagian/view_kb',$data);
    }

}

  //bag//
  //PEGAWWAI//
  function pegawai()
  {
    
      if($this->uri->segment('3')=='edit'){
         cek_session_akses('administrator/pegawai/edit',$this->session->id_session);
          if(isset($_POST['submit'])){
              $config['upload_path']          = './asset/foto_user/';
              $config['allowed_types']        = 'gif|jpg|png|jpeg';
              $config['max_size']             = 5000;
              $config['encrypt_name'] = TRUE;
              
              
            
              
             

              $this->load->library('upload', $config);

              $id = $this->input->post('id');
              if (! $this->upload->do_upload('foto')){
             
                  $f = $this->input->post('old');
              }else{
                  $foto = $this->upload->data();
                  $f = $foto['file_name'];
              }
              $tanggal_lahir = date('Y-m-d',strtotime($this->input->post('tanggal_lahir')));
              if(trim($this->input->post('password')) != ''){
               $data = array('no_ktp'=>$this->input->post('no_ktp'),
                            'no_npwp'=>$this->input->post('no_npwp'),
                            'nama_lengkap'=>$this->input->post('nama_lengkap'),
                            'nama_panggilan'=>$this->input->post('nama_panggilan'),
                            'tempat_lahir'=>$this->input->post('tempat_lahir'),
                            'tanggal_lahir' =>$tanggal_lahir,
                            'agama'=>$this->input->post('agama'),
                            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                            'alamat'=>$this->input->post('alamat'),
                            'no_hp'=>$this->input->post('no_hp'),
                            'pendidikan_terakhir'=>$this->input->post('pendidikan_terakhir'),
                            'goldar'=>$this->input->post('goldar'),
                            'status'=>$this->input->post('status'),
                            'no_rekening'=>$this->input->post('no_rekening'),
                            'bank' =>$this->input->post('bank'),
                            'gaji_pokok'=>$this->input->post('gaji_pokok'),
                            'bagian' =>$this->input->post('bagian'),
                            'sub_bagian'=>$this->input->post('sub_bagian'),
                            'email'=>$this->input->post('email'),
                            'foto_profile'=>$f,
                            'tugas_pokok'=>$this->input->post('tugas_pokok'),
                            'id_sd'=>$this->input->post('id_sd'),

                            'password'=>hash("sha512", md5($this->input->post('password'))),
                           
                      );
              }
              else{
               $data = array('no_ktp'=>$this->input->post('no_ktp'),
                            'no_npwp'=>$this->input->post('no_npwp'),
                            'nama_lengkap'=>$this->input->post('nama_lengkap'),
                            'nama_panggilan'=>$this->input->post('nama_panggilan'),
                            'tempat_lahir'=>$this->input->post('tempat_lahir'),
                            'tanggal_lahir' =>$tanggal_lahir,
                            'agama'=>$this->input->post('agama'),
                            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                            'alamat'=>$this->input->post('alamat'),
                            'no_hp'=>$this->input->post('no_hp'),
                            'pendidikan_terakhir'=>$this->input->post('pendidikan_terakhir'),
                            'goldar'=>$this->input->post('goldar'),
                            'status'=>$this->input->post('status'),
                            'no_rekening'=>$this->input->post('no_rekening'),
                            'bank' =>$this->input->post('bank'),
                            'gaji_pokok'=>$this->input->post('gaji_pokok'),
                            'bagian' =>$this->input->post('bagian'),
                            'sub_bagian'=>$this->input->post('sub_bagian'),
                            'email'=>$this->input->post('email'),
                            'tugas_pokok'=>$this->input->post('tugas_pokok'),
                            'foto_profile'=>$f,
                            'id_sd'=>$this->input->post('id_sd'),



                           
                           
                      );
              }
              $where = array('id_pegawai'=>$id);
              $this->model_app->update('pegawai',$data,$where);
              $this->session->set_flashdata('success', 'Pegawai Berhasil Diubah');
              redirect('administrator/pegawai');
          
          }else{
              $id = $this->uri->segment('4');
              $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
              $cek =  $this->model_app->view_where('pegawai',array('id_pegawai'=>$id,'id_sd'=>$cabang['id_sd']));
              if($cek->num_rows() > 0 ){
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                if($cabang['status']  == 'sekolah'){
                    $cbg = 'all';
                }else {
                    $cbg = $cabang['id_sd'];
                }
                $data['status'] = $cabang['status'];
               
                $data['row'] =$cek->row_array();
                $data['title'] = 'Pegawai - '.title();
                $data['page'] = 'Edit  Pegawai';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/pegawai').'">Pegawai</a></li> ';
                $data['breadcumb3']= '<li class="breadcrumb-item active" >Edit</li>';
                $data['bag'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
                $this->template->load('administrator/template','administrator/mod_pegawai/view_pegawai_edit',$data);
              }else{
                  $this->session->set_flashdata('message',array('Pegawai tidak ditemukan!'));
                  redirect('administrator/pegawai');
              }
             
          }

      }elseif($this->uri->segment('3')=='hapus'){
         cek_session_akses('administrator/pegawai/hapus',$this->session->id_session);

          $where = array('id_pegawai'=>$this->uri->segment('4'));
          $this->model_app->delete('pegawai',$where);
           $this->session->set_flashdata('success', 'Pegawai Berhasil Dihapus');
          redirect('administrator/pegawai');

      }elseif($this->uri->segment('3')=='add'){
         cek_session_akses('administrator/pegawai/add',$this->session->id_session);

          if(isset($_POST['submit'])){
              $this->form_validation->set_rules('no_ktp','No KTP','required|is_unique[pegawai.no_ktp]');
             
              $this->form_validation->set_rules('email','Email','required|is_unique[pegawai.email]');
               $config['upload_path']          = './asset/foto_user/';
              $config['allowed_types']        = 'gif|jpg|png|jpeg';
              $config['max_size']             = 5000;
              $config['encrypt_name'] = TRUE;
              
              
            
              
             

              $this->load->library('upload', $config);

            
              if ( ! $this->upload->do_upload('foto')){
             
               $foto = 'blank.png';
              }else{
                  $f = $this->upload->data();
               $foto = $f['file_name'];
              }
              if($this->form_validation->run() === FALSE){
                  
                  
               $data['bagian'] = $this->model_app->view('bagian');
               $this->template->load('administrator/template','administrator/mod_pegawai/view_pegawai_tambah',$data);

              }else{
              $tanggal_lahir = date('Y-m-d',strtotime($this->input->post('tanggal_lahir')));
              $data = array('no_ktp'=>$this->input->post('no_ktp'),
                            'no_npwp'=>$this->input->post('no_npwp'),
                            'nama_lengkap'=>$this->input->post('nama_lengkap'),
                            'nama_panggilan'=>$this->input->post('nama_panggilan'),
                            'tempat_lahir'=>$this->input->post('tempat_lahir'),
                            'tanggal_lahir' =>$tanggal_lahir,
                            'agama'=>$this->input->post('agama'),
                            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                            'alamat'=>$this->input->post('alamat'),
                            'no_hp'=>$this->input->post('no_hp'),
                            'pendidikan_terakhir'=>$this->input->post('pendidikan_terakhir'),
                            'goldar'=>$this->input->post('goldar'),
                            'status'=>$this->input->post('status'),
                            'no_rekening'=>$this->input->post('no_rekening'),
                            'bank' =>$this->input->post('bank'),
                            'gaji_pokok'=>$this->input->post('gaji_pokok'),
                            'bagian' =>$this->input->post('bagian'),
                            'sub_bagian'=>$this->input->post('sub_bagian'),
                            'sub_kegiatan'=>$this->input->post('sub_kegiatan'),
                            'email'=>$this->input->post('email'),
                            'tugas_pokok'=>$this->input->post('tugas_pokok'),
                            'foto_profile'=>$foto,
                            'id_sd'=>$this->input->post('id_sd'),


                            'password'=>hash("sha512", md5($this->input->post('password'))),
                           
                      );
              $this->model_app->insert('pegawai',$data);
              $this->session->set_flashdata('success', 'Pegawai Berhasil Ditambah');
              redirect('administrator/pegawai');
              }
          }else{
               $data['title'] = 'Pegawai - '.title();
                $data['page'] = 'Tambah  Pegawai';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/pegawai').'">Pegawai</a></li> ';
                $data['breadcumb3']= '<li class="breadcrumb-item active" >Tambah</li>';
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                  if($cabang['status']  == 'sekolah'){
                      $cbg = 'all';
                  }else {
                      $cbg = $cabang['id_sd'];
                  }
                  $data['status'] = $cabang['status'];
                 
                  
               $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
               $this->template->load('administrator/template','administrator/mod_pegawai/view_pegawai_tambah',$data);
          }

      }else{
          cek_session_akses('administrator/pegawai',$this->session->id_session);
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
      if($cabang['status']  == 'sekolah'){
          $cbg = 'all';
      }else {
          $cbg = $cabang['id_sd'];
      }
      $data['status'] = $cabang['status'];
    

      if(isset($_POST['filter'])){
        $data['bagian'] = $this->input->post('bagian');
        $data['sub_bagian'] = $this->input->post('sub_bagian');
        $data['sub_kegiatan'] = $this->input->post('sub_kegiatan');
    
      }else{
        $data['bagian'] = "all";
        $data['sub_bagian'] = "all";
        $data['sub_kegiatan'] = "all";
       
        
      }
      $data['cabang'] = $cbg;
      $data['title'] = 'Pegawai - '.title();
      $data['page'] = 'Data Pegawai';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
      $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/pegawai').'">Pegawai</a></li> ';
      $data['breadcumb3']= '';
       
      $data['record'] = $this->model_app->filterpegawai($data['bagian'],$data['sub_bagian'],$data['sub_kegiatan'],$data['status']);
      $this->template->load('administrator/template','administrator/mod_pegawai/view_pegawai',$data);
      }
  }
  function sub1(){
    $id_bagian = $this->input->post('id_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_bagian',array('id_bagian' => $id_bagian),'id_sub_bagian','DESC');
    $this->load->view('administrator/view_sub_bagian1',$data);    
  }
  function sk1(){
    $id_sub_bagian = $this->input->post('id_sub_bagian');
    $data['sub'] = $this->model_app->view_where_ordering('sub_kegiatan',array('id_sub_bagian' => $id_sub_bagian),'id_sub_kegiatan','DESC');
    $this->load->view('administrator/view_sub_kegiatan1',$data);    
  }

  //PEGAWAI//
  //PENGAWAS//
  function pengawas()

  {
     
    if($this->uri->segment('3')=='add'){
      cek_session_akses('administrator/pengawas/add',$this->session->id_session);
      if(isset($_POST['submit']))
      {
        $jabatan = $this->input->post('jabatan');

        if($jabatan == 'admin'){
          $bagian = 0;
          $sub_bagian =0;
        }else{
           if($this->input->post('sub_bagian') == NULL)
           {
             $bagian = $this->input->post('bagian');
            $sub_bagian = 0;
          }else{
          $bagian = $this->input->post('bagian');
          $sub_bagian = $this->input->post('sub_bagian');
          }
        }
        $password = hash("sha512", md5($this->input->post('password')));
        $data = array('nip'=>$this->input->post('nip'),
                      'nama_lengkap' => $this->input->post('nama_lengkap'),
                      'username'=> $this->input->post('username'),
                      'password'=>$password,
                      'jabatan'=>$jabatan,
                      'bagian'=>$bagian,
                      'sub_bagian'=>$sub_bagian,
                      'no_hp'=>$this->input->post('nohp'),
                      'id_sd'=>$this->input->post('id_sd'),
                      );

        $this->model_app->insert('pengawas',$data);
         $this->session->set_flashdata('success', 'Pengawas Berhasil Ditambah');
        redirect('administrator/pengawas');




      }else{
           $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                  if($cabang['status']  == 'sekolah'){
                      $cbg = 'all';
                  }else {
                      $cbg = $cabang['id_sd'];
                  }
                  $data['status'] = $cabang['status'];
                  $data['kelurahan'] = $cabang['kelurahan'];
                  $data['kabupaten'] = $cabang['kabupaten'];
                  $data['kecamatan'] = $cabang['kecamatan'];
                  $data['title'] = 'Pengawas - '.title();
                  $data['page'] = 'Tambah Pengawas';
                  $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
                  $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/pengawas').'">Pengawas</a></li> ';
                  $data['breadcumb3']= ' <li class="breadcrumb-item active" >Tambah</li>';
                $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cbg));
               $this->template->load('administrator/template','administrator/mod_pengawas/view_pengawas_add',$data);
      }

    }elseif($this->uri->segment('3')=='edit'){
      cek_session_akses('administrator/pengawas/edit',$this->session->id_session);
      if(isset($_POST['submit']))
      {
         $jabatan = $this->input->post('jabatan');

        if($jabatan == 'admin'){
          $bagian = 0;
          $sub_bagian =0;
        }else{
           if($this->input->post('sub_bagian') == NULL)
           {
             $bagian = $this->input->post('bagian');
            $sub_bagian = 0;
          }else{
          $bagian = $this->input->post('bagian');
          $sub_bagian = $this->input->post('sub_bagian');
          }
        }
        $pwd = $this->input->post('password');
        if(trim($pwd) != ''){
          $password = hash("sha512", md5($this->input->post('password')));
        }else{
          $password = $this->input->post('pwd');
        }
        
        $data = array('nip'=>$this->input->post('nip'),
                      'nama_lengkap' => $this->input->post('nama_lengkap'),
                      'username'=> $this->input->post('username'),
                      'password'=>$password,
                      'jabatan'=>$jabatan,
                      'bagian'=>$bagian,
                      'sub_bagian'=>$sub_bagian,
                       'no_hp'=>$this->input->post('nohp'),
                       'id_sd'=>$this->input->post('id_sd'),
                      );
        $where = array('id_pengawas'=>$this->input->post('id'));
        $this->model_app->update('pengawas',$data,$where);
         $this->session->set_flashdata('success', 'Pengawas Berhasil Diubah');
        redirect('administrator/pengawas');

      }else{
          $id = $this->uri->segment('4');
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                  if($cabang['status']  != 'kelurahan'){
                      $cbg = 'all';
                  }else {
                      $cbg = $cabang['id_sd'];
                  }
                  $data['status'] = $cabang['status'];
                  $data['kelurahan'] = $cabang['kelurahan'];
                  $data['kabupaten'] = $cabang['kabupaten'];
                  $data['kecamatan'] = $cabang['kecamatan'];
                  $data['title'] = 'Pengawas - '.title();
                  $data['page'] = 'Edit Pengawas';
                  $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
                  $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/pengawas').'">Pengawas</a></li> ';
                  $data['breadcumb3']= ' <li class="breadcrumb-item active" >Edit</li>';
          $data['row'] = $this->model_app->view_where('pengawas',array('id_pengawas'=>$id))->row_array();
        
          $this->template->load('administrator/template','administrator/mod_pengawas/view_pengawas_edit',$data);
      }

    }elseif($this->uri->segment('3')=='hapus'){
      cek_session_akses('administrator/pengawas/hapus',$this->session->id_session);
         $where = array('id_pengawas'=>$this->uri->segment('4'));
          $this->model_app->delete('pengawas',$where);

           $this->session->set_flashdata('success', 'Pengawas Berhasil Dihapus');
          redirect('administrator/pengawas');

    }else{
      cek_session_akses('administrator/pengawas',$this->session->id_session);
       $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                  if($cabang['status']  == 'kelurahan'){
                      $cbg = 'all';
                  }else {
                      $cbg = $cabang['id_sd'];
                  }
                  $data['status'] = $cabang['status'];
                  $data['kelurahan'] = $cabang['kelurahan'];
                  $data['kabupaten'] = $cabang['kabupaten'];
                  $data['kecamatan'] = $cabang['kecamatan'];
      if(isset($_POST['filter'])){
       
          $data['bagian'] = $this->input->post('bagian');
          $data['sub_bagian'] = $this->input->post('sub_bagian');
       
      }else{
        //   $data['jabatan'] = 'all';
          $data['bagian'] = 'all';
          $data['sub_bagian'] = 'all';
      }
      $data['cabang'] = $cbg;

      $data['title'] = 'Pengawas - '.title();
      $data['page'] = 'Data Pengawas';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
      $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/pengawas').'">Pengawas</a></li> ';
      $data['breadcumb3']= '';
      $data['record'] = $this->model_app->filterpengawas($data['bagian'],$data['sub_bagian'],$data['cabang']);
      $this->template->load('administrator/template','administrator/mod_pengawas/view_pengawas',$data);
    }
  }
  //PENGAWAS //
  function harikerja()
  { 
     cek_session_akses('administrator/harikerja',$this->session->id_session);
     $m = date('Y-m-d');
     if($this->input->post('bulan') ==""){
          $data['m'] = $m;
          $this->template->load('administrator/template','administrator/mod_harikerja/view_harikerja',$data);
    
     }else{
      $data['m'] = $this->input->post('bulan');
      $tahun = date('Y');
      $tanggal =$this->input->post('bulan');
      $bulan = date('m',strtotime($tanggal));

      $cek = $this->model_app->view_where('harikerja',array('bulan'=>$bulan,'tahun'=>$tahun));
      if($cek->num_rows() <= 0){
        
        $hari_ini = date("Y-m-d",strtotime($tanggal));
        $tgl_pertama = date('01', strtotime($hari_ini));
        $tgl_terakhir = date('t', strtotime($hari_ini));
     
        
        for($a=1;$a<=$tgl_terakhir;$a++){
          $data = array('bulan'=>$bulan,'tahun'=>$tahun,'tanggal'=>$a);
          $this->model_app->insert('harikerja',$data);
        }
      } 
      $data['title'] = 'Hari Kerja - '.title();
      $data['page'] = 'Data Hari Kerja';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
      $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/harikerja').'">Hari Kerja</a></li> ';
      $data['breadcumb3']= '';
       $data['record'] = $this->model_app->view_where('harikerja',array('bulan'=>$bulan))->result_array();
       $this->template->load('administrator/template','administrator/mod_harikerja/view_harikerja',$data);

    
     }

     
  }

  function update_harikerja()
  {
    $status = $this->input->post('status');
    $id = $this->input->post('id');

    $wher = array('id_harikerja'=>$id);
    $data = array('status'=>$status);
    $this->model_app->update('harikerja',$data,$wher);
  }
  function jamkerja()
  {
     cek_session_akses('administrator/jamkerja',$this->session->id_session);
    $cek = $this->model_app->view('shift');

    if($cek->num_rows() <= 0 )
    {
      $hari=array("Senin","Selasa","Rabu","Kamis","Jumat");
      $count = count($hari);

      for($a=0;$a<$count;$a++){
        $data=array('hari'=>$hari[$a],'shift_masuk'=>'00:00:00','shift_keluar'=>'00:00:00');
        $this->model_app->insert('shift',$data);
      }
    }
    $data['title'] = 'Jam Kerja - '.title();
    $data['page'] = 'Data Jam Kerja';
    $data['breadcumb1'] = ' <li class="breadcrumb-item " >Module Pegawai</li>';
    $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/jamkerja').'">Jam Kerja</a></li> ';
    $data['breadcumb3']= '';
      $data['record'] = $cek->result_array();
      $this->template->load('administrator/template','administrator/mod_harikerja/view_jamkerja',$data);
  }

  function updatejamkerja()
  {

    $shift_masuk = $this->input->post('shift_masuk');
    $shift_keluar = $this->input->post('shift_keluar');
    $id = $this->input->post('id');
    

    $updateArray = array();

    for($x = 0; $x < sizeof($id); $x++){

  
    $updateArray[] = array(
        'id_shift'=>$id[$x],
        'shift_masuk' => $shift_masuk[$x],
        'shift_keluar' => $shift_keluar[$x],
       
    );
   
    }      
    $this->db->update_batch('shift',$updateArray, 'id_shift');
     redirect('administrator/jamkerja'); 
    }
    //KINERJA //

    function absensi(){
        cek_session_akses('administrator/absensi',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  == 'kelurahan'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
         
       if(isset($_POST['filter'])){
             $data['start'] = $this->input->post('start');
             $data['end'] = $this->input->post('end');
             $data['telat'] = $this->input->post('telat');
             $data['pulang'] =$this->input->post('pulang');
             $data['ket'] = $this->input->post('ket');
           
   
   
       }else{
   
             $data['start'] = date('Y-m-01');
             $data['end'] = date('Y-m-d');
             $data['telat'] = 'all';
             $data['pulang'] = 'all';
             $data['ket'] = 'all';
           
   
   
       }
       $data['cabang'] = $cbg;
        $data['title'] = 'Absensi - '.title();
        $data['page'] = 'Data Absensi';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/absensi').'">Absensi</a></li> ';
        $data['breadcumb3']= '';
        $sub = $this->session->sub_bagian;
             $data['record'] = $this->model_app->search_absensi($data['start'],$data['end'],$data['telat'],$data['pulang'],$data['ket'],$data['cabang']);
             $this->template->load('administrator/template','administrator/mod_kehadiran/view_absensi',$data);
   
     }
      function tambahabsen(){
    cek_session_akses('administrator/tambahabsen',$this->session->id_session);
       if(isset($_POST['submit'])){
           $ip = $_SERVER['REMOTE_ADDR'];
           $details = json_decode(file_get_contents("https://ipinfo.io/$ip/json"));
           $loc =  $details->loc; // -> "Mountain View"
           $lok =explode(',', $loc);
           $lat = $lok[0];
           $long = $lok[1];
           $tgl = date('Y-m-d');
           $absen_masuk = date('H:i:s',strtotime($this->input->post('absen_masuk')));
           $absen_keluar =  date('H:i:s',strtotime($this->input->post('absen_keluar')));
           $id_pegawai = $this->input->post('peg');
           $ket = $this->input->post('ket');
   
             $config['upload_path']          = './asset/foto_absen/';
             $config['allowed_types']        = 'gif|jpg|png|jpeg';
             $config['max_size']             = 20000;
             $config['encrypt_name'] = TRUE;
             $h = hari_ini(date('w'));
            $cek = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
   
            if($absen_masuk <= $cek['shift_masuk']){
                 $telat ='n';
                 $poin_in = 1;
                     
           }else{
                 $telat ='y';
                 $poin_in = 0;
                    
           }
           if($absen_keluar >= $cek['shift_keluar']){
                         $pulang ='n';
                      
                       
             }else{
                         $pulang ='y';
                      
                        
             }
                   $this->load->library('upload', $config);
   
                   if ( ! $this->upload->do_upload('foto_in')){
                   
                     $foto_masuk = '';
                   }else{
                     $foto_in = $this->upload->data();
                     $foto_masuk = base_url('asset/foto_absen/').$foto_in['file_name'];
                   }
                    if ( ! $this->upload->do_upload('foto_out')){
                   
                     $foto_keluar = '';
                   }else{
                     $foto_out = $this->upload->data();
                     $foto_keluar = base_url('asset/foto_absen/').$foto_out['file_name'];
                   }
   
                   $data=array('id_pegawai'=>$id_pegawai,'tanggal'=>$tgl,'absen_masuk'=>$absen_masuk,'absen_keluar'=>$absen_keluar,'ip'=>$ip,'latitude_in'=>$lat,'longitude_in'=>$long,'latitude_out'=>$lat,'longitude_out'=>$long,'foto_masuk'=>$foto_masuk,'foto_keluar'=>$foto_keluar,'telat'=>$telat,'pulang_awal'=>$pulang,'ket'=>$ket,'status_absen'=>'pegawai');
                   $ids = $this->model_app->insert_id('absensi',$data);
   
                     $pe = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$tgl,'id_pegawai'=>$id_pegawai));
               if($pe->num_rows() > 0){
                   $p = $pe->row_array();
                 if($p['poin'] <= 1 ){
                   
                
                 $poin_now = $p['poin'];
   
                 $poin = $poin_now+2;
               }else{
                 $poin_now = $p['poin'];
                 $poin = $poin_now+1;
               }
   
                 $dp = array('poin'=>$poin);
                 $wp = array('tanggal'=>$tgl,'id_pegawai'=>$id_pegawai);
                $this->model_app->update('poin_pegawai',$dp,$wp);
             }else{
               $datp = array('id_pegawai'=>$id_pegawai,'tanggal'=>$tgl,'poin'=>'1','status_poin'=>'pegawai');
               $this->model_app->insert('poin_pegawai',$datp);
             }
                   
                     $link = base_url('administrator/detailabsen/').$ids;
                     $this->insert_history($link,'tambah','absensi');
                   redirect('administrator/absensi');
   
   
   
       }else{
           $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                       if($cabang['status']  == 'sekolah'){
                           
                          $cbg = 'all';
   
                           
                       }else {
                           $cbg = $cabang['id_sd'];
                       }
           $data['status'] = $cabang['status'];
           $data['kelurahan'] = $cabang['kelurahan'];
           $data['kabupaten'] = $cabang['kabupaten'];
           $data['kecamatan'] = $cabang['kecamatan'];
         $h = hari_ini(date('w'));
         $data['title'] = 'Absensi - '.title();
         $data['page'] = 'Tambah Absensi';
         $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
         $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/absensi').'">Absensi</a></li> ';
         $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
         $data['shift'] = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
         $sub = $this->session->sub_bagian;
        
            $data['pegawai'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
       
      
        $this->template->load('administrator/template','administrator/mod_kehadiran/view_absensi_add',$data);
      }
     }
   
     function editabsen(){
        cek_session_akses('administrator/editabsen',$this->session->id_session);
   
       if(isset($_POST['submit'])){
           $absen_masuk = date('H:i:s',strtotime($this->input->post('absen_masuk')));
           $absen_keluar =  date('H:i:s',strtotime($this->input->post('absen_keluar')));
   
           $tgl = $this->input->post('tgl');
           $ket = $this->input->post('ket');
   
           $id=$this->input->post('id');
            $h = hari_ini(date('w'));
            $cek = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
            
   
             $data = array('absen_masuk'=>$absen_masuk,'absen_keluar'=>$absen_keluar,'ket'=>$ket,'telat'=>$cek['telat'],'pulang_awal'=>$cek['pulang_awal']);
             $where = array('id_absensi'=>$id);
             $this->model_app->update('absensi',$data,$where);
   
              $link = base_url('administrator/detailabsen/').$id;
                     $this->insert_history($link,'edit','absensi');
   
             redirect('administrator/detailabsen/'.$id);
   
   
   
       }else{
        $id = $this->uri->segment('3');
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
  
  
         $cek = $this->model_app->detail_absensi($id,$cabang['id_sd']);
         if($cek->num_rows() >0){
          $data['title'] = 'Absensi - '.title();
          $data['page'] = 'Edit Absensi';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/absensi').'">Absensi</a></li> ';
          $data['breadcumb3']= '<li class="breadcrumb-item active " >Edit</li>';
          $data['rows'] = $cek->row_array();
          $this->template->load('administrator/template','administrator/mod_kehadiran/view_absensi_edit',$data);
         }else{
          $this->session->set_flashdata('message','Absensi tidak ditemukan');
          redirect('administrator/absensi');
         }

       }
     }
     function detailabsen(){
       $id = $this->uri->segment('3');
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();


       $cek = $this->model_app->detail_absensi($id,$cabang['id_sd']);
       if($cek->num_rows() >0){
        $data['title'] = 'Absensi - '.title();
        $data['page'] = 'Detail Absensi';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/absensi').'">Absensi</a></li> ';
        $data['breadcumb3']= '<li class="breadcrumb-item active " >Detail</li>';
        $data['rows'] = $cek->row_array();
        $this->template->load('administrator/template','administrator/mod_kehadiran/view_absensi_detail',$data);
       }else{
        $this->session->set_flashdata('message','Absensi tidak ditemukan');
        redirect('administrator/absensi');
       }
      
   
     }
     function hapusabsen()
     {
         cek_session_akses('administrator/hapusabsen',$this->session->id_session);
       $id = $this->uri->segment('3');
       $cek = $this->model_app->view_where('absensi',array('id_absensi'=>$id));
       if($cek->num_rows() > 0){
       $row = $cek->row_array();
       $tgl = $row['tanggal'];
       $id_peg = $row['id_pegawai'];
   
       $this->model_app->delete('report',array('id_pegawai'=>$id_peg,'date'=>$tgl));
      $this->model_app->delete('poin_pegawai',array('id_pegawai'=>$id_peg,'tanggal'=>$tgl));
       $this->model_app->delete('absensi',array('id_absensi'=>$id));
   
   
        $this->session->set_flashdata('success','Absen berhasil dihapus!');
   
           $link = base_url('administrator/absensi/');
           $this->insert_history($link,'hapus','absensi');
           redirect('administrator/absensi');
       }else{
           $this->session->set_flashdata('message','Data tidak ditemukan');
           redirect('administrator/absensi');
       }
     }
       function ijin(){
        cek_session_akses('administrator/ijin',$this->session->id_session);
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  != 'kelurahan'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
          
        if(isset($_POST['filter'])){
             $data['start'] = $this->input->post('start');
             $data['end'] = $this->input->post('end');
             $data['status'] = $this->input->post('status');
             
   
             
       }else{
   
             $data['start'] = date('Y-m-01');
             $data['end'] = date('Y-m-d',strtotime("+5 Days"));
             $data['status'] = 'all';
            
            
       }
       $data['cabang'] = $cbg;
       $data['title'] = 'Ijin - '.title();
       $data['page'] = 'Data Ijin';
       $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
       $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/ijin').'">Ijin</a></li> ';
       $data['breadcumb3']= '';
       
       $data['record'] = $this->model_app->search_izin($data['start'],$data['end'],$data['status'],$data['cabang']);
        $this->template->load('administrator/template','administrator/mod_kehadiran/view_ijin',$data);
     }
   
     function ijin_add()
     {
       cek_session_akses('administrator/ijin_add',$this->session->id_session);
       if(isset($_POST['submit'])){
           $data = [];
      
         $count = count($_FILES['files']['name']);
       
         for($i=0;$i<$count;$i++){
       
           if(!empty($_FILES['files']['name'][$i])){
       
             $_FILES['file']['name'] = $_FILES['files']['name'][$i];
             $_FILES['file']['type'] = $_FILES['files']['type'][$i];
             $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
             $_FILES['file']['error'] = $_FILES['files']['error'][$i];
             $_FILES['file']['size'] = $_FILES['files']['size'][$i];
     
             $config['upload_path'] =  './asset/foto_form/'; 
             $config['allowed_types'] = 'jpg|jpeg|png|gif';
             $config['max_size'] = '20000';
             $config['encrypt_name'] = TRUE;
             $config['file_name'] = $_FILES['files']['name'][$i];
      
             $this->load->library('upload',$config); 
             $this->upload->do_upload('file');
           
            //  $data['totalFiles'][] = $images;
             $uploadData = $this->upload->data();
             $images[] = $uploadData['file_name'];
             }
   
      
         }
            $fileName = implode(';',$images);
               $foto = str_replace(' ','_',$fileName);
              
       
             if(trim($foto)!=''){
                 
             
                $id = $this->input->post('peg');
               $dari = date('Y-m-d',strtotime($this->input->post('dari')));
               $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
               $data = array('id_pegawai'=>$id,'keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'),'foto'=>$foto,'approved'=>'setuju','status_form'=>'pegawai');
               $this->db->insert('form_izin',$data);
               $this->session->set_flashdata('success','Formulir berhasil diinput!');
   
               redirect('administrator/ijin');
           
   
               
             }else{
                    $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('message',$error['error']);
                redirect('administrator/ijin');
                
             }
             
       }else{
           $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  == 'sekolah'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
           $data['title'] = 'Add Ijin - '.title();
           $data['page'] = 'Add Ijin';
           $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
           $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/ijin').'">Ijin</a></li> ';
           $data['breadcumb3']= '<li class="breadcrumb-item  active" >Tambah</li>';
     
        $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
        $this->template->load('administrator/template','administrator/mod_kehadiran/view_ijin_add',$data);
      }
     }
     function lembur(){
       cek_session_akses('administrator/lembur',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  == 'sekolah'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
            $data['status'] = $cabang['status'];
           $data['kelurahan'] = $cabang['kelurahan'];
           $data['kabupaten'] = $cabang['kabupaten'];
           $data['kecamatan'] = $cabang['kecamatan'];
        if(isset($_POST['filter'])){
   
         $data['hari'] = $this->input->post('hari');
         $data['sub'] = $this->input->post('sub');
        
       
       }
       else{
         $data['hari'] = date('Y-m-d');
         $data['sub'] = 'all';
         
       }
       $data['cabang'] = $cbg;
        $data['sub_bag'] = $this->model_app->view_where('sub_bagian',array('id_sd'=>$cbg));
        $data['record'] =   $this->model_app->search_lembur($data['hari'],$data['sub'],$data['cabang']);
        $data['title'] = 'Lembur - '.title();
        $data['page'] = 'Data Lembur';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/lembur').'">Lembur</a></li> ';
        $data['breadcumb3']= '';
        $this->template->load('administrator/template','administrator/mod_kehadiran/view_lembur',$data);
   
     }
      function downloadlembur(){
         $id = $this->uri->segment('4');
         $data['row'] = $this->db->query("SELECT * FROM lembur a JOIN pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_lembur = $id")->row_array();
         // $this->load->view('phpmu-tigo/pengawas/view_download_lembur',$data);
   
          $this->load->helper('dompdf');
               $html = $this->load->view('administrator/mod_kehadiran/view_download_lembur',$data,true);
           
    
       //load content html
                 
                
                   // create pdf using dompdf
                   $filename = 'SURAT TUGAS SEKDA';
                   $paper = 'A4';
                   $orientation = 'potrait';
                   pdf_create($html, $filename, $paper, $orientation);
     }
   
      function hapusijin()
     {
       cek_session_akses('administrator/hapusijin',$this->session->id_session);
       $id = $this->uri->segment('3');
       $this->model_app->delete('form_izin',array('id_form'=>$id));
        $this->session->set_flashdata('success','Formulir berhasil dihapus!');
       redirect('administrator/ijin');
     }
      function detailform(){
   
       $id = $this->uri->segment('3');
       $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
       $cek =  $this->model_app->detail_form($id,$cabang['id_sd']);
       if($cek->num_rows()> 0){
        $data['title'] = 'Detail Ijin - '.title();
        $data['page'] = 'Detail Ijin';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/ijin').'">Ijin</a></li> ';
        $data['breadcumb3']= '<li class="breadcrumb-item  active" >Detail</li>';
        $data['rows'] =$cek->row_array();
       $this->template->load('administrator/template','administrator/mod_kehadiran/view_ijin_detail',$data);
       }else{
           $this->session->set_flashdata('message','Ijin Sakit tidak ditemukan');
           redirect('administrator/ijin');
       }
       
   
     }
     function downloadform()
     {
   
       $id = $this->uri->segment('4');
    //    $data['row'] = $this->model_app->detail_form($id)->row_array();
     
       $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
       $cek =  $this->model_app->detail_form($id,$cabang['id_sd']);
       if($cek->num_rows()> 0){
        $data['row'] = $cek->row_array();
           $this->load->helper('dompdf');
         $html =   $this->load->view('administrator/mod_kehadiran/view_form_download',$data,true);
       
    
       //load content html
           
          
             // create pdf using dompdf
             $filename = 'FORMULIR-IZIN/SAKIT-PEGAWAI-NON-ASN';
             $paper = 'A4';
             $orientation = 'potrait';
             pdf_create($html, $filename, $paper, $orientation);
       }else{
        $this->session->set_flashdata('message','Ijin Sakit tidak ditemukan');
        redirect('administrator/ijin');
       }
     }
      function editijin(){
        cek_session_akses('administrator/editijin',$this->session->id_session);
       if(isset($_POST['submit'])){
                $dari = date('Y-m-d',strtotime($this->input->post('dari')));
               $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
               $data = array('keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'));
               $where = array('id_form'=>$this->input->post('id'));
   
               $this->model_app->update('form_izin',$data,$where);
               $this->session->set_flashdata('success','Formulir berhasil diubah!');
   
               redirect('administrator/ijin');
       }else{
        $id = $this->uri->segment('3');
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $cek =  $this->model_app->detail_form($id,$cabang['id_sd']);
        if($cek->num_rows()> 0){
         $data['title'] = 'Edit Ijin - '.title();
         $data['page'] = 'Edit Ijin';
         $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
         $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/ijin').'">Ijin</a></li> ';
         $data['breadcumb3']= '<li class="breadcrumb-item  active" >Edit</li>';
         $data['rows'] =$cek->row_array();
        $this->template->load('administrator/template','administrator/mod_kehadiran/view_ijin_edit',$data);
        }else{
            $this->session->set_flashdata('message','Ijin Sakit tidak ditemukan');
            redirect('administrator/ijin');
        }
      
       }
   
     }
     function alpha()
     {
        cek_session_akses('administrator/alpha',$this->session->id_session);
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  == 'sekolah'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
          
       if(isset($_POST['filter'])){
   
         $data['hari'] = $this->input->post('hari');
         $data['sub'] = $this->input->post('sub');
       
       }
       else{
         $data['hari'] = date('Y-m-d');
         $data['sub'] = 'all';
         
       }
        $data['title'] = 'Alpha - '.title();
        $data['page'] = 'Data Alpha';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/alpha').'">Alpha</a></li> ';
        $data['breadcumb3']= '';
          $data['cabang'] = $cbg;
          $data['sub_bag'] = $this->model_app->view_where('sub_bagian',array('id_sd'=>$cabang['id_sd']));
          $data['record'] = $this->model_app->search_alpha($data['hari'],$data['sub'],$data['cabang']);
       
       $this->template->load('administrator/template','administrator/mod_kehadiran/view_alpha',$data);
     }
       function report(){
          cek_session_akses('administrator/report',$this->session->id_session);
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  == 'sekolah'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
           $data['status'] = $cabang['status'];
           $data['kelurahan'] = $cabang['kelurahan'];
           $data['kabupaten'] = $cabang['kabupaten'];
           $data['kecamatan'] = $cabang['kecamatan'];
   
   
        if(isset($_POST['filter'])){
             $data['start'] = $this->input->post('start');
             $data['end'] = $this->input->post('end');
             $data['pegawai'] = $this->input->post('pegawai');
           
             
       }else{
   
             $data['start'] = date('Y-m-01');
             $data['end'] = date('Y-m-d',strtotime("+5 Days"));
            
             $data['pegawai'] ='all';
            
       }
         $data['cabang'] = $cbg;
         $data['title'] = 'Report - '.title();
        $data['page'] = 'Data Report';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/report').'">Report</a></li> ';
        $data['breadcumb3']= '';
        
            $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
       $data['record'] = $this->model_app->data_report($data['start'],$data['end'],$data['pegawai'],$data['cabang']);
        $this->template->load('administrator/template','administrator/mod_report/view_report',$data);
     }
     function detailreport(){
        $id = $this->uri->segment('3');
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $cek =  $this->model_app->detail_report($id,$cabang['id_sd']);
        if($cek->num_rows()> 0){
          $data['title'] = 'Detail Report - '.title();
          $data['page'] = 'Detail Report';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/ijin').'">Rerport</a></li> ';
          $data['breadcumb3']= '<li class="breadcrumb-item  active" >Detail</li>';
          $data['rows'] =$cek->row_array();
          $this->template->load('administrator/template','administrator/mod_report/view_report_detail',$data);
        }else{
            $this->session->set_flashdata('message','Report  tidak ditemukan');
            redirect('administrator/report');
        }
      
   
    
      }
      function editreport(){
         cek_session_akses('administrator/editreport',$this->session->id_session);
        if(isset($_POST['submit'])){
              $judul = $this->input->post('judul_report');
              $tgl = $this->input->post('date');
              $start = $this->input->post('start');
              $end = $this->input->post('end');
              $keterangan = $this->input->post('report');
    
              $date = date('Y-m-d',strtotime($tgl));
              $start = date('H:i:s',strtotime($start));
              $end = date('H:i:s',strtotime($end));
              $id = $this->input->post('id');
              
              $s = new DateTime($start);
              $e = new DateTime($end);
              $interval = $s->diff($e);
              $hrs = $interval->d * 24 + $interval->h;
              $sel =  $hrs.".".$interval->format('%i');
               $data = array('judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'end'=>$end,'date'=>$date,'jam_kerja'=>$sel);
               $where = array('id_report'=>$id);
    
               $this->model_app->update('report',$data,$where);
    
               $this->session->set_flashdata('success','Report berhasil diubah!');
               redirect('administrator/report');
    
    
    
        }else{
          $id = $this->uri->segment('3');
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $cek =  $this->model_app->detail_report($id,$cabang['id_sd']);
          if($cek->num_rows()> 0){
            $data['title'] = 'Edit Report - '.title();
            $data['page'] = 'Edit Report';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/ijin').'">Rerport</a></li> ';
            $data['breadcumb3']= '<li class="breadcrumb-item  active" >Edit</li>';
            $data['rows'] =$cek->row_array();
            $this->template->load('administrator/template','administrator/mod_report/view_report_edit',$data);
          }else{
              $this->session->set_flashdata('message','Report  tidak ditemukan');
              redirect('administrator/report');
          }
      
        }
      }
    
      function tambahreport()
      {
         cek_session_akses('administrator/tambahreport',$this->session->id_session);
        if(isset($_POST['submit'])){
            $judul = $this->input->post('judul_report');
        $tgl = $this->input->post('date');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $keterangan = $this->input->post('report');
    
        $date = date('Y-m-d',strtotime($tgl));
        $start = date('H:i:s',strtotime($start));
        $end = date('H:i:s',strtotime($end));
        $id = $this->input->post('peg');
        
        $s = new DateTime($start);
        $e = new DateTime($end);
        $interval = $s->diff($e);
        $hrs = $interval->d * 24 + $interval->h;
        $sel =  $hrs.".".$interval->format('%i'); 
    
     
          $config1['upload_path']          = './asset/foto_report/';
								$config1['encrypt_name'] = TRUE;
								$config1['allowed_types']        = 'gif|jpg|png|jpeg';
								$config1['max_size']             = 1000;
									
										
								$this->load->library('upload', $config1,'identity_photo');
								$this->identity_photo->initialize($config1);

								
								$config2['upload_path']          = './asset/foto_report/';
								$config2['encrypt_name'] = TRUE;
								$config2['allowed_types']        = 'gif|jpg|png|jpeg';
								$config2['max_size']             = 1000;
									
										
								$this->load->library('upload', $config2,'npwp_photo');
								$this->npwp_photo->initialize($config2);

                // $fileName = implode(';',$images);
                // $foto = str_replace(' ','_',$fileName);
               
        
              if(!$this->identity_photo->do_upload('file')){
                $error = array('error' => $this->identity_photo->display_errors());
                $this->session->set_flashdata('message',$error['error']);
                redirect('administrator/report');
              }else if(!$this->npwp_photo->do_upload('file1')){
                $error = array('error' => $this->npwp_photo->display_errors());
                $this->session->set_flashdata('message',$error['error']);
                redirect('administrator/report');
              }else{
                $upload_data1 = $this->identity_photo->data();
                $upload_data2 = $this->npwp_photo->data();

                $foto_masuk = base_url('asset/foto_report/').$upload_data1['file_name'];
                $foto_keluar = base_url('asset/foto_report/').$upload_data2['file_name'];
                $tanggal = date('Y-m-d');
                $p = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$tanggal,'id_pegawai'=>$id))->row_array();
    
                $poin_now = $p['poin'];
    
                $poin = $poin_now+$sel;
    
                $dp = array('poin'=>$poin);
                $wp = array('tanggal'=>$tanggal,'id_pegawai'=>$id);
    
              $this->model_app->update('poin_pegawai',$dp,$wp);
    
    
                $data = array('id_pegawai'=>$id,'judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'end'=>$end,'date'=>$date,'foto_masuk'=>$foto_masuk,'foto_keluar'=>$foto_keluar,'jam_kerja'=>$sel,'status_report'=>'pegawai');
                $this->db->insert('report',$data);
                $this->session->set_flashdata('success','Report berhasil diinput!');
    
                redirect('administrator/report');
              }
                  
              
            
    
                
             
        }else{
             $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                        if($cabang['status']  == 'dinas'){
                          $cbg = $cabang['id_sd'];
                      
    
                            
                        }
                $sub = $this->session->sub_bagian;
                $data['title'] = 'Tambah Report - '.title();
                $data['page'] = 'Tambah Report';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/report').'">Report</a></li> ';
                $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
             $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
          // $data['peg'] = $this->model_app->view('pegawai');
           $this->template->load('administrator/template','administrator/mod_report/view_report_add',$data);
        }
       
    
      }
       function hapusreport()
      {
        cek_session_akses('administrator/hapusreport',$this->session->id_session); 
        $id = $this->uri->segment('3');
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $cek =  $this->model_app->detail_report($id,$cabang['id_sd']);
        if($cek->num_rows()> 0){
          $this->model_app->delete('report',array('id_report'=>$id));
          $this->session->set_flashdata('success','Report berhasil dihapus!');
          redirect('administrator/report');
        }else{
          $this->session->set_flashdata('message','Report tidak ditemukan!');
          redirect('administrator/report');
        }
      
        
      }
      function lembarkinerja()
      {
        cek_session_akses('administrator/lembarkinerja',$this->session->id_session); 
        $set = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $nama = $this->uri->segment('5');
        if($set =='harian'){
            $data['row'] = $this->db->query("SELECT * FROM pegawai a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_pegawai = $id")->row_array();
            $this->load->helper('dompdf');
          $html = $this->load->view('phpmu-tigo/download/download_pdf',$data,true);
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'LEMBAR-KERJA-'.strtoupper($nama).'-HARIAN-NON-ASN';
              $paper = 'A4';
              $orientation = 'potrait';
              pdf_create($html, $filename, $paper, $orientation);
    
        }elseif($set=='bulanan'){
                $now = date('Y-m-d');
          $start = date('Y-m-01');
          $d = date('j');
          $m = date('m');
          $y = date('Y');
    
          $data['bulan'] = bulan($m);
          $data['month'] = $m;
          $cek = $this->db->query("SELECT * FROM harikerja  WHERE tanggal <= '$d' AND bulan = '$m' AND tahun = '$y' AND status = 'kerja'");
          $bolos = 0;
          $telat = 0;
          $pulang =0;
          $kerja =0;
          $poin = 0;
          foreach ($cek->result_array() as $row) {
            $tgl = $row['tanggal'];
            $bln = $row['bulan'];
            $thn = $row['tahun'];
            $all = $thn.'-'.$bln.'-'.$tgl;
            $date = date('Y-m-d',strtotime($all));
          
            
            $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $id");
            $absen = $abs->row_array();
            if($abs->num_rows() > 0){
              $bolos += 0;
              $kerja +=1;
            }else{
              $bolos += 1;
              $kerja+=0;
            }
    
            if($absen['telat']=='y'){
              $telat +=1;
            }else{
              $telat +=0;
            }
            if($absen['pulang_awal']=='y'){
              $pulang +=1;
            }else{
              $pulang +=0;
            }
    
            $pp = $this->db->query("SELECT * FROM poin_pegawai WHERE id_pegawai = $id AND tanggal = '$date' "  )->row_array();
            $poin += $pp['poin'];
    
    
            
            
          }
          
    
          $data['alpha']=$bolos;
          $data['telat'] = $telat;
          $data['pulang'] = $pulang;
          $data['harikerja'] = $cek->num_rows();
          $data['kerja'] = $kerja;
    
          $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);
    
    
          if($persentase >= 100 AND $persentase <= 90 ){
            $data['status'] = "Sangat Baik";
          }elseif($persentase>= 89 AND $persentase<= 89){
            $data['status'] = "Baik";
          }elseif($persentase>= 70 AND $persentase<= 79){
            $data['status'] = "Cukup";
          }elseif($persentase>= 60 AND $persentase<= 69){
            $data['status'] = "Kurang";
          }elseif($persentase>= 0 AND $persentase<= 59){
            $data['status'] = "Sangat Kurang";
          }
          $per = ceil(($poin / (10 * $data['harikerja']) ) * 100); 
    
    
          $data['kinerja'] = $per;
          
          $data['persentase'] = $persentase;
          $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$m' AND MONTH(sampai) = $m  AND id_pegawai = '".$id."' AND status_form ='pegawai'");
          $selisih = 0;
          $selisih_i = 0;
          foreach($form->result_array() as $frm){
            $dari = date('Ymd',strtotime($frm['dari']));
            $sampai = date('Ymd',strtotime($frm['sampai']));
            if($frm['status']=='Sakit'){
            if($sampai == $dari){
              $sel = 1;
            }else{
              $sel = ($sampai - $dari)+1;
            }
            $selisih = $selisih + $sel;
            }else{
                if($sampai == $dari){
                  $sel = 1;
                }else{
                  $sel = ($sampai - $dari)+1;
                }
                $selisih_i = $selisih_i + $sel;
            }
          }
          $data['sakit'] = $selisih;
          $data['izin'] = $selisih_i;
    
          $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE MONTH(date)=$m AND id_pegawai = $id")->row_array();
    
          $data['jumlah_kerja'] = $rep['tot'];
          $data['lama_kerja'] = $rep['tot_jam'];
    
    
          $data['row'] = $this->db->query("SELECT * FROM pegawai a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_pegawai = $id")->row_array();
          
            $this->load->helper('dompdf');
          $html = $this->load->view('phpmu-tigo/download/download_pdf_m',$data,true);
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'LEMBAR-KERJA-'.strtoupper($nama).'-BULAN-'.strtoupper(bulan($m)).'-NON-ASN';
              $paper = 'A4';
              $orientation = 'potrait';
              pdf_create($html, $filename, $paper, $orientation);
    
        }elseif($set=='tahunan'){
            $now = date('Y-m-d');
          $start = date('Y-m-01');
          $d = date('j');
          $m = date('m');
          $y = date('Y');
    
          $data['bulan'] = bulan($m);
          $data['month'] = $m;
          $cek = $this->db->query("SELECT * FROM harikerja  WHERE  tahun = '$y' AND status = 'kerja'");
          $bolos = 0;
          $telat = 0;
          $pulang =0;
          $kerja =0;
          $tot_poin = 0;
          foreach ($cek->result_array() as $row) {
            $tgl = $row['tanggal'];
            $bln = $row['bulan'];
            $thn = $row['tahun'];
            $all = $thn.'-'.$bln.'-'.$tgl;
            $date = date('Y-m-d',strtotime($all));
          
            
            $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $id");
            $absen = $abs->row_array();
            if($abs->num_rows() > 0){
              $bolos += 0;
              $kerja +=1;
            }else{
              $bolos += 1;
              $kerja+=0;
            }
    
            if($absen['telat']=='y'){
              $telat +=1;
            }else{
              $telat +=0;
            }
            if($absen['pulang_awal']=='y'){
              $pulang +=1;
            }else{
              $pulang +=0;
            }
            
          }
          $data['alpha']=$bolos;
          $data['telat'] = $telat;
          $data['pulang'] = $pulang;
          $data['harikerja'] = $cek->num_rows();
          $data['kerja'] = $kerja;
    
          $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);
    
            $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);
    
    
          if($persentase >= 100 AND $persentase <= 90 ){
            $data['status'] = "Sangat Baik";
          }elseif($persentase>= 89 AND $persentase<= 89){
            $data['status'] = "Baik";
          }elseif($persentase>= 70 AND $persentase<= 79){
            $data['status'] = "Cukup";
          }elseif($persentase>= 60 AND $persentase<= 69){
            $data['status'] = "Kurang";
          }elseif($persentase>= 0 AND $persentase<= 59){
            $data['status'] = "Sangat Kurang";
          }
          $data['persentase'] = $persentase;
            $form = $this->db->query("SELECT * FROM form_izin WHERE YEAR(dari) = '$y' AND YEAR(sampai) = $y AND id_pegawai = '".$id."' AND status_form ='guru'  ");
          $selisih = 0;
          $selisih_i = 0;
          foreach($form->result_array() as $frm){
            $dari = date('Ymd',strtotime($frm['dari']));
            $sampai = date('Ymd',strtotime($frm['sampai']));
            if($frm['status']=='Sakit'){
            if($sampai == $dari){
              $sel = 1;
            }else{
              $sel = ($sampai - $dari)+1;
            }
            $selisih = $selisih + $sel;
            }else{
                if($sampai == $dari){
                  $sel = 1;
                }else{
                  $sel = ($sampai - $dari)+1;
                }
                $selisih_i = $selisih_i + $sel;
            }
          }
          $data['sakit'] = $selisih;
          $data['izin'] = $selisih_i;
    
          $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE YEAR(date)=$y AND id_pegawai = $id")->row_array();
    
          $data['jumlah_kerja'] = $rep['tot'];
          $data['lama_kerja'] = $rep['tot_jam'];
          
            $data['row'] = $this->db->query("SELECT * FROM pegawai a JOIN bagian b ON a.bagian = b.id_bagian JOIN sub_bagian c ON a.sub_bagian = c.id_sub_bagian WHERE id_pegawai = $id")->row_array();
          
           
          
           $this->load->helper('dompdf');
          $html = $this->load->view('phpmu-tigo/download/download_pdf_y',$data,true);
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'LEMBAR-KERJA-'.strtoupper($nama).'-TAHUN-'.$y.'-NON-ASN';
              $paper = 'A4';
              $orientation = 'potrait';
              pdf_create($html, $filename, $paper, $orientation);
    
        }else{
             $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  == 'sekolah'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
         
    
          
                $data['cabang'] = $cbg;
                $data['title'] = 'Lembar Kinerja - '.title();
                $data['page'] = 'Lembar Kinerja';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/lembarkinerja').'">Lembar Kinerja</a></li> ';
                $data['breadcumb3']= '';
            $data['record'] = $this->model_app->data_lembarkinerja($data['cabang']);
            //$data['record'] = $this->db->query("SELECT * FROM `pegawai` JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` ORDER BY `id_pegawai` DESC");
           $this->template->load('administrator/template','administrator/mod_down/view_lembarkinerja',$data);
    
        }
      }
      function lembarKinerjaGuru()
      {
        cek_session_akses('administrator/lembarKinerjaGuru',$this->session->id_session); 
        $set = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $nama = $this->uri->segment('5');
        if($set =='harian'){
            $data['row'] = $this->db->query("SELECT * FROM guru a JOIN subdomain b ON a.id_sd = b.id_sd  WHERE id_guru = $id")->row_array();
            $this->load->helper('dompdf');
          $html = $this->load->view('administrator/mod_sekolah/download_lk_harian',$data,true);
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'LEMBAR-KERJA-'.strtoupper($nama).'-HARIAN-'.date('Y/m/d');
              $paper = 'A4';
              $orientation = 'potrait';
              pdf_create($html, $filename, $paper, $orientation);
    
        }elseif($set=='bulanan'){
                $now = date('Y-m-d');
          $start = date('Y-m-01');
          $d = date('j');
          $m = date('m');
          $y = date('Y');
    
          $data['bulan'] = bulan($m);
          $data['month'] = $m;
          $cek = $this->db->query("SELECT * FROM working_days  WHERE tanggal <= '$d' AND bulan = '$m' AND tahun = '$y' AND status = 'kerja'");
          $bolos = 0;
          $telat = 0;
          $pulang =0;
          $kerja =0;
          $poin = 0;
          foreach ($cek->result_array() as $row) {
            $tgl = $row['tanggal'];
            $bln = $row['bulan'];
            $thn = $row['tahun'];
            $all = $thn.'-'.$bln.'-'.$tgl;
            $date = date('Y-m-d',strtotime($all));
          
            
            $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $id AND status_absen = 'guru' ");
            $absen = $abs->row_array();
            if($abs->num_rows() > 0){
              $bolos += 0;
              $kerja +=1;
            }else{
              $bolos += 1;
              $kerja+=0;
            }
    
            if($absen['telat']=='y'){
              $telat +=1;
            }else{
              $telat +=0;
            }
            if($absen['pulang_awal']=='y'){
              $pulang +=1;
            }else{
              $pulang +=0;
            }
    
            $pp = $this->db->query("SELECT * FROM poin_pegawai WHERE id_pegawai = $id AND tanggal = '$date'  AND status_poin = 'guru'"  )->row_array();
            $poin += $pp['poin'];
    
    
            
            
          }
          
    
          $data['alpha']=$bolos;
          $data['telat'] = $telat;
          $data['pulang'] = $pulang;
          $data['harikerja'] = $cek->num_rows();
          $data['kerja'] = $kerja;
    
          $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);
    
    
          if($persentase >= 100 AND $persentase <= 90 ){
            $data['status'] = "Sangat Baik";
          }elseif($persentase>= 89 AND $persentase<= 89){
            $data['status'] = "Baik";
          }elseif($persentase>= 70 AND $persentase<= 79){
            $data['status'] = "Cukup";
          }elseif($persentase>= 60 AND $persentase<= 69){
            $data['status'] = "Kurang";
          }elseif($persentase>= 0 AND $persentase<= 59){
            $data['status'] = "Sangat Kurang";
          }
          $per = ceil(($poin / (10 * $data['harikerja']) ) * 100); 
    
    
          $data['kinerja'] = $per;
          
          $data['persentase'] = $persentase;
          $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$m' AND MONTH(sampai) = $m AND id_pegawai = '".$id."' AND status_form ='guru' ");
          $selisih = 0;
          $selisih_i = 0;
          foreach($form->result_array() as $frm){
            $dari = date('Ymd',strtotime($frm['dari']));
            $sampai = date('Ymd',strtotime($frm['sampai']));
            if($frm['status']=='Sakit'){
            if($sampai == $dari){
              $sel = 1;
            }else{
              $sel = ($sampai - $dari)+1;
            }
            $selisih = $selisih + $sel;
            }else{
                if($sampai == $dari){
                  $sel = 1;
                }else{
                  $sel = ($sampai - $dari)+1;
                }
                $selisih_i = $selisih_i + $sel;
            }
          }
          $data['sakit'] = $selisih;
          $data['izin'] = $selisih_i;
    
          $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE MONTH(date)=$m AND id_pegawai = $id AND status_report ='guru'")->row_array();
    
          $data['jumlah_kerja'] = $rep['tot'];
          $data['lama_kerja'] = $rep['tot_jam'];
    
    
          $data['row'] = $this->db->query("SELECT * FROM guru a JOIN subdomain b ON a.id_sd = b.id_sd  WHERE id_guru = $id")->row_array();
          
            $this->load->helper('dompdf');
          $html = $this->load->view('administrator/mod_sekolah/download_lk_bulan',$data,true);
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'LEMBAR-KERJA-'.strtoupper($nama).'-BULAN-'.strtoupper(bulan($m));
              $paper = 'A4';
              $orientation = 'potrait';
              pdf_create($html, $filename, $paper, $orientation);
    
        }elseif($set=='tahunan'){
            $now = date('Y-m-d');
          $start = date('Y-m-01');
          $d = date('j');
          $m = date('m');
          $y = date('Y');
    
          $data['bulan'] = bulan($m);
          $data['month'] = $m;
          $cek = $this->db->query("SELECT * FROM working_days  WHERE  tahun = '$y' AND status = 'kerja'");
          $bolos = 0;
          $telat = 0;
          $pulang =0;
          $kerja =0;
          $tot_poin = 0;
          foreach ($cek->result_array() as $row) {
            $tgl = $row['tanggal'];
            $bln = $row['bulan'];
            $thn = $row['tahun'];
            $all = $thn.'-'.$bln.'-'.$tgl;
            $date = date('Y-m-d',strtotime($all));
          
            
            $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $id AND status_absen ='guru' ");
            $absen = $abs->row_array();
            if($abs->num_rows() > 0){
              $bolos += 0;
              $kerja +=1;
            }else{
              $bolos += 1;
              $kerja+=0;
            }
    
            if($absen['telat']=='y'){
              $telat +=1;
            }else{
              $telat +=0;
            }
            if($absen['pulang_awal']=='y'){
              $pulang +=1;
            }else{
              $pulang +=0;
            }
            
          }
          $data['alpha']=$bolos;
          $data['telat'] = $telat;
          $data['pulang'] = $pulang;
          $data['harikerja'] = $cek->num_rows();
          $data['kerja'] = $kerja;
    
          $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);
    
            $persentase = ceil(($data['kerja'] / $data['harikerja']) * 100);
    
    
          if($persentase >= 100 AND $persentase <= 90 ){
            $data['status'] = "Sangat Baik";
          }elseif($persentase>= 89 AND $persentase<= 89){
            $data['status'] = "Baik";
          }elseif($persentase>= 70 AND $persentase<= 79){
            $data['status'] = "Cukup";
          }elseif($persentase>= 60 AND $persentase<= 69){
            $data['status'] = "Kurang";
          }elseif($persentase>= 0 AND $persentase<= 59){
            $data['status'] = "Sangat Kurang";
          }
          $data['persentase'] = $persentase;
            $form = $this->db->query("SELECT * FROM form_izin WHERE YEAR(dari) = '$y' AND YEAR(sampai) = $y AND id_pegawai = '".$id."' AND status_form ='guru' ");
          $selisih = 0;
          $selisih_i = 0;
          foreach($form->result_array() as $frm){
            $dari = date('Ymd',strtotime($frm['dari']));
            $sampai = date('Ymd',strtotime($frm['sampai']));
            if($frm['status']=='Sakit'){
            if($sampai == $dari){
              $sel = 1;
            }else{
              $sel = ($sampai - $dari)+1;
            }
            $selisih = $selisih + $sel;
            }else{
                if($sampai == $dari){
                  $sel = 1;
                }else{
                  $sel = ($sampai - $dari)+1;
                }
                $selisih_i = $selisih_i + $sel;
            }
          }
          $data['sakit'] = $selisih;
          $data['izin'] = $selisih_i;
    
          $rep = $this->db->query("SELECT *,COUNT(id_report) as tot, COUNT(jam_kerja) as tot_jam FROM report WHERE YEAR(date)=$y AND id_pegawai = $id AND status_report = 'guru'")->row_array();
    
          $data['jumlah_kerja'] = $rep['tot'];
          $data['lama_kerja'] = $rep['tot_jam'];
          
          $data['row'] = $this->db->query("SELECT * FROM guru a JOIN subdomain b ON a.id_sd = b.id_sd  WHERE id_guru = $id")->row_array();
          
           
          
           $this->load->helper('dompdf');
           $html = $this->load->view('administrator/mod_sekolah/download_lk_tahun',$data,true);
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'LEMBAR-KERJA-'.strtoupper($nama).'-TAHUN-'.$y;
              $paper = 'A4';
              $orientation = 'potrait';
              pdf_create($html, $filename, $paper, $orientation);
    
        }else{
             $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  == 'dinas'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
         
                if(isset($_POST['filter'])){
                  $cabang1 = $this->input->post('sekolah');
                  if($cabang1 == 'all'){
                    $sekolah = 'all';
                  }else{
                    $sekolah = decode($cabang1);
                  }
                  
                }else{
                  $cabang1 = $cbg;
                  $sekolah = $cabang1;
                }
          
                $data['cabang'] = $sekolah;
                $data['status'] = $cabang['status'];
                $data['title'] = 'Lembar Kinerja - '.title();
                $data['page'] = 'Lembar Kinerja';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/lembarkinerja').'">Lembar Kinerja</a></li> ';
                $data['breadcumb3']= '';
            $data['record'] = $this->model_app->data_lembarkinerjaGuru($data['cabang']);
            //$data['record'] = $this->db->query("SELECT * FROM `pegawai` JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` ORDER BY `id_pegawai` DESC");
           $this->template->load('administrator/template','administrator/mod_sekolah/view_lembarkinerja',$data);
    
        }
      }
      function kehadiran(){
         cek_session_akses('administrator/kehadiran',$this->session->id_session); 
        if(isset($_POST['filter'])){
           
            $data['bulan'] =$this->input->post('bulan');
            $data['tahun'] =$this->input->post('tahun');
        }else{
           $data['bulan'] = date('m');
           $data['tahun'] = date('Y');
    
        }
        $data['title'] = 'Kehadiran - '.title();
        $data['page'] = 'Data Kehadiran';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/kehadiran').'">Kehadiran</a></li> ';
        $data['breadcumb3']= '';
          $data['year'] = $this->db->query("SELECT tahun FROM  harikerja GROUP BY tahun ");  
          $data['month'] = $this->db->query("SELECT bulan FROM  harikerja GROUP BY bulan ");
    
          $data['hari'] = $this->db->query("SELECT * FROM harikerja WHERE bulan = $data[bulan] AND tahun = $data[tahun] AND status = 'kerja'");
          $data['record'] = $this->db->query("SELECT * FROM `pegawai` JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` ORDER BY `id_pegawai` DESC");
          $this->template->load('administrator/template','administrator/mod_down/view_kehadiran',$data);
    
      }
      function persentaseKehadiran(){
        cek_session_akses('administrator/persentaseKehadiran',$this->session->id_session); 
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        if($cabang['status']  == 'dinas'){
            $cbg = 'all';
        }else {
            $cbg = $cabang['id_sd'];
        }
     
            if(isset($_POST['filter'])){
              $cabang1 = $this->input->post('sekolah');
              if($cabang1 == 'all'){
                $sekolah = 'all';
              }else{
                $sekolah = decode($cabang1);
              }
              $data['bulan'] =$this->input->post('bulan');
              $data['tahun'] =$this->input->post('tahun');
              
            }else{
              $cabang1 = $cbg;
              $sekolah = $cabang1;
              $data['bulan'] = date('m');
              $data['tahun'] = date('Y');
            }
      
            $data['cabang'] = $sekolah;
            $data['status'] = $cabang['status'];
      
       $data['title'] = 'Kehadiran - '.title();
       $data['page'] = 'Data Kehadiran';
       $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
       $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/persentaseKehadiran').'">Kehadiran</a></li> ';
       $data['breadcumb3']= '';
         $data['year'] = $this->db->query("SELECT tahun FROM  working_days GROUP BY tahun ");  
         $data['month'] = $this->db->query("SELECT bulan FROM  working_days GROUP BY bulan ");
   
         $data['hari'] = $this->db->query("SELECT * FROM working_days WHERE bulan = $data[bulan] AND tahun = $data[tahun] AND status = 'kerja'");
         $data['record'] = $this->model_app->view_guru_cabang($data['cabang']);
        //  $data['record'] = $this->db->query("SELECT * FROM `guru` a JOIN subdomain b ON a.id_sd = b.id_sd  ORDER BY `id_guru` DESC");
         $this->template->load('administrator/template','administrator/mod_sekolah/view_kehadiran',$data);
   
     }
   
      function downloadpdf()
      {
        $month = $this->uri->segment('3');
        $year = $this->uri->segment('4');
    
        $data['bulan'] = $month;
        $data['tahun'] = $year;
        $data['hari'] = $this->db->query("SELECT * FROM harikerja WHERE bulan = $data[bulan] AND tahun = $data[tahun] AND status = 'kerja'");
        $data['record'] = $this->db->query("SELECT * FROM `pegawai` JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` ORDER BY `id_pegawai` DESC");
    
    
           $this->load->helper('dompdf');
          $html =       $this->load->view('administrator/mod_down/pdf_kehadiran.php',$data,true);
    
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'PERSENTASE-KEHADIRAN-BULAN-'.bulan($month).'-TAHUN-'.$year;
              $paper = 'A4';
              $orientation = 'landscape';
              pdf_create($html, $filename, $paper, $orientation);
    
    
      }
      function pdf_persentaseKehadiran()
      {
        $month = $this->uri->segment('3');
        $year = $this->uri->segment('4');
        $cabang = $this->uri->segment('5');

    
        $data['bulan'] = $month;
        $data['tahun'] = $year;
        $data['hari'] = $this->db->query("SELECT * FROM working_days WHERE bulan = $data[bulan] AND tahun = $data[tahun] AND status = 'kerja'");
        $data['record'] = $this->model_app->view_guru_cabang($cabang);
        $cbg = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $data['sekolah'] = $cbg['nama_cabang'];
    
    
           $this->load->helper('dompdf');
          $html =       $this->load->view('administrator/mod_sekolah/pdf_kehadiran.php',$data,true);
    
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'PERSENTASE-KEHADIRAN-BULAN-'.bulan($month).'-TAHUN-'.$year;
              $paper = 'A4';
              $orientation = 'landscape';
              pdf_create($html, $filename, $paper, $orientation);
    
    
      }
      function downloadexcel()
      {
        $month = $this->uri->segment('3');
        $year = $this->uri->segment('4');
        echo "404 Maintenance";
      }
      function ampragaji()
      {
         cek_session_akses('administrator/ampragaji',$this->session->id_session); 
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  == 'sekolah'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
         
           if(isset($_POST['filter'])){
           
            $data['bulan'] =$this->input->post('bulan');
            $data['tahun'] =$this->input->post('tahun');
            $data['bagian'] = $this->input->post('bagian');
           
          
            
        }else{
           $data['bulan'] = date('m');
           $data['tahun'] = date('Y');
           $data['bagian'] = 'all';
          
           $where = " ";
    
        }
          
          $data['cabang'] = $cbg;
    
             
        if($data['bulan'] == date('m')){
            $data['hari'] = date('j');
        }else{
            $d = $data['tahun'].'-'.$data['bulan'].'-01';
           
    
             $data['hari'] = date('t',strtotime($d));
        }
        $data['title'] = 'Ampra Gaji - '.title();
        $data['page'] = 'Data Ampra Gaji';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/ampragaji').'">Ampra Gaji</a></li> ';
        $data['breadcumb3']= '';
           $data['year'] = $this->db->query("SELECT tahun FROM  harikerja GROUP BY tahun ");  
          $data['month'] = $this->db->query("SELECT bulan FROM  harikerja GROUP BY bulan ");
        $data['bag'] = $this->model_app->view_ordering('sub_kegiatan','id_sub_kegiatan','DESC');
        $data['record'] = $this->model_app->dataGaji($data['bagian'],$data['cabang']);
        
        // $data['record'] = $this->db->query("SELECT * FROM `pegawai`  JOIN `bagian` ON `pegawai`.`bagian`=`bagian`.`id_bagian` JOIN `sub_bagian`ON `sub_bagian`.`id_sub_bagian` = `pegawai`.`sub_bagian` $where ORDER BY `id_pegawai` DESC");
           $this->template->load('administrator/template','administrator/mod_down/view_gaji',$data);
    
      }
      function print_gaji()
      {
        $hari = $this->uri->segment('3');
        $bulan = $this->uri->segment('4');
        $tahun = $this->uri->segment('5');
        $bagian = $this->uri->segment('6');
          $cbg = $this->uri->segment('7');
    
        $sub  = $this->model_app->view_where('sub_kegiatan',array('id_sub_kegiatan'=>$bagian))->row_array();
       
        $data['hari']=$hari;
        $data['bulan']=$bulan;
        $data['tahun']=$tahun;
        $data['bagian']=$bagian;
        $data['nama_kegiatan'] = $sub['nama_kegiatan'];
        $data['sub'] = $sub;
       if($data['bagian'] != 'all' OR $data['bagian'] == NULL){
              $where = "AND sub_kegiatan =".$data['bagian'];
            }else{
               $where = " ";
            }
        
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  != 'kelurahan'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
            $data['cabang'] = $cbg;
            $data['status'] = $cabang['status'];
            $data['kelurahan'] = $cabang['kelurahan'];
            $data['kabupaten'] = $cabang['kabupaten'];
            $data['kecamatan'] = $cabang['kecamatan'];
              $data['record'] = $this->model_app->dataGaji($data['bagian'],$data['cabang'],$data['status'],$data['kabupaten'],$data['kecamatan'],$data['kelurahan']);
          $this->load->view('administrator/mod_down/print_gaji.php',$data);
    
        //     $this->load->helper('dompdf');
        //   $html =             $this->load->view('administrator/mod_down/pdf_gaji.php',$data,true);
    
        
     
        // //load content html
            
           
        //       // create pdf using dompdf
        //       $filename = 'AMPRA-GAJI-BULAN-'.strtoupper(bulan($bulan)).'-TAHUN-'.$tahun;
        //       $paper = 'a4';
        //       $orientation = 'potrait';
        //     pdf_create($html, $filename, $paper, $orientation);
      }
      function pdf_gaji()
      {
        $hari = $this->uri->segment('3');
        $bulan = $this->uri->segment('4');
        $tahun = $this->uri->segment('5');
        $bagian = $this->uri->segment('6');
        $cbg = $this->uri->segment('7');
    
        $sub  = $this->model_app->view_where('sub_kegiatan',array('id_sub_kegiatan'=>$bagian))->row_array();
       
        $data['hari']=$hari;
        $data['bulan']=$bulan;
        $data['tahun']=$tahun;
        $data['bagian']=$bagian;
        $data['nama_kegiatan'] = $sub['nama_kegiatan'];
        $data['sub'] = $sub;
        if($data['bagian'] != 'all' OR $data['bagian'] == NULL){
              $where = "AND sub_kegiatan =".$data['bagian'];
            }else{
               $where = " ";
            }
         $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  != 'kelurahan'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
              $data['cabang'] = $cbg;
            $data['status'] = $cabang['status'];
            $data['kelurahan'] = $cabang['kelurahan'];
            $data['kabupaten'] = $cabang['kabupaten'];
            $data['kecamatan'] = $cabang['kecamatan'];
       $data['record'] = $this->model_app->dataGaji($data['bagian'],$data['cabang'],$data['status'],$data['kabupaten'],$data['kecamatan'],$data['kelurahan']);
      // $this->load->view('administrator/mod_down/pdf_gaji.php',$data);
    
            $this->load->helper('dompdf');
          $html =             $this->load->view('administrator/mod_down/pdf_gaji.php',$data,true);
    
        
     
        //load content html
            
           
              // create pdf using dompdf
              $filename = 'AMPRA-GAJI-BULAN-'.strtoupper(bulan($bulan)).'-TAHUN-'.$tahun;
              $paper = 'a4';
              $orientation = 'potrait';
            pdf_create($html, $filename, $paper, $orientation);
      }
    function excel_gaji()
      {
        $hari1 = $this->uri->segment('3');
        $bulan = $this->uri->segment('4');
        $tahun = $this->uri->segment('5');
        $bagian = $this->uri->segment('6');
         $cbg = $this->uri->segment('7');
    
        $sub  = $this->model_app->view_where('sub_kegiatan',array('id_sub_kegiatan'=>$bagian))->row_array();
       
       
         if($bulan == date('m')){
            $data['hari'] = date('j');
            $hari = date('j');
    
        }else{
            $d = $tahun.'-'.$bulan.'-01';
           
            $hari = date('t',strtotime($d));
             $data['hari'] = date('t',strtotime($d));
        }
         $data['cabang'] = $cbg;
        $data['bulan']=$bulan;
        $data['tahun']=$tahun;
        $data['bagian']=$bagian;
        $nama_kegiatan = $sub['nama_kegiatan'];
        $data['sub'] = $sub;
        if($data['bagian'] != 'all' OR $data['bagian'] == NULL){
              $where = "AND sub_kegiatan =".$data['bagian'];
            }else{
               $where = " ";
            }
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  != 'kelurahan'){
                $cbg = 'all';
            }else {
                $cbg = $cabang['id_sd'];
            }
            $data['status'] = $cabang['status'];
            $data['kelurahan'] = $cabang['kelurahan'];
            $data['kabupaten'] = $cabang['kabupaten'];
            $data['kecamatan'] = $cabang['kecamatan'];
       $record = $this->model_app->dataGaji($data['bagian'],$data['cabang'],$data['status'],$data['kabupaten'],$data['kecamatan'],$data['kelurahan']);
      // $this->load->view('administrator/mod_down/pdf_gaji.php',$data);
    
           include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
                     ->setLastModifiedBy('My Notes Code')
                     ->setTitle("Data Siswa")
                     ->setSubject("Siswa")
                     ->setDescription("Laporan Semua Data Siswa")
                     ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF'),),
          'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '92D050')
            ), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DAFTAR HONORARIUM PEGAWAI HONORER/TIDAK TETAP"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:T1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    
        $excel->setActiveSheetIndex(0)->setCellValue('A2', "BIRO UMUM SEKRETARIAT DAERAH PROVINSI SULAWESI BARAT"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A2:T2'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
         $excel->setActiveSheetIndex(0)->setCellValue('A3', "PADA KEGIATAN ".strtoupper($nama_kegiatan)); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A3:T3'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A5', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->getActiveSheet()->mergeCells('A5:A6');
        $excel->setActiveSheetIndex(0)->setCellValue('B5', "NAMA"); // Set kolom B3 dengan tulisan "NIS"
        $excel->getActiveSheet()->mergeCells('B5:B6');
        $excel->setActiveSheetIndex(0)->setCellValue('C5', "JUMLAH"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->getActiveSheet()->mergeCells('C5:C6');
        $excel->setActiveSheetIndex(0)->setCellValue('D5', "BULAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->getActiveSheet()->mergeCells('D5:D6');
        $excel->setActiveSheetIndex(0)->setCellValue('E5', "TELAT DATANG"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->getActiveSheet()->mergeCells('E5:G5');
        $excel->setActiveSheetIndex(0)->setCellValue('E6', "Jml");
        $excel->setActiveSheetIndex(0)->setCellValue('F6', "0,5%");
        $excel->setActiveSheetIndex(0)->setCellValue('G6', "Potongan (Rp)");
    
        $excel->setActiveSheetIndex(0)->setCellValue('H5', "CEPAT PULANG"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->getActiveSheet()->mergeCells('H5:J5');
        $excel->setActiveSheetIndex(0)->setCellValue('H6', "Jml");
        $excel->setActiveSheetIndex(0)->setCellValue('I6', "0,5%");
        $excel->setActiveSheetIndex(0)->setCellValue('J6', "Potongan (Rp)");
    
        $excel->setActiveSheetIndex(0)->setCellValue('K5', "IZIN / SAKIT"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->getActiveSheet()->mergeCells('K5:M5');
        $excel->setActiveSheetIndex(0)->setCellValue('K6', "Jml");
        $excel->setActiveSheetIndex(0)->setCellValue('L6', "0,5%");
        $excel->setActiveSheetIndex(0)->setCellValue('M6', "Potongan (Rp)");
    
    
        $excel->setActiveSheetIndex(0)->setCellValue('N5', "ALPHA"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->getActiveSheet()->mergeCells('N5:P5');
        $excel->setActiveSheetIndex(0)->setCellValue('N6', "Jml");
        $excel->setActiveSheetIndex(0)->setCellValue('O6', "0,5%");
        $excel->setActiveSheetIndex(0)->setCellValue('P6', "Potongan (Rp)");
    
        $excel->setActiveSheetIndex(0)->setCellValue('Q5', "PERSENTASE POTONGAN");
        $excel->setActiveSheetIndex(0)->setCellValue('Q6', "( % )");
    
        $excel->setActiveSheetIndex(0)->setCellValue('R5', "JUMLAH POTONGAN");
        $excel->setActiveSheetIndex(0)->setCellValue('R6', "( Rp )");
    
        $excel->setActiveSheetIndex(0)->setCellValue('S5', "TOTAL DIBAYARKAN");
        $excel->setActiveSheetIndex(0)->setCellValue('S6', "( Rp )");
    
        $excel->setActiveSheetIndex(0)->setCellValue('T5', "TANDA TANGAN");
         $excel->getActiveSheet()->mergeCells('T5:T6');
    
    
    
    
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A5:A6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B5:B6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C5:C6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D5:D6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E5:G6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5:J5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K5:M5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N5:P5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T5:T6')->applyFromArray($style_col);
    
        $excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S6')->applyFromArray($style_col);
    
    
    
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
        $telat = 0;
        $pulang = 0;
        $izin = 0;
                                              
        $total_gaji = 0;
        $total_dibayar = 0;
    
        foreach($record->result_array() as $row){ // Lakukan looping pada variabel siswa
           $total_gaji += $row['gaji_pokok'];
    
                                                $telat = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun,'telat'=>'y'))->num_rows();
                                             
    
                                                $pulang = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_pegawai'],'MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun,'pulang_awal'=>'y'))->num_rows();
                                                 
                                                 $form = $this->db->query("SELECT * FROM form_izin WHERE MONTH(dari) = '$bulan' AND MONTH(sampai) = $bulan AND YEAR(dari) = '$tahun' AND YEAR(sampai) = $tahun AND id_pegawai = $row[id_pegawai] AND approved ='setuju' ");
                                                 $ket = 0;
                                                 if($form->num_rows() > 0){
                                                     foreach($form->result_array() as $f){
                                                        $dari = date('Ymd',strtotime($f['dari']));
                                                        $sampai = date('Ymd',strtotime($f['sampai']));
                                                        if($dari == $sampai){
                                                            $ket += 1;
                                                        }else{
                                                            $ket += ($sampai - $dari)+1;
                                                        }
                                                     }
                                                }
    
                                                $pot_cp = ($row['gaji_pokok']*($pulang*0.5))/100;
                                                $pot_td = ($row['gaji_pokok']*($telat*0.5))/100;
                                                $pot_is = ($row['gaji_pokok']*($ket*1.5))/100;
                                                $bolos = 0;
                                                $cek = $this->db->query("SELECT * FROM harikerja  WHERE tanggal <= '$hari' AND bulan = '$bulan' AND tahun = '$tahun' AND status = 'kerja'");
                                                foreach($cek->result_array() as $c)
                                                {
                                                    $tgl = $c['tanggal'];
                                                    $bln = $c['bulan'];
                                                    $thn = $c['tahun'];
                                                    $all = $thn.'-'.$bln.'-'.$tgl;
                                                    $date = date('Y-m-d',strtotime($all));
                                                
                                                    
                                                    $abs = $this->db->query("SELECT * FROM absensi WHERE tanggal = '$date' AND id_pegawai = $row[id_pegawai]");
                                                    
                                                    if($abs->num_rows() > 0){
                                                        $bolos += 0;
                                                     
                                                    }else{
                                                        $bolos += 1;
                                                      
                                                    }
                                                }
    
                                                $pot_bol = ($row['gaji_pokok']*($bolos*4.5))/100;
                                                $pot_all = $pot_td + $pot_cp + $pot_is + $pot_bol;
                                                $dibayar = $row['gaji_pokok'] - $pot_all;
                                                 $total_dibayar += $dibayar;
    
                                                 $perTel = $telat*0.5.'%';
                                                 $perPul = $pulang*0.5.'%';
                                                 $perKet = $ket*1.5.'%';
                                                 $perBol = $bolos*4.5.'%';
                                                 $perPot = ($telat*0.5)+($pulang*0.5)+($ket*1.5)+($bolos*4.5).'%';
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row['nama_lengkap']);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, rupiah($row['gaji_pokok']));
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, bulan($bulan));
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $telat);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $perTel);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, rupiah($pot_td));
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $pulang);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $perPul);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, rupiah($pot_cp));
          $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $ket);
          $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $perKet);
          $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, rupiah($pot_is));
          $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $bolos);
          $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $perBol);
          $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, rupiah($pot_bol));
          $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $perPot);
          $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, rupiah($pot_all));
          $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, rupiah($dibayar));
          $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $no.'...........');
    
          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
    
          
          $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    
        $numm = $numrow+1;
        $num0 = $numrow+3;
        $num1 = $numrow+4;
        $num2 = $numrow+5;
        $num3 = $numrow+10;
        $num4 = $numrow+11;
        $num5 = $numrow+12;
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$numm, 'Total Dibayarkan: ');
        $excel->setActiveSheetIndex(0)->setCellValue('C'.$numm, rupiah($total_gaji));
    
        $excel->setActiveSheetIndex(0)->setCellValue('S'.$numm, rupiah($total_dibayar));
        $excel->getActiveSheet()->mergeCells('A'.$numm.':B'.$numm);
        $excel->getActiveSheet()->mergeCells('D'.$numm.':R'.$numm);
        $excel->getActiveSheet()->getStyle('A'.$numm.':B'.$numm)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C'.$numm)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D'.$numm.':R'.$numm)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('S'.$numm)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('T'.$numm)->applyFromArray($style_row);
    
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$num1, 'Mengetahui'); // Set kolom A1 dengan tulisan "DATA SISWA"
        
        $excel->getActiveSheet()->mergeCells('A'.$num1.':C'.$num1); // Set Merge Cell pada kolom A1 sampai E1
        
        $excel->getActiveSheet()->getStyle('A'.$num1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    
    
          $excel->setActiveSheetIndex(0)->setCellValue('R'.$num0, "Mamuju, ". bulan($bulan)." ".$tahun); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('R'.$num0.':T'.$num0); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('R'.$num0)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$num2, "KEPALA BIRO UMUM SETDA PROV.SULBAR"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A'.$num2.':C'.$num2); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A'.$num2)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A'.$num2)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A'.$num2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Set width kolom
    
          $pptk = $this->model_app->view_where('pptk',array('id_pptk'=>$sub['id_pptk']))->row_array();
          $kb = $this->model_app->view_where('kepala_biro',array('id_kb'=>$sub['id_kb']))->row_array();
          $sub_bag = $this->model_app->view_where('sub_bagian',array('id_sub_bagian'=>$sub['id_sub_bagian']))->row_array();
    
    
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$num3, $kb['nama']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A'.$num3.':C'.$num3); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A'.$num3)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A'.$num3)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A'.$num3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$num4, "Pangkat : ".$kb['pangkat']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A'.$num4.':C'.$num4); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('A'.$num4)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$num5, "NIP : ".$kb['nip']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A'.$num5.':C'.$num5); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('A'.$num5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    
    
        
    
        $excel->setActiveSheetIndex(0)->setCellValue('J'.$num2, "PEJABAT PELAKSANA TEKHNIS KEGIATAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('J'.$num2.':N'.$num2); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('J'.$num2)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('J'.$num2)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('J'.$num2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Set width kolom
    
        
    
    
        $excel->setActiveSheetIndex(0)->setCellValue('J'.$num3, $pptk['nama']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('J'.$num3.':N'.$num3); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('J'.$num3)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('J'.$num3)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('J'.$num3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('J'.$num4, "Pangkat : ".$pptk['pangkat']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('J'.$num4.':N'.$num4); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('J'.$num4)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('J'.$num5, "NIP : ".$pptk['nip']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('J'.$num5.':N'.$num5); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('J'.$num5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    
    
         $excel->setActiveSheetIndex(0)->setCellValue('R'.$num2, "KASUBANG ".strtoupper($sub_bag['nama_sub_bagian'])); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('R'.$num2.':T'.$num2); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('R'.$num2)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('R'.$num2)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('R'.$num2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    
         $excel->setActiveSheetIndex(0)->setCellValue('R'.$num3, $sub_bag['kepala_sub_bagian']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('R'.$num3.':T'.$num3); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('R'.$num3)->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('R'.$num3)->getFont()->setSize(12); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('R'.$num3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('R'.$num4, "Pangkat : ".$sub_bag['pangkat']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('R'.$num4.':T'.$num4); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('R'.$num4)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
        $excel->setActiveSheetIndex(0)->setCellValue('R'.$num5, "NIP : ".$sub_bag['nip']); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('R'.$num5.':T'.$num5); // Set Merge Cell pada kolom A1 sampai E1
       
        $excel->getActiveSheet()->getStyle('R'.$num5)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(40); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
    
    
    
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle(bulan($bulan));
        $excel->setActiveSheetIndex(0);
        // Proses file excel
    
        $name =  'AMPRA-GAJI-BULAN-'.strtoupper(bulan($bulan)).'-TAHUN-'.$tahun;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$name.'".xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
      }
    //KINERJA//
  //SISWA//

  function siswa()
  {
    
      if($this->uri->segment('3')=='edit'){
         cek_session_akses('administrator/editSiswa',$this->session->id_session);
        
              $id = $this->encrypt->decode($this->input->get('id'),keys());
              $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$id));
              if($cek->num_rows() > 0 ){
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                if($cabang['status']  == 'dinas'){
                    $cbg = 'all';
                }else {
                    $cbg = $cabang['id_sd'];
                }
                $data['status'] = $cabang['status'];
                $data['kelurahan'] = $cabang['kelurahan'];
                $data['kabupaten'] = $cabang['kabupaten'];
                $data['kecamatan'] = $cabang['kecamatan'];
                $data['cabang']= $cbg;
                $data['jenis'] = $cabang['jenis_sekolah'];
            $data['row'] = $cek->row_array();
            $data['title'] = 'Siswa - '.title();
            $data['page'] = 'Edit Siswa';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/siswa').'">Siswa</a></li>';
            $data['breadcumb2']= '  <li class="breadcrumb-item active " >Edit</li>';
            $data['breadcumb3']= '';
             
             $data['bag'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
            $this->template->load('administrator/template','administrator/mod_siswa/view_siswa_edit',$data);
          }else{
            $this->session->set_flashdata('message','Siswa Tidak Ditemukan');
            redirect('administrator/siswa');
          }
             
          

      }elseif($this->uri->segment('3')=='add'){
         cek_session_akses('administrator/addSiswa',$this->session->id_session);

         
          
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                  if($cabang['status']  != 'sekolah'){
                      $cbg = 'all';
                    
                  }else {
                      
                      $cbg = $cabang['id_sd'];
                  }
                  $data['jenis'] = $cabang['jenis_sekolah'];
                  $data['status'] = $cabang['status'];
                  $data['kelurahan'] = $cabang['kelurahan'];
                  $data['kabupaten'] = $cabang['kabupaten'];
                  $data['kecamatan'] = $cabang['kecamatan'];
                  $data['title'] = 'Siswa - '.title();
                $data['page'] = 'Tambah Siswa';
                $data['cabang'] = $cbg;
                $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/siswa').'">Siswa</a></li>';
                $data['breadcumb2']= '  <li class="breadcrumb-item active " >Tambah</li>';
                $data['breadcumb3']= '';
             
               $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
               $this->template->load('administrator/template','administrator/mod_siswa/view_siswa_tambah',$data);
          

      }else{
        cek_session_akses('administrator/siswa',$this->session->id_session);
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
      if($cabang['status']  != 'sekolah'){
          $cbg = 'all';
      }else {
          $cbg = $cabang['id_sd'];
      }
      $data['status'] = $cabang['status'];
      $data['kelurahan'] = $cabang['kelurahan'];
      $data['kabupaten'] = $cabang['kabupaten'];
      $data['kecamatan'] = $cabang['kecamatan'];

      if(isset($_POST['filter'])){
       
      
        $data['cabang'] = $this->input->post('cabang');
      }else{
       
      
       
        $data['cabang'] = $cbg;
      }
      $data['title'] = 'Siswa - '.title();
      $data['page'] = 'Daftar Siswa';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Siswa</li>';
      $data['breadcumb2']= ' ';
      $data['breadcumb3']= '';
       
      $data['record'] = $this->model_app->filterSiswa($data['cabang']);
      $this->template->load('administrator/template','administrator/mod_siswa/view_siswa',$data);
      }
  } 
  function hapusSiswa(){
    cek_session_akses('administrator/hapusSiswa',$this->session->id_session);

   
    $id = $this->encrypt->decode($this->input->get('id'),keys());
    $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$id));
    if($cek->num_rows() > 0){
      $this->model_app->delete('siswa',array('id_siswa'=>$id));
     $row = $cek->row_array();
     $this->session->set_flashdata('success','Siswa Berhasil Dihapus');
      redirect('administrator/siswa');
    }else{
      $this->session->set_flashdata('message','Tidak Ditemukan!');
      redirect('administrator/siswa');
    }
  }
  function editSiswa(){
    cek_session_akses('administrator/editSiswa',$this->session->id_session);

   
     $id = decode($this->input->post('id'));
     $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$id));
     if($cek->num_rows() > 0){
      $row = $cek->row_array();
    
     
     

       $config['upload_path']          = './asset/upload_sklh/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 10000;
      $config['encrypt_name'] = TRUE;
      
      
    
      
     

      $this->load->library('upload', $config);

    
      if ( ! $this->upload->do_upload('foto')){
     
       $foto = $row['foto'];
      }else{
          $f = $this->upload->data();
       $foto = base_url('asset/upload_sklh/').$f['file_name'];
      }
     
      $tanggal_lahir = date('Y-m-d',strtotime($this->input->post('tanggal_lahir')));
      if(trim($this->input->post('password'))){
        $data = array('nisn'=>$this->input->post('nisn'),
        'nipd'=>$this->input->post('nipd'),
        'no_telp'=>$this->input->post('no_telp'),
      
        'nama_lengkap'=>$this->input->post('nama_lengkap'),
        'kelas'=>$this->input->post('kelas'),
        'tempat_lahir'=>$this->input->post('tempat_lahir'),
        'tanggal_lahir' =>$tanggal_lahir,
        'agama'=>$this->input->post('agama'),
        'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
        'alamat'=>$this->input->post('alamat'),
        'no_hp'=>$this->input->post('no_hp'),
        'email'=>$this->input->post('email'),
        'provinsi'=>76,
        'kabupaten'=>7604,
        'kecamatan'=>$this->input->post('kecamatan'),
        'kelurahan'=>$this->input->post('kelurahan'),
        'rt'=>$this->input->post('rt'),
        'rw'=>$this->input->post('rw'),
        'dusun'=>$this->input->post('dusun'),
        'kode_pos'=>$this->input->post('kode_pos'),
        'alat_transportasi'=>$this->input->post('alat_transportasi'),
        'jenis_tinggal'=>$this->input->post('jenis_tinggal'),
        'password'=>encode($this->input->post('password')),
        'vaksin'=>$this->input->post('vaksin'),
        'vaksin_ke'=>$this->input->post('vaksin_ke'),
        'nama_vaksin'=>$this->input->post('nama_vaksin'),
        'foto'=>$foto,
        'id_sd'=>$this->input->post('id_sd'),
  
  
       
       
        );
      }else{
        $data = array('nisn'=>$this->input->post('nisn'),
        'nipd'=>$this->input->post('nipd'),
        'no_telp'=>$this->input->post('no_telp'),
      
        'nama_lengkap'=>$this->input->post('nama_lengkap'),
        'kelas'=>$this->input->post('kelas'),
        'tempat_lahir'=>$this->input->post('tempat_lahir'),
        'tanggal_lahir' =>$tanggal_lahir,
        'agama'=>$this->input->post('agama'),
        'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
        'alamat'=>$this->input->post('alamat'),
        'no_hp'=>$this->input->post('no_hp'),
        'email'=>$this->input->post('email'),
        'provinsi'=>76,
        'kabupaten'=>7604,
        'kecamatan'=>$this->input->post('kecamatan'),
        'kelurahan'=>$this->input->post('kelurahan'),
        'rt'=>$this->input->post('rt'),
        'rw'=>$this->input->post('rw'),
        'dusun'=>$this->input->post('dusun'),
        'kode_pos'=>$this->input->post('kode_pos'),
        'alat_transportasi'=>$this->input->post('alat_transportasi'),
        'jenis_tinggal'=>$this->input->post('jenis_tinggal'),
        'vaksin'=>$this->input->post('vaksin'),
                    'vaksin_ke'=>$this->input->post('vaksin_ke'),
                    'nama_vaksin'=>$this->input->post('nama_vaksin'),
       
       
        'foto'=>$foto,
        'id_sd'=>$this->input->post('id_sd'),
  
  
       
       
  );
      }
     
        $this->model_app->update('siswa',$data,array('id_siswa'=>$id));
        $msg =  'Siswa Berhasil Diubah';
        $status = true;
       }else{
        $msg  = 'Siswa Tidak Ditemukan';
        $status = false;
       }
       echo json_encode(array('status'=>$status,'msg'=>$msg));
      
  }
  function addSiswa(){
    cek_session_akses('administrator/addSiswa',$this->session->id_session);

   
      $this->form_validation->set_rules('nisn','NISN','required|is_unique[siswa.nisn]');
      $this->form_validation->set_rules('nipd','NIPD','required|is_unique[siswa.nipd]');

     
     

       $config['upload_path']          = './asset/upload_sklh/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 10000;
      $config['encrypt_name'] = TRUE;
      
      
    
      
     

      $this->load->library('upload', $config);

    
      if ( ! $this->upload->do_upload('foto')){
     
       $foto =  base_url('asset/upload_sklh/').'blank.png';
      }else{
          $f = $this->upload->data();
       $foto = base_url('asset/upload_sklh/').$f['file_name'];
      }
      if($this->form_validation->run() === FALSE){
          
            $msg = validation_errors();
           $status = false;
       
      }else{
      $tanggal_lahir = date('Y-m-d',strtotime($this->input->post('tanggal_lahir')));
      $data = array('nisn'=>$this->input->post('nisn'),
                    'nipd'=>$this->input->post('nipd'),
                    'no_telp'=>$this->input->post('no_telp'),
                  
                    'nama_lengkap'=>$this->input->post('nama_lengkap'),
                    'kelas'=>$this->input->post('kelas'),
                    'tempat_lahir'=>$this->input->post('tempat_lahir'),
                    'tanggal_lahir' =>$tanggal_lahir,
                    'agama'=>$this->input->post('agama'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'alamat'=>$this->input->post('alamat'),
                    'no_hp'=>$this->input->post('no_hp'),
                    'email'=>$this->input->post('email'),
                    'provinsi'=>76,
                    'kabupaten'=>7604,
                    'kecamatan'=>$this->input->post('kecamatan'),
                    'kelurahan'=>$this->input->post('kelurahan'),
                    'rt'=>$this->input->post('rt'),
                    'rw'=>$this->input->post('rw'),
                    'dusun'=>$this->input->post('dusun'),
                    'kode_pos'=>$this->input->post('kode_pos'),
                    'alat_transportasi'=>$this->input->post('alat_transportasi'),
                    'jenis_tinggal'=>$this->input->post('jenis_tinggal'),
                    'password'=>encode($this->input->post('password')),
                    'vaksin'=>$this->input->post('vaksin'),
                    'vaksin_ke'=>$this->input->post('vaksin_ke'),
                    'nama_vaksin'=>$this->input->post('nama_vaksin'),
                    'foto'=>$foto,
                    'id_sd'=>$this->input->post('id_sd'),


                   
                   
              );
      $id_siswa = $this->model_app->insert_id('siswa',$data);
      if(trim($this->input->post('nama_ibu'))){
        $dataIbu = array('id_siswa'=>$id_siswa,
                        'status_wali'=>'ibu',
                        'nama'=>$this->input->post('nama_ibu'),
                        'tahun'=>date('Y',strtotime($this->input->post('tahun_ibu'))),
                        'jenjang_pendidikan'=>$this->input->post('jenjang_pendidikan_ibu'),
                        'pekerjaan'=>$this->input->post('pekerjaan_ibu'),
                        'penghasilan'=>$this->input->post('penghasilan_ibu'),
                        'nik'=>$this->input->post('nik_ibu'),
                      );
          $this->model_app->insert('siswa_wali',$dataIbu);
      }
      if(trim($this->input->post('nama_ayah'))){
        $dataAyah = array('id_siswa'=>$id_siswa,
                        'status_wali'=>'ayah',
                        'nama'=>$this->input->post('nama_ayah'),
                        'tahun'=>date('Y',strtotime($this->input->post('tahun_ayah'))),
                        'jenjang_pendidikan'=>$this->input->post('jenjang_pendidikan_ayah'),
                        'pekerjaan'=>$this->input->post('pekerjaan_ayah'),
                        'penghasilan'=>$this->input->post('penghasilan_ayah'),
                        'nik'=>$this->input->post('nik_ayah'),
                      );
          $this->model_app->insert('siswa_wali',$dataAyah);

      }
      if(trim($this->input->post('nama_wali'))){
        $dataWali = array('id_siswa'=>$id_siswa,
                        'status_wali'=>'wali',
                        'nama'=>$this->input->post('nama_wali'),
                        'tahun'=>date('Y',strtotime($this->input->post('tahun_wali'))),
                        'jenjang_pendidikan'=>$this->input->post('jenjang_pendidikan_wali'),
                        'pekerjaan'=>$this->input->post('pekerjaan_wali'),
                        'penghasilan'=>$this->input->post('penghasilan_wali'),
                        'nik'=>$this->input->post('nik_wali'),
                      );
          $this->model_app->insert('siswa_wali',$dataWali);

      }
      $dataPersonal = array('id_siswa'=>$id_siswa,
                            'nik'=>$this->input->post('nik'),
                            'skhun'=>$this->input->post('skhun'),
                            'penerima_kps'=>$this->input->post('penerima_kps'),
                            'no_kps'=>$this->input->post('no_kps'),
                            'no_peserta_ujian_nasional'=>$this->input->post('no_peserta_ujian_nasional'),
                            'no_seri_ijazah'=>$this->input->post('no_seri_ijazah'),
                            'nomor_kks'=>$this->input->post('no_kks'),
                            'bank'=>$this->input->post('bank'),
                            'nomor_rekening_bank'=>$this->input->post('nomor_rekening_bank'),
                            'rekening_atas_nama'=>$this->input->post('rekening_atas_nama'),
                            'layak_pip'=>$this->input->post('layak_pip'),
                            'alasan_layak_pip'=>$this->input->post('alasan_layak_pip'),
                            'kebutuhan_khusus'=>$this->input->post('kebutuhan_khusus'),
                            'sekolah_asal'=>$this->input->post('sekolah_asal'),
                            'anak_ke'=>$this->input->post('anak_ke'),
                            'lintang'=>$this->input->post('lintang'),
                            'bujur'=>$this->input->post('bujur'),
                            'no_kk'=>$this->input->post('no_kk'),
                            'berat_badan'=>$this->input->post('berat_badan'),
                            'tinggi_badan'=>$this->input->post('tinggi_badan'),
                            'lingkar_kepala'=>$this->input->post('lingkar_kepala'),
                            'jml_saudara'=>$this->input->post('jml_saudara'),
                            'jarak_ke_sekolah'=>$this->input->post('jarak_ke_sekolah'),
                          );
          $this->model_app->insert('siswa_data',$dataPersonal);

      
          $msg= 'Siswa Berhasil Ditambah';
          $status = true;
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
  function editPersonalSiswa(){
    if($this->input->method() == 'post'){
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$id));
      if($cek->num_rows() > 0){
        $cekP = $this->model_app->view_where('siswa_data',array('id_siswa'=>$id));
          if($cekP->num_rows() > 0){
            $status = true;
            $msg = 'Personal Data Berhasil Disimpan';
            $row = $cekP->row_array();
            $dataPersonal = array(
            'nik'=>$this->input->post('nik'),
            'skhun'=>$this->input->post('skhun'),
            'penerima_kps'=>$this->input->post('penerima_kps'),
            'no_kps'=>$this->input->post('no_kps'),
            'no_peserta_ujian_nasional'=>$this->input->post('no_peserta_ujian_nasional'),
            'no_seri_ijazah'=>$this->input->post('no_seri_ijazah'),
            'nomor_kks'=>$this->input->post('no_kks'),
            'bank'=>$this->input->post('bank'),
            'nomor_rekening_bank'=>$this->input->post('nomor_rekening_bank'),
            'rekening_atas_nama'=>$this->input->post('rekening_atas_nama'),
            'layak_pip'=>$this->input->post('layak_pip'),
            'alasan_layak_pip'=>$this->input->post('alasan_layak_pip'),
            'kebutuhan_khusus'=>$this->input->post('kebutuhan_khusus'),
            'sekolah_asal'=>$this->input->post('sekolah_asal'),
            'anak_ke'=>$this->input->post('anak_ke'),
            'lintang'=>$this->input->post('lintang'),
            'bujur'=>$this->input->post('bujur'),
            'no_kk'=>$this->input->post('no_kk'),
            'berat_badan'=>$this->input->post('berat_badan'),
            'tinggi_badan'=>$this->input->post('tinggi_badan'),
            'lingkar_kepala'=>$this->input->post('lingkar_kepala'),
            'jml_saudara'=>$this->input->post('jml_saudara'),
            'jarak_ke_sekolah'=>$this->input->post('jarak_ke_sekolah'),
          );
            $this->model_app->update('siswa_data',$dataPersonal,array('sd_id'=>$row['sd_id']));
          }else{
            $status = true;
            $msg = 'Personal Data Berhasil Ditambah';
            $dataPersonal = array('id_siswa'=>$id,
            'nik'=>$this->input->post('nik'),
            'skhun'=>$this->input->post('skhun'),
            'penerima_kps'=>$this->input->post('penerima_kps'),
            'no_kps'=>$this->input->post('no_kps'),
            'no_peserta_ujian_nasional'=>$this->input->post('no_peserta_ujian_nasional'),
            'no_seri_ijazah'=>$this->input->post('no_seri_ijazah'),
            'nomor_kks'=>$this->input->post('no_kks'),
            'bank'=>$this->input->post('bank'),
            'nomor_rekening_bank'=>$this->input->post('nomor_rekening_bank'),
            'rekening_atas_nama'=>$this->input->post('rekening_atas_nama'),
            'layak_pip'=>$this->input->post('layak_pip'),
            'alasan_layak_pip'=>$this->input->post('alasan_layak_pip'),
            'kebutuhan_khusus'=>$this->input->post('kebutuhan_khusus'),
            'sekolah_asal'=>$this->input->post('sekolah_asal'),
            'anak_ke'=>$this->input->post('anak_ke'),
            'lintang'=>$this->input->post('lintang'),
            'bujur'=>$this->input->post('bujur'),
            'no_kk'=>$this->input->post('no_kk'),
            'berat_badan'=>$this->input->post('berat_badan'),
            'tinggi_badan'=>$this->input->post('tinggi_badan'),
            'lingkar_kepala'=>$this->input->post('lingkar_kepala'),
            'jml_saudara'=>$this->input->post('jml_saudara'),
            'jarak_ke_sekolah'=>$this->input->post('jarak_ke_sekolah'),
          );
            $this->model_app->insert('siswa_data',$dataPersonal);
          }
      }else{
        $status = false;
        $msg = 'Siswa Tidak DItemukan!';
      }
    
    }
    echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
  function updateWali(){
    if($this->input->method() == 'post'){
      $id = decode($this->input->post('id'));
      $cek = $this->model_app->view_where('siswa_wali',array('sw_id'=>$id));
      if($cek->num_rows() > 0){
        $status = true;
        $dataWali = array(
        
        'nama'=>$this->input->post('nama'),
        'tahun'=>date('Y',strtotime($this->input->post('tahun'))),
        'jenjang_pendidikan'=>$this->input->post('jenjang_pendidikan'),
        'pekerjaan'=>$this->input->post('pekerjaan'),
        'penghasilan'=>$this->input->post('penghasilan'),
        'nik'=>$this->input->post('nik'),
      );
      $this->model_app->update('siswa_wali',$dataWali,array('sw_id'=>$id));
      $msg = 'Wali Berhasil diubah!';

      }else{
        $status = false;
        $msg= 'Wali Siswa Tidak Ditemukan!';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
    }
  

  }
  function kepalasekolah()
  {
    
      if($this->uri->segment('3')=='edit'){
         cek_session_akses('administrator/kepalasekolah/edit',$this->session->id_session);
              if($this->input->method() == 'post'){
                $id = $this->encrypt->decode($this->input->post('id'),keys());
                $cek = $this->model_app->view_where('kepala_sekolah',array('kepsek_id'=>$id));
                if($cek->num_rows() > 0 ){
                    if(trim($this->input->post('kepsek_password'))){
                      $data = array(
                        'kepsek_id_sd'=>decode($this->input->post('sekolah')),
                        'kepsek_name'=>$this->input->post('kepsek_name'),
                        'kepsek_email'=>$this->input->post('kepsek_email'),
                        'kepsek_phone'=>$this->input->post('kepsek_phone'),
                        'kepsek_password'=>encode($this->input->post('kepsek_password')),
                      );
                    }else{
                      $data = array(
                        'kepsek_id_sd'=>decode($this->input->post('sekolah')),
                        'kepsek_name'=>$this->input->post('kepsek_name'),
                        'kepsek_email'=>$this->input->post('kepsek_email'),
                        'kepsek_phone'=>$this->input->post('kepsek_phone'),
                       
                      );
                    }
                    $this->model_app->update('kepala_sekolah',$data,array('kepsek_id'=>$id));
                    $status = true;
                    $msg = null;
                }else{
                  $status = false;
                  $msg = 'Data Kepala Sekolah Tidak Ditemukan!';
                }
                echo json_encode(array('status'=>$status,'msg'=>$msg));
              }else{
                $this->session->set_flashdata('message','Wrong Method');
                redirect('administrator/kepalasekolah');
              }
             
             
          

      }elseif($this->uri->segment('3')=='add'){
               cek_session_akses('administrator/kepalasekolah/add',$this->session->id_session);
               if($this->input->method() == 'post'){
                  $data = array(
                                'kepsek_id_sd'=>decode($this->input->post('sekolah')),
                                'kepsek_name'=>$this->input->post('kepsek_name'),
                                'kepsek_email'=>$this->input->post('kepsek_email'),
                                'kepsek_phone'=>$this->input->post('kepsek_phone'),
                                'kepsek_password'=>encode($this->input->post('kepsek_password')),
                          );
                  $this->model_app->insert('kepala_sekolah',$data);
                  $status = true;
               }else{
                 $this->session->set_flashdata('message','Wrong Method');
                 redirect('administrator/kepalasekolah');
               }
               echo json_encode($status);

         
          
              
          

      }else if($this->uri->segment('3') == 'detail'){
        $id = $this->encrypt->decode($this->input->post('id'),keys());
        $cek = $this->model_app->view_where('kepala_sekolah',array('kepsek_id'=>$id));
        $arr = null;
        if($cek->num_rows() > 0 ){
          $row = $cek->row_array();
          $status = true;
          $msg=  null;
          $arr = array('kepsek_name'=>$row['kepsek_name'],'kepsek_email'=>$row['kepsek_email'],'kepsek_phone'=>$row['kepsek_phone'],'id'=>encode($row['kepsek_id']));
        }else{
          $status=  false;
          $msg = 'Kepala Sekolah Tidak Ditemukan';
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg,'arr'=>$arr));
      }else if($this->uri->segment('3') == 'hapus'){
        $id = $this->encrypt->decode($this->input->get('id'),keys());
        $cek = $this->model_app->view_where('kepala_sekolah',array('kepsek_id'=>$id));
        $arr = null;
        if($cek->num_rows() > 0 ){
          $this->model_app->delete('kepala_sekolah',array('kepsek_id'=>$id));
          $this->session->set_flashdata('success','Kepala Sekolah Berhasil Dihapus');
          redirect('administrator/kepalasekolah');
        }else{
          $this->session->set_flashdata('message','Kepala Sekolah Tidak Ditemukan');
                 redirect('administrator/kepalasekolah');
        }
        
      }
      
      else{
        cek_session_akses('administrator/kepalasekolah',$this->session->id_session);
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
      if($cabang['status']  == 'dinas'){
          $cbg = 'all';
      }else {
          $cbg = $cabang['id_sd'];
      }
      $data['status'] = $cabang['status'];
    

      if(isset($_POST['filter'])){
       
      
        $data['cabang'] = $this->input->post('cabang');
      }else{
       
      
       
        $data['cabang'] = $cbg;
      }
      $data['title'] = 'Kepala Sekolah - '.title();
      $data['page'] = 'Data Kepala Sekolah';
      $data['breadcumb1'] = ' <li class="breadcrumb-item ">Sekolah</li>';
      $data['breadcumb2']= ' <li class="breadcrumb-item active">Kepala Sekolah</li>';
      $data['breadcumb3']= '';
       
      $data['record'] = $this->model_app->fitlerKepsek($data['cabang']);
      $this->template->load('administrator/template','administrator/mod_sekolah/view_kepsek',$data);
      }
  }
  function workingDays()
  { 
     cek_session_akses('administrator/workingDays',$this->session->id_session);
     $m = date('Y-m-d');
    
     if($this->input->post('bulan') ==""){
          $data['m'] = $m;
          $data['title'] = 'Hari Kerja - '.title();
          $data['page'] = 'Data Hari Kerja';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/workingDays').'">Hari Kerja</a></li> ';
          $data['breadcumb3']= '';
          $this->template->load('administrator/template','administrator/mod_sekolah/view_harikerja',$data);
    
     }else{
      $data['title'] = 'Hari Kerja - '.title();
      $data['page'] = 'Data Hari Kerja';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
      $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/workingDays').'">Hari Kerja</a></li> ';
      $data['breadcumb3']= '';
      $data['m'] = $this->input->post('bulan');
      $tahun = date('Y');
      $tanggal =$this->input->post('bulan');
      $bulan = date('m',strtotime($tanggal));

      $cek = $this->model_app->view_where('working_days',array('bulan'=>$bulan,'tahun'=>$tahun));
      if($cek->num_rows() <= 0){
        
        $hari_ini = date("Y-m-d",strtotime($tanggal));
        $tgl_pertama = date('01', strtotime($hari_ini));
        $tgl_terakhir = date('t', strtotime($hari_ini));
     
        
        for($a=1;$a<=$tgl_terakhir;$a++){
          $data = array('bulan'=>$bulan,'tahun'=>$tahun,'tanggal'=>$a);
          $this->model_app->insert('working_days',$data);
        }
      } 
     
       $data['record'] = $this->model_app->view_where('working_days',array('bulan'=>$bulan))->result_array();
       $this->template->load('administrator/template','administrator/mod_sekolah/view_harikerja',$data);

    
     }

     
  }

  function updateWorkingDays()
  {
    $status = $this->input->post('status');
    $id = $this->input->post('id');

    $wher = array('id_wd'=>$id);
    $data = array('status'=>$status);
    $this->model_app->update('working_days',$data,$wher);
  }
  function workingHours()
  {
     cek_session_akses('administrator/workingHours',$this->session->id_session);
    $cek = $this->model_app->view('working_hours');

    if($cek->num_rows() <= 0 )
    {
      $hari=array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $count = count($hari);

      for($a=0;$a<$count;$a++){
        $data=array('hari'=>$hari[$a],'shift_masuk'=>'00:00:00','shift_keluar'=>'00:00:00');
        $this->model_app->insert('working_hours',$data);
      }
    }
    $data['title'] = 'Jam Kerja - '.title();
    $data['page'] = 'Data Jam Kerja';
    $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
    $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/jamkerja').'">Jam Kerja</a></li> ';
    $data['breadcumb3']= '';
      $data['record'] = $cek->result_array();
      $this->template->load('administrator/template','administrator/mod_sekolah/view_jamkerja',$data);
  }

  function updateWorkingHours()
  {

    $shift_masuk = $this->input->post('shift_masuk');
    $shift_keluar = $this->input->post('shift_keluar');
    $id = $this->input->post('id');
    

    $updateArray = array();

    for($x = 0; $x < sizeof($id); $x++){

  
    $updateArray[] = array(
        'id_wh'=>$id[$x],
        'shift_masuk' => $shift_masuk[$x],
        'shift_keluar' => $shift_keluar[$x],
       
    );
   
    }      
    $this->db->update_batch('working_hours',$updateArray, 'id_wh');
     redirect('administrator/workingHours'); 
    }

  function guru()
  {
    
      if($this->uri->segment('3')=='edit'){
         cek_session_akses('administrator/editGuru',$this->session->id_session);
        
              $id = $this->encrypt->decode($this->input->get('id'),keys());
              $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
              if($cek->num_rows() > 0 ){
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                if($cabang['status'] == 'd'){
                    $cbg = 'all';
                }else {
                    $cbg = $cabang['id_sd'];
                }
                $data['status'] = $cabang['status'];
                $data['kelurahan'] = $cabang['kelurahan'];
                $data['kabupaten'] = $cabang['kabupaten'];
                $data['kecamatan'] = $cabang['kecamatan'];
                $data['title'] = 'Guru - '.title();
                $data['page'] = 'Edit Guru';
                $data['cabang'] = $cbg;
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Guru</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current="page">Edit</li>';
                $data['breadcumb3']= '';
            $data['row'] = $cek->row_array();
             $data['bag'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
            $this->template->load('administrator/template','administrator/mod_guru/view_guru_edit',$data);
          }else{
            $this->session->set_flashdata('message','Guru Tidak Ditemukan');
            redirect('administrator/guru');
          }
             
          

      }elseif($this->uri->segment('3')=='add'){
         cek_session_akses('administrator/addGuru',$this->session->id_session);

         
          
                $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                  if($cabang['status']  == 'dinas'){
                      $cbg = 'all';
                  }else {
                      $cbg = $cabang['id_sd'];
                  }
                  $data['cabang'] = $cbg;
                  $data['title'] = 'Guru - '.title();
                  $data['page'] = 'Tambah Guru';
                  $data['breadcumb1'] = ' <li class="breadcrumb-item " >Guru</li>';
                  $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current="page">Tambah</li>';
                  $data['breadcumb3']= '';
                  $data['status'] = $cabang['status'];
                  $data['kelurahan'] = $cabang['kelurahan'];
                  $data['kabupaten'] = $cabang['kabupaten'];
                  $data['kecamatan'] = $cabang['kecamatan'];
                 $data['bagian'] = $this->model_app->view_where('bagian',array('id_sd'=>$cabang['id_sd']));
               $this->template->load('administrator/template','administrator/mod_guru/view_guru_tambah',$data);
          

      }else{
        cek_session_akses('administrator/guru',$this->session->id_session);
      $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
      if($cabang['status']  == 'dinas'){
          $cbg = 'all';
      }else {
          $cbg = $cabang['id_sd'];
      }
      $data['status'] = $cabang['status'];
    

      if(isset($_POST['filter'])){
       
      
        $data['cabang'] = $this->input->post('cabang');
      }else{
       
      
       
        $data['cabang'] = $cbg;
      }
      $data['title'] = 'Guru - '.title();
      $data['page'] = 'Data Guru';
      $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Guru</li>';
      $data['breadcumb2']= ' ';
      $data['breadcumb3']= '';
       
      $data['record'] = $this->model_app->filterGuru($data['cabang']);
      $this->template->load('administrator/template','administrator/mod_guru/view_guru',$data);
      }
  }
  function hapusGuru(){
    cek_session_akses('administrator/hapusGuru',$this->session->id_session);

   
    $id = $this->encrypt->decode($this->input->get('id'),keys());
    $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
    if($cek->num_rows() > 0){
      $this->model_app->delete('guru',array('id_guru'=>$id));
     $row = $cek->row_array();
     $this->session->set_flashdata('success','Guru Berhasil Dihapus');
      redirect('administrator/guru');
    }else{
      $this->session->set_flashdata('message','Tidak Ditemukan!');
      redirect('administrator/guru');
    }
  }
  function pribadiGuru(){
    cek_session_akses('administrator/editGuru',$this->session->id_session);

   
    $id = $this->encrypt->decode($this->input->post('id'),keys());
    $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
    if($cek->num_rows() > 0){
     $row = $cek->row_array();
   
    
    

    
     
  
       $data = array(  'nama_ibu_kandung'=>$this->input->post('nama_ibu_kandung'),
                      'status_perkawinan'=>$this->input->post('status_perkawinan'),
                      'nama_pasangan'=>$this->input->post('nama_pasangan'),
                      'nip_pasangan'=>$this->input->post('nip_pasangan'),
                      'pekerjaan_pasangan'=>$this->input->post('pekerjaan_pasangan'),

                      'tmt_pns'=>$this->input->post('tmt_pns'),
                      'lisensi_kepsek'=>$this->input->post('lisensi_kepsek'),
                      'diklat_kepengawasan'=>$this->input->post('diklat_kepengawasan'),
                      'keahlian_braille'=>$this->input->post('keahlian_braille'),
                      'keahlian_bahasa_syarat'=>$this->input->post('keahlian_bahasa_syarat'),

                   


                  
                  
             );
      
     
        $this->model_app->update('guru',$data,array('id_guru'=>$id));
       $status = true;
       $msg ='Profile Guru Berhasil Dirubah';
      }else{
       $status = false;
       $msg ='Profile Guru Tidak Ditemukan';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
  function kepegGuru(){
    cek_session_akses('administrator/editGuru',$this->session->id_session);

   
    $id = $this->encrypt->decode($this->input->post('id'),keys());
    $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
    if($cek->num_rows() > 0){
     $row = $cek->row_array();
   
    
    

    
     
  
       $data = array('tugas_tambahan'=>$this->input->post('tugas_tambahan'),
                      'sk_cpns'=>$this->input->post('sk_cpns'),
                      'tanggal_cpns'=>$this->input->post('tgl_cpns'),
                      'sk_pengangkatan'=>$this->input->post('sk_pengangkatan'),
                      'tmt_pengangkatan'=>$this->input->post('tmt_pengangkatan'),
                      'lembaga_pengangkatan'=>$this->input->post('lembaga_pengangkatan'),
                      'pangkat_golongan'=>$this->input->post('pangkat_golongan'),
                      'sumber_gaji'=>$this->input->post('sumber_gaji'),
                   


                  
                  
             );
      
     
        $this->model_app->update('guru',$data,array('id_guru'=>$id));
       $status = true;
       $msg ='Profile Guru Berhasil Dirubah';
      }else{
       $status = false;
       $msg ='Profile Guru Tidak Ditemukan';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
  function profileGuru(){
    cek_session_akses('administrator/editGuru',$this->session->id_session);

   
     $id = $this->encrypt->decode($this->input->post('id'),keys());
     $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
     if($cek->num_rows() > 0){
      $row = $cek->row_array();
    
     
     

       $config['upload_path']          = './asset/upload_sklh/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 10000;
      $config['encrypt_name'] = TRUE;
      
      
    
      
     

      $this->load->library('upload', $config);

    
      if ( ! $this->upload->do_upload('foto')){
     
       $foto = $row['foto'];
      }else{
          $f = $this->upload->data();
       $foto = base_url('asset/upload_sklh/').$f['file_name'];
      }
      
      $tanggal_lahir = date('Y-m-d',strtotime($this->input->post('tanggal_lahir')));
      if(trim($this->input->post('password'))){
        $data = array('nip'=>$this->input->post('nip'),
                    'id_sd'=>decode($this->input->post('cabang')),
                    'nama_guru'=>$this->input->post('nama_guru'),
                    'nik'=>$this->input->post('nik'),
                    'no_kk'=>$this->input->post('no_kk'),
                    'nuptk'=>$this->input->post('nuptk'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'tempat_lahir'=>$this->input->post('tempat_lahir'),
                    'tanggal_lahir' =>$tanggal_lahir,
                    'status_kepegawaian'=>$this->input->post('status_kepegawaian'),
                    'jenis_ptk'=>$this->input->post('jenis_ptk'),
                    'agama'=>$this->input->post('agama'),
                    'alamat'=>$this->input->post('alamat'),
                    'kecamatan'=>$this->input->post('kecamatan'),
                    'kelurahan'=>$this->input->post('kelurahan'),
                    'rt'=>$this->input->post('rt'),
                    'rw'=>$this->input->post('rw'),
                    'kode_pos'=>$this->input->post('kode_pos'),
                    'telepon'=>$this->input->post('telepon'),
                    'hp'=>$this->input->post('hp'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'alamat'=>$this->input->post('alamat'),
                
                    'email'=>$this->input->post('email'),
                    'password'=>encode($this->input->post('password')),
                    'kewarganegaraan'=>$this->input->post('kewarganegaraan'),
                    'foto'=>$foto,
                    


                   
                   
              );
        }else{
          $data = array('nip'=>$this->input->post('nip'),
                    'id_sd'=>decode($this->input->post('cabang')),
                    'nama_guru'=>$this->input->post('nama_guru'),
                    'nik'=>$this->input->post('nik'),
                    'no_kk'=>$this->input->post('no_kk'),
                    'nuptk'=>$this->input->post('nuptk'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'tempat_lahir'=>$this->input->post('tempat_lahir'),
                    'tanggal_lahir' =>$tanggal_lahir,
                    'status_kepegawaian'=>$this->input->post('status_kepegawaian'),
                    'jenis_ptk'=>$this->input->post('jenis_ptk'),
                    'agama'=>$this->input->post('agama'),
                    'alamat'=>$this->input->post('alamat'),
                    'kecamatan'=>$this->input->post('kecamatan'),
                    'kelurahan'=>$this->input->post('kelurahan'),
                    'rt'=>$this->input->post('rt'),
                    'rw'=>$this->input->post('rw'),
                    'kode_pos'=>$this->input->post('kode_pos'),
                    'telepon'=>$this->input->post('telepon'),
                    'hp'=>$this->input->post('hp'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'alamat'=>$this->input->post('alamat'),
                
                    'email'=>$this->input->post('email'),

                    'kewarganegaraan'=>$this->input->post('kewarganegaraan'),
                    'foto'=>$foto,
                    


                   
                   
              );
        }
      
         $this->model_app->update('guru',$data,array('id_guru'=>$id));
        $status = true;
        $msg ='Profile Guru Berhasil Dirubah';
       }else{
        $status = false;
        $msg ='Profile Guru Tidak Ditemukan';
       }
       echo json_encode(array('status'=>$status,'msg'=>$msg));
      
  }
  function pajakGuru(){
    cek_session_akses('administrator/editGuru',$this->session->id_session);

   
    $id = $this->encrypt->decode($this->input->post('id'),keys());
    $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
    if($cek->num_rows() > 0){
     $row = $cek->row_array();
   
    
    

    
     
  
       $data = array(
        'npwp'=>$this->input->post('npwp'),
        'nama_wajib_pajak'=>$this->input->post('nama_wajib_pajak'),

        'bank'=>$this->input->post('bank'),
        'nomor_rekening'=>$this->input->post('nomor_rekening'),
        'atas_nama'=>$this->input->post('atas_nama'),
                   


                  
                  
             );
      
     
        $this->model_app->update('guru',$data,array('id_guru'=>$id));
       $status = true;
       $msg ='Profile Guru Berhasil Dirubah';
      }else{
       $status = false;
       $msg ='Profile Guru Tidak Ditemukan';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
  function kepekGuru(){
    cek_session_akses('administrator/editGuru',$this->session->id_session);

   
    $id = $this->encrypt->decode($this->input->post('id'),keys());
    $cek = $this->model_app->view_where('guru',array('id_guru'=>$id));
    if($cek->num_rows() > 0){
     $row = $cek->row_array();
   
    
    

    
     
  
       $data = array(
        'karpeg'=>$this->input->post('karpeg'),
        'karis/karsu'=>$this->input->post('karis/karsu'),
        'lintang'=>$this->input->post('lintang'),
        'bujur'=>$this->input->post('bujur'),
        'nuks'=>$this->input->post('nuks'),
                   


                  
                  
             );
      
     
        $this->model_app->update('guru',$data,array('id_guru'=>$id));
       $status = true;
       $msg ='Profile Guru Berhasil Dirubah';
      }else{
       $status = false;
       $msg ='Profile Guru Tidak Ditemukan';
      }
      echo json_encode(array('status'=>$status,'msg'=>$msg));
  }
  function addGuru(){
    cek_session_akses('administrator/addGuru',$this->session->id_session);

   
      $this->form_validation->set_rules('nip','NIP','required|is_unique[guru.nip]');
      $this->form_validation->set_rules('nik','NIK','required|is_unique[guru.nik]');
      $this->form_validation->set_rules('nuptk','NUPTK','required|is_unique[guru.nuptk]');
      $this->form_validation->set_rules('email','Email','required|is_unique[guru.email]');


     
     

       $config['upload_path']          = './asset/upload_sklh/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 10000;
      $config['encrypt_name'] = TRUE;
      
      
    
      
     

      $this->load->library('upload', $config);

    
      if ( ! $this->upload->do_upload('foto')){
     
       $foto = base_url('asset/upload_sklh/').'blank.png';
      }else{
          $f = $this->upload->data();
       $foto = base_url('asset/upload_sklh/').$f['file_name'];
      }
      if($this->form_validation->run() === FALSE){
          
        $status =  false;
        $msg =  validation_errors();
       
      }else{
      $tanggal_lahir = date('Y-m-d',strtotime($this->input->post('tanggal_lahir')));
      $data = array('nip'=>$this->input->post('nip'),
                    'id_sd'=>decode($this->input->post('cabang')),
                    'nama_guru'=>$this->input->post('nama_guru'),
                    'nik'=>$this->input->post('nik'),
                    'no_kk'=>$this->input->post('no_kk'),
                    'nuptk'=>$this->input->post('nuptk'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'tempat_lahir'=>$this->input->post('tempat_lahir'),
                    'tanggal_lahir' =>$tanggal_lahir,
                    'status_kepegawaian'=>$this->input->post('status_kepegawaian'),
                    'jenis_ptk'=>$this->input->post('jenis_ptk'),
                    'agama'=>$this->input->post('agama'),
                    'alamat'=>$this->input->post('alamat'),
                    'kecamatan'=>$this->input->post('kecamatan'),
                    'kelurahan'=>$this->input->post('kelurahan'),
                    'rt'=>$this->input->post('rt'),
                    'rw'=>$this->input->post('rw'),
                    'kode_pos'=>$this->input->post('kode_pos'),
                    'telepon'=>$this->input->post('telepon'),
                    'hp'=>$this->input->post('hp'),
                    'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
                    'alamat'=>$this->input->post('alamat'),
                
                    'email'=>$this->input->post('email'),
                    'password'=>encode($this->input->post('password')),
                    'kewarganegaraan'=>$this->input->post('kewarganegaraan'),

                    'tugas_tambahan'=>$this->input->post('tugas_tambahan'),
                    'sk_cpns'=>$this->input->post('sk_cpns'),
                    'tanggal_cpns'=>$this->input->post('tgl_cpns'),
                    'sk_pengangkatan'=>$this->input->post('sk_pengangkatan'),
                    'tmt_pengangkatan'=>$this->input->post('tmt_pengangkatan'),
                    'lembaga_pengangkatan'=>$this->input->post('lembaga_pengangkatan'),
                    'pangkat_golongan'=>$this->input->post('pangkat_golongan'),
                    'sumber_gaji'=>$this->input->post('sumber_gaji'),

                    'nama_ibu_kandung'=>$this->input->post('nama_ibu_kandung'),
                    'status_perkawinan'=>$this->input->post('status_perkawinan'),
                    'nama_pasangan'=>$this->input->post('nama_pasangan'),
                    'nip_pasangan'=>$this->input->post('nip_pasangan'),
                    'pekerjaan_pasangan'=>$this->input->post('pekerjaan_pasangan'),
                    'tmt_pns'=>$this->input->post('tmt_pns'),
                    'lisensi_kepsek'=>$this->input->post('lisensi_kepsek'),
                    'diklat_kepengawasan'=>$this->input->post('diklat_kepengawasan'),
                    'keahlian_braille'=>$this->input->post('keahlian_braille'),
                    'keahlian_bahasa_syarat'=>$this->input->post('keahlian_bahasa_syarat'),

                    'npwp'=>$this->input->post('npwp'),
                    'nama_wajib_pajak'=>$this->input->post('nama_wajib_pajak'),

                    'bank'=>$this->input->post('bank'),
                    'nomor_rekening'=>$this->input->post('nomor_rekening'),
                    'atas_nama'=>$this->input->post('atas_nama'),


                    'karpeg'=>$this->input->post('karpeg'),
                    'karis/karsu'=>$this->input->post('karis/karsu'),
                    'lintang'=>$this->input->post('lintang'),
                    'bujur'=>$this->input->post('bujur'),
                    'nuks'=>$this->input->post('nuks'),
                    




                    

                  
                    
                   
                    'foto'=>$foto,
                   


                   
                   
              );
           $this->model_app->insert('guru',$data);
          $status = true;
          $msg = 'Guru Berhasil Ditambah!';
   
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg));
  }

    // RESELLER MODUL ==============================================================================================================================================================================

        // Controller Modul Konsumen
        function seeKelas(){
          $get = $this->model_app->view_where('subdomain',array('id_sd'=>decode($this->input->post('id'))));
          if($get->num_rows() > 0){
              $row = $get->row_array();
              $jenis = $row['jenis_sekolah'];
              $output = '<option value="all">Semua</option>';
              if($jenis == 'sd'){
                  $output .=  "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
              }else if($jenis == 'smp'){
                  $output .=  "<option value='VII'>VII</option><option value='VIII'>VIII</option><option value='IX'>IX</option>";
              }else if($jenis == 'sma'){
                  $output .=  "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

              }
          }else{
              $output = '<option value="all">Semua</option>';
          }
          echo $output;
      }
      function seeSiswa(){
        $kelas = $this->input->post('kelas');
        $sekolah = $this->input->post('sekolah');
        $skh = decode($sekolah);
        if($kelas == 'all' AND $sekolah != 'all' ){
          $data = $this->model_app->view_where('siswa',array('id_sd'=>$skh));
        }else if($kelas != 'all' AND $sekolah == 'all'){
          $data = $this->model_app->view_where('siswa',array('kelas'=>$kelas));
        }else if($kelas == 'all' AND $sekolah == 'all'){
          $data = $this->model_app->view('1siswa');
        }else if($kelas != 'all' AND $sekolah != 'all'){
          $data = $this->model_app->view_where('siswa',array('kelas'=>$kelas,'id_sd'=>$skh));

        }
        $output  = "<option value='all'>Semua</option>";
        if($data->num_rows() > 0){
          foreach($data->result_array() as $row){
            $output .= "<option value='".encode($row['id_siswa'])."'>".$row['nama_lengkap']."</option>";
          }
        }
        echo $output;
      }
      function generateCodeClass(){
          $kode = randomShuffle(5);
          $cek = $this->model_app->view_where('ruang_kelas',array('rk_code'=>$kode));
          if($cek->num_rows() > 0){
            $output = randomShuffle(5);
          }else{
            $output = $kode;
          }
          echo json_encode($output);
      }
      function getMapel(){
        $kelas= $this->input->post('kelas');
        $output = null;
        if($kelas == null OR $kelas == ''){
          $status = false;
          $output = '<option selected disabled>Pilih kelas terlebih dahulu</option>';

        }else{
            $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_kelas'=>$kelas));
            if($mapel->num_rows() > 0){
               $status = true;
                foreach($mapel->result_array() as $mp){
                  $output .= "<option value='".encode($mp['mapel_id'])."'>".$mp['mapel']."</option>";
                }
            }else{
             $output = '<option selected disabled>Tidak ada matapelajaran</option>';

            }
        }
        echo json_encode($output);
      }
      function getMapelNotNUll(){
        $kelas= $this->input->post('kelas');
        $matpel = $this->input->post('mapel');
        $output = null;
        if($kelas == null OR $kelas == ''){
          $status = false;
          $output = '<option selected disabled>Pilih kelas terlebih dahulu</option>';

        }else{
            $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_kelas'=>$kelas));
            if($mapel->num_rows() > 0){
               $status = true;
                foreach($mapel->result_array() as $mp){
                  if($matpel == $mp['mapel_id']){
                    $output .= "<option value='".encode($mp['mapel_id'])."' selected>".$mp['mapel']."</option>";

                  }else{
                    $output .= "<option value='".encode($mp['mapel_id'])."'>".$mp['mapel']."</option>";

                  }
                }
            }else{
             $output = '<option selected disabled>Tidak ada matapelajaran</option>';

            }
        }
        echo json_encode($output);
      }
      function getGuruNotNull(){
        $gurue = $this->input->post('guru');
        $get = $this->model_app->view_where('subdomain',array('id_sd'=>$this->input->post('id')));
        if($get->num_rows() > 0){
          $output = null;
            $row = $get->row_array();
            $guru = $this->model_app->view_where('guru',array('id_sd'=>$row['id_sd']));
            if($guru->num_rows() > 0){
              foreach($guru->result_array() as $gur){
                if($gurue == $gur['id_guru']){
                   $output.= "<option value='".encode($gur['id_guru'])."' selected>$gur[nama_guru]</option>";

                }else{
                  
                  $output.= "<option value='".encode($gur['id_guru'])."'>$gur[nama_guru]</option>";
                }

              }
            }else{
              $output = '<option></option>';
            }
        }else{
            $output = '<option></option>';
        }
        echo json_encode($output);
      }
      function getGuru(){
        $get = $this->model_app->view_where('subdomain',array('id_sd'=>$this->input->post('id')));
        if($get->num_rows() > 0){
          $output = null;
            $row = $get->row_array();
            $guru = $this->model_app->view_where('guru',array('id_sd'=>$row['id_sd']));
            if($guru->num_rows() > 0){
              foreach($guru->result_array() as $gur){
                $output.= "<option value='".encode($gur['id_guru'])."'>$gur[nama_guru]</option>";

              }
            }else{
              $output = '<option></option>';
            }
        }else{
            $output = '<option></option>';
        }
        echo json_encode($output);
      }
        function getKelas(){
            $get = $this->model_app->view_where('subdomain',array('id_sd'=>$this->input->post('id')));
            if($get->num_rows() > 0){
                $row = $get->row_array();
                $jenis = $row['jenis_sekolah'];
                if($jenis == 'sd'){
                    $output =  "<option value='I'>I</option><option value='II'>II</option><option value='III'>III</option><option value='IV'>IV</option><option value='V'>V</option><option value='VI'>VI</option>";
                }else if($jenis == 'smp'){
                    $output =  "<option value='VII'>VII</option><option value='VIII'>VIII</option><option value='IX'>IX</option>";
                }else if($jenis == 'sma'){
                    $output =  "<option value='X'>X</option><option value='XI'>XI</option><option value='XII'>XII</option>";

                }
            }else{
                $output = '<option></option>';
            }
            echo $output;
        }
        function kelurahanSel(){

            $id_kec = $this->input->post('id_kec');
            $data = $this->model_app->view_where_ordering('kelurahan',array('id_kec' => $id_kec),'id_kel','DESC');
            $output ='<option></option>';
            foreach($data->result_array() as $row){
                $output.= '<option value="'.$row['id_kel'].'">'.$row['nama'].'</option>';
            }
            echo $output;
          
          }
    function tebakangka()
    {
        cek_session_akses('tebakangka',$this->session->id_session);
        $status = $this->uri->segment('3');
        $data['link'] = $status;
        $tgl = date('Y-m-d');
        $time = date('H:i:s');
        if($status == 'dua'){
            $data['judul'] = "Data Tebak Dua Angka";
            $data['duaangka'] = $this->model_app->konsumen_tebak_angka('2');
            

            if(isset($_POST['cari']))
            {
                $angka =$this->input->post('tebak');
               
                $data['tebak'] = $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE `angka`.`id_angka` = '$angka' ORDER BY `id_ta` ASC");
                $data['tbangka'] = $this->model_app->view_where('angka',array('id_angka'=>$angka));
                $tebak = $data['tbangka']->row_array();
                $data['date'] = $tebak['date'];
                $data['start'] = $tebak['start'];
                $data['end'] = $tebak['end'];
                $data['angka'] = $tebak['angka'];
            }else{
                $data['tebak'] = $this->model_app->search_konsumen_tebak_angka($tgl,'2',$time);
                $tebak= $data['tebak']->row_array();
                $data['date'] = $tebak['date'];
                $data['start'] = $tebak['start'];
                $data['end'] = $tebak['end'];
                $data['id_angka'] = $tebak['id_angka'];
                $data['angka'] = $tebak['angka'];
            }

        }elseif($status =='tiga')
        {
            $data['judul'] = "Data Tebak Tiga Angka";

            $data['duaangka'] = $this->model_app->konsumen_tebak_angka('3');
            

            if(isset($_POST['cari']))
            {
                $angka =$this->input->post('tebak');
               
                $data['tebak'] = $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE `angka`.`id_angka` = '$angka' ORDER BY `id_ta` ASC");
                $data['tbangka'] = $this->model_app->view_where('angka',array('id_angka'=>$angka));
                $tebak = $data['tbangka']->row_array();
                $data['date'] = $tebak['date'];
                $data['start'] = $tebak['start'];
                $data['end'] = $tebak['end'];
                $data['angka'] = $tebak['angka'];
            }else{
                $data['tebak'] = $this->model_app->search_konsumen_tebak_angka($tgl,'3',$time);
                $tebak= $data['tebak']->row_array();
                $data['date'] = $tebak['date'];
                $data['start'] = $tebak['start'];
                $data['end'] = $tebak['end'];
                $data['id_angka'] = $tebak['id_angka'];
                $data['angka'] = $tebak['angka'];
            }
        }else{
            $data['judul'] = "Data Tebak Empat Angka";
             $data['duaangka'] = $this->model_app->konsumen_tebak_angka('4');
            

            if(isset($_POST['cari']))
            {
                $angka =$this->input->post('tebak');
               
                $data['tebak'] = $this->db->query("SELECT * FROM `angka` LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE `angka`.`id_angka` = '$angka' ORDER BY `id_ta` ASC");
                $data['tbangka'] = $this->model_app->view_where('angka',array('id_angka'=>$angka));
                $tebak = $data['tbangka']->row_array();
                $data['date'] = $tebak['date'];
                $data['start'] = $tebak['start'];
                $data['end'] = $tebak['end'];
                $data['angka'] = $tebak['angka'];
            }else{
                $data['tebak'] = $this->model_app->search_konsumen_tebak_angka($tgl,'4',$time);
                $tebak= $data['tebak']->row_array();
                $data['date'] = $tebak['date'];
                $data['start'] = $tebak['start'];
                $data['end'] = $tebak['end'];
                $data['id_angka'] = $tebak['id_angka'];
                $data['angka'] = $tebak['angka'];
            }
        }

        $this->template->load('administrator/template','administrator/additional/mod_games/view_tebak_angka',$data);

    }
    function absen()
    {

        if($this->uri->segment('3') == 'add'){
        cek_session_akses('administrator/absen/add',$this->session->id_session);

          if(isset($_POST['submit'])){
            $ip = $_SERVER['REMOTE_ADDR'];
            $details = json_decode(file_get_contents("https://ipinfo.io/$ip/json"));
            $loc =  $details->loc; // -> "Mountain View"
            $lok =explode(',', $loc);
            $lat = $lok[0];
            $long = $lok[1];
            $tgl = date('Y-m-d');
            $absen_masuk = date('H:i:s',strtotime($this->input->post('absen_masuk')));
            $absen_keluar =  date('H:i:s',strtotime($this->input->post('absen_keluar')));
            $id_pegawai = decode($this->input->post('peg'));
            $ket = $this->input->post('ket');
    
              $config['upload_path']          = './asset/foto_absen/';
              $config['allowed_types']        = 'gif|jpg|png|jpeg';
              $config['max_size']             = 20000;
              $config['encrypt_name'] = TRUE;
              $h = hari_ini(date('w'));
             $cek = $this->model_app->view_where('working_hours',array('hari'=>$h))->row_array();
    
             if($absen_masuk <= $cek['shift_masuk']){
                  $telat ='n';
                  $poin_in = 1;
                      
            }else{
                  $telat ='y';
                  $poin_in = 0;
                     
            }
            if($absen_keluar >= $cek['shift_keluar']){
                          $pulang ='n';
                       
                        
              }else{
                          $pulang ='y';
                       
                         
              }
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('foto_in')){
                    
                      $foto_masuk = '';
                    }else{
                      $foto_in = $this->upload->data();
                      $foto_masuk = base_url('asset/foto_absen/').$foto_in['file_name'];
                    }
                     if ( ! $this->upload->do_upload('foto_out')){
                    
                      $foto_keluar = '';
                    }else{
                      $foto_out = $this->upload->data();
                      $foto_keluar = base_url('asset/foto_absen/').$foto_out['file_name'];
                    }
    
                    $data=array('id_pegawai'=>$id_pegawai,'tanggal'=>$tgl,'absen_masuk'=>$absen_masuk,'absen_keluar'=>$absen_keluar,'ip'=>$ip,'latitude_in'=>$lat,'longitude_in'=>$long,'latitude_out'=>$lat,'longitude_out'=>$long,'foto_masuk'=>$foto_masuk,'foto_keluar'=>$foto_keluar,'telat'=>$telat,'pulang_awal'=>$pulang,'ket'=>$ket,'status_absen'=>'guru');
                    $ids = $this->model_app->insert_id('absensi',$data);
    
                      $pe = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$tgl,'id_pegawai'=>$id_pegawai));
                if($pe->num_rows() > 0){
                    $p = $pe->row_array();
                  if($p['poin'] <= 1 ){
                    
                 
                  $poin_now = $p['poin'];
    
                  $poin = $poin_now+2;
                }else{
                  $poin_now = $p['poin'];
                  $poin = $poin_now+1;
                }
    
                  $dp = array('poin'=>$poin);
                  $wp = array('tanggal'=>$tgl,'id_pegawai'=>$id_pegawai);
                 $this->model_app->update('poin_pegawai',$dp,$wp);
              }else{
                $datp = array('id_pegawai'=>$id_pegawai,'tanggal'=>$tgl,'poin'=>'1','status_poin'=>'guru');
                $this->model_app->insert('poin_pegawai',$datp);
              }
                    
                      $link = base_url('administrator/absen/add').$ids;
                      $this->insert_history($link,'tambah','absensi');
                    redirect('administrator/absen/add');
    
    
    
        }else{
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                        if($cabang['status']  == 'sekolah'){
                            
                           $cbg = 'all';
    
                            
                        }else {
                            $cbg = $cabang['id_sd'];
                        }
            $data['status'] = $cabang['status'];
            $data['kelurahan'] = $cabang['kelurahan'];
            $data['kabupaten'] = $cabang['kabupaten'];
            $data['kecamatan'] = $cabang['kecamatan'];
          $h = hari_ini(date('w'));
          $data['title'] = 'Absensi - '.title();
          $data['page'] = 'Tambah Absensi';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " >Kinerja Pegawai</li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/absensi').'">Absensi</a></li> ';
          $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
          $data['cabang'] = $cbg;
          $data['shift'] = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
          $sub = $this->session->sub_bagian;
         
             $data['pegawai'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
        
       
         $this->template->load('administrator/template','administrator/mod_sekolah/view_absensi_add',$data);
       }
        }elseif($this->uri->segment('3') == 'edit'){
          cek_session_akses('administrator/absen/edit',$this->session->id_session);
   
          if(isset($_POST['submit'])){
              $absen_masuk = date('H:i:s',strtotime($this->input->post('absen_masuk')));
              $absen_keluar =  date('H:i:s',strtotime($this->input->post('absen_keluar')));
      
              $tgl = $this->input->post('tgl');
              $ket = $this->input->post('ket');
      
              $id=$this->input->post('id');
               $h = hari_ini(date('w'));
               $cek = $this->model_app->view_where('shift',array('hari'=>$h))->row_array();
      
      
                $data = array('absen_masuk'=>$absen_masuk,'absen_keluar'=>$absen_keluar,'ket'=>$ket,'telat'=>$cek['telat'],'pulang_awal'=>$cek['pulang_awal']);
                $where = array('id_absensi'=>$id);
                $this->model_app->update('absensi',$data,$where);
      
                 $link = base_url('administrator/absen/detail?id=').$id;
                        $this->insert_history($link,'edit','absensi');
      
                redirect('administrator/absen/detail?id='.encode($id));
      
      
      
          }else{
           $id = decode($this->input->get('id'));
           
     
     
            $cek = $this->model_app->detail_absensi_guru($id);
            if($cek->num_rows() >0){
              $rows = $cek->row_array();
             $data['title'] = 'Absensi - '.title();
             $data['page'] = 'Edit Absensi';
             $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
             $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/absen').'">Absensi</a></li> ';
             $data['breadcumb3']= '<li class="breadcrumb-item active " >Edit</li>';
             $data['rows'] = $cek->row_array();
             $data['row'] = $this->model_app->view_where('guru',array('id_guru'=>$rows['id_pegawai']))->row_array();
             $this->template->load('administrator/template','administrator/mod_sekolah/view_absensi_edit',$data);
            }else{
             $this->session->set_flashdata('message','Absensi tidak ditemukan');
             redirect('administrator/absen');
            }
   
          
        }
        }else if($this->uri->segment('3') == 'hapus'){
          cek_session_akses('administrator/absen/hapus',$this->session->id_session);
          $id = decode($this->input->get('id'));
          $cek = $this->model_app->view_where('absensi',array('id_absensi'=>$id));
          if($cek->num_rows() > 0){
          $row = $cek->row_array();
          $tgl = $row['tanggal'];
          $id_peg = $row['id_pegawai'];
      
          $this->model_app->delete('report',array('id_pegawai'=>$id_peg,'date'=>$tgl));
         $this->model_app->delete('poin_pegawai',array('id_pegawai'=>$id_peg,'tanggal'=>$tgl));
          $this->model_app->delete('absensi',array('id_absensi'=>$id));
      
      
           $this->session->set_flashdata('success','Absen berhasil dihapus!');
      
              $link = base_url('administrator/absen/');
              $this->insert_history($link,'hapus','absensi');
              redirect('administrator/absen');
          }else{
              $this->session->set_flashdata('message','Data tidak ditemukan');
              redirect('administrator/absen');
          }
        }else if($this->uri->segment('3') == 'detail'){
            $id = decode($this->input->get('id'));
            $cek = $this->model_app->view_where('absensi',array('id_absensi'=>$id));
            if($cek->num_rows() > 0){
              $rows = $cek->row_array();
              $data['title'] = 'Absensi - '.title();
              $data['page'] = 'Detail Absensi';
              $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
              $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/absen').'">Absensi</a></li> ';
              $data['breadcumb3']= '<li class="breadcrumb-item active " >Detail</li>';
              $data['rows'] = $cek->row_array();
              $data['row'] = $this->model_app->view_where('guru',array('id_guru'=>$rows['id_pegawai']))->row_array();
              $this->template->load('administrator/template','administrator/mod_sekolah/view_absensi_detail',$data);
            }else{
              $this->session->set_flashdata('message','Absensi tidak ditemukan!');
              redirect('administrator/absen');
            }

        }else{
          cek_session_akses('administrator/absen',$this->session->id_session);
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
             if($cabang['status']  == 'dinas'){
                 $cbg = 'all';
             }else {
                 $cbg = $cabang['id_sd'];
             }
           
         if(isset($_POST['filter'])){
               $data['start'] = $this->input->post('start');
               $data['end'] = $this->input->post('end');
               $data['telat'] = $this->input->post('telat');
               $data['pulang'] =$this->input->post('pulang');
               $data['ket'] = $this->input->post('ket');
             
     
     
         }else{
     
               $data['start'] = date('Y-m-01');
               $data['end'] = date('Y-m-d');
               $data['telat'] = 'all';
               $data['pulang'] = 'all';
               $data['ket'] = 'all';
             
     
     
         }
          $data['cabang'] = $cbg;
          $data['title'] = 'Absensi - '.title();
          $data['page'] = 'Data Absensi';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/absen').'">Absensi</a></li> ';
          $data['breadcumb3']= '';
          $sub = $this->session->sub_bagian;
          $data['record'] = $this->model_app->search_absensi_guru($data['start'],$data['end'],$data['telat'],$data['pulang'],$data['ket'],$data['cabang']);
          $this->template->load('administrator/template','administrator/mod_sekolah/view_absensi',$data);
  
        }
       

    }
    function form()
    {

        if($this->uri->segment('3') == 'add'){
        cek_session_akses('administrator/form/add',$this->session->id_session);

          if(isset($_POST['submit'])){
            $data = [];
      
            $count = count($_FILES['files']['name']);
          
            for($i=0;$i<$count;$i++){
          
              if(!empty($_FILES['files']['name'][$i])){
          
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
        
                $config['upload_path'] =  './asset/foto_form/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '20000';
                $config['encrypt_name'] = TRUE;
                $config['file_name'] = $_FILES['files']['name'][$i];
         
                $this->load->library('upload',$config); 
                $this->upload->do_upload('file');
              
                // $data['totalFiles'][] = $images;
                $uploadData = $this->upload->data();
                $images[] = base_url('asset/foto_form/').$uploadData['file_name'];
                }
      
         
            }
               $fileName = implode(';',$images);
                  $foto = str_replace(' ','_',$fileName);
                 
          
                if(trim($foto)!=''){
                    
                
                   $id = decode($this->input->post('peg'));
                  $dari = date('Y-m-d',strtotime($this->input->post('dari')));
                  $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
                  $data = array('id_pegawai'=>$id,'keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'),'foto'=>$foto,'approved'=>'setuju','status_form'=>'guru');
                  $this->db->insert('form_izin',$data);
                  $this->session->set_flashdata('success','Formulir berhasil diinput!');
      
                  redirect('administrator/form');
              
      
                  
                }else{
                       $error = array('error' => $this->upload->display_errors());
                   $this->session->set_flashdata('message',$error['error']);
                   redirect('administrator/form');
                   
                }
    
    
    
        }else{
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                        if($cabang['status']  != 'sekolah'){
                            
                           $cbg = 'all';
    
                            
                        }else {
                            $cbg = $cabang['id_sd'];
                        }
            $data['status'] = $cabang['status'];
            $data['cabang'] = $cabang['id_sd'];
            $data['kelurahan'] = $cabang['kelurahan'];
            $data['kabupaten'] = $cabang['kabupaten'];
            $data['kecamatan'] = $cabang['kecamatan'];
            $h = hari_ini(date('w'));
            $data['title'] = 'Tambah Ijin & Sakit - '.title();
            $data['page'] = 'Tambah Ijin & Sakit';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/form').'">Ijin & Sakit</a></li> ';
            $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
            $data['cabang'] = $cbg;
       
       
         
         
        
       
         $this->template->load('administrator/template','administrator/mod_sekolah/view_ijin_add',$data);
       }
        }elseif($this->uri->segment('3') == 'edit'){
          cek_session_akses('administrator/form/edit',$this->session->id_session);
   
          if(isset($_POST['submit'])){
              $dari = date('Y-m-d',strtotime($this->input->post('dari')));
              $sampai = date('Y-m-d',strtotime($this->input->post('sampai')));
              $data = array('keterangan'=>$this->input->post('keterangan'),'dari'=>$dari,'sampai'=>$sampai,'status'=>$this->input->post('status'));
              $where = array('id_form'=>$this->input->post('id'));

              $this->model_app->update('form_izin',$data,$where);
              $this->session->set_flashdata('success','Formulir berhasil diubah!');

              redirect('administrator/form');
      
              
      
      
      
          }else{
            $id = decode($this->input->get('id'));
            $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            $cek =  $this->model_app->detail_form_guru($id);
            if($cek->num_rows()> 0){
             $data['title'] = 'Edit Ijin - '.title();
             $data['page'] = 'Edit Ijin';
             $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
             $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/form').'">Ijin & Sakit</a></li> ';
             $data['breadcumb3']= '<li class="breadcrumb-item  active" >Edit</li>';
             $data['rows'] =$cek->row_array();
            $this->template->load('administrator/template','administrator/mod_sekolah/view_ijin_edit',$data);
            }else{
                $this->session->set_flashdata('message','Ijin Sakit tidak ditemukan');
                redirect('administrator/ijin');
            }
   
          
        }
        }else if($this->uri->segment('3') == 'hapus'){
          cek_session_akses('administrator/form/hapus',$this->session->id_session);
          $id = decode($this->input->get('id'));
          $cek = $this->model_app->view_where('form_izin',array('id_form'=>$id));
          if($cek->num_rows() > 0){
          $row = $cek->row_array();
         
          $this->model_app->delete('form_izin',array('id_form'=>$id));
      
      
           $this->session->set_flashdata('success','Form berhasil dihapus!');
      
              $link = base_url('administrator/form/');
              $this->insert_history($link,'hapus','form');
              redirect('administrator/form');
          }else{
              $this->session->set_flashdata('message','Data tidak ditemukan');
              redirect('administrator/form');
          }
        }else if($this->uri->segment('3') == 'detail'){
          $id = decode($this->input->get('id'));
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $cek =  $this->model_app->detail_form_guru($id,$cabang['id_sd']);
            if($cek->num_rows()> 0){
                $data['title'] = 'Detail Ijin - '.title();
                $data['page'] = 'Detail Ijin';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/form').'">Ijin & Sakit</a></li> ';
                $data['breadcumb3']= '<li class="breadcrumb-item  active" >Detail</li>';
              $data['rows'] =$cek->row_array();
              $this->template->load('administrator/template','administrator/mod_sekolah/view_ijin_detail',$data);
            }else{
                $this->session->set_flashdata('message','Ijin Sakit tidak ditemukan');
                redirect('administrator/ijin');
            }

        }else{
          cek_session_akses('administrator/form',$this->session->id_session);
          
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
            if($cabang['status']  == 'dinas'){
                $cbg = 'all';
            }else {
                $cbg = encode($cabang['id_sd']);
            }
            $data['cbg']= $cbg;
           
            if(isset($_POST['filter'])){
                  $data['start'] = $this->input->post('start');
                  $data['end'] = $this->input->post('end');
                  $data['status'] = $this->input->post('status');
                  $data['cabang'] = $this->input->post('cabang');
        
                  
            }else{
        
                  $data['start'] = date('Y-m-01');
                  $data['end'] = date('Y-m-d',strtotime("+5 Days"));
                  $data['status'] = 'all';
                  $data['cabang'] = $cbg;
                
            }
            if($data['cabang'] == 'all'){
              $cabang = 'all';
            }else{
              $cabang = decode($data['cabang']);
            }
            $data['title'] = 'Ijin - '.title();
            $data['page'] = 'Data Ijin';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/form').'">Ijin & Sakit</a></li> ';
            $data['breadcumb3']= '';
            
            $data['record'] = $this->model_app->search_izin_guru($data['start'],$data['end'],$data['status'],$cabang);
            $this->template->load('administrator/template','administrator/mod_sekolah/view_ijin',$data);
  
        }
       

    }
    function laporan(){
        if($this->uri->segment('3') == 'add'){
          cek_session_akses('administrator/laporan/add',$this->session->id_session);
          if(isset($_POST['submit'])){
            $judul = $this->input->post('judul_report');
        $tgl = $this->input->post('date');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $keterangan = $this->input->post('report');
    
        $date = date('Y-m-d',strtotime($tgl));
        $start = date('H:i:s',strtotime($start));
        $end = date('H:i:s',strtotime($end));
        $id = decode($this->input->post('peg'));
        
        $s = new DateTime($start);
        $e = new DateTime($end);
        $interval = $s->diff($e);
        $hrs = $interval->d * 24 + $interval->h;
        $sel =  $hrs.".".$interval->format('%i'); 
    
     
          $config1['upload_path']          = './asset/foto_report/';
								$config1['encrypt_name'] = TRUE;
								$config1['allowed_types']        = 'gif|jpg|png|jpeg';
								$config1['max_size']             = 1000;
									
										
								$this->load->library('upload', $config1,'identity_photo');
								$this->identity_photo->initialize($config1);

								
								$config2['upload_path']          = './asset/foto_report/';
								$config2['encrypt_name'] = TRUE;
								$config2['allowed_types']        = 'gif|jpg|png|jpeg';
								$config2['max_size']             = 1000;
									
										
								$this->load->library('upload', $config2,'npwp_photo');
								$this->npwp_photo->initialize($config2);

                // $fileName = implode(';',$images);
                // $foto = str_replace(' ','_',$fileName);
               
        
              if(!$this->identity_photo->do_upload('file')){
                $error = array('error' => $this->identity_photo->display_errors());
                $this->session->set_flashdata('message',$error['error']);
                redirect('administrator/report');
              }else if(!$this->npwp_photo->do_upload('file1')){
                $error = array('error' => $this->npwp_photo->display_errors());
                $this->session->set_flashdata('message',$error['error']);
                redirect('administrator/report');
              }else{
                $upload_data1 = $this->identity_photo->data();
                $upload_data2 = $this->npwp_photo->data();

                $foto_masuk = base_url('asset/foto_report/').$upload_data1['file_name'];
                $foto_keluar = base_url('asset/foto_report/').$upload_data2['file_name'];
                $tanggal = date('Y-m-d');
                $p = $this->model_app->view_where('poin_pegawai',array('tanggal'=>$tanggal,'id_pegawai'=>$id))->row_array();
    
                $poin_now = $p['poin'];
    
                $poin = $poin_now+$sel;
    
                $dp = array('poin'=>$poin);
                $wp = array('tanggal'=>$tanggal,'id_pegawai'=>$id);
    
              $this->model_app->update('poin_pegawai',$dp,$wp);
    
    
                $data = array('id_pegawai'=>$id,'judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'end'=>$end,'date'=>$date,'foto_masuk'=>$foto_masuk,'foto_keluar'=>$foto_keluar,'jam_kerja'=>$sel,'status_report'=>'guru');
                $this->db->insert('report',$data);
                $this->session->set_flashdata('success','Report berhasil diinput!');
    
                redirect('administrator/laporan');
              }
                  
              
            
    
                
             
        }else{
             $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
                        if($cabang['status']  == 'sekolah'){
                          $cbg = $cabang['id_sd'];
                      
    
                            
                        }else{
                          $cbg = 'all';
                        }
                $data['status'] = $cabang['status'];
                $data['cabang'] = $cbg;
                
                $data['title'] = 'Tambah Report - '.title();
                $data['page'] = 'Tambah Report';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/laporan').'">Report</a></li> ';
                $data['breadcumb3']= '<li class="breadcrumb-item active " >Tambah</li>';
             $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
          // $data['peg'] = $this->model_app->view('pegawai');
           $this->template->load('administrator/template','administrator/mod_sekolah/view_report_add',$data);
        }
        }else if($this->uri->segment('3') == 'edit'){
          cek_session_akses('administrator/laporan/edit',$this->session->id_session);

          if(isset($_POST['submit'])){
            $judul = $this->input->post('judul_report');
            $tgl = $this->input->post('date');
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $keterangan = $this->input->post('report');
  
            $date = date('Y-m-d',strtotime($tgl));
            $start = date('H:i:s',strtotime($start));
            $end = date('H:i:s',strtotime($end));
            $id = $this->input->post('id');
            
            $s = new DateTime($start);
            $e = new DateTime($end);
            $interval = $s->diff($e);
            $hrs = $interval->d * 24 + $interval->h;
            $sel =  $hrs.".".$interval->format('%i');
             $data = array('judul_report'=>$judul,'report'=>$keterangan,'start'=>$start,'end'=>$end,'date'=>$date,'jam_kerja'=>$sel);
             $where = array('id_report'=>$id);
  
             $this->model_app->update('report',$data,$where);
  
             $this->session->set_flashdata('success','Report berhasil diubah!');
             redirect('administrator/laporan');
  
  
  
        }else{
            $id = decode($this->input->get('id'));
            
            $cek =  $this->model_app->detail_report_guru($id);
            if($cek->num_rows()> 0){
              $data['title'] = 'Detail Report - '.title();
              $data['page'] = 'Detail Report';
              $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
              $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/laporan').'">Rerport</a></li> ';
              $data['breadcumb3']= '<li class="breadcrumb-item  active" >Edit</li>';
              $data['rows'] =$cek->row_array();
              $this->template->load('administrator/template','administrator/mod_sekolah/view_report_edit',$data);
            }else{
                $this->session->set_flashdata('message','Report  tidak ditemukan');
                redirect('administrator/laporan');
            }
          }
        }else if($this->uri->segment('3') == 'hapus'){
          cek_session_akses('administrator/laporan/hapus',$this->session->id_session); 
          $id = decode($this->input->get('id'));
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $cek =  $this->model_app->detail_report_guru($id);
          if($cek->num_rows()> 0){
            $this->model_app->delete('report',array('id_report'=>$id));
            $this->session->set_flashdata('success','Report berhasil dihapus!');
            redirect('administrator/laporan');
          }else{
            $this->session->set_flashdata('message','Report tidak ditemukan!');
            redirect('administrator/laporan');
          }
        }else if($this->uri->segment('3') == 'detail'){
          $id = decode($this->input->get('id'));
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
          $cek =  $this->model_app->detail_report_guru($id);
          if($cek->num_rows()> 0){
            $data['title'] = 'Detail Report - '.title();
            $data['page'] = 'Detail Report';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/laporan').'">Rerport</a></li> ';
            $data['breadcumb3']= '<li class="breadcrumb-item  active" >Detail</li>';
            $data['rows'] =$cek->row_array();
            $this->template->load('administrator/template','administrator/mod_sekolah/view_report_detail',$data);
          }else{
              $this->session->set_flashdata('message','Report  tidak ditemukan');
              redirect('administrator/laporan');
          }
        
        }else{
          cek_session_akses('administrator/laporan',$this->session->id_session);
          $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
           if($cabang['status']  == 'dinas'){
               $cbg = 'all';
           }else {
               $cbg = $cabang['id_sd'];
           }
           $data['status'] = $cabang['status'];
           $data['kelurahan'] = $cabang['kelurahan'];
           $data['kabupaten'] = $cabang['kabupaten'];
           $data['kecamatan'] = $cabang['kecamatan'];
    
    
            if(isset($_POST['filter'])){
                $data['start'] = $this->input->post('start');
                $data['end'] = $this->input->post('end');
                $data['cabang'] = $this->input->post('cabang');
                
          }else{
        
                $data['start'] = date('Y-m-01');
                $data['end'] = date('Y-m-d',strtotime("+5 Days"));
                
               
                $data['cabang'] = encode($cbg);
                
          }
          
          $data['title'] = 'Report - '.title();
          $data['page'] = 'Data Report';
          $data['breadcumb1'] = ' <li class="breadcrumb-item " >Sekolah</li>';
          $data['breadcumb2']= ' <li class="breadcrumb-item active" ><a href="'.base_url('administrator/laporan').'">Report</a></li> ';
          $data['breadcumb3']= '';
          if($data['cabang'] == 'all'){
            $cabang = 'all';
          }else{
            $cabang = decode($data['cabang']);
          }
          $data['peg'] = $this->model_app->view_where('pegawai',array('id_sd'=>$cbg));
          $data['record'] = $this->model_app->data_report_guru($data['start'],$data['end'],$cabang);
          $this->template->load('administrator/template','administrator/mod_sekolah/view_report',$data);
        }
      
     }
    function seeGuru(){
      $tgl = date('Y-m-d');
      $sekolah = decode($this->input->post('sekolah'));
      $data = $this->model_app->view_where('guru',array('id_sd'=>$sekolah));
      $output = '<option selected disabled></option>';
      if($data->num_rows() > 0 ){
      
        foreach($data->result_array() as $row){
          $cekAbs = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_guru'],'status_absen'=>'guru','tanggal'=>date('Y-m-d')));
          if($cekAbs->num_rows() == 0 ){
              $output.= "<option value='".encode($row['id_guru'])."'>".$row['nama_guru']."</option>";
          }
        }
      }
      echo $output;

    }
    function seeGuru2(){
      $tgl = date('Y-m-d');
      $sekolah = decode($this->input->post('sekolah'));
      $data = $this->model_app->view_where('guru',array('id_sd'=>$sekolah));
      $output = '<option selected disabled></option>';
      if($data->num_rows() > 0 ){
      
        foreach($data->result_array() as $row){
          $cekAbs = $this->model_app->view_where('absensi',array('id_pegawai'=>$row['id_guru'],'status_absen'=>'guru','tanggal'=>date('Y-m-d')));
          if($cekAbs->num_rows() > 0 ){
              $output.= "<option value='".encode($row['id_guru'])."'>".$row['nama_guru']."</option>";
          }
        }
      }
      echo $output;

    }
    function seeGuru1(){
      $tgl = date('Y-m-d');
      $sekolah = decode($this->input->post('sekolah'));
      $data = $this->model_app->view_where('guru',array('id_sd'=>$sekolah));
      $output = '<option selected disabled></option>';
      if($data->num_rows() > 0 ){
      
        foreach($data->result_array() as $row){
       
              $output.= "<option value='".encode($row['id_guru'])."'>".$row['nama_guru']."</option>";
          
        }
      }
      echo $output;

    }
    function soal()
    {
        cek_session_akses('administrator/soal',$this->session->id_session);
        $data['title'] = 'Soal - '.title();
        $data['page'] = 'Daftar Soal';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Soal</li>';
        $data['breadcumb2']= ' ';
            $data['breadcumb3']= '';
        $data['record'] = $this->model_app->view_ordering('quiz','id_quiz','DESC');
        // $this->template->load('administrator/template','administrator/mod_soal/view_soal',$data);
        $this->template->load('administrator/template','administrator/mod_soal/view_soal',$data);




    }
    function seeMapel(){
      $kelas = $this->input->post('kelas');
      $data = $this->model_app->view_where('mata_pelajaran',array('mapel_kelas'=>$kelas));
      if($data->num_rows() >0){
        $output = null;
        foreach($data->result_array() as $row){
          $output .= '<option value="'.$row['mapel_id'].'">'.$row['mapel'].'</option>';
        }
      }
      echo $output;
    }
    function addSoal()
    {
        cek_session_akses('administrator/addSoal',$this->session->id_session);
        $data['title'] = 'Tambah Soal - '.title();
        $data['page'] = 'Tambah  Soal';
        $data['breadcumb1'] = ' <li class="breadcrumb-item "><a href="'.base_url('administrator/soal').'">Soal</a></li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current >Tambah</li>';
            $data['breadcumb3']= '';
    
        $this->template->load('administrator/templateeditor','administrator/mod_soal/view_soal_add',$data);
       
    }

    function editSoal()
    {
        cek_session_akses('administrator/editSoal',$this->session->id_session);
        $id = $this->input->get('id');
        $id_soal = $this->encrypt->decode($id,$this->key);
        $cek = $this->model_app->view_where('quiz',array('id_quiz'=>$id_soal));
        if($cek->num_rows() > 0){
            $data['row']  =$cek->row_array();
            $data['title'] = 'Edit Soal - '.title();
            $data['page'] = 'Edit  Soal';
            $data['breadcumb1'] = ' <li class="breadcrumb-item "><a href="'.base_url('administrator/soal').'">Soal</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current >Edit</li>';
                $data['breadcumb3']= '';
        
            $this->template->load('administrator/templateeditor','administrator/mod_soal/view_soal_edit',$data);
        }else{
            $this->session->set_flashdata('message','Soal Tidak Ditemukan');
            redirect('administrator/soal');
        }
        
       
    }
    function doAddSoal(){
      if($this->input->method() == 'post'){
         $config['upload_path']          = './asset/foto_soal/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 20000;
                $config['encrypt_name'] = TRUE;
                
                
              
                
               

                $this->load->library('upload', $config);

             
                if (! $this->upload->do_upload('file')){
               
                    $f = NULL;
                }else{
                    $foto = $this->upload->data();
                    $f = base_url('asset/foto_soal/').$foto['file_name'];
                }
        $data = array('quiz'=>$this->input->post('soal'),'answer_a'=>$this->input->post('answer_a'),'answer_b'=>$this->input->post('answer_b'),'answer_c'=>$this->input->post('answer_c'),'answer_d'=>$this->input->post('answer_d'),'answer'=>$this->input->post('answer'),'kelas'=>$this->input->post('kelas'),'image'=>$f,'created_by'=>$this->session->username,'status'=>'y','correction'=>$this->input->post('correction'),'mapel_id'=>$this->input->post('mata_pelajaran'));
        $this->model_app->insert('quiz',$data);
        echo json_encode(array('status'=>true));
      }
        
    }
     function doEditSoal(){
         $config['upload_path']          = './asset/foto_soal/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 20000;
                $config['encrypt_name'] = TRUE;
                
                
              
                
               

                $this->load->library('upload', $config);

             
                if (! $this->upload->do_upload('file')){
               
                    $f = $this->input->post('oldfoto');
                }else{
                    $foto = $this->upload->data();
                    $f = base_url('asset/foto_soal/').$foto['file_name'];
                }
        $data = array('quiz'=>$this->input->post('soal'),'answer_a'=>$this->input->post('answer_a'),'answer_b'=>$this->input->post('answer_b'),'answer_c'=>$this->input->post('answer_c'),'answer_d'=>$this->input->post('answer_d'),'answer'=>$this->input->post('answer'),'kelas'=>$this->input->post('kelas'),'image'=>$f,'created_by'=>$this->session->username,'status'=>'y','correction'=>$this->input->post('correction'),'mapel_id'=>$this->input->post('mata_pelajaran'));
        $where = array('id_quiz'=>$this->encrypt->decode($this->input->post('id'),$this->key));
        $this->model_app->update('quiz',$data,$where);
        echo true;
    }
    function setSoal(){
        cek_session_akses('administrator/setSoal',$this->session->id_session);
        $id = $this->input->get('id');
        $id_soal = $this->encrypt->decode($id,$this->key);
        $cek = $this->model_app->view_where('quiz',array('id_quiz'=>$id_soal));
        $status= $this->input->get('status');
        if($cek->num_rows() > 0){
            if($status == 'y' OR $status == 'n'){
                $this->model_app->update('quiz',array('status'=>$status),array('id_quiz'=>$id_soal));
                $this->session->set_flashdata('success','Berhasil diubah');
                 redirect('administrator/soal');
            }else{
                 $this->session->set_flashdata('message','Format Salah');
                 redirect('administrator/soal');
            }
        }else{
            $this->session->set_flashdata('message','Soal Tidak Ditemukan');
            redirect('administrator/soal');
        }
    }
    function hapusSoal(){
        cek_session_akses('administrator/hapusSoal',$this->session->id_session);
        $id = $this->input->post('id');
        $id_soal = $this->encrypt->decode($id,$this->key);
        $cek = $this->model_app->view_where('quiz',array('id_quiz'=>$id_soal));
        $status= $this->input->get('status');
        if($cek->num_rows() > 0){
            
                $this->model_app->delete('quiz',array('id_quiz'=>$id_soal));
                echo true;
            
        }else{
            echo false;
        }
    }
    function pushSoal(){
        $kelas = 'I';
        $get = $this->model_app->view_where('quiz',array('kelas'=>$kelas,'status'=>'y'))->row_array();
        for($a=1;$a<=50;$a++){
            $data = array('quiz'=>$get['quiz'],'answer_a'=>$get['answer_a'],'answer_b'=>$get['answer_b'],'answer_c'=>$get['answer_c'],'answer_d'=>$get['answer_d'],'answer'=>$get['answer'],'kelas'=>$get['kelas'],'correction'=>$get['correction'],'image'=>$get['image'],'status'=>'y','created_by'=>$get['created_by']
                    );
            $this->model_app->insert('quiz',$data);
            echo $a;
        }
    }
    function quiz(){
        cek_session_akses('administrator/quiz',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        if($cabang['status'] == 'dinas'){
          $cbg = 'all';
        }else{
          $cbg = $cabang['id_sd'];
        }
        $data['jenis'] = $cabang['status'];
        $data['cabang'] = $cbg;
        $data['title'] = 'Quiz Partisipasi - '.title();
        $data['page'] = 'Quiz Partisipasi ';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current >Quiz</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current > Partisipasi</li>';
        $data['breadcumb3']= '';
        $this->template->load('administrator/template','administrator/mod_kuis/view_partisipasi',$data);
    }
    
    function addPartisipasi(){
        cek_session_akses('administrator/addPartisipasi',$this->session->id_session);
        $data['title'] = 'Add Partisipasi - '.title();
        $data['page'] = 'Add Partisipasi ';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/quiz').'" >Quiz</a></li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item "  >Partisipasi</li>';
        $data['breadcumb3']= ' <li class="breadcrumb-item active" aria-current >Tambah</li>';
        $this->template->load('administrator/template','administrator/mod_kuis/view_partisipasi_add',$data);
    }
    function getPartisipasi(){
        $tanggal = $this->input->post('tanggal');
       
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        if($cabang['status'] == 'dinas'){
            $data = $this->model_app->view_where_ordering('siswa',array('active'=>'y'),'id_sd','ASC');
        }else{
           $data = $this->model_app->view_where('siswa',array('active'=>'y','id_sd'=>$cabang['id_sd']));
        }
        $output = "<option selected disabled></option>";
        $cekT = $this->model_app->view_where('quiz_date',array('tanggal'=>$tanggal));
        if($cekT->num_rows() > 0){
          foreach($data->result_array() as $row){
          
            $cek = $this->db->query("SELECT * FROM quiz_date a JOIN quiz_partisipasi b ON a.id_qd = b.qp_date WHERE tanggal = '".$tanggal."' AND b.id_siswa = '".$row['id_siswa']."'");
            if($cek->num_rows() > 0) {
              $output = "<option selected disabled></option>";
            }else{
                $output .= "<option value='".$this->encrypt->encode($row['id_siswa'],keys())."'>".nama($row['nama_lengkap'])."</option>";
            }
         }
        }else{
            $output = "<option selected disabled></option>";
        }
       
        echo $output;
    }
    function getMataPelajaran(){
        $id = decode($this->input->post('id'));
        $tanggal = $this->input->post('tanggal');
        $output = null;
        $cek = $this->model_app->view_where('siswa',array('id_siswa'=>$id));
        if($cek->num_rows() > 0){
          $row = $cek->row_array();
          $kelas = $row['kelas'];
          $matpel = $this->model_app->view_where('quiz_date',array('tanggal'=>$tanggal,'kelas'=>$kelas));
          if($matpel->num_rows() > 0){
            $mp = $matpel->row_array();
            $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$mp['mapel_id']))->row_array();
            $status = true;
            $output = $kelas.' - '.strtoupper($mapel['mapel']);
          }else{
            $status =false;
          }
        }else{
          $status = false;
        }
        echo json_encode(array('status'=>$status,'output'=>$output));
    }
    function doAddPartisipasi(){
        $tanggal = $this->input->post('tanggal');
        $id_siswa = $this->encrypt->decode($this->input->post('siswa'),keys());
        $siswa= $this->model_app->view_where('siswa',array('id_siswa'=>$id_siswa));
        if($siswa->num_rows() > 0 ){
          $sis = $siswa->row_array();
          $cek = $this->model_app->view_where('quiz_date',array('tanggal'=>$tanggal,'kelas'=>$sis['kelas']));
          if($cek->num_rows() > 0){
              $rowC = $cek->row_array();
              
              $cekS = $this->model_app->view_where('quiz_partisipasi',array('id_siswa'=>$id_siswa,'qp_date'=>$rowC['id_qd']));
              if($cekS->num_rows() > 0){
                  $status = false;
                  $msg = 'Siswa sudah melakukan kuis pada tanggal tersebut!';
              }else{
                  $finish = date('Y-m-d H:i:s');
                
                  $data = array('id_siswa'=>$id_siswa,'qp_date'=>$rowC['id_qd'],'qp_correct'=>$this->input->post('benar'),'qp_wrong'=>$this->input->post('salah'),'qp_poin'=>$this->input->post('poin'),'quiz_duration'=>$this->input->post('durasi').':00','qp_finish'=>$finish,'qp_done'=>'y');
                      
                  $this->model_app->insert('quiz_partisipasi',$data);
                  $status = true;
                  $msg = null;
              }
          }else{
              $status = false;
              $msg = 'Pada Tanggal Tersebut tidak ada Quiz yang Aktif!';
          }
        }else{
          $status = false;
          $msg = 'Siswa tidak ditemukan!';
        }
       
        echo json_encode(array('status'=>$status,'msg'=>$msg));
        
    }
    function dataPartisipasi(){
        $id = $this->session->id_session;
        $u= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/editPartisipasi'")->num_rows();
        $d= $this->db->query("SELECT * FROM submodul,users_modul WHERE submodul.id_sm=users_modul.id_sm AND users_modul.id_session='$id' AND submodul.link='administrator/hapusPartisipasi'")->num_rows();
        $output = '<table class="table table-bordered" id="table" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Siswa</th>
            <th>Kelas</th>
            <th>Sekolah</th>
            <th>Tanggal</th>
            <th>Benar</th>
            <th>Salah</th>
            <th>Poin</th>
            <th>Durasi</th>
            <th>Selesai</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
       
        $siswa = $this->input->post('siswa');
        if($siswa == 'all' OR $siswa == null){
            $sis = 'all';
        }else{
            $sis = $this->encrypt->decode($this->input->post('siswa'),keys());
        }

        $start =$this->input->post('start');
        $end = $this->input->post('end');
        $kelas = $this->input->post('kelas');
        $skh = $this->input->post('sekolah');
        if($skh == 'all'){
          $sekolah = 'all';
        }else{
          $sekolah = decode($skh);
        }
        $data = $this->model_app->dataPartisipasi($start,$end,$sis,$kelas,$sekolah);
        $no =1;
        foreach($data->result_array() as $row){
            if($u > 0 AND $row['qp_done'] == 'y' AND $row['qp_finish'] != null){
                $edit = "<button class=' m-1 btn btn-round btn-outline-success btn-xs btnEdit' data-id='".$this->encrypt->encode($row['id_qp'],keys())."'  title='Edit Data' ><span class='feather icon-edit' style='font-size:10px;'></span></button> ";
    
            }else{
                $edit = null;
            }
    
            if($d > 0){
                $hapus = "<button class='m-1 btn btn-round btn-outline-danger btn-xs btnHapus' data-id='".$this->encrypt->encode($row['id_qp'],keys())."'  title='Hapus Data' ><span class='feather icon-trash' style='font-size:10px;'></span></button> ";
    
            }
            if($row['qp_done'] == 'n'){
                $status ='Quiz Belum Selesai';
            }else{
                $status = date('d/m/Y H:i',strtotime($row['qp_finish']));
            }
            $d = $row['quiz_duration'];
            $dur = explode(':',$d);
            $m = $dur[0];
            $d = $dur[1];
            
            $me = 119-$m;
            $de = 60-$d;
            if($de == 60){
                $me = $me+1;
                $detik = '';
            }else{
                $detik = $de.' Detik';
                $me = $me;
            }
            $durasi = $me.' Menit '.$detik ;
            $sch = $this->model_app->view_where('subdomain',array('id_sd'=>$row['id_sd']))->row_array();
            $tgl = $this->model_app->view_where('quiz_date',array('id_qd'=>$row['qp_date']))->row_array();

            $output .= "<tr>
                            <td>".$no."</td>
                            <td>".nama($row['nama_lengkap'])."</td>
                            <td>".$row['kelas']."</td>
                            <td>".$sch['nama_cabang']."</td>
                            <td>".date('d/m/Y',strtotime($tgl['tanggal']))."</td>
                            <td>".$row['qp_correct']."</td>
                            <td>".$row['qp_wrong']."</td>
                            <td>".$row['qp_poin']."</td>



                            <td>".$durasi."</td>
                            <td>".$status."</td>
                            <td>".$edit." ".$hapus."</td>

                        </tr>";
            $no++;
        }
        $output .= '
        </tbody>
        </table>';
    echo $output;
    }
    function hapusPartisipasi(){
        cek_session_akses('administrator/hapusPartisipasi',$this->session->id_session);
        $id = $this->input->post('id');
        $id_qp = $this->encrypt->decode($id,keys());
        $cek = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp));
        if($cek->num_rows() > 0 ){
            $this->model_app->delete('quiz_partisipasi',array('id_qp'=>$id_qp));
            echo true;
        }else{
            echo false;
        }

    }
    function editPartisipasi(){
        cek_session_akses('administrator/editPartisipasi',$this->session->id_session);
        $id = $this->input->get('id');
        $id_qp = $this->encrypt->decode($id,keys());
        $cek = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp));
        if($cek->num_rows() > 0 ){
            $row = $cek->row_array();
            if($row['qp_done'] == 'n' AND $row['qp_finish'] == NULL){
                $this->session->set_flashdata('message','Partisipasi ini belum selesai');
                redirect('administrator/quiz');
            }else{
                $data['row'] = $row;
                $data['tanggal'] = $this->model_app->view_where('quiz_date',array('id_qd'=>$row['qp_date']))->row_array();
                $data['siswa'] = $this->model_app->view_where('siswa',array('id_siswa'=>$row['id_siswa']))->row_array();
                $data['title'] = 'Edit Partisipasi - '.title();
                $data['page'] = 'Edit Partisipasi ';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " ><a href="'.base_url('administrator/quiz').'" >Quiz Partisipasi</a></li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current >Edit</li>';
                $data['breadcumb3']= '';
                $this->template->load('administrator/template','administrator/mod_kuis/view_partisipasi_edit',$data);
            }
            
           
        }else{
           $this->session->set_flashdata('message','Partisipasi tidak ditemukan');
           redirect('administrator/quiz');
        }
    }
    function doEditPartisipasi(){
        cek_session_akses('administrator/editPartisipasi',$this->session->id_session);
        $id = $this->input->post('id');
        $id_qp = $this->encrypt->decode($id,keys());
        $cek = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp));
        if($cek->num_rows() > 0 ){
            $data = array('qp_correct'=>$this->input->post('benar'),'qp_wrong'=>$this->input->post('salah'),'qp_poin'=>$this->input->post('poin'));
            $where = array('id_qp'=>$id_qp);
            $this->model_app->update('quiz_partisipasi',$data,$where);
            echo true;
        }else{
            $this->session->set_flashdata('message','Partisipasi tidak ditemukan');
            echo false;
        }
        
    }
    function peringkat(){
        cek_session_akses('administrator/peringkat',$this->session->id_session);
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        if($cabang['status'] == 'dinas'){
          $cbg = 'all';
        }else{
          $cbg = $cabang['id_sd'];
        }
        $data['jenis'] = $cabang['status'];
        $data['cabang'] = $cbg;
        $data['title'] = 'Peringkat - '.title();
        $data['page'] = 'Peringkat';
        $data['breadcumb1'] = ' <li class="breadcrumb-item active" aria-current >Peringkat</li>';
        $data['breadcumb2']= ' ';
            $data['breadcumb3']= '';
        $this->template->load('administrator/template','administrator/mod_kuis/view_peringkat',$data);
    }
    function date(){
        cek_session_akses('administrator/date',$this->session->id_session);
        $data['title'] = 'Tanggal Kuis - '.title();
        $data['page'] = 'Tanggal Kuis';
        $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current >Quiz</li>';
        $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current >Tanggal</li>';
            $data['breadcumb3']= '';
        $this->template->load('administrator/template','administrator/mod_kuis/view_tambah_kuis',$data);
    }
    function manajemencabang(){
        cek_session_akses('administrator/manajemencabang',$this->session->id_session);
         if($this->session->level == 'admin'){
     
                $data['record'] = $this->db->query("SELECT * FROM subdomain ORDER BY id_sd DESC");
                $data['title'] = 'Sekolah -'.title();
                $data['page'] = 'Sekolah';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Manajemen</a></li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item active" aria-current="page">Sekolah</a></li>';
                $data['breadcumb3']= ' ';
        $this->template->load('administrator/template','administrator/mod_modul/view_cabang',$data);
        }else{
           $this->session->set_flashdata('message','Anda Tidak Bisa Mengakses Halaman Ini !');
               redirect('administrator/home');
        }
    
      }
        function tambah_manajemencabang(){
        cek_session_akses('administrator/tambah_manajemencabang',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
               $config['upload_path'] = 'asset/images/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
                $config['max_size'] = '30000'; // kb
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
        
                
    
                  
                if ( ! $this->upload->do_upload('file')){
                    $this->session->set_flashdata('message','Gambar tak bisa diupliod');
                    redirect('administrator/tambah_manajemencabang');
                }else{
    
    
                $hasil=$this->upload->data();
                
                 $config1['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config1['new_image'] =  'asset/images/'.$hasil['file_name'];
                $config1['maintain_ratio'] = FALSE;
                $config1['width'] = 100;
                $config1['height'] = 100; 
                $this->load->library('image_lib', $config1); 
                if ( ! $this->image_lib->resize()){ 
                $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
    
                }
             
                
               $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'asset/images/'.$hasil['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 100;
                $config['height']   = 100;
                $this->image_lib->initialize($config);
               
                     $data = array(
                                 'sub_domain'=>$this->input->post('sub_domain'),
                                 'nama_cabang'=>$this->input->post('nama_cabang'),
                                 'status'=>$this->input->post('status'),
                                
                                 'jenis_sekolah'=>$this->input->post('jenis_sekolah'),
                                 
                                  'icon' =>base_url('asset/images/').$hasil['file_name'],
    
                                 );
                
                $this->model_app->insert('subdomain',$data);
                  $this->session->set_flashdata('success','Cabang Berhasil Ditambah');
                redirect('administrator/manajemencabang');
                }
        }else{
              
            $data['title'] = 'Sekolah -'.title();
                $data['page'] = 'Sekolah';
                $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Manajemen</a></li>';
                $data['breadcumb2']= ' <li class="breadcrumb-item " aria-current="page">Sekolah</a></li>';
                $data['breadcumb3']= ' <li class="breadcrumb-item " aria-current="page">Tambah</a></li>';
          $this->template->load('administrator/template','administrator/mod_modul/view_cabang_tambah',$data);
        }
      }
        function delete_manajemencabang(){
            cek_session_akses('administrator/delete_manajemencabang',$this->session->id_session);
     
                $id = array('id_sd' => $this->uri->segment(3));
            
            $this->model_app->delete('subdomain',$id);
        redirect($this->uri->segment(1).'/manajemencabang');
      }
      function historyuser(){
        cek_session_akses('administrator/historyuser',$this->session->id_session);
        $data['record'] = $this->model_app->view_ordering('users_history','id_uh','DESC');
          $this->template->load('administrator/template','administrator/mod_users/view_history',$data);
    
      }
      function edit_manajemencabang(){
        cek_session_akses('administrator/edit_manajemencabang',$this->session->id_session);
        $id = $this->uri->segment(3);
        if (isset($_POST['submit'])){
               $config['upload_path'] = 'asset/images/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
                $config['max_size'] = '30000'; // kb
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
        
                
    
                  
                if ( ! $this->upload->do_upload('file')){
                  $foto = $this->input->post('old_foto');
                }else{
    
    
                $hasil=$this->upload->data();
                
                 $config1['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config1['new_image'] =  'asset/images/'.$hasil['file_name'];
                $config1['maintain_ratio'] = FALSE;
                $config1['width'] = 100;
                $config1['height'] = 100; 
                $this->load->library('image_lib', $config1); 
                if ( ! $this->image_lib->resize()){ 
                $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
    
                }
             
                
               $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'asset/images/'.$hasil['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']     = 100;
                $config['height']   = 100;
                $this->image_lib->initialize($config);
                $foto = base_url('asset/images/').$hasil['file_name'];
                     
                 
                }
                $data = array(
                                 'sub_domain'=>$this->input->post('sub_domain'),
                                 'nama_cabang'=>$this->input->post('nama_cabang'),
                                 'status'=>$this->input->post('status'),
                                 'jenis_sekolah'=>$this->input->post('jenis_sekolah'),
                                
                                 
                                  'icon' =>$foto,
    
                                 );
                
                $this->model_app->update('subdomain',$data,array('id_sd'=>$this->input->post('id_sd')));
                 $this->session->set_flashdata('success','Cabang Berhasil diubah');
                redirect('administrator/manajemencabang');
        }else{
            $data['title'] = 'Sekolah - '.title();
            $data['page'] = 'Sekolah';
            $data['breadcumb1'] = ' <li class="breadcrumb-item " aria-current="page">Manajemen</a></li>';
            $data['breadcumb2']= ' <li class="breadcrumb-item " aria-current="page">Sekolah</a></li>';
            $data['breadcumb3']= ' <li class="breadcrumb-item " aria-current="page">Edit</a></li>';
          $data['row'] = $this->model_app->view_where('subdomain',array('id_sd'=>$this->uri->segment('3')))->row_array();
          $this->template->load('administrator/template','administrator/mod_modul/view_cabang_edit',$data);
        }
      }
      function count(){
        $start = date('Y-m-d');
        $end = date('Y-m-d',strtotime('+5 Days'));
        echo selisihdate($start,$end);
      }
    function updateDate(){
        $status = $this->input->post('status');
        $date = $this->input->post('tanggal');
        $kelas = $this->input->post('kelas');
        $mata_pelajaran =$this->input->post('mata_pelajaran');
        $start = date('H:i:s',strtotime($this->input->post('start')));
        $end = date('H:i:s',strtotime($this->input->post('end')));

        $count = count($mata_pelajaran);
        for($a=0;$a<$count;$a++){
          $cek = $this->model_app->view_where('quiz_date',array('tanggal'=>$date,'kelas'=>$kelas[$a]));
          if($cek->num_rows() > 0){
            $row =  $cek->row_array();
            $data = array('mapel_id'=>$mata_pelajaran[$a],'status'=>$status,'start'=>$start,'end'=>$end);
            $where = array('id_qd'=>$row['id_qd']);
            $this->model_app->update('quiz_date',$data,$where);
          }else{
            $data = array('tanggal'=>$date,'status'=>$status,'mapel_id'=>$mata_pelajaran[$a],'kelas'=>$kelas[$a],'start'=>$start,'end'=>$end);
            $this->model_app->insert('quiz_date',$data);
          }
        }
        echo true;
    }
    function forDate(){
      $start = date('2022-03-21');
      $end = date('2022-03-29');
      $startTime = new DateTime($start);
      $endTime = new DateTime($end);
      for($a=$startTime;$a<=$endTime;$a->modify('+1 day')){
        $date =$a->format("Y-m-d");
       
          echo $date;
          echo "<br>";
        
       
      }
      
    }
    function getBulanDate(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $startTime = new DateTime($start);
        $endTime = new DateTime($end);
        // $count = intval(selisihdate($start,$end));
        $output = null;
        // $bulan = $this->input->post('bulan');
        // $tgl= date('Y').'-'.$bulan.'-01';
        // //$bulan = date('m',strtotime($bul));
        // $awal =  date("Y-n-01",strtotime($tgl));
        // $akhir = date("Y-n-t",strtotime($tgl));
        // $output="";
        // $from= date('j',strtotime($awal));
        // $end = date('j',strtotime($akhir));
       
        
        for($a=$startTime;$a<=$endTime;$a->modify('+1 day')){
            // $dt = date('Y').'-'.$bulan.'-'.$a;
            // $tanggal = $start;
            $date =$a->format("Y-m-d");


            $cek = $this->model_app->view_where('quiz_date',array('tanggal'=>$date));
         
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $start = date('H:i',strtotime($row['start']));
                $end = date('H:i',strtotime($row['end']));

                if($row['status'] == 'y'){
                    $status = "<option value='y' selected>Aktif</option><option value='n'>Tidak Aktif</option>";
                  
                }else{
                     $status = "<option value='y' >Aktif</option><option value='n' selected>Tidak Aktif</option>";
                   
                }
              }else{
                $status = "<option value='y' >Aktif</option><option value='n' >Tidak Aktif</option>";
                $start = '10:00';
                $end = '21:00';
              }
               
         
                
                 $output .= "<div class='card my-3'>
                              <div class='card-header'>
                                  <h4>".date('d/m/Y',strtotime($date))."</h4>
                              </div>
                              <div class='card-body'>
                              <form class='formDate'>
                                <div class='row'>
                                   
                                    <div class='col-lg-12 form-group'>
                                      <input type='hidden' name='tanggal' value='".$date."'>
                                        <label>Status</label>
                                        <select name='status' id='status".$a."' class='form-control status'  onchange='getval(this,".$a.")';>
                                           ".$status."
                                        </select>

                                    </div>
                                    <div class='col-lg-6 form-group'>
                                      <label>Start</label>
                                      <input type='time' class='form-control' name='start' value='".$start."' >
                                    </div>
                                     <div class='col-lg-6 form-group'>
                                      <label>End</label>
                                      <input type='time' class='form-control' name='end' value='".$end."' >
                                    </div>
                                    <div class='col-12 form-group formMapel' >
                                      <div class='row'>
                                      ";
                                      for($x=1;$x<=12;$x++){
                                        $matpel = $this->model_app->view_where('mata_pelajaran',array('mapel_kelas'=>romawi($x)));
                                        $output .= "
                                        <div class='col-4 form-group'>
                                            <label>Kelas : ".romawi($x)."</label>
                                            <input type='hidden' name='kelas[]' value='".romawi($x)."'>
                                            <select name='mata_pelajaran[]' class='form-control' >
                                            ";
                                        if($matpel->num_rows() > 0){
                                          foreach($matpel->result_array() as $mp){
                                            if($cek->num_rows() > 0){
                                              $row1 = $cek->row_array();
                                              if($row1['mapel_id'] == $mp['mapel']){
                                                  $output .= "<option value='".$mp['mapel_id']."' selected>".$mp['mapel']."</option>";

                                              }else{
                                              $output .= "<option value='".$mp['mapel_id']."'>".$mp['mapel']."</option>";

                                              }
                                            }else{
                                              $output .= "<option value='".$mp['mapel_id']."'>".$mp['mapel']."</option>";
                                            }
                                            
                                          }
                                        }
                                        $output .= "
                                            </select>
                                        </div>
                                        ";
                                      }
                                     
                                      $output .= "
                                      </div>
                                    </div>
                                    <div class='col-12 form-group'>
                                        <button class='btn btn-primary w-100'>Simpan</button>
                                    </div>
                                  
                                    

                                </div>
                               
                              </form>
                              </div>
                            </div>";
           
        }
        echo $output; 
        // $output .= "<div class='col-lg-12 mt-3 mb-3'><input type='submit' value='UPDATE' class='btn btn-primary ' style='width:100%'></div>";
        
       
    }
    function delete_soal()
    {
        $id = $this->uri->segment('3');
        $data = array('status'=>'n');
        $where = array('id_quiz'=>$id);
        $this->model_app->update('quiz', $data, $where);
        redirect('administrator/soal');
    }
    function edit_soal()
    {
        if(isset($_POST['submit'])){
            $config['upload_path'] = 'asset/foto_soal/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
             $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $hasil=$this->upload->data();
            
            $config['source_image'] = 'asset/foto_soal/'.$hasil['file_name'];
            $config['wm_text'] = 'madamcha02.com';
            $config['wm_type'] = 'text';
            $config['wm_font_path'] = './system/fonts/texb.ttf';
            $config['wm_font_size'] = '26';
            $config['wm_font_color'] = 'ffffff';
            $config['wm_vrt_alignment'] = 'middle';
            $config['wm_hor_alignment'] = 'center';
            $config['wm_padding'] = '20';
            $this->load->library('image_lib',$config);
            $this->image_lib->watermark();
            if ($hasil['file_name']==''){

                $data = array('quiz' => $this->input->post('soal'),
                              'answer_a'=>$this->input->post('a'),
                              'answer_b'=>$this->input->post('b'),
                              'answer_c'=>$this->input->post('c'),
                              'answer_d'=>$this->input->post('d'),
                              'answer'=>$this->input->post('answer'),


                             );
            }else
            {
                 $data = array('quiz' => $this->input->post('soal'),
                              'answer_a'=>$this->input->post('a'),
                              'answer_b'=>$this->input->post('b'),
                              'answer_c'=>$this->input->post('c'),
                              'answer_d'=>$this->input->post('d'),
                              'answer'=>$this->input->post('answer'),
                              'image' =>$hasil['file_name'],

                             );
            }
            $where = array('id_quiz'=>$this->input->post('id'));
            $this->model_app->update('quiz', $data, $where);
            redirect('administrator/soal');
        }else{
        $id = $this->uri->segment('3');
        $data['rows'] = $this->model_app->view_where('quiz',array('id_quiz'=>$id))->row_array();
        $this->template->load('administrator/template','administrator/additional/mod_soal/edit_soal',$data);

        }
    }
    // function kuis()
    // {
    //      cek_session_akses('kuis',$this->session->id_session);


    //     if(isset($_POST['search']))
    //     {
    //         $start = $this->input->post('start');
    //         $end = $this->input->post('end');
    //         $konsumen = $this->input->post('konsumen');
    //         $status = $this->input->post('status');

    //     }else{
        

    //        $start = date('Y-m-01');
    //        $end = date('Y-m-d');
    //        $konsumen = 'all';
    //        $status = '50';

        

    //     }

    //     $data['start'] = $start;
    //     $data['end'] = $end;
    //     $data['status'] =$status;
    //     $data['konsumen'] = $this->model_app->view('rb_konsumen');
    //     $data['kuis'] = $this->model_app->get_quiz($start,$end,$konsumen,$status);
    //     $data['board'] = $this->model_app->search_quiz_board($start,$end,$status,100);
    //     $this->template->load('administrator/template','administrator/additional/mod_soal/view_all_kuis',$data);
    // }

    function kuis(){
         cek_session_akses('administrator/kuis',$this->session->id_session);
          if(isset($_POST['search']))
        {
          $data['bulan'] = $this->input->post('bulan');
          $data['status'] = $this->input->post('status');

        }else{
        
            $data['bulan'] =  date('n');
            $data['status'] = 'all';
        }
        $data['record'] = $this->model_app->get_kuis($data['bulan'],$data['status']);
        $this->template->load('administrator/template','administrator/mod_kuis/view_kuis',$data);
        

    //     
    }
    function addKuis(){
        $data['arr'] = null;
        $this->template->load('administrator/template','administrator/mod_kuis/view_tambah_kuis',$data);
    }
    function detailKuis(){
        $id = $this->uri->segment('3');
        $cek = $this->model_app->view_where('quiz_date',array('qd_id'=>$id));
        if($cek->num_rows() > 0){

        if(isset($_POST['search']))
        {
         
            $data['konsumen'] = $this->input->post('konsumen');
          

        }else{
        

        
           $data['konsumen'] = 'all';
         

        

        }
            $data['id'] = $id;
            $data['pengguna'] = $this->model_app->view_ordering('rb_konsumen','nama_lengkap','ASC');
            $data['row'] = $cek->row_array();

            $data['record'] = $this->model_app->quiz_detail($id,$data['konsumen']);
            $this->template->load('administrator/template','administrator/mod_kuis/view_detail_kuis',$data);
        }else{
            $this->session->set_flashdata('message','Data Tidak Ditemukan!');
            redirect('administrator/kuis');
        }
    }
    function addPoin(){
        $id_konsumen = $this->input->post('konsumen');
        $qd_id = $this->input->post('qd_id');
        $poin = $this->input->post('poin');
        $cek = $this->model_app->view_where('quiz_partisipasi',array('id_konsumen'=>$id_konsumen,'qd_id'=>$qd_id));
        if($cek->num_rows() > 0){
            $this->session->set_flashdata('message','Pengguna ini sudah melakukan kuis pada tanggal ini!');
            redirect('administrator/detailKuis/'.$qd_id);

        }else{
            $data = array('id_konsumen'=>$id_konsumen,'qd_id'=>$qd_id,'qp_benar'=>50,'qp_salah'=>0,'qp_status'=>'50','qp_poin'=>$poin,'qp_finish'=>date('Y-m-d H:i:s'),'qp_selesai'=>'y');
            $this->model_app->insert('quiz_partisipasi',$data);
            $this->session->set_flashdata('success','Poin Berhasil Ditambah');
              redirect('administrator/detailKuis/'.$qd_id);

        }
    }
    function doAddKuis(){
        $date = $this->input->post('tanggal');
        $status = $this->input->post('status');
       

        $count = count($date);
        for($a=0;$a<$count;$a++){
            $cek = $this->model_app->view_where('quiz_date',array('tanggal'=>$date[$a]));
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                if($status[$a] == 'y'){
                    $dat = array('status'=>'y');
                }else{
                    $dat = array('status'=>'n');
                }
                $this->model_app->update('quiz_date',$dat,array('tanggal'=>$date[$a]));
            }else{
                 if($status[$a] == 'y'){
                    $data = array('status'=>'y','tanggal'=>$date[$a]);
                }else{
                    $data = array('status'=>'n','tanggal'=>$date[$a]);
                }
                $this->model_app->insert('quiz_date',$data);
            }
        }
        $this->session->set_flashdata('success','Tanggal Kuis Berhasil Ditambah');
        redirect('administrator/date');
    }
    function sliderwebsite()
    {
        $data['slider'] = $this->model_app->view('slider');
        $this->template->load('administrator/template','administrator/mod_tebak/view_slider',$data);

    }
    function tambah_slider()
    {
        if(isset($_POST['submit']))
        {
            $config['upload_path'] = 'asset/slider/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '30000'; // kb
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
    
            

              
            if ( ! $this->upload->do_upload('file')){
                $this->session->set_flashdata('message','Gambar tak bisa diupliod');
                redirect('administrator/tambah_slider');
            }else{


            $hasil=$this->upload->data();
            
             $config1['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config1['new_image'] =  'asset/slider/'.$hasil['file_name'];
            $config1['maintain_ratio'] = FALSE;
            $config1['width'] = 1350;
            $config1['height'] = 800; 
            $this->load->library('image_lib', $config1); 
            if ( ! $this->image_lib->resize()){ 
            $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));

            }
         
            
           $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'asset/slider/'.$hasil['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 1350;
            $config['height']   = 800;
            $this->image_lib->initialize($config);
           
                 $data = array(
                              
                             
                              'gambar' =>$hasil['file_name'],

                             );
            
            $this->model_app->insert('slider',$data);
              $this->session->set_flashdata('success','Slider Berhasil Diubah');
            redirect('administrator/sliderwebsite');
            }

        }else{

        $this->template->load('administrator/template','administrator/mod_tebak/add_slider');
    }
    } 
    function edit_slider()
    {

        if(isset($_POST['submit'])){
              $config['upload_path'] = 'asset/slider/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '30000'; // kb
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
    
            

              
            if ( ! $this->upload->do_upload('file')){
                $this->session->set_flashdata('message','Gambar tak bisa diupliod');
                redirect('administrator/tambah_slider');
            }else{


            $hasil=$this->upload->data();
            
             $config1['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config1['new_image'] =  'asset/slider/'.$hasil['file_name'];
            $config1['maintain_ratio'] = FALSE;
            $config1['width'] = 1350;
            $config1['height'] = 800; 
            $this->load->library('image_lib', $config1); 
            if ( ! $this->image_lib->resize()){ 
            $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));

            }
        
            
           $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'asset/slider/'.$hasil['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 1350;
            $config['height']   = 800;
            $this->image_lib->initialize($config);
           
                 $data = array(
                              
                             
                              'gambar' =>$hasil['file_name'],

                             );
              $where = array('id_gambar'=>$this->input->post('id'));
         
                
            $this->model_app->update('slider',$data,$where);
            $this->session->set_flashdata('success','Slider Berhasil Diubah');
            redirect('administrator/sliderwebsite');
         }
        }else{
        $id = $this->uri->segment('3');
        $data['row'] = $this->model_app->view_where('slider',array('id_gambar'=>$id))->row_array();
        $this->template->load('administrator/template','administrator/mod_tebak/edit_slider',$data);
        }
    }
    function hapus_slider(){
        $id = $this->uri->segment('3');
        $cek = $this->model_app->view_where('slider',array('id_gambar'=>$id));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $path = './asset/slider/'.$row['gambar'] ;
           
          
            unlink($path);

            $this->model_app->delete('slider',array('id_gambar'=>$id));
            $this->session->set_flashdata('success','Slider berhasil dihapus');
            redirect('administrator/sliderwebsite');

        }else{
            $this->session->set_flashdata('message','Slider tidak ditemukan');
            redirect('administrator/sliderwebsite');
        }
        
    }
    function videowebsite()
    {
        // if(isset($_POST['submit']))
        // {
        //     $where = array('id_video'=>$this->input->post('id'));
        //     $data = array('link'=> $this->input->post('link'));

        //     $this->model_app->update('video_embed',$data,$where);
        //     redirect('administrator/videowebsite');
        // }else{

        $data['record'] = $this->model_app->view('video_embed')->result_array();
        $this->template->load('administrator/template','administrator/mod_tebak/view_video',$data);
        
    }
    function tambah_videoweb(){
      $data['arr'] = null;
         $this->template->load('administrator/template','administrator/mod_tebak/view_tambah_video',$data);
    }
    function uploadVideo(){
           $configVideo['upload_path'] = 'asset/video'; # check path is correct
        $configVideo['max_size'] = '502400';
        $configVideo['allowed_types'] = 'mp4|mkv|avi'; # add video extenstion on here
        $configVideo['overwrite'] = FALSE;
        $configVideo['remove_spaces'] = TRUE;
        $configVideo['encrypt_name'] = TRUE;

        $this->load->library('upload', $configVideo);
        $this->upload->initialize($configVideo);
        $upload = 0;
            if (!$this->upload->do_upload('file')) # form input field attribute
            {
                # Upload Failed
                $upload = 0;

            }
            else
            {
                 $dataupload = $this->upload->data();
                # Upload Successfull
                $user = $this->session->username;
                $data = array('video'=>$dataupload['file_name']);
                $this->model_app->insert('video_embed',$data);
                $upload = 1;
            }

            echo $upload;
            
    }
    function edit_videoweb()
    {
      
             $id= $this->uri->segment('3');
             $data['row'] = $this->model_app->view_where('video_embed',array('id_video'=>$id))->row_array();
             $this->template->load('administrator/template','administrator/mod_tebak/edit_video',$data);

        

    }
    function delete_videoweb(){
         $id = $this->uri->segment('3');
        $cek = $this->model_app->view_where('video_embed',array('id_video'=>$id));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $path = './asset/video/'.$row['video'] ;
           
          
            unlink($path);

            $this->model_app->delete('video_embed',array('id_video'=>$id));
            $this->session->set_flashdata('success','Video berhasil dihapus');
            redirect('administrator/videowebsite');

        }else{
            $this->session->set_flashdata('message','Video tidak ditemukan');
            redirect('administrator/videowebsite');
        }
    }
    function editVideo(){
        $video = $this->input->post('video');
        $path = './asset/video/'.$video;
           
          
        unlink($path);
        $id = $this->input->post('id');

        $configVideo['upload_path'] = 'asset/video'; # check path is correct
        $configVideo['max_size'] = '502400';
        $configVideo['allowed_types'] = 'mp4|mkv|avi'; # add video extenstion on here
        $configVideo['overwrite'] = FALSE;
        $configVideo['remove_spaces'] = TRUE;
        $configVideo['encrypt_name'] = TRUE;

        $this->load->library('upload', $configVideo);
        $this->upload->initialize($configVideo);
        $upload = 0;
            if (!$this->upload->do_upload('file')) # form input field attribute
            {
                # Upload Failed
                $upload = 0;

            }
            else
            {
                 $dataupload = $this->upload->data();
                # Upload Successfull
                $user = $this->session->username;
                $data = array('video'=>$dataupload['file_name']);
                $where = array('id_video'=>$id);
                $this->model_app->update('video_embed',$data,$where);
                $upload = 1;
            }

            echo $upload;
            
    }
    function popup(){
         $data['record'] = $this->model_app->view_ordering('popup','id_popup','DESC');
        $this->template->load('administrator/template','administrator/mod_tebak/view_popup',$data);
    }
    function tambahPopUp(){
      $data['arr']= null;
         $this->template->load('administrator/template','administrator/mod_tebak/view_popup_add',$data);
    }
     function deletePopup(){
        $id = $this->uri->segment('3');
        $cek = $this->model_app->view_where('popup',array('id_popup'=>$id));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $path = './asset/popup/'.$row['file'] ;
           
          
            unlink($path);

            $this->model_app->delete('popup',array('id_popup'=>$id));
            $this->session->set_flashdata('success','Popup berhasil dihapus');
            redirect('administrator/popup');

        }else{
            $this->session->set_flashdata('message','Popup tidak ditemukan');
            redirect('administrator/popup');
        }
        
    }
    function editPopUp(){
        $id = $this->uri->segment('3');
        $cek = $this->model_app->view_where('popup',array('id_popup'=>$id));
        if($cek->num_rows() > 0 ){
         $data['row'] = $cek->row_array();
         $this->template->load('administrator/template','administrator/mod_tebak/view_popup_edit',$data);
        }else{
            $this->session->set_flashdata('message','Popup tidak ditemukan');
            redirect('administrator/popup');
        }
    }
    function uploadPopup(){
         $configVideo['upload_path'] = 'asset/popup'; # check path is correct
        $configVideo['max_size'] = '502400';
        $configVideo['allowed_types'] = 'mp4|mkv|avi|jpg|png|jpeg|gif'; # add video extenstion on here
        $configVideo['overwrite'] = FALSE;
        $configVideo['remove_spaces'] = TRUE;
        $configVideo['encrypt_name'] = TRUE;

        $this->load->library('upload', $configVideo);
        $this->upload->initialize($configVideo);
        $upload = 0;
            if (!$this->upload->do_upload('file')) # form input field attribute
            {
                # Upload Failed
                $upload = 0;

            }
            else
            {
                 $dataupload = $this->upload->data();
                 $filename = $dataupload['file_name'];
                 $ext = pathinfo($filename, PATHINFO_EXTENSION);

                 $foto = array('gif', 'png', 'jpg','jpeg');
                 if (in_array($ext, $foto)) {
                        $type =  "image";
                }else{
                    $type =  "video";
                }
                # Upload Successfull
                $user = $this->session->username;
                $data = array('type'=>$type,'file'=>$dataupload['file_name']);
                $this->model_app->insert('popup',$data);
                $upload = 1;
            }
            echo $upload;
           
    }
    function updatePopup(){
          $old = $this->input->post('old');
        $path = './asset/popup/'.$old;
           
          
        unlink($path);
        $id = $this->input->post('id');
         $configVideo['upload_path'] = 'asset/popup'; # check path is correct
        $configVideo['max_size'] = '502400';
        $configVideo['allowed_types'] = 'mp4|mkv|avi|jpg|png|jpeg|gif'; # add video extenstion on here
        $configVideo['overwrite'] = FALSE;
        $configVideo['remove_spaces'] = TRUE;
        $configVideo['encrypt_name'] = TRUE;

        $this->load->library('upload', $configVideo);
        $this->upload->initialize($configVideo);
        $upload = 0;
            if (!$this->upload->do_upload('file')) # form input field attribute
            {
                # Upload Failed
                $upload = 0;

            }
            else
            {
                 $dataupload = $this->upload->data();
                 $filename = $dataupload['file_name'];
                 $ext = pathinfo($filename, PATHINFO_EXTENSION);

                 $foto = array('gif', 'png', 'jpg','jpeg');
                 if (in_array($ext, $foto)) {
                        $type =  "image";
                }else{
                    $type =  "video";
                }
                # Upload Successfull
                $user = $this->session->username;
                $data = array('type'=>$type,'file'=>$dataupload['file_name']);
                $where = array('id_popup'=>$id);
                $this->model_app->update('popup',$data,$where);
                $upload = 1;
            }
            echo $upload;
           
    }
    function chat(){
      $data['arr'] = null;
        $this->template->load('administrator/template','administrator/mod_tebak/view_chat',$data);
    }
     function detailChatShow(){
        $data = $this->db->query("SELECT a.id_ca,a.konsumen,a.untuk,a.`read`,a.alur,a.tanggal,b.nama_lengkap,a.created_at FROM chat_admin a JOIN rb_konsumen b ON a.konsumen = b.id_konsumen
      WHERE a.id_ca IN (SELECT MAX(id_ca) FROM chat_admin  GROUP BY konsumen)  GROUP BY a.konsumen ORDER BY created_at DESC ");;
         $output = "";
         foreach($data->result_array() as $row){
               $date = date('Y-m-d',strtotime($row['tanggal']));
                  $time = date('H:i',strtotime($row['tanggal']));
                  $yes = date('Y-m-d', strtotime($date. ' +1 days'));
                  $now = date('Y-m-d');
                  $dt = date('d/m',strtotime($row['tanggal']));

                  $count = date('Ymd') - $yes;

                  if($date == $now){
                    $chat_time = $time;
                  }elseif($yes  == $now){
                    $chat_time = 'Kemarin';
                  }else {
                    $chat_time = $dt;
                  }
          
            $buy = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$row['konsumen']))->row_array();
             $name = $buy['nama_lengkap'];
            $foto = 'avatar'.rand(1,5).'.png';
          

            
         $pp = "";
        if (!file_exists("asset/foto_user/$foto") OR $foto==''){
                        $pp = base_url('asset/foto_user/blank.png');
        }else{
                        $pp = base_url('asset/foto_user/').$foto;
        }
        if($row['read'] == 'n' ){
            $output .= "<div class='chat_list' id='detailChatShow' data-id='".$row['konsumen']."' >
                                          <div class='chat_people'>
                                        <div class='chat_img'> <img src='".$pp."' alt='sunil'> </div>
                                            <div class='chat_ib'>
                                              <h5><b>".$name."</b> </h5>
                                              <h5><b>".$chat_time."</b></h5>
                                            </div>
                                          </div>
                                        </div>";
        }else{
             $output .= "<div class='chat_list' id='detailChatShow' data-id='".$row['konsumen']."'  >
                                          <div class='chat_people'>
                                        <div class='chat_img'> <img src='".$pp."' alt='sunil'> </div>
                                            <div class='chat_ib'>
                                              <h5>".$name."</h5>
                                              <h5>".$chat_time."</h5>
                                            </div>
                                          </div>
                                        </div>";
        }
         }
         echo $output;
       
  }
   function kirimWablas($phone,$msg)
    {

        $link  =  "https://us.wablas.com//api/send-message";
        $data = [
        'phone' => $phone,
        'message' => $msg,
        ];
         
         
        $curl = curl_init();
        $token =  "Vz6Pn24cz0chEYCJXpG5kcZX0doAHJKzqGAxz2iC0sr7cOUzzpj0XGReVkcir3ZK";
 
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl); 
        return $result;
}
   function broadcast(){
        $cus = $this->input->post('konsumen');
     
        $status = $this->input->post('statusBrd');
        $count = count($cus);
        $user = $this->session->username;
           $insert_fj = array();
           if($status == 'teks'){
             for($i = 0; $i < $count; $i++)
                {
                    $kon = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$cus[$i]))->row_array();
                    $hp = noHp($kon['no_hp']);
                    $pesan =  $this->input->post('teks');
                    $this->kirimWablas($hp,$pesan);

                    
                    $insert_fj[] = array(
                      'konsumen' => $cus[$i],
                      'untuk'=>'admin',
                      'teks'=>$this->input->post('teks'),
                      'type'=>'teks',
                      'tanggal'=>date('Y-m-d H:i:s'),
                      'alur'=>'admin-konsumen',
                      'read'=>'n',
                      'chat_by'=>$user

                     
                       
                        
                    );
                }
                 $this->db->insert_batch('chat_admin', $insert_fj);
                   $this->session->set_flashdata('success','Broadcast Berhasil!');
            }else{
                 $config['upload_path']          = './asset/chat/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000;
                $config['encrypt_name'] = TRUE;
                
                
              
                
               

                $this->load->library('upload', $config);

              
                if ( ! $this->upload->do_upload('file')){
                    
                    $this->session->set_flashdata('message','File Gagal Diupload');
                    
                }else{
                    $f = $this->upload->data();
                     for($i = 0; $i < $count; $i++)
                        {


                            
                            $insert_fj[] = array(
                              'konsumen' => $cus[$i],
                              'untuk'=>'admin',
                              'teks'=>$f['file_name'],
                              'type'=>'file',
                              'tanggal'=>date('Y-m-d H:i:s'),
                             'alur'=>'admin-konsumen',
                              'read'=>'n',
                              'chat_by'=>$user

                             
                               
                                
                            );
                        }
                         $this->db->insert_batch('chat_admin', $insert_fj);
                         $this->session->set_flashdata('success','Broadcast Berhasil!');
                
                }
                

            }

           
           redirect('administrator/chat');
    }
    function searchCus(){
        $search = $this->input->post('search');
        $output = "";
       
            $data = $this->db->query("SELECT * FROM rb_konsumen WHERE nama_lengkap LIKE '%".$search."%' OR no_hp LIKE '%".$search."%' ");
            if($data->num_rows() > 0){

                foreach($data->result_array() as $row){
                      $foto = 'avatar'.rand(1,5).'.png';
                      if($foto == ""){
                            $foto = base_url('asset/foto_user/blank.png');
                        }else{
                            $foto = base_url('asset/foto_user/').$foto;
                        }
                    $output .= "     <div class='chat_list' id='detailChatShow' data-id='".$row['id_konsumen']."'  >
                                          <div class='chat_people'>
                                        <div class='chat_img'> <img src='".$foto."' alt='sunil'> </div>
                                            <div class='chat_ib'>
                                              <h5><b>".$row['nama_lengkap']."</b> </h5>
                                             <h5 class='text-muted'>".$row['no_hp']."</h5>
                                              
                                            </div>
                                          </div>
                                        </div>";
                }

            }else{
                 $output = "<div class='chat_list' id='detailChatShow'  >
                                          <div class='chat_people'>
                                          </div>
                                           <h5><b>Data Tidak Ditemukan</b> </h5>
                                          </div>";
            }
        
        echo $output;

    }
      function updateChat(){
    $id_pegawai = $this->input->post('id');
  
    $data = array('read'=>'y');
    $where = array('konsumen'=>$id_pegawai,'alur'=>'konsumen-admin');
    $this->model_app->update('chat_admin',$data,$where);
  }
  function fetch_chat(){
    $id = $this->input->post('id');
    $data = $this->db->query("SELECT * FROM chat_admin   WHERE konsumen = '".$id."' ORDER BY tanggal ASC");
    $output = "";
          $foto = 'avatar'.rand(1,5).'.png';
    foreach($data->result_array() as $row){
           $date = date('Y-m-d',strtotime($row['tanggal']));
                  $time = date('H:i',strtotime($row['tanggal']));
                  $yes = date('Y-m-d', strtotime($date. ' +1 days'));
                  $now = date('Y-m-d');
                  $dt = date('d/m',strtotime($row['tanggal']));

                  $count = date('Ymd') - $yes;

                  if($date == $now){
                    $chat_time = $time;
                  }elseif($yes  == $now){
                    $chat_time = 'Kemarin';
                  }else {
                    $chat_time = $dt;
                  }
       
            $buy = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$row['konsumen']))->row_array();
             $name = $buy['nama_lengkap'];
   
         

        
        $pp = "";
        if (!file_exists("asset/foto_user/$foto") OR $foto==''){
                        $pp = base_url('asset/foto_user/blank.png');
        }else{
                        $pp = base_url('asset/foto_user/').$foto;
        }
        if($row['alur'] == 'admin-konsumen'){
            if($row['type'] == 'teks'){
                $output .= "<div class='outgoing_msg mb-2'>
                                      <div class='sent_msg'>
                                      <p>".$row['teks']."</p>
                                      <span class='time_date'> ".$chat_time." </span> </div>
                                      </div>";
            }else {
                 $output .= "<div class='outgoing_msg mb-2'>
                                      <div class='sent_msg'>
                                    <img src='".base_url('asset/chat/').$row['teks']."' class='img-fluid lazyload'>
                                      <span class='time_date'> ".$chat_time." </span> </div>
                                      </div>";
            }

        } else if($row['alur'] == 'konsumen-admin' ){
            if($row['type'] == 'teks'){
                $output .= "<div class='incoming_msg mb-2'>
                                            <div class='incoming_msg_img'>
                                           <img src='".$pp."' alt='sunil' class='lazyload'>
                                           </div>
                                           <div class='received_msg'>
                                           <div class='received_withd_msg'>
                                           <p>".$row['teks']."</p>
                                           <span class='time_date'>   ".$chat_time." </span></div></div>
                                           </div>";
            }else{
                  $output .= "<div class='incoming_msg mb-2'>
                                            <div class='incoming_msg_img'>
                                           <img src='".$pp."' alt='sunil' class='lazyload'>
                                           </div>
                                           <div class='received_msg'>
                                           <div class='received_withd_msg'>
                                           <img src='".base_url('asset/chat/').$row['teks']."' class='img-fluid lazyload'>
                                           <span class='time_date'>   ".$chat_time." </span></div></div>
                                           </div>";
            }
        }
        
    }
    echo $output;
  }
   function sendchat(){
  $username = $this->session->username;
  $id_peg = $this->input->post('id_peg');
  $chat = $this->input->post('chat');
  
  $tgl = date('Y-m-d H:i:s');

  $data = array('konsumen'=>$id_peg,'untuk'=>$username,'teks'=>$chat,'tanggal'=>$tgl,'type'=>'teks','alur'=>'admin-konsumen','read'=>'n','chat_by'=>$username);
  $this->model_app->insert('chat_admin',$data);
}
  public function datachat()
  {

    $data = $this->db->query("SELECT * FROM chat_admin WHERE   `read` ='n' AND alur = 'konsumen-admin' GROUP BY konsumen ")->num_rows();
    
  
    echo json_encode($data);
  }
  function chatCome(){
       $data = $this->db->query("SELECT a.id_ca,a.konsumen,a.untuk,a.`read`,a.alur,a.tanggal,b.nama_lengkap,a.created_at FROM chat_admin a JOIN rb_konsumen b ON a.konsumen = b.id_konsumen
      WHERE a.id_ca IN (SELECT MAX(a.id_ca) FROM chat_admin  GROUP BY a.konsumen)  AND `read` = 'n' AND alur ='konsumen-admin' GROUP BY a.konsumen ORDER BY created_at DESC ");;
         $output = "";
         foreach($data->result_array() as $row){
               $date = date('Y-m-d',strtotime($row['tanggal']));
                  $time = date('H:i',strtotime($row['tanggal']));
                  $yes = date('Y-m-d', strtotime($date. ' +1 days'));
                  $now = date('Y-m-d');
                  $dt = date('d/m',strtotime($row['tanggal']));

                  $count = date('Ymd') - $yes;

                  if($date == $now){
                    $chat_time = $time;
                  }elseif($yes  == $now){
                    $chat_time = 'Kemarin';
                  }else {
                    $chat_time = $dt;
                  }
          
            $buy = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$row['konsumen']))->row_array();
             $name = $buy['nama_lengkap'];
            $foto = 'avatar'.rand(1,5).'.png';
          

            
         $pp = "";
        if (!file_exists("asset/foto_user/$foto") OR $foto==''){
                        $pp = base_url('asset/foto_user/blank.png');
        }else{
                        $pp = base_url('asset/foto_user/').$foto;
        }
        if($this->uri->segment('2') == 'chat'){
        $output .= "

                                    <li >
                                  <a  href='#load_data'  id='detailChatShow' data-id='".$row['konsumen']."'>
                                    <div class='pull-left'>
                                      <img src='".$pp."' class='img-circle' alt='User Image'>
                                    </div>
                                    <h4>$row[nama_lengkap]<small><i class='fa fa-clock-o'></i> $chat_time</small></h4>
                                   
                                  </a>
                                </li>
                                    ";
        }else{
             $output .= "

                                       <li >
                                  <a href='".base_url('administrator/chat#load_data')."'  id='detailChatShow' data-id='".$row['konsumen']."''>
                                    <div class='pull-left'>
                                      <img src='".$pp."' class='img-circle' alt='User Image'>
                                    </div>
                                    <h4>$row[nama_lengkap]<small><i class='fa fa-clock-o'></i> $chat_time</small></h4>
                                  
                                  </a>
                                </li>

                                    ";
        }
         }
         echo $output;
       
  }
 function addImageChatAdmin(){
                          $config['upload_path'] =  './asset/chat/'; 
                          $config['allowed_types'] = 'jpg|jpeg|png|gif';
                          $config['max_size'] = '20000';
                          $config['encrypt_name'] = TRUE;
                       

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')){
            $status = "error";
           
        }
        else{
            $to = $this->input->post('to');
          
            $kode = $this->session->username;
            $dataupload = $this->upload->data();
            $status = "success";
         
            $data = array('konsumen'=>$to,'untuk'=>'admin','teks'=>$dataupload['file_name'],'tanggal'=>date('Y-m-d H:i:s'),'read'=>'n','type'=>'file','alur'=>'admin-konsumen','chat_by'=>$kode);
            $this->model_app->insert('chat_admin',$data);

            
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status)));
    }
    function cek_notif()
    {
        $time = mdate("%H:%i:%s");
        $date = mdate("%Y-%m-%d");
        $data = $this->db->query("SELECT *, count(id_ta) as jml FROM `angka`  LEFT JOIN `tebak_angka` ON `angka`.`id_angka`=`tebak_angka`.`id_angka` JOIN `rb_konsumen` ON `rb_konsumen`.`id_konsumen` = `tebak_angka`.`id_konsumen` WHERE end >= '$time' AND start <= '$time' AND date = '$date' ");
     
        foreach($data->result_array() as $row){
            if($row['angka'] == $row['tebak']){

               $count = $row['jml'];
            }
        }
       if($count > 0)
       {
        echo $count;
       }
        
    }

    function riwayatpoin()
    {

        cek_session_akses('riwayatpoin',$this->session->id_session);

        $data['riwayat'] = $this->db->query("SELECT * FROM `poin_history` a INNER JOIN `poin` b ON a.id_poin = b.id_poin INNER JOIN `rb_konsumen` c ON a.id_konsumen = c.id_konsumen ORDER BY id_ph DESC");
        $this->template->load('administrator/template','administrator/additional/mod_poin/view_riwayat',$data);
    
    }
    function poin()
    {

        cek_session_akses('poin',$this->session->id_session);

        $data['poin'] = $this->model_app->view('poin');
        $this->template->load('administrator/template','administrator/additional/mod_poin/view_poin',$data);
    
    }
    function tambah_poin()
    {
        if(isset($_POST['submit'])){
            $start = mdate('%Y-%m-%d %H:%i:00',strtotime($this->input->post('mulai')));
            $end = mdate('%Y-%m-%d %H:%i:00',strtotime($this->input->post('selesai')));

            $data = array('judul'=>$this->input->post('judul'),
                          'keterangan'=>$this->input->post('keterangan'),
                          'poin'=>$this->input->post('poin'),
                          'link'=>$this->input->post('link'),
                          'tombol'=>$this->input->post('tombol'),
                          'status'=>$this->input->post('status'),
                           'jenis'=>$this->input->post('jenis'),
                           'mulai'=>$start,
                            'selesai'=>$end);
            $this->model_app->insert('poin',$data);
            redirect('administrator/poin');
        }
        else{
        $this->template->load('administrator/template','administrator/additional/mod_poin/add_poin');
        }
    }
    function edit_poin()
    {
        if(isset($_POST['submit']))
        {
              $start = mdate('%Y-%m-%d %H:%i:00',strtotime($this->input->post('mulai')));
            $end = mdate('%Y-%m-%d %H:%i:00',strtotime($this->input->post('selesai')));
              $data = array('judul'=>$this->input->post('judul'),
                          'keterangan'=>$this->input->post('keterangan'),
                          'poin'=>$this->input->post('poin'),
                          'link'=>$this->input->post('link'),
                          'tombol'=>$this->input->post('tombol'),
                          'status'=>$this->input->post('status'),
                          'jenis'=>$this->input->post('jenis'),
                           'mulai'=>$start,
                            'selesai'=>$end);

              $where = array('id_poin'=>$this->input->post('id'));

              $this->model_app->update('poin',$data,$where);
              redirect('administrator/poin');
            

        }else{
            $id = $this->uri->segment('3');
            $data['row'] = $this->model_app->view_where('poin',array('id_poin'=>$id))->row_array();
            $this->template->load('administrator/template','administrator/additional/mod_poin/edit_poin',$data);

        }

    }
      function delete_poin()
    {
        $id = $this->uri->segment('3');
    
        $where = array('id_poin'=>$id);
        $this->model_app->delete('poin', $where);
        redirect('administrator/poin');
    }

    function tambah_poin_user()

    {
        $id = $this->input->post('id_konsumen');
        $poin =$this->input->post('poin');
        $status = $this->input->post('status');


        $date=mdate('%Y-%m-%d');
        $dt = mdate('%Y-%m-%d %H:%i:%s');
        $dataqp = array('id_konsumen'=>$id,'qp_date'=>$date,'qp_benar'=>0,'qp_salah'=>0,'qp_poin'=>$poin,'qp_status'=>$status,'qp_finish'=>"$dt",'qp_selesai'=>'y','qp_tambahan'=>'y');
        $this->model_app->insert('quiz_partisipasi',$dataqp);

        redirect('administrator/detail_konsumen/'.$id);
    }
    function tambah_poin_absen()

    {
        $id = $this->input->post('id_konsumen');
        $poin =$this->input->post('poin');
     


        $date=mdate('%Y-%m-%d');
        $time = mdate('%H:%i:%s');
        $next = mdate('%Y-%m-%d %H:%i:%s',strtotime('+ 60 minutes'));
        for($x=1;$x<=$poin;$x++){
        $data = array('id_konsumen'=>$id,'date'=>$date,'absen_in'=>$time,'next'=>$next);
        $this->model_app->insert('absensi',$data);
        }
        redirect('administrator/detail_konsumen/'.$id);
    }
	function logout(){
		$this->session->sess_destroy();
		redirect('administrator');
	}
}
