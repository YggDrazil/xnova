<br />
<form action="alliance.php?mode=make&yes=1" method="POST">
<table width=519>
	<tr>
	  <td class="c" colspan=2>{make_alliance}</td>
	</tr>
	<tr>
	  <th>{alliance_tag} (3-8 {characters})</th>
	  <th><input type="text" name="tag" size=8 maxlength=8 value=""></th>
	</tr>
	<tr>
	  <th>{allyance_name} (max. 35 {characters})</th>
	  <th><input type="text" name="name" size=20 maxlength=30 value=""></th>
	</tr>
	<tr>
	  <th colspan=2><input type="submit" value="{sys_create}"></th>
	</tr>
</table>

</form>
