@extends('app')
@section('content')
<div class="row">
   <div class="col-md-6">
      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif
      <form action="{{ route('tempatsampah.update', $row) }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('PUT')
         <div class="form-group">
            <label>ID Device <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="id_tempat_sampah" readonly="readonly" value="{{ old('idtempat_sampah', $row->id_tempat_sampah) }}" />
         </div>
         <div class="form-group">
            <label>Alamat <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="alamat" value="{{ old('alamat', $row->alamat) }}" />
         </div>
         <div class="form-group">
            <label>Kota <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="kota" value="{{ old('kota', $row->kota) }}" />
         </div>
         <div class="form-group">
            <label>Cluster <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="keterangan" value="{{ old('keterangan', $row->keterangan) }}" />
         </div>
         <div class="form-group">
            <label>Latitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="latitude" value="{{ old('latitude', $row->latitude) }}" />
         </div>
         <div class="form-group">
            <label>Longitude <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="longitude" value="{{ old('longitude', $row->longitude) }}" />
         </div>
         <div class="form-group">
            <label>Penanggung Jawab <span class="text-danger">*</span></label>
            <select class="form-control" name="id_user" value="{{ old('id_user', $row->id_user) }}">
            @foreach ($users as $item)
            <option value="{{$item->id_user}}" {{ old('id_user', $row->id_user)== $item->id_user ? 'selected' : null}}>{{$item->nama_user}}</option>
            @endforeach
            </select>           
         </div>
         <div class="form-group">
            <label for="foto_tempatsampah">Upload Foto Tempat Sampah (Harus Landscape)</label>
            <input type="file" class="form-control" name="foto_tempatsampah" value="{{ old('foto_tempatsampah', $row->foto_tempatsampah) }}" accept="image/*" 
            onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"/>
         </div>
         <div class="mt-3"><img src="{{asset($row->foto_tempatsampah)}}" id="output" width="500"></div>
         <div class="form-group">
            <label>Status <span class="text-danger">*</span></label>
            <select class="form-control" name="status">
               @foreach($status as $key => $val)
               @if($key==old('status', $row->status))
               <option value="{{ $key }}" selected>{{ $val }}</option>
               @else
               <option value="{{ $key }}">{{ $val }}</option>
               @endif
               @endforeach
            </select>
         </div>
         <div class="form-group">
            <label>Jenis Limbah <span class="text-danger">*</span></label>
            <select class="form-control" name="jenis_limbah">
               @foreach($jenis_limbah as $key => $val)
               @if($key==old('jenis_limbah', $row->jenis_limbah))
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