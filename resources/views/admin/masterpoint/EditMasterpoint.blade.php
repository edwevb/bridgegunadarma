@extends('layout.admin_cms')
@section('title', 'Edit Masterpoint '.$masterpoint->atlet->atlet_name)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<section id="edit">
	        <div class="card-borderless"> {{-- card --}}
	          <div class="card-header borderless rounded border-l-i_border-r-d shadow-sm bg-white">
	            <h3 class="text-center text-info">Form Edit masterpoint</h3>
	          </div>
	           @if ($errors->any())
	              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
	                <p>&nbsp;<span class="font-weight-bold text-danger">Gagal memperbaharui Masterpoint {{$masterpoint->atlet->atlet_name}}!</span> Cek kembali inputan anda.</p>
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	                </button>
	              </div>
	            @endif
	          <div class="card-body">
	            <form method="post" action="{{ url('/masterpoint/'.$masterpoint->id) }}" enctype="multipart/form-data">
	              @method('patch')
	              @csrf
	              <div class="row justify-content-center">
		            	<div class="form-group col-md-6">
		            		<label>Atlet</label>
		            		{{-- Real Data --}}
		            		<input type="hidden" name="atlet_id" id="atlet_id" value="{{$masterpoint->atlet_id}}">
		            		{{-- User Interface --}}
		                <input type="text" class="form-control text-muted" value="{{$masterpoint->atlet->atlet_name}}" disabled>
		              </div>
		            </div>
	              <div class="row">
		              <div class="form-group col-md-4">
		                <label for="discipline">Kedisiplinan</label>
		                <input type="text" name="discipline" id="discipline" class="form-style-static @error('discipline') is-invalid @enderror" value="{{$masterpoint->discipline}}">
		                @error('discipline')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-4">
		                <label for="bidding">Penguasaan Sistem</label>
		                <input type="text" name="bidding" id="bidding" class="form-style-static @error('bidding') is-invalid @enderror" value="{{$masterpoint->bidding}}">
		                @error('bidding')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-4">
		                <label for="play">Teknik Play</label>
		                <input type="text" name="play" id="play" class="form-style-static @error('play') is-invalid @enderror" value="{{$masterpoint->play}}">
		                @error('play')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
	              <div class="ml-3">
	                <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
	                <button type="reset" class="btn-form btn btn-danger">Reset</button>
	                <a href="{{ url('/masterpoint') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
	              </div>
	            </form>
	          </div>
	        </div> {{-- end card --}}
	      </section> {{-- end content --}}
			</div>	{{-- end container --}}
		</div>
	</div>

@endsection