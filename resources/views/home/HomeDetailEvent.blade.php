@extends('layout.detail')
@section('title', $event->eve_title)
@section('content')
	<div class="content-mobile">
		<div class="no-gutters py-5 bg-gradient-light">
			{{-- start content --}}
			<div class="col-lg d-flex">
				<div class="container">
					<section>
						<div class="row">
							{{-- content 1 --}}
							<div class="col-md-6">
								<div class="text-center">
									<div class="text-center px-3">
	              		<img class="shadow-lg col-md rounded p-1 text-white bg-dark" src="{{ url('/assets/img/img_eve/'.$event->img_eve) }}" alt="{{$event->eve_title}}">
		              </div>
		              <div class="text-center my-4">
		            		<h3 class="text-shadow">{{ $event->eve_title }}</h3>
		            	</div>
		            </div>
		            <div class="px-4">
		            	<table class="table table-borderless mx-auto mt-3">
			              <tbody class="clearfix">
				              <tr>
				                <th>Event start</th>
				                <td width="10">:</td>
				                <td>
				                	@php
			                	 		$eve_date = strtotime($event->eve_date)
			                		@endphp
				                  {{date("l, d M Y", $eve_date)}}
						            </td>
				              </tr>
				              <tr>
												<th>Event location</th>
				                <td>:</td>
				                <td>{{$event->eve_loc}}</td>
				              </tr>
				            </tbody>
				          </table>
		            </div>
							</div> {{-- end content 1 --}}
							{{-- content 2 --}}
							<div class="col-md">
								{{-- card deskripsi --}}
			          <div class="card-borderless">
		            	<div class="bg-warning rounded">
		            		<div class="col-md p-1">
		          				<a href="#deskripsi" class="btn btn-block bx-none" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="deskripsi"><h5 class="lead">Event Description<i class="fa fa-fw fa-caret-down"></i></h5></a>
		            			<div class="collapse" id="deskripsi">
		            				<div class="p-4">
						            	<div class="card-borderless bg-white p-4 shadow rounded">
						                <h5 class="card-text">
						                	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque quas maiores velit tempore laudantium ipsam illo impedit ex minus eos! Repellendus, iste eos! Atque dolorum deserunt pariatur perferendis, ex assumenda!
						                	@isset($event->eve_isi)
																{!! $event->eve_isi !!}
					              			@endisset
						                </h5>
					                 	<div class=" my-4">
							            		<div class="text-muted">Contact Person</div>
							            		@isset ($event->kontak)
							            			<p class="p-2">{!! $event->kontak !!}</p>
							            		@endisset
								            	@empty($event->kontak)
								            	    <p class="text-muted font-italic p-2">No information given.</p>
								            	@endempty
								          	</div>
							          	</div>
					              </div>
					            </div> {{-- end collapse --}}
		            		</div>
		            	</div>
		            </div>{{-- end card deskripsi --}}
								<div class="py-2 mt-4">
	                <h5 class="lead font-italic">Biaya Pendaftaran</h5>
	              </div>
								<table class="table table-borderless mx-auto">
			          	<tbody>
			              <tr>
			              	<th colspan="3">
			              		<a class="text-muted font-italic ">Team</a>
			              	</th>
			              </tr>
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
			              <tr>
			              	<th colspan="3">
			              		<a class="text-muted font-italic ">Pasangan</a>
			              	</th>
			              </tr>
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
			          <div class="card-borderless">
		            	<div class="bg-dark rounded">
		            		<div class="col-md p-1">
		          				<a href="#prizepool" class="btn bx-none btn-block text-white" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prizepool"><h5 class="lead">PRIZEPOOL<i class="fa fa-fw fa-caret-down"></i></h5></a>
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
		          </div>{{--end content 2 --}}
						</div>{{--  end row --}}
					</section>
					<div class="text-center mt-5">
	        	<a href="{{ url('/moreEvent') }}" class="btn btn-warning rounded-pill px-5 shadow"><span class="lead font-weight-bold">Load More <i class="far fa-clipboard"></i></span></a>
	        </div>
				</div> {{-- end container --}}
			</div> {{-- end content --}}
		</div>
	</div>
	@section('script')
	  <script>
	    //Back to top
	    $(document).ready(function(){ 
	      $(window).scroll(function(){ 
	          if ($(this).scrollTop() > 400) { 
	              $('#scroll').fadeIn(); 
	          } else { 
	              $('#scroll').fadeOut(); 
	          } 
	      }); 
	      $('#scroll').click(function(){ 
	          $("html, body").animate({ scrollTop: 0 }, 600); 
	          return false; 
	      }); 
	    });
	  </script>
	@stop
@endsection