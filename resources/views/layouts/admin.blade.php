<!DOCTYPE html-->
<html lang="ja">
	<head>
		@yield('header')
		@stack('js')
	</head>
	<body class="font-body font-sepia-800 bg-blue-100">
		@yield('header-menu')
		@yield('main')
		@include('components.admin.footer')
	</body>
</html>