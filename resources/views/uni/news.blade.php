@extends('layouts.backend')

@section('maincontent')

<!-- Ankündigungen -->
<h1>Ankündigungen</h1>

<form class="mb-4" action="{{ route('user.wulearn.load.news', $user->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-primary">
        <i class="fas fa-sync-alt"></i> Daten aktualisieren
    </button>
</form>

@foreach (App\News::orderBy('date', 'desc')->get() as $news)
<div class="block block-bordered">
	<div class="block-header block-header-default">
		<h3 class="block-title font-w700">{{ $news->title }}<br/>
			<small>{{ $news->lv->key }} {{ $news->lv->name }}</small></h3>
		<small>{{ $news->date->diffForHumans() }}</small>
	</div>
	<div class="block-content">
		{!! $news->content !!}
	</div>
	<div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
		Veröffentlicht in <a class="font-w700" href="{{ route('user.wulearn.open', [$user->id, urlencode(urlencode($news->url))]) }}" target="_blank">Learn@WU</a> 
		am <span class="font-w700">{{ $news->date->format("d.m.Y") }}</span>
		von <span class="font-w700">{{ $news->author }}</span>.
	</div>
</div>
@endforeach
<!-- END Ankündigungen -->

@endsection