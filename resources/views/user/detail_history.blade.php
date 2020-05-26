@extends('layout.admin_cms')
@section('title','History '.$history->hist_title)
@section('section')
	<div class="row no-gutters">
	  <div class="col-md-2"></div>
	  {{-- start content --}}
	  <div class="col-lg d-flex">
	    <div class="container">
	    	<section>
	  			@if(session('AlertDanger'))
		        <div class="alert alert-danger alert-dismissible fade show text-center col-md-6 mx-auto" role="alert">
		          <strong>{{ session('AlertDanger')}}</strong>
		          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
          @endif
          @if(session('AlertWarning'))
            <div class="alert alert-warning alert-dismissible fade show text-center col-md-6 mx-auto" role="alert">
              <strong>{{ session('AlertWarning')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <div class="card-borderless col-md border-left-info rounded shadow">
          	<div class="row">
	            <div class="col-md-4 text-center mt-4">
	            	<a href="{{ url('/_history/'.$history->id.'/download') }}">
					      	<img src="{{ url('assets/img/download.png') }}" class="rounded" alt="{{$history->hist_title}}" height="100" width="auto">
									<p class="m-2"><small class="text-muted">download distribusi<br><span class="text-info font-italic">{{$history->hist_dist}}</span></small></p>
					      </a>
	            </div>
	            <div class="col-md">
	              <div class="card-body">
	                <h5 class="card-title">{{$history->hist_title}}</h5>
	                <h6 class="card-subtitle mb-2 text-muted font-italic">
	                	@php 
	                	$hist_date = strtotime($history->hist_date)
	                	@endphp
		                 {{date("l, d M Y", $hist_date)}}<br>
		                 {!!$history->hist_loc!!} 
		              </h6>
		              <div class="card-text text-justify">
		              	@isset($history->hist_keterangan)
		              		{!!$history->hist_keterangan!!}
		              	@endisset
		              	@empty($history->hist_keterangan)
		              		<span class="text-muted font-italic">No description given</span>
		              	@endempty
                  </div>
                  <div class="my-4 text-center">
	                	<h5 class="font-italic lead border-right-dark border-left-info p-2 shadow-sm rounded">List Participation</h5>
	                	@if(session('ErrorInput'))
			                {!! session('ErrorInput') !!}
			              @endif
			              @if(session('AlertSuccess'))
			                {!!session('AlertSuccess') !!}
			              @endif
									</div>
		              <table class="table table-borderless ml-2">
		              	<tbody>
		                  @foreach ($history->atlet as $atlet)
		                  <tr>
		                    <th width="10" scope="row"><i class="fa fa-caret-right"></th>
		                    <td>{{$atlet->atlet_name}}</td>
		                  </tr>
		                  @endforeach
		                </tbody>
		              </table>
	              </div>
	            </div>
            </div>
          </div>
        </section>
	    </div> {{-- end container --}}
	  </div> {{-- end content --}}
	</div>
	
  
@endsection