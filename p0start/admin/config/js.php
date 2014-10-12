<?php
// Javascript:




?>

<!-- Latest jQuery -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<!-- jQuery UI -->
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- TinyMCE -->
<script src="js/tinymce/tinymce.min.js"></script>

<!-- Dropzone -->
<script src="js/dropzone.js"></script>

<!-- atom.SaveOnBlur -->
<script src="js/jquery.atom.SaveOnBlur.js"></script>

<!-- Progressbar -->
<script src="js/progressbar.js"></script>

<!-- Skycons -->
<script src="js/skycons.js"></script>

<!-- X-editable -->
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<!-- Screen Leap -->
<!--<script type="text/javascript" src="http://api.screenleap.com/js/screenleap.js"></script>-->

<!-- Bootstrap Validator -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>

<!-- Fusion Charts -->
<script type="text/javascript" src="js/fusioncharts/fusioncharts.js"></script>
<script type="text/javascript" src="js/fusioncharts/themes/fusioncharts.theme.zune.js"></script>

<script>
	
	$(document).ready(function() {
		
		$("#console-debug").hide();
		
		$("#btn-debug").click(function() {
			
			$("#console-debug").toggle();
			
		});

		$(".btn-delete").on("click", function() {
			
			/* Retrieve button id */
			var selected = $(this).attr("id");
			
			var pageid = selected.split("del_").join("");
			
			/* Confirm deletion of page */
			var confirmed = confirm("Are you sure you want to delete this page?");
			
			if(confirmed == true) {
				/* Send info to another file */
				$.get("ajax/pages.php?id="+pageid);
			
				$("#page_"+pageid).remove();
				
			}

			/* Test */
			/*alert(selected);*/
		});
		
		$("#sort-nav").sortable({
			cursor: "move",
			update: function() {
				var order = $(this).sortable("serialize");
				$.get("ajax/list-sort.php", order);
			}
		});
		
		$('.nav-form').submit(function(event) {
			var navData = $(this).serializeArray();
			var navLabel = $('input[name=label]').val();
			var navID = $('input[name=id]').val();
			
			$.ajax({
				url: "ajax/navigation.php",
				type: "POST",
				data: navData
				
			}).done(function(){
				
				$("#label_"+navID).html(navLabel);
				
			});
			
			event.preventDefault();
		});
		
		$('input.piaCalc').keyup(function(event){
			// skip for arrow keys
			if(event.which >= 37 && event.which <= 40){
				event.preventDefault();
			}
			var $this = $(this);
		    var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
		      
		    var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
		      
		    //console.log(num2);
		      
		      
		    // the following line has been simplified. Revision history contains original.
		    $this.val(num2);
		});
		
		$('#piaCalc').bootstrapValidator({
			
	        feedbackIcons: {
	            valid: 'fa fa-check',
    			invalid: 'fa fa-times',
    			validating: 'fa fa-refresh'
            },
            
	        fields: {
            	'income[]': {
                	validators: {
                    	regexp: {
                    		regexp: '^[0-9\,]+$',
                        	message: 'The earnings input is invalid '
                    	}
                	}
            	}
        	}
	    });
		
    	$("canvas").each(function(){
    		var a = new Skycons({color: "#ecf0f1"});
    		var canvasId = $(this).attr("id");
    		var canvasValue = $(this).attr("value");
    		
    		
			if(canvasValue == "partly-cloudy-day") {
				var iconValue = Skycons.PARTLY_CLOUDY_DAY;
			} else if(canvasValue == "clear-night") {
				var iconValue = Skycons.CLEAR_NIGHT;
			} else if(canvasValue == "clear-day") {
				var iconValue = Skycons.CLEAR_DAY;
			} else if(canvasValue == "partly-cloudy-night") {
				var iconValue = Skycons.PARTLY_CLOUDY_NIGHT;
			} else if(canvasValue == "cloudy") {
				var iconValue = Skycons.CLOUDY;	
			} else if(canvasValue == "rain") {
				var iconValue = Skycons.RAIN;
			} else if(canvasValue == "sleet") {
				var iconValue = Skycons.SLEET;
			} else if(canvasValue == "snow") {
				var iconValue = Skycons.SNOW;
			} else if(canvasValue == "wind") {
				var iconValue = Skycons.WIND;
			} else if(canvasValue == "fog") {
				var iconValue = Skycons.FOG;
			} else {
				null
			};
			
    		a.set(canvasId, iconValue);
    		a.play();
  	
        });
        
        $('#panelZipcode').hide();
        $('a').click(function() {
        	$('#panelZipcode').toggle();
        });
        
		$.fn.editable.defaults.mode = 'popup';
		
		$('#inputZipCode').editable();
		
		// ACTIVATE progressbar.js
		$('.progress .progress-bar').progressbar();
		
		//Scrolling back to top button
		if ( ($(window).height() + 200) < $(document).height() ) {
		    $('#top-link-block').removeClass('hidden').affix({
		        // how far to scroll down before link "slides" into view
		        offset: {top:200}
		    });
		};
	
		if (!!$('.sticky').offset()) { // make sure ".sticky" element exists
			//Scrolling close button for clientview
			var stickyTop = $('.sticky').offset().top;
			$(window).scroll(function(){ // scroll event
	 
	    	var windowTop = $(window).scrollTop(); // returns number
	 
	  		});
	  	};
		
	}); // END document.ready();
	
	jQuery(document).ready(function() {
		jQuery('[rel=popover]').popover();
	});
	
	tinymce.init({
	    selector: ".editor",
	    theme: "modern",
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor colorpicker"
	   ],
	   content_css: "css/content.css",
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
	   style_formats: [
	        {title: 'Bold text', inline: 'b'},
	        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
	        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
	        {title: 'Example 1', inline: 'span', classes: 'example1'},
	        {title: 'Example 2', inline: 'span', classes: 'example2'},
	        {title: 'Table styles'},
	        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	    ]
	 });
	 
	 
	function RemoveRougeChar(convertString){
	    
	    
	    if(convertString.substring(0,1) == ","){
	        
	        return convertString.substring(1, convertString.length)            
	        
	    }
	    return convertString;
	    
	}
	
</script>

