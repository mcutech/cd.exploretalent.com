<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

{{-- <title data-bind="<%= skins.title %>" data-bind-target="title">@yield('title')</title> --}}
<title>Casting Director Interface</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

<!-- build:css /assets/index.css -->
<!-- bower:css -->
<!-- endinject -->
<!-- inject:css -->
<!-- endinject -->
<!-- endbuild -->
<link rel="icon" type="text/css" href="" data-bind="<%= skins.favicon %>" data-bind-target="href">

</head>
<body class=" theme-default cd-custom-template main-menu-animated no-sidebar-layout @yield('master.class') gt-ie8 gt-ie9 not-ie pxajs" data-bind="<%= skins.bodyClass %>" data-bind-target="class">

	@yield('master.body')

<!-- build:js /assets/index.js -->
<!-- bower:js -->
<!-- endinject -->
<!-- inject:js -->
<!-- endinject -->
<!-- endbuild -->

</body>
</html>
