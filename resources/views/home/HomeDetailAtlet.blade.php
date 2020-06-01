@extends('layout.detail')
@section('title', $atlet->atlet_name)
@section('content')
	<div class="content-mobile">
		<div class="no-gutters py-5 bg-gradient-light">
	    <div class="col-lg d-flex">
	      <div class="container">
	        <section id="home-detail-header">
	        	<div class="text-dark mx-auto mb-5">
	        		<h1 class="text-center">Atlet Bridge Gunadarma</h1>
	        	</div>
	          <div class="row">
	            <div class="col-md-6 mb-4">{{-- content 1 --}}
	              <div class="text-center px-3">
              		<img class="shadow-lg col rounded p-2 bg-dark text-white" alt="{{$atlet->atlet_name}}" src="{{ url('/assets/img/img_atlet/'.$atlet->img_atlet) }}">
	              </div>
	              <div class="text-center mt-4">
	            		<h3 class="text-shadow">{{ $atlet->atlet_name }}</h3>
	            	</div>
	            	<hr class="bg-success" style="border-width: 3px;">
	            	<div class="px-4">
	            		<table class="table table-borderless">
		                <tr>
		                	<th><i class="fas fa-graduation-cap fa-2x"></i></th>
		                	<td>:</td>
			                <th class="lead">
											 	Fakultas {{$atlet->fakultas}}
			                </th>
			              </tr>
			              <tr>
			              	<th><i class="fas fa-hourglass-half fa-2x"></i></th>
		                	<td>:</td>
		                	<th class="lead">
												{{$atlet->getAge()}} yo
			                </th>
			              </tr>
			              <tr>
			              	<th><i class="fas fa-map fa-2x"></i></th>
		                	<td>:</td>
			                <th class="lead">
			                	{{$atlet->alamat}}
			                </th>
		                </tr>
		              </table>
	            	</div>
	            	<hr class="bg-success" style="border-width: 3px;">
	            </div>{{--end content 1 --}}
	            <div class="col-md-6"> {{-- content 2 --}}
	              <div id="brg_taught" class="mb-3">
	                <div class="card-borderless shadow rounded border-left-dark p-1">
	                  <div class="card-body rounded">
	                    <h5 class="card-title text-muted p-2">What have I learned from bridge?</h5>
	                    <div class="card-text font-italic p-2">
	                      @isset($atlet->brg_taught)
	                      	{!! $atlet->brg_taught !!}
	                      @endisset
	                      @empty($atlet->brg_taught)
	                      	Description not found.
	                      @endempty
	                    </div>
	                  </div>
	                </div>
	              </div> {{-- end brg_taught --}}
	              <h6 class="text-success font-weight-bold font-italic mt-4 p-2"><i class="fas fa-search"></i> Find me on</h6>
	              <table class="table table-borderless">
	              	<tr>
	              		<td><i class="fab fa-facebook-square fa-2x"></i></td>
	              		<td>:</td>
	              		<th>{{$atlet->fb}}</th>
	              	</tr>
	              	<tr>
	              		<td><i class="fab fa-twitter-square fa-2x"></i></td>
	              		<td>:</td>
	              		<th>{{$atlet->twt}}</th>
	              	</tr>
	              	<tr>
	              		<td><i class="fab fa-instagram-square fa-2x"></i></td>
	              		<td>:</td>
	              		<th>{{$atlet->ig}}</th>
	              	</tr>
	              </table>
	            </div> {{-- end content 2 --}}
	          </div> {{-- end row --}}
	        </section>
	        <div class="text-center mt-5">
	        	<a href="{{ url('/moreAtlet') }}" class="btn btn-success rounded-pill px-5 shadow"><span class="lead font-weight-bold">Load More <i class="fas fa-users"></i></span></a>
	        </div>
	      </div> {{-- end container --}}
	    </div> {{-- end content --}}
	  </div>
	</div>
@endsection

