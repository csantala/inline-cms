<p><?=$pagination?></p>
<table width="100%">
	<tr>
		<td>Time</td>
		<td>Page</td>
		<td>Referer</td>
		<td>Browser</td>
		<td>OS</td>
		<td>IP</td>
	</tr>

	<? if(isset($stats)) foreach ($stats as $row) {
		if (strlen($row->page_title) > 50) $title = substr($row->page_title,0,40) . '..';
		else $title = $row->page_title;

		if(strlen($row->referer) > 20) $ref = "..".substr($row->referer, -20);
		else $ref = $row->referer;

		if ($row->referer == '0') $ref = 'none';
		else $ref = '<a href="'.$row->referer.'" title="'.$row->referer.'">'.$ref.'</a>';
		echo '
		<tr>
		<td>'.substr($row->dt,5,30).'</td>
		<td>'.$title.'</td>
		<td>'.$ref.'</td>
		<td>'.$row->browser_family.' '.$row->browser_version.'</td>
		<td>'.$row->os.'</td>
		<td><a href="http://www.infosniper.net/?ip_address='.$row->ip.'" target="_blank">'.$row->ip.'</a></td>
		</tr>';
	} ?>
</table>
<p><?=$pagination?></p>