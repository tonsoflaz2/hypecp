<tr>
        <td style="width: 5%;">
            @if (isset($i))
                {{ $i }}
            @endif
        </td>
        <td style="width: 20%;"><b>This is my main info</td>
        <td style="width: 60%;">Secondary info<br>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel sapien non nunc pharetra suscipit. Proin vitae vehicula enim. Sed nec lorem et augue consequat luctus. Vivamus tristique nisi vel bibendum mattis.
        </td>
        <td style="width: 15%;">
            <button hx-get="/big-html-row-new"
                    hx-target="closest tr"
                    hx-swap="outerHTML">
                Change the row
            </button>
        </td>
    </tr>