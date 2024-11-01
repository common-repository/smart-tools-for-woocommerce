			jQuery(document).ready(function(){			
				UpdateFields();
				document.addEventListener('click', UpdateFields);

				function UpdateFields(){		
				    //Add Custom Column
				    if ( !document.getElementById('stwc_ft_csco_3').checked ) {
				       document.getElementById('stwc_ft_csco_size_4').setAttribute("disabled","disabled");
				       document.getElementById('stwc_ft_csco_name_5').setAttribute("disabled","disabled");
				       document.getElementById('stwc_ft_csco_attribute_name_6').setAttribute("disabled","disabled");
				    } else {
				       document.getElementById('stwc_ft_csco_size_4').removeAttribute("disabled");
				       document.getElementById('stwc_ft_csco_name_5').removeAttribute("disabled");
				       document.getElementById('stwc_ft_csco_attribute_name_6').removeAttribute("disabled");
				    }		
					
				    //Add GDPR Compliant Checkbox
				    if ( !document.getElementById('stwc_ft_gdpr_11').checked ) {
				       document.getElementById('stwc_ft_gdpr_text_12').setAttribute("disabled","disabled");
				       document.getElementById('stwc_ft_gdpr_link_text_13').setAttribute("disabled","disabled");
				       document.getElementById('stwc_ft_gdpr_privacy_page_14').setAttribute("disabled","disabled");
				    } else {
				       document.getElementById('stwc_ft_gdpr_text_12').removeAttribute("disabled");
				       document.getElementById('stwc_ft_gdpr_link_text_13').removeAttribute("disabled");
				       document.getElementById('stwc_ft_gdpr_privacy_page_14').removeAttribute("disabled");
				    }				

				    //Set Role upon specific purchase
				    if ( !document.getElementById('stwc_ft_usro_15').checked ) {
				       document.getElementById('stwc_ft_usro_product_id_16').setAttribute("disabled","disabled");		
				       document.getElementById('stwc_ft_usro_role_17').setAttribute("disabled","disabled");				       		       
				    } else {
				       document.getElementById('stwc_ft_usro_product_id_16').removeAttribute("disabled");
				       document.getElementById('stwc_ft_usro_role_17').removeAttribute("disabled");				       
				    }			

				    //Add P.IVA / VAT to Billing
				    if ( !document.getElementById('stwc_ft_piva_18').checked ) {
				       document.getElementById('stwc_ft_piva_label_19').setAttribute("disabled","disabled");		
				       document.getElementById('stwc_ft_piva_placeholder_20').setAttribute("disabled","disabled");				       		       
				    } else {
				       document.getElementById('stwc_ft_piva_label_19').removeAttribute("disabled");
				       document.getElementById('stwc_ft_piva_placeholder_20').removeAttribute("disabled");				       
				    }							    					    				        
				}				
			});			