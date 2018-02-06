<br>
<table class="table_border" id="error_table" cellpadding="$stylevar[cellpadding]" cellspacing="$stylevar[cellspacing]" border="0" width="70%" align="center">
<tr>
	<td class="tcat">$lang[error_message]</td>
</tr>
<tr>
	<td class="td2">
	<div class="td1l">
		<div>
	
		<if condition="$show['permission_error']">		
			<if condition="!$local[userid]">
			<form action="login.php?do=login" method="post">
			<input type="hidden" name="do" value="login">
			<input type="hidden" name="url" value="$local[whereurl]">
			<input type="hidden" name="SID" value="$SID">
		
			
			<div class="smallfont">$lang[not_logged_no_permission]</div>
			
			<fieldset class="fieldset">
				<legend>$lang[log_in]</legend>
				<table cellpadding="0" cellspacing="$stylevar[formspacer]" border="0" align="center">
				<tr>
					<td>$lang[username]:<br><input type="text" class="bginput" name="username" size="50"></td>
				</tr>
				<tr>
					<td>$lang[password]:<br><input type="password" class="bginput" name="password" size="50"></td>
				</tr>
				<tr>
					<td>
						<span style="float:$stylevar[right]"><a href="login.php?$session[sessionurl]do=lostpass">$lang[forgotten_your_password]</a></span>
						<label><input type="checkbox" name="remember_me" value="1" checked>$lang[remember_me]</label>
					
					</td>
				</tr>
				<tr>
					<td align="$stylevar[right]">
						<input type="submit" class="button" value="$lang[log_in]">
						<input type="reset" class="button" value="$lang[reset_fields]">
					
					</td>
				</tr>
				</table>

				<else>
			<div class="smallfont">$lang[not_logged_no_permission]</div>
			<fieldset class="fieldset">
				<legend>$lang[log_out]</legend>
				<table cellpadding="0" cellspacing="$stylevar[formspacer]" border="0" align="center" width="100%">
				<tr>
					<td align="$stylevar[leftl]">$lang[username] : <a href="member.php?u=$local[userid]">$local[username]</a></td>
				</tr>
				<tr>
					<td align="$stylevar[right]">
						<a href="login.php?do=logout&SID=$SID">$lang[log_out]</a>
					
					</td>
				</tr>
				</table>
			</if>
			</fieldset>
			
			<div class="smallfont"><if condition="$local[userid]">$lang[no_permission_or_disabled]<else>$lang[admin_required_register]</if></div>
			</form>
			
			<!-- / permission error message - user not logged in -->
		<else>		
			<!-- main error message -->
			
			
			<blockquote><p>$errormessage</p></blockquote>
			
				<div align=center><a href="javascript:history.back()">$lang[go] $lang[back]</a></div>
			<!-- / main error message -->			
		</if>
		
		</div>
	</div>

	</td>
</tr>
</table>

<br>

<!-- forum jump -->
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
	<td>$forumjump</td>
</tr>
</table>
<!-- / forum jump -->

<br>