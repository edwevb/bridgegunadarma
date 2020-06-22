@extends('layout.admin_cms')
@section('title', 'Client Info')
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="card-borderless borderless">
          <div class="card-header">
            <h1 id="cms-header" class="text-center font-weight-bold">Client Info</h1>
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
            	<table class="table table-borderless" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Device</th>
                    <th scope="col">Browser</th>
                    <th scope="col">Platform OS</th>
                    <th scope="col">IP Address</th>
                    <th class="text-center" scope="col"> Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_client as $client)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$client->name}}</td>
                    <td>{!!$client->device!!}</td>
                    <td>{!!$client->browser!!}</td>
                    <td>{!!$client->platform!!}</td>
                    <td>{!!$client->ip!!}</td>
                    <td class="text-center">
                      <form action="{{ url('/clientInfo/delete/'.$client->id) }}" method="post">
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