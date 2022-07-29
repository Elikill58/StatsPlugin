<div class="stats-wrapper">
    <p style="float: left;">
        {{ $stats->name }}
    </p>
    <p style="float: right;">
        <?php
        $linked = $stats->settings == null ? "" : $stats->settings["linked"];
        $linkedValue = isset($statsValues[$linked]) ? $statsValues[$linked] : 1;
        $porcent = (intval($val) / ($linkedValue == null || $linkedValue == 0 ? 1 : $linkedValue)) * 100;
        ?>
        {{ intval($porcent) }}%
    </p>
</div>