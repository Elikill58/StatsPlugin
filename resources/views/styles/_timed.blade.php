<div style="display: flow-root;">
	<p style="float: left;">
		{{ $stats->name }}
	</p>
	<p style="float: right;">
		{{ ($stats->settings['prefix'] ?? '') . $stats->toVisualTime($val) . ($stats->settings['suffix'] ?? '') }}
	</p>
</div>