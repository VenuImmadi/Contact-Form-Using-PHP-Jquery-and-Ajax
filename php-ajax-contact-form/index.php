<!DOCTYPE html>
<html>
<head>
<title>Contact From Using PHP, Jquery and Ajax</title>
<meta content="noindex, nofollow" name="robots">
<!-- Include CSS File Here -->
<style>
@import "http://fonts.googleapis.com/css?family=Raleway";
body{
font-family:'Raleway',sans-serif;
    background-color: #DDDDDD;
}
   .form-wrapper {
    width: 400px;
    margin: 0 auto;
    border: 1px solid #ccc;
    margin-top: 160px;
    padding-bottom: 40px;
	background-color: #fff;
}
    #contact_form{
   width: 321px;
    position:relative;
    margin:0 auto;
    }
#contact_form.field {
    width: 100%;
    clear: both;
} 
   #contact_form h1{
    font-size: 41px;
    display: block;
    text-align: center;
}
  #contact_form h1 span {
    display: block;
    font-size: 19px;
    margin-top: 5px;
}
#contact_form label {
    font-size: 15px;
    font-weight: 700;
    display: block;
    width: 100px;
}
#contact_form input,#contact_form textarea{

border:1px solid #DADADA;
margin-top:10px;
margin-bottom:10px;
padding-left: 5px;
width:310px;
height:30px;
font-size:14px;

}
  #contact_form  textarea{
    min-height:120px;
    }


#contact_form button {
    width: 158px;
    font-size: 15px;
}
#contact_form #submit {
    background-color: #EE7C2E;
    border-radius: 5px;
    border: none;
    padding: 10px 25px;
    color: #FFF;
    text-shadow: 1px 1px 1px #949494;
}
   #contact_form #reset{
    
    background-color:#59C19E;
border-radius:5px;
border:none;
padding:10px 25px;
color:#FFF;
text-shadow:1px 1px 1px #949494;
    }
	#message {
    margin-top: 10px;
    text-align: center;
    font-size: 14px;
}
#message li {
    list-style: none;
    color: red;
    font-weight: bold;
    text-align: left;
}
  
</style>
</head>
<body>
    <div class="form-wrapper">
      <form id="contact_form"   method="post">
            <h1>Contact From <span>Using PHP, Jquery and Ajax</span></h1>
            <div class="field">
                <label for="name">Name:</label>
                <input type="text" name="name" >
            </div>

            <div class="field">
                <label for="email">Email:</label>
                <input type="email"  name="email" >
            </div>

            <div class="field">
                <label for="message">Message:</label>
                <textarea name="message" ></textarea>
            </div>

            <div class="field">
            
                <button id="submit" type="submit">Send</button>
                <button  id="reset" type="reset">Reset</button>
            </div>
            <div id="message"></div>
        </form>
    </div> 
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
	$.fn.clearForm = function() {
	  return this.each(function() {
		var type = this.type, tag = this.tagName.toLowerCase();
		if (tag == 'form')
		  return $(':input',this).clearForm();
		if (type == 'text' || type == 'password' || type == 'email' || tag == 'textarea')
		  this.value = '';
		else if (type == 'checkbox' || type == 'radio')
		  this.checked = false;
		else if (tag == 'select')
		  this.selectedIndex = -1;
	  });
	};

 $("#contact_form").submit(function() {
  var $this = $(this);
		
    var url = "process.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
		   dataType: 'json',
           data: $("#contact_form").serialize(), // serializes the form's elements.
           success: function(data)
           {
            if(data.success == 'sent'){
				$('#message').html('');
              $('#message').html('your message has been sent successfully');
			  
			 $this.clearForm();
            
            }else{
				$('#message').html('');
				var errorData = $('#message').append($( "ul" ));
				//$('#message').html(errorData);
			$.each(data, function(i, val) {
           errorData.append( '<li>' + val + '</li>');
    });
				}
				
				//$('#message').html(errorData);
              
         }
         });

    return false; // avoid to execute the actual submit of the form.
});
    
    </script>
</body>
</html>