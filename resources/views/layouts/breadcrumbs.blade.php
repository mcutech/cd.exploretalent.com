<ul class="breadcrumb breadcrumb-page">
	<div class="breadcrumb-label text-light-gray">You are here: </div>
	<li><a href="{{ HTML::href('projects') }}">Home</a></li>
	@foreach($breadcrumbs as $label => $breadcrumb)
		<li class="{{ $label == $active? 'active': '' }}">
			<a
				{{ $breadcrumb? ('href="' . HTML::href($breadcrumb) . '"'): '' }}
			>
				{{ $label }}
			</a>
		</li>
	@endforeach
</ul>
