<html>
    <head>
        <title>Laravel Commerce - @yield('title')</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        @section('sidebar')
            <nav class="navbar navbar-default">
            		<div class="container-fluid">
            			<div class="navbar-header">
            				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            					<span class="sr-only">Toggle Navigation</span>
            					<span class="icon-bar"></span>
            					<span class="icon-bar"></span>
            					<span class="icon-bar"></span>
            				</button>
            				<a class="navbar-brand" href="#">Laravel</a>
            			</div>

            			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            				<ul class="nav navbar-nav">
            					<li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('categories') }}">Categories</a></li>
            				</ul>

            				<ul class="nav navbar-nav navbar-right">
            					@if (Auth::guest())
            						<li><a href="{{ url('/auth/login') }}">Login</a></li>
            						<li><a href="{{ url('/auth/register') }}">Register</a></li>
            					@else
            						<li class="dropdown">
            							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
            							<ul class="dropdown-menu" role="menu">
            								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            							</ul>
            						</li>
            					@endif
            				</ul>
            			</div>
            		</div>
            	</nav>
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>