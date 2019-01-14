<?php
include_once("dbconfig.php");
if(isset($_POST['update']))
{    
	$FName=$_POST['FName'];
    $LName=$_POST['LName'];
    $UName=$_POST['UName'];  
	$NIC = $_POST['NIC'];
	$Mobile=$_POST['Mobile'];
    $Address=$_POST['Address'];
    $AccountType=$_POST['AccountType'];  
	$pin = $_POST['pin'];
	$CardNumber=$_POST['CardNumber'];
    $ExpDate=$_POST['ExpDate'];
    $CardType=$_POST['CardType'];  	
    $amount=$_POST['amount'];

		$rresult =  "UPDATE `customer` SET FName='$FName',LName='$LName',UName='$UName',NIC='$NIC',Mobile='$Mobile',Address='$Address',AccountType='$AccountType',pin='$pin',CardNumber='$CardNumber',ExpDate='$ExpDate',CardType='$CardType',amount='$amount' WHERE Mobile=$Mobile";
		$result = mysqli_query($conn, $rresult);
       
        header("Location: customer.php");
 }

?>
<?php
		include_once("dbconfig.php");

		$Mobile = $_GET['Mobile'];
		$rresulta =  "SELECT * FROM `customer` WHERE Mobile=$Mobile";
		$resulta = mysqli_query($conn, $rresulta);
		while($res = mysqli_fetch_array($resulta))
		{
			$FName = $res['FName'];
			$LName = $res['LName'];
			$UName = $res['UName'];
			$NIC = $res['NIC'];
			$Mobile = $res['Mobile'];
			$Address = $res['Address'];
			$AccountType = $res['AccountType'];
			$pin = $res['pin'];
			$CardNumber = $res['CardNumber'];
			$ExpDate = $res['ExpDate'];
			$CardType = $res['CardType'];
			$amount = $res['amount']; 
		}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Besafe - Update Customer</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
  <link rel = "stylesheet" type = "text/css" href = "css/jquery-ui.css" />
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>Be<span>SAFE</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-tasks"></i>
              <span class="badge bg-theme">4</span>
              </a>
            <ul class="dropdown-menu extended tasks-bar">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">You have 4 pending tasks</p>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Dashio Admin Panel</div>
                    <div class="percent">40%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Database Update</div>
                    <div class="percent">60%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                      <span class="sr-only">60% Complete (warning)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Product Development</div>
                    <div class="percent">80%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      <span class="sr-only">80% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.html#">
                  <div class="task-info">
                    <div class="desc">Payments Sent</div>
                    <div class="percent">70%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      <span class="sr-only">70% Complete (Important)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li class="external">
                <a href="#">See All Tasks</a>
              </li>
            </ul>
          </li>
          <!-- settings end -->
          <!-- inbox dropdown start-->
          <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-theme">5</span>
              </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">You have 5 new messages</p>
              </li>
              <li>
                <a href="index.html#">
                  <span class="photo"><img alt="avatar" src="img/ui-zac.jpg"></span>
                  <span class="subject">
                  <span class="from">Zac Snider</span>
                  <span class="time">Just now</span>
                  </span>
                  <span class="message">
                  Hi mate, how is everything?
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="photo"><img alt="avatar" src="img/ui-divya.jpg"></span>
                  <span class="subject">
                  <span class="from">Divya Manian</span>
                  <span class="time">40 mins.</span>
                  </span>
                  <span class="message">
                  Hi, I need your help with this.
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="photo"><img alt="avatar" src="img/ui-danro.jpg"></span>
                  <span class="subject">
                  <span class="from">Dan Rogers</span>
                  <span class="time">2 hrs.</span>
                  </span>
                  <span class="message">
                  Love your new Dashboard.
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="photo"><img alt="avatar" src="img/ui-sherman.jpg"></span>
                  <span class="subject">
                  <span class="from">Dj Sherman</span>
                  <span class="time">4 hrs.</span>
                  </span>
                  <span class="message">
                  Please, answer asap.
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.html#">See all messages</a>
              </li>
            </ul>
          </li>
          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->
          <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-bell-o"></i>
              <span class="badge bg-warning">7</span>
              </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-yellow"></div>
              <li>
                <p class="yellow">You have 7 new notifications</p>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                  Server Overloaded.
                  <span class="small italic">4 mins.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-warning"><i class="fa fa-bell"></i></span>
                  Memory #2 Not Responding.
                  <span class="small italic">30 mins.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                  Disk Space Reached 85%.
                  <span class="small italic">2 hrs.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-success"><i class="fa fa-plus"></i></span>
                  New User Registered.
                  <span class="small italic">3 hrs.</span>
                  </a>
              </li>
              <li>
                <a href="index.html#">See all notifications</a>
              </li>
            </ul>
          </li>
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="login.html">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    
<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include 'sidebar.php';?>

    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">


      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>Update Customer</h3>

       <section class="wrapper">
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table">
				 <form name="form1" method="post" action="update.php">
								<table border="0">
									<tr>
										<td >First Name</td>
										<td><input type="text"  name="FName"  id="FName" value="<?php echo $FName;?>"    autocomplete="off" pattern='[A-Za-z\\s]*'
												   oninvalid="this.setCustomValidity('Only characters are allowed')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')" checked required /><br>
											</td>
									</tr>
									<tr>
										<td  >Last Name</td>
									
													<td><input type="text" name="LName"  id="LName" value="<?php echo $LName;?>" autocomplete="off" pattern='[A-Za-z]+'
												   oninvalid="this.setCustomValidity('Only characters are allowed')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')" checked required /><br>
											</td>
									</tr>
									<tr>
										<td  >User Name</td>
									
													<td><input type="text" 
												   name="UName"  id="UName" value="<?php echo $UName;?>" autocomplete="off" pattern="[a-z0-9._%+-]{1,40}[@]{1}[a-z]{1,10}[.]{1}[a-z]{3}"
												   oninvalid="this.setCustomValidity('Incorrect')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')"  placeholder="valid@gmail.com" checked required /><br>
											</td>
									</tr>
									<tr>
										<td  >NIC Number</td>
										<td><input type="text" 
												   name="NIC"  id="NIC"  value="<?php echo $NIC;?>" autocomplete="off" pattern='\d{9}[x|X|v|V]|\d{11}[x|X|v|V]' 
												   oninvalid="this.setCustomValidity('Check Correct NIC Number')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')" checked required /><br>
											</td>
									</tr>
									<tr>
										<td  >Phone Number</td>
										<td><input type="text" 
												   name="Mobile" id="Mobile" value="<?php echo $Mobile;?>" autocomplete="off"
												   maxlength="10"  oninvalid="this.setCustomValidity('Check Correct Phone Number')"  
												 checked required/><br>
											</td>
									</tr>
									<tr>
										<td  >Address</td>
										<td><input type="text" name="Address" id="Address"value="<?php echo $Address;?>" autocomplete="off" pattern="[a-zA-Z0-9]| |/|\\|@|#|\$|%|&)+" 
												    oninvalid="this.setCustomValidity('Check address ')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')"  checked required /><br>
											</td>
									</tr>
									
									<tr>
										<td  >Account Type</td>
										<td> <select id = "AccountType" name="AccountType" value="<?php echo $AccountType;?>">
												<option value = "Saving Account">Saving Account</option>
												<option value = "Current Account">Current Account</option>
										
											</select></td>
									</tr>
									<tr>
										<td  >Pin Number</td>
										<td><input type="text" 
												   name="pin" id="pin"value="<?php echo $pin;?>" autocomplete="off" pattern="[0-9]{4}" 
												    oninvalid="this.setCustomValidity('Check pin Number')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')" maxlength="4" checked required /><br>
											</td>
									</tr>
									<tr>
										<td  >Card Number</td>
											<td><input type="text" name="CardNumber" id="CardNumber"value="<?php echo $CardNumber;?>" autocomplete="off" pattern='^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$' 
												   oninvalid="this.setCustomValidity('Check Card Number')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')" maxlength="16" checked required /><br>
											</td>
									</tr>
									
									<tr>
										<td  >Expire Date</td>
										<td><input type="text" name="ExpDate" data-date-format='yyyy-mm-dd' autocomplete="off"   id="select_date"value="<?php echo $ExpDate;?>" /></td>
									</tr>
									
									<tr>
										<td  >Card Type</td>
										<td> <select id = "CardType" name="CardType" value="<?php echo $CardType;?>">
												<option value = "Credit card">Credit card</option>
												<option value = "Debit card">Debit card</option>
										
											</select></td>
										
									</tr>
									<tr>
										<td  >Amount</td>
										<td><input type="text" name="amount"   id="amount" value="<?php echo $amount;?>" autocomplete="off" pattern="[0-9]+" 
												    oninvalid="this.setCustomValidity('check amount')"  
												   onchange="try{setCustomValidity('')}catch(e){}"
					     						   oninput="setCustomValidity(' ')" checked required/></td>
									</tr>
								
        
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
		</form>
                               
            </div>
          </div>
          <!-- page end-->
        </div>

      </section>
        <!-- /row -->
      </section>
      


      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>BESAFE</strong>.
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          besafe   footer</a>
        </div>
        <a href="advanced_table.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script>
  
  <script src="script/jquery-1.12.4.js"></script>
<script src="script/jquery-ui.js"></script>

 <script type="text/javascript">

	 $(function(){
	        $("#select_date").datepicker({ dateFormat: 'yy-mm-dd',autoclose:true,
				todayHighlight:true,
				showOtherMonths:true,
				
				selectOtherMonth:true,
				autoclose:true,
				changeMonth:true,
				changeYear:true,
				minDate:new Date() });
	        $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
	            var minValue = $(this).val();
	            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
	            minValue.setDate(minValue.getDate()+1);
	            $("#to").datepicker( "option", "minDate", minValue );
	        })
	    });

	 
</script>	
</body>

</html>
