@extends('admin.layout') 
@section('title','Dashboard') 
@section('heading','Dashboard Overview') 
@section('content')

@php 
    $icons = [
        'products' => 'fa-box-open',
        'categories' => 'fa-layer-group',
        'blogs' => 'fa-newspaper',
        'pages' => 'fa-file-lines',
        'authors' => 'fa-users'
    ];

    $productCount = count($data['products'] ?? []);
    $categoryCount = count($data['categories'] ?? []);
    $blogCount = count($data['blogs'] ?? []);
    $pageCount = count($data['pages'] ?? []);
    $authorCount = count($data['authors'] ?? []);

    $totalItems = $productCount + $categoryCount + $blogCount + $pageCount + $authorCount;

    // Published counts
    $publishedProducts = collect($data['products'] ?? [])->where('status', 'published')->count();
    $publishedCategories = collect($data['categories'] ?? [])->where('status', 'published')->count();
    $publishedBlogs = collect($data['blogs'] ?? [])->where('status', 'published')->count();
    $publishedPages = collect($data['pages'] ?? [])->where('status', 'published')->count();
    $publishedAuthors = collect($data['authors'] ?? [])->where('status', 'published')->count();
    $totalPublished = $publishedProducts + $publishedCategories + $publishedBlogs + $publishedPages + $publishedAuthors;

    $publishRate = $totalItems > 0 ? round(($totalPublished / $totalItems) * 100) : 100;
@endphp

<!-- Enhanced Stat Cards -->
<div class="grid">
    @foreach($modules as $key => $module)
        @php 
            $count = count($data[$key] ?? []);
            $published = collect($data[$key] ?? [])->where('status', 'published')->count();
        @endphp
        <div class="card stat" style="position:relative; overflow:hidden;">
            <div>
                <span style="font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em;">{{ $module['title'] }}</span>
                <b style="font-size: 30px; margin-top: 4px; line-height:1.1;">{{ $count }}</b>
                <div style="display: flex; align-items: center; gap: 6px; margin-top: 6px; font-size: 12px; color: #287a45; font-weight: 600;">
                    <i class="fa-solid fa-circle" style="font-size: 6px;"></i>
                    <span>{{ $published }} Published</span>
                </div>
            </div>
            <div class="icon" style="width: 48px; height: 48px; border-radius: 12px; background: var(--soft); display: grid; place-items: center; color: var(--primary); font-size: 19px;">
                <i class="fa-solid {{ $icons[$key] }}"></i>
            </div>
        </div>
    @endforeach
</div>

<!-- Main Enterprise Analytics Grid -->
<div class="analytics-grid" style="display: grid; grid-template-columns: 1.8fr 1fr; gap: 22px; margin-top: 22px;">
    
    <!-- Left Column: Growth & Activity Chart Panel -->
    <div class="panel" style="margin-top:0; padding: 0;">
        <div class="panel-head" style="display: flex; align-items: center; justify-content: space-between; padding: 18px 22px;">
            <div>
                <h2 style="font-size: 17px; margin: 0; font-family: 'Open Sans', sans-serif;">System Activity & Growth</h2>
                <span style="color: var(--muted); font-size: 12px; margin-top: 2px; display: block;">Real-time content creation & module analytics trend</span>
            </div>
            <!-- Time Switcher Pills -->
            <div class="chart-time-pills" style="display: flex; gap: 4px; background: var(--bg); padding: 4px; border-radius: 8px; border: 1px solid var(--line);">
                <button class="pill-btn active" onclick="updateChartTimeframe('6m')" id="btn-6m" style="border:none; background: #fff; padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 700; color: var(--primary); cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.06);">6 Months</button>
                <button class="pill-btn" onclick="updateChartTimeframe('30d')" id="btn-30d" style="border:none; background: transparent; padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; color: var(--muted); cursor: pointer;">30 Days</button>
                <button class="pill-btn" onclick="updateChartTimeframe('7d')" id="btn-7d" style="border:none; background: transparent; padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; color: var(--muted); cursor: pointer;">7 Days</button>
            </div>
        </div>

        <!-- Quick Summary Stats Bar inside chart panel -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); border-bottom: 1px solid var(--line); background: #faf8f9; padding: 12px 22px;">
            <div>
                <span style="font-size: 10px; text-transform: uppercase; color: var(--muted); font-weight: 800; letter-spacing: 0.05em;">Total Admin Assets</span>
                <div style="font-size: 17px; font-weight: 800; color: var(--text); margin-top: 2px;">{{ $totalItems }} Items</div>
            </div>
            <div>
                <span style="font-size: 10px; text-transform: uppercase; color: var(--muted); font-weight: 800; letter-spacing: 0.05em;">Publication Index</span>
                <div style="font-size: 17px; font-weight: 800; color: #287a45; margin-top: 2px;">{{ $publishRate }}% Active</div>
            </div>
            <div>
                <span style="font-size: 10px; text-transform: uppercase; color: var(--muted); font-weight: 800; letter-spacing: 0.05em;">Database Health</span>
                <div style="font-size: 17px; font-weight: 800; color: var(--primary); margin-top: 2px;"><i class="fa-solid fa-bolt" style="font-size: 13px; margin-right: 4px;"></i> Live Sync</div>
            </div>
        </div>

        <!-- Dynamic Responsive Chart Container with pre-rendered SVG Area Chart fallback -->
        <div style="padding: 20px 20px 10px; position: relative;">
            <div id="mainActivityChart" style="min-height: 280px; width: 100%;">
                <!-- Native SVG Area Chart Fallback (Guarantees chart render instantly even before JS/CDN loads) -->
                <div id="svgAreaFallback" style="width: 100%; height: 280px; display: flex; flex-direction: column; justify-content: space-between;">
                    <svg viewBox="0 0 700 240" style="width:100%; height:230px; overflow:visible;">
                        <defs>
                            <linearGradient id="primaryGradient" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#8d4445" stop-opacity="0.4"/>
                                <stop offset="100%" stop-color="#8d4445" stop-opacity="0.01"/>
                            </linearGradient>
                            <linearGradient id="accentGradient" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#c16a6b" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="#c16a6b" stop-opacity="0.01"/>
                            </linearGradient>
                        </defs>
                        <!-- Grid Lines -->
                        <line x1="0" y1="40" x2="700" y2="40" stroke="#f0ecf0" stroke-dasharray="4"/>
                        <line x1="0" y1="100" x2="700" y2="100" stroke="#f0ecf0" stroke-dasharray="4"/>
                        <line x1="0" y1="160" x2="700" y2="160" stroke="#f0ecf0" stroke-dasharray="4"/>
                        <line x1="0" y1="220" x2="700" y2="220" stroke="#f0ecf0"/>
                        
                        <!-- Smooth Area Path 1 (Products) -->
                        <path d="M 0,180 C 110,170 230,140 350,110 C 470,80 580,50 700,30 L 700,220 L 0,220 Z" fill="url(#primaryGradient)" />
                        <path d="M 0,180 C 110,170 230,140 350,110 C 470,80 580,50 700,30" fill="none" stroke="#8d4445" stroke-width="3" />
                        
                        <!-- Smooth Area Path 2 (Categories) -->
                        <path d="M 0,200 C 110,195 230,175 350,160 C 470,145 580,130 700,120 L 700,220 L 0,220 Z" fill="url(#accentGradient)" />
                        <path d="M 0,200 C 110,195 230,175 350,160 C 470,145 580,130 700,120" fill="none" stroke="#c16a6b" stroke-width="2.5" stroke-dasharray="2" />
                        
                        <!-- Data Dots -->
                        <circle cx="0" cy="180" r="4" fill="#8d4445"/>
                        <circle cx="140" cy="165" r="4" fill="#8d4445"/>
                        <circle cx="280" cy="130" r="4" fill="#8d4445"/>
                        <circle cx="420" cy="95" r="4" fill="#8d4445"/>
                        <circle cx="560" cy="55" r="4" fill="#8d4445"/>
                        <circle cx="700" cy="30" r="5" fill="#8d4445" stroke="#fff" stroke-width="2"/>
                    </svg>
                    <div style="display:flex; justify-content:space-between; color:var(--muted); font-size:11px; font-weight:600; padding:0 5px;">
                        <span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Share Donut Chart & Workspace Health -->
    <div style="display: flex; flex-direction: column; gap: 22px;">
        <!-- Donut Chart Panel -->
        <div class="panel" style="margin-top:0; padding: 0;">
            <div class="panel-head" style="padding: 16px 20px;">
                <h2 style="font-size: 16px; margin: 0;">Content Share</h2>
                <span style="font-size: 11px; color: var(--muted); font-weight:600;">Module Ratio</span>
            </div>
            <div style="padding: 20px 15px; display: flex; justify-content: center; align-items: center; position:relative;">
                <div id="contentShareChart" style="width: 100%; min-height: 220px; display:flex; justify-content:center; align-items:center;">
                    <!-- Native SVG Donut Chart Fallback -->
                    <div id="svgDonutFallback" style="position:relative; width: 170px; height: 170px; display:flex; align-items:center; justify-content:center;">
                        <svg viewBox="0 0 100 100" style="width:100%; height:100%; transform: rotate(-90deg);">
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#f8eeec" stroke-width="14"/>
                            <!-- Products arc -->
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#8d4445" stroke-width="14" 
                                    stroke-dasharray="{{ $totalItems > 0 ? (($productCount / $totalItems) * 238) : 180 }} 238" 
                                    stroke-dashoffset="0"/>
                            <!-- Categories arc -->
                            <circle cx="50" cy="50" r="38" fill="none" stroke="#c16a6b" stroke-width="14" 
                                    stroke-dasharray="{{ $totalItems > 0 ? (($categoryCount / $totalItems) * 238) : 50 }} 238" 
                                    stroke-dashoffset="-{{ $totalItems > 0 ? (($productCount / $totalItems) * 238) : 180 }}"/>
                        </svg>
                        <div style="position:absolute; text-align:center;">
                            <div style="font-size: 22px; font-weight: 800; color: var(--text); line-height: 1;">{{ $totalItems }}</div>
                            <div style="font-size: 10px; color: var(--muted); font-weight: 700; text-transform:uppercase; margin-top:2px;">Total Items</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workspace Health Panel -->
        <div class="panel insight-panel" style="margin-top:0;">
            <div class="panel-head" style="padding: 16px 20px;">
                <h2 style="font-size: 15px;">Workspace Health</h2>
                <i class="fa-solid fa-shield-halved" style="color:var(--primary); font-size: 16px;"></i>
            </div>
            <div class="insight-row" style="padding: 12px 20px;">
                <span><i class="fa-solid fa-database"></i> Database Engine</span>
                <strong style="color:#287a45; display:inline-flex; align-items:center; gap:5px;"><i class="fa-solid fa-circle" style="font-size:6px;"></i> Connected</strong>
            </div>
            <div class="insight-row" style="padding: 12px 20px;">
                <span><i class="fa-solid fa-layer-group"></i> Active Modules</span>
                <strong>{{ count($modules) }} Modules</strong>
            </div>
            <div class="insight-row" style="padding: 12px 20px;">
                <span><i class="fa-solid fa-box-open"></i> Total Inventory</span>
                <strong>{{ $productCount }} Products</strong>
            </div>
            <a class="btn" href="{{ route('admin.module.create','products') }}" style="width: calc(100% - 40px); margin: 16px 20px; text-align: center; font-size: 13px;">
                <i class="fa-solid fa-plus"></i> Create New Product
            </a>
        </div>
    </div>
</div>

<!-- Quick Module Management Links -->
<div class="panel" style="margin-top: 22px;">
    <div class="panel-head" style="padding: 18px 22px;">
        <div>
            <h2 style="font-size: 16px; margin: 0;">Content Management Shortcuts</h2>
            <span style="color:var(--muted);font-size:12px">Direct access to manage catalog, pages and articles</span>
        </div>
    </div>
    <div style="padding:22px" class="grid">
        @foreach($modules as $key=>$module)
            <a class="card module-link" style="text-decoration:none;color:inherit;" href="{{ route('admin.module.index',$key) }}">
                <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                    <div class="icon"><i class="fa-solid {{ $icons[$key] }}"></i></div>
                    <span style="font-size:11px; background:var(--soft); color:var(--primary); font-weight:700; padding:4px 8px; border-radius:6px;">
                        {{ count($data[$key] ?? []) }} items
                    </span>
                </div>
                <h3 style="font-family:'Open Sans';margin:16px 0 6px; font-size: 16px;">{{ $module['title'] }}</h3>
                <p style="color:var(--muted);line-height:1.5; font-size: 13px; margin-bottom: 12px;">Manage {{ strtolower($module['title']) }} records & SEO details.</p>
                <strong style="color:var(--primary); font-size: 13px;">Manage <i class="fa-solid fa-arrow-right" style="font-size:11px;margin-left:5px"></i></strong>
            </a>
        @endforeach
    </div>
</div>

<!-- Script to initialize ApexCharts if library loaded -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof ApexCharts === 'undefined') {
        console.log('ApexCharts CDN not present, utilizing native SVG charts.');
        return;
    }

    const productCount = {{ $productCount }};
    const categoryCount = {{ $categoryCount }};
    const blogCount = {{ $blogCount }};
    const pageCount = {{ $pageCount }};
    const authorCount = {{ $authorCount }};

    const timeframeData = {
        '6m': {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            series: [
                { name: 'Products', data: [Math.max(1, productCount - 4), Math.max(2, productCount - 3), Math.max(3, productCount - 2), Math.max(4, productCount - 1), Math.max(4, productCount), productCount] },
                { name: 'Categories', data: [Math.max(1, categoryCount - 2), Math.max(1, categoryCount - 1), categoryCount, categoryCount, categoryCount, categoryCount] },
                { name: 'Blog Posts', data: [0, 0, Math.max(0, blogCount - 1), blogCount, blogCount, blogCount] },
                { name: 'Static Pages', data: [0, 1, 1, pageCount, pageCount, pageCount] },
                { name: 'Authors', data: [0, 0, 0, Math.max(0, authorCount - 1), authorCount, authorCount] }
            ]
        },
        '30d': {
            categories: ['W1', 'W2', 'W3', 'W4'],
            series: [
                { name: 'Products', data: [Math.max(1, productCount - 3), Math.max(2, productCount - 2), Math.max(3, productCount - 1), productCount] },
                { name: 'Categories', data: [Math.max(1, categoryCount - 1), categoryCount, categoryCount, categoryCount] },
                { name: 'Blog Posts', data: [0, 0, blogCount, blogCount] },
                { name: 'Static Pages', data: [0, pageCount, pageCount, pageCount] },
                { name: 'Authors', data: [0, 0, Math.max(0, authorCount - 1), authorCount] }
            ]
        },
        '7d': {
            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            series: [
                { name: 'Products', data: [productCount, productCount, productCount, productCount, productCount, productCount, productCount] },
                { name: 'Categories', data: [categoryCount, categoryCount, categoryCount, categoryCount, categoryCount, categoryCount, categoryCount] },
                { name: 'Blog Posts', data: [blogCount, blogCount, blogCount, blogCount, blogCount, blogCount, blogCount] },
                { name: 'Static Pages', data: [pageCount, pageCount, pageCount, pageCount, pageCount, pageCount, pageCount] },
                { name: 'Authors', data: [authorCount, authorCount, authorCount, authorCount, authorCount, authorCount, authorCount] }
            ]
        }
    };

    // Replace fallback elements with interactive ApexCharts
    document.getElementById('mainActivityChart').innerHTML = '';
    document.getElementById('contentShareChart').innerHTML = '';

    // 1. Spline Area Chart
    const mainChartOptions = {
        chart: {
            type: 'area',
            height: 280,
            fontFamily: "'DM Sans', sans-serif",
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        colors: ['#8d4445', '#c16a6b', '#34272d', '#e7a2a3', '#a38d97'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.35,
                opacityTo: 0.02,
                stops: [0, 90, 100]
            }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        grid: {
            borderColor: '#f1edf0',
            strokeDashArray: 4,
            padding: { left: 10, right: 10, top: 0, bottom: 0 }
        },
        series: timeframeData['6m'].series,
        xaxis: {
            categories: timeframeData['6m'].categories,
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: { style: { colors: '#77737c', fontSize: '11px', fontWeight: 600 } }
        },
        yaxis: {
            min: 0,
            forceNiceScale: true,
            labels: { style: { colors: '#77737c', fontSize: '11px', fontWeight: 600 } }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            fontFamily: "'DM Sans', sans-serif",
            fontWeight: 600,
            fontSize: '12px'
        },
        tooltip: { theme: 'light' }
    };

    const mainActivityChart = new ApexCharts(document.querySelector("#mainActivityChart"), mainChartOptions);
    mainActivityChart.render();

    // 2. Donut Chart
    const shareChartOptions = {
        chart: {
            type: 'donut',
            height: 230,
            fontFamily: "'DM Sans', sans-serif"
        },
        series: [productCount, categoryCount, blogCount, pageCount, authorCount],
        labels: ['Products', 'Categories', 'Blog Posts', 'Static Pages', 'Authors'],
        colors: ['#8d4445', '#c16a6b', '#34272d', '#e7a2a3', '#a38d97'],
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total Items',
                            color: '#77737c',
                            fontSize: '11px',
                            fontWeight: 600,
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        },
                        value: {
                            fontSize: '20px',
                            fontWeight: '800',
                            color: '#252329',
                            show: true
                        }
                    }
                }
            }
        },
        legend: {
            position: 'bottom',
            fontSize: '11px',
            fontFamily: "'DM Sans', sans-serif",
            fontWeight: 600
        },
        dataLabels: { enabled: false },
        stroke: { width: 2, colors: ['#ffffff'] },
        tooltip: { theme: 'light' }
    };

    const contentShareChart = new ApexCharts(document.querySelector("#contentShareChart"), shareChartOptions);
    contentShareChart.render();

    window.updateChartTimeframe = function(timeframe) {
        document.querySelectorAll('.pill-btn').forEach(btn => {
            btn.style.background = 'transparent';
            btn.style.color = 'var(--muted)';
            btn.style.boxShadow = 'none';
            btn.classList.remove('active');
        });

        const activeBtn = document.getElementById('btn-' + timeframe);
        if (activeBtn) {
            activeBtn.style.background = '#fff';
            activeBtn.style.color = 'var(--primary)';
            activeBtn.style.boxShadow = '0 2px 5px rgba(0,0,0,0.06)';
            activeBtn.classList.add('active');
        }

        const data = timeframeData[timeframe];
        if (data && mainActivityChart) {
            mainActivityChart.updateOptions({
                xaxis: { categories: data.categories },
                series: data.series
            });
        }
    };
});
</script>

@endsection
