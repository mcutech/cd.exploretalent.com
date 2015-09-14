<ul class="breadcrumb breadcrumb-page">
	<div class="breadcrumb-label text-light-gray">You are here: </div>
	<li>
		<a href="/">Home</a>
	</li>
	@if (isset($pages))
		@foreach ($pages as $page)
		<li class="{{ isset($page['active']) && $page['active'] ? 'active' : '' }}">
			<a href="{{ $page['url'] }}">{{ $page['name'] }}</a>
		</li>
		@endforeach
	@endif
</ul>
