<?php
session_start();




function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
$employeeData=CallAPI('GET','http://dummy.restapiexample.com/api/v1/employees',false);
// $employeeDelete=CallAPI('GET','http://dummy.restapiexample.com/api/v1/delete/1',false);


$empdata=json_decode($employeeData);
?>


<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" />  
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
  <style type="text/css">
    ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}

table.dataTable tbody tr {
    background-color: #ffffff;
}
.headertext{
  text-align: center  !important;
}
  </style>
    

</head>
    
    
<?php $base_url= "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>

<body style="background-color: #eee">

<div class="container">
  <?php if($_SESSION["email"]) {
?>
<h5 style="float: right;"><button type="button" class="btn" style="color: #000"><?php echo $_SESSION["email"]; ?></button>
<a href="logout.php" style="float: right;" tite="Logout"><button type="button" class="btn btn-info">Logout</button> </a></h5> 


<?php
}else{
  $_SESSION["error"]='Login first';
      header("location:loginform.php");
};?>
<div class="card">
  <h2 class="headertext">Employee List</h2>

       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addemp">Add Employee</button> 
       
       <div class="card-body" style="margin-top: 30px;">  
  <table class="table table-responsive" id="datatable" style="background-color: #2f647a">

    <thead style="color: #fff" >
      <tr>
        <th>ID</th>
        <th>Employee Name</th>
        <th>Employee Salary</th>
        <th>Employee Age</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
     <?php foreach($empdata->data as $emp){?>
      <tr>
        <td><?php echo $emp->id; ?></td>
        <td><?php echo $emp->employee_name;?></td>
        <td><?php echo $emp->employee_salary;?></td>
        <td><?php echo $emp->employee_age;?></td>
        <td> 
             
          <button class="btn btn-danger deleteemp" type="button"  data-id=<?=$emp->id?> data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
             
        </td>
      </tr>
     <?php }?>
    </tbody>
  </table>
  </div>   
  <div id="addemp" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="background-color: #eee;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Employee</h4>
      </div>
      <div class="modal-body">
        <div class="login-form">

        <!-- <form action="" method="post"> -->
       

          <h5 style="color:green" id='message_success'></h5>
         
          <div class="form-group">
            <input type="text" name="employee_name" id="employee_name" class="form-control" placeholder="Enter Name" required="required">
          </div>
          <div class="form-group">
            <input type="text" name="employee_salary" id='employee_salary' class="form-control" placeholder="Enter Salary" required="required">
          </div>
          <div class="form-group">
            <input type="text" name="employee_age" id='employee_age' class="form-control" placeholder="Enter Age" required="required">
          </div>
          <div class="form-group">
            <button type="submit" name='submit' id='adddata' class="btn btn-primary">Add</button>
          </div>

        <!-- </form> -->

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
   $('#datatable').dataTable(  
    {});  

  $('#adddata').click(function(){
    var employee_name=$('#employee_name').val();
    var employee_salary=$('#employee_salary').val();
    var employee_age=$('#employee_age').val();

     console.log(employee_name +' '+ employee_salary +' '+ employee_age);
    data={"name":employee_name,"salary":employee_salary,"age":employee_age};
    console.log(data);
     $.ajax({
              type: "POST",
              url: "http://dummy.restapiexample.com/api/v1/create",
              data: data,
              success: function(data) {
                console.log(data); 
                console.log(data['message']);
                $('#message_success').text(data['message']).delay(2000).fadeOut();
                // $.session.set('message',data['message']);
                $(".modal-body input").val("");
            swal("Record has been added successfully!", {
            icon: "success",
          });

                },
              // dataType: dataType
            });
  });


$('.deleteemp').click(function(){
    var employee_id=$(this).data('id');
   

     console.log(employee_id);
     // swal("Hello world!");
     swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
              type: "DELETE",
              url: "http://dummy.restapiexample.com/api/v1/delete/"+employee_id,
              // data: data,
              success: function(data) {
                console.log(data); 
                console.log(data['message']);
                // $('#message_success').text(data['message']).delay(2000).fadeOut();
                // $.session.set('message',data['message']);
                // $(".modal-body input").val("");


                },
              // dataType: dataType
            });
          swal("Poof! Record has been deleted!", {
            icon: "success",
          });
        } else {
          
        }
      });
    // data={"id":employee_id,"salary":employee_salary,"age":employee_age}
    // console.log(data);
    

  });

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
