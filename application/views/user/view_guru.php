<section id="about" class="about" style='padding:30px !important'>
      <div class="container" data-aos="fade-up">

        
     
        <div class="row justify-content-center" id='data-guru'>
           
           <div class='col-6 mb-3'>
                <div class='row'>
                    <div class='col-12'>
                    <center><img src="https://scontent.fdps2-1.fna.fbcdn.net/v/t39.30808-6/s526x395/268908127_424664989143084_3015246576725207845_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFYu-QkayT9lQJdO6W3jTqSCEXs-Ma5U1kIRez4xrlTWbm55izF-x1ByeTOMzFpT5gmfHM61s769peEQzJvfugl&_nc_ohc=aOhMVzBQI48AX8ChfZE&_nc_ht=scontent.fdps2-1.fna&oh=00_AT9mTWlV1wkP50p8sc1ymEKc4tO72woh7-Laackmg1I7hg&oe=61C0F94D" class='img-fluid rounded-circle' style='width:80px;height:80px' alt=""></center>
                       
                    </div>
                    <div class='col-12 mt-1'>
                        <h5 class='text-center mb-0'>Bu Desak</h5>
                        <h6 class='text-center'>Kepala Sekolah</h6>
                    </div>
                </div>
           </div>

           <div class='col-6 mb-3'>
                <div class='row'>
                    <div class='col-12'>
                    <center><img src="https://scontent.fdps2-1.fna.fbcdn.net/v/t39.30808-6/s526x395/268908127_424664989143084_3015246576725207845_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFYu-QkayT9lQJdO6W3jTqSCEXs-Ma5U1kIRez4xrlTWbm55izF-x1ByeTOMzFpT5gmfHM61s769peEQzJvfugl&_nc_ohc=aOhMVzBQI48AX8ChfZE&_nc_ht=scontent.fdps2-1.fna&oh=00_AT9mTWlV1wkP50p8sc1ymEKc4tO72woh7-Laackmg1I7hg&oe=61C0F94D" class='img-fluid rounded-circle' style='width:80px;height:80px' alt=""></center>
                       
                    </div>
                    <div class='col-12 mt-1'>
                        <h5 class='text-center mb-0'>Bu Desak</h5>
                        <h6 class='text-center'>Kepala Sekolah</h6>
                    </div>
                </div>
           </div>
           <div class='col-12'><hr></div>
           <div class='col-12  mb-2'>
                <div class='row'>
                    <div class='col-4'>
                    <img src="https://scontent.fdps2-1.fna.fbcdn.net/v/t39.30808-6/s526x395/268908127_424664989143084_3015246576725207845_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFYu-QkayT9lQJdO6W3jTqSCEXs-Ma5U1kIRez4xrlTWbm55izF-x1ByeTOMzFpT5gmfHM61s769peEQzJvfugl&_nc_ohc=aOhMVzBQI48AX8ChfZE&_nc_ht=scontent.fdps2-1.fna&oh=00_AT9mTWlV1wkP50p8sc1ymEKc4tO72woh7-Laackmg1I7hg&oe=61C0F94D" class='img-fluid rounded-circle' style='width:80px;height:80px' alt="">
                       
                    </div>
                    <div class='col-8 mt-1'>
                        <h6 class='text-left mb-0'>Bu Desak</h6>
                        <span class='text-left'>Kepala Sekolah</span>
                        <span class='text-left'>08123812731</span>
                    </div>
                </div>
           </div>
            
        </div>
        
        
    </div>
</section>

<script>
    var key = $('#keyword').val();
    dataGuru();
    function dataGuru(){
        $.ajax({
            type:'POST',
            url:'<?= base_url('display/seeTeacher') ?>',
           
            beforeSend:function(){

            },success:function(resp){
                $('#data-guru').html(resp);
            },complete:function(){

            }
        })
    }
    $(document).on('input','#key',function(){
        if($(this).value == ''){
            dataGuru();
        }
    });
       
    
    $(document).on('submit','#formSearch',function(e){
        e.preventDefault();
        var key = $('#keyword').val();
        if(key == ''){
            dataGuru();
        }else{
            $.ajax({
            type:'POST',
            url:'<?= base_url('display/searchTeacher') ?>',
            data:{key:key},
           
            beforeSend:function(){

            },success:function(resp){
                $('#data-guru').html(resp);
            },complete:function(){

            }
        })
        }
       
    })
</script>