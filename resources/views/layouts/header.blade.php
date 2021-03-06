<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home.index') }}">Teeka Library</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            @unless(auth()->guest())
            <ul class="nav navbar-nav">
                <li class="{{ request()->is('user*') ? 'active' : '' }}"><a href="{{ route('user.index') }}"><i class="fa fa-btn fa-user"></i> Users</a></li>
                <li class="{{ request()->is('note*') ? 'active' : '' }}"><a href="{{ route('note.index') }}"><i class="fa fa-sticky-note"></i> Notes</a></li>
            </ul>
            @endunless
            <ul class="nav navbar-nav navbar-right">
                @if (auth()->guest())
                    <li><a href="{{ url('/login') }}"> Login</a></li>
                    <li><a href="{{ url('/register') }}"> Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                        </ul>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>