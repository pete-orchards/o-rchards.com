@include('utilities.buttons.a1', [
	'text' => '新規作成',
	'href' => route('admin.idea_theme_result.create,
	'color' => 'bg-yellow-700',
])
@if($idea_theme_result->count() > 0)
	@foreach($idea_theme_result as $item)
	<div>
		<div class="">
			<img src="{{url('/'.$item->banner_path())}}">
			<a href="{{route('admin.idea_theme_result.show', ['idea_theme_result' => $item->id])}}">
				<span class="">{{$item->title}}</span>
			</a>
			日付: {{$item->date}}
			<div>
				本文: {{Str::limit($item->body, 60, '(…)' )}}
			</div>
			<small>投稿日: {{($item->created_at)->format('Y/m/d')}}</small><br/>
			<small>更新日: {{($item->updated_at)->format('Y/m/d')}}</small>
		</div>
	</div>
	@endforeach
@endif

@include('utilities.buttons.a1', [
	'text' => '管理者ページトップ',
	'href' => route('admin.home'),
	'color' => 'bg-yellow-700',
])
