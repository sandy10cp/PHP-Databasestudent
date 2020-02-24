<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>

<?php
//$sql ="SELECT count(*) AS jumlah FROM mahasiswa";
$count = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
$result = mysqli_num_rows($count);
?>

<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">

	<!-- Start container -->
	<div class="container">
		<div class="content">
			<div class="jumbotron">
				<h1>Database Student</h1>
				<a href="data.php" data-toggle="tooltip" title="Lihat Data Student" class="btn btn-info" role="button"><span class="glyphicon glyphicon-list"></span> Lihat Data Student</a>
				<a href="tambah.php" data-toggle="tooltip" title="Tambah Data Student" class="btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span> Tambah Data</a>
			</div> <!-- /.jumbotron -->
	<div class="row">
		<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="data.php" style="text-decoration:none;color:black;">
					Total Student
					<span class="badge pull pull-right"><?php echo $result; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
			<div class="card">
			  <div class="cardHeader" style="background-color:green;">
				<h1 align="center"><font color="white"><?php echo date('d'); ?></font></h1>
			  </div>

			  <div class="cardContainer">
				<p><h4 align ="center"><?php echo date('l') .' '.date('d').', '.date('Y'); ?></h4></p>
			  </div>
			</div>
		</div>
			
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendar</div>
					<div class="panel-body">
						<div id="calendar"></div>
					</div>	
				</div>
			
			</div>
	</div>
	
		</div> <!-- /.content -->
	</div>
	<!-- End container -->
	
	<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>
<?php 
include("footer.php"); // memanggil file footer.php
?>