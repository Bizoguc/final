	 <script type="text/javascript">
		$(document).ready(function () {
			var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
  		console.log(pgurl);
   		  $(".nav.navbar-nav").find('li').each(function(){
    		  // console.log($(this));
          var $a = $(this).find('a');
          if($a.attr("href") == pgurl || $a.attr("href") == '' )
          $(this).addClass("active");
     });

     });
     </script>
