@include('emails.components.spacer', ['height' => 10])
<tr>
	<td>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="250" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
				<td width="100" height="100" style="font-size:0;">
					<a href="{{$user->href()}}" target="_blank" width="100" height="100" style="display:block;width:100px;height:100px;text-decoration:none;">
						<img src="{{$user->prof_path()}}" width="100" height="100" alt="" style="display:block;width:100%;max-width:600px;height:100%;border-radius:50px;border:2px solid #aaa;">
					</a>
				</td>
				<td width="250" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
			</tr>
			@include('emails.components.spacer', ['height' => 5])
		</table>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="20" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
				<td width="560" align="center">
					<a href="{{$user->href()}}" target="_blank" width="100" height="96" style="display:block;width:100%;height:100%;text-decoration:none;">
						<span style="color:#432;font-size:14px;line-height:150%;">{{$user->name}}</span>
					</a>
				</td>
				<td width="20" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
			</tr>
		</table>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="20" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
				<td width="560" align="center">
					<a href="{{$user->href()}}" target="_blank" width="100" height="96" style="display:block;width:100%;height:100%;text-decoration:none;">
						<span style="color:#432;font-size:14px;line-height:150%;">{{'@'.$user->user_id}}</span>
					</a>
				</td>
				<td width="20" style="font-size:0;">
					<img src="img/spacer.gif" alt="" width="10" height="1" style="display:block;">
				</td>
			</tr>
		</table>

	</td>
</tr>
@include('emails.components.spacer', ['height' => 10])