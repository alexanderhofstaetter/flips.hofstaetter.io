<ul class="nav-main">
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">
            <i class="nav-main-link-icon si si-home"></i>
            <span class="nav-main-link-name">Dashboard</span>
        </a>
    </li>
    <li class="nav-main-heading">
        <i class="nav-main-link-icon si si-graduation"></i> WU Wien
    </li>
        <li class="nav-main-item open">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="">
                <i class="nav-main-link-icon si si-folder"></i>
                <span class="nav-main-link-name">Learn@WU</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('uni.general') }}">
                        <span class="nav-main-link-name">Allgemein</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('uni.classes') }}">
                        <span class="nav-main-link-name">LVs</span>
                        @if (Auth::user()->lvs()->count())
                            <span class="nav-main-link-badge badge badge-pill badge-success">{{ Auth::user()->lvs()->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('uni.grades') }}">
                        <span class="nav-main-link-name">Noten</span>
                        @if (Auth::user()->grades()->count())
                            <span class="nav-main-link-badge badge badge-pill badge-success">{{ Auth::user()->grades()->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('uni.exams') }}">
                        <span class="nav-main-link-name">Prüfungen</span>
                        @if (Auth::user()->exams()->count())
                            <span class="nav-main-link-badge badge badge-pill badge-success">{{ Auth::user()->exams()->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('uni.news') }}">
                        <span class="nav-main-link-name">Ankündigungen</span>
                        @if (App\News::count())
                            <span class="nav-main-link-badge badge badge-pill badge-success">{{ App\News::count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('uni.registration') }}">
                        <span class="nav-main-link-name">LV/PI Anmeldungen</span>
                    </a>
                </li>                
            </ul>
        </li>

</ul>