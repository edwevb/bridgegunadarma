@extends('layout.detail')
@section('title', 'List Tournament / Event')
@section('content')
	<article id="event"> {{-- event article --}}
		<div class="p-5 bg-gradient-light text-center rounded content-mobile">
			<div class="text-shadow text-dark mx-auto my-4">
    		<h1 class="font-weight-bold">List Tournament / Event</h1>
    		<hr class="bg-gradient-warning w-50" style="border-width: 3px;">
    	</div>
			<div class="row row-cols-1 row-cols-md-3 justify-content-center">
				@foreach ($data_event as $event)
					<div class="px-1 mb-5">
					  <div class="card-borderless shadow h-100 bg-dark rounded border-left-warning">
					  	<div class="col-md p-2">
					  		<img height="250" width="auto" src="{{ asset('assets/img/img_eve/'.$event->img_eve) }}" class="card-img-top rounded" alt="{!!$event->eve_title!!}">
					  	</div>
					    <div class="card-body">
					      <h5 class="card-title text-white">{{$event->eve_title}}</h5>
					      <p class="mb-4 card-subtitle text-muted">
					      	<?php $date = strtotime($event->eve_date);
					      		echo date('d M Y',$date);
					      	?>
					      </p>
					       <a href="{{ url('/detailevent/'.$event->id) }}" target="_blank" class="btn btn-warning p-3 rounded-circle shadow"><span class="lead font-weight-bold">Detail <i class="fas fa-external-link-alt"></i></span></a>
					    </div>
					  </div> {{-- end card --}}
					</div>
				@endforeach
			</div> {{-- end event row --}}
			<a href="{{ url('/') }}" class="btn btn-dark rounded-pill px-5 shadow"><span class="lead font-weight-bold">BACK TO HOME <i class="fas fa-home"></i></span></a>
		</div>
  </article>{{-- end event --}}
@endsection