@extends('layouts.admin')

@section('content')
<div class="topbar">
    <div class="topbar-title">Edit Tamu: {{ $guest->name }}</div>
</div>

<div class="content">
    <div class="card" style="max-width:560px;">
        <div class="card-header">
            <div class="card-title">Update Data Tamu</div>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('admin.guests.update', $guest) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group" style="grid-column:1/-1">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $guest->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. HP / WhatsApp</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $guest->phone) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori *</label>
                        <select name="category" class="form-control" required>
                            <option value="family"    {{ $guest->category=='family'?'selected':'' }}>Keluarga</option>
                            <option value="friend"    {{ $guest->category=='friend'?'selected':'' }}>Teman</option>
                            <option value="colleague" {{ $guest->category=='colleague'?'selected':'' }}>Rekan Kerja</option>
                            <option value="other"     {{ $guest->category=='other'?'selected':'' }}>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top:10px; padding:14px; background:#faf6ef; border:1px solid #e8e0d5; border-radius:3px;">
                    <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#8a7060;margin-bottom:6px;">Link Undangan</div>
                    <div style="font-size:13px;color:#4a3728;word-break:break-all;">
                        {{ url('/undangan/'.$guest->slug) }}
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.guests.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
