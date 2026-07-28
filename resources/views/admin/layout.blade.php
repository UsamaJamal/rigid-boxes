<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') · Rigid Boxes Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Open+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        :root{--primary:#8d4445;--primary-dark:#633032;--sidebar:#251d21;--sidebar-soft:#34272d;--accent:#c16a6b;--soft:#f8eeec;--bg:#f5f5f7;--card:#fff;--text:#252329;--muted:#77737c;--line:#ebe8ec;--shadow:0 8px 30px rgba(42,25,31,.06)}
        *{box-sizing:border-box}
        body{margin:0;background:var(--bg);color:var(--text);font:14px 'DM Sans',sans-serif}
        .shell{display:grid;grid-template-columns:260px minmax(0,1fr);min-height:100vh}
        .side{position:sticky;top:0;height:100vh;padding:0 16px 22px;background:linear-gradient(180deg,var(--sidebar),#1e171a);color:#fff;box-shadow:8px 0 30px rgba(20,12,15,.1);z-index:20}
        .brand{height:88px;display:flex;align-items:center;gap:12px;padding:0 8px;border-bottom:1px solid rgba(255,255,255,.09)}
        .brand img{width:50px;height:50px;object-fit:contain}
        .brand strong{font:700 16px/1.2 'Open Sans'; display:block;}
        .brand small{display:block;margin-top:2px;color:#baaeb4;font-size:10px;font-weight:500;letter-spacing:.08em;text-transform:uppercase}
        .nav-label{padding:22px 14px 8px;color:#82747b;font-size:10px;font-weight:800;letter-spacing:.15em;text-transform:uppercase}
        .nav{display:grid;gap:5px}
        .nav a{position:relative;display:flex;align-items:center;gap:13px;min-height:44px;padding:0 14px;border-radius:10px;color:#cfc4c9;text-decoration:none;font-weight:600;transition:.2s}
        .nav a i{width:20px;text-align:center;font-size:15px;color:#9c8d94}
        .nav a:hover{background:rgba(255,255,255,.06);color:#fff}
        .nav a:hover i{color:#fff}
        .nav a.active{background:linear-gradient(90deg,var(--primary),#713638);color:#fff;box-shadow:0 8px 20px rgba(141,68,69,.28)}
        .nav a.active i{color:#fff}
        .nav a.active:before{content:"";position:absolute;left:-16px;top:9px;width:4px;height:26px;border-radius:0 5px 5px 0;background:#e7a2a3}
        .side-bottom{position:absolute;left:16px;right:16px;bottom:22px}
        .main{min-width:0}
        .top{height:78px;display:flex;align-items:center;justify-content:space-between;padding:0 34px;background:#fff;border-bottom:1px solid var(--line);position:sticky;top:0;z-index:10}
        .top-left{display:flex;align-items:center;gap:14px}
        .top h1{font:700 20px 'Open Sans';margin:0}
        .crumb{font-size:12px;color:var(--muted);margin-top:3px}
        .user{display:flex;align-items:center;gap:11px}
        .user-copy{text-align:right}
        .user-copy strong{display:block;font-size:13px}
        .user-copy span{font-size:11px;color:var(--muted)}
        .avatar{width:40px;height:40px;border-radius:12px;display:grid;place-items:center;background:var(--soft);color:var(--primary);font-weight:800;border:1px solid #f0dddd}
        .content{padding:28px 32px 50px;max-width:1600px;margin:0 auto;width:100%}
        .grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:18px}
        .card{background:var(--card);border:1px solid var(--line);border-radius:15px;padding:22px;box-shadow:var(--shadow)}
        .stat{display:flex;justify-content:space-between;align-items:center;min-height:118px}
        .stat b{display:block;font:800 30px 'Open Sans';color:var(--text)}
        .stat span{color:var(--muted);font-weight:500}
        .icon{width:50px;height:50px;border-radius:13px;background:var(--soft);display:grid;place-items:center;color:var(--primary);font-size:19px}
        .panel{margin-top:22px;background:#fff;border:1px solid var(--line);border-radius:15px;overflow:hidden;box-shadow:var(--shadow)}
        .panel-head{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid var(--line)}
        .panel-head h2{font:700 17px 'Open Sans';margin:0}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:0;border-radius:9px;padding:10px 15px;background:var(--primary);color:#fff;text-decoration:none;font-weight:700;cursor:pointer;box-shadow:0 5px 14px rgba(141,68,69,.18)}
        .btn:hover{background:var(--primary-dark)}
        .btn.light{background:var(--soft);color:var(--primary);box-shadow:none}
        .btn.danger{background:#fff0f0;color:#a52b2b;box-shadow:none}
        .table-wrap{overflow:auto}
        table{width:100%;border-collapse:collapse}
        th,td{padding:14px 20px;border-bottom:1px solid var(--line);text-align:left;white-space:nowrap}
        th{font-size:11px;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);background:#fbfafb}
        .status{display:inline-flex;align-items:center;gap:6px;padding:5px 9px;border-radius:99px;background:#eaf8ef;color:#287a45;font-size:11px;font-weight:700}
        .status:before{content:"";width:6px;height:6px;border-radius:50%;background:currentColor}
        .empty{text-align:center;padding:56px;color:var(--muted)}
        .alert{padding:12px 16px;border-radius:9px;background:#e9f8ef;color:#267643;margin-bottom:18px}
        .form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
        .field{display:grid;gap:7px}
        .field.full{grid-column:1/-1}
        .field label{font-weight:700}
        .field small{color:var(--muted)}
        input,select,textarea{width:100%;border:1px solid #ddd8df;border-radius:9px;padding:12px 13px;background:#fff;font:inherit;outline:none}
        input:focus,select:focus,textarea:focus{border-color:var(--primary);box-shadow:0 0 0 3px #8d44451a}
        textarea{min-height:120px;resize:vertical}
        .section{padding:22px;border-bottom:1px solid var(--line)}
        .section h3{margin:0 0 17px;font:700 15px 'Open Sans';color:var(--primary)}
        .checks{display:flex;flex-wrap:wrap;gap:16px}
        .check{display:flex;align-items:center;gap:7px}
        .check input{width:auto}
        .actions{display:flex;justify-content:flex-end;gap:10px;padding:20px 22px}
        .help{margin-top:22px;padding:18px;border-radius:12px;background:var(--soft);color:#633839}
        .module-link{transition:transform .2s,box-shadow .2s}
        .module-link:hover{transform:translateY(-3px);box-shadow:0 14px 34px rgba(42,25,31,.1)}

        @media(max-width:1100px){
            .grid{grid-template-columns:repeat(2,1fr);}
        }

        @media(max-width:768px){
            .shell{grid-template-columns:72px minmax(0,1fr);}
            .side{padding-inline:8px;}
            .brand{padding:0;justify-content:center;}
            .brand img{width:44px;}
            .brand div,.nav-label,.nav a span,.side-bottom span{display:none;}
            .nav a{justify-content:center;padding:0;}
            .nav a i{font-size:18px;}
            .grid{grid-template-columns:1fr;}
            .top{padding:0 16px;}
            .content{padding:20px 14px;}
        }
    </style>
    <script>
        window.tinyMceUploadConfig = {
            automatic_uploads: true,
            paste_data_images: true,
            file_picker_types: 'image media',
            images_upload_handler: function (blobInfo) {
                const data = new FormData();
                data.append('file', blobInfo.blob(), blobInfo.filename());

                return window.uploadTinyMceFile(data);
            },
            file_picker_callback: function (callback, value, meta) {
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = meta.filetype === 'media'
                    ? 'video/mp4,video/webm,video/ogg'
                    : 'image/jpeg,image/png,image/gif,image/webp';

                input.addEventListener('change', async function () {
                    const file = input.files && input.files[0];
                    if (!file) return;

                    const data = new FormData();
                    data.append('file', file, file.name);

                    try {
                        const location = await window.uploadTinyMceFile(data);
                        callback(location, { title: file.name });
                    } catch (error) {
                        window.alert(error.message || 'Upload failed.');
                    }
                });

                input.click();
            }
        };

        window.uploadTinyMceFile = async function (data) {
            const response = await fetch(@json(route('admin.tinymce.upload')), {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: data
            });
            const result = await response.json().catch(function () { return {}; });

            if (!response.ok || !result.location) {
                const validationMessage = result.errors && result.errors.file
                    ? result.errors.file[0]
                    : result.message;
                throw new Error(validationMessage || 'Upload failed.');
            }

            return result.location;
        };
    </script>
</head>
<body>
<div class="shell">
    <aside class="side">
        <div class="brand">
            <img src="{{ asset('images/The Rigid Boxes Logo 1.png') }}" alt="Rigid Boxes">
            <div>
                <strong>Rigid Boxes</strong>
                <small>Administration</small>
            </div>
        </div>
        <div class="nav-label">Workspace</div>
        <nav class="nav">
            <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
            <a class="{{ request()->routeIs('admin.homepage.edit') ? 'active' : '' }}" href="{{ route('admin.homepage.edit') }}">
                <i class="fa-solid fa-house"></i>
                <span>Home Page Settings</span>
            </a>
            <a class="{{ request()->routeIs('admin.footer.edit') ? 'active' : '' }}" href="{{ route('admin.footer.edit') }}">
                <i class="fa-solid fa-gear"></i>
                <span>Footer & Company</span>
            </a>
            <a class="{{ request()->routeIs('admin.faqpage.edit') ? 'active' : '' }}" href="{{ route('admin.faqpage.edit') }}">
                <i class="fa-solid fa-circle-question"></i>
                <span>FAQ Page</span>
            </a>
            <a class="{{ request()->route('module') === 'products' ? 'active' : '' }}" href="{{ route('admin.module.index', 'products') }}">
                <i class="fa-solid fa-box-open"></i>
                <span>Products</span>
            </a>
            <a class="{{ request()->route('module') === 'categories' ? 'active' : '' }}" href="{{ route('admin.module.index', 'categories') }}">
                <i class="fa-solid fa-layer-group"></i>
                <span>Categories</span>
            </a>
            <a class="{{ request()->route('module') === 'blogs' ? 'active' : '' }}" href="{{ route('admin.module.index', 'blogs') }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Blog Posts</span>
            </a>
            <a class="{{ request()->route('module') === 'authors' ? 'active' : '' }}" href="{{ route('admin.module.index', 'authors') }}">
                <i class="fa-solid fa-users"></i>
                <span>Authors</span>
            </a>
            <a class="{{ request()->route('module') === 'pages' ? 'active' : '' }}" href="{{ route('admin.module.index', 'pages') }}">
                <i class="fa-regular fa-file-lines"></i>
                <span>Static Pages</span>
            </a>
        </nav>
        <div class="side-bottom">
            <nav class="nav">
                <a href="/" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>View Website</span>
                </a>
            </nav>
        </div>
    </aside>
    <main class="main">
        <header class="top">
            <div class="top-left">
                <div>
                    <h1>@yield('heading', 'Dashboard')</h1>
                    <div class="crumb">Rigid Boxes <i class="fa-solid fa-chevron-right" style="font-size:8px;margin:0 6px"></i> Admin</div>
                </div>
            </div>
            <div class="user">
                <div class="user-copy">
                    <strong>{{ session('admin_name', 'Administrator') }}</strong>
                    <span>{{ session('admin_email', 'admin@rigidboxes.com') }}</span>
                </div>
                <span class="avatar">RB</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="margin-left:8px;">
                    @csrf
                    <button type="submit" class="btn light" style="padding:7px 12px;font-size:12px;cursor:pointer;" title="Logout from Admin">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </header>
        <div class="content">
            @if(session('success'))
                <div class="alert">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif 
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
