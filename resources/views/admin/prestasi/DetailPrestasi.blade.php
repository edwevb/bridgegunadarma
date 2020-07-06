@extends('layout.admin_cms')
@section('title','Prestasi '.$prestasi->pre_title)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <div class="my-2 text-muted">
          <small>Dashboard / Data / Prestasi / {{$prestasi->pre_title}}</small>
        </div>
        <section>
          <div class="row">
            <div class="card-borderless col-md-6 rounded">
              <div class="m-1">
                <div class="text-center mt-4">
                  <img class="rounded col-md bg-dark p-1" src="{{ url('assets/img/img_pre/'.$prestasi->img_pre) }}" alt="{{$prestasi->pre_title}}">
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
                <hr id="bridgeHr">
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
            </div><!--end card-->
            <div class="col-md-6">
              <div class="my-4">
                <a id="btn-wh" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-tambah-daftar-atlet"><i class="far fa-plus-square"></i> Tambah List Atlet</a>
              </div>
              <div class="mb-4">
                @if(session('ErrorInput'))
                  {!! session('ErrorInput') !!}
                @endif
                @if(session('AlertSuccess'))
                  {!!session('AlertSuccess') !!}
                @endif
                <h5 class="m-1">List Atlet Berprestasi</h5>
              </div>
              <div class="table-responsive-xl m-1">
                <table class="table table-borderless mx-auto">
                  <tbody>
                    @foreach ($prestasi->atlet as $atlet)
                    <tr>
                      <th width="10" scope="row">{{$loop->iteration}}</th>
                      <td>{{$atlet->atlet_name}}</td>
                      <td>
                        <a href="{{ url('/prestasi/'.$prestasi->id.'/'.$atlet->id.'/removeAtlet') }}" onclick="return confirm('Anda yakin?')"><i class="fa fa-trash"></i> Remove</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>{{-- end table --}}
            </div>
          </div> {{-- end row --}}
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
  <!-- Modal Tambah Daftar Atlet-->
  <div class="modal fade" id="modal-tambah-daftar-atlet" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tambah Atlet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/prestasi/'.$prestasi->id.'/addAtlet') }}" method="POST">
            @csrf
            <div class="form-group col-md-9">
              <label for="atlet">List atlet</label>
              <select class="form-style-static" name="atlet" id="atlet">
                @foreach ($data_atlet as $atlet)
                  <option value="{{$atlet->id}}">{{$atlet->atlet_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('This is a confirmation message, click (OK) to continue the action.')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="btn-form btn btn-danger">Reset</button>
              <button type="button" class="btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> {{-- end modal --}}

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