$stylevar[htmldoctype]
<html dir="$lang[dir]" lang="$lang[code]">
<head>
	<meta http-equiv="Refresh" content="2; URL=$url" />
	$headinclude
<title>$options[sitetitle]</title>
</head>
<body>

<br />
<br />
<br />
<br />

<form action="$url" method="post" name="redirection_form">
<table class="table_border" cellpadding="$stylevar[cellpadding]" cellspacing="$stylevar[cellspacing]" border="0" width="70%" align="center">
<tr>
	<td class="tcat">$lang[redirecting]</td>
</tr>
<tr>
	<td class="td2" align="center">
	<div class="td1">
			
		<blockquote>
			<p>&nbsp;</p>
			<p><strong>$redirect_message</strong></p>			
				<p class="smallfont"><a href="$url">$lang[click_if_browser_does_not_redirect]</a></p>
				<div>&nbsp;</div>
		</blockquote>
			
	</div>
	</td>
</tr>
</table>
</form>
</body>
</html>