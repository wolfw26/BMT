 	<center>
		<h2>Jumlah Karyawan Mendaftar</h2>
	</center>
 
	<div style="width: 80%;margin: 0px auto; ">
		<canvas id="myChart"></canvas>
	</div>
 
	<br/>
	<br/>	

<script src="../assets/chart/rpie.js"></script>

<script src="../assets/chart/chart.min.js"></script>

<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["HOD", "Admin", "IT", "SPV", "Mekanik", "Operator", "Driver", "Fuelman"],
			datasets: [{
				label: '',
				data: [
				<?php 
				$jumlah_hod = mysqli_query($db,"select * from peserta where id_ruang='6'");
				echo mysqli_num_rows($jumlah_hod);
				?>, 
				<?php 
				$jumlah_admin = mysqli_query($db,"select * from peserta where id_ruang='8'");
				echo mysqli_num_rows($jumlah_admin);
				?>, 
				<?php 
				$jumlah_it = mysqli_query($db,"select * from peserta where id_ruang='9'");
				echo mysqli_num_rows($jumlah_it);
				?>, 
				<?php 
				$jumlah_spv = mysqli_query($db,"select * from peserta where id_ruang='10'");
				echo mysqli_num_rows($jumlah_spv);
				?>,
				<?php 
				$jumlah_mekanik = mysqli_query($db,"select * from peserta where id_ruang='11'");
				echo mysqli_num_rows($jumlah_mekanik);
				?>,
				<?php 
				$jumlah_operator = mysqli_query($db,"select * from peserta where id_ruang='12'");
				echo mysqli_num_rows($jumlah_operator);
				?>,
				<?php 
				$jumlah_driver = mysqli_query($db,"select * from peserta where id_ruang='13'");
				echo mysqli_num_rows($jumlah_driver);
				?>,
				<?php 
				$jumlah_fuelman = mysqli_query($db,"select * from peserta where id_ruang='14'");
				echo mysqli_num_rows($jumlah_fuelman);
				?>,
				
				],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(19, 100, 0)',
				'rgba(255, 255, 0)',
				'rgba(100, 149, 237)',
				'rgba(165, 42, 42)',
				'rgba(250, 99, 71)'
				],
				borderColor: [
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)',
				'rgba(19, 100, 0)'
				
				
				],
				borderWidth: 1
			}]
		},
		options: {
			plugins:{
				legend:{
					display:false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>