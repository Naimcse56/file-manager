    

		function draw_contant(ref_id,calling_page)
		{     
           var http = new XMLHttpRequest();
		   
		   //document.getElementById(ref_id).innerHTML="<br><br><br><img src=\"../../../image/loading_progress.gif\" >";
		   
		   function draw_contant_response()
	       { 	
		    if(http.readyState ==4) 
		    {
             if(http.status==200)
		     {
              document.getElementById(ref_id).innerHTML= http.responseText;
             }
            }
           }
		   
		   http.open("GET",calling_page, true);
		   http.onreadystatechange = draw_contant_response;
		   http.send(null);
        }

	    function draw_value(ref_id,calling_page)
		{     
           var http = new XMLHttpRequest();
		   
		   //document.getElementById(ref_id).innerHTML="<br><br><br><img src=\"../../../image/loading_progress.gif\" >";
		   
		   function draw_contant_response()
	       { 	
		    if(http.readyState ==4) 
		    {
             if(http.status==200)
		     {
              document.getElementById(ref_id).value= http.responseText;
             }
            }
           }
		   
		   http.open("GET",calling_page, true);
		   http.onreadystatechange = draw_contant_response;
		   http.send(null);
        }

	    function draw_display(ref_id,calling_page)
		{     
           var http = new XMLHttpRequest();
		   
		   //document.getElementById(ref_id).innerHTML="<br><br><br><img src=\"../../../image/loading_progress.gif\" >";
		   
		   function draw_contant_response()
	       { 	
		    if(http.readyState ==4) 
		    {
             if(http.status==200)
		     {
              document.getElementById(ref_id).style.display=http.responseText;
             }
            }
           }
		   
		   http.open("GET",calling_page, true);
		   http.onreadystatechange = draw_contant_response;
		   http.send(null);
        }
 