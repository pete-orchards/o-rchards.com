@include('emails.components.spacer', ['height' => 10])
<tr>
	<td>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="{{(600-$width)/2}}" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
				<td width="{{$width}}" style="font-size:0;">
					<img src="{{$src}}" width="{{$width}}" alt="" style="display:block;width:100%;max-width:600px;height:auto;">
				</td>
				<td width="{{(600-$width)/2}}" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
			</tr>
		</table>
	</td>
</tr>
@include('emails.components.spacer', ['height' => 10])