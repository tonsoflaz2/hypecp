@php
    $enabled = $signals->enabled;
    // Do something with the state and toggle the enabled state.
    $enabled = !$enabled;
@endphp

@mergesignals(['enabled' => $enabled])

@mergefragments
    <span id="button-text">
        {{ $enabled ? 'Disable' : 'Enable' }}
    </span>
@endmergefragments