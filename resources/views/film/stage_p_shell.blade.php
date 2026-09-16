{{-- Star Federation Archive — raw Datastar + Rocket + Stellar CSS demo.
     Standalone page: Stellar is classless and styles bare elements, so this
     view owns its whole <head> instead of using the app layout.
     Note: @@get / @@clipboard / @@intl are Blade escapes for literal @. --}}
<!doctype html>
<html lang="en"
      data-signals="{hue: 305, round: 14, frost: 16, density: 50}"
      data-attr:style="'--accent-hue:' + $hue + ';--radius-3:' + $round + 'px;--glass-blur:' + $frost + 'px;--stars:' + $density + ';--scroll:' + ($_scrollY || 0)">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Star Federation Archive</title>
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 16 16%22><text y=%2213%22 font-size=%2213%22>🚀</text></svg>">
<link rel="stylesheet" href="/datastar/podcast/stellar.css">
<link rel="stylesheet" href="/datastar/podcast/app.css">
@verbatim
<script type="module">
// Rocket components — the only JavaScript on this page, and all of it
// defines web components. Application behavior lives in data-* attributes.
import { rocket } from '/datastar/podcast/datastar-pro.js'

// Inline YouTube player. Each instance has its own $$playing state; the
// iframe lives in a data-if template, so it only mounts once clicked.
rocket('yt-clip', {
  mode: 'light',
  props: ({ string, number }) => ({
    video: string.default(''),
    start: number.min(0).default(0),
  }),
  setup: ({ $$ }) => {
    $$.playing = false
  },
  render: ({ html, props: { video, start } }) => html`
    <div class="clip">
      <button type="button" class="btn" data-show="!$$playing"
              data-on:click="$$playing = true">&#9654; Watch</button>
      <template data-if="$$playing">
        <div class="player">
          <iframe src="https://www.youtube-nocookie.com/embed/${video}?start=${start}&autoplay=1"
                  title="YouTube player"
                  allow="autoplay; encrypted-media; picture-in-picture"
                  allowfullscreen></iframe>
          <button type="button" class="btn" data-on:click="$$playing = false">&#10005; Close</button>
        </div>
      </template>
    </div>
  `,
})

// Copy-to-clipboard button with instance-local $$copied state.
rocket('copy-link', {
  mode: 'light',
  props: ({ string, number }) => ({
    url: string.default(''),
    label: string.trim.default('Copy link'),
    resetMs: number.min(0).default(1600),
  }),
  setup: ({ $$, props, action, cleanup }) => {
    $$.copied = false
    let timerId = 0
    action('copy', async () => {
      await navigator.clipboard.writeText(props.url)
      $$.copied = true
      clearTimeout(timerId)
      timerId = window.setTimeout(() => {
        $$.copied = false
      }, props.resetMs)
    })
    cleanup(() => clearTimeout(timerId))
  },
  render: ({ html, props: { label } }) => html`
    <button type="button" class="btn" data-on:click="@copy()"
            data-class:copied="$$copied"
            data-text="$$copied ? 'Copied \u2713' : '${label}'"></button>
  `,
})
</script>
@endverbatim
</head>
<body>
<div class="wrap"
     data-signals="{query: '', term: '', count: 0, compact: false}"
     data-query-string="{include: /^(query|term)$/}"
     data-persist="{include: /^(compact|hue|round|frost|density)$/}"
     data-on-raf="$_scrollY = window.scrollY">

  <header class="hero">
    <p class="kicker">Star Federation Archive &middot; declassified</p>
    <h1>Not a Space Cult</h1>
    <p class="lede">Every space-adjacent utterance on the Datastar podcast, transcribed and
    indexed. {{ $nEpisodes }} episodes. <strong data-text="@@intl('number', {{ $nMentions }})"></strong> documented mentions.
    <button type="button" class="chip" data-on:click="@@clipboard(location.href)">Share this search &#x2934;</button></p>
  </header>


  <search>
    <div class="searchbar">
      <input type="search" placeholder="Search the transcripts&hellip;"
             aria-label="Search the transcripts"
             data-bind:query
             data-on:input__debounce.300ms="@@get('/datastar/podcast/search')">
      <span class="spinner" data-show="$searching" aria-hidden="true"></span>
    </div>
    <nav class="chips" aria-label="Filter by term">
      <button type="button" class="chip" data-class:active="$term === ''"
              data-on:click="$term = ''; @@get('/datastar/podcast/search')">all</button>
      {!! $chips !!}
    </nav>
    <p class="meta">
      <span><strong data-text="@@intl('number', $count)"></strong> results</span>
      <button type="button" class="chip" data-show="$query !== '' || $term !== ''"
              data-on:click="$query = ''; $term = ''; @@get('/datastar/podcast/search')">&#10005; clear</button>
      <label><input type="checkbox" data-bind:compact> Compact view</label>
    </p>
  </search>

  <main id="results" data-class:compact="$compact"
        data-init="@@get('/datastar/podcast/search')"
        data-indicator:searching>
    <p class="muted">Contacting the mothership&hellip;</p>
  </main>


  <footer class="site-footer">
    <p>A Datastar Pro sample &mdash; raw SSE (no SDK), Rocket web components, Stellar CSS, and Pro attributes
    (<code>data-query-string</code>, <code>data-persist</code>, <code>@@clipboard</code>, <code>@@intl</code>)
    over server-sent HTML patches. Transcripts by whisper.cpp.</p>
  </footer>
</div>
<div class="planet-horizon" aria-hidden="true"><div class="planet"></div></div>
</body>
</html>

