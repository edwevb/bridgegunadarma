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
 	<link rel="stylesheet" href="{{ asset('assets/css/bridgeug.css') }}">
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
 <h2>Atlet Bridge Gunadarma</h2>
	  
  {{-- <p class="card-text"><small class="text-muted">downloaded by : {{getUserIpAddr()}}</small></p> --}}
  <p class="card-text"><small class="text-muted">{{$date}}</small></p>
  	<p class="text-muted font-italic">Major information</p>
 	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nama</th>
				<th>NIK/NPM</th>
				<th>Tanggal Lahir</th>
				<th>Telp</th>
				<th>Alamat</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($atlet as $a)
			<tr>
				<td>{{$a->atlet_name}}</td>
				<td>{{$a->nik}}</td>
				<td>
					@php $tgl_lahir = strtotime($a->tgl_lahir); @endphp
                    {{date("d M Y", $tgl_lahir)}}
				</td>
				<td>{{$a->telp}}</td>
				<td>{{$a->alamat}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<p class="text-muted font-italic mt-4">Minor information</p>
 	<table class="table table-striped">
		<thead class="bg_gradient-info">
			<tr>
				<th>Nama</th>
				<th>Fakultas</th>
				<th>Jurusan</th>
				<th>Angkatan</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($atlet as $b)
			<tr>
				<td>{{$b->atlet_name}}</td>
				<td>{{$b->fakultas}}</td>
				<td>{{$b->jurusan}}</td>
				<td>{{$b->angkatan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 </body>
 </html>

