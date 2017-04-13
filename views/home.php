<script src="scripts/initialization.js"></script>
<script>
homeInit()
</script>
<script type="text/javascript">
	function showReport($i) {
		var show;
		var hide;
		if ($i == 1) {
			show = '.priority';
			hide = '.date';
		} else {
			hide = '.priority';
			show = '.date';
		}
		[].forEach.call(document.querySelectorAll(show), function (el) {
			  el.style.display = '';
		});
		[].forEach.call(document.querySelectorAll(hide), function (el) {
			  el.style.display = 'none';
		});
	}
	
	function showReportOnLoad() {
		showReport(2);	
	}
</script>

<h2>Recent Incidents</h2>
<select>
  <option value=1 onchange="showReport(value);">Priority</option>
  <option value=2 onchange="showReport(value);">Date</option>
</select>
<a href="report.html" class="btn btn-default">Report Incident</a>
<table id="reports">
</table>
<p onload="showReportOnLoad()"></p>
