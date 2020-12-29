

<html>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>



</head>
<style>
	body{
		background-color: #f3f5f7 !important;
	}
	.ticket{
		border:1px solid #fff;
		background: #fff;
	}
	.breadcrumb {
		padding: 15px 30px;
		margin-bottom: 20px;
		list-style: none;
		background-color: #869CCC;
		border-radius: 4px;
		color:#fff;
	}
	.breadcrumb>.active {
		color: #fff;
	}
	a {
		color: #fff;
		text-decoration: none;
	}
	form .error {
  color: #ff0000;
}

</style>
<body>
<div class="headerTicket">



</div>

<div class="container ">


<div class="col-md-3"></div>
	<?php if ( $this->session->flashdata( 'message' ) ) : ?>
		<h5 style="color:red"><?php echo $this->session->flashdata( 'message' ); ?></h5>
	<?php endif; ?>
	<div class="col-md-6 ticket" >

		<h3>Registration Form</h3><br>
		<form method="post" id="ticketForm"name="registration" action="<?php echo base_url() ?>index.php/registerlogin/register" enctype="multipart/form-data">

			<div class="form-group">
				<label for="projectUrl">First Name:</label>
				<input type="text" class="form-control" id="subject" 	 placeholder="First Name" name="first_name" required>
			</div>
			<div class="form-group">
				<label for="projectUrl">Last name:</label>
				<input type="text" class="form-control" id="subject"pattern="^[a-zA-Z ]*$" placeholder="Last name" name="last_name" required>
			</div>
			<div class="form-group">
				<label for="projectUrl">Email Id :</label>
				<input type="email" class="form-control" id="subject" placeholder="Email" name="emailid" required>
			</div>

			<div class="form-group">
				<label for="subject">Designation:</label>
				<input type="text" class="form-control" id="subject" placeholder="Designation" name="designation" required>
			</div>
			<div class="form-group">
				<label for="subject">Date Of Birth:</label>
				<input type="date" class="form-control" id="subject" placeholder="Date" id="datepicker" name="date" required>
			</div>
			<div class="form-group">
				<label for="subject">Mobile:</label>
				<input type="text" class="form-control" id="subject" placeholder="Mobile" name="mobile" required>
			</div>

			<div class="form-group">
				<label for="subject">Password:</label>
				<input type="text" class="form-control" id="subject" placeholder="Password" name="password" required>
			</div>
			<div class="form-group">
				<label for="subject">Confirm Password:</label>
				<input type="text" class="form-control" id="subject" placeholder="Confirm Password" name="confirm_password" required>
			</div>
			<div class="form-group">
				<label for="projectUrl">Profile Image</label>
				<input type="file"  value="" name="image" required>
			</div>


			<button type="submit" class="btn btn-default add">Submit</button>
		</form>
	</div>
	<div class="col-md-3" ></div>
</div>

</body>
</html>

<script>

jQuery.validator.addMethod(
  "regex",
   function(value, element, regexp) {
       if (regexp.constructor != RegExp)
          regexp = new RegExp(regexp);
       else if (regexp.global)
          regexp.lastIndex = 0;
          return this.optional(element) || regexp.test(value);
   },"erreur expression reguliere"
);
 $.validator.addMethod('filesize', function (value, element,param) {
   
  var size=element.files[0].size;
 
  size=size/1024;
  console.log(size);
  size=Math.round(size);
  console.log(size);
  return this.optional(element) || size <=param ;
  
}, 'File size must be less than {0}');

 $.validator.addMethod("maxDate", function(value, element) {
    var curDate = new Date();
    var inputDate = new Date(value);
    if (inputDate < curDate)
        return true;
    return false;
}, "Invalid Date!"); 
	$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      first_name:{required:true,
      	regex:/^[a-zA-Z'.\s]{1,40}$/},
      last_name: {required:true,
      	regex:/^[a-zA-Z'.\s]{1,40}$/},
      emailid: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      designation:{
      	required:true,
      	regex:/^[a-zA-Z'.\s]{1,40}$/,
      },
      mobile:{
      	required:true,
      	regex:/^[0-9]*$/,
      },
       
      password: {
        required: true,
        minlength: 8
      },
      confirm_password:{
        required: true,
        minlength: 8
        // equalTo:"#password"
      },
      image: {
                required: true,
                extension: "jpg,jpeg",
                filesize: 40
            },
      date: {
            required: true,
            date: true,
            maxDate: true
        }
    },
    // Specify validation error messages
    messages: {
      first_name: {
      	required:"Please enter your first name",
      	regex:"Please enter only alphabet string"
      },
      last_name:  {
      	required:"Please enter your last name",
      	regex:"Please enter only alphabet string"
      },
      designation:  {
      	required:"Please enter your designation",
      	regex:"Please enter only alphabet string"
      },
      mobile:  {
      	required:"Please enter your mobile number",
      	regex:"Please enter only numbers"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
      },
      confirm_password: {
        required: "Please provide a confirm password",
        minlength: "Your confirm password must be same as password"
        // equalTo: "Your confirm password must be same as password"
      },
      emailid: {
      	required:"Please enter a email address",
      	email:"Please enter a valid email address"
      },
      image:{
      	required:"Please choose profile photo",
      	extension:"File must be jpg or jpeg format",
      	filesize:"File size must be between 20kb and 40kb"
      },
      date:{
      	required:"Please select date of birth",
      	maxDate:"Invalid date of birth"
      }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>