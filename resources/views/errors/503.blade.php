<!DOCTYPE html-->
<html lang="ja">
	<head>
	@include('components.header', ['title' => 'メンテナンス | Orchards'])
	</head>

	<body>
		<header class="">
			<div class="text-center mx-auto">
				<img class="w-full max-w-md" src="{{asset('/img/orchards-logo.png')}}" alt="Orchards">
			</div>
		</header>

		@component('components.container', ['id' => '503error'])
			@include('components.pagetitle', ['title' => 'メンテナンスのお知らせ'])

			<div class="border-4 border-lettuce-300 bg-white rounded-xl my-4 p-1">
				<div class="mb-4">
					<p>
						日頃よりOrchardsをご利用いただき、誠にありがとうございます。
					</p>
					<p>
						現在メンテナンス中のため、こちらのページはご利用いただけません。
					</p>
					<p>
						ご不便をお掛け致しますが、ご理解いただきますようお願い申し上げます。
					</p>
				</div>

				<div class="hidden">
					<p>
						メンテナンス予定時刻: 2021/2/5 23:00 - 24:00
					</p>
				</div>
			</div>
		@endcomponent
	</body>
</html>