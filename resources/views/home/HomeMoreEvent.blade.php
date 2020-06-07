@extends('layout.detail')
@section('title', 'List Tournament / Event')
@section('content')
	<article id="event"> {{-- event article --}}
		<div class="p-5 bg-light text-center rounded content-mobile">
			<div class="text-dark mx-auto my-4">
    		<h1 class="text-gradient-purple">List Tournament / Event</h1>
    		<hr class="bg-gradient-purple w-50" style="border-width: 3px;">
    	</div>
			<div class="row row-cols-1 row-cols-md-3 justify-content-center">
				@foreach ($data_event as $event)
					<div class="px-1 mb-5 moreEvent">
					  <div class="card-borderless shadow h-100 bg-gradient-purple rounded moreEventShow">
					  	<div class="col-md p-2">
					  		<img height="250" width="auto" src="{{ asset('assets/img/img_eve/'.$event->img_eve) }}" class="card-img-top rounded text-white" alt="{!!$event->eve_title!!}">
					  	</div>
					    <div class="card-body text-white">
					      <h5 class="card-title">{{$event->eve_title}}</h5>
					      <p class="mb-4 card-subtitle">
					      	<?php $date = strtotime($event->eve_date);
					      		echo date('d M Y',$date);
					      	?>
					      </p>
					       <a href="{{ url('/detailEvent/'.$event->id) }}" class="btn p-3 rounded-circle shadow"><span class="lead font-weight-bold">Detail <i class="fas fa-external-link-alt"></i></span></a>
					    </div>
					  </div> {{-- end card --}}
					</div>
				@endforeach
			</div> {{-- end event row --}}
			<a href="{{ url('/') }}" class="btn bg-gradient-purple btn-none rounded-pill px-5 shadow text-white"><span class="lead font-weight-bold">BACK TO HOME <i class="fas fa-home"></i></span></a>
		</div>
  </article>{{-- end event --}}
  @section('script')
	  <script>
	    //Back to top
	    $(document).ready(function(){ 
	      $(window).scroll(function(){ 
	          if ($(this).scrollTop() > 400) { 
	              $('#scroll').fadeIn(); 
	          } else { 
	              $('#scroll').fadeOut(); 
	          } 
	      }); 
	      $('#scroll').click(function(){ 
	          $("html, body").animate({ scrollTop: 0 }, 600); 
	          return false; 
	      }); 
	    });

	    $(window).on('load', function(){
	      $('.moreEvent').each(function(i)
	      {
	         setTimeout(function(){
	          $('.moreEvent').eq(i).addClass('moreEventShow'); 
	         }, 1000*i);
	      });
	    });
	  </script>
	@stop
@endsection