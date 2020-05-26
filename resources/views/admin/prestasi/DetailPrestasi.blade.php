@extends('layout.admin_cms')
@section('title','Prestasi '.$prestasi->pre_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <section>
          <div class="card-borderless col-md-11 mx-auto border-left-info rounded">
            <div class="row no-gutters m-3">
              <div class="col-md-4 text-center mt-4">
                <img class="rounded col-md" src="{{ url('assets/img/img_pre/'.$prestasi->img_pre) }}" alt="{{$prestasi->pre_title}}" height="auto" width="auto">
                <div class="text-center mt-4">
                  <a href="{{ url('/prestasi/'.$prestasi->id.'/edit') }}" class="text-primary px-2"><i class="fa fa-edit"></i> Edit</a>
                  <a href="#delete-prestasi" data-toggle="modal" data-target="#delete-prestasi" class="text-danger px-2"><i class="fa fa-trash"></i> Delete</a>
                  <p class="my-4 text-left">
                    <small class="text-muted">
                      created : 
                      @php
                        $created = strtotime($prestasi->created_at);
                        echo date('D, d-m-Y', $created);
                      @endphp
                    </small>
                  </p>
                </div>
              </div>
              <div class="col-md">
                <div class="card-body">
                  <h5 class="card-title">{{$prestasi->pre_title}}</h5>
                  <h6 class="card-subtitle mb-2 text-muted">
                    @php
                      $date = strtotime($prestasi->pre_date);
                      echo date('d M Y', $date);
                    @endphp
                  </h6>
                  <div class="card-text text-justify">
                    @isset ($prestasi->pre_isi)
                      {!!$prestasi->pre_isi!!}
                    @endisset
                    @empty ($prestasi->pre_isi)
                      <p class="font-italic">No description found.</p>
                    @endempty
                    <div class="py-4">
                      <hr class="bridgeHr">
                      <h5>List Partisipasi Atlet</h5>
                      @foreach ($prestasi->atlet as $atlet)
                        <li class="ml-4"><a href="{{ url('/atlet/'.$atlet->id) }}">{{$atlet->atlet_name}}</a></li>
                      @endforeach
                    </div>
                  </div>
                  <p class="my-2"><small class="text-muted">
                    last updated : 
                    @php
                      $updated = strtotime($prestasi->updated_at);
                      echo date('D, d-m-Y', $updated);
                    @endphp
                  </small></p>
                </div>
              </div>
            </div>
          </div><!--end card-->
        </section>
      </div>
    </div>{{-- end content --}}
  </div>
  <div class="ml-4 my-5">
    <a href="{{ url('/prestasi') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>
  {{-- Modal Delete Prestasi --}}
  <div class="modal fade" id="delete-prestasi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body">
          <div class="mb-4 font-italic">
            <small>Semua data yang berkaitan dengan <span class="text-danger font-weight-bold">{{$prestasi->pre_title}}</span> akan terhapus!</small>
          </div>
          <form class="d-inline" action="{{ url('/prestasi/'.$prestasi->id) }}" method="post">
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