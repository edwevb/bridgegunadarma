@extends('layout.admin_cms')
@section('title', 'Masterpoint Bridge Gunadarma')
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex">
			<div class="container">
				<div class="card-borderless">
          <div class="card-header">
            <h1 class="text-center font-weight-bold text-info">Masterpoint Bridge Gunadarma</h1>
          </div>
          <div class="card-body">
            <div class="table-responsive-xl mt-4">
              <table class="table table-borderless table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" width="10">No</th>
                    <th scope="col">Atlet</th>
                    <th class="text-center" scope="col">Kedisplinan</th>
                    <th class="text-center" scope="col">Penguasaan Sistem</th>
                    <th class="text-center" scope="col">Teknik Play</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data_mpoint as $mp)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                      <a href="{{ url('/detailAtlet/'.$mp->atlet_id) }}">
                        @isset ($mp->atlet->atlet_name)
                            {{$mp->atlet->atlet_name}}
                        @endisset
                        </a>
                    </td>
                    <td class="text-center">{{$mp->discipline}}</td>
                    <td class="text-center">{{$mp->bidding}}</td>
                    <td class="text-center">{{$mp->play}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>{{-- end table --}}
            <div class="mt-4">
              <p>Value Masterpoint berdasarkan penilian Coach.</p>
              <span class="font-weight-bold lead">W.D. Karamoy</span>
            </div>
          </div>
        </div> {{-- end card --}}
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>
@endsection