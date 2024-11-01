			jQuery(document).ready(function(){			
				UpdateFields();
				document.addEventListener('click', UpdateFields);

				function UpdateFields(){
					//Out of Stock Notice
				    if ( !document.getElementById('stwc_ft_oosn_0').checked ) {
				       document.getElementById('stwc_ft_oosn_notice_1').setAttribute("disabled","disabled");
				    } else {
				       document.getElementById('stwc_ft_oosn_notice_1').removeAttribute("disabled");
				    }

				    //Discount Percentage or Removes Sale Badge				    
				    if (document.getElementById('stwc_ft_oosn_0').checked ) {
				    	//document.getElementById('stwc_ft_saba_8').setAttribute("disabled","disabled");
				    	document.getElementById('stwc_ft_saba_8').disabled = true;
				    } else {
				    	//document.getElementById('stwc_ft_saba_8').removeAttribute("disabled");
				    	document.getElementById('stwc_ft_saba_8').disabled = false;
				    }

				    if ( document.getElementById('stwc_ft_saba_8').checked ) {
				    	//document.getElementById('stwc_ft_saba_7').setAttribute("disabled","disabled");
				    	document.getElementById('stwc_ft_oosn_0').disabled = true;
				    } else {
				    	//document.getElementById('stwc_ft_saba_7').removeAttribute("disabled");
				    	document.getElementById('stwc_ft_oosn_0').disabled = false;
				    }				    
							    					    				        
				}				
			});			