@extends('layout.detail')
@section('title', $prestasi->pre_title)
@section('content')
	<div class="content-home">
		<div class=" py-5 bg-light">
      <section id="home-detail-header" class="pb-5">
      	<div class="mb-5 text-gradient-purple">
      		<h1 class="text-center">Prestasi Bridge Gunadarma</h1>
      	</div>
        <div class="">
        	<div class="card-borderless rounded p-3">
        		<div class="row">
        			<div class="col-md-6">
          			<div class="text-center" id="prestasi">
              		<img class="shadow col-md rounded p-1 bg-gradient-salmon text-white" alt="{{$prestasi->pre_title}}" src="{{ url('/assets/img/img_pre/'.$prestasi->img_pre) }}">
	              </div>
          		</div>
          		<div class="col-md-6">
          			<div class="card-body">
                  <h5 class="card-title text-salmon font-weight-bold">{{$prestasi->pre_title}}</h5>
                  <h6 class="card-subtitle mb-2">
                    @php
                      $date = strtotime($prestasi->pre_date);
                      echo date('d M Y', $date);
                    @endphp
                  </h6>
                  <hr id="bridgeHr" class="bg-gradient-salmon">
                  <div class="card-text">
                  	@isset ($prestasi->pre_isi)
                      {!!$prestasi->pre_isi!!}
                    @endisset
                    @empty ($prestasi->pre_isi)
                      <p class="font-italic">No description found.</p>
                    @endempty
                  </div>
                </div>
          		</div>
        		</div>
          </div> {{-- end card --}}
        </div>
      </section>
      <div class="text-center mt-5">
      	<a href="{{ url('/morePrestasi') }}" class="btn btn-salmon btn-none rounded-pill px-5 shadow text-white"><span class="lead font-weight-bold">Load More <i class="fas fa-medal"></i></span></a>
      </div>
	  </div>
	</div>
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
	  </script>
	@stop
@endsection

