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
					<div class="card-borderless col-md-10 mx-auto p-4 rounded">
					  <div class="row no-gutters">
					    <div class="col-md-4 text-center bg-gradient-info shadow rounded py-2">
					    	<div class="bg-white">
						    	<a href="{{ url('/materi/'.$materi->id.'/download') }}">
						      	<img src="{{ url('assets/img/download.png') }}" class="my-2 rounded" alt="{{$materi->mat_title}}" height="100" width="auto">
										<p class="card-text"><small class="text-muted">download <span class="text-info font-italic">{{$materi->file_mat}}</span></small></p>
						      </a>
						      <div class="text-center p-3">
	                  <a href="{{ url('/materi/'.$materi->id.'/edit') }}" class="text-primary px-2"><i class="fa fa-edit"></i> Edit</a>
	             			<a href="#delete-atlet" class="text-danger px-2" data-toggle="modal" data-target="#delete-materi"><i class="fa fa-trash"></i> Delete</a>
	                </div>
					    	</div>
					    </div>
					    <div class="col-md">
					      <div class="card-body mt-2">
					        <h4 class="card-title font-weight-bold">{{strtoupper($materi->mat_title)}}</h4>
					        @isset($materi->mat_keterangan)
					        	<p class="card-text">{!! $materi->mat_keterangan !!}</p>
									@endisset
									@empty($materi->mat_keterangan)
										<i class="text-muted">No information given.</i>
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
  <div class="ml-4 my-5">
    <a href="{{ url('/materi') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>

 {{-- Modal Delete Materi --}}
  <div class="modal fade" id="delete-materi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body">
        	<div class="mb-4 font-italic">
            <small>Semua data yang berkaitan dengan <span class="text-danger font-weight-bold">{{$materi->mat_title}}</span> akan terhapus!</small>
          </div>
	        <form class="d-inline" action="{{ url('/materi/'.$materi->id) }}" method="post">
	          @method('delete')
	          @csrf
	          <button class="btn btn-danger"><i class="fa fa-trash"></i> Ya, hapus</button>
	          <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
	        </form>
	      </div>
      </div>
    </div>
  </div>{{-- End Modal --}}
@endsection