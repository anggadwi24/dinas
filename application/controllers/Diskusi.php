<?php
/*
-- ---------------------------------------------------------------
-- CHAT --
-- JUA KOPI --
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Diskusi extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        $this->session->set_userdata('referred_from', current_url()); 
			cek_session();
    }
    function index(){
        $data['title'] = 'Diskusi - '.title();
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        
        $data['row'] = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $this->template->load('phpmu-tigo/template-diskusi','phpmu-tigo/diskusi/view_diskusi',$data);
    }
    function detail(){
       
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $dis = $this->encrypt->decode($this->input->get('id'),keys());
        $cek = $this->model_app->view_where('diskusi',array('id_diskusi'=>$dis));
        if($cek->num_rows() > 0){
            $data['title'] = 'Diskusi - '.title();
            $data['row'] = $cek->row_array();
            $this->template->load('phpmu-tigo/template-diskusi','phpmu-tigo/diskusi/view_detail',$data);
        }else{
            $this->session->set_flashdata('message','Diskusi tidak ditemukan');
            redirect('diskusi');
        }
       
        
    }
    function goLike(){
        $id = $this->encrypt->decode($this->input->post('id'),keys());
        $id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
        $cek = $this->model_app->view_where('diskusi_like',array('id_diskusi'=>$id,'id_siswa'=>$id_siswa));
        if($cek->num_rows() > 0){
            $status = false;
            $this->model_app->delete('diskusi_like',array('id_diskusi'=>$id,'id_siswa'=>$id_siswa));
        }else{
            $status = true;
            $this->model_app->insert('diskusi_like',array('id_diskusi'=>$id,'id_siswa'=>$id_siswa));

        }
        $get = $this->model_app->view_where('diskusi_like',array('id_diskusi'=>$id))->num_rows();
        echo json_encode(array('status'=>$status,'num'=>$get));

    }
    function dataComment(){
        $id = $this->encrypt->decode($this->input->post('id'),keys());
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $output = null;
        $data = $this->db->query("SELECT *,a.foto as foto_profile FROM siswa a JOIN diskusi_komentar b ON a.id_siswa = b.id_siswa WHERE b.id_diskusi = '".$id."' ORDER BY b.tanggal DESC LIMIT $start,$limit");
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                if($row['foto'] != NULL){
                    $fotoC = "<div class='my-1'> <img src='". base_url()."asset/diskusi_upload/".$row['foto']."' alt='avatar' class='img-fluid'></div>";
                }else{
                    $fotoC = "";
                }
                $output .= "<div class='item'>
                <div class='avatar'>
                    <img src='".$row['foto_profile']."' alt='avatar' class='imaged w32 rounded'>
                </div>
                <div class='in'>
                    <div class='comment-header'>
                        <h4 class='title'>".nama($row['nama_lengkap'])."</h4>
                        <span class='time'>".cek_terakhir($row['tanggal'])."</span>
                    </div>
                    <div class='text'>
                    ".$row['komentar']."
                     ".$fotoC."
                    </div>
                    
                </div>
            </div>";
            }
            $btn = "<center><button class='btn btn-text-dark mr-1 mb-1 ' id='btnComMore' data-id='".$this->encrypt->encode($id,keys())."'>LIHAT SELANJUTNYA</button></center>";
        }else{
            $output = "";
            $btn = "";
        }
        echo json_encode(array('output'=>$output,'btn'=>$btn));
    }
    function dataDiskusi(){
        $start = $this->input->post('start');
        $limit = $this->input->post('limit');
        $cabang = $this->model_app->view_where('subdomain',array('sub_domain'=>base_url()))->row_array();
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $date = date("Y-m-d H:i");
        $data = $this->model_app->dataDiskusi($start,$limit,$id,$date,$cabang['id_sd']);
        $output = null;
        if($data->num_rows() > 0){
        foreach($data->result_array() as $row){
            if($row['foto'] != '' OR $row['foto'] != NULL){
                $foto = $row['foto'];
            }else{  
                $foto = base_url('asset/foto_siswa/profile.svg');

            }
            
            $like = $this->model_app->view_where('diskusi_like',array('id_diskusi'=>$row['id_diskusi']))->num_rows();
            $comment = $this->model_app->view_where('diskusi_komentar',array('id_diskusi'=>$row['id_diskusi']))->num_rows();

            $cekLike = $this->model_app->view_where('diskusi_like',array('id_siswa'=>$id,'id_diskusi'=>$row['id_diskusi']));
            if($cekLike->num_rows () > 0){
                $dataLike = " <a href='javascript:;' class='comment-button like' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."' >
                    <ion-icon name='heart' class='text-danger md hydrated'></ion-icon>
                    ".$like."
                    </a>";
            }else{
                $dataLike = " <a href='javascript:;' class='comment-button like' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."' >
                    <ion-icon name='heart-outline'></ion-icon>
                    ".$like."
                    </a>";
            }
            $fotoDiskusi = null;
            $disFot = $this->model_app->view_where('diskusi_foto',array('id_diskusi'=>$row['id_diskusi']));
            if($disFot->num_rows() > 0){
              foreach($disFot->result_array() as $df){

                $fotoDiskusi .="<div class='pr-1'>
                                        <img src='". base_url()."asset/diskusi_upload/".$df['foto']."' alt='avatar' class='img-fluid'>
                                </div>
                                ";
              }
            }
            $diskusiComment = null;
           
            $getComment = $this->model_app->view_where_ordering_limit('diskusi_komentar',array('id_diskusi'=>$row['id_diskusi']),'id_diskusi_komentar','DESC','0','3');
            if($getComment->num_rows() > 0 ){
               $fotoC = "";
                foreach($getComment->result_array() as $gC){
                    $cSiswa = $this->model_app->view_where('siswa',array('id_siswa'=>$gC['id_siswa']))->row_array();
                    if($gC['foto'] != NULL){
                        $fotoC = "<div class='my-1'> <img src='". base_url()."asset/diskusi_upload/".$gC['foto']."' alt='avatar' class='img-fluid'></div>";
                    }else{
                        $fotoC = "";
                    }
                    $diskusiComment .= "<div class='item'>
                                        <div class='avatar'>
                                            <img src='".$cSiswa['foto']."' alt='avatar' class='imaged w32 h32 rounded'>
                                        </div>
                                        <div class='in'>
                                            <div class='comment-header'>
                                                <h4 class='title'>".nama($cSiswa['nama_lengkap'])."</h4>
                                                <span class='time'>".cek_terakhir($gC['tanggal'])."</span>
                                            </div>
                                            <div class='text'>
                                            ".$gC['komentar']."
                                             ".$fotoC."
                                            </div>
                                            
                                        </div>
                                    </div>";
                }
               
            }
         
            $output .="
            <div class='item'>
                <div class='avatar' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."'>
                    <img src='".$foto."' alt='avatar' class='imaged w32 h32 rounded'>
                </div>
                <div class='in' >
                    <div class='comment-header detail' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."' >
                        <h4 class='title'>".nama($row['nama_lengkap'])."</h4>
                        <span class='time'>".cek_terakhir($row['tanggal'])."</span>
                    </div>
                    <div class='text detail' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."' >
                        <h3 class='title my-2'>".$row['diskusi_title']."</h3>
                        ".$row['diskusi_deskripsi']."
                        
                    </div>
                    <div class='text'>
                        <div class='d-flex justify-content-center mt-1'>
                            ".$fotoDiskusi."
                        </div>
                    </div>
                    <div class='comment-footer'>
                       ".$dataLike."
                        <a href='javascript:;' class='comment-button comment' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."'>
                            <ion-icon name='chatbubble-outline'></ion-icon>
                            ".$comment."
                        </a>
                    </div>
                    <div class='text mt-0'>
                        <form class='formReply'  data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."'>
                            <div class='row'>
                                <div class='col-12'><span class='fileRep'></span></div>
                                <div class='col-12'>
                                <input type='hidden' name='id_diskusi'  value='".$this->encrypt->encode($row['id_diskusi'],keys())."'>

                                    <div class='form-group basic'>
                                        <div class='input-wrapper'>
                                            <input type='text'autocomplete='off' class='form-control font-12' placeholder='Tulis Komentar....' name='reply' required>
                                            <i class='clear-input'>
                                                <ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>
                                            </i>
                                        </div>
                                
                                    </div>
                                </div>
                                
                            
                            </div>
                            
                        </form>
                    </div>
                    <div class='text'>
                     <div class='wide-block pt-2 pb-2' style='background:none !important;border-top:none;border-bottom:none'>
                            <div class='comment-block' id='com-".$row['id_diskusi']."'>
                    ".$diskusiComment."
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            ";
           
        }
        $show = "<div class='my-2  '><button type='button' class='btn btn-text-dark mr-0 mb-1' id='showMore'>LIHAT LAINNYA</button></div>";
        }else{
            $output = "";
            $show ="";
        }
       
        $arr = array('output'=>$output,'show'=>$show);
        echo json_encode($arr);
    }
    function createReply(){
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $id_diskusi = $this->encrypt->decode($this->input->post('id_diskusi'),keys());

        $me = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $komen = $this->input->post('reply');
        $config['upload_path'] =  './asset/diskusi_upload/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '20000';
			$config['encrypt_name'] = TRUE;
		 

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')){
		    $foto = null;
            $fotoC = '';

		}
		else{
            $dataupload = $this->upload->data();
            $foto = $dataupload['file_name'];
            $fotoC = "<div class='my-1'> <img src='". base_url()."asset/diskusi_upload/".$foto."' alt='avatar' class='img-fluid'></div>";
        }
        $data = array('id_diskusi'=>$id_diskusi,'id_siswa'=>$id,'komentar'=>$komen,'tanggal'=>date('Y-m-d H:i:s'),'foto'=>$foto);
        $this->model_app->insert('diskusi_komentar',$data);
        $msg = "<div class='item'>
                    <div class='avatar'>
                        <img src='".$me['foto']."' alt='avatar' class='imaged h32 w32 rounded'>
                    </div>
                    <div class='in'>
                        <div class='comment-header'>
                            <h4 class='title'>".nama($me['nama_lengkap'])."</h4>
                            <span class='time'>Baru saja</span>
                        </div>
                        <div class='text'>
                        ".$komen."
                        ".$fotoC."
                        </div>
                        
                    </div>
                </div>";
        echo json_encode(array('status'=>true,'msg'=>$msg,'id'=>$id_diskusi));

        
    }
    function createDiskusi(){
        $id = $this->encrypt->decode($this->session->id_siswa,keys());
        $me = $this->model_app->view_where('siswa',array('id_siswa'=>$id))->row_array();
        $text = $this->input->post('text');
        $title = $this->input->post('title');
        $tanggal = date('Y-m-d H:i:s');
        if($title != ''){
            $data = array('id_siswa'=>$id,'diskusi_title'=>$title,'diskusi_deskripsi'=>$text,'tanggal'=>$tanggal,'status'=>'y');
            $id_diskusi = $this->model_app->insert_id('diskusi',$data);
            if(!empty($_FILES['files']['name'])){
                $fotoDiskusi = null;
                foreach ($_FILES['files']['name'] as $i => $value)  
                       {
                           if(!empty($_FILES['files']['name'][$i])){
                                 $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                                 $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                                 $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                                 $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                                 $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                         
                                 $config['upload_path'] =  './asset/diskusi_upload/'; 
                                 $config['allowed_types'] = 'jpg|png|jpeg|gif'; # add video extenstion on here
                                 $config['max_size'] = '100480';
                                 $config['encrypt_name'] = TRUE;
                                 $config['overwrite'] = FALSE;
                                 $config['remove_spaces'] = TRUE;
                                 $config['file_name'] = $_FILES['files']['name'][$i];
                          
                                 $this->load->library('upload',$config); 
                                 $this->upload->do_upload('file');
                                   
                               
                                 $uploadData = $this->upload->data();
                                 $images = $uploadData['file_name'];
                                
                                 $data_img = array('id_diskusi'=>$id_diskusi,'foto'=>$images);
                                 $this->model_app->insert('diskusi_foto',$data_img);
       
                                 $fotoDiskusi .="<div class='pr-1'>
                                        <img src='". base_url()."asset/diskusi_upload/".$images."' alt='avatar' class='img-fluid'>
                                </div>
                                ";
                           }
                          
                        
                       }
               }
            $status =  true;
            
            $msg = "<div class='item'>
            <div class='avatar'>
                <img src='".base_url('asset/foto_siswa/'.$me['foto'])."' alt='avatar' class='imaged w32 rounded'>
            </div>
            <div class='in ' '>
                <div class='comment-header detail' data-id='".$this->encrypt->encode($id_diskusi,keys()).">
                    <h4 class='title'>".nama($me['nama_lengkap'])."</h4>
                    <span class='time'>Baru saja</span>
                </div>
                <div class='text detail' data-id='".$this->encrypt->encode($id_diskusi,keys()).">
                    <h3 class='title my-2'>".$title."</h3>
                    ".$text."
                    
                </div>
                <div class='text'>
                    <div class='d-flex justify-content-center mt-1'>
                        ".$fotoDiskusi." 
                    </div>
                </div>
                <div class='comment-footer'>
                    <a href='javascript:;' class='comment-button like' data-id='".$this->encrypt->encode($id_diskusi,keys())."'>
                <ion-icon name='heart-outline' role='img' class='md hydrated' aria-label='heart outline'></ion-icon>
                0
                </a>
                    <a href='javascript:;' class='comment-button comment' data-id='".$this->encrypt->encode($id_diskusi,keys())."'>
                        <ion-icon name='chatbubble-outline' role='img' class='md hydrated' aria-label='chatbubble outline'></ion-icon>
                        0
                    </a>
                </div>
                <div class='text mt-0'>
                    <form class=''>
                        <div class='row'>
                            <div class='col-12'><span class='fileRep'></span></div>
                            <div class='col-10'>
                                <div class='form-group basic'>
                                    <div class='input-wrapper'>
                                        <input type='text' class='form-control font-12' placeholder='Tulis Komentar....'>
                                        <i class='clear-input'>
                                            <ion-icon name='close-circle' role='img' class='md hydrated' aria-label='close circle'></ion-icon>
                                        </i>
                                    </div>
                            
                                </div>
                            </div>
                            <div class='col-2 mt-3'>
                                <input type='file' class='file' name='file' style='display:none'>
                                <span class='text-center font-25 '><ion-icon name='attach-outline' role='img' class='md hydrated' aria-label='attach outline'></ion-icon></span>
                            </div>
                        
                        </div>
                        
                    </form>
                </div>
                
                </div>
            </div>";
        }else{
            $status = false;
            $msg = null;
        }
        echo json_encode(array('status'=>$status,'msg'=>$msg));


    }
    function detailDiskusi(){
        $siswa = $this->encrypt->decode($this->session->id_siswa,keys());
        $id = $this->encrypt->decode($this->input->post('id'),keys());
        $row = $this->model_app->view_where('diskusi',array('id_diskusi'=>$id))->row_array();
        $comment = $this->model_app->view_where('diskusi_komentar',array('id_diskusi'=>$id))->num_rows();
        $like = $this->model_app->view_where('diskusi_like',array('id_diskusi'=>$id))->num_rows();
        $cek = $this->model_app->view_where('diskusi_like',array('id_diskusi'=>$id,'id_siswa'=>$siswa));
        if($cek->num_rows() > 0){
           
               
                $dataLike = "<div class='my-1 mr-2 h6' id='like' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."'>
                        <ion-icon name='heart' role='img' class='text-danger md hydrated' aria-label='heart outline'></ion-icon>
                    ".$like."</div>";   
            }else{
                
                    $dataLike = "<div class='my-1 mr-2 h6' id='like' data-id='".$this->encrypt->encode($row['id_diskusi'],keys())."'>
                    <ion-icon name='heart-outline' role='img' class=' md hydrated' aria-label='heart outline'></ion-icon>
                ".$like."</div>";  
                   
            
        }
        $dataComment = " <div class='my-1 h6' id='comment'>
            <ion-icon name='chatbubble-outline' role='img' class='md hydrated' aria-label='chatbubble outline'></ion-icon>
            ".$comment."
        </div>";
        $output = $dataLike.$dataComment;
        $total = $comment;
        echo json_encode(array('output'=>$output,'total'=>$total));
    }
}