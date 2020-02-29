<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/home/drivers">Водители</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/routes">Направления</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/tours">Туры</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/editcategories">Категории</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/settings">Наcтройки</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/home/notices">Запросы</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Altaycross</a></li>
                <li class="nav-item dropdown">
                <li class="nav-item naw-wrapper">
                    <div class="naw-wrapper_line"></div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name . "(" .(Auth::user()->login) . ")" }}
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
