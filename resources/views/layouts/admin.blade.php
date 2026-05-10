<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Undangan Nauval & Zaneta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #c9a96e;
            --gold-light: #e8d5a3;
            --deep: #1a1209;
            --cream: #faf6ef;
            --sidebar: #0f0b06;
            --card: #ffffff;
            --border: #e8e0d5;
            --text: #2d1e0e;
            --muted: #8a7060;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Jost',sans-serif; background:#f5f0e8; color:var(--text); display:flex; min-height:100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: var(--sidebar);
            min-height: 100vh;
            padding: 0;
            position: sticky;
            top: 0;
            flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(201,169,110,0.15);
        }
        .sidebar-brand .brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-style: italic;
            color: var(--gold);
        }
        .sidebar-brand .brand-sub {
            font-size: 10px;
            letter-spacing: 3px;
            color: rgba(250,246,239,0.3);
            text-transform: uppercase;
            margin-top: 2px;
        }
        .sidebar-nav { padding: 20px 0; }
        .nav-section {
            font-size: 9px;
            letter-spacing: 4px;
            color: rgba(250,246,239,0.25);
            text-transform: uppercase;
            padding: 14px 24px 6px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: rgba(250,246,239,0.55);
            text-decoration: none;
            font-size: 13px;
            font-weight: 400;
            transition: all 0.2s;
            border-left: 2px solid transparent;
        }
        .nav-item:hover, .nav-item.active {
            color: var(--gold);
            border-left-color: var(--gold);
            background: rgba(201,169,110,0.06);
        }

        /* MAIN */
        .main { flex: 1; min-width: 0; }
        .topbar {
            background: white;
            padding: 16px 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar-title { font-size: 16px; font-weight: 500; color: var(--text); }
        .topbar-actions { display: flex; gap: 10px; }

        .content { padding: 32px; }

        /* CARDS */
        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
        }
        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-title { font-size: 14px; font-weight: 500; }
        .card-body { padding: 24px; }

        /* STAT CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 3px; height: 100%;
            background: var(--gold);
        }
        .stat-value {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px;
            font-weight: 400;
            color: var(--gold);
            line-height: 1;
        }
        .stat-label {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 1px;
            margin-top: 6px;
            text-transform: uppercase;
        }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { border-bottom: 2px solid var(--border); }
        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 500;
            white-space: nowrap;
        }
        td {
            padding: 14px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        tr:hover td { background: #fdf9f4; }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 2px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .badge-success { background: #f0faf4; color: #2d7a4f; border: 1px solid #b6e8cc; }
        .badge-warning { background: #fffbf0; color: #a07020; border: 1px solid #f0d98a; }
        .badge-muted   { background: #f5f0e8; color: var(--muted); border: 1px solid var(--border); }
        .badge-family   { background: #f5f0ff; color: #6a3db0; border: 1px solid #d5c0f0; }
        .badge-colleague{ background: #f0f5ff; color: #2d5ab0; border: 1px solid #c0d0f0; }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            border-radius: 3px;
            font-family: 'Jost', sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
            letter-spacing: 0.5px;
        }
        .btn-primary {
            background: var(--deep);
            color: var(--gold);
            border: 1px solid var(--deep);
        }
        .btn-primary:hover { background: #2d1e0e; }
        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { border-color: var(--gold); color: var(--gold); }
        .btn-danger {
            background: transparent;
            color: #cc4444;
            border: 1px solid #e0b0b0;
            font-size: 11px;
            padding: 6px 12px;
        }
        .btn-danger:hover { background: #fff0f0; }
        .btn-sm { padding: 5px 12px; font-size: 11px; }

        /* FORMS */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--border);
            border-radius: 3px;
            font-family: 'Jost', sans-serif;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s;
        }
        .form-control:focus { border-color: var(--gold); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        /* LINK COPY */
        .link-cell {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--muted);
            max-width: 260px;
        }
        .copy-btn {
            flex-shrink: 0;
            background: none;
            border: 1px solid var(--border);
            border-radius: 2px;
            padding: 3px 8px;
            font-size: 10px;
            cursor: pointer;
            color: var(--muted);
            transition: all 0.2s;
        }
        .copy-btn:hover { border-color: var(--gold); color: var(--gold); }

        /* ALERTS */
        .alert {
            padding: 14px 18px;
            border-radius: 3px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #f0faf4; color: #2d7a4f; border-left: 3px solid #2d7a4f; }
        .alert-error   { background: #fff0f0; color: #cc4444; border-left: 3px solid #cc4444; }

        .link-url { font-size:11px; color:var(--muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; flex:1; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-name">Nauval & Zaneta</div>
        <div class="brand-sub">Admin Panel</div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Menu</div>
        <a href="{{ route('admin.guests.index') }}" class="nav-item {{ request()->routeIs('admin.guests.index') ? 'active' : '' }}">
            <span>👥</span> Daftar Tamu
        </a>
        <a href="{{ route('admin.guests.create') }}" class="nav-item {{ request()->routeIs('admin.guests.create') ? 'active' : '' }}">
            <span>➕</span> Tambah Tamu
        </a>
        <a href="{{ route('invitation.general') }}" class="nav-item" target="_blank">
            <span>👁️</span> Lihat Undangan
        </a>
    </nav>
</aside>

<div class="main">
    @yield('content')
</div>

<script>
function copyLink(text) {
    navigator.clipboard.writeText(text).then(() => {
        const btns = document.querySelectorAll('.copy-btn');
        btns.forEach(b => { if(b.dataset.url === text) { b.textContent='✓'; setTimeout(()=>b.textContent='Salin',1500); } });
    });
}
</script>
@stack('scripts')
</body>
</html>
