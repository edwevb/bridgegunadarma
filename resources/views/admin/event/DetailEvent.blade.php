@extends('layout.admin_cms')
@section('title','Event '.$event->eve_title)
@section('section')
	<div class="row no-gutters">
		<div class="col-md-2"></div>
		{{-- start content --}}
		<div class="col-lg d-flex mb-5">
			<div class="container">
				<div class="my-2 text-muted">
	        <small>Dashboard / Data / Event / {{$event->eve_title}}</small>
	      </div>
				<section>
					<div class="row">
						{{-- content 1 --}}
						<div class="col-md-6 mt-3">
							<div class="text-center">
								<img class="mx-auto shadow rounded d-block" alt="{{$event->eve_title}}" height="200" width="auto" src="{{ url('/assets/img/img_eve/'.$event->img_eve) }}">
	              <h4 class="my-2 pt-2" class="text-center mt-2">{{strtoupper($event->eve_title)}}</h4>
	              <div class="mb-4">
                	<a href="{{ url('/event/'.$event->id.'/edit') }}" class="text-primary px-2"><i class="fa fa-edit"></i> Edit</a>
                	<a href="#delete-event" data-toggle="modal" data-target="#delete-event" class="text-danger px-2"><i class="fa fa-trash"></i> Delete</a>
	              </div>
	            </div>
	            <table class="table table-borderless mx-auto mt-3">
	              <tbody class="clearfix">
		              <tr>
		                <th>Event start</th>
		                <td width="10">:</td>
		                <td>
		                	@php
	                	 		$eve_date = strtotime($event->eve_date)
	                		@endphp
		                  {{date("d M Y", $eve_date)}}
				            </td>
		              </tr>
		              <tr>
										<th>Event location</th>
		                <td>:</td>
		                <td>{{$event->eve_loc}}</td>
		              </tr>
		            </tbody>
		          </table>
		          <p class="card-text mt-3 ml-2"><small class="text-muted">
	            	created : 
	            	@php
	              	$created = strtotime($event->created_at);
	              	echo date("D, d-m-Y", $created)
	              @endphp
	          	</small></p>
		          {{-- card deskripsi --}}
		          <div class="card-borderless">
	            	<div class="bg-gradient-info rounded">
	            		<div class="col-md p-1">
	          				<a href="#deskripsi" class="btn btn-block text-white bx-none" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="deskripsi"><h5 class="lead">Event Description<i class="fa fa-fw fa-caret-down"></i></h5></a>
	            			<div class="collapse" id="deskripsi">
	            				<div class="p-4">
					            	<div class="card-borderless bg-white p-4 shadow rounded">
					                <h5 class="card-text font-italic">
					                	@isset($event->eve_isi)
															{!! $event->eve_isi !!}
				              			@endisset
					                </h5>
				                 	<div class="border-left-dark pl-2 my-4 shadow">
						            		<div class="text-muted font-italic">Contact Person</div>
						            		@isset ($event->kontak)
						            			<div class="p-2 font-italic">{!! $event->kontak !!}</div>
						            		@endisset
							            	@empty($event->kontak)
							            	    <div class="text-muted font-italic">No information given.</div>
							            	@endempty
							          	</div>
						          	</div>
				              </div>
				            </div> {{-- end collapse --}}
	            		</div>
	            	</div>
	            </div>{{-- end card deskripsi --}}
						</div> {{-- end content 1 --}}
						{{-- content 2 --}}
						<div class="col-md mt-3">
							<div class="border-l-i_border-r-d py-2 mb-3 shadow-sm rounded">
                <h5 class="text-muted lead text-center">Biaya Pendaftaran</h5>
              </div>
							<table class="table table-borderless mx-auto">
		          	<tbody>
		              @if (isset($event->fee_team_open)
		          				|| isset($event->fee_team_mhs) 
		          				|| isset($event->fee_team_u21))
			          		<tr>
			              	<th colspan="3">
			              		<a class="text-muted font-italic">Team</a>
			              	</th>
			              </tr>
		          		@endif
		              @isset($event->fee_team_open)
	              		<tr>
		              		<th>Open</th>
				              <td>:</td>
				              <td>@rupiah($event->fee_team_open)</td>
			             </tr>
	              	@endisset
	              	@isset($event->fee_team_mhs)
	              		<tr>
		              		<th>Mahasiswa / U-	26</th>
				              <td>:</td>
				              <td>@rupiah($event->fee_team_mhs)</td>
			             </tr>
	              	@endisset
		              @isset($event->fee_team_u21)
	              		<tr>
		              		<th>Pelajar / U-21</th>
				              <td>:</td>
				              <td>@rupiah($event->fee_team_u21)</td>
			             </tr>
	              	@endisset
		              @if (isset($event->fee_pas_open)
		          				|| isset($event->fee_pas_mhs) 
		          				|| isset($event->fee_pas_u21))
			          		<tr>
			              	<th colspan="3">
			              		<a class="text-muted font-italic">Pasangan</a>
			              	</th>
			              </tr>
		          		@endif
		              @isset($event->fee_pas_open)
	              		<tr>
		              		<th>Open</th>
				              <td>:</td>
				              <td>@rupiah($event->fee_pas_open)</td>
			             </tr>
	              	@endisset
		              @isset($event->fee_pas_mhs)
	              		<tr>
		              		<th>Mahasiswa / U-26</th>
				              <td>:</td>
				              <td>@rupiah($event->fee_pas_mhs)</td>
			             </tr>
	              	@endisset
		              @isset($event->fee_pas_u21)
	              		<tr>
		              		<th>Pelajar / U-21</th>
				              <td>:</td>
				              <td>@rupiah($event->fee_pas_u21)</td>
			             </tr>
	              	@endisset
	              </tbody>
	            </table>
	            {{-- card prizepool --}}
		          <div class="card-borderless ">
	            	<div class="bg-gradient-dark rounded">
	            		<div class="col-md p-1">
	          				<a href="#prizepool" class="btn btn-prizepool btn-block text-white bx-none" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prizepool"><h5 class="lead">PRIZEPOOL<i class="fa fa-fw fa-caret-down"></i></h5></a>
	            			<div class="collapse" id="prizepool">
				            	<div class="card-borderless ">
				            		<div class="rounded text-white my-2 py-2 ">
				            			<h5 class="text-center font-italic">
				                	@isset($event->prizepool)
														@rupiah($event->prizepool)
			              			@endisset
			              			@empty($event->prizepool)
														<i class="text-white">No information given.</i>
													@endempty
				                </h5>
				            		</div>
				              </div>
				            </div> {{-- end collapse --}}
	            		</div>
	            	</div>
	            </div>{{-- end card prizepoool --}}
	            <p class="card-text mt-2"><small class="text-muted">
	          		last updated : 
	          		@php 
	          			$updated = strtotime($event->updated_at);
	          			echo date("D, d-m-Y", $updated);
	          		@endphp 
	          	</small></p>
	          </div>{{--end content 2 --}}
					</div>{{--  end row --}}
				</section>
			</div> {{-- end container --}}
		</div> {{-- end content --}}
	</div>
  <div class="ml-4 my-5">
    <a href="{{ url('/event') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>
{{-- Modal Delete event --}}
  <div class="modal fade" id="delete-event" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body">
        	<div class="mb-4 font-italic">
            <small>Semua data yang berkaitan dengan <span class="text-danger font-weight-bold">{{$event->eve_title}}</span> akan terhapus!</small>
          </div>
          <form class="d-inline" action="{{ url('/event/'.$event->id) }}" method="post">
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