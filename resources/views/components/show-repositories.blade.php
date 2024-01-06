@props(['response'])
<div>
	<h4 style="text-align: center">Public Repositories of Tushar259</h4>
	@if(count($response) == 0)
		No data found!<br>
		Check your internet connection. 
	@else
	    @foreach($response as $rep)
	        <p>Repository name: <strong>{{ $rep->name }}</strong></p>
	        <p>Url: {{ $rep->html_url }}</p>
	        <p>Size: {{ $rep->size }}</p>
	        <p>Language: {{ $rep->language }}</p>
	        <div style="padding-bottom: 10px;"></div>
	    @endforeach
    @endif
</div>