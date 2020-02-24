<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="content">
		<?php
		$nim = $_GET['nim']; // mengambil data nim dari nim yang terpilih
	    ?>
	    
		<ul class="nav nav-tabs">
		  <li><a href="profile.php?nim=<?php echo $nim ?>">Profile</a></li>
		  <li class="active"><a href="#">Nilai</a></li>
		  <li><a href="spp.php?nim=<?php echo $nim ?>">SPP</a></li>
		  <li><a href="#">Menu 3</a></li>
		</ul>
			<h2><a href="data.php">Data Student </a> &raquo; Nilai Student</h2>
			<hr />	
			
			<table class="table table-striped">
			        <th>No</th>
					<th>Pelajaran</th>
					<th>Tanggal Input</th>
					<th>Nilai</th>
					<th>Input By</th>
			<?php
			$sql3 = mysqli_query($koneksi, "SELECT * FROM nilai WHERE kode_nis='$nim' order by tgl_input DESC");
			if(mysqli_num_rows($sql3) == 0){ 
						echo '<tr><td colspan="14">Data Nilai Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ 
			$no=1;					
				  while($row3 = mysqli_fetch_assoc($sql3)){
				?>
							<tr>
				            <td><?php echo $no ?>
				            <td><?php echo $row3['kode_pelajaran']; ?></td>
				            <td><?php echo $row3['tgl_input']; ?></td>
				            <td><b><?php echo $row3['nilai']; ?></b></td>
							<td><?php echo $row3['input_by']; ?></td>
				             </tr>
							<?php
					     $no++;
						}
					}
				?>
			   
			</table>
  </div>
	</div> <!-- /.content -->
	</div> <!-- /.container -->

<?php 
include("footer.php"); // memanggil file footer.php
?>