@extends('layout.detail')
@section('title', $prestasi->pre_title)
@section('content')
	<div class="content-home">
		<div class="py-5 bg-light">
      <section id="home-detail-header" class="pb-5 container">
      	<div class="mb-5 text-gradient-purple">
      		<h1 class="text-center">Prestasi Bridge Gunadarma</h1>
      	</div>
        <div class="row">
        	<div class="card-borderless rounded p-3 col-md-6">
      			<div class="">
        			<div class="text-center" id="prestasi">
            		<img class="shadow col-md rounded p-1 bg-gradient-salmon text-white" alt="{{$prestasi->pre_title}}" src="{{ url('/assets/img/img_pre/'.$prestasi->img_pre) }}">
              </div>
        		</div>
        		<div class="col-md">
        			<div class="card-body">
                <h5 class="card-title text-salmon font-weight-bold">{{$prestasi->pre_title}}</h5>
                <h6 class="card-subtitle mb-2">
                  @php
                    $date = strtotime($prestasi->pre_date);
                    echo date('d M Y', $date);
                  @endphp
                </h6>
                <hr id="bridgeHr" class="bg-gradient-salmon">
                <div class="card-text">
                  @isset ($prestasi->pre_isi)
                    {!!$prestasi->pre_isi!!}
                  @endisset
                  @empty ($prestasi->pre_isi)
                    <p class="font-italic">No description found.</p>
                  @endempty
                </div>
              </div>
        		</div>
          </div> {{-- end card --}}
          <div class="text-center col-md-6">
            <div class="font-weight-bold lead text-salmon">List Atlet Berprestasi</div>
            @foreach ($sort_atlet as $atlet)
              <ul class="list-group">
                <a class="btn-none rounded-pill" href="{{ url('/detailAtlet/'.$atlet->id.'/'.\Str::slug($atlet->atlet_name)) }}">
                  <li class="list-group-item btn btn-sm btn-salmon text-white">
                    <span class="lead">{!!$atlet->atlet_name!!}</span>
                  </li>
                </a>
              </ul>
            @endforeach
          </div>
        </div> {{-- end row --}}
      </section>
      <div class="text-center mt-5">
        <div class="col-md-6 mx-auto">
          <button type="button" class="btn btn-salmon btn-none rounded-pill font-weight-bold col-md-4" data-toggle="modal" data-target="#ModalShare"><span class="lead font-weight-bold">Share <i class="fas fa-share-square"></i></span></button>
        </div>
        <div class="col-md-6 mt-2 mx-auto">
          <a href="{{ url('/morePrestasi') }}" class="btn btn-salmon btn-none rounded-pill col-md-4 shadow text-white"><span class="lead font-weight-bold">Load More <i class="fas fa-medal"></i></span></a>
        </div>
      </div>
	  </div>
	</div>
  <div class="modal fade bg-dark" id="ModalShare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Share This Page</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="addthis_inline_share_toolbox_8sj8"></div>
        </div>
      </div>
    </div>
  </div>
	@section('script')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5eef7ac28f548f31"></script>
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

