<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="max-width:600px;line-height:100%;">
	@include('emails.components.spacer', ['height' => 10])
	<tr>
		<td width="600" align="right">
			<span style="color:#999999;font-size:11px;line-height:120%;">正しく表示されない方は<a href="{{$href}}" target="_blank" style="color:#999999;text-decoration:underline;">こちら</a>をクリックしてください。</span>
		</td>
	</tr>
	@include('emails.components.spacer', ['height' => 10])
</table>