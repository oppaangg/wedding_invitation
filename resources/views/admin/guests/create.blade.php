@extends('layouts.admin')

@section('content')
<div class="topbar">
    <div class="topbar-title">Tambah Tamu Baru</div>
</div>

<div class="content">
    <div class="card" style="max-width:560px;">
        <div class="card-header">
            <div class="card-title">Data Tamu</div>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('admin.guests.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="cth: Ahmad Fauzi" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP / WhatsApp</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori *</label>
                        <select name="category" class="form-control" required>
                            <option value="family" {{ old('category')=='family'?'selected':'' }}>Keluarga</option>
                            <option value="friend"  {{ old('category','friend')=='friend'?'selected':'' }}>Teman</option>
                            <option value="colleague" {{ old('category')=='colleague'?'selected':'' }}>Rekan Kerja</option>
                            <option value="other" {{ old('category')=='other'?'selected':'' }}>Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Tamu</button>
                    <a href="{{ route('admin.guests.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
