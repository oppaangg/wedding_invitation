@extends('layouts.admin')

@section('content')
<div class="topbar">
    <div class="topbar-title">Manajemen Tamu Undangan</div>
    <div class="topbar-actions">
        <button id="btn-blast-wa" class="btn btn-success" style="background:#25D366;color:#fff;border:none;display:inline-flex;align-items:center;gap:6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.136.565 4.14 1.548 5.871L.057 23.882l6.188-1.462A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.895 9.895 0 01-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374A9.86 9.86 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106c5.421 0 9.894 4.474 9.894 9.894 0 5.421-4.473 9.894-9.894 9.894z"/>
            </svg>
            Blast WA
        </button>
        <a href="{{ route('admin.guests.create') }}" class="btn btn-primary">+ Tambah Tamu</a>
    </div>
</div>

<div class="content">

    @if(session('success'))
    <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">Total Tamu</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $stats['opened'] }}</div>
            <div class="stat-label">Sudah Buka</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $stats['confirmed'] }}</div>
            <div class="stat-label">Konfirmasi Hadir</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $stats['total_pax'] }}</div>
            <div class="stat-label">Total Pax</div>
        </div>
    </div>

    <!-- BULK IMPORT -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <div class="card-title">Import Massal</div>
            <button onclick="document.getElementById('bulk-form').classList.toggle('hidden')" class="btn btn-outline btn-sm">Toggle</button>
        </div>
        <div class="card-body hidden" id="bulk-form">
            <form action="{{ route('admin.guests.bulk') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Tamu (satu per baris)</label>
                    <textarea name="names" class="form-control" rows="6" placeholder="Ahmad Fauzi&#10;Siti Rahayu&#10;Hendra Wijaya"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Default</label>
                    <select name="category" class="form-control">
                        <option value="friend">Teman</option>
                        <option value="family">Keluarga</option>
                        <option value="colleague">Rekan Kerja</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Import Semua</button>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Daftar Tamu (<span id="showing-count">{{ $stats['total'] }}</span>)</div>
            <div style="display:flex;gap:8px;align-items:center;">
                <input type="text" id="search" class="form-control" style="max-width:220px;padding:8px 12px;" placeholder="Cari nama...">
                <select id="per-page" class="form-control" style="width:auto;padding:8px 12px;">
                    <option value="10">10 / hal</option>
                    <option value="25" selected>25 / hal</option>
                    <option value="50">50 / hal</option>
                    <option value="100">100 / hal</option>
                </select>
            </div>
        </div>
        <div class="table-wrap">
            <table id="guest-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th class="sortable" data-col="1" data-type="text" style="cursor:pointer;">
                            Nama <span class="sort-icon">↕</span>
                        </th>
                        <th class="sortable" data-col="2" data-type="text" style="cursor:pointer;">
                            Kategori <span class="sort-icon">↕</span>
                        </th>
                        <th>Link Undangan</th>
                        <th class="sortable" data-col="4" data-type="text" style="cursor:pointer;">
                            Status <span class="sort-icon">↕</span>
                        </th>
                        <th>Pesan</th>
                        <th class="sortable" data-col="6" data-type="date" style="cursor:pointer;">
                            Dibuka <span class="sort-icon">↕</span>
                        </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($guests as $i => $guest)
                <tr>
                    <td style="color:#aaa;font-size:12px;">{{ $i+1 }}</td>
                    <td>
                        <div style="font-weight:500;">{{ $guest->name }}</div>
                        @if($guest->phone)
                        <div style="font-size:11px;color:#aaa;">{{ $guest->phone }}</div>
                        @endif
                    </td>
                    <td>
                        @php
                            $catMap   = ['family'=>'Keluarga','friend'=>'Teman','colleague'=>'Rekan','other'=>'Lainnya'];
                            $catClass = ['family'=>'badge-family','friend'=>'badge-muted','colleague'=>'badge-colleague','other'=>'badge-muted'];
                        @endphp
                        <span class="badge {{ $catClass[$guest->category] }}">{{ $catMap[$guest->category] }}</span>
                    </td>
                    <td>
                        <div class="link-cell">
                            <span class="link-url">{{ url('/undangan/'.$guest->slug) }}</span>
                            <button class="copy-btn" data-url="{{ url('/undangan/'.$guest->slug) }}">Salin</button>
                            <a href="{{ route('invitation.guest', $guest->slug) }}" target="_blank" class="copy-btn">↗</a>
                        </div>
                    </td>
                    <td>
                        @if($guest->is_confirmed)
                            <span class="badge badge-success">✓ Hadir ({{ $guest->guest_count }} pax)</span>
                        @elseif($guest->opened_at)
                            <span class="badge badge-warning">Sudah Buka</span>
                        @else
                            <span class="badge badge-muted">Belum Dibuka</span>
                        @endif
                    </td>
                    <td>
                        @if($guest->message)
                            <button
                                class="btn btn-outline btn-sm btn-show-message"
                                data-name="{{ $guest->name }}"
                                data-message="{{ $guest->message }}"
                                title="Lihat pesan dari {{ $guest->name }}"
                            >💬 Lihat</button>
                        @else
                            <span style="color:#aaa;font-size:12px;">—</span>
                        @endif
                    </td>
                    <td style="font-size:12px;color:#aaa;" data-ts="{{ $guest->opened_at ? $guest->opened_at->timestamp : 0 }}">
                        {{ $guest->opened_at ? $guest->opened_at->format('d M H:i') : '—' }}
                    </td>
                    <td>
                        @php
                            $inviteUrl = url('/undangan/' . $guest->slug);
                            $waMessage = "Assalamu'alaikum Wr. Wb.\n\nKepada Yth.\n*{$guest->name}*\n\nDengan hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami.\n\nSilakan buka link undangan berikut:\n{$inviteUrl}\n\nMerupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir.\n\nWassalamu'alaikum Wr. Wb.";
                            $waUrl = null;
                            if ($guest->phone) {
                                $phone = preg_replace('/\D/', '', $guest->phone);
                                if (str_starts_with($phone, '0')) {
                                    $phone = '62' . substr($phone, 1);
                                } elseif (!str_starts_with($phone, '62')) {
                                    $phone = '62' . $phone;
                                }
                                $waUrl = 'https://wa.me/' . $phone . '?text=' . rawurlencode($waMessage);
                            }
                        @endphp
                        <div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
                            <a href="{{ route('admin.guests.edit', $guest) }}" class="btn btn-outline btn-sm">Edit</a>

                            @if($waUrl)
                                <a href="{{ $waUrl }}" target="_blank" class="btn btn-sm" style="background:#25D366;color:#fff;border:none;display:inline-flex;align-items:center;gap:4px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.136.565 4.14 1.548 5.871L.057 23.882l6.188-1.462A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.895 9.895 0 01-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374A9.86 9.86 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106c5.421 0 9.894 4.474 9.894 9.894 0 5.421-4.473 9.894-9.894 9.894z"/>
                                    </svg>
                                    WA
                                </a>
                            @else
                                <span class="btn btn-sm btn-outline" style="opacity:0.35;cursor:not-allowed;" title="Nomor HP belum diisi">WA</span>
                            @endif

                            <form action="{{ route('admin.guests.destroy', $guest) }}" method="POST" onsubmit="return confirm('Hapus tamu ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="empty-row"><td colspan="8" style="text-align:center;padding:40px;color:#aaa;">Belum ada tamu. Tambahkan tamu pertama!</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION BAR -->
        <div id="pagination-bar" style="display:flex;align-items:center;justify-content:space-between;padding:12px 20px;border-top:1px solid #f0f0f0;flex-wrap:wrap;gap:8px;">
            <div id="pagination-info" style="font-size:13px;color:#aaa;"></div>
            <div style="display:flex;gap:6px;align-items:center;">
                <button id="btn-first" class="btn btn-outline btn-sm" title="Halaman pertama">«</button>
                <button id="btn-prev"  class="btn btn-outline btn-sm">← Sebelumnya</button>
                <span id="page-label" style="font-size:13px;color:#555;padding:0 4px;white-space:nowrap;"></span>
                <button id="btn-next"  class="btn btn-outline btn-sm">Selanjutnya →</button>
                <button id="btn-last"  class="btn btn-outline btn-sm" title="Halaman terakhir">»</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL PESAN --}}
<div id="message-modal-overlay">
    <div id="message-modal-box">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <div>
                <div style="font-size:12px;color:#aaa;margin-bottom:2px;">Pesan dari</div>
                <div id="modal-guest-name" style="font-weight:600;font-size:16px;"></div>
            </div>
            <button id="modal-close-btn" style="background:none;border:none;cursor:pointer;font-size:22px;color:#aaa;line-height:1;padding:4px 8px;">&times;</button>
        </div>
        <div id="modal-guest-message" style="background:#f9f9f9;border-radius:8px;padding:16px;font-size:14px;line-height:1.7;color:#333;min-height:60px;white-space:pre-wrap;"></div>
        <div style="margin-top:16px;text-align:right;">
            <button id="modal-close-btn-2" class="btn btn-outline btn-sm">Tutup</button>
        </div>
    </div>
</div>

{{-- MODAL BLAST WA --}}
<div id="blast-modal-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:12px;padding:28px;width:460px;max-width:92%;box-shadow:0 8px 32px rgba(0,0,0,0.18);">

        {{-- Header --}}
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <div style="display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;background:#25D366;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="#fff">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.136.565 4.14 1.548 5.871L.057 23.882l6.188-1.462A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.895 9.895 0 01-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374A9.86 9.86 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106c5.421 0 9.894 4.474 9.894 9.894 0 5.421-4.473 9.894-9.894 9.894z"/>
                    </svg>
                </div>
                <div style="font-weight:600;font-size:16px;">Blast Undangan WhatsApp</div>
            </div>
            <button id="blast-modal-close" style="background:none;border:none;cursor:pointer;font-size:22px;color:#aaa;line-height:1;padding:4px 8px;">&times;</button>
        </div>

        {{-- Step 1: Konfirmasi --}}
        <div id="blast-step-1">
            <p style="color:#555;font-size:14px;margin:0 0 16px;">
                Sistem akan membuka tab WhatsApp satu per satu untuk setiap tamu yang memiliki nomor HP.
                Klik <strong>Kirim Berikutnya</strong> untuk membuka tab tamu selanjutnya.
            </p>

            <div style="background:#f7f7f7;border-radius:10px;padding:16px;margin-bottom:16px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                    <span style="font-size:13px;color:#666;">Tamu dengan nomor HP</span>
                    <span style="font-weight:600;font-size:15px;color:#25D366;" id="blast-count-with-phone">—</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;color:#666;">Tanpa nomor HP (dilewati)</span>
                    <span style="font-size:13px;color:#aaa;" id="blast-count-no-phone">—</span>
                </div>
            </div>

            <div style="background:#fff8e1;border:1px solid #ffe082;border-radius:8px;padding:12px;font-size:12px;color:#795548;margin-bottom:20px;line-height:1.6;">
                ⚠️ Pastikan browser Anda <strong>mengizinkan popup</strong> dari halaman ini agar semua tab dapat terbuka secara otomatis.
            </div>

            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button id="blast-cancel-btn" class="btn btn-outline">Batal</button>
                <button id="blast-start-btn" class="btn btn-primary" style="background:#25D366;border-color:#25D366;color:#fff;">
                    Mulai Kirim
                </button>
            </div>
        </div>

        {{-- Step 2: Progress --}}
        <div id="blast-step-2" style="display:none;">
            <div style="text-align:center;margin-bottom:24px;">
                <div style="font-size:42px;font-weight:600;color:#25D366;line-height:1;" id="blast-progress-num">0</div>
                <div style="font-size:13px;color:#aaa;margin-top:4px;">
                    dari <span id="blast-total-num" style="color:#555;font-weight:500;">0</span> tamu
                </div>
            </div>

            <div style="background:#eee;border-radius:100px;height:8px;margin-bottom:12px;overflow:hidden;">
                <div id="blast-progress-bar" style="height:100%;background:#25D366;border-radius:100px;width:0%;transition:width 0.4s ease;"></div>
            </div>

            <div style="font-size:13px;color:#555;text-align:center;margin-bottom:24px;min-height:20px;padding:0 8px;" id="blast-current-name">
                Memulai...
            </div>

            <div style="display:flex;gap:10px;justify-content:center;">
                <button id="blast-next-btn" class="btn btn-primary" style="background:#25D366;border-color:#25D366;color:#fff;min-width:160px;display:inline-flex;align-items:center;justify-content:center;gap:6px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.136.565 4.14 1.548 5.871L.057 23.882l6.188-1.462A11.935 11.935 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.894a9.895 9.895 0 01-5.031-1.378l-.361-.214-3.741.981.999-3.648-.235-.374A9.86 9.86 0 012.106 12C2.106 6.58 6.58 2.106 12 2.106c5.421 0 9.894 4.474 9.894 9.894 0 5.421-4.473 9.894-9.894 9.894z"/>
                    </svg>
                    Kirim Berikutnya
                </button>
                <button id="blast-stop-btn" class="btn btn-outline" style="color:#e53935;border-color:#e53935;">Stop</button>
            </div>

            {{-- Daftar yang sudah dikirim --}}
            <div style="margin-top:20px;border-top:1px solid #f0f0f0;padding-top:14px;">
                <div style="font-size:12px;color:#aaa;margin-bottom:8px;">Riwayat pengiriman:</div>
                <div id="blast-sent-list" style="max-height:120px;overflow-y:auto;font-size:12px;"></div>
            </div>
        </div>

        {{-- Step 3: Selesai --}}
        <div id="blast-step-3" style="display:none;text-align:center;">
            <div style="width:64px;height:64px;background:#e8f5e9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <div style="font-weight:600;font-size:17px;margin-bottom:8px;">Selesai!</div>
            <div style="font-size:13px;color:#777;margin-bottom:6px;" id="blast-done-msg"></div>
            <div style="font-size:12px;color:#aaa;margin-bottom:24px;">Pastikan Anda sudah menekan tombol Kirim di setiap tab WhatsApp yang terbuka.</div>
            <button id="blast-done-btn" class="btn btn-primary" style="background:#25D366;border-color:#25D366;color:#fff;">Tutup</button>
        </div>

    </div>
</div>

<style>
.hidden { display: none; }

#message-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}
#message-modal-overlay.active { display: flex; }
#message-modal-box {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    width: 420px;
    max-width: 90%;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
}

/* Sortable header */
th.sortable:hover { background: #fafafa; }
th.sortable .sort-icon { font-size:11px; color:#ccc; margin-left:4px; }
th.sortable.asc .sort-icon::after  { content: '↑'; color:#555; }
th.sortable.desc .sort-icon::after { content: '↓'; color:#555; }
th.sortable.asc  .sort-icon,
th.sortable.desc .sort-icon { font-size:0; }

/* Blast sent list item */
.blast-sent-item {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 0;
    border-bottom: 1px solid #f5f5f5;
    color: #555;
}
.blast-sent-item:last-child { border-bottom: none; }
.blast-sent-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #25D366;
    flex-shrink: 0;
}
</style>

@endsection

@push('scripts')
<script>
const tbody   = document.querySelector('#guest-table tbody');
const allRows = Array.from(tbody.querySelectorAll('tr:not(#empty-row)'));

let filtered    = [...allRows];
let currentPage = 1;
let perPage     = parseInt(document.getElementById('per-page').value);
let sortCol     = null;
let sortDir     = 'asc';

// ── RENDER ───────────────────────────────────────────────────────
function render() {
    const total      = filtered.length;
    const totalPages = Math.max(1, Math.ceil(total / perPage));
    if (currentPage > totalPages) currentPage = totalPages;

    const start = (currentPage - 1) * perPage;
    const end   = Math.min(start + perPage, total);

    allRows.forEach(tr => tr.style.display = 'none');
    filtered.slice(start, end).forEach(tr => tr.style.display = '');

    document.getElementById('showing-count').textContent = total;
    document.getElementById('pagination-info').textContent =
        total === 0 ? 'Tidak ada data' : `Menampilkan ${start + 1}–${end} dari ${total} tamu`;
    document.getElementById('page-label').textContent =
        `Hal ${currentPage} / ${totalPages}`;

    document.getElementById('btn-first').disabled = currentPage <= 1;
    document.getElementById('btn-prev').disabled  = currentPage <= 1;
    document.getElementById('btn-next').disabled  = currentPage >= totalPages;
    document.getElementById('btn-last').disabled  = currentPage >= totalPages;
}

// ── SEARCH ───────────────────────────────────────────────────────
document.getElementById('search').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    filtered = q
        ? allRows.filter(tr => tr.textContent.toLowerCase().includes(q))
        : [...allRows];
    currentPage = 1;
    render();
});

// ── PER PAGE ─────────────────────────────────────────────────────
document.getElementById('per-page').addEventListener('change', function() {
    perPage = parseInt(this.value);
    currentPage = 1;
    render();
});

// ── NAV BUTTONS ──────────────────────────────────────────────────
document.getElementById('btn-first').addEventListener('click', function() { currentPage = 1; render(); });
document.getElementById('btn-prev').addEventListener('click',  function() { if (currentPage > 1) { currentPage--; render(); } });
document.getElementById('btn-next').addEventListener('click',  function() {
    const totalPages = Math.ceil(filtered.length / perPage);
    if (currentPage < totalPages) { currentPage++; render(); }
});
document.getElementById('btn-last').addEventListener('click',  function() {
    currentPage = Math.ceil(filtered.length / perPage);
    render();
});

// ── SORT ─────────────────────────────────────────────────────────
document.querySelectorAll('th.sortable').forEach(function(th) {
    th.addEventListener('click', function() {
        const col  = parseInt(this.dataset.col);
        const type = this.dataset.type;

        if (sortCol === col) {
            sortDir = sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            sortCol = col;
            sortDir = 'asc';
        }

        document.querySelectorAll('th.sortable').forEach(t => t.classList.remove('asc','desc'));
        this.classList.add(sortDir);

        filtered.sort(function(a, b) {
            let aVal, bVal;
            if (type === 'date') {
                aVal = parseInt(a.cells[col].dataset.ts || 0);
                bVal = parseInt(b.cells[col].dataset.ts || 0);
            } else {
                aVal = a.cells[col].textContent.trim().toLowerCase();
                bVal = b.cells[col].textContent.trim().toLowerCase();
            }
            if (aVal < bVal) return sortDir === 'asc' ? -1 : 1;
            if (aVal > bVal) return sortDir === 'asc' ?  1 : -1;
            return 0;
        });

        filtered.forEach(tr => tbody.appendChild(tr));
        currentPage = 1;
        render();
    });
});

// ── COPY LINK ────────────────────────────────────────────────────
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.copy-btn[data-url]');
    if (!btn) return;

    const url      = btn.dataset.url;
    const original = btn.textContent;

    const doFallback = function() {
        const el = document.createElement('textarea');
        el.value = url;
        el.style.position = 'fixed';
        el.style.opacity  = '0';
        document.body.appendChild(el);
        el.focus(); el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        btn.textContent = '✓ Disalin';
        setTimeout(function() { btn.textContent = original; }, 1500);
    };

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(function() {
            btn.textContent = '✓ Disalin';
            setTimeout(function() { btn.textContent = original; }, 1500);
        }).catch(doFallback);
    } else {
        doFallback();
    }
});

// ── MODAL PESAN ──────────────────────────────────────────────────
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-show-message');
    if (btn) {
        document.getElementById('modal-guest-name').textContent    = btn.dataset.name;
        document.getElementById('modal-guest-message').textContent = btn.dataset.message;
        document.getElementById('message-modal-overlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
});

function closeMessageModal() {
    document.getElementById('message-modal-overlay').classList.remove('active');
    document.body.style.overflow = '';
}

document.getElementById('message-modal-overlay').addEventListener('click', function(e) {
    if (e.target === this) closeMessageModal();
});
document.getElementById('modal-close-btn').addEventListener('click', closeMessageModal);
document.getElementById('modal-close-btn-2').addEventListener('click', closeMessageModal);
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeMessageModal(); closeBlastModal(); } });

// ── BLAST WA ──────────────────────────────────────────────────────
(function() {
    // Ambil data tamu dari DOM (semua row, tidak hanya yang sedang ditampilkan)
    function getGuestList() {
        return Array.from(document.querySelectorAll('#guest-table tbody tr:not(#empty-row)')).map(function(tr) {
            const nameEl  = tr.cells[1].querySelector('div:first-child');
            const phoneEl = tr.cells[1].querySelector('div:last-child');
            const copyBtn = tr.querySelector('.copy-btn[data-url]');

            const name  = nameEl  ? nameEl.textContent.trim()  : '';
            const phone = (phoneEl && phoneEl !== nameEl) ? phoneEl.textContent.trim() : '';
            const url   = copyBtn ? copyBtn.dataset.url : '';

            return { name, phone, url };
        }).filter(function(g) { return g.name; });
    }

    function formatPhone(raw) {
        let phone = raw.replace(/\D/g, '');
        if (phone.startsWith('0'))        phone = '62' + phone.slice(1);
        else if (!phone.startsWith('62')) phone = '62' + phone;
        return phone;
    }

    function buildWaUrl(guest) {
        if (!guest.phone || !guest.url) return null;
        const phone = formatPhone(guest.phone);
        if (phone.length < 10) return null;
        const msg = "Assalamu'alaikum Wr. Wb.\n\nKepada Yth.\n*" + guest.name + "*\n\nDengan hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami.\n\nSilakan buka link undangan berikut:\n" + guest.url + "\n\nMerupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir.\n\nWassalamu'alaikum Wr. Wb.";
        return 'https://wa.me/' + phone + '?text=' + encodeURIComponent(msg);
    }

    const overlay = document.getElementById('blast-modal-overlay');
    const step1   = document.getElementById('blast-step-1');
    const step2   = document.getElementById('blast-step-2');
    const step3   = document.getElementById('blast-step-3');

    let withPhone    = [];
    let currentIndex = 0;
    let sentCount    = 0;

    function openBlastModal() {
        const all      = getGuestList();
        withPhone      = all.filter(function(g) { return g.phone && buildWaUrl(g); });
        const noPhone  = all.length - withPhone.length;

        document.getElementById('blast-count-with-phone').textContent = withPhone.length + ' tamu';
        document.getElementById('blast-count-no-phone').textContent   = noPhone + ' tamu';

        // Reset state
        currentIndex = 0;
        sentCount    = 0;
        document.getElementById('blast-sent-list').innerHTML = '';

        step1.style.display = '';
        step2.style.display = 'none';
        step3.style.display = 'none';

        overlay.style.display        = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeBlastModal() {
        overlay.style.display        = 'none';
        document.body.style.overflow = '';
    }

    // Expose closeBlastModal globally for Escape key handler above
    window.closeBlastModal = closeBlastModal;

    function showStep(n) {
        step1.style.display = n === 1 ? '' : 'none';
        step2.style.display = n === 2 ? '' : 'none';
        step3.style.display = n === 3 ? '' : 'none';
    }

    function startBlast() {
        if (withPhone.length === 0) {
            alert('Tidak ada tamu dengan nomor HP yang valid!');
            return;
        }
        document.getElementById('blast-total-num').textContent  = withPhone.length;
        document.getElementById('blast-progress-num').textContent = '0';
        document.getElementById('blast-progress-bar').style.width = '0%';
        document.getElementById('blast-current-name').textContent = 'Klik "Kirim Berikutnya" untuk memulai.';
        showStep(2);
    }

    function updateProgress() {
        const pct = withPhone.length ? Math.round((sentCount / withPhone.length) * 100) : 0;
        document.getElementById('blast-progress-num').textContent  = sentCount;
        document.getElementById('blast-progress-bar').style.width  = pct + '%';
    }

    function addSentItem(name) {
        const list = document.getElementById('blast-sent-list');
        const item = document.createElement('div');
        item.className = 'blast-sent-item';
        item.innerHTML = '<div class="blast-sent-dot"></div><span>' + name + '</span>';
        list.prepend(item);
    }

    function sendNext() {
        if (currentIndex >= withPhone.length) {
            finishBlast();
            return;
        }

        const guest  = withPhone[currentIndex];
        const waUrl  = buildWaUrl(guest);

        if (waUrl) {
            window.open(waUrl, '_blank');
            sentCount++;
            addSentItem(guest.name);
            updateProgress();
        }

        currentIndex++;

        if (currentIndex >= withPhone.length) {
            document.getElementById('blast-current-name').textContent = 'Semua tamu sudah dibuka! Klik Selesai.';
            document.getElementById('blast-next-btn').textContent     = 'Selesai ✓';
            document.getElementById('blast-next-btn').onclick         = finishBlast;
        } else {
            const next = withPhone[currentIndex];
            document.getElementById('blast-current-name').textContent =
                'Tab WA untuk ' + guest.name + ' sudah terbuka. Berikutnya: ' + next.name;
        }
    }

    function finishBlast() {
        document.getElementById('blast-done-msg').textContent =
            sentCount + ' tab WhatsApp berhasil dibuka.';
        showStep(3);
    }

    // ── Event Listeners ──
    document.getElementById('btn-blast-wa').addEventListener('click', openBlastModal);
    document.getElementById('blast-modal-close').addEventListener('click', closeBlastModal);
    document.getElementById('blast-cancel-btn').addEventListener('click', closeBlastModal);
    document.getElementById('blast-start-btn').addEventListener('click', startBlast);
    document.getElementById('blast-next-btn').addEventListener('click', sendNext);
    document.getElementById('blast-stop-btn').addEventListener('click', finishBlast);
    document.getElementById('blast-done-btn').addEventListener('click', closeBlastModal);
    overlay.addEventListener('click', function(e) { if (e.target === overlay) closeBlastModal(); });
})();

// ── INIT ─────────────────────────────────────────────────────────
render();
</script>
@endpush