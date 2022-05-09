<?php
/*
-- ---------------------------------------------------------------
=== JUA KOPI ===
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Kelas extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        $id = decode($this->session->id_siswa);
        $siswa = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $cabang  = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $this->session->unset_userdata('referred_from');

        $this->session->set_userdata('referred_from', current_url());
        if($cabang['status'] == 'sekolah'){

        }else{
            exit();
        }

    }
    public function index()
    {
        cek_session();
        $data['title']= 'Kelas - '.title();
        $data['left'] = 'Kelas';
        $data['center'] = '';
        $data['head']='transparent';
        $data['right'] ='<a href="javascript:;" class="headerButton" data-toggle="modal" data-target="#addDialog">
                                <ion-icon name="add-outline"></ion-icon>
                            </a>';
        $data['right'] .=' <a href="javascript:;" class="headerButton toggle-searchbox">
                                    <ion-icon name="search-outline"></ion-icon>
                            </a>';
        
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id,date('Y-m-d'));
        $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $this->template->load('phpmu-tigo/kelas/template','phpmu-tigo/kelas/view_kelas',$data);

    }
    public function detail()
    {
        cek_session();
        $id = decode($this->input->get('id'));
        $cek= $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
        if($cek->num_rows() > 0){
            $row = $cek->row_array();
            $data['head'] = 'bg-primary text-light';
            $data['title']= 'Kelas - '.title();
            $data['left'] = '<a href="'.base_url('kelas').'" class="headerButton goBack">
            <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="chevron back outline"></ion-icon>
        </a>';
            $data['center'] = $row['rk_title'];
            $data['right'] ='';
          
            
            $id = $this->encrypt->decode($this->session->id_siswa,keys());
            update_session($id,date('Y-m-d'));
            $data['row'] = $row;
            // $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
            $this->template->load('phpmu-tigo/kelas/template','phpmu-tigo/kelas/view_detail',$data);
        }else{
            $this->session->set_flashdata('error','Kelas tidak ditemukan!');
            redirect('kelas');
        }
        

    }
 
    function participant(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $output = null;
            $cek= $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
            if($cek->num_rows() > 0){
                $output .='<ul class="listview image-listview mt-2">';
              
           
                $status = true;
                $msg = null;
                $siswaID = $this->encrypt->decode($this->session->id_siswa,keys());
                $data = $this->model_app->join_where_order('ruang_kelas_siswa','siswa','rks_id_siswa','id_siswa',array('rks_rk_id'=>$id),'rks_id','ASC');
                if($data->num_rows() > 0){
                    foreach($data->result_array() as $row){
                        if(checkImage($row['foto']) == 1){
                            $img = $row['foto'];
                        }else{
                            $img = base_url('asset/upload_sklh/blank.png');
                        }
                        $on = $this->model_app->view_where('siswa_session',array('id_siswa'=>$row['id_siswa'],'date'=>date('Y-m-d'),'time >='=>date('H:i:s')));
                        if($row['id_siswa'] == $siswaID){
                            $dot = '<span></span>' ;
                        }else{
                            if($on->num_rows() > 0){
                                $dot =' <span class="on"></span>';
                            }else{
                                $dot =' <span class="off"></span>';
                            }
                        }
                       
                        $output .='
                                    <li class="goChat">
                                        <div class="item " data-id="'.encode($row['id_siswa']).'">
                                            <img src="'.$img.'" alt="'.$row['nama_lengkap'].'" class="image">
                                            <div class="in">
                                                <div>'.$row['nama_lengkap'].'</div>
                                                '.$dot.'
                                                
                                            </div>
                                        </div>
                                    </li>';
                    }
                }
                $output .='</ul>';
            }else{
                $status= false;
                $msg ='Kelas tidak ditemukan';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
        }
    }
    function materi(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $output = null;
            $cek= $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
            if($cek->num_rows() > 0){
                $status = true;
                $data = $this->model_app->view_where_ordering('ruang_kelas_materi',array('rke_rk_id'=>$id),'rke_id','DESC');
                if($data->num_rows() > 0){

                    foreach($data->result_array() as $row){
                        if(file_exists('asset/upload_kelas/'.$row['rke_file'])){
                            $file = '<a href="'.base_url('asset/upload_kelas/'.$row['rke_file']).'" class="text-left"><ion-icon name="document-outline"></ion-icon> '.$row['rke_file_name'].'</a>';
                        }else{
                            $file = '<ion-icon name="sad-outline"></ion-icon> File tidak ditemukan';
                        }
                        $date = date('Y-m-d',strtotime($row['rke_created_on']));
                        $output .='<div class="section  mt-2 mb-2">
                                    <div class="section-title"><span class="text-left">'.$row['rke_title'].'</span><span class="text-right">'.checkToday($date).'</span> </div>
                                    <div class="wide-block pt-2 pb-1">
                                       '.$row['rke_desc'].'
                                       <div class="divider mt-3 mb-2 text-left">
                                       
                                        
                                       </div>
                                       
                                       <h5>'.$file.'</h5>
                                      
                                    </div>
                                   
                                </div>';
                    }
                }else{
                    $output .= "<h6><i>Belum ada materi</i></h6>";
                }

            }else{
                $status= false;
                $msg = 'Ruang kelas tidak ditemukan!';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
        }
    }
    function meeting(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $output = null;
            $cek= $this->model_app->view_where('ruang_kelas',array('rk_id'=>$id));
            if($cek->num_rows() > 0){
                $status = true;
                $msg = null;
                $data = $this->model_app->view_where_ordering('ruang_kelas_meeting',array('rkm_rk_id'=>$id),'rkm_id','DESC');
                if($data->num_rows() >0){
                    foreach($data->result_array() as $row){
                        if($row['rkm_date'] == date('Y-m-d')){
                            if($row['rkm_start'] >= date('H:i:s') AND $row['rkm_end'] >= date('H:i:s')){
                                    $peserta = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$row['rkm_id']))->num_rows();
                                    
                                    // $button = '<button class="btn btn-primary joinmeet mr-auto" data-id="'.encode($row['rkm_id']).'"><ion-icon name="videocam-outline"></ion-icon> JOIN</button>';
                                    $button = '<h6>Meeting sedang dimulai</h6>';

                                    $button .= '<p>'.$peserta.' peserta</p>';

                            }else if($row['rkm_start'] < date('H:i:s') && $row['rkm_end'] < date('H:i:s')) {
                                    $peserta = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$row['rkm_id']))->num_rows();
                                    $button = '<h6>Meeting selesai</h6>';
                                    $button .= '<p>'.$peserta.' peserta</p>';
                                    // $button = '<button class="btn btn-primary btn-right " data-id="'.encode($row['rkm_id']).'" disabled>Selesai</button>';
                            
                            }else if($row['rkm_start'] > date('H:i:s') && $row['rkm_end'] < date('H:i:s')) {
                                $button = '<h6>'.date('H:i',strtotime($row['rkm_start'])).'</h6>';
                            }
                        }else if($row['rkm_date'] < date('Y-m-d')){
                            $peserta = $this->model_app->view_where('ruang_kelas_meeting_partisipasi',array('rkmp_rkm_id'=>$row['rkm_id']))->num_rows();
                            $button = $peserta.' partisipasi';
                        }else if($row['rkm_date'] > date('Y-m-d')){
                            $button= 'Pukul : '.date('H:i',strtotime($row['rkm_start']));
                        }

                        if($row['rkm_url'] != ''){
                            $url = '<h4 class="text-left">URL : <a href='.$row['rkm_url'].' target="_BLANK">'.$row['rkm_url'].'</a></h4>';
                        }else{
                            $url = '';
                        }
                        $output .= '<div class="section  mt-2 mb-2">
                        <div class="section-title"><span class="text-left">'.$row['rkm_title'].'</span> <span class="text-right">'.checkToday($row['rkm_date']).'</span></div>
                        <div class="wide-block pt-2 pb-1 text-right">
                            <p class="text-left">
                               '.$row['rkm_desc'].'
                              
                    
                            </p>

                           '.$url.'
                         
                           '.$button.'
                        </div>
                    </div>';
                    }
                }
            }else{
                $status = false;
                $msg = 'Kelas tidak ditemukan!';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg,'output'=>$output));
        }
    }
    function conference(){
        if($this->input->method() == 'get'){
            if($this->input->get('meet') != null){
                $m = explode('_',decode($this->input->get('meet')));
                $rkm_id = $m[0];
                $cek = $this->model_app->view_where('ruang_kelas_meeting',array('rkm_id'=>$rkm_id));
                if($cek->num_rows() > 0){
                    $row = $cek->row_array();
                    $part = $this->model_app->view_where('ruang_kelas_siswa',array('rks_rk_id'=>$row['rkm_rk_id']));
                    if($part->num_rows() > 0){
                      
                        $data['head'] = 'bg-primary text-light';
                        $data['title']= 'Kelas - '.title();
                        $data['left'] = '<a href="'.base_url('kelas/detail?id='.encode($row['rk_id'])).'" class="headerButton goBack">
                        <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="chevron back outline"></ion-icon>
                    </a>';
                        $data['center'] = $row['rkm_title'];
                        $data['right'] ='';
                    
                        
                        $id = $this->encrypt->decode($this->session->id_siswa,keys());
                        update_session($id,date('Y-m-d'));
                        $data['row'] = $row;
                        // $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
                        $this->template->load('phpmu-tigo/kelas/templateconf','phpmu-tigo/kelas/view_conf',$data);
                    }else{
                        $this->session->set_flashdata('error','Anda tidak bergabung kelas ini');
                        redirect('kelas');
                        
                    }
                }else{
                    $this->session->set_flashdata('error','Meeting tidak ditemukan!');
                    redirect('kelas');
                    
                }
            }else{
                $this->session->set_flashdata('error','Format salah!');
                redirect('kelas');
            }
        }
    }
    function joinMeeting(){
        if($this->input->method() == 'post'){
            $id = decode($this->input->post('id'));
            $cek = $this->model_app->view_where('ruang_kelas_meeting',array('rkm_id'=>$id));
            $redirect = null;
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $part = $this->model_app->view_where('ruang_kelas_siswa',array('rks_rk_id'=>$row['rkm_rk_id']));
                if($part->num_rows() > 0){
                    $status = true;
                    $msg = null;
                    $redirect = encode($row['rkm_id'].'_'.$row['rkm_meeting_id']);
                }else{
                    $status = false;
                    $msg = 'Anda tidak bergabung kelas ini';
                }
            }else{
                $status = false;
                $msg= 'Meeting tidak ditemukan!';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg,'redirect'=>$redirect));
        }

    }
    function join(){
        if($this->input->method() == 'post'){
            $id = $this->encrypt->decode($this->session->id_siswa,keys());
            $sis = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();

            $kode = $this->input->post('kode');
            $cek = $this->model_app->view_where('ruang_kelas',array('rk_code'=>$kode,'rk_id_sd'=>$sis['id_sd']));
            if($cek->num_rows() > 0){
                $row = $cek->row_array();
                $cekPart = $this->model_app->view_where('ruang_kelas_siswa',array('rks_rk_id'=>$row['rk_id'],'rks_id_siswa'=>$id));
                if($cekPart->num_rows() > 0){
                    $rowP = $cekPart->row_array();
                    if($rowP['rks_approved'] == 'y'){
                        $status = false;
                        $msg = 'Anda sudah bergabung dalam kelas';
                    }else{
                        $status = false;
                        $msg = 'Anda dalam verifikasi kelas, silahkan hubungi guru';
                    }
                   
                }else{
                    if($row['rk_kelas'] == $sis['kelas']){
                        $status = true;
                        if($row['rk_acc'] == 'y'){
                            $msg = 'Tunggu konfirmasi dari guru';
                            $app = 'p';
                            $approved =null;
                        }else{
                            $msg = 'Berhasil join kelas';
                            $app = 'y';
                            $approved = date('Y-m-d H:i:s');
                        }
    
                        $data = array('rks_rk_id'=>$row['rk_id'],
                                    'rks_id_siswa'=>$id,
                                    'rks_approved'=>$app,
                                    'rks_joined_at'=>date('Y-m-d H:i:s'),
                                    'rks_approved_on'=>$approved
                                    );
                        $this->model_app->insert('ruang_kelas_siswa',$data);
                    }else{
                        $status = false;
                        $msg = 'Kelas ini untuk kelas '.$row['rk_kelas'];
                    }
                }
                
                
            }else{
                $status = false;
                $msg = 'Kelas tidak ditemukan';
            }
            echo json_encode(array('status'=>$status,'msg'=>$msg));
        }
    }
    function dataKelas(){
        if($this->input->method() == 'post'){
            $id = $this->encrypt->decode($this->session->id_siswa,keys());
            $output =null;
            $data = $this->db->query("SELECT * FROM `ruang_kelas` JOIN `ruang_kelas_siswa` ON `ruang_kelas`.`rk_id`=`ruang_kelas_siswa`.`rks_rk_id` WHERE `rks_id_siswa` = '".$id."' AND ( `rks_approved` = 'p' OR `rks_approved` = 'y') ORDER BY `rks_id` DESC");
            if($data->num_rows() > 0){
                foreach($data->result_array() as $row){
                    if(checkImage($row['rk_icon'])){
                        $icon = $row['rk_icon'];
                    }else{
                        $icon = base_url('asset/upload_kelas/blank.png');
                    }

                    if(strlen($row['rk_title']) > 25){
                        $title = substr($row['rk_title'],0,22).'...';
                    }else{
                        $title = $row['rk_title'];
                    }

                    if(strlen($row['rk_desc']) > 80){
                        $deskripsi = substr($row['rk_desc'],0,80).'...';
                    }else{
                        $deskripsi = $row['rk_desc'];
                    }

                    if($row['rks_approved']=='p'){
                        $button = '<p class="card-text  text-right text-light font-10">Menunggu Persetujuan</p>';
                        $class ='notice';
                        $style = "style='padding:18px 16px 16px 16px'";
                    }else{
                        $class = 'detail';
                        $button = '';
                        $style = "style='padding:18px 16px 37px 16px'";
                    }
                    $output .= "<div class='col-6 my-2 ".$class."' data-id='".encode($row['rk_id'])."'>
                                    <div class='card'>
                                        <img class='card-img-top' src='".$icon."' srcset='' alt='".$row['rk_title']."' style='max-height:150px;'>
                                        <div class='card-body' ".$style.">
                                            <h6 class='card-title font-10 my-0'>".$title."</h6>
                                           
                                            ".$button."
                                        </div>
                                    </div>
                                </div>";
                }
            }
            echo json_encode($output);
               
        }
    }
    function dataSearch(){
        if($this->input->method() == 'post'){
            $id = $this->encrypt->decode($this->session->id_siswa,keys());
            $output =null;
            $key = $this->input->post('key');
            $data = $this->db->query("SELECT * FROM `ruang_kelas` JOIN `ruang_kelas_siswa` ON `ruang_kelas`.`rk_id`=`ruang_kelas_siswa`.`rks_rk_id` WHERE `rks_id_siswa` = '".$id."' AND ( `rks_approved` = 'p' OR `rks_approved` = 'y') AND rk_title LIKE '%".$key."%' ORDER BY `rks_id` DESC");
            $output .= "<div class='col-10'>
                            <h6 class='font-25 text-dark text-left'>".$key."</h6>
                        </div>
                        <div class='col-2'>
                            <span id='closeSearch'>
                                <ion-icon name='close-circle-outline'></ion-icon>
                            </span>
                        </div>
                        ";
            if($data->num_rows() > 0){
               
                foreach($data->result_array() as $row){
                    if(checkImage($row['rk_icon'])){
                        $icon = $row['rk_icon'];
                    }else{
                        $icon = base_url('asset/upload_kelas/blank.png');
                    }
                    if(strlen($row['rk_title']) > 25){
                        $title = substr($row['rk_title'],0,22).'...';
                    }else{
                        $title = $row['rk_title'];
                    }

                    if(strlen($row['rk_desc']) > 80){
                        $deskripsi = substr($row['rk_desc'],0,80).'...';
                    }else{
                        $deskripsi = $row['rk_desc'];
                    }

                    if($row['rks_approved']=='p'){
                        $button = '<p class="card-text  text-right text-light font-10">Menunggu Persetujuan</p>';
                        $class ='notice';
                        $style = "style='padding:18px 16px 16px 16px'";
                    }else{
                        $class = 'detail';
                        $button = '';
                        $style = "style='padding:18px 16px 37px 16px'";
                    }
                    $output .= "<div class='col-6 my-2 ".$class."' data-id='".encode($row['rk_id'])."'>
                                    <div class='card'>
                                        <img class='card-img-top' src='".$icon."' srcset='' alt='".$row['rk_title']."' style='max-height:150px;'>
                                        <div class='card-body' ".$style.">
                                            <h6 class='card-title font-10 my-0'>".$title."</h6>
                                           
                                            ".$button."
                                        </div>
                                    </div>
                                </div>";
                }
            }else{
                $output .= "<div class='col-12 my-2'><h6 class='font-10'>Pencarian ".$key." tidak ditemukan</h6></div>";
            }
            echo json_encode($output);
               
        }
    }
}