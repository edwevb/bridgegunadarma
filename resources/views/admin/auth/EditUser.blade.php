@extends('layout.admin_cms')
@section('title','Edit '.$user->username)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="my-2 text-muted">
	        <small>Dashboard / User Management / Edit / {{$user->name}}</small>
	      </div>
				<section id="edit">
	        <div class="card-borderless"> {{-- card --}}
	          <div class="card-header borderless rounded shadow-sm">
	            <h3 id="cms-header" class="text-center">Form Edit User</h3>
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
		                 <select class="form-style-static @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
		                 	<option value="">Choose..</option>
                      <?php $role_id = [0,1];
                      foreach($role_id as $role):?>
	                      @if ($role == $user['role_id'])
	                      	@if ($user['role_id']===1)
	                        	<option value="<?= $role; ?>" selected>Admin</option>
	                        @else
	                        	<option value="<?= $role; ?>" selected>User</option>
	                        @endif
	                      @else
                        	@if ($user['role_id']!=0)
	                        	<option value="{{0}}">User</option>
	                        @else
	                        	<option value="{{1}}">Admin</option>
	                        @endif
	                      @endif
                      <?php endforeach; ?>
                    </select>
		                @error('role_id')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		              <div class="form-group col-md-6">
		                <label for="email">Email</label>
		                <input type="text" name="email" id="email" class="form-style  @error('email') is-invalid @enderror" value="{{$user->email}}" autocomplete="off">
		                @error('email')
		                  <div class="invalid-feedback">
		                    {{$message}}
		                  </div>
		                @enderror
		              </div>
		            </div>
		            <div class="row">
		              <div class="form-group col-md-6">
		                <label for="password">Password <a type="button" class="bx-none" onclick="VisiblePassword()"><i class="far fa-eye"></i></a></label>
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
	              <div class="">
	                <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Save Changes</button>
	                <button type="reset" class="btn-form btn btn-danger">Reset</button>
	                <a href="{{ url('/user') }}" class="btn-form btn btn-secondary" data-dismiss="modal">Back</a>
	              </div>
	            </form>
	          </div>
	        </div> {{-- end card --}}
	      </section> {{-- end content --}}
			</div>
		</div>
	</div>
	@section('footer')
	  <script>
	    function VisiblePassword() {
	      var x = document.getElementById("password");
	      var y = document.getElementById("confirm_password");
	      if (x.type === "password") {
	        x.type = "text";
	      } else {
	        x.type = "password";
	      }
	      if (y.type === "password") {
	        y.type = "text";
	      } else {
	        y.type = "password";
	      }
	    }
	  </script>
	@stop
@endsection