<div class="ratio-wrapper">
    <p>
        {{ $stats->name }}
    </p>
    <div class="ratio-background">
        <?php
        $linked = $stats->settings == null ? "" : $stats->settings["linked"];
        $linkedValue = isset($statsValues[$linked]) ? $statsValues[$linked] : 1;
        $porcent = (intval($val) / ($linkedValue == null || $linkedValue == 0 ? 1 : $linkedValue)) * 100;
        ?>
        <div class="ratio-main" style="width: {{ $porcent }}%"></div>
    </div>
</div>