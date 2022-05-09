<?php
/*
-- ---------------------------------------------------------------
==== JUA KOPI ======
-- ---------------------------------------------------------------
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Kuis extends CI_Controller {
 	public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Makassar');
        $this->session->set_userdata('referred_from', current_url()); 
		cek_session();
    }
	function index(){
		$sesId = $this->session->id_qp;
		if($sesId){
			$data['number'] = $this->input->get('number');
			$data['key'] = $this->input->get('key');
			$data['title'] = 'Kuis Beasiswa';
			$id = $this->encrypt->decode($this->session->id_siswa,keys());
			update_session($id,date('Y-m-d'));
			$this->template->load('phpmu-tigo/template-kuis','phpmu-tigo/view_kuis',$data);

		}else{	
			$this->session->set_flashdata('message','Sesi Telah Berakhir');
			redirect('main');
		}
	}
	function saveAnswer(){
		$id = $this->session->id_qp;
        $id_qp = $this->encrypt->decode($id,keys());
        $id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
        update_session($id_siswa,date('Y-m-d'));
		$qp = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp))->row_array();
		$id_qa = $this->input->post('id_qa');
		$qa_soal = $this->input->post('qa_soal');
		$duration = $this->input->post('quiz_duration');
		$answer = $this->input->post('answer');
		$row = $this->model_app->view_where('quiz_answer',array('id_qa'=>$id_qa))->row_array();
		if($row['qa_keys'] == $answer){
			$pp = 2;
			$poin = $qp['qp_poin']+2;
			$correct = $qp['qp_correct']+1;
			$wrong = $qp['qp_wrong'];
			$status = true;
			$message = 'Selamat jawaban anda benar';

		}else{
			$rowQ = $this->model_app->view_where('quiz',array('id_quiz'=>$row['id_quiz']))->row_array();
			$status = false;
			$message = "<h6 class='d-block my-2 text-center'>Maaf jawaban anda salah</h6><center><img src='".base_url('asset/images/iconic.png')."' class='img-fluid my-2' style='height:120px;width:80px'></center>";
			$message .= "<span class='d-block text-center'>".str_replace(array('<p>','</p>'),'',$rowQ['correction'])."</span>";
			$pp =0;
			$poin = $qp['qp_poin'];
			$correct = $qp['qp_correct'];
			$wrong = $qp['qp_wrong']+1;
		}
		
		$dataQP = array('quiz_duration'=>$duration,'qp_poin'=>$poin,'qp_correct'=>$correct,'qp_wrong'=>$wrong);
		$this->model_app->update('quiz_partisipasi',$dataQP,array('id_qp'=>$id_qp));
		$dataQA = array('qa_answer'=>$answer,'qa_poin'=>$pp,'qa_status'=>'y','datetime'=>date('Y-m-d H:i:s'));
		$this->model_app->update('quiz_answer',$dataQA,array('id_qa'=>$id_qa));
		echo json_encode(array('status'=>$status,'msg'=>$message));
	}
	function getKuis(){
        $id = $this->input->get('id');
        $id_qp = $this->encrypt->decode($id,keys());
        $id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
        $cek = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa));
        if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$id_qp1 = $this->encrypt->encode($row['id_qp'],keys());
			$this->session->set_userdata(array('id_qp'=>$id_qp1));
            $last = $this->db->query("SELECT * FROM quiz_answer WHERE id_qp = '".$id_qp."' AND qa_status = 'n'  ORDER BY qa_soal ASC LIMIT 1")->row_array();
            redirect('kuis?number='.$last['qa_soal'].'&key='.$id_qp1);
        }else{
            $this->session->unset_userdata(array('id_qp'));
			redirect('main');
        }
    }
	function getKuisDetail(){
		$id = $this->session->id_qp;
		$id_qp = $this->encrypt->decode($id,keys());
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$data = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa));
		if($data->num_rows() > 0 ){
			$status = true;
			$row = $data->row_array();
		}else{
			$status = false;
			$row = null;
		}
		echo json_encode(array('status'=>$status,'row'=>$row));
	}
	function setExpired(){
		$id = $this->session->id_qp;
		$id_qp = $this->encrypt->decode($id,keys());
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$this->model_app->update('quiz_partisipasi',array('qp_finish'=>date('Y-m-d H:i:s'),'qp_done'=>'y'),array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa));
		$this->session->unset_userdata(array('id_qp'));
		$this->session->set_flashdata('message','Anda Kehabisan Waktu!');
		redirect('main');
	}	
	function setSave(){
		$id = $this->session->id_qp;
		$id_qp = $this->encrypt->decode($id,keys());
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$row = $this->model_app->view_where('quiz_partisipasi',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa))->row_array();
		$this->model_app->update('quiz_partisipasi',array('qp_finish'=>date('Y-m-d H:i:s'),'qp_done'=>'y'),array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa));
		$this->session->unset_userdata(array('id_qp'));
		
		$this->session->set_flashdata('success','Selamat anda sudah menyelesaikan quiz hari ini  dengan poin '.$row['qp_poin'].'!');

		redirect('main');
	}
	function cekLast(){
		$id = $this->session->id_qp;
		$id_qp = $this->encrypt->decode($id,keys());
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$last = $this->db->query("SELECT * FROM quiz_answer WHERE id_siswa = '".$id_siswa."' AND id_qp ='".$id_qp."' AND qa_status = 'n' ORDER BY qa_soal LIMIT 1 ")->row_array();
		echo json_encode($last['qa_soal']);
	}
	function updateDuration(){
		$id = $this->session->id_qp;
		$id_qp = $this->encrypt->decode($id,keys());
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$jam = $this->input->post('jam');
		$this->model_app->update('quiz_partisipasi',array('quiz_duration'=>$jam),array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa));
	}
	function getSoal(){
		$no = $this->input->post('no');
		$id = $this->session->id_qp;
		$id_qp = $this->encrypt->decode($id,keys());
		$id_siswa = $this->encrypt->decode($this->session->id_siswa,keys());
		$cek = $this->model_app->view_where('quiz_answer',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa,'qa_soal'=>$no));
		$soal = null;
		$answer_a = null;
		$answer_b = null;
		$answer_c = null;
		$answer_d = null;
		$title  = null;
		$row = null;
		$button = null;
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$qa = $this->model_app->view_where('quiz',array('id_quiz'=>$row['id_quiz']))->row_array();
			
			if($qa['image'] != NULL   ){
				$img = "<div class='col-6 mt-2'><img src='".$qa['image']."' class='img-fluid'></div>";
			}else{
				$img = "";
			}
			if($no ==  1 ){
				if(  $row['qa_status'] == 'n' AND $row['qa_answer'] == NULL){
					$button = "<div class='col-6'></div><div class='col-6'><button id='btnAnswer' class='btn btn-outline-primary w-100'><ion-icon name='save-outline'></ion-icon> JAWAB</button></div>"; 

				}else{
					$button = "<div class='col-6'></div><div class='col-6'><button type='button' id='btnNext' class=' w-100 btn btn-outline-primary' id='btnNext'>LANJUT <ion-icon name='caret-forward-outline'></ion-icon></button> </div>"; 

				}
			}else if($no > 1 AND $no <50){
				if(  $row['qa_status'] == 'n' AND $row['qa_answer'] == NULL){
					$button = "<div class='col-6'><button id='btnBack' class='w-100 btn btn-outline-danger'><ion-icon name='caret-back-outline'></ion-icon> KEMBALI </button></div><div class='col-6'><button id='btnAnswer' class='w-100 btn btn-outline-primary'><ion-icon name='save-outline'></ion-icon> JAWAB</button></div>"; 

				}else{
					$button = "<div class='col-6'><button id='btnBack' class='w-100 btn btn-outline-danger'><ion-icon name='caret-back-outline'></ion-icon> KEMBALI </button></div><div class='col-6'><button type='button' id='btnNext' class='w-100 btn btn-outline-primary'>LANJUT <ion-icon name='caret-forward-outline'></ion-icon></button> </div>"; 

				}	
			}else if($no == 50){
				$cekS = $this->model_app->view_where('quiz_answer',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa,'qa_status'=>'n'))->num_rows();
				if($cekS > 1){
					$button = "<div class='col-6'><button id='btnBack' class='w-100 btn btn-outline-danger'><ion-icon name='caret-back-outline'></ion-icon> KEMBALI </button></div><div class='col-6'><button  type='button' id='btnCek' class=' w-100 btn btn-outline-primary'><ion-icon name='save-outline'></ion-icon> FINISH </button> </div>"; 


				}else{
					$button = "<div class='col-6'><button id='btnBack' class='w-100 btn btn-outline-danger'><ion-icon name='caret-back-outline'></ion-icon> KEMBALI </button></div><div class='col-6'><button type='button' id='btnSave' class='w-100 btn btn-outline-primary'><ion-icon name='save-outline'></ion-icon> FINISH </button> </div>"; 

				}
			}
			$soal = $img."<div class='col-12 my-3'><h4 class='text-center '>".str_replace(array('<p>','</p>'),'',$qa['quiz'])."</h4></div>";
			$answer_a = str_replace(array('<p>','</p>'),'',$qa['answer_a']);
			$answer_b = str_replace(array('<p>','</p>'),'',$qa['answer_b']);
			$answer_c = str_replace(array('<p>','</p>'),'',$qa['answer_c']);
			$answer_d = str_replace(array('<p>','</p>'),'',$qa['answer_d']);
			$title = $row['qa_soal'].' / '.$this->model_app->view_where('quiz_answer',array('id_qp'=>$id_qp,'id_siswa'=>$id_siswa))->num_rows();


			$status = true;
		}else{
			$status = false;
		}
		$arr = array('status'=>$status,'answer_a'=>$answer_a,'answer_b'=>$answer_b,'answer_c'=>$answer_c,'answer_d'=>$answer_d,'soal'=>$soal,'title'=>$title,'row'=>$row,'button'=>$button);
		echo json_encode($arr);
	}
	 function dataSlide(){
	 	$output = "";
	 	$output .= "<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
			        <ol class='carousel-indicators'>";
		$slider = $this->db->query("SELECT * FROM slider ORDER BY id_gambar DESC");
		if($slider->num_rows() > 0){
		$no=0; 
			foreach($slider->result_array() as $count){
				if($no==0){
				    $output .= " <li data-target='#carouselExampleIndicators' data-slide-to='".$no."' class='active'></li>";
				}else{
					$output .= " <li data-target='#carouselExampleIndicators' data-slide-to='".$no."'></li>";
				}
			$no++;
			}
		$output .= "</ol><div class='carousel-inner'>";
		 $noo=1;
			 foreach($slider->result_array() as $ads){
			 	if($noo == 1){
			 		$output.=" 
			          <div class='carousel-item active'>
                            <img class='d-block w-100 lazyload' src='".base_url().'asset/slider/'.$ads[gambar] ."' alt='slide-".$noo."'>
			          </div>";
			 	}else{
			 		$output.=" 
			          <div class='carousel-item '>
                            <img class='d-block w-100 lazyload' src='".base_url().'asset/slider/'.$ads[gambar] ."' alt='slide-".$noo."'>
			          </div>";
			 	}
			 	$noo++;
			 }
			            
			              
	 	$output .=" 
			          		        
			        </div>
			        <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
			          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
			          <span class='sr-only'>Previous</span>
			        </a>
			        <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
			          <span class='carousel-control-next-icon' aria-hidden='true'></span>
			          <span class='sr-only'>Next</span>
			        </a>
			       </div>";
		}
		echo $output;

	 }
	public function start()
	{

		$status = $this->input->post('status');
		$this->session->set_userdata('status', $status); 

		$tgl = date('Y-m-d');
		$id_konsumen = $this->session->id_konsumen;
		$date = $this->model_app->view_where('quiz_date',array('tanggal'=>$tgl));
		$qd = $date->row_array();
		if($qd['status']== 'y'){
			$start = $qd['start'];
			$end = $qd['end'];

			if(date('H:i') < $start){
				$text = 'Kuis dimulai pukul :'.date('H:i',strtotime($start)).' WITA';
				$this->session->set_flashdata('message',$text);
				redirect('kuis/index/50');
			}else if(date('H:i') > $end){
					$this->session->set_flashdata('message','Kuis sudah ditutup');
				redirect('kuis/index/50');
			}else{
				$cek = $this->model_app->view_where('quiz_partisipasi',array('id_konsumen'=>$id_konsumen,'qd_id'=>$qd['qd_id'],'qp_status'=>$status,'qp_tambahan'=>'n'))->row_array();
		if(isset($cek)){
		$last=$this->db->query("SELECT * FROM quiz_user WHERE qp_id = $cek[qp_id]  ORDER BY qu_soal DESC LIMIT 1")->row_array();
		}
		
		if(isset($cek) AND $cek['qp_selesai'] == 'y' ){
			//echo "Maaf, anda sudah selesai menjawab kuis hari ini, silahkan kembali besok";
			$this->session->set_flashdata('message', 'Tugas Hari ini selesai, silahkan kembali besok untuk pertanyaan baru!');
			redirect('kuis/index/'.$status);
		}elseif( $last['qu_status'] == 'y'){
			$this->session->set_flashdata('message', 'Maaf, anda kehabisan waktu silahkan kembali besok!');
			redirect('kuis/index/'.$status);

		}elseif($cek['qp_selesai'] == 'n' ){
			$id=$this->db->query("SELECT * FROM quiz_user WHERE qp_id = $cek[qp_id] AND qu_status = 'n' ORDER BY qu_soal ASC LIMIT 1")->row_array();
			$soal = $id['qu_soal']-1;
			redirect('kuis/jawab/'.$soal);


		}
		else{
			$data = array('id_konsumen'=>$id_konsumen,
						  'qd_id'=>$qd['qd_id'],
						   'qp_status'=>$status);
			$this->model_app->insert('quiz_partisipasi',$data);
			$id = $this->db->insert_id();
			

			$soal = $this->db->query("SELECT * FROM `quiz` WHERE status = 'y' ORDER BY RAND() LIMIT $status")->result();
			$no = 1;
			foreach($soal as $s)
			{	
			    $dataqu = array('qp_id'=>$id,
								'quiz_id'=>$s->id_quiz,
								'id_konsumen'=>$id_konsumen,
								'qu_keys'=>$s->answer,
								'qu_soal'=>$no,
								'date'=>$qd['tanggal']);

				$this->model_app->insert('quiz_user',$dataqu);
				$no++;
			}
			redirect('kuis/jawab/0');
		}	
			}

		}else if($qd['status'] == 'n'){
			$this->session->set_flashdata('message',$qd['alasan']);
				redirect('kuis/index/50');

		}else if($date->num_rows() == 0){
			$this->session->set_flashdata('message','Tidak ada kuis');
				redirect('kuis/index/50');

		}
		

	}
	public function kuisjawab()

	{		
				$data['title'] = "KUIs";
				$this->load->view('/phpmu-tigo/kuis/index',$data);

	}
	public function jawab()
	{
			$id_konsumen = $this->session->id_konsumen;
			$status = $this->session->userdata('status');
			$tgl = date('Y-m-d');
			$id_konsumen = $this->session->id_konsumen;
			$date = $this->model_app->view_where('quiz_date',array('tanggal'=>$tgl));
			$qd = $date->row_array();
			$date = date('Y-m-d');
			$qp = $this->model_app->view_where_ordering_limit('quiz_partisipasi',array('id_konsumen'=>$id_konsumen,'qd_id'=>$qd['qd_id'],'qp_status'=>$status),'qp_id','DESC',0,1)->row_array();

			$config = array();
			
			$config['per_page'] = 1; 
			$config['uri_segment'] = 3;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$limit = $config['per_page'];
			$offset = $page;
			
			

			$config['base_url'] = site_url() . '/kuis/jawab/';   
		    $config['total_rows'] =$this->db->query("SELECT * FROM quiz_user JOIN quiz ON quiz_user.quiz_id = quiz.id_quiz WHERE id_konsumen = $id_konsumen AND date = '$date' AND qp_id = $qp[qp_id] ")->num_rows();
		    $data['total'] = $config['total_rows'];

			$data['kuis'] =$this->db->query("SELECT * FROM quiz_user JOIN quiz ON quiz_user.quiz_id = quiz.id_quiz JOIN quiz_partisipasi ON quiz_partisipasi.qp_id = quiz_user.qp_id WHERE quiz_partisipasi.id_konsumen = $id_konsumen AND date = '$date' AND quiz_user.qp_id = $qp[qp_id] LIMIT $offset,$limit ");
			$data['soal'] =$this->db->query("SELECT * FROM quiz_user JOIN quiz ON quiz_user.quiz_id = quiz.id_quiz WHERE id_konsumen = $id_konsumen AND date = '$date' AND qp_id = $qp[qp_id]  ");
			$data['terjawab'] = $this->db->query("SELECT * FROM quiz_user WHERE  id_konsumen = $id_konsumen AND date '$date' AND qp_id = $qp[qp_id] AND qu_status = 'n' ")->num_rows();


			$data['title'] = 'Kuis Online | Madam Cha ';
			$this->template->load(template().'/template-kuis','/phpmu-tigo/kuis/jawab',$data);

	}
	function chat(){
	 	
        $id = $this->session->id_konsumen;
        if(isset($id)){

           
	 	$data['title'] = "Customer Service - Seraphina";
	 
	 	 $cek = $this->model_app->view_where('chat_admin',array('konsumen'=>$id));
	 	 if($cek->num_rows() == 0){

	 	 	  $upt = array('konsumen'=>$id,'untuk'=>'admin','teks'=>'Terima kasih sudah menggunakan jasa kami, jika ada keluhan mohon hubungi kami','tanggal'=>date('Y-m-d H:i:s'),'read'=>'n','type'=>'teks','alur'=>'admin-konsumen','chat_by'=>'admin');
       			 $this->model_app->insert('chat_admin',$upt);
	 	 }


	 	$this->template->load(template().'/template-polos','/phpmu-tigo/kuis/chat',$data);

        }else{
            $this->session->set_flashdata('auth','Anda tidak login');
            redirect('auth/login');
        }
	 }
	 function displayChatAdmin(){
        $kode = $this->session->id_konsumen;
        $customer = $this->input->post('customer');

        $this->model_app->update('chat_admin',array('read'=>'y'),array('konsumen'=>$kode,'alur'=>'admin-konsumen'));
        $output = "";
        $data = $this->db->query("SELECT * FROM chat_admin WHERE konsumen = '$kode' ORDER BY id_ca ");
        $cus = $this->model_app->view_where('rb_konsumen',array('id_konsumen'=>$kode))->row_array();
         $foto_user = 'avatar'.rand(1,5).'.png';
        if($data->num_rows() > 0){
            foreach($data->result_array() as $row){
                $admin = $this->model_app->view_where('users',array('username'=>$row['chat_by'],''))->row_array();
                 if (!file_exists("asset/foto_user/$admin[foto]") OR $admin['foto']==''){
                    $foto_a = "blank.png";
                  }else{
                    $foto_a = $admin['foto'];
                  }
                   
                   if (!file_exists("asset/foto_user/$foto_user") OR $foto_user==''){
                    $foto = "blank.png";
                  }else{
                    $foto = $foto_user;
                  }


                  $date = date('Y-m-d',strtotime($row['tanggal']));
                  $time = date('H:i',strtotime($row['tanggal']));
                  $yes = date('Y-m-d', strtotime($date. ' +1 days'));
                  $now = date('Y-m-d');
                  $dt = date('d/m/Y',strtotime($row['tanggal']));
                  if($date == $now){
                    $chat_time = 'Hari Ini - '.$time;
                  }elseif($now ==  $yes){
                    $chat_time = 'Kemarin - '.$time;
                  }else{
                    $chat_time = $dt.' '.$time;
                  }
                  if($row['read'] == 'y'){
                    $show = " - Dilihat";
                  }else{
                    $show  = "";
                  }

                if($row['alur'] == 'konsumen-admin'){
                   if($row['type'] == 'teks'){
                      $output .= 
                    " <div class='outgoing_msg'>
                          <div class='sent_msg'>
                          <p class='text-left'>".$row['teks']."</p>
                          <span class='time_date text-left'> ".$chat_time." ".$show." </span> </div>
                        </div>";
                   }elseif($row['type'] == 'file'){
                    
                    $file = $row['teks'];
                         if (!file_exists("asset/chat/$file") OR $file==''){
                          $pp = base_url('asset/chat/blank.png');
                         }else{
                          $pp = base_url('asset/chat/').$file;
                         }
                      $output .= 
                    " <div class='outgoing_msg'>
                          <div class='sent_msg'>
                           <img src='".$pp."' class='img-fluid lazyload' style='min-width:100px;' onclick='zoomImg(this.src)' id='myImg'></img> 
                          <span class='time_date text-left'> ".$chat_time." ".$show." </span> </div>
                        </div>";
                   }
                  
                }elseif($row['alur'] == 'admin-konsumen'){
                    if($row['type'] == 'teks'){ 
                         $output .= 
                    "<div class='incoming_msg mb-2'>
                      <div class='incoming_msg_img'> <img src='".base_url('asset/foto_user/').$foto_a."' alt='foto-".$admin['nama_lengkap']."' class='rounded-circle' style='width:80px;height:80px;'>  </div>
                      <div class='received_msg'>
                      <div class='received_withd_msg'>
                        <p class='text-left'>".$row['teks']."</p>
                        <span class='time_date text-left'> ".$chat_time." </span></div>
                      </div>
                    </div>";
                    }elseif($row['type'] == 'file'){
                         $file = $row['teks'];
                         if (!file_exists("asset/chat/$file") OR $file==''){
                          $pp = base_url('asset/chat/blank.png');
                         }else{
                          $pp = base_url('asset/chat/').$file;
                         }
                         $output .= 
                    "<div class='incoming_msg mb-2'>
                    <div class='incoming_msg_img '> <img src='".base_url('asset/foto_user/').$foto_a."' alt='foto-".$admin['nama_lengkap']."' class='rounded-circle lazyload' style='width:80px;height:80px;'>  </div>
                      <div class='received_msg'>
                      <div class='received_withd_msg'>
                          <img src='".$pp."' class='img-fluid' style='min-width:100px;' id='myImg' onclick='zoomImg(this.src)'></img> 
                        <span class='time_date text-left'> ".$chat_time." </span></div>
                      </div>
                    </div>";
                    }
                   
                }
            }
        }else{
            $output = "";
        }
        echo $output;
    } 
      function sendChatAdmin(){
        $to = $this->input->post('to');
        $kode = $this->session->id_konsumen;
        $teks = $this->input->post('teks');

        $data = array('konsumen'=>$kode,'untuk'=>$to,'teks'=>$teks,'tanggal'=>date('Y-m-d H:i:s'),'read'=>'n','type'=>'teks','alur'=>'konsumen-admin','chat_by'=>$kode);
        $this->model_app->insert('chat_admin',$data);

       


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
            $kode = $this->session->id_konsumen;
            $dataupload = $this->upload->data();
            $status = "success";
         
            $data = array('konsumen'=>$kode,'untuk'=>$to,'teks'=>$dataupload['file_name'],'tanggal'=>date('Y-m-d H:i:s'),'read'=>'n','type'=>'file','alur'=>'konsumen-admin','chat_by'=>$kode);
            $this->model_app->insert('chat_admin',$data);

            
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status)));
    }
	public function save_answer()
	{
		$id = $this->input->post('qu_id');
		$answer = $this->input->post('answer');

		$cek = $this->model_app->view_where('quiz_user',array('qu_id'=>$id))->row_array();
		
		if($cek['qu_keys'] == $answer){
			$salah= 0;
			$benar = 1;
			$qu_poin = 1;
			$this->session->set_flashdata('benar', 'Selamat jawaban anda benar');

		}else{
			$qu_poin = 0;
			$benar=0;
			$salah=1;
			$this->session->set_flashdata('salah', 'Jawaban anda salah, silahkan menjawab soal selanjutnya');

		}

		$status = $this->input->post('status');
		$qp_id = $this->input->post('qp_id');
		$qp_cek = $this->db->query("SELECT * FROM quiz_partisipasi WHERE qp_id = $qp_id")->row_array();
		$qp_benar = $qp_cek['qp_benar'];
		$qp_salah = $qp_cek['qp_salah'];
		$qp_poin = $qp_cek['qp_poin'];

		$benar_qp = $qp_benar + $benar;
		$salah_qp = $qp_salah + $salah;

		if($status == 50)
		{
			$poin = $benar * 2;
		}elseif($status == 80)
		{
			$poin = $benar * 1.25;
		}
		else{
			$poin = $benar * 1;
		}
		$poin_qp = $qp_poin + $poin;

		$where_qp = array('qp_id'=>$qp_id);
		$data_qp = array('qp_salah'=>$salah_qp,'qp_benar'=>$benar_qp,'qp_poin'=>$poin_qp);
		$update_qp = $this->model_app->update('quiz_partisipasi',$data_qp,$where_qp);


		$where = array('qu_id'=>$id);
		$data = array('qu_answer'=>$answer,'qu_poin'=>$qu_poin,'qu_status'=>'y');
		$update = $this->model_app->update('quiz_user',$data,$where);


		echo json_encode($update);
	}
	public function expired()
	{
		$id = $this->uri->segment('3');
		$next = $this->uri->segment('4');
		$total = $this->uri->segment('5');
		$qp_id = $this->uri->segment('6');
		$last = $total-1;
		$where = array('qu_id'=>$id);
		$data = array('qu_status'=>'y');
		$update = $this->model_app->update('quiz_user',$data,$where);

		$qp_cek = $this->db->query("SELECT * FROM quiz_partisipasi WHERE qp_id = $qp_id")->row_array();
		
		$qp_salah = $qp_cek['qp_salah'];		
		$salah_qp = $qp_salah + 1;

		$this->model_app->update('quiz_partisipasi',array('qp_salah'=>$salah_qp),array('qp_id'=>$qp_id));


		if($total == $next)
		{
			$dataqp['qp_finish'] = date('Y-m-d H:i:s');
			$dataqp['qp_selesai'] = 'y';

			$whereqp['qp_id'] = $id;

			$update = $this->model_app->update('quiz_partisipasi',$dataqp,$whereqp);
			redirect('kuis/index/'.$total);
		}else{
			
			$this->session->set_flashdata('message', 'Maaf, anda kehabisan waktu!');
			redirect('kuis/jawab/'.$next);

		}

		

	


		
	}
	public function finish()
	{
		$id = $this->input->post('qu_id');
		$answer = $this->input->post('answer');
		$qp_id  = $this->input->post('qp_id');


		$cek = $this->model_app->view_where('quiz_user',array('qu_id'=>$id))->row_array();
		
		if($cek['qu_keys'] == $answer){
			$qu_poin = 1;
		}else{
			$qu_poin = 0;
		}

		$where = array('qu_id'=>$id);
		$data = array('qu_answer'=>$answer,'qu_poin'=>$qu_poin);
		$id_konsumen = $this->session->id_konsumen;
			

		$date = date('Y-m-d');
		
		$update = $this->model_app->update('quiz_user',$data,$where);

		$benar =$this->db->query("SELECT * FROM quiz_user JOIN quiz ON quiz_user.quiz_id = quiz.id_quiz WHERE id_konsumen = $id_konsumen AND date = '$date' AND qp_id = $qp_id  AND qu_poin = 1 ")->num_rows();
		$salah =$this->db->query("SELECT * FROM quiz_user JOIN quiz ON quiz_user.quiz_id = quiz.id_quiz WHERE id_konsumen = $id_konsumen AND date = '$date' AND qp_id = $qp_id  AND qu_poin = 0 ")->num_rows();
		
		
		
		
		$tot = $this->input->post('total');

		if($tot == 50)
		{
			$dataqp['qp_poin'] = $benar * 2;
		}elseif($tot == 80)
		{
			$dataqp['qp_poin'] = $benar * 1.25;
		}
		else{
			$dataqp['qp_poin'] = $benar * 1;
		}

		$dataqp['qp_benar'] = $benar;
		$dataqp['qp_salah'] = $salah;
		$dataqp['qp_finish'] = date('Y-m-d H:i:s');
		$dataqp['qp_selesai'] = 'y';

		$whereqp['qp_id'] = $qp_id;

		$update = $this->model_app->update('quiz_partisipasi',$dataqp,$whereqp);
		
	}

}
?>