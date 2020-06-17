@extends('layout.admin_cms')
@section('title', 'User Management')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="card-borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">User Management</h1>
          </div>
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <p>Gagal menambahkan data!&nbsp;<a class="font-weight-bold text-danger" href="#modal-tambah-user" data-toggle="modal" data-target="#modal-tambah-user">Click disini</a> untuk melihat error.</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            @if (session('AlertSuccess'))
              <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('AlertSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="mb-2">
              <a id="btn-wh" class="btn bg-primary" data-toggle="modal" data-target="#modal-tambah-user" data-backdrop="static"><i class="far fa-plus-square"></i> Tambah data</a>
              @include('vendor.popover')
            </div>
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th width="10">No</th>
                    <th scope="col">Atlet</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level</th>
                    <th scope="col">Created</th>
                    <th class="text-center" width="50" scope="col">Edit</th>
                    <th class="text-center" width="50" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_user as $user)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role()}}</td>
                    <td>
                      <?php $created = strtotime($user->created_at) ?>
                      {{date('l, d-m-Y', $created)}}
                    </td>
                    <td class="text-center">
                    	<a class="btn-table  btn btn-transparent" href="{{ url('/user/'.$user->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                      <form action="{{ url('/user/'.$user->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn-table btn btn-transparent" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>{{-- end table --}}
          </div>
        </div>{{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>

	 {{-- Modal tambah user --}}
  <div class="modal fade" id="modal-tambah-user" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ url('/user') }}">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
              	<input type="text" name="name" id="name" class="form-style  @error('name') is-invalid @enderror" value="{{old('name')}}" autocomplete="off">
                @error('name')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="role_id">Role | Level</label>
                <select class="form-style-static @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                  <option value="">Choose..</option>
                  <option value="1" {{(old('role_id') == '1') ? 'selected' : ''}}>Admin</option>
                  <option value="0" {{(old('role_id') == '0') ? 'selected' : ''}}>User</option>
                </select>
                @error('role_id')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-style  @error('email') is-invalid @enderror" value="{{old('email')}}" autocomplete="off">
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
            <div class="pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="btn-form btn btn-danger">Reset</button>
              <button type="button" class="btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>{{-- end modal tambah user --}}
  @section('footer')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
      $(document).ready(function()
      {
        $('#dataTable').DataTable();
      });

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