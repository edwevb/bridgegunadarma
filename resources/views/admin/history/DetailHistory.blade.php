@extends('layout.admin_cms')
@section('title','Pelatihan '.$history->hist_title)
@section('section')
	<div class="row no-gutters">
	  <div class="col-md-2"></div>
	  {{-- start content --}}
	  <div class="col-lg d-flex">
	    <div class="container px-4">
	    <div class="my-2 text-muted">
        <small>Dashboard / Data / Pelatihan / {{$history->hist_title}}</small>
      </div>
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
          <div class="card-borderless col-md border-left-info rounded">
          	<div class="row">
	            <div class="col-md-4 text-center mt-4">
	            	<a href="{{ url('/history/'.$history->id.'/download') }}">
					      	<img src="{{ url('assets/img/download.png') }}" class="rounded" alt="{{$history->hist_title}}" height="100" width="auto">
									<p class="m-2"><small class="text-muted">download distribusi<br><span class="text-info font-italic">{{$history->hist_dist}}</span></small></p>
					      </a>
	              <div class="text-center my-4">
	                <a href="{{ url('/history/'.$history->id.'/edit') }}" class="text-primary px-2"><i class="fa fa-edit"></i> Edit</a>
	                <a href="#delete-{{$history->hist_title}}" data-toggle="modal" data-target="#delete-history" class="text-danger px-2"><i class="fa fa-trash"></i> Delete</a>
	              </div>
	              <p class="card-text text-left ml-4 pb-2"><small class="text-muted">
              		created : 
              		@php
              	 		$created = strtotime($history->created_at);
              	 		echo date("D, d-m-Y", $created);
              		@endphp
              	</small></p>
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
		              <div class="card-text text-justify block">
		              	@isset($history->hist_keterangan)
		              		{!!$history->hist_keterangan!!}
		              	@endisset
		              	@empty($history->hist_keterangan)
		              	    {!! '<span class="text-muted font-italic">No description given.</span>' !!}
		              	@endempty
                  </div>
                  <div class="mt-4">
                  	@if(session('ErrorInput'))
		                  {!! session('ErrorInput') !!}
		                @endif
		                @if(session('AlertSuccess'))
		                  {!!session('AlertSuccess') !!}
		                @endif
		                @if ($errors->has('atlet'))
		                  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
		                    <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-daftar-atlet" data-toggle="modal" data-target="#modal-tambah-daftar-atlet">Click disini</a> untuk melihat error.</p>
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                    </button>
		                  </div>
		                @endif
	                	<a id="btn-wh" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-tambah-daftar-atlet"><i class="far fa-plus-square"></i> Tambah List Atlet</a>
	                </div>
	                <div class="text-center my-4">
	                	<h5 class="font-italic lead border-right-dark border-left-info p-2 shadow-sm rounded">List Participation</h5>
	                </div>
									<div class="table-responsive-xl">
		              <table class="table table-borderless mx-auto">
		              	<tbody>
		                  @foreach ($sort_atlet as $atlet)
		                  <tr>
		                    <th width="10" scope="row">{{$loop->iteration}}</th>
		                    <td>
		                    	<a class="text-none" href="{{ url('/atlet/'.$atlet->id) }}">{{$atlet->atlet_name}}</a>
		                    </td>
		                    <td>
	                      	<a href="{{ url('/history/'.$history->id.'/'.$atlet->id.'/removeAtlet') }}" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i> Remove</a>
	                      </td>
		                  </tr>
		                  @endforeach
		                </tbody>
		              </table>
		            </div>{{-- end table --}}
	                <p class="card-text"><small class="text-muted">
	              		last updated : 
	              		@php
	              	 		$updated = strtotime($history->updated_at);
	              	 		echo date("D, d-m-Y", $updated);
	              		@endphp
	              	</small></p>
	              </div>
	            </div>
            </div>
          </div>
        </section>
	    </div> {{-- end container --}}
	  </div> {{-- end content --}}
	</div>
  <div class="ml-4 my-5">
    <a href="{{ url('/history') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>
  <!-- Modal Tambah Daftar Atlet-->
  <div class="modal fade" id="modal-tambah-daftar-atlet" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tambah Atlet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/history/'.$history->id.'/addAtlet') }}" method="POST">
            @csrf
            <div class="form-group col-md-9">
              <label for="atlet">List Atlet</label>
              <select class="form-style-static @error('atlet') is-invalid @enderror" name="atlet" id="atlet">
              	<option value="">Choose..</option>
                @foreach ($data_atlet as $atlet)
                  <option value="{{$atlet->id}}">{{$atlet->atlet_name}}</option>
                @endforeach
              </select>
              @error('atlet')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
              @enderror
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="btn-form btn btn-danger">Reset</button>
              <button type="button" class="btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> {{-- end modal --}}

  {{-- Modal Delete History --}}
  <div class="modal fade" id="delete-history" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body">
        	<div class="mb-4 font-italic">
            <small>Semua data yang berkaitan dengan <span class="text-danger font-weight-bold">{{$history->hist_title}}</span> akan terhapus!</small>
          </div>
	        <form class="d-inline" action="{{ url('/history/'.$history->id) }}" method="post">
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