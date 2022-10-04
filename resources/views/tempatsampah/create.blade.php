@extends('app')
@section('content')
<div class="row">
   <div class="col-md-6">
      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif
      <form action="{{ route('tempatsampah.store') }}" method="POST" enctype="multipart/form-data">
         @csrf
         {{-- <div class="form-group">
            <label>ID Device (UUID ONLY) <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="id_tempat_sampah" value="{{ old('id_tempat_sampah') }}" />
         </div> --}}
         <div class="form-group">
            <label>Alamat <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="alamat" value="{{ old('alamat') }}" />
         </div>
         <div class="form-group">
            <label>Kota <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="kota" value="{{ old('kota') }}" />
         </div>
         <div class="form-group">
            <label>Cluster <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="keterangan" value="{{ old('keterangan') }}" />
         </div>
         <div class="form-group">
            <label>Latitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="latitude" value="{{ old('latitude') }}" />
         </div>
         <div class="form-group">
            <label>Longitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="longitude" value="{{ old('longitude') }}" />
         </div>
         <div class="form-group">
            <label>Penanggung Jawab <span class="text-danger">*</span></label>
            <select class="form-control" type="text" name="id_user" value="{{ old('id_user') }}" />
            <option value="" disabled selected>- Pilih -</option>
            @foreach ($users as $item)
            <option value="{{$item->id_user}}" {{old('id_user') == $item->id_user ? 'selected' : null}}>{{$item->nama_user}}</option>
            @endforeach
            </select>
         </div>
         <div class="form-group">
            <label for="foto_tempatsampah">Upload Foto Tempat Sampah (Harus Landscape)<span class="text-danger">*</label>
            <input type="file" class="form-control" value="{{ old('foto_tempatsampah') }}" id="foto_tempatsampah" name="foto_tempatsampah" accept="image/*" 
            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"/>
         </div>
         <div class="form-group"><img src="" id="output" width="500"></div>
         <div class="form-group">
            <label>Status <span class="text-danger">*</span></label>
            <select class="form-control" name="status" />
            <option value="" disabled selected>- Pilih-</option>
            @foreach($status as $key => $val)
            @if($key==old('status'))
            <option value="{{ $key }}" selected>{{ $val }}</option>
            @else
            <option value="{{ $key }}">{{ $val }}</option>
            @endif
            @endforeach
            </select>
         </div>
         <div class="form-group">
            <label>Jenis Limbah <span class="text-danger">*</span></label>
            <select class="form-control" name="jenis_limbah" />
            <option value="" disabled selected>- Pilih -</option>
            @foreach($jenis_limbah as $key => $val)
            @if($key==old('jenis_limbah'))
            <option value="{{ $key }}" selected>{{ $val }}</option>
            @else
            <option value="{{ $key }}">{{ $val }}</option>
            @endif
            @endforeach
            </select>
         </div>
         <div class="form-group">
            <button class="btn btn-primary">Simpan</button>
            <a class="btn btn-danger" href="{{ route('tempatsampah.index') }}">Kembali</a>
         </div>
      </form>
   </div>
</div>
@endsection