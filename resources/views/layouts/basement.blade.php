<!DOCTYPE html-->
<html lang="ja">
	<head>
		@yield('header')
		@stack('js')
	</head>
	<body class="font-body text-base text-sepia-800 bg-ivory-200 bg-gradient-to-t from-ivory-300">
		@yield('header-menu')
		@yield('main')
		@yield('footer')
	</body>
</html>