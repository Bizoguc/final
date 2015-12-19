

    $(document).ready(function () {
       $("#activity").change(function () {
      
          	
          	 var id = $(this).val();

          	 console.log('Activity', id);

          	$.ajax({
			      url: "getActivity.php",
			      type: 'POST',
			      data: { activityId: id } //activityId ชื่อค่า : id value ค่า
			}).done(function(result) {
				console.log(result);
			   activity = (JSON.parse(result));
			   
		         $("#room").val("");
				 $("#activity_quan").val(activity.Activity_Quantity);
			
				 $("#activity_date").val(activity.Activity_Date);
			     $('#startActivity').val(activity.Activity_StartTime);
		         $('#endActivity').val(activity.Activity_StartTime);

		         // console.log(activity.Activity_Hour + activity.Activity_StartTime)

		          var hour = parseInt($('#endActivity').val()) +  parseInt(activity.Activity_Hour)
		          $('#endActivity').val(hour);

		         console.log(hour);
					}).error(function(){
						console.log("ERROR");
					});

					
		        });
		    });
