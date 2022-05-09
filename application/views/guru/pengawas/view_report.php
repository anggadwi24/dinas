

 <section id="about" class="about">
      <div class="container" data-aos="fade-down">
        
    
      <div class="container" >
         <div class="row">
           <div class="col-6">
             <input type="date" class="form-control" id="date" value="<?= date('Y-m-d')?>">
           </div>
           <div class="col-6">
             <select name="guru" id="guru" class="form-control">
               <option value="all">Semua</option>
               <?php 
                if($record->num_rows() > 0){
                  foreach($record->result_array() as $rec){
                    echo "<option value='".encode($rec['id_guru'])."'>".$rec['nama_guru']."</option>";
                  }
                 
                }
              ?>
             </select>
           </div>
           <div class="col-12 form-group my-2">
             <button class="btn btn-primary w-100" id="btnFilter">FILTER</button>
           </div>
           
           <div class="col-12 mt-3">
             <span id="title">Tanggal : <?= date('Y-m-d')?> | Guru : All</span>
           </div>
         </div>

      
         


           
        
        <div id="load_data" class="row mt-2 justify-content-center" >
   
          
        </div>
                
       
        
      </div>
  </section>






<script>
  $(document).ready(function(){
    $(document).on('click','.detail',function(){
        var id = $(this).attr('data-id');
        window.location = '<?= base_url('kepsek/detailReport?id=')?>'+id;
    })
    $(document).on('click','#btnFilter',function(){
        var date = $('#date').val();
        var guru = $('#guru').val();
        data(date,guru);
    })
    data('<?= date('Y-m-d')?>','all'); 
    function data(date,guru){
      $.ajax({
        type:'POST',
        data:{date:date,guru:guru},
        url:'<?= base_url('kepsek/dataReport')?>',
        dataType:'json',
        success:function(resp){
            $('#load_data').html(resp.output);
            $('#title').html(resp.title);
        }
      })
    }
  })
</script>
