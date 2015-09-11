<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>@yield('title')</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

<!-- build:css /assets/index.css -->
<!-- bower:css -->
<!-- endinject -->
<!-- inject:css -->
<!-- endinject -->
<!-- endbuild -->

</head>
<body class="theme-default cd-custom-template main-menu-animated @yield('master.class')">
	@yield('master.body')

<!-- build:js /assets/index.js -->
<!-- bower:js -->
<!-- endinject -->
<!-- inject:js -->
<!-- endinject -->
<!-- endbuild -->

</body>
</html>
