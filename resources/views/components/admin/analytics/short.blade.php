<div class="text-left border border-blue-200 rounded-lg mx-1 my-2 p-2">
	<div class="text-center text-lg bg-blue-200">
		{{$name}}
		<span class="bg-blue-400 rounded-full px-1 text-white">
			{{$models->count()}}
		</span>
	</div>
	<div class="my-2">
		<div class="flex flex-wrap text-center mx-auto">
			@for($key = 0; $key < 9; $key++)
			<div class="p-1 h-32">
				<div>
					{{$models->whereBetween('created_at', [now()->subweek($key+1), now()->subweek($key)])->count()}}
					<div class="nm-inset-gray-200 h-20 w-4 mx-auto flex items-end rounded-tr-full rounded-tl-full">
						<div class="w-4 bg-blue-400 rounded-tr-full rounded-tl-full p-1 box-border inline-block" style="height: {{$models->whereBetween('created_at', [now()->subweek(9),now()])->count() == 0? '0':
							$models->whereBetween('created_at', [
								now()->subweek($key+1),
								now()->subweek($key),
							])->count()/$models->whereBetween('created_at', [
								now()->subweek(9),
								now(),
							])->count()*100}}%"></div>
					</div>
				</div>
				<div class="text-xs">{{now()->subweek($key+1)->format('m/d')}}-</div>
				<div class="text-xs">{{now()->subweek($key)->format('m/d')}}</div>
			</div>
			@endfor
		</div>
	</div>
</div>