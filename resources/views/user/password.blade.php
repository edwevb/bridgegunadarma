@extends('layout.admin_cms')
@section('title','Edit '.$user->username)
@section('section')
	<div class="row no-gutters">
		{{-- start content --}}
		<div class="col-md-2"></div>
		<div class="col-lg d-flex">
			<div class="container">
				<section id="edit">
	        <div class="card-borderless"> {{-- card --}}
	          <div class="card-header borderless bg-dark">
	            <h3 class="text-center text-primary font-weight-bold">Form Change Password</h3>
	          </div>
	          <div class="card-body">
	            <form method="post" action="{{ url('/changePassword/'.auth()->user()->id) }}">
	              @csrf
		            <div class="row">
		              <div class="form-group col-md-6">
		                <label for="password">New Password</label>
		                <input type="password" name="password" id="password" class="form-style  @error('password') is-invalid @enderror">
		                @error('password')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-6">
		                <label for="confirm_password">Confirm New Password</label>
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
	                <a href="{{ url('/dashboard') }}" class="btn-form btn btn-secondary form-btn" data-dismiss="modal">Back</a>
	              </div>
	            </form>
	          </div>
	        </div> {{-- end card --}}
	      </section> {{-- end content --}}
			</div>
		</div>
	</div>
@endsection