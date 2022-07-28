<div class="ratio-wrapper">
    <p>
        {{ $stats->name }}
    </p>
    <div class="ratio-background">
        <?php
        $linked = $stats->settings["linked"];
        $linkedValue = $statsValues[$linked];
        $porcent = ($val / ($linkedValue == null || $linkedValue == 0 ? 1 : $linkedValue)) * 100;
        ?>
        <div class="ratio-main" style="width: {{ $porcent }}%"></div>
    </div>
</div>