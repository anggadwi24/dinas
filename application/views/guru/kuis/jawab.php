

   <div class="container-fluid">
    <div class="row">
      
          <?php 
            $page = ($this->uri->segment(3)) + 1 ;
            $links = $this->uri->segment(3);
            $tr = $soal->num_rows();
            $total1 = $tr-1;

            


          ?>
          <?php foreach($kuis->result_array() as $ku){
        ?>
      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto" style="margin-bottom: 50px;">
        
        <div class="d-flex justify-content-center font-aur">
        <h2><?= '<b>'.$page.'</b> / '.$total?></h2>

        </div>
        <div class="d-flex justify-content-center font-aur">
        <span id="time"></span>
        
        </div>
        
        <div class="d-flex justify-content-center ">
        
          <?php if($ku['image']!=NULL){?>
        <img class="img-fluid" style="max-width: 400px;max-height: 400px;" src="<?= base_url('asset/foto_soal').'/'.$ku['image']?>" alt="Card image">
      <?php }?>
        </div>
        <div class="d-flex justify-content-center soal">
          <?= $ku['quiz']?>
     </div>
        
      </div>
      
    </div>
    
  </div>
   <div class="container-fluid">
    <div class="row">

      <label class="radio col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex  ">
     <input type="radio" id="answer" name="answer" value="A" <?php if($ku['qu_answer'] == 'A'){echo "checked";}?> >  <?= $ku['answer_a'];?><span class="checkmark"></span>
    </div>
        
        
      </label>
       <label class="radio col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex ">
          <input type="radio" id="answer" name="answer" value="B" <?php if($ku['qu_answer'] == 'B'){echo "checked";}?> > <?= $ku['answer_b'];?><span class="checkmark"></span>
        </div>
        
        
      </label>
       <label class="radio col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
      
        
        <div class="d-flex ">
     <input type="radio" id="answer" name="answer" value="C" <?php if($ku['qu_answer'] == 'C'){echo "checked";}?> > <?= $ku['answer_c'];?><span class="checkmark"></span>        </div>
        
        
     
      </label>
       <label class=" radio col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full-1 mx-auto">
        
        <div class="d-flex">
      <input type="radio" id="answer" name="answer" value="D" <?php if($ku['qu_answer'] == 'D'){echo "checked";}?>> <?= $ku['answer_d'];?><span class="checkmark"></span>
        </div>
        
        
      </div>
      
    </div>
    
  </div>
    <div class="row">

      
      <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 float-right box-full-1 mx-auto">
        <div class="d-flex justify-content-center ">
          <?php $next = $links+1;?>
          <?php if($links >= 0 && $links < $total1  ){?>
               
                  <input type="submit" name="next" id="next" value="JAWAB" class="sbm">
                
          
          <?php }else{
          if($terjawab == 1){
          ?>
                <input type="hidden" name="total" value="<?= $total?>"> 
            
                <input type="submit" name="next" id="finish" value="FINISH" class="sbm">
              
              <?php 
            }

          }?>
        </div>
      </div>
      
    </div>
    
  </div>
  <input type="hidden" name="status" value="<?= $ku['qp_status']?>">
  <input type="hidden" name="nextkuis" value="<?= $next ?>">
     <input type="hidden" name="qp_id" value="<?= $ku['qp_id']?>">
        <input type="hidden" name="date" value="<?= date('Y-m-d')?>">
        <input type="hidden" name="qu_id" value="<?= $ku['qu_id']?>">
        <input type="hidden" name="total" value="<?= $total?>">
    <?php }?>

        
  
 <div class="overlay"></div>
<div class="container-fluid">
      <div class="row">

        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12 box-full mx-auto">
          
          <div class="d-flex justify-content-center font-aur">
          <div class="d-flex p-2 bd-highlight"><h2>KUIS</h2></div>
          </div>
          <div class="allsoal">
        
        <?php 
            $no=1;
            $link = 0;

            foreach($soal->result_array() as $k){
          ?>
          <?php if($k['qu_answer'] == "" AND $k['qu_status']=='n'){?>

          <button type="button" id="belom" class="btn btn-secondary btn-lg num" data-id="<?= $link ?>"" style="margin-bottom: 3px;"><?= $no?></button>
          <?php }elseif($k['qu_answer'] == $k['qu_keys'] ){?>
        <button type="button" data-id="<?=$link ?>"" id="soal" class="btn btn-success btn-lg num" style="margin-bottom: 3px;"><?= $no?></button>

         <?php }else{?>
          <button type="button" data-id="<?=$link ?>" id="soal" class="btn btn-danger btn-lg num" style="margin-bottom: 3px;"><?= $no?></button>
         <?php } $no++; $link++; }?>         
          </div>
        </div>
          
          
        </div>
        
  </div>
