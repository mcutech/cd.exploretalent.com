<div id="top-alert-div" class="alert border-radius-zero margin-zero text-center padding-xs" style="display: none;" data-bind-target="visibility" data-bind="<%= (typeof body === 'undefined') ? '0' : '1' %>">
	<span data-bind="<%= (typeof body === 'undefined') ? '' : body %>" data-bind-target="html"></span>
</div>

