<!DOCTYPE html>
<html lang="ja">
	<head>
		@yield('header')
	</head>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#f1efdd" style="background:#f1efdd;font-family: 'ヒラギノ角ゴ Pro W3', Hiragino Kaku Gothic Pro, 'メイリオ', Meiryo, Osaka, 'ＭＳ Ｐゴシック', MS PGothic, sans-serif;">
		<div style="background:#f1efdd;">
			<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="max-width:600px;line-height:100%;">
				@yield('main')
				@yield('footer')
			</table>
		</div>
	</body>
</html>