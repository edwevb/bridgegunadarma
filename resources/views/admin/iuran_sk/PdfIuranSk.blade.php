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
 	<h2>Laporan Kas Iuran SK Bridge Gunadarma</h2>
  <p class="card-text"><small class="text-muted">downloaded at : {{$date}}</small></p>
 	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
        <th scope="col">Nama Atlet</th>
        <th scope="col">Tanggal bayar</th>
        <th scope="col">Jumlah bayar</th>
			</tr>
		</thead>
		<tbody>
			 @foreach ($iuranSk->atlet as $atlet)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$atlet->atlet_name}}</td>
        <td>
          <?php $tgl_lahir = strtotime($atlet->pivot->sk_date) ?>
          {{date("D, d M Y", $tgl_lahir)}}
        </td>
        <td>@rupiah($atlet->pivot->sk_bayar)</td>
      </tr>
      @endforeach
       @if($iuranSk->atlet->isEmpty())
        <th class="text-center font-italic lead" colspan="4">No Data.</th>
      @else
	      <tr>
	        <td colspan="3" class="text-right"><h5>Total</h5></td>
	        <td>@rupiah($iuranSk->totalSk())</td>
	      </tr>
      @endif
		</tbody>
	</table>
 </body>
 </html>

