@extends('mylayouts.app')
@section('title', 'Form '.ucwords($mode).' Pejabat / Bidang')
@push('library-css')
<style>
   .select_sm {
   height: 33.22222px !important;
   padding-bottom: 2px !important;
   padding-top: 2px !important;
   padding-right: 2px !important;
   padding-left: 2px !important;
   }
</style>
@endpush
@section('content')
<section class="section">
   <div class="section-header">
      <h1>{{'Form '.ucwords($mode).' Pejabat / Bidang'}}</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></div>
         <div class="breadcrumb-item"><a href="{{route('perangkat-daerah')}}">Daftar PD</a></div>
         <div class="breadcrumb-item active">{{'Form '.ucwords($mode).''}}</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-sm-8 order-sm-0 order-lg-1 order-xl-1">
            <div class="card">
               <form id="form" name="form" role="form" action="{{$action}}"
                  enctype="multipart/form-data" method="post">
                  {{csrf_field()}}
                  @if($mode=='ubah')
                  {{ method_field('PUT') }}
                  @endif
                  <div class="card-body">
                     <div class="col-sm-12">
                        <div class="row mb-3">
                           <label class="col-sm-3 col-lg-3 col-form-label">Nama</label>
                           <div class="col-sm-9 col-lg-9">
                              <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-building"></i></label>
                                 </span>
                                 <input class="form-control @error('nama_opd') is-invalid @enderror"
                                    placeholder="Contoh : Badan Perencanaan Daerah"
                                    required="required" name="nama_opd" id="nama_opd"
                                    type="text" value="{{$nama_opd}}">
                              </div>
                              @error('nama_opd')
                              <div class="invalid-feedback" id="error_nama_opd">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                        </div>
                        <div class="row mb-3">
                           <label class="col-sm-3 col-lg-3 col-form-label">Bidang / Bagian</label>
                           <div class="col-sm-9 col-lg-9">
                              <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-chalkboard-teacher"></i></label>
                                 </span>
                                 <input class="form-control @error('alias_opd') is-invalid @enderror"
                                    placeholder="Contoh : Bidang  Umum"
                                    required="required" name="alias_opd" id="alias_opd"
                                    type="text"
                                    value="{{$alias_opd}}">
                              </div>
                              @error('alias_opd')
                              <div class="invalid-feedback" id="error_alias_opd">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                        </div>
                        <div class="row mb-3">
                           <label class="col-sm-3 col-lg-3 col-form-label">Alamat</label>
                           <div class="col-sm-9 col-lg-9">
                              <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-address-book"></i></label>
                                 </span>
                                 <input
                                    class="form-control @error('alamat_opd') is-invalid @enderror"
                                    placeholder="Contoh : Jalan Robert Wolter Monginsidi No. xxx"
                                     name="alamat_opd" id="alamat_opd"
                                    type="text" value="{{$alamat_opd}}">
                              </div>
                              @error('alamat_opd')
                              <div class="invalid-feedback" id="error_alamat_opd">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                        </div>
                        <div class="row mb-3">
                           <label class="col-sm-3 col-lg-3 col-form-label">Email</label>
                           <div class="col-sm-9 col-lg-9">
                              <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-envelope"></i></label>
                                 </span>
                                 <input class="form-control @error('email_opd') is-invalid @enderror"
                                    placeholder="Contoh : umum@gmail.com"
                                    name="email_opd" id="email_opd"
                                    type="email"
                                    value="{{$email_opd}}">
                              </div>
                              @error('email_opd')
                              <div class="invalid-feedback" id="error_email_opd">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                        </div>
                        <div class="row mb-3">
                           <label class="col-sm-3 col-lg-3 col-form-label">No Telepon</label>
                           <div class="col-sm-9 col-lg-9">
                              <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-phone"></i></label>
                                 </span>
                                 <input
                                    class="form-control @error('notelepon_opd') is-invalid @enderror"
                                    placeholder="Contoh : (0721) 485458"
                                     name="notelepon_opd" id="notelepon_opd"
                                    type="text" onkeypress="return check_int(event)" maxlength="14"
                                    value="{{$notelepon_opd}}">
                              </div>
                              @error('notelepon_opd')
                              <div class="invalid-feedback" id="error_notelepon_opd">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                        </div>
                        <div class="row mb-3">
                           <label class="col-sm-3 col-lg-3 col-form-label">Status</label>
                           <div class="col-sm-9 col-lg-9">
                              <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-unlock"></i></label>
                                 </span>
                                 <select name="active"
                                    class="form-control @error('active') is-invalid @enderror">
                                 <option value="1" {{$active==1 ? 'selected' : ''}}>Aktif
                                 </option>
                                 <option value="0" {{$active==0 ? 'selected' : ''}}>Tidak Aktif
                                 </option>
                                 </select>
                              </div>
                              @error('password_confirmation')
                              <div class="invalid-feedback" id="error_jenis_ttd">
                                 {{$message}}
                              </div>
                              @enderror
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer text-right bg-whitesmoke">
                     @if($mode=='tambah')
                     <button type="reset" class="btn btn-secondary mr-2">Reset Form</button>
                     @endif
                     <button type="submit" class="btn btn-primary mr-2"><i class="mr-50 fa fa-save"></i>
                     @if($mode=='ubah') Simpan Perubahan @else Submit @endif
                     </button>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-sm-4 order-sm-0 order-lg-0 order-xl-0">
            <div class="card">
               <div class="card-body">
                   <div class="empty-state">
                     <img class="img-fluid"
                        src="{{assetku('assets/img/drawkit/drawkit-full-stack-man-colour.svg')}}"
                        alt="image">
                     <h2 class="mt-0 mb-2">Isi Lengkap Data Pejabat / Perangkat Daerah</h2>
                     @if (count($errors) > 0)
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-body">
                           <ul>
                              @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                           </ul>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@push('scripts')
<script src="{{ assetku('assets/jshideyorix/general.js')}}"></script>
<!--begin::Page Scripts(used by this page)-->
<script type="text/javascript">
   @if(session('pesan_status'))
   tampilPesan('{{session('pesan_status.tipe')}}', '{{session('pesan_status.desc')}}', '{{session('pesan_status.judul')}}');
   @endif
</script>
@endpush
