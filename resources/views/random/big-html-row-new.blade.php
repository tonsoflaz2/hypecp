<div class="row" style="display:flex;">
    <div style="width: 5%;">
        @if (isset($i))
            {{ $i }}
        @endif
    </div>
    <div style="width: 20%;"><b>This is my main info</b></div>
    <div style="width: 60%;" class="expandable-column">
        This has much more info<br>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.
        <div class="extra-content">
            <br><b>More Details:</b><br>
            This additional content is dynamically revealed upon expansion.
        </div>
    </div>
    <div style="width: 15%;">
        <button hx-get="/big-html-row"
                    hx-target="closest .row"
                    hx-swap="outerHTML">
                Change it back
            </button>
        <!-- <button class="expand-button">Expand</button> -->
    </div>
</div>
