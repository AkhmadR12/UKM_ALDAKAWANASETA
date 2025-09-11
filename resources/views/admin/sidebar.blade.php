{{-- @php
    use App\Models\User;
@endphp --}}
<div class="sidebar" data-background-color="green2">
    {{-- <div class="sidebar" data-background-color="light-blue2"> --}}
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue2">
            <a href="{{ url('/dashboard') }}" class="logo">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('logo/alas.png') }}" style="width: 40%;">
             </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="collapsed" aria-expanded="false">
                        {{-- <i class="fas fa-briefcase"></i> --}}
                        <i class="fa-duotone fa-solid fa-house-user"></i>
                        <p>Home front end</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>

                    </a>

                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                {{-- @if ($userType == 1) --}}

                {{-- digunakan  --}}
                {{-- @if (Auth::user()->usertype == User::ADMIN) --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Form">
                        <i class="fas fa-table"></i>
                         <p>Form</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Form">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->is('kategoris') ? 'active' : '' }}">
                                <a href="{{ url('kategoris') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-layer-group"></i>
                                    <p>Kategori Form</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('form_inputs') ? 'active' : '' }}">
                                <a href="{{ url('form_inputs') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-table"></i>
                                    <p>form_input</p></span>
                                </a>
                            </li>
                             
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#bahan">
                        <i class="fas fa-user-tie"></i>
                        <p>User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="bahan">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->is('user') ? 'active' : '' }}">
                                <a href="{{ url('/user') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-user"> </i>User</span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('members') ? 'active' : '' }}">
                                <a href="{{ url('members') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-address-book"></i>
                                    <p>Member</p></span>
                                </a>
                            </li> 
                            <li class="nav-item {{ request()->is('subdep') ? 'active' : '' }}">
                                <a href="{{ url('subdep') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-suitcase"></i>
                                    <p>supdep</p></span>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#konten">
                        <i class="fas fa-store"></i>
                        <p>Konten</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="konten">
                        <ul class="nav nav-collapse">
                            {{-- <li class="nav-item {{ request()->is('magazine') ? 'active' : '' }}">
                                <a href="{{ url('magazine') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-book-open"></i>
                                    <p>Majalah</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('data_majalah') ? 'active' : '' }}">
                                <a href="{{ url('data_majalah') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-book-open"></i>
                                    <p>Data Majalah</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('sosmed') ? 'active' : '' }}">
                                <a href="{{ url('sosmed') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-globe"></i>
                                    <p>Kontributor</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('redakturs') ? 'active' : '' }}">
                                <a href="{{ url('redakturs') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-user-tag"></i>
                                    <p>redakturs</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('tipe') ? 'active' : '' }}">
                                <a href="{{ url('tipe') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-layer-group"></i>
                                    <p>Tipe Portofolio</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('porto') ? 'active' : '' }}">
                                <a href="{{ url('porto') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>Portofolio</p></span>
                                </a>
                            </li> --}}
                            <li class="nav-item {{ request()->is('testimoni') ? 'active' : '' }}">
                                <a href="{{ url('testimoni') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>Testimoni</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('carousel') ? 'active' : '' }}">
                                <a href="{{ url('carousel') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>Carausel</p></span>
                                </a>
                            </li>
                            
                            <li class="nav-item {{ request()->is('video') ? 'active' : '' }}">
                                <a href="{{ url('video') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-newspaper"></i>
                                    <p>video</p></span>
                                </a>
                            </li> 
                            <li class="nav-item {{ request()->is('berita') ? 'active' : '' }}">
                                <a href="{{ url('berita') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>berita</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('popup') ? 'active' : '' }}">
                                <a href="{{ url('popup') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>popup</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('services') ? 'active' : '' }}">
                                <a href="{{ url('service') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>services</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('events') ? 'active' : '' }}">
                                <a href="{{ url('event') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>Events</p></span>
                                </a>
                            </li>
                            {{-- <li class="nav-item {{ request()->is('partner') ? 'active' : '' }}">
                                <a href="{{ url('partner') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-users"></i>
                                    <p>Partner</p></span>
                                </a>
                            </li> --}}
                            
                        </ul>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#toko">
                        <i class="fas fa-store-alt"></i>
                        <p>TOKO</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="toko">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ request()->is('payments') ? 'active' : '' }}">
                                <a href="{{ url('payments') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>payments</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('photos') ? 'active' : '' }}">
                                <a href="{{ url('photo') }}" class="collapsed" aria-expanded="false">
                                    <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>Toko Photo</p></span>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('products') ? 'active' : '' }}">
                                <a href="{{ url('product') }}" class="collapsed" aria-expanded="false">
                                     <span class="sub-item"><i class="fas fa-briefcase"></i>
                                    <p>produk</p></span> 
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                 
                <li class="nav-item {{ request()->is('faq') ? 'active' : '' }}">
                    <a href="{{ url('faq') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-suitcase"></i>
                        <p>Faq</p>
                    </a>
                </li>
                

               
                {{-- <li class="nav-item {{ request()->is('request') ? 'active' : '' }}">
                    <a href="{{ url('request') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-file"></i>
                        <p>permintaan</p>
                    </a>
                </li>
                
                <li class="nav-item {{ request()->is('data') ? 'active' : '' }}">
                    <a href="{{ url('data_majalah/report') }}" class="collapsed" aria-expanded="false">
                        <span class="sub-item"><i class="fas fa-users"></i>
                        <p>data majalah</p></span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dataproduct') ? 'active' : '' }}">
                    <a href="{{ url('produk/report') }}" class="collapsed" aria-expanded="false">
                        <span class="sub-item"><i class="fas fa-users"></i>
                        <p>data Produk</p></span>
                    </a>
                </li> --}}
                <li class="nav-item {{ request()->is('categories_barang') ? 'active' : '' }}">
                    <a href="{{ url('categories_barang') }}" class="collapsed" aria-expanded="false">
                        <span class="sub-item"><i class="fas fa-list"></i>
                        <p>Kategori Barang</p></span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('item') ? 'active' : '' }}">
                    <a href="{{ url('item') }}" class="collapsed" aria-expanded="false">
                        <span class="sub-item"><i class="fas fa-toolbox"></i>
                        <p>Item Barang</p></span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('rentals') ? 'active' : '' }}">
                    <a href="{{ url('rentals') }}" class="collapsed" aria-expanded="false">
                        <span class="sub-item"><i class="fas fa-wrench"></i>
                        <p>Rentals Barang</p></span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('absens') ? 'active' : '' }}">
                    <a href="{{ url('absens') }}" class="collapsed" aria-expanded="false">
                        <span class="sub-item"><i class="fas fa-wrench"></i>
                        <p>Absen</p></span>
                    </a>
                </li>
                

            </ul>
        </div>
    </div>
</div>

{{-- jika ingin menggunakan sidebar pencarian --}}
{{-- <script>
    document.getElementById("search-sidebar").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll(".sidebar-item");

        items.forEach(item => {
            let text = item.textContent.toLowerCase();
            let isVisible = text.includes(filter);
            item.style.display = isVisible ? "" : "none";

            // Jika sub-item cocok, pastikan parent tetap terbuka
            if (isVisible) {
                let parentCollapse = item.closest(".collapse");
                if (parentCollapse) {
                    parentCollapse.classList.add("show");
                }
            }
        });
    });
</script> --}}
