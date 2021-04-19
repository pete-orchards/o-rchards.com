<!-- Global site tag (gtag.js) - Google Analytics -->
@if(app('env')=='production')
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180969425-1"></script>
@endif
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-180969425-1');
</script>

<meta charset="utf-8">

<title>{{$title}}</title>
<meta name="description" content="{{$description = '日常の中のちょっとしたアイデアを共有し、みんなで育てていく果樹園(=Orchards)。商売感覚を養うSNSです。since2020.10.17'}}">

<meta property="og:site_name" content="Orchards">
<meta property="og:title" content="{{$title}}">
<meta property="og:description" content="{{$description = '日常の中のちょっとしたアイデアを共有し、みんなで育てていく果樹園(=Orchards)。商売感覚を養うSNSです。since2020.10.17'}}">
<meta property="og:image" content="{{asset('/img/orchards-logo.png')}}">
<meta property="og:url" content="{{request()->fullUrl()}}">
<meta property="og:type" content="article">
<meta property="og:locale" content="ja_JP">
<meta name="twitter:site" content="o_rchards">
<meta name="twitter:card" content="summary">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css?family=Baloo+Da+2|M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>
	'use strict';
	const route = "{{url('/').'/'}}";
</script>
@if(app('env')=='local')
<link rel="stylesheet" href="{{ asset('/css/ress.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('/css/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
<script src="{{ asset('/js/jquery-3.5.1.min.js') }}" defar></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}" defar></script>
<script src="{{ asset('/js/jquery-ui.min.js') }}" defar></script>
<script src="{{ asset('/js/tagify.min.js') }}" defar></script>
<script src="{{ asset('/js/jQuery.tagify.min.js') }}" defar></script>
<script src="{{ asset('/js/tagify.polyfills.min.js') }}" defar></script>
<script src="{{ asset('/js/script.js') }}" defar></script>
<link rel="icon" type="image/png" href="{{ asset('/img/favicon.png')}}">
@endif
@if(app('env')=='production')
<link rel="stylesheet" href="{{ secure_asset('/css/ress.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('/css/app.css') }}">
<link rel="stylesheet" href="{{ secure_asset('/css/tagify.css') }}">
<link rel="stylesheet" href="{{ secure_asset('/css/style.css') }}">
<script src="{{ secure_asset('/js/jquery-3.5.1.min.js') }}" defar></script>
<script src="{{ secure_asset('/js/jquery.validate.min.js') }}" defar></script>
<script src="{{ secure_asset('/js/jquery-ui.min.js') }}" defar></script>
<script src="{{ secure_asset('/js/tagify.min.js') }}" defar></script>
<script src="{{ secure_asset('/js/jQuery.tagify.min.js') }}" defar></script>
<script src="{{ secure_asset('/js/tagify.polyfills.min.js') }}" defar></script>
<script src="{{ secure_asset('/js/script.js') }}" defar></script>
<link rel="icon" type="image/png" href="{{ secure_asset('/img/favicon.png')}}">
@endif