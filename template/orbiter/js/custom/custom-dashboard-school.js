/*
----------------------------------------------
    : Custom - Dashboard CRM js :
----------------------------------------------
*/
"use strict";
$(document).ready(function() {    
    /* -----  Apex Area Chart ----- */
    var quiz,date;
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var link = baseUrl+'/administrator/chartData';
   
    
    var options = {
        series: [],
        chart: {
          height: 350,
          type: 'bar',
        },
        dataLabels: {
          enabled: true
        },
        title: {
          text: '',
        },
        noData: {
          text: 'Loading...'
        },
        xaxis: {
          type: 'category',
          tickPlacement: 'on',
          labels: {
            rotate: -45,
            rotateAlways: true
          }
        }
      };
     
      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
      var data2 = [];
      $.getJSON({ url: link }, function (resp) {
        
          data2 = resp;
        
        var produce = []
       
        //loop through return data 
        $(resp).each(function(i, v) {
          
        //push values as x & y
        produce.push({
            "x": v.date,
            "y": v.quiz
        })
        
        })
       
        chart.updateSeries([{
        name: 'Partisipasi Siswa',
        data: produce //pass them here 
        }])
      });

      
});