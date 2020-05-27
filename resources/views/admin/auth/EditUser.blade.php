@extends('layout.admin_cms')
@section('title','Edit '.$user->username)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<section id="edit">
	        <div class="card-borderless"> {{-- card --}}
	          <div class="card-header borderless rounded border-l-i_border-r-d shadow-sm bg-white">
	            <h3 class="text-center text-info">Form Edit User</h3>
	          </div>
	           @if ($errors->any())
	              <div class="alert alert-danger alert-dismissible fade show text-center m-4" role="alert">
	                <p>&nbsp;<span class="font-weight-bold text-danger">Gagal memperbaharui User {{$user->name}}!</span> Cek kembali inputan anda.</p>
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	                </button>
	              </div>
	            @endif
	          <div class="card-body">
	            <form method="post" action="{{ url('/user/'.$user->id) }}">
	              @method('patch')
	              @csrf
	              <input type="hidden" name="remember_token" value="{{$user->remember_token}}">
		            <div class="row">
		              <div class="form-group col-md-6">
		                <label for="name">Nama</label>
		              	{{-- Real Data --}}
		            		<input type="hidden" name="name" id="name" value="{{$user->name}}">
		            		{{-- User Interface --}}
		                <input type="text" class="form-control text-muted" value="{{$user->name}}" disabled>
		              </div>
		            </div>
		            <div class="row">
		            	<div class="form-group col-md-6">
		                <label for="role_id">Role | Level</label>
		                 <select class="form-style-static" name="role_id" id="role_id">
		                  <option value="0" {{(old('role_id') == '0') ? 'selected' : ''}}>User</option>
		                  <option value="1" {{(old('role_id') == '1') ? 'selected' : ''}}>Admin</option>
		                </select>
		                @error('role_id')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-6">
		                <label for="email">Email</label>
		                <input type="text" name="email" id="email" class="form-style  @error('email') is-invalid @enderror" value="{{$user->email}}">
		                @error('email')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
		            <div class="row">
		              <div class="form-group col-md-6">
		                <label for="password">Password</label>
		                <input type="password" name="password" id="password" class="form-style  @error('password') is-invalid @enderror">
		                @error('password')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-6">
		                <label for="confirm_password">Confirm Password</label>
		                <input type="password" name="confirm_password" id="confirm_password" class="form-style  @error('confirm_password') is-invalid @enderror">
		                @error('confirm_password')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
	              <div class="ml-3">
	                <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
	                <button type="reset" class="btn-form btn btn-danger">Reset</button>
	                <a href="{{ url('/user') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
	              </div>
	            </form>
	          </div>
	        </div> {{-- end card --}}
	      </section> {{-- end content --}}
			</div>
		</div>
	</div>
@endsection