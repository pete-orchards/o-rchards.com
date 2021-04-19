<article class="my-4 p-2 text-left bg-white border border-sepia-800 rounded-xl">
	@include('components.idea_theme.item', ['idea_theme' => $content, 'banner' => $content['banner']])

	<section class="border-t border-gray-400 py-2">
		<div class="p-2 m-2">
			@include('components.form.index', ['init' => $content['tag'], 'tane_placeholders' => ['楽しいアイディアを集めよう']])
		</div>
	</section>

	<section class="border-t border-gray-400 py-2">
		<div class="text-center text-2xl py-2">集まったアイディア</div>
		<div>
			@include('components.post.posts')
		</div>
	</section>

</article>