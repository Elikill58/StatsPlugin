<div class="stats-wrapper">
	<p style="float: left;">
		{{ $stats->name }}
	</p>
	<p style="float: right;">
		{{ ($stats->settings['prefix'] ?? '') . $val . ($stats->settings['suffix'] ?? '') }}
	</p>
</div>