<!-- MENU SIDEBAR-->
<div class="logo logos">
    <a href="{{route('stock.index')}}">
        <img src="{{asset('images/beauty-logo.jpg')}}" alt="BeautyNBottles Logo" style="width: 30%; height: 30%;" /> BEAUTY N BOTTLES
    </a>
</div>
<div class="menu-sidebar2__content js-scrollbar1">
    <div class="account2">
        <div class="img-fluid img-120">
            @if(Auth::check())
                @if(Auth::user()->profile_image)
                    <img src="{{asset('BnB/profiles/'.Auth::user()->profile_image)}}" alt="Profile Image" />
                @else
                    <img src="{{asset('images/user.png')}}" alt="Profile Image" />
                @endif
            @else
                <img src="{{asset('images/user.png')}}" alt="Profile Image" />
            @endif
        </div>
        @if(Auth::check())
            <h4 class="name">{{Auth::user()->fullname}}</h4>
        @else
            <h4 class="name">Guest</h4>
        @endif
    </div>
    <!-- if login -->
    @auth
        @role('Admin')
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{route('stock.index')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('category.index')}}">
                        <i class="fas fa-tag"></i>Category
                    </a>
                </li>
                <li>
                    <a href="{{route('sub_category.index')}}">
                        <i class="fas fa-tags"></i>Sub-Category
                    </a>
                </li>
                <li>
                    <a href="{{route('item.index')}}">
                        <i class="fas fa-shopping-basket"></i>Products
                    </a>
                </li>
                <li>
                    <a href="{{route('stock.return')}}">
                        <i class="fas fa-undo"></i>Return to Sender
                    </a>
                </li>
                <li>
                    <a href="{{route('stock.convert')}}">
                        <i class="fa fa-exchange-alt"></i>Convert Stocks
                    </a>
                </li>
                <li>
                    <a href="{{route('stock.low')}}">
                        <i class="fas fa-warning"></i>Low Stocks
                    </a>
                    <span class="inbox-num">{{$lowstocks}}</span>
                </li>
                <li>
                    <a href="{{route('log.index')}}">
                        <i class="fas fa-copy"></i>Logs
                    </a>
                </li>
                <li>
                    <a href="{{route('report.index')}}">
                        <i class="fas fa-file-alt"></i>Reports
                    </a>
                </li>
                <li>
                    <a href="{{route('account.index')}}">
                        <i class="fa fa-user"></i>Accounts
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>
        @elserole('Assistant')
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{route('stock.index')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('category.index')}}">
                        <i class="fas fa-tag"></i>Category
                    </a>
                </li>
                <li>
                    <a href="{{route('sub_category.index')}}">
                        <i class="fas fa-tags"></i>Sub-Category
                    </a>
                </li>
                <li>
                    <a href="{{route('item.index')}}">
                        <i class="fas fa-shopping-basket"></i>Products
                    </a>
                </li>
                <li>
                    <a href="{{route('stock.return')}}">
                        <i class="fas fa-undo"></i>Return to Sender
                    </a>
                </li>
                <li>
                    <a href="{{route('stock.low')}}">
                        <i class="fas fa-warning"></i>Low Stocks
                    </a>
                    <span class="inbox-num">{{$lowstocks}}</span>
                </li>
                <li>
                    <a href="{{route('log.index')}}">
                        <i class="fas fa-copy"></i>Logs
                    </a>
                </li>
                <li>
                    <a href="{{route('report.index')}}">
                        <i class="fas fa-file-alt"></i>Reports
                    </a>
                </li>
                <li>
                    <a href="{{route('account.index')}}">
                        <i class="fa fa-user"></i>Accounts
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>
        @elserole('Employee')
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{route('stock.index')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('account.index')}}">
                        <i class="fa fa-user"></i>Accounts
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>
        @endrole
    <!-- end if login -->
    <!-- if guest -->
    @else
    <nav class="navbar-sidebar2">
        <ul class="list-unstyled navbar__list">
            <li >
                <a href="{{route('login')}}">
                    <i class="fas fa-sign-in-alt"></i>Login
                </a>
            </li>
        </ul>
    </nav>
    @endauth
    <!-- end if guest -->
</div>
<!-- END MENU SIDEBAR-->
