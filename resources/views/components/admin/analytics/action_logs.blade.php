<div class="text-left border border-blue-200 rounded-lg mx-1 my-2 p-2">
	<div class="text-center text-lg bg-blue-200">{{$name}}</div>
	<div class="my-2">
		<div class="text-center">概略</div>
		<div class="container mx-auto flex justify-around">
			<div>
				<div>1ヵ月</div>
				<div>{{$models->where('created_at', '>', now()->subMonth())->count()}}</div>
			</div>
			<div>
				<div>7日間</div>
				<div>{{$models->where('created_at', '>', now()->subWeek())->count()}}</div>
			</div>
			<div>
				<div>全期間</div>
				<div>
					{{$models->count()}}
					<span class="text-sm">({{$models->where('created_at', '>', now()->subMonth())->count()}})</span>
				</div>
			</div>
		</div>
	</div>
	<div class="my-2">
		<div class="text-center">推移</div>
		<div class="flex flex-wrap text-center mx-auto">
			@for($key = 0; $key < 9; $key++)
			<div class="p-1">
				<div class="text-xs">{{now()->subweek($key+1)->format('m/d')}} - {{now()->subweek($key)->format('m/d')}}</div>
				<div>{{$models->whereBetween('created_at', [now()->subweek($key+1), now()->subweek($key)])->count()}}</div>
			</div>
			@endfor
		</div>
	</div>
</div>