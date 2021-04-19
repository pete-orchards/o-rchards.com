<div class="py-4">
	<div>
		スタッフのご紹介
	</div>
	<div>
		4名のスタッフで企画・運営しています。
	</div>
</div>
<div class="py-2">
	<div class="bg-lettuce-300 text-center p-2 rounded-tr-2xl rounded-bl-2xl mb-4">
		<div class="p-2">
			<span class="rounded-full py-2 px-4 m-2 nm-flat-lettuce-300 text-white text-lg">太田 潤</span>
		</div>
		<div class="m-1"><img class="w-32 h-32 inline" src="{{asset('img/ota_icon.png')}}" alt="おおたアイコン"></div>
		<div>Position: 企画者・実践者・脱森と猫の皿の主</div>
		<div>Age: 28</div>
		<div>Residence: 岐阜県恵那市</div>
		<div class="py-2 border-t-2 border-tomato-500 text-left">
			できるだけ沢山、面白いと思えるアイデアをかたちにしていけたらなと思います。
		</div>
		<div class="text-right hover:text-tomato-500"><a href="{{route('staff', ['id' => 'junota'])}}">...click here to more</a></div>
		<div class="py-2 border-t-2 border-tomato-500">
			<a href="https://twitter.com/_datsumori_" target="_blank" rel="noopener"><img src="{{asset('img/Twitter_Social_Icon_Circle_Color.svg')}}" alt="Twitter" class="h-8 w-8 inline"></a>
		</div>
	</div>

	<div class="bg-lettuce-300 text-center p-2 rounded-tr-2xl rounded-bl-2xl mb-4">
		<div class="p-2">
			<span class="rounded-full py-2 px-4 m-2 nm-flat-lettuce-300 text-white text-lg">ミカ</span>
		</div>
		<div class="m-1"><img class="w-32 h-32 inline" src="{{asset('img/mika_icon.png')}}" alt="ミカアイコン"></div>
		<div>Position: 実践×移住×エッセイスト木工作家</div>
		<div>Age: 23</div>
		<div>Residence: 岐阜県恵那市</div>
		<div class="py-2 border-t-2 border-tomato-500 text-left">
			「リトルフォレスト」のような暮らしを求めて新卒で田舎に移住。
			<br>つくる、食べる、ねむる。五感を使う、ただの生き物でありたい。
		</div>
		<div class="text-right hover:text-tomato-500"><a href="{{route('staff', ['id' => 'mika'])}}">...click here to more</a></div>
		<div class="py-2 border-t-2 border-tomato-500">
			<a href="https://twitter.com/mikaeru6170" target="_blank" rel="noopener"><img src="{{asset('img/Twitter_Social_Icon_Circle_Color.svg')}}" alt="Twitter" class="h-8 w-8 inline"></a>
			<a href="https://note.com/myiukzau" target="_blank" rel="noopener"><img src="{{asset('img/logo_symbol.svg')}}" alt="Note" class="h-8 w-8 inline"></a>
		</div>
	</div>

	<div class="bg-lettuce-300 text-center p-2 rounded-tr-2xl rounded-bl-2xl mb-4">
		<div class="p-2">
			<span class="rounded-full py-2 px-4 m-2 nm-flat-lettuce-300 text-white text-lg">ピート</span>
		</div>
		<div class="m-1"><img class="w-32 h-32 inline" src="{{asset('img/pete_icon.png')}}" alt="peteアイコン"></div>
		<div>Position: 3D系ミュージシャン系Web開発デザイン担当</div>
		<div>Age: 27</div>
		<div>Residence: 東京</div>
		<div class="py-2 border-t-2 border-tomato-500 text-left">
					本業は会社員(小売業)。2020年はレザークラフトを始めようとしたが、失敗。購入した道具は部屋の片隅のタイムカプセルで眠っているという。きっと来年の僕が使ってくれるだろう。<br>
		</div>
		<div class="text-right hover:text-tomato-500"><a href="{{route('staff', ['id' => 'pete'])}}">...click here to more</a></div>
		<div class="py-2 border-t-2 border-tomato-500">
			<a href="https://twitter.com/pete_thetartles" target="_blank" rel="noopener"><img src="{{asset('img/Twitter_Social_Icon_Circle_Color.svg')}}" alt="Twitter" class="h-8 w-8 inline"></a>
		</div>
	</div>

	<div class="bg-lettuce-300 text-center p-2 rounded-tr-2xl rounded-bl-2xl mb-4">
		<div class="p-2">
			<span class="rounded-full py-2 px-4 m-2 nm-flat-lettuce-300 text-white text-lg">おすし</span>
		</div>
		<div class="m-1"><img class="w-32 h-32 inline" src="{{asset('img/osushi_icon.jpg')}}" alt="おすしアイコン"></div>
		<div>Position: Kawaiiグラフィッカープログラマ</div>
		<div>Age: 25</div>
		<div>Residence: 東京</div>
		<div class="py-2 border-t-2 border-tomato-500 text-left">
			本業は会社員。プログラマというポジションだがPythonしか使えない。最近CSSとPHPに触れ始めた。絵を描くのが好き。最近iPadを手に入れてとても楽しい。今年は2つ目のイラスト本を出したい。Youtubeもやってます。
		</div>
		<div class="text-right hover:text-tomato-500"><a href="{{route('staff', ['id' => 'osushi'])}}">...click here to more</a></div>
		<div class="py-2 border-t-2 border-tomato-500">
			<a href="https://twitter.com/anyway_osushi" target="_blank" rel="noopener"><img src="{{asset('img/Twitter_Social_Icon_Circle_Color.svg')}}" alt="Twitter" class="h-8 w-8 inline"></a>
		</div>
	</div>

</div>

@include('utilities.buttons.a1', [
	'text' => 'トップページ',
	'href' => route('home'),
	'color' => 'bg-tomato-500',
])