<div class="stats-wrapper">
	<p style="float: left;">
		{{ $stats->name }}
	</p>
	<p style="float: right;">
		{{ ($stats->settings['prefix'] ?? '') . substr_count($val, $stats->settings["split"] ?? ";") . ($stats->settings['suffix'] ?? '') }}
	</p>
</div>