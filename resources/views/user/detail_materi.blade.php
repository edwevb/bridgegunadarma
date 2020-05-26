@extends('layout.admin_cms')
@section('title','Materi '.$materi->mat_title)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
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
					<div class="card-borderless col-md-10 mx-auto shadow p-4 rounded">
					  <div class="row no-gutters">
					    <div class="col-md-4 text-center bg-gradient-info shadow rounded py-2">
					    	<div class="bg-white p-4">
						    	<a href="{{ url('/_materi/'.$materi->id.'/download') }}">
						      	<img src="{{ url('assets/img/download.png') }}" class="my-2 rounded" alt="{{$materi->mat_title}}" height="100" width="auto">
										<p class="card-text"><small class="text-muted">download <span class="text-info font-italic">{{$materi->file_mat}}</span></small></p>
						      </a>
					    	</div>
					    </div>
					    <div class="col-md">
					      <div class="card-body mt-2">
					        <h3 class="card-title">{{strtoupper($materi->mat_title)}}</h3>
					        @isset($materi->mat_keterangan)
					        	<p class="card-text">{!! $materi->mat_keterangan !!}</p>
									@endisset
									@empty($materi->mat_keterangan)
										<i class="text-muted">No Description.</i>
									@endempty
					        <p class="card-text"><small class="text-muted">
					        	Uploaded : 
					        	@php
                	 		$uploaded = strtotime($materi->created_at);
                	 		echo date("D, d-m-Y", $uploaded);
                		@endphp
					        </small></p>
					      </div>
					    </div>
					  </div>
					</div>
				</section>
			</div>
		</div>
	</div>
@endsection