@if(count($data))
<article>
	<a href="{{ $data[0]['link'] }}" title="{{ $data[0]['title'] }}">
		<img src="{{ $data[0]['img'] }}" title="{{ $data[0]['title'] }}" src="{{ $data[0]['title'] }}" class="img-responsive" style="width: 100%;" />
	</a>
</article>
@endif