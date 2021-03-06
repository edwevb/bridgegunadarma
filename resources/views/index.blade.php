 @extends('layout/main')
 @section('title', 'Home')
 @section('section')
 	<div class="content-home no-gutters">
 		<div class="col-lg">
 			<section id="home" class="bg-light pb-2"> {{-- main --}}
		 		{{-- start Jumbotron --}}
				<div class="jumbotron bg-transparent">
					<header class="mb-5 startContent">
						<div class="row">{{-- row welcome --}}
							<div class="col-xl-6 mb-5">
							  <h1 class="display-4 text-gradient-purple">Hello, Bridge Lovers!</h1>
							  <p class="lead">Welcome to Bridge Gunadarma website</p>
							  <a href="#about" class="btn btn-lg btn-salmon btn-none text-white rounded-pill px-5 js-scroll-trigger" role="button">About Us</a>
							</div>
							<div class="col-xl-6 p-1 bg-purple shadow-lg rounded mb-5">
								<article id="slider">
									<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
									  <ol class="carousel-indicators">
									    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
									    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
									    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
									  </ol>
									  <div class="carousel-inner">
									    <div class="carousel-item active">
									      <img src="{{ asset('assets/img/bridgeug_1.jpg') }}" class="d-block w-100 rounded text-white" alt="ImagePreview">
									    </div>
									    <div class="carousel-item">
									      <img src="{{ asset('assets/img/bridgeug_2.jpg') }}" class="d-block w-100 rounded text-white" alt="ImagePreview">
									    </div>
									    <div class="carousel-item">
									      <img src="{{ asset('assets/img/bridgeug_3.jpg') }}" class="d-block w-100 rounded text-white" alt="ImagePreview">
									    </div>
									  </div>
									</div>
							 	</article> {{-- end slider --}}
							</div>
						</div> {{-- end row welcome --}}
					</header>
				</div> {{-- end jumbotron --}}
				<div class="d-block gunadarmaCup bg-gradient-purple py-5">
					<div class="text-center">
					  <div class="gundarCup text-animate text-shadow">GUNADARMA CUP</div>
					  <div class="py-4">
					  	<a type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-lg btn-salmon btn-none text-white rounded-pill px-5 shadow" href="#" role="button">Learn more</a>
					  </div>
				  </div>
					<!-- Modal -->
					<div class="modal fade bg-gradient-salmon" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered modal-lg">
					    <div class="modal-content bg-purple br-50">
			      		<a class="p-5 text-white text-center" type="button" disabled>
								  <span class="spinner-grow" role="status"></span>
								  <h1 class="d-inline"><span class="text-salmon font-weight-bold" style="letter-spacing:3px;">Postponed</span></h1><br><h3><i class="far fa-frown my-2"></i><br>Due to Corona Virus.</h3>
								</a>
									<small class="m-1 text-center text-white" role="button" data-dismiss="modal">X Close</small>
					    </div>
					  </div>
					</div>{{-- end modal --}}
				</div>
				<div class="mb-5 pb-5"></div>
				<div class="bg-transparent">
				  <article id="atlet"> {{-- atlet article --}}
					  <div class="d-block">
	        		<div class="p-1 text-center">
	    					<a href="#atlet-collapse" class="title" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="atlet-collapse">ATLET<br><i class="fa fa-fw fa-caret-down fa-2x text-salmon"></i></a>
	        			<div class="collapse hide" id="atlet-collapse">
	        				<div class="p-3">
		                <div class="row row-cols-1 row-cols-md-3" >
											@foreach ($data_mpoint as $mp)
											<div class="px-1 mb-5">
											  <div class="card-borderless h-100 shadow rounded">
											  	<div class="col-md p-2">
											  		<a href="{{ url('/detailAtlet/'.$mp->atlet_id.'/'.\Str::slug($mp->atlet->atlet_name,'-')) }}"><img height="350" width="auto" src="{{ asset('assets/img/img_atlet/'.$mp->atlet->img_atlet) }}" class="card-img-top rounded text-white" alt="ImagePreview"></a>
											  	</div>
											    <div class="card-body text-center">
											      <a id="body-link" href="{{ url('/detailAtlet/'.$mp->atlet_id.'/'.\Str::slug($mp->atlet->atlet_name,'-')) }}"><h5 class="card-title font-weight-bold">{{$mp->atlet->atlet_name}}</h5></a>
											      <hr id="atletHr" class="bg-gradient-salmon">
											      <div class="text-white lead font-italic">
										      	<h6>{{$mp->atlet->alamat}}</h6>
											      </div>
											    </div>
											  </div> {{-- end card --}}
											</div>
											@endforeach
										</div> {{-- end atlet row --}}
										<a href="{{ url('/moreAtlet') }}" class="btn btn-salmon text-white rounded-pill col-md-6 mx-auto shadow mt-5"><span class="lead font-weight-bold">Load More <i class="fas fa-users"></i></span></a>
		              </div>
		            </div> {{-- end collapse --}}
	          	</div>`
	          </div> {{-- end card atlet button --}}
	        </article>{{-- end atlet --}}
					<hr id="bridgeHr" class="my-5 col-6 bg-gradient-salmon">
					<article id="prestasi"> {{-- prestasi article --}}
					  <div class="d-block">
	        		<div class="p-1 text-center">
	    					<a href="#prestasi-collapse" class="title" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prestasi-collapse">PRESTASI<br><i class="fa fa-fw fa-caret-down fa-2x text-salmon"></i></a>
	        			<div class="collapse hide" id="prestasi-collapse">
	        				<div class="p-3">
		                <div class="row row-cols-1 row-cols-md-3">
											@foreach ($data_prestasi as $prestasi)
											<div class="px-1 mb-5">
											  <div class="card-borderless shadow h-100 bg-gradient-purple rounded">
											  	<div class="col-md p-2">
											  		<a href="{{ url('/detailPrestasi/'.$prestasi->id.'/'.\Str::slug($prestasi->pre_title,'-')) }}"><img height="250" width="auto" src="{{ asset('assets/img/img_pre/'.$prestasi->img_pre) }}" class="card-img-top rounded text-white" alt="ImagePreview"></a>
											  	</div>
											    <div class="card-body">
											      <a id="body-link" href="{{ url('/detailPrestasi/'.$prestasi->id.'/'.\Str::slug($prestasi->pre_title,'-')) }}"><h5 class="card-title font-weight-bold">{{$prestasi->pre_title}}</h5></a>
											      <p class="mb-4 card-subtitle text-white">
											      	<?php $date = strtotime($prestasi->pre_date);
											      		echo date('d M Y',$date);
											      	?>
											      </p>
											    </div>
											  </div> {{-- end card --}}
											</div>
											@endforeach
										</div> {{-- end prestasi row --}}
										<a href="{{ url('/morePrestasi') }}" class="btn btn-salmon text-white rounded-pill col-md-6 mx-auto shadow mt-5"><span class="lead font-weight-bold">Load More <i class="fas fa-medal"></i></span></a>
		              </div>
		            </div> {{-- end collapse --}}
	          	</div>
	          </div>
	        </article>{{-- end prestasi --}}
	        <hr id="bridgeHr" class="my-5 col-6 bg-gradient-salmon">
					 <article id="event"> {{-- event article --}}
					  <div class="d-block">
	        		<div class="p-1 text-center">
	      				<a href="#event-collapse" class="title" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="event-collapse">TOURNAMENT/EVENT<br><i class="fa fa-fw fa-caret-down fa-2x text-salmon"></i></a>
	        			<div class="collapse" id="event-collapse">
	        				<div class="p-3">
		                <div class="row row-cols-1 row-cols-md-3">
											@foreach ($data_event as $event)
											<div class="px-1 mb-5">
											  <div class="card-borderless shadow h-100 bg-gradient-purple rounded">
											  	<div class="col-md p-2">
											  		<a href="{{ url('/detailEvent/'.$event->id.'/'.\Str::slug($event->eve_title,'-')) }}"><img height="250" width="auto" src="{{ asset('assets/img/img_eve/'.$event->img_eve) }}" class="card-img-top rounded text-white" alt="ImagePreview"></a>
											  	</div>
											    <div class="card-body">
											      <a id="body-link" href="{{ url('/detailEvent/'.$event->id.'/'.\Str::slug($event->eve_title,'-')) }}"><h5 class="card-title font-weight-bold">{{$event->eve_title}}</h5></a>
											      <p class="mb-4 card-subtitle text-white">
											      	<?php $date = strtotime($event->eve_date);
											      		echo date('d M Y',$date);
											      	?>
											      </p>
											    </div>
											  </div> {{-- end card --}}
											</div>
											@endforeach
										</div> {{-- end event row --}}
										<a href="{{ url('/moreEvent') }}" class="btn btn-salmon text-white rounded-pill col-md-6 mx-auto shadow mt-5"><span class="lead font-weight-bold">Load More <i class="far fa-clipboard"></i></span></a>
		              </div>
		            </div> {{-- end collapse --}}
	          	</div>
	          </div>
	        </article> {{-- end event --}}
	        <hr id="bridgeHr" class="my-5 col-6 bg-gradient-salmon">
				</div>
			</section> {{-- end section main --}}
 		</div>
		<section id="about">
			<div class="no-gutters">
	 			<div class="d-block">
				 	<div class="bridge-bg">
				 		<div class="container pt-5">
					 		<div class="bg-light rounded col-md-10 mx-auto shadow about">
		 						<div class="p-2">
									<div class="mt-4 showAbout">
										<h1 class="text-center text-gradient-purple">ABOUT</h1>
									</div>
									<hr id="bridgeHr" class="bg-gradient-salmon" width="200">
								</div>
								<div class="col-md-6 mx-auto text-center mb-4">
									Bridge Gunadarma merupakan organisasi olahraga Bridge Universitas Gunadarma yang berdiri pada tahun 1992 dan masih "aktif" hingga saat ini. Dengan berkompetisi membawa nama Gunadarma, Bridge Gunadarma telah menorehkan banyak prestasi pada tingkat nasional hingga internasional.
								</div>
								<hr id="bridgeHr" width="200">
								<div class="row">
									<div class="col-md-5 mx-auto text-justify py-2">
							  		<div class="aboutLeft text-center">
							  			<h5 class="lead font-weight-bold">VISI</h5>
							  			<p>
							  				Meningkatkan kualitas Atlet dan menjadi sarana peningkatan EQ (Emotional Qoutient), IQ (Intellegence Qoutient, SQ (Spiritual Qoutient), dan CQ (Creativity Qoutient) bagi para Atlet Bridge Gunadarma.
							  			</p>
							  		</div>
								  </div>		
								  <div class="col-md-5 mx-auto text-justify py-2">
							  		<div class="aboutRight text-center">
							  			<h5 class="lead font-weight-bold">MISI</h5>
							  			<p>
							  				Bridge Gunadarma mampu berprestasi agar Gunadarma dikenal tidak saja di Indonesia, namun juga secara internasional melalui cabang olahraga Bridge.
							  			</p>
							  		</div>
								  </div>
								</div>
								<div class="text-center pb-2 font-italic">
									<small>W.D. Karamoy (2011)</small>
								</div>
							</div>
						  <article id="contact" class="mt-5">	
				 				<div class="row justify-content-center px-2 contact">
				 					<div class="col-md-5 mt-2 bg-gradient-purple rounded showContact1">
				 						<div class="card-borderless text-white bg-transparent">
										  <div class="card-body">
										  	<h1 class="text-shadow font-weight-bold">CONTACT</h1>
										  		<hr id="bridgeHr">
										  	<h2 class="card-title ml-2"><i class="fas fa-mobile-alt"></i></h2>
										    <p class="card-text ml-2">xxxx-xxxx-xxxx</p>
										    	<hr id="bridgeHr">
										    <h2 class="card-title ml-2"><i class="fab fa-instagram"></i></h2>
										    <p class="card-text ml-2"><a class="text-white" href="https://www.instagram.com/bridgegunadarmajkt" target="_blank">@bridgegunadarmajkt</a></p>
										    	<hr id="bridgeHr">
										  	<h2 class="card-title ml-2"><i class="far fa-paper-plane"></i></h2>
										    <p class="card-text ml-2"><a class="text-white" href="mailto:bridgegundarma@gmail.com" target="_blank">bridgegunadarma@gmail.com</a></p>
										  </div>
										</div> {{-- end card --}}
				 					</div> {{-- end card row --}}
				 					<div class="col-md-5 rounded bg-salmon mt-2 p-3 showContact2 text-white">
				 						<h2 class="card-title"><i class="fas fa-map-marked-alt"></i></h2>
								    <p class="card-text">Universitas Gunadarma, Kampus C Salemba, Jakarta Pusat.</p>
				 							<iframe class="rounded col-md" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8404.702815305292!2d106.85095023492941!3d-6.198698104947517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4680ba8956b%3A0x6ce461d1f179ab40!2sJl.%20Murtado%203%20No.33%2C%20RT.11%2FRW.5%2C%20Paseban%2C%20Kec.%20Senen%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010440!5e0!3m2!1sen!2sid!4v1589984686992!5m2!1sen!2sid" height="250" width="auto" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				 					</div> {{-- end maps --}}
				 				</div> {{-- end row --}}		  
						  </article>
						</div> {{-- end container --}}
					</div> {{-- end bridgebg --}}
				</div>
			</div>
		</section> {{-- end about --}}
	</div>
	@section('script')
		<script>
			$(window).on('load', function(){
				$('.startContent').addClass('showContent');
			});

			$(window).scroll(function(){
			  var wScroll = $(this).scrollTop();

			  if (wScroll > $('.about').offset().top - 500)
			  {
			    $('.about').addClass('showAbout');
			    $('.about').addClass('aboutLeft');
			    $('.about').addClass('aboutRight');
			  }

			  if (wScroll > $('.contact').offset().top - 500)
			  {
			    $('.contact').addClass('showContact1');
			    $('.contact').addClass('showContact2');
			  }
			});
		</script>
	@stop	
@endsection