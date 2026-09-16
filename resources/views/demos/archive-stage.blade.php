{{-- Video-lesson stage pages — the real app frozen at each build stage:
     raw     = plain Datastar attributes, real search, components inert
     rocket  = + the two Rocket components (Watch/Copy come alive)
     stellar = + stellar.css linked (classless design kicks in)
     (the finished page itself is the "hero" stage)
     Loads real data via the real /datastar/podcast/search endpoint. --}}
<!doctype html>
<html lang="en" data-signals="{query: '', term: '{{ request('term', '') }}'}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Not a Space Cult — {{ $stage }}</title>
@if($stage === 'stellar')
<link rel="stylesheet" href="/datastar/podcast/stellar.css">
@endif
@if($stage === 'raw')
<script type="module" src="/datastar/podcast/datastar-pro.js"></script>
@else
@verbatim
<script type="module">
import { rocket } from '/datastar/podcast/datastar-pro.js'

rocket('yt-clip', {
  mode: 'light',
  props: ({ string, number }) => ({
    video: string.default(''),
    start: number.min(0).default(0),
  }),
  setup: ({ $$ }) => { $$.playing = false },
  render: ({ html, props: { video, start } }) => html`
    <div class="clip">
      <button type="button" class="btn" data-show="!$$playing"
              data-on:click="$$playing = true">&#9654; Watch</button>
      <template data-if="$$playing">
        <div class="player">
          <iframe src="https://www.youtube-nocookie.com/embed/${video}?start=${start}&autoplay=1"
                  title="YouTube player" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          <button type="button" class="btn" data-on:click="$$playing = false">&#10005; Close</button>
        </div>
      </template>
    </div>`,
})

rocket('copy-link', {
  mode: 'light',
  props: ({ string, number }) => ({
    url: string.default(''),
    label: string.trim.default('Copy'),
    resetMs: number.min(0).default(1600),
  }),
  setup: ({ $$, props, action, cleanup }) => {
    $$.copied = false
    let timerId = 0
    action('copy', async () => {
      await navigator.clipboard.writeText(props.url)
      $$.copied = true
      clearTimeout(timerId)
      timerId = window.setTimeout(() => { $$.copied = false }, props.resetMs)
    })
    cleanup(() => clearTimeout(timerId))
  },
  render: ({ html, props: { label } }) => html`
    <button type="button" class="btn" data-on:click="@copy()"
            data-text="$$copied ? 'Copied ✓' : '${label}'"></button>`,
})
</script>
@endverbatim
@endif
</head>
<body>

<!-- search: signals up, HTML down -->
<input data-bind:query placeholder="Search the transcripts&hellip;"
       data-on:input__debounce.300ms="@@get('/datastar/podcast/search')">
<main id="results" data-init="@@get('/datastar/podcast/search')">...</main>

</body>
</html>
