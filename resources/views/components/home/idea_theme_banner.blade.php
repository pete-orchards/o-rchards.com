<a href="{{route('idea_theme', ['id' => $idea_theme->id])}}">
	<img src="@if(!empty($idea_theme->result)){{url('/'.$idea_theme->result->banner_path())}}@else{{url('/'.$idea_theme->banner_path())}}@endif">
</a>