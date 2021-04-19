{{--$scaleを渡すことで拡縮可能 'scale-50'(50%)など--}}
<div class="relative flex justify-center items-center m-6 transform {{$scale ?? ''}}">
	{{--'w-12 h-12'にすると丁度ロゴのように棒がOに触れる...が、見た目がかわいいので小さめにしている--}}
	<span class="relative inline-block box-content w-8 h-8 rounded-full bg-tomato-500 border-4 border-sepia-800 animate-rotate-12steps">
		@php
			$span_1 = '<span class="absolutetop-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"><span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-9 h-2 w-1 transform rotate-0 opacity-90 border-2 border-sepia-800">
						</span>';
			$span_r30 = '<span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform rotate-30 opacity-75"><span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-9 h-1 w-1 rounded-full transform rotate-0 opacity-90 border-2 border-sepia-800">
						</span>';
			$span_r_30 = '<span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform -rotate-30 opacity-75"><span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-9 h-1 w-1 rounded-full transform rotate-0 opacity-90 border-2 border-sepia-800">
						</span>';
			$endspan = '</span>';
		@endphp
		{!!$span_1!!}
		{!!$endspan!!}
		{!!$span_r30!!}
			{!!$span_r30!!}
				{!!$span_r30!!}
					{!!$span_r30!!}
						{!!$span_r30!!}
						{!!$endspan!!}
					{!!$endspan!!}
				{!!$endspan!!}
			{!!$endspan!!}
		{!!$endspan!!}
		{!!$span_r_30!!}
			{!!$span_r_30!!}
				{!!$span_r_30!!}
					{!!$span_r_30!!}
						{!!$span_r_30!!}
							{!!$span_r_30!!}
							{!!$endspan!!}
						{!!$endspan!!}
					{!!$endspan!!}
				{!!$endspan!!}
			{!!$endspan!!}
		{!!$endspan!!}
	</span>
</div>