<div class="text-left border border-blue-200 rounded-lg mx-1 my-2 p-2">
	<div class="text-center text-lg bg-blue-200">{{$name}}</div>
	<div class="my-2">
		@foreach($models->take(100) as $key =>$model)
			<div class="flex m-1 bg-white justify-between">
				<div class="text-left">
					"{{$model->keywords}}"
				</div>
				<div class="text-sm">
					{{$model->types}}
					{{$model->logged_at}}
				</div>
			</div>
		@endforeach
	</div>
</div>