@extends('layout.detail')
@section('title', 'Atlet Bridge Gunadarma')
@section('content')
	<article id="atlet" class="content-home"> {{-- atlet article --}}
		<div class="col-md mt-1 text-center bg-light rounded">
			<div class="p-2">
				<div class="text-gradient-purple mx-auto my-4">
    			<h1>List Atlet Bridge Gunadarma</h1>
    			<hr class="bg-gradient-salmon w-50" style="border-width: 3px;">
    		</div>
	      <div class="row justify-content-center row-cols-1 row-cols-md-3 ">
					@foreach ($data_atlet as $atlet)
					<div class="px-1 mb-5 moreAtlet">
					  <div class="card-borderless shadow h-100 bg-gradient-purple rounded moreAtletShow">
					  	<div class="col-md p-2">
					  		<img height="350" width="auto" src="{{ asset('assets/img/img_atlet/'.$atlet->img_atlet) }}" class="card-img-top rounded text-white" alt="{!!$atlet->atlet_name!!}">
					  	</div>
					    <div class="card-body">
					      <h5 class="card-title text-shadow text-white font-weight-bold">{{$atlet->atlet_name}}</h5>
					      <hr id="atletHr">
					      <div class="text-white lead font-italic mb-3">
					      	<h6>{{$atlet->alamat}}</h6>
					      </div>
					      <a href="{{ url('/detailAtlet/'.$atlet->id) }}" class="btn btn-salmon p-3 rounded-circle shadow text-white"><span class="lead">Detail <i class="fas fa-external-link-alt"></i></span></a>
					    </div>
					  </div> {{-- end card --}}
					</div>
					@endforeach
				</div> {{-- end atlet row --}}
				<a href="{{ url('/') }}" class="btn btn-salmon rounded-pill px-5 shadow btn-none"><span class="lead font-weight-bold">BACK TO HOME <i class="fas fa-home"></i></span></a>
	    </div>
		</div>
  </article>{{-- end atlet --}}
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
	      $('.moreAtlet').each(function(i)
	      {
	         setTimeout(function(){
	          $('.moreAtlet').eq(i).addClass('moreAtletShow'); 
	         }, 500*i);
	      });
	    });
	  </script>
	@stop
@endsection