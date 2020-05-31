@extends('layout.admin_cms')
@section('title','Atlet '.$atlet->atlet_name)
@section('section')
  <div class="row no-gutters">
    <div class="col-md-2"></div>
    {{-- start content --}}
    <div class="col-lg d-flex">
      <div class="container">
        <section>
          <div class="row">
            <div class="col-md-6 mt-3">{{-- content 1 --}}
              <div class="text-center">
                <img class="mx-auto shadow rounded d-block" alt="{{$atlet->atlet_name}}" height="200" width="auto" src="{{ url('/assets/img/img_atlet/'.$atlet->img_atlet) }}">
                <h4 class="my-2 pt-2" class="text-center mt-2">{{ $atlet->atlet_name }}</h4>
                <div class="mb-4">
                  <a href="{{ url('/atlet/'.$atlet->id.'/edit') }}" class="text-primary px-2"><i class="fas fa-user-edit"></i> Edit</a>
                  <a href="#delete-atlet" data-toggle="modal" data-target="#delete-atlet" class="text-danger px-2"><i class="fas fa-trash-alt"></i> Delete</a>
                </div>
              </div>
              <table class="table table-borderless">
                <tr class="text-center bg-gradient-info text-white">
                  <th>Kedisiplinan</th>
                  <th>Penguasaan Sistem</th>
                  <th>Teknik Play</th>
                </tr>
                <tr class="text-center">
                  <td>
                    @isset ($atlet->masterpoint->discipline)
                      @if ($atlet->masterpoint->discipline>=8)
                        <h3 class="text-primary">{{$atlet->masterpoint->discipline}}</h3>
                      @elseif($atlet->masterpoint->discipline>=5)
                        <h3 class="text-dark">{{$atlet->masterpoint->discipline}}</h3>
                      @else
                        <h3 class="text-danger">{{$atlet->masterpoint->discipline}}</h3>
                      @endif
                    @endisset
                    @empty ($atlet->masterpoint->discipline)
                      <h3>?</h3>
                    @endempty
                  </td>
                  <td>
                    @isset ($atlet->masterpoint->bidding)
                      @if ($atlet->masterpoint->bidding>=8)
                        <h3 class="text-primary">{{$atlet->masterpoint->bidding}}</h3>
                      @elseif($atlet->masterpoint->bidding>=5)
                        <h3 class="text-dark">{{$atlet->masterpoint->bidding}}</h3>
                      @else
                        <h3 class="text-danger">{{$atlet->masterpoint->bidding}}</h3>
                      @endif
                    @endisset
                    @empty ($atlet->masterpoint->bidding)
                      <h3>?</h3>
                    @endempty
                  </td>
                  <td>
                    @isset ($atlet->masterpoint->play)
                      @if ($atlet->masterpoint->play>=8)
                        <h3 class="text-primary">{{$atlet->masterpoint->play}}</h3>
                      @elseif($atlet->masterpoint->play>=5)
                        <h3 class="text-dark">{{$atlet->masterpoint->play}}</h3>
                      @else
                        <h3 class="text-danger">{{$atlet->masterpoint->play}}</h3>
                      @endif
                    @endisset
                    @empty ($atlet->masterpoint->play)
                      <h3>?</h3>
                    @endempty
                  </td>
                </tr>
              </table>
              <div class="text-center">
                @isset ($atlet->masterpoint->id)        
                  <a href="{{ url('/masterpoint/'.$atlet->masterpoint->id.'/edit') }}" class="text-info"><i class="fa fa-edit"></i> Update</a>
                @endisset
                @empty ($atlet->masterpoint->id)
                  <a href="{{ url('/masterpoint') }}" class="text-info"><i class="fa fa-edit"></i> Update</a>
                @endempty
              </div>
              <hr width="300">
              <div id="brg_taught" class="my-5">
                <div class="card-borderless shadow rounded">
                  <div class="card-body">
                    <p class="card-title text-center text-muted font-italic">What have I learned from bridge?</p>
                    <h5 class="card-text font-italic">
                      @isset($atlet->brg_taught)
                          {!! $atlet->brg_taught !!}
                      @endisset
                      @empty($atlet->brg_taught)
                          Alert! Description not found.
                      @endempty
                    </h5>
                    <p class="card-text"><small class="text-muted">
                      created : 
                      @php
                        $created = strtotime($atlet->created_at);
                        echo date('D, d-m-Y',$created)
                      @endphp
                    </small></p>
                  </div>
                </div>
              </div> {{-- end brg_taught --}}
            </div>{{--end content 1 --}}

            <div class="col-md-6 mt-3"> {{-- content 2 --}}
              <div class="border-l-i_border-r-d py-1 mb-3 shadow-sm rounded">
                <h5 class="text-muted lead text-center font-italic">Major information</h5>
              </div>
              <table class="table table-striped table-borderless mx-auto">
                <tbody class="clearfix">
                  <tr>
                    <th>NIK</th>
                    <td>:</td>
                    <td>{{$atlet->nik}}</td>
                  </tr>
                  <tr>
                    <th>Tanggal lahir</th>
                    <td>:</td>
                    <td>
                      <?php $tgl_lahir = strtotime($atlet->tgl_lahir) ?>
                      {{date("d M Y", $tgl_lahir)}}
                    </td>
                  </tr>
                  <tr>
                    <th>Jenis Kelamin</th>
                    <td>:</td>
                    <td>{{$atlet->gender}}</td>
                  </tr>
                  <tr>
                    <th>No Hp</th>
                    <td>:</td>
                    <td>{{$atlet->telp}}</td>
                  </tr>
                  <tr>
                    <th>E-mail</th>
                    <td>:</td>
                    <td>{{$atlet->email}}</td>
                  </tr>
                  <tr>
                    <th>Domisili</th>
                    <td>:</td>
                    <td>{{$atlet->alamat}}</td>
                  </tr>
                  <tr>
                    <th>Fakultas</th>
                    <td>:</td>
                    <td>{{$atlet->fakultas}}</td>
                  </tr>
                  <tr>
                    <th>Jurusan</th>
                    <td>:</td>
                    <td>{{$atlet->jurusan}}</td>
                  </tr>
                  <tr>
                    <th>Angkatan</th>
                    <td>:</td>
                    <td>{{$atlet->angkatan}}</td>
                  </tr>
                </tbody>
              </table>
              <p class="card-text ml-2"><small class="text-muted">
              last updated : 
              @php
                $updated = strtotime($atlet->updated_at);
                echo date('D, d-m-Y',$updated);
              @endphp
              </small></p>
              {{-- card prestasi --}}
              @if(session('ErrorInputPre'))
                {!! session('ErrorInputPre') !!}
              @endif
              @if(session('AlertSuccessPre'))
                {!!session('AlertSuccessPre') !!}
              @endif
              <div class="card-borderless">
                <div class="bg-gradient-info rounded">
                  <div class="col-md p-1">
                    <a href="#prestasi" class="btn btn-block text-white" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prestasi"><h5><i class="fas fa-trophy"></i> List Prestasi Atlet<i class="fa fa-fw fa-caret-down"></i></h5></a>
                    <div class="collapse" id="prestasi">
                      <div class="p-4">
                        <div class="card-borderless bg-white p-4 shadow rounded">
                          <div class="p-2 mt-3">
                            <a id="btn-wh" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-tambah-atlet-prestasi"><i class="far fa-plus-square"></i>&nbsp; <i class="far fa-user"></i></a>
                          </div>
                          <table class="table table-borderless mx-auto">
                            <tr>
                              <th>List Prestasi ({{$atlet->prestasi->count()}})</th>
                              <th hidden>Action</th>
                            </tr>
                            <tbody class="clearfix">
                              @foreach($atlet->prestasi as $prestasi)
                                <tr>
                                  <td>
                                    <a href="{{ url('/prestasi/'.$prestasi->id) }}">{{$prestasi->pre_title}}</a>
                                  </td>
                                  <td width="100">
                                    <a href="{{ url('/atlet/'.$atlet->id.'/'.$prestasi->id.'/removePrestasi') }}" onclick="return confirm('Anda yakin?')"><h5><i class="far fa-minus-square"></i></h5></a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div> {{-- end collapse --}}
                  </div>
                </div>
              </div>{{-- end card prestasi --}}

              <div><hr class="m-4"></div>

              {{-- card pelatihan --}}
              @if(session('ErrorInputHist'))
                {!! session('ErrorInputHist') !!}
              @endif
              @if(session('AlertSuccessHist'))
                {!!session('AlertSuccessHist') !!}
              @endif
              <div class="card-borderless">
                <div class="bg-gradient-info rounded">
                  <div class="col-md p-1">
                    <a href="#pelatihan" class="btn btn-block text-white" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pelatihan"><h5><i class="far fa-lightbulb"></i> List Pelatihan Atlet<i class="fa fa-fw fa-caret-down"></i></h5></a>
                    <div class="collapse" id="pelatihan">
                      <div class="p-4">
                        <div class="card-borderless bg-white p-4 shadow rounded">
                          <div class="p-2">
                            <a id="btn-wh" class="btn bg-gradient-primary" data-toggle="modal" data-target="#modal-tambah-atlet-history"><i class="far fa-plus-square"></i>&nbsp; <i class="far fa-user"></i></a>
                          </div>
                          <table class="table table-borderless mx-auto">
                            <tr>
                              <th colspan="2">List Pelatihan ({{$atlet->history->count()}})</th>
                              <th hidden>Action</th>
                            </tr>
                            <tbody class="clearfix">
                              @foreach($atlet->history as $history)
                                <tr>
                                  <td>
                                    <a href="{{ url('/history/'.$history->id) }}">{{$history->hist_title}}</a>
                                  </td>
                                  <td>
                                    @php
                                      $date = strtotime($history->hist_date);
                                      echo date('D, d-M-Y',$date);
                                    @endphp
                                  </td>
                                  <td width="100">
                                    <a href="{{ url('/atlet/'.$atlet->id.'/'.$history->id.'/removeHistory') }}" onclick="return confirm('Anda yakin?')"><h5><i class="far fa-minus-square"></i></h5></a>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div> {{-- end collapse --}}
                  </div>
                </div>
              </div>{{-- end card pelatihan --}}
            </div>{{--end content 2 --}}
          </div>{{--end row --}}
        </section>
      </div>{{-- end container --}}
    </div> {{-- end content --}}
  </div>
  <div class="ml-4 my-5">
    <a href="{{ url('/atlet') }}" class="btn btn-dark btn-sm btn-fade rounded-pill px-5 shadow"><span class="lead font-weight-bold"><i class="fas fa-caret-left"></i> Table</span></a>
  </div>

  <!-- Modal Tambah Prestasi Atlet-->
  <div class="modal fade" id="modal-tambah-atlet-prestasi" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tambah Prestasi Atlet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/atlet/'.$atlet->id.'/addPrestasi') }}" method="POST">
            @csrf
            <div class="form-group col-md-9">
              <label for="prestasi">List Prestasi</label>
              <select class="form-style-static" name="prestasi" id="prestasi">
                @foreach ($data_prestasi as $prestasi)
                  <option value="{{$prestasi->id}}">{{$prestasi->pre_title}} |  
                    @php
                      $date = strtotime($prestasi->pre_date);
                      echo date('d-M-Y',$date);
                    @endphp
                  </option>
                @endforeach
              </select>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="btn-form btn btn-danger">Reset</button>
              <button type="button" class="btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> {{-- end modal --}}

  <!-- Modal Tambah History Atlet-->
  <div class="modal fade" id="modal-tambah-atlet-history" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Tambah List Pelatihan Atlet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/atlet/'.$atlet->id.'/addHistory') }}" method="POST">
            @csrf
            <div class="form-group col-md-9">
              <label for="history">List Pelatihan</label>
              <select class="form-style-static" name="history" id="history">
                @foreach ($data_history as $history)
                  <option value="{{$history->id}}">{{$history->hist_title}} |  
                    @php
                      $date = strtotime($history->hist_date);
                      echo date('d-M-Y',$date);
                    @endphp
                  </option>
                @endforeach
              </select>
            </div>
            <div class="ml-5 pb-5">
              <button onclick="javascript: return confirm('Tambahkan ke DATABASE ?')" type="submit" class="btn-form btn btn-primary">Insert</button>
              <button type="reset" class="btn-form btn btn-danger">Reset</button>
              <button type="button" class="btn-form btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> {{-- end modal --}}

  {{-- Modal Delete Atlet --}}
  <div class="modal fade" id="delete-atlet" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete From Database?</h5>
        </div>
        <div class="modal-body"> 
          <div class="mb-4 font-italic">
            <small>Semua data yang berkaitan dengan <span class="text-danger font-weight-bold">{{$atlet->atlet_name}}</span> akan terhapus!</small>
          </div>
          <form class="d-inline" action="{{ url('/atlet/'.$atlet->id) }}" method="post">
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