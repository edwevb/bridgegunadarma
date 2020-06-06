@extends('layout.detail')
@section('title', 'Prestasi Bridge Gunadarma')
@section('content')
	<article id="prestasi"> {{-- prestasi article --}}
		<div class="p-5 bg-gradient-light text-center rounded content-mobile">
			<div class="text-dark mx-auto my-4">
    		<h1>List Prestasi Bridge Gunadarma</h1>
    		<hr class="bg-gradient-info w-50" style="border-width: 3px;">
    	</div>
			<div class="row row-cols-1 row-cols-md-3 justify-content-center">
				@foreach ($data_prestasi as $prestasi)
					<div class="px-1 mb-5">
					  <div class="card-borderless shadow h-100 bg-dark rounded border-left-info">
					  	<div class="col-md p-2">
					  		<img height="250" width="auto" src="{{ asset('assets/img/img_pre/'.$prestasi->img_pre) }}" class="card-img-top rounded text-muted" alt="{!!$prestasi->pre_title!!}">
					  	</div>
					    <div class="card-body">
					      <h5 class="card-title text-white">{{$prestasi->pre_title}}</h5>
					      <p class="mb-4 card-subtitle text-muted">
					      	<?php $date = strtotime($prestasi->pre_date);
					      		echo date('d M Y',$date);
					      	?>
					      </p>
					       <a href="{{ url('/detailPrestasi/'.$prestasi->id) }}" class="btn btn-info p-3 rounded-circle shadow"><span class="lead font-weight-bold">Detail <i class="fas fa-external-link-alt"></i></span></a>
					    </div>
					  </div> {{-- end card --}}
					</div>
				@endforeach
			</div> {{-- end prestasi row --}}
			<a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-5 shadow"><span class="lead font-weight-bold">BACK TO HOME <i class="fas fa-home"></i></span></a>
		</div>
  </article>{{-- end prestasi --}}
@endsection