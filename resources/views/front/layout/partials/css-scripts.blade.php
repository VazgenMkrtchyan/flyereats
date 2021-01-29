<!-- font awesome -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- font -->
<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Open+Sans%3A400%2C600%2C300&#038;subset=latin%2Clatin-ext&#038;ver=4.2.2' type='text/css' media='all' />

@if (isPage(['install.step1', 'install.step2']))
    <link rel="stylesheet" href="{{ asset('templates/front/css/default-theme.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('templates/front/css/' . sessionOrWebc('color_scheme', 'color_scheme') . '-theme.css') }}">
@endif

<!-- favicon -->
<link rel="shortcut icon" href="{{ asset('templates/misc/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('templates/misc/favicon.ico') }}" type="image/x-icon">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
