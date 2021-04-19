<article class="theme-content-container">
	@include('components.idea_theme.item', ['idea_theme' => $content, 'banner' => $content['banner']])

	<section class="theme-content-topborder">
		<div class="theme-form">
			@include('components.form.index', ['init' => $content['tag'], 'tane_placeholders' => ['楽しいアイディアを集めよう']])
		</div>
	</section>

	<section class="theme-content-topborder">
		<div class="theme-content-subtitle">集まったアイディア</div>
		<div>
			@include('components.post.posts')
		</div>
	</section>

</article>