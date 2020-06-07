@extends('layout.detail')
@section('title', $prestasi->pre_title)
@section('content')
	<div class="content-mobile">
		<div class="no-gutters py-5 bg-light">
	    <div class="d-flex">
	      <div class="col-lg">
	        <section id="home-detail-header" class="pb-5">
	        	<div class="mb-5 text-gradient-purple">
	        		<h1 class="text-center">Prestasi Bridge Gunadarma</h1>
	        	</div>
            <div class="col-lg">
            	<div class="card-borderless rounded p-3 bg-gradient-purple">
            		<div class="row">
            			<div class="col-md-6">
	            			<div class="text-center" id="prestasi">
		              		<img class="shadow col-md rounded p-1 bg-dark text-white" alt="{{$prestasi->pre_title}}" src="{{ url('/assets/img/img_pre/'.$prestasi->img_pre) }}">
			              </div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="card-body text-white">
		                  <h5 class="card-title font-weight-bold">{{$prestasi->pre_title}}</h5>
		                  <h6 class="card-subtitle mb-2">
		                    @php
		                      $date = strtotime($prestasi->pre_date);
		                      echo date('d M Y', $date);
		                    @endphp
		                  </h6>
		                  <hr id="bridgeHr">
		                  <div class="card-text">
		                  	@isset ($prestasi->pre_isi)
		                      {!!$prestasi->pre_isi!!}
		                    @endisset
		                    @empty ($prestasi->pre_isi)
		                      <p class="font-italic">No description found.</p>
		                    @endempty
		                    <div class="py-4">
		                    	<h5>List Partisipasi Atlet</h5>
		                      @foreach ($prestasi->atlet as $atlet)
		                        <li class="ml-4"><a href="{{ url('/atlet/'.$atlet->id) }}">{{$atlet->atlet_name}}</a></li>
		                      @endforeach
		                    </div>
		                  </div>
		                </div>
	            		</div>
            		</div>
              </div> {{-- end card --}}
            </div>
	        </section>
	        <div class="text-center mt-5">
	        	<a href="{{ url('/morePrestasi') }}" class="btn bg-gradient-purple btn-none rounded-pill px-5 shadow text-white"><span class="lead font-weight-bold">Load More <i class="fas fa-medal"></i></span></a>
	        </div>
	      </div> {{-- end container --}}
	    </div> {{-- end content --}}
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

