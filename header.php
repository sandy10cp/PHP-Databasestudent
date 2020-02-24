<?php require_once 'core.php'; ?>

<?php 
$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = {$id}";
$query = $koneksi->query($sql);
$result = $query->fetch_assoc();

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Database Student v1.0</title>
	<link rel="shortcut icon" href="img/logo_ilmututorial_32x32.jpg" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="https://maxcdn.bootsrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typehead/4.0.1/bootstrap3-typehead.min.js"></script>
	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tooltip.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
    <link href="style.css" rel="stylesheet">
	

	<script>
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
	</script>
	
	<style>
	@media (min-width: 760px){
		.dropdown:hover .dropdown-menu{
			display: block;
		}
	}
	</style>
	<!--
	Project      : Data Mahasiswa v1.0
	Description	 : CRUD (Create, read, Update, Delete) PHP, MySQLi dan Bootstrap
	Author		 : Firman Dwi Jayanto
	Author URI   : http://www.facebook.com/firmandije 
	Website		 : http://www.ilmututorial.com
	Email	 	 : firmandije[at]gmail.com, firman@firmandije.com
	-->
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	
  </head>
<body>
	<!-- Start navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
		
		<?php
		if($result['akses'] == 'Teacher')
		{
		?>
			<li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li><a href="data.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Student"><span class="glyphicon glyphicon-list"></span> Data Student</a></li>
			<li><a href="input_nilai.php" data-toggle="tooltip" data-placement="bottom" title="Input Nilai" ><span class="glyphicon glyphicon-list"></span> Input Nilai</a></li>
			<li><a href="jadwal.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Jadwal"><span class="glyphicon glyphicon-list"></span> Jadwal</a></li>
			<li class="dropdown" id="navSetting">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span><?php echo $result['nama_users']; ?></a>
			  <ul class="dropdown-menu">
				<li><a href="cpassword.php" data-toggle="tooltip" data-placement="bottom" title="Change Password" ><span class="glyphicon glyphicon-wrench"></span> Change  Password</a></li>
				<li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>           
			  </ul>
			</li> 
			
		<?php
		
		}
		else if($result['akses'] == 'Kepalasekolah')
		{
			
		echo '	
			<li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			<li class="dropdown" id="navSetting">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list"></i> <span class="caret"></span>Data Student</a>
				<ul class="dropdown-menu">
					<li><a href="data.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Student"><span class="glyphicon glyphicon-list"></span> View Student</a></li>
					<li><a href="tambah.php" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Student" ><span class="glyphicon glyphicon-plus"></span> Add Student</a></li>
				</ul>
			</li>
			<li><a href="datateacher.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Teacher"><span class="glyphicon glyphicon-list"></span> Teacher</a></li>
		    <li><a href="input_spp.php" data-toggle="tooltip" data-placement="bottom" title="Input SPP" ><span class="glyphicon glyphicon-list"></span> Input SPP</a></li>           
			<li><a href="input_nilai.php" data-toggle="tooltip" data-placement="bottom" title="Input Nilai" ><span class="glyphicon glyphicon-list"></span> Input Nilai</a></li>           
			<li class="dropdown" id="navSetting">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list"></i> <span class="caret"></span>Jadwal</a>
				<ul class="dropdown-menu">
					<li><a href="jadwal.php" data-toggle="tooltip" data-placement="bottom" title="Lihat Data Jadwal"><span class="glyphicon glyphicon-list"></span> View Jadwal</a></li>
					<li><a href="input_jadwal.php" data-toggle="tooltip" data-placement="bottom" title="Tambah Data Jadwal" ><span class="glyphicon glyphicon-plus"></span> Add Jadwal</a></li>
				</ul>
			</li>
			<li class="dropdown" id="navSetting">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span>'.$result['nama_users'].'</a>
			  <ul class="dropdown-menu">            
				<li><a href="users.php" data-toggle="tooltip" data-placement="bottom" title="Manage Users" ><span class="glyphicon glyphicon-wrench"></span> Manage Users</a></li>            
				<li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>           
			  </ul>
			</li>   
        </li>
		
		';
		}
		
	?>
		  </ul>
			<form name="cari" method="post" action="cari.php" role="search" class="navbar-form navbar-left">
				<div class="form-group">
					<input type="text" name="carinama" placeholder="Cari Nama Student" class="form-control">
				</div>
				<button type="submit" name="submit" id="submit" value="search" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Cari Data Student">Cari</button>
			</form>
		</div>
	  </div>
	</nav>
	<!-- End navbar -->