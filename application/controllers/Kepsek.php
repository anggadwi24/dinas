<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kepsek extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        $this->session->unset_userdata('referred_from');
        $this->session->set_userdata('referred_from', current_url()); 
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $this->cabang = $cabang['id_sd'];
        $this->sekolah = $cabang['nama_cabang'];
        $this->jenis = $cabang['jenis_sekolah'];
        if(!$this->session->userdata('kepsek')){
           $user =  $this->model_app->view_where('kepala_sekolah',array('kepsek_id'=>$this->session->userdata['kepsek']['kepsek_id'],'kepsek_id_sd'=>$cabang['id_sd']));
           if($user->num_rows() > 0){
                $row = $user->row_array();
                $this->row = $row;
                $this->id = $row['id_kepsek'];
           }
        }
            if($cabang['status'] != 'sekolah'){
            exit();
            }
            $this->key = "aplikasidatakepegawaianENCRYPTION30224923912";
    // 
    }
    function login(){
    if (isset($_POST['login'])){
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $no_ktp = strip_tags($this->input->post('a'));
        $password = $this->input->post('b');
        $cek = $this->db->query("SELECT * FROM kepala_sekolah where kepsek_email='".$this->db->escape_str($no_ktp)."' AND kepsek_id_sd = '".$cabang['id_sd']."'");
        if($cek->num_rows() > 0) {

        
        $row = $cek->row_array();
            $pwd= decode($row['kepsek_password']);
            

        
            if(trim($pwd) == trim($password) ){
                $this->session->set_userdata(array('kepsek'=>array('kepsek_id'=>$row['kepsek_id'],'level'=>'kepsek','id_sd'=>$row['kepsek_id_sd'])));
                
            
                $referred_from = $this->session->userdata('referred_from');
                redirect('kepsek/index');
            }else{
            
                $data['title'] = 'Gagal Login';
                $this->session->set_flashdata('message','Password anda salah!');
                $this->load->view('guru/view_login_pengawas',$data);
            }
            
        
        
            
        
        }else{
        $data['title'] = 'Gagal Login';
        $this->session->set_flashdata('message', 'Maaf, Email tidak ditemukan!');
        $this->load->view('guru/view_login_pengawas',$data);

        
        }
    }else{
    $data['title'] = 'User Login';
    $this->load->view('guru/view_login_pengawas',$data);
    }
    }
    function index(){
        cek_session_cabang_kepsek($this->cabang);
        $data['title'] = 'KEPALA SEKOLAH - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;


        $this->template->load(theme_base().'/template-pengawas',theme_base().'/pengawas/view_home',$data);
        
        
    }
    function guru(){
        cek_session_cabang_kepsek($this->cabang);

        $data['title'] = 'Guru - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;
        $data['menu'] = 'Data Guru';
        $data['back'] = base_url('kepsek/');
        $data['record'] = $this->db->query("SELECT * FROM guru WHERE id_sd = '".$this->cabang."' AND status = 'active'");
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_guru',$data);
    }
    function detailGuru(){
        cek_session_cabang_kepsek($this->cabang);

        $id = decode($this->input->get('id'));
        $cek = $this->model_app->view_where('guru',array('id_guru'=>$id,'id_sd'=>$this->cabang));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['title'] = 'Guru - '.title();
            $data['row'] = $cek->row_array();
            $data['back'] = base_url('kepsek/guru');
            $data['menu'] = strtoupper($row['nama_guru']);
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_guru_detail',$data);

        }else{
            $this->session->set_flashdata('message','Guru Tidak Ditemukan!');
            redirect('kepsek/guru');
        }
    }
    function kehadiran(){
        cek_session_cabang_kepsek($this->cabang);

        $data['title'] = 'Kehadiran - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;
        $data['menu'] = 'Kehadiran';
        $data['back'] = base_url('kepsek/');
        $data['record'] = $this->db->query("SELECT * FROM guru WHERE id_sd = '".$this->cabang."' AND status = 'active'");
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_kehadiran',$data);
    }
    function dataKehadiran(){
        
        $tanggal = $this->input->post('date');
        $output = null;
        $cek = $this->db->query("SELECT * FROM guru a JOIN absensi b ON a.id_guru = b.id_pegawai WHERE status_absen = 'guru' AND tanggal = '".$tanggal."' AND id_sd ='".$this->cabang."'");
        if($cek->num_rows() > 0){
            foreach($cek->result_array() as $row){
                $jam_masuk = date('H:i',strtotime($row['absen_masuk']));
                if($row['absen_keluar'] == NULL){
                    $jam_keluar = "--:--";
                }else{
                    $jam_keluar = date('H:i',strtotime($row['absen_keluar']));
                }
                $output .= "<div class='col-11 border border-danger mb-3 py-2 ' data-id='".encode($row['id_absen'])."' style='border-radius:10px;'>
                                <div class='row'>
                                    <div class='col-3'>
                                        <img src='".$row['foto']."' style='widht:40px;height:40px' class='rounded-circle my-2' srcset=''> 
                                    </div>
                                    <div class='col-7'>
                                        <h5 class='my-0'>".$row['nama_guru']."</h5>
                                        <h6 class='my-2'>".$jam_masuk." - ".$jam_keluar."</h6>
                                    </div>
                                   
                                    <div class='col-2 detail' data-id='".encode($row['id_absensi'])."'><span class='ri-arrow-right-s-line mt-3' style='font-size:30px;'></span></div>
                                  
                                </div>
                            </div>";
            }
        }else{
            $output = "<div class='col-12 my-2'><i>Tidak ada data kehadiran</i></div>";
        }
        echo json_encode(array('output'=>$output,'tanggal'=>$tanggal));
    }
    function detailKehadiran(){
        cek_session_cabang_kepsek($this->cabang);

        $id = decode($this->input->get('id'));
        $cek = $this->db->query("SELECT * FROM guru a JOIN absensi b ON a.id_guru = b.id_pegawai WHERE status_absen = 'guru' AND id_absensi = '".$id."' AND  id_sd ='".$this->cabang."' " );
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['back'] = base_url('kepsek/kehadiran');
            $data['menu'] = 'Detail Kehadiran';
            $data['title'] = 'Detail Kehadiran - '.title();
            $data['row'] = $row;
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_kehadiran_detail',$data);

        }else{
            $this->session->set_flashdata('message','Kehadiran Tidak Ditemukan!');
            redirect('kepsek/kehadiran');
        }
    }
    function report(){
        cek_session_cabang_kepsek($this->cabang);

        $data['title'] = 'Report - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;
        $data['menu'] = 'Report';
        $data['back'] = base_url('kepsek/');
        $data['record'] = $this->db->query("SELECT * FROM guru WHERE id_sd = '".$this->cabang."' AND status = 'active'");
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_report',$data);
    }
    function dataReport(){
        $date= $this->input->post('date');
        $guru = $this->input->post('guru');
        if($guru == 'all'){
            $title  = 'Tanggal : '.$date.' | Guru : all';
            $data = $this->db->query("SELECT * FROM guru a JOIN report b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' AND date = '".$date."' AND status_report= 'guru' ORDER BY id_report DESC ");
        }else{
            $gur = $this->model_app->view_where('guru',array('id_guru'=>decode($guru)))->row_array();
            $title = 'Tanggal : '.$date.' | Guru : '.$gur['nama_guru'];
            $data = $this->db->query("SELECT * FROM guru a JOIN report b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' AND date = '".$date."' AND status_report= 'guru'  AND b.id_pegawai = '".decode($guru)."' ORDER BY id_report DESC");
            
        }
        $output = null;
        if($data->num_rows () > 0){
            foreach($data->result_array() as $row){
                if($row['finish'] == 'y'){
                    $border = 'border border-success';
                }else{
                    $border = 'border border-danger';
                }
                $output .= "<div class='col-11 my-2 py-3 ".$border." detail' data-id='".encode($row['id_report'])."' >
                                <div class='row'>
                                    <div class='col-3'>
                                        <img src='".$row['foto']."' style='widht:40px;height:40px' class='rounded-circle my-2' srcset=''> 
                                     </div>
                                     <div class='col-9'>
                                        <h6 class='mb-1'>".$row['judul_report']."</h6>
                                        <span class='my-0'>".$row['nama_guru']."</span>
                                     </div>
                                </div>
                            </div>";
            }
        }else{
            $output = '<div class="col-12 my-2"><i>Tidak ada report</i></div>';
        }
        echo json_encode(array('output'=>$output,'title'=>$title));
    }
    function detailReport(){
        cek_session_cabang_kepsek($this->cabang);

        $id = decode($this->input->get('id'));
        $cek = $this->db->query("SELECT * FROM guru a JOIN report b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' AND id_report = '".$id."' ORDER BY id_report DESC ");
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['back'] = base_url('kepsek/report');
            $data['menu'] = 'Detail Report';
            $data['title'] = 'Detail Report - '.title();
            $data['row'] = $row;
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_report_detail',$data);
        }else{
            $this->session->set_flashdata('message','Report tidak ditemukan');
            redirect('kepsek/report');
        }
    }
    function form(){
        cek_session_cabang_kepsek($this->cabang);

        $data['title'] = 'Izin & Sakit - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;
        $data['menu'] = 'Izin & Sakit';
        $data['back'] = base_url('kepsek/');
        $data['record'] = $this->db->query("SELECT * FROM guru WHERE id_sd = '".$this->cabang."' AND status = 'active'");
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_form',$data);
    }
    function dataForm(){
        $status= $this->input->post('status');
        if($status == 'all'){
            $where = '';
        }else{
            $where = 'AND b.status = "'.$status.'" ';
        }
        $guru = $this->input->post('guru');
        if($guru == 'all'){
            $title  = 'Status : '.$status.' | Guru : all';
            $data = $this->db->query("SELECT *,a.foto as foto_profile FROM guru a JOIN form_izin b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' $where  AND status_form = 'guru' ORDER BY id_form DESC ");
        }else{
            $gur = $this->model_app->view_where('guru',array('id_guru'=>decode($guru)))->row_array();
            $title = 'Status : '.$status.' | Guru : '.$gur['nama_guru'];
            $data = $this->db->query("SELECT *,a.foto as foto_profile  FROM guru a JOIN form_izin b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' $where AND status_form = 'guru' AND b.id_pegawai = '".decode($guru)."' ORDER BY id_form DESC");
            
        }
        $output = null;
        if($data->num_rows () > 0){
            foreach($data->result_array() as $row){
                if($row['approved'] == 'setuju'){
                    $border = 'border border-success';
                }else{
                    $border = 'border border-danger';
                }
                $output .= "<div class='col-11 my-2 py-3 ".$border." detail' data-id='".encode($row['id_form'])."' >
                                <div class='row'>
                                    <div class='col-3'>
                                        <img src='".$row['foto_profile']."' style='widht:40px;height:40px' class='rounded-circle my-1' srcset=''> 
                                     </div>
                                     <div class='col-9'>
                                        <h6 class='mb-1'>".$row['status']." [ ".date('d/m',strtotime($row['dari']))." - ".date('d/m',strtotime($row['sampai']))." ] </h6>
                                        <span class='my-0 float-left'>".$row['nama_guru']."</span>
                                        <span class='my-0 float-right'>".ucfirst($row['approved'])."</span>

                                     </div>
                                </div>
                            </div>";
            }
        }else{
            $output = '<div class="col-12 my-2"><i>Tidak ada form izin & sakit</i></div>';
        }
        echo json_encode(array('output'=>$output,'title'=>$title));
    }
    function detailForm(){
        cek_session_cabang_kepsek($this->cabang);

        $id = decode($this->input->get('id'));
        $cek = $this->db->query("SELECT *,a.foto as foto_profile  FROM guru a JOIN form_izin b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' AND b.id_form = '".$id."'AND status_form = 'guru' ORDER BY id_form DESC");
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['back'] = base_url('kepsek/form');
            $data['menu'] = 'Detail '.$row['status'];
            $data['title'] = 'Detail '.$row['status'].' - '.title();
            $data['row'] = $row;
             $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_form_detail',$data);
        }else{
            $this->session->set_flashdata('message','Form Izin & Sakit Tidak Ditemukan!');
            redirect('kepsek/form');
        }

    }
    function approv(){
        cek_session_cabang_kepsek($this->cabang);

        $get = explode('/',decode($this->input->get('id')));
        $id = $get[1];
        $status = $get[0];
        $cek = $this->db->query("SELECT *,a.foto as foto_profile  FROM guru a JOIN form_izin b ON a.id_guru = b.id_pegawai WHERE a.id_sd = '".$this->cabang."' AND b.id_form = '".$id."' AND status_form = 'guru' ORDER BY id_form DESC");
        if($cek->num_rows()  > 0 ){ 
            $row = $cek->row_array();
            if($row['approved'] == 'proses'){
                $where = array('id_form'=>$id);
                $data = array('approved'=>$status);
                $this->model_app->update('form_izin',$data,$where);
                $this->session->set_flashdata('success','Form Izin & Sakit berhasil di'.$status);
                redirect('kepsek/detailForm?id='.encode($id));
            }else{
                $this->session->set_flashdata('message','Form Izin & Sakit Tidak dalam status proses!');
                redirect('kepsek/detailForm?id='.encode($id));
            }
        }else{
            $this->session->set_flashdata('message','Form Izin & Sakit Tidak Ditemukan!');
            redirect('kepsek/form');
        }
        
        
      

    }
    
  function peringkat(){
    cek_session_cabang_kepsek($this->cabang);

    $data['title'] = title();
      $data['menu'] = "Peringkat";
      
      
      
      $data['bulan'] = date('m');
      
    
      $this->load->view('guru/peringkat/view_peringkat',$data);
    }
    function siswa(){
        cek_session_cabang_kepsek($this->cabang);

        $data['title'] = 'Siswa - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;
        $data['menu'] = 'Siswa';
        $data['jenis'] = $this->jenis;
        $data['back'] = base_url('kepsek/');
        $data['record'] = $this->db->query("SELECT * FROM siswa WHERE id_sd = '".$this->cabang."' AND active = 'y'");
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_siswa',$data);
    }
    function dataSiswa(){
        $kelas = $this->input->post('kelas');
        $output = null;
        if($kelas == 'all' OR $kelas == NULL){
            $data = $this->db->query("SELECT * FROM siswa WHERE id_sd = '".$this->cabang."' AND active = 'y'");
        }else{
            $data = $this->db->query("SELECT * FROM siswa WHERE id_sd = '".$this->cabang."' AND active = 'y' AND kelas ='".$kelas."'");
        }
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $output.= "  <div class='col-11 my-3 border border-danger py-3'>
                            <div class='row'>
                                <div class='col-3'><img src='".$row['foto']."' class='rounded-circle ' style='width: 50px;height: 50px;' src='set'></div>
                                <div class='col-7'><h5 class='my-0'>".$row['nama_lengkap']."</h5><label>Kelas  ".$row['kelas']."</label></div>
                                <div class='col-2 detail' data-id='".encode($row['id_siswa'])."'><span class='ri-arrow-right-s-line mt-3' style='font-size:30px;'></span></div>
                            </div>
                        </div>";
            }
        }else{
            $output= "<div class='col-11 my-2'><i>Tidak ada data siswa<i></div>";
        }
        echo json_encode(array('output'=>$output));
    }
    function detailSiswa(){
        $id= decode($this->input->get('id'));
        $cek =  $this->db->query("SELECT * FROM siswa WHERE id_sd = '".$this->cabang."' AND active = 'y' AND id_siswa = '".$id."'");
        if($cek->num_rows()  > 0){
            $row = $this->row;
            $data['title'] = 'Detail Siswa - '.title();
            $data['sekolah'] = $this->sekolah;
            $data['menu'] = 'Detail Siswa';
            $data['jenis'] = $this->jenis;
            $data['row'] = $cek->row_array();
            $data['back'] = base_url('kepsek/siswa');
            $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_siswa_detail',$data);

        }else{
            $this->session->set_flashdata('message','Siswa tidak ditemukan!');
            redirect('kepsek/siswa');
        }
    }
    function quiz(){
        cek_session_cabang_kepsek($this->cabang);

        $data['title'] = 'Kuis - '.title();
        $data['user'] = $this->row;
        $row = $this->row;
        $data['sekolah'] = $this->sekolah;
        $data['menu'] = 'Kuis';
        $data['jenis'] = $this->jenis;
        $data['back'] = base_url('kepsek/');
        $data['record'] = $this->db->query("SELECT * FROM siswa WHERE id_sd = '".$this->cabang."' AND active = 'y'");
        $this->template->load(theme_base().'/template-pengawasback',theme_base().'/pengawas/view_kuis',$data);
    }
    function dataKuis(){
        $kelas = $this->input->post('kelas');
        $date = $this->input->post('date');
        if($kelas == 'all' OR $kelas == NULL){
            $data = $this->db->query("SELECT * FROM quiz_date a JOIN quiz_partisipasi b ON a.id_qd = b.qp_date JOIN siswa c ON b.id_siswa = c.id_siswa WHERE a.tanggal = '".$date."' AND c.id_sd = '".$this->cabang."' ");

        }else{
            $data = $this->db->query("SELECT * FROM quiz_date a JOIN quiz_partisipasi b ON a.id_qd = b.qp_date JOIN siswa c ON b.id_siswa = c.id_siswa WHERE a.tanggal = '".$date."' AND a.kelas = '".$kelas."' AND c.id_sd = '".$this->cabang."' ");

        }
        $title = 'Tanggal : '.$date.' | Kelas : '.$kelas;
        $jmlSiswa = $this->model_app->view_where('siswa',array('id_sd'=>$this->cabang))->num_rows();
        $jumlahKuis = $data->num_rows();
        $jumlahTidak = $jmlSiswa-$jumlahKuis;
        $output = null;
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $mapel = $this->model_app->view_where('mata_pelajaran',array('mapel_id'=>$row['mapel_id']))->row_array();
                $output .= "<div class='col-11 my-2 border border-danger py-2'>
                                <div class='row'>
                                    <div class='col-3'><img src='".$row['foto']."' class='rounded-circle ' style='width: 50px;height: 50px;' src='set'></div>
                                    <div class='col-7'><h5 class='my-0'>".$row['nama_lengkap']."</h5><label class='my-0'>Kelas  ".$row['kelas']."</label> <label class='d-block my-0'>".$mapel['mapel']."</label></div>
                                    <div class='col-2''><h5 class='my-0'>".$row['qp_poin']."</h5><label>Poin</label></div>
                                </div>
                            </div>";
            }
        }else{
            $output = "<div class='col-12 my-2'><i>Tidak ada partisipasi</i></div>";
        }
        echo json_encode(array('output'=>$output,'title'=>$title,'siswa'=>$jmlSiswa,'partisipasi'=>$jumlahKuis,'tidak'=>$jumlahTidak));
    }
    function logout(){
        $this->session->set_userdata('referred_from', base_url('kepsek/home')); 
        $this->session->unset_userdata('kepsek');
        redirect('kepsek/login');
    }
}