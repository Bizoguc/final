
        $(document).ready(function(){
        $("#sendActivity").click(function(){
          if ( ($("#Name").val() == "") ){
            alert('กรอกชื่อกิจกรรม');
            event.preventDefault();
            $("#Name").attr("placeholder", "กรุณาใส่ชื่อกิจกรรม").val("").css({"border-color": "red",'color':'red'});
            $("#Name").parent().css({'color':'red'});
         
          }else if ( ($("#Detail").val() == "") ){
            alert('กรอกรายละเอียดกิจกรรม');
            event.preventDefault();
            $("#Detail").attr("placeholder", "กรุณากรอกรายละเอียดกิจกรรม").val("").css({"border-color": "red",'color':'red'});
            $("#Detail").parent().css({'color':'red'});

          }else if ( ($("#Date").val() == "") ){
            alert('กรอกวันที่จัดกิจกรรม');
            event.preventDefault();
            $("#Date").css({"border-color": "red",'color':'red'});
            $("#Date").parent().css({'color':'red'});

          }else if ( ($("#startActivity").val() == "") ){
            alert('กรอกเวลาที่เริ่มจัด');
            event.preventDefault();
            $("#startActivity").css({"border-color": "red",'color':'red'});
            $("#startActivity").parent().css({'color':'red'});

          }else if ( ($("#Hour").val() == "") ){
            alert('กรอกชั่วโมงที่ต้องเข้าร่วมกิจกรรม');
            event.preventDefault();
            $("#Hour").css({"border-color": "red",'color':'red'});
            $("#Hour").parent().css({'color':'red'});

          }else if ( ($("#Quan").val() == "") ){
            alert('กรอกจำนวนที่เปิดรับ');
            event.preventDefault();
            $("#Quan").css({"border-color": "red",'color':'red'});
            $("#Quan").parent().css({'color':'red'});

          }else if ( ($("#facultyActivity").val() == "") ){
            alert('กรุณาเลือกคณะที่จะจัด');
            event.preventDefault();
            $("#facultyActivity").css({"border-color": "red",'color':'red'});
            $("#facultyActivity").parent().css({'color':'red'});

          }else if( ($("#typeActivity").val() == "") ){
            alert('กรุณาเลือกประเภทกิจกรรม');
            event.preventDefault();
            $("#typeActivity").css({"border-color": "red",'color':'red'});
            $("#typeActivity").parent().css({'color':'red'});

          }
        });
      });


       
      $(document).ready(function(){
        $("#Name").on('input',function(){
          if (($("#Name").val() == "") ){
            $("#Name").parent().css({'color':'red'});
            $("#Name").attr("placeholder", "กรุณาใส่ชื่อกิจกรรม").css({"border-color": "red",'color':'red'});
          }else{
            $("#Name").parent().css({'color':''});
            $("#Name").css({"border-color":"","color":""});
          }
        });
      });

      $(document).ready(function(){
        $("#Detail").on('input',function(){
            if (($("#Detail").val() == "") ){
              $("#Detail").parent().css({'color':'red'});
              $("#Detail").attr("placeholder", "กรุณาใส่รายละเอียดกิจกรรม").css({"border-color": "red",'color':'red'});
            }else{
              $("#Detail").parent().css({'color':''});
              $("#Detail").css({"border-color":"","color":""});
            }
          });
        });


        $(document).ready(function(){
        $("#Date").change(function(){
            
              $("#Date").parent().css({'color':''});
              $("#Date").css({"border-color":"","color":""});
            
          });
        });

        $(document).ready(function(){
        $("#startActivity").on('input',function(){
            if (($("#startActivity").val() == "") ){
              $("#startActivity").parent().css({'color':'red'});
              $("#startActivity").attr("placeholder", "กรุณาใส่รายละเอียดกิจกรรม").css({"border-color": "red",'color':'red'});
            }else{
              $("#startActivity").parent().css({'color':''});
              $("#startActivity").css({"border-color":"","color":""});
            }
          });
        });

        $(document).ready(function(){
        $("#Hour").on('input',function(){
            if (($("#Hour").val() == "") ){
              $("#Hour").parent().css({'color':'red'});
              $("#Hour").css({"border-color": "red",'color':'red'});
            }else{
              $("#Hour").parent().css({'color':''});
              $("#Hour").css({"border-color":"","color":""});
            }
          });
        });
        
        $(document).ready(function(){
        $('#Quan').keyup(function(){
            if ($(this).val() >= 60){
              alert('สูงสุด 60 ที่นั่ง');
              $(this).val('60');
            }
          });
        });

        $(document).ready(function(){
        $("#Quan").on('input',function(){
            if (($("#Quan").val() == "") ){
              $("#Quan").parent().css({'color':'red'});
              $("#Quan").attr("placeholder", "กรุณากรอกจำนวนที่รับ").css({"border-color": "red",'color':'red'});
            }else{
              $("#Quan").parent().css({'color':''});
              $("#Quan").css({"border-color":"","color":""});
            }
          });
        });

        $(document).ready(function(){
        $("#facultyActivity").on('input',function(){
            if (($("#facultyActivity").val() == "") ){
              $("#facultyActivity").parent().css({'color':'red'});
              $("#facultyActivity").css({"border-color": "red",'color':'red'});
            }else{
              $("#facultyActivity").parent().css({'color':''});
              $("#facultyActivity").css({"border-color":"","color":""});
            }
          });
        });

        $(document).ready(function(){
        $("#typeActivity").on('input',function(){
            if (($("#typeActivity").val() == "") ){
              $("#typeActivity").parent().css({'color':'red'});
              $("#typeActivity").css({"border-color": "red",'color':'red'});
            }else{
              $("#typeActivity").parent().css({'color':''});
              $("#typeActivity").css({"border-color":"","color":""});
            }
          });
        });
