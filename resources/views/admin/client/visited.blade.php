@extends('layout.admin_cms')
@section('title', 'Visitors')
@section('header')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="card-borderless borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Visitors</h1>
          </div>
					<div class="card-body">
            @if (session('AlertSuccess'))
              <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('AlertSuccess') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="table-responsive-xl">
            	<table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Total Visitors</th>
                    <th class="text-center" scope="col"> Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_visit as $visit)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$visit->atlet->atlet_name}}</td>
                    <td>{{$visit->hits}}</td>
                    <td class="text-center">
                      <form action="{{ url('/visitor/delete/'.$visit->id) }}" method="post">
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
        </div> {{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>
  <div class="ml-4 my-5">
    <a href="{{ url('/clientInfo') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>
  @section('footer')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
      $(document).ready(function(){
        $('#dataTable').DataTable();
      });
    </script>
  @stop
@endsection