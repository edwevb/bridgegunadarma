@extends('layout.detail')
@section('title', 'Prestasi Bridge Gunadarma')
@section('content')
	<article id="prestasi"> {{-- prestasi article --}}
		<div class="p-5 bg-light text-center rounded content-home">
			<div class="text-dark mx-auto my-4">
    		<h1 class="text-gradient-purple">List Prestasi Bridge Gunadarma</h1>
    		<hr class="bg-gradient-salmon w-50" style="border-width: 3px;">
    	</div>
			<div class="row row-cols-1 row-cols-md-3 justify-content-center">
				@foreach ($data_prestasi as $prestasi)
					<div class="px-1 mb-5 morePrestasi">
					  <div class="card-borderless shadow h-100 bg-gradient-purple rounded morePrestasiShow">
					  	<div class="col-md p-2">
					  		<a href="{{ url('/detailPrestasi/'.$prestasi->id.'/'.\Str::slug($prestasi->pre_title,'-')) }}"><img height="250" width="auto" src="{{ asset('assets/img/img_pre/'.$prestasi->img_pre) }}" class="card-img-top rounded text-white" alt="{!!$prestasi->pre_title!!}"></a>
					  	</div>
					    <div class="card-body">
					      <a id="body-link" href="{{ url('/detailPrestasi/'.$prestasi->id.'/'.\Str::slug($prestasi->pre_title,'-')) }}"><h5 class="card-title font-weight-bold">{{$prestasi->pre_title}}</h5></a>
					      <p class="mb-4 card-subtitle text-white">
					      	<?php $date = strtotime($prestasi->pre_date);
					      		echo date('d M Y',$date);
					      	?>
					      </p>
					    </div>
					  </div> {{-- end card --}}
					</div>
				@endforeach
			</div> {{-- end prestasi row --}}
			<a href="{{ url('/') }}" class="btn btn-salmon rounded-pill px-5 shadow"><span class="lead font-weight-bold">BACK TO HOME <i class="fas fa-home"></i></span></a>
		</div>
  </article>{{-- end prestasi --}}
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
	      $('.morePrestasi').each(function(i)
	      {
	         setTimeout(function(){
	          $('.morePrestasi').eq(i).addClass('morePrestasiShow'); 
	         }, 500*i);
	      });
	    });
	  </script>
	@stop
@endsection