<?php 
    include("dbconfig.php");
?>
<?php 
  if(isset($_POST["btn-login"]))
  {
      $email=$_POST["txt_uname_email"];
      $pass=$_POST["txt_password"];
      
      $sql=mysqli_query($con,"select * from registration where email='$email' and password='$pass'");
      if(mysqli_num_rows($sql))
      {
          while($row=mysqli_fetch_array($sql))
          {   
              $name=$row["name"];
              $id=$row["usr_id"];
              session_start();
              $_SESSION["name"]=$name;
              $_SESSION["id"]=$id;
              $_SESSION["email"]=$email;
              
          }
        header("location:user.php");
      }
      else{
         //$error="";
         echo '<script>alert("plz inter valid password");</script>';


      }

  }

?>
<?php
if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$pic=$_FILES["img"]["name"];
    $tmp=$_FILES["img"]["tmp_name"];
    $type=$_FILES["img"]["type"];
   
      
    $path="user_images/".$pic;
	$icon="warning";
	$class="danger";
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($type=="application/pdf" || $type=="application/pdf" || $type=="application/x-zip-compressed")	{
		$error[] = "this type of file does not supported !";
		echo '<script>alert("this type of file does not supported !");</script>';	
	}
	else if($pic=="")	{
		$error[] = "Select Image !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}

	else
	{
		//$sql="insert into registration values();"
		$sql= mysqli_query($con,"insert into registration(name,email,image,password) values('$uname','$umail','$pic','$upass')");
		if($sql)
		{  
            move_uploaded_file($tmp,$path);
		   $error[] = "Registration successfully for login click on sign button";
		   echo '<script>alert("Registration successfully for login click on sign button");</script>';
		   $icon="success";
	       $class="success";	
		}
	}	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
</head>
<body>
   
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Logo Here</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     All Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#" data-toggle = "modal" data-target = "#myModal"><img src="./assets/Icons/Navigation icons/png/profile icon.png">&nbsp;&nbsp;&nbsp;&nbsp;Sign In<br> My Account<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Track<br><b>Order</b></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="#">Your<br><b>Order</b></a>
              </li>

          </ul>
          
        </div>
      </nav>
    <!-- navbar ends -->
    <!-- Modal for login -->
<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            
            
            <h4 class = "modal-title" id = "myModalLabel">
               Login here
            </h4>

            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
         </div>
         <form class="form-signin" method="post" id="login-form">
         
         <div class = "modal-body">
            <input type="email" name="txt_uname_email" placeholder="Enter Your email here" />
         </div>
         <div class = "modal-body">
            <input type="password" name="txt_password" placeholder="Enter Your password" />
         </div>
         <button class="btn btn-primary"> <a data-toggle = "modal" data-target = "#signupModal">signup</a></button>
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-primary" name="btn-login" value="LOG IN">
               
            </input>
			<button type = "button" class = "btn btn-danger" data-dismiss = "modal">
               Close
            </button>
            
        </form>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

<!-- Modal for login -->
<div class = "modal fade" id = "signupModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            
            
            <h4 class = "modal-title" id = "myModalLabel">
               Fill Detail here
            </h4>

            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            <form method="post" class="form-signin" enctype="multipart/form-data">
         </div>
         <div class = "modal-body">
            Name: <input type="text" name="txt_uname" placeholder="Enter Your name" required/>
         </div>
         
         <div class = "modal-body">
            Email : <input type="email" name="txt_umail" placeholder="Enter Your email here" required/>
         </div>
         <div class = "modal-body">
            Password: <input type="password" name="txt_upass" placeholder="Enter Your password" required/>
         </div>
         <div class = "modal-body">
            Slect Your Photo: <input type="file" name="img" required/>
         </div>
         
         <div class = "modal-footer">
            
            <input type = "submit" class = "btn btn-primary" value="SIGN UP" name="btn-signup">
			 <button type = "button" class = "btn btn-danger" data-dismiss = "modal">
               Close
            </button>
           
		   
            </input>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-2 categories">
            <ul>
                <li>
                    <img src="./assets/Icons/Category Icons/png/si-glyph_drill.png" alt="">
                    Power Tools
                </li>
                <li>
                    <img src="./assets/Icons/Category Icons/png/bx_bxs-car.png" alt="">
                    Automative Maintenance
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/fa-solid_solar-panel.png" alt="">
                    Solar           
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/flask.png" alt="">
                    Office Supplies
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/flask.png alt="">
                    Material Handling & packging
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/oil-can.png" alt="">
                    pumps
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/Vector-1.png" alt="">
                    Hand Tools
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/Vector-2.png" alt="">
                    Medical Supplies
                </li>                <li>
                    <img src="./assets/Icons/Category Icons/png/Vector-4.png" alt="">
                    Testing & measuring Instruments
                </li>
                <li>
                    <img src="./assets/Icons/Category Icons/png/Vector-6.png" alt="">
                    Testing & measuring Instruments
                </li>  <li>
                    <img src="./assets/Icons/Category Icons/png/Vector-5.png" alt="">
                    Agricultural Gardening & Landscaping
                </li>  <li>
                    <img src="./assets/Icons/Category Icons/png/tap.png" alt="">
                    Cleaning
                </li>  <li>
                    <img src="./assets/Icons/Category Icons/png/screwdriver.png" alt="">
                    Safety
                </li>
                <li>Power Tools</li>
            </ul>
        </div>
        <div class="col-9">
            <div class="mask">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./assets/Images/Mask Group 1.png" class="w-100" alt="">
                    </div>
                    <div class="col-md-6">
                        <img src="./assets/Images/Mask Group 2.png" class="w-100" alt="">
                    </div>
                </div>
                </div>
                
            <div class="row my-3 side">
                <div class="col-2">
                    <p>Power Tools</p>
                </div>
                <div class="col-2">
                    <button class="btn btn-success">View All</button>
                </div>
            </div>
            <div class="items">
                <div class="row">
                <?php
                for ($x = 6; $x <= 15; $x++) {?>
                
                <div class="col-2 cl">
                        <div class="card" style="width: 11rem;height:13rem">
                            <img class="card-img-top w-25" src="./assets/Images/Image <?=$x?>.png" alt="Card image cap">
                            <div class="card-body">
                              <p class="card-text">Product Name</p>
                              <p class="strike"><strike>Rs 999</strike></p>
                              <h5 class="card-title">Rs 499</h5>
                            </div>
                          </div>
                    </div>
                <?php }
                 ?>
                    <div class="col-2"></div>
                    <div class="col-2"></div>
                    <div class="col-2"></div>
                    <div class="col-2"></div>
                </div>
            </div>
            <div>
                <img src="./assets/Images/Mask Group 3.png" class="w-100" alt="">
            </div>

            <div class="row my-3 side">
                <div class="col-2">
                    <p>Best Sellers</p>
                </div>
                <div class="col-2">
                    <button class="btn btn-success">View All</button>
                </div>
            </div>
            <div class="items">
                <div class="row">
                <?php
                for ($x = 6; $x <= 15; $x++) {?>
                
                <div class="col-2 cl">
                        <div class="card" style="width: 11rem;height:13rem">
                            <img class="card-img-top w-25" src="./assets/Images/Image <?=$x?>.png" alt="Card image cap">
                            <div class="card-body">
                              <p class="card-text">Product Name</p>
                              <p class="strike"><strike>Rs 999</strike></p>
                              <h5 class="card-title">Rs 499</h5>
                            </div>
                          </div>
                    </div>
                <?php }
                 ?>    
                
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script> -->
</body>
</html>