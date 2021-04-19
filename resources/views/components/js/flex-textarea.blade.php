<div class="relative js-flex-textarea">
	<div class="overflow-hidden border-box invisible whitespace-pre-wrap break-words min-h-16 p-1 js-flex-textarea-dummy"></div>
	{{$slot}}
</div>

@push('js')
	<script src="{{asset('/js/flex-textarea.js')}}" defar></script>
@endpush