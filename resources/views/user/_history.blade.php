@extends('layout.admin_cms')
@section('title', 'Pelatihan Bridge Gunadarma')
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
            <h1 class="text-center font-weight-bold text-info">Pelatihan Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Tanggal</th>
										<th scope="col">Lokasi</th>
                    <th class="text-center" width="50" scope="col">Detail</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_history as $history)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/_history/'.$history->id) }}" class="text-primary" >{{$history->hist_title}}</a>
                    </td>
                    <td>
                      <?php $hist_date = strtotime($history->hist_date) ?>
                      {{date("d M Y", $hist_date)}}
                    </td>
                    <td>{!!$history->hist_loc!!}</td>
                    <td class="text-center">
                      <a class="btn-table btn btn-transparent" href="{{ url('/_history/'.$history->id) }}"><i class="fas fa-book"></i></a>
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
@section('footer')
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function()
    {
      $('#dataTable').DataTable();
    });
  </script>
@stop
@endsection
