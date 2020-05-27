 @extends('layout/main')
 @section('title', 'Home')
 @section('section')
	 <div class="content-mobile">
	 	<div class="no-gutters">
	 		<div class="col-lg d-flex">
	 			<section id="home"> {{-- main --}}
			 		{{-- start Jumbotron --}}
					<div class="jumbotron bg-gradient-light">
						<header class="content-wrapper mb-5">
							<div class="row">{{-- row welcome --}}
								<div class="col-xl-6 mb-5">
								  <h1 class="display-4 text-gradient-danger font-weight-bold">Hello, Bridge Lovers!</h1>
								  <p class="lead">Welcome to Bridge Gunadarma's website</p>
								  <a href="#about" class="btn btn-primary btn-lg rounded-pill px-5 js-scroll-trigger" role="button">About Us</a>
								</div>
								<div class="col-xl-6 p-1 bg-dark shadow-lg rounded mb-5">
									<article id="slider"> {{-- slider --}}
										<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
										  <ol class="carousel-indicators">
										    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
										    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
										    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
										  </ol>
										  <div class="carousel-inner">
										    <div class="carousel-item active">
										      <img src="{{ asset('assets/img/bridgeug_1.jpg') }}" class="d-block w-100 rounded" alt="...">
										    </div>
										    <div class="carousel-item">
										      <img src="{{ asset('assets/img/bridgeug_2.jpg') }}" class="d-block w-100 rounded" alt="...">
										    </div>
										    <div class="carousel-item">
										      <img src="{{ asset('assets/img/bridgeug_3.jpg') }}" class="d-block w-100 rounded" alt="...">
										    </div>
										  </div>
										  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
										    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
										    <span class="sr-only">Previous</span>
										  </a>
										  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
										    <span class="carousel-control-next-icon" aria-hidden="true"></span>
										    <span class="sr-only">Next</span>
										  </a>
										</div>
								 	</article> {{-- end slider --}}
								</div>
							</div> {{-- end row welcome --}}
						</header>
					  <article id="atlet"> {{-- atlet article --}}
						  <div class="card-borderless">
	            	<div class="rounded">
	            		<div class="col-md p-1 text-center">
	          				<a id="header-article" href="#atlet-collapse" class="text-shadow" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="atlet-collapse"><h1 class="display-4 font-weight-bold text-shadow d-inline">ATLET<i class="fa fa-fw fa-caret-down bg-gradient-success rounded-circle ml-2"></i></h1></a>
	            			<div class="collapse hide bg-transparent" id="atlet-collapse">
	            				<div class="p-3">
				                <div class="row justify-content-center row-cols-1 row-cols-lg-3" >
													@foreach ($data_atlet as $atlet)
													<div class="px-1 mb-5">
													  <div class="card-borderless shadow h-100 bg-dark rounded border-left-success">
													  	<div class="col-md p-2">
													  		<img height="350" width="auto" src="{{ asset('assets/img/img_atlet/'.$atlet->img_atlet) }}" class="card-img-top rounded" alt="{!!$atlet->atlet_name!!}">
													  	</div>
													    <div class="card-body text-center">
													      <h5 class="card-title text-shadow text-white">{{$atlet->atlet_name}}</h5>
													      <hr id="atletHr">
													      <div class="text-white lead font-italic">
													      	<h6>{{$atlet->alamat}}</h6>
													      </div>
													    </div>
													  </div> {{-- end card --}}
													   <a href="{{ url('/detailAtlet/'.$atlet->id) }}" target="_blank" class="btn-detail btn btn-success rounded-pill shadow"><span class="font-weight-bold">Detail <i class="fas fa-external-link-alt"></i></span></a>
													</div>
													@endforeach
												</div> {{-- end atlet row --}}
												<a href="{{ url('/moreAtlet') }}" target="_blank" class="btn btn-success rounded-pill col-md-6 mx-auto shadow mt-5"><span class="lead font-weight-bold">MORE <i class="fas fa-users"></i></span></a>
				              </div>
				            </div> {{-- end collapse --}}
		            	</div>
		            </div>
		          </div> {{-- end card atlet button --}}
		        </article>{{-- end atlet --}}
						<hr id="bridgeHr" class="my-5" width="400">
						<article id="prestasi"> {{-- prestasi article --}}
						  <div class="card-borderless">
	            	<div class="rounded">
	            		<div class="col-md p-1 text-center">
	          				<a id="header-article" href="#prestasi-collapse" class="text-shadow" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prestasi-collapse"><h1 class="display-4 font-weight-bold text-shadow d-inline">PRESTASI<i class="fa fa-fw fa-caret-down  bg-gradient-info rounded-circle ml-2"></i></h1></a>
	            			<div class="collapse hide bg-transparent" id="prestasi-collapse">
	            				<div class="p-4">
					            	<div class="card-borderless">
					                <div class="row row-cols-1 row-cols-lg-3">
														@foreach ($data_prestasi as $prestasi)
														<div class="px-1 mb-5">
														  <div class="card-borderless shadow h-100 bg-dark rounded border-left-info">
														  	<div class="col-md p-2">
														  		<img height="250" width="auto" src="{{ asset('assets/img/img_pre/'.$prestasi->img_pre) }}" class="card-img-top rounded" alt="{!!$prestasi->pre_title!!}">
														  	</div>
														    <div class="card-body">
														      <h5 class="card-title text-white">{{$prestasi->pre_title}}</h5>
														      <p class="mb-4 card-subtitle text-muted">
														      	<?php $date = strtotime($prestasi->pre_date);
														      		echo date('d M Y',$date);
														      	?>
														      </p>
														    </div>
														  </div> {{-- end card --}}
														  <a href="{{ url('/detailPrestasi/'.$prestasi->id) }}" target="_blank" class="btn-detail btn btn-info rounded-pill shadow"><span class="font-weight-bold">Detail <i class="fas fa-external-link-alt"></i></span></a>
														</div>
														@endforeach
													</div> {{-- end prestasi row --}}
													<a href="{{ url('/morePrestasi') }}" target="_blank" class="btn btn-info rounded-pill col-md-6 mx-auto shadow mt-5"><span class="lead font-weight-bold">MORE <i class="fas fa-medal"></i></span></a>
						          	</div>
				              </div>
				            </div> {{-- end collapse --}}
		            	</div>
		            </div>{{-- end card deskripsi --}}
		          </div>
		        </article>{{-- end prestasi --}}
		        <hr id="bridgeHr" class="my-5" width="400">
						 <article id="event"> {{-- event article --}}
						  <div class="card-borderless">
	            	<div class="rounded">
	            		<div class="col-md p-1 text-center">
	          				<a id="header-article" href="#event-collapse" class="text-shadow" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="event-collapse"><h1 class="display-4 font-weight-bold text-shadow d-inline">EVENT<i class="fa fa-fw fa-caret-down  bg-gradient-warning rounded-circle ml-2"></i></h1></a>
	            			<div class="collapse hide bg-transparent" id="event-collapse">
	            				<div class="p-4">
					            	<div class="card-borderless">
					                <div class="row row-cols-1 row-cols-md-3">
														@foreach ($data_event as $event)
														<div class="px-1 mb-5">
														  <div class="card-borderless shadow h-100 bg-dark rounded border-left-warning">
														  	<div class="col-md p-2">
														  		<img height="250" width="auto" src="{{ asset('assets/img/img_eve/'.$event->img_eve) }}" class="card-img-top rounded" alt="{!!$event->eve_title!!}">
														  	</div>
														    <div class="card-body">
														      <h5 class="card-title text-white">{{$event->eve_title}}</h5>
														      <p class="mb-4 card-subtitle text-muted">
														      	<?php $date = strtotime($event->eve_date);
														      		echo date('d M Y',$date);
														      	?>
														      </p>
														    </div>
														  </div> {{-- end card --}}
														  <a href="{{ url('/detailEvent/'.$event->id) }}" target="_blank" class="btn-detail btn btn-warning rounded-pill shadow"><span class="font-weight-bold">Detail <i class="fas fa-external-link-alt"></i></span></a>
														</div>
														@endforeach
													</div> {{-- end event row --}}
													<a href="{{ url('/moreEvent') }}" target="_blank" class="btn btn-warning rounded-pill col-md-6 mx-auto shadow mt-5"><span class="lead font-weight-bold">MORE <i class="far fa-clipboard"></i></span></a>
						          	</div>
				              </div>
				            </div> {{-- end collapse --}}
		            	</div>
		            </div>{{-- end card deskripsi --}}
		          </div>
		        </article> {{-- end event --}}
					</div> {{-- end jumbotron --}}
				</section> {{-- end section main --}}
	 		</div>
	 	</div> {{-- end row --}}
	 	
		<section id="about">
			<div class="no-gutters">
	 			<div class="col-lg">
				 	<div class="">
				 		<div class="bridge-bg p-4">
					 		<div class="bg-light rounded col-md-5 mx-auto shadow">
					 			<div class="container">
			 						<div class="my-3">
										<div class="col-md mx-auto rounded-circle p-4 about-border">
											<h1 class="display-4 text-shadow text-center text-dark font-weight-bold">About</h1>
										</div>
									</div>
					 				<div class="col-md mx-auto text-center py-4">
							  		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos neque, ipsa illo omnis dicta sapiente nisi, illum dolor. Ea perferendis iure dolor? Fugiat ipsa nisi ab soluta pariatur aliquid, natus.</p>
								  </div>
								</div>
							</div>
						  <article id="contact" class="mt-5">	
				 				<div class="row justify-content-center px-2">
				 					<div class="col-md-5 mt-2 bg-primary rounded">
				 						<div class="card-borderless text-white bg-transparent">
										  <div class="card-body">
										  	<h1 class="text-shadow font-weight-bold">Contact</h1>
										  		<hr id="bridgeHr">
										  	<h2 class="card-title ml-2"><i class="fas fa-mobile-alt"></i></h2>
										    <p class="card-text ml-2">xxxx-xxxx-xxxx</p>
										    	<hr id="bridgeHr">
										    <h2 class="card-title ml-2"><i class="fab fa-instagram"></i></h2>
										    <p class="card-text ml-2"><a class="text-white" href="https://www.instagram.com/bridgegunadarmajkt" target="_blank">@bridgegunadarmajkt</a></p>
										    	<hr id="bridgeHr">
										  	<h2 class="card-title ml-2"><i class="far fa-paper-plane"></i></h2>
										    <p class="card-text ml-2"><a class="text-white" href="mailto:someone@example.com" target="_blank">bridgegunadarma@gmail.com</a></p>
										  </div>
										</div> {{-- end card --}}
				 					</div> {{-- end card row --}}
				 					<div class="col-md-5 rounded bg-light mt-2 p-3">
				 						<h2 class="card-title"><i class="fas fa-map-marked-alt"></i></h2>
								    <p class="card-text">Universitas Gunadarma, Kampus C Salemba, Jakarta Pusat.
								    <br>(belakang deretan Gereja St. Carolus)</p>
				 							<iframe class="rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8404.702815305292!2d106.85095023492941!3d-6.198698104947517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4680ba8956b%3A0x6ce461d1f179ab40!2sJl.%20Murtado%203%20No.33%2C%20RT.11%2FRW.5%2C%20Paseban%2C%20Kec.%20Senen%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010440!5e0!3m2!1sen!2sid!4v1589984686992!5m2!1sen!2sid" width="auto" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				 					</div> {{-- end maps --}}
				 				</div> {{-- end row --}}		  
						  </article>
						</div>
					</div> {{-- end jumbotron --}}
				</div>
			</div>
		</section> {{-- end about --}}


	</div>
@endsection