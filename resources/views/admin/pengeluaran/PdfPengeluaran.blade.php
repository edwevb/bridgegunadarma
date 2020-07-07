@php
	    date_default_timezone_set("Asia/Jakarta");
	    $date = date("D, d-M-Y | H:i:s");
	    /*function getUserIpAddr(){
	      if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	          //ip from share internet
	          $ip = $_SERVER['HTTP_CLIENT_IP'];
	      }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	          //ip pass from proxy
	          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	      }else{
	          $ip = $_SERVER['REMOTE_ADDR'];
	      }
	      return $ip;
	  }*/
@endphp
<!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 	<meta charset="UTF-8">
 	<title>PDF</title>
 	<style>
 		table, th, td{
 			font-family: 'Nunito', 'Helvetica', sans-serif !important;
 		}
 		th,td{
 			width: 100%;
 		}
 	</style>
 </head>
 <body>
 	<img height="100" width="auto" class="imgug" src="{{ asset('assets/img/bridgeug.png') }}">
 	<h2>Laporan Pengeluaran Bridge Gunadarma</h2>
  <p class="card-text"><small class="text-muted">downloaded at : {{$date}}</small></p>
 	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Jenis Pengeluaran</th>
				<th>Tanggal</th>
				<th>Biaya Pengeluaran</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pengeluaran as $p)
			<tr>
				<th scope="row">{{$loop->iteration}}</th>
        <td>{{strtoupper($p->p_title)}}</td>
        <td>
          <?php $date = strtotime($p->p_date) ?>
          {{date("d M Y", $date)}}
        </td>
        <td>@rupiah($p->p_biaya)</td>
        <td>{{$p->p_keterangan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 </body>
 </html>

