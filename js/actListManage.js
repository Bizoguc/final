


    	function delShowTime(showtimeId){
    		console.log(showtimeId);
    			$.ajax({
    				url: "deleteShowtime.php",
    				type: 'POST',
    				data: { dataShowTime: showtimeId }
            
    			}).done(function(result){
    				 var $delShowTime = $('#showtime-' + showtimeId);
    				 
             $td = $delShowTime.parent();

             $td.css({'background-color': 'white'});
         
    				 $delShowTime.remove();
    				 alert("ลบข้อมูลห้องกิจกรรมเรียบร้อย");
    			})
    	}

    	 	function getManage(dateShowTime) {

            $.ajax({ 
    			  url: "getManage.php",
    			  type: 'POST',
    			  data: { dataDate: dateShowTime }
    			  }).done(function(result) {

    			  var dateShowTime = result;
             
     			  console.log(dateShowTime.length);

            // reset table 
            $('table').find('td').each(function(index, value){
                var $td = $(this);
                $td.show();
                //$td.css({'background-color': 'red'});
            });


    			  $.each(dateShowTime, function( index, showTime ) {
      					

      					//console.log(showTime);

      					var $tdStartTime = $('#activity-' + showTime.Room_ID + '-' + showTime.StartTimeID);
      					var $tdEndTime =  $('#activity-' + showTime.Room_ID + '-' + showTime.EndTimeID);
      					
      					console.log($tdStartTime.index(), $tdEndTime.index());

      						$tdStartTime.html('<a id="showtime-'+ showTime.Showtime_ID +  '"showTime.Activity_Name href=javascript:void(0) onclick="delShowTime(' + showTime.Showtime_ID + ') ;return false;">' + ' ' + showTime.Activity_Name +'(ลบ)</a>');
      						$tdEndTime.html(showTime.Activity_Name);


      						var diff =  $tdEndTime.index() + 1  - $tdStartTime.index() ;
    				              console.log(showTime.Activity_Name);
    				              console.log('StartTime Index: ', $tdStartTime.index());
    				              console.log('EndTime Index: ', $tdEndTime.index());
    				              

                for (i = $tdStartTime.index() + 1; i <= $tdEndTime.index(); i++) {
                    var $tr = $tdStartTime.parent();
                    var $td = $tr.find('td:eq(' + i + ')')
                    
                    $td.hide();
                }



    	              $tdStartTime.attr('colspan', diff);

      						// console.log($tdStartTime.index(), $tdEndTime.index())

     

      						$tdStartTime.css({
      							'text-align': 'center',
      							'background-color':'#EEEEEE',
      							'color':'#000000',
      							'font-weight': 'bold',

      						});


                  //return false;
      						// $tdEndTime.html(showTime.Activity_Name + ' E');
    				});

     			

    			}).error(function(){
    				console.log("ERROR");
    			});
    	 	}

    	 

    	$(document).ready(function () {
        $("#iDate").change(function () {

    		$("#content > tbody").find('td:not(:first-child)').css({'background-color': 'white'}).attr('colspan', '').empty();

          		var id = $(this).val();

              	console.log('Date', id);

              	getManage(id);
    		});
         
         var date = new Date();
         console.log(date);
         var day = date.getDate();
      	 var monthIndex = date.getMonth() + 1;
      	 var year = date.getFullYear();
      	 console.log(day, monthIndex, year);
      	
      	 var datenow = year + '-' + monthIndex + '-' + day;
      	 console.log(datenow);
           
         getManage(datenow);
            // getManage("2015-11-10");
     });
          


