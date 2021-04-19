<form action="{{$route ?? ''}}" method="post" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
	@include('utilities.buttons.submit', [
		'text' => 投稿する,
		'color' => 'bg-tomato-500',
	])

	<input type="hidden" name="title" value="{{$post->each()->title}}">
	<input type="hidden" name="body" value="{{$post->each()->body}}">
	@foreach ($post->each()->incomes as $key => $income)
	<input type="hidden" name="incomes[{{$key}}][name]" value="{{$income->name}}">
	<input type="hidden" name="incomes[{{$key}}][amount]" value="{{$income->amount}}">
	<input type="hidden" name="incomes[{{$key}}][volume]" value="{{$income->volume}}">
	@endforeach

	@foreach ($post->each()->costs as $key => $cost)
	<input type="hidden" name="costs[{{$key}}][name]" value="{{$cost->name}}">
	<input type="hidden" name="costs[{{$key}}][amount]" value="{{$cost->amount}}">
	<input type="hidden" name="costs[{{$key}}][volume]" value="{{$cost->volume}}">
	@endforeach

	@if($post->each()->imgs)
	@foreach ($post->each()->imgs as $key => $img)
	<input type="hidden" name="imgs[{{$key}}]" value="{{$img->img}}">
	@endforeach
	@endif

	@if($post->tags)
	<input type="hidden" name="tag" value="@foreach($post->tags as $key => $tag)@if(!$loop->first){{','}}@endif{{$tag->name}}@endforeach">
	@endif

	@if(!empty($post->parent->first()))
	<input type="hidden" name="reference" value="{{$post->parent->id}}">
	@endif
</form>