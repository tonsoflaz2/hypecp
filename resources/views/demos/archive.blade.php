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
  <link rel="stylesheet" href="/datastar-assets/podcast/stellar.css">
  <link rel="stylesheet" href="/datastar-assets/podcast/app.css">
@verbatim
<script type="module">
// Rocket components — the only JavaScript on this page, and all of it
// defines web components. Application behavior lives in data-* attributes.
import { rocket } from '/datastar-assets/podcast/datastar-pro.js'

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
          <button type="button" class="btn"
                  data-on:click="$$playing = false">&#10005; Close</button>
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
<section class="howmade" data-class:open="$_howOpen">
  <div class="hm-drawer"><div class="hm-inner">
  <section class="made-with">
    <article class="made-card" data-class:flipped="$_mcDs">
      <div class="mc-face mc-front">
        <button type="button" class="chip mc-flip" data-on:click="$_mcDs = !$_mcDs" title="See the code">&lt;/&gt;</button>
        <h3>Datastar</h3>
        <p>The real-time engine. Every behavior here &mdash; live search, term filters,
        the shareable URL, this drawer &mdash; is a <code>data-*</code> attribute on plain HTML.
        Signals hold state in the browser; <code>@@get()</code> sends them to the server, which answers
        with rendered HTML that Datastar morphs into the page. No JSON API, no client framework.
        The entire wire format is two SSE events:</p>
        <pre><code>event: datastar-patch-signals
data: signals {"count": 20}

event: datastar-patch-elements
data: elements &lt;main id="results"&gt;&hellip;&lt;/main&gt;</code></pre>
      </div>
      <div class="mc-face mc-back">
        <button type="button" class="chip mc-flip" data-on:click="$_mcDs = !$_mcDs" title="Back">&#8617;</button>
        <h3>Datastar &mdash; code</h3>
        <p>The browser side is attributes:</p>
        <pre><code>&lt;input data-bind:query
  data-on:input__debounce.300ms="@@get('/search')"&gt;
&lt;main id="results"&gt;&hellip;&lt;/main&gt;</code></pre>
        <p>The server side is a string:</p>
        <pre><code>return response(
  "event: datastar-patch-elements
".
  'data: elements &lt;main id="results"&gt;&hellip;&lt;/main&gt;'
  ."

",
  200, ['Content-Type' =&gt; 'text/event-stream']);</code></pre>
      </div>
    </article>
    <article class="made-card" data-class:flipped="$_mcRk">
      <div class="mc-face mc-front">
        <button type="button" class="chip mc-flip" data-on:click="$_mcRk = !$_mcRk" title="See the code">&lt;/&gt;</button>
        <h3>Rocket</h3>
        <p>The component layer. The server writes dumb tags like
        <code>&lt;yt-clip video start&gt;</code> and Rocket upgrades them into real web components.
        Typed codecs (<code>number.min(0)</code>, <code>string.trim</code>) decode the attributes,
        and each instance owns private state: every card&rsquo;s player mounts its iframe only when
        clicked, every Copy button tracks its own &ldquo;Copied&rdquo; state. Both components live in
        this page&rsquo;s single script tag. Here&rsquo;s one, live:</p>
        <p class="made-demo"><copy-link url="https://hypecp.test/datastar/podcast" label="Copy the site link"></copy-link></p>
      </div>
      <div class="mc-face mc-back">
        <button type="button" class="chip mc-flip" data-on:click="$_mcRk = !$_mcRk" title="Back">&#8617;</button>
        <h3>Rocket &mdash; code</h3>
        <p>The page defines it once:</p>
        <pre><code>rocket('yt-clip', {
  props: ({ string, number }) =&gt; ({
    video: string, start: number.min(0),
  }),
  setup: ({ $$ }) =&gt; { $$.playing = false },
  render: ({ html, props: { video, start } }) =&gt; html`
    &lt;button data-on:click="$$playing = true"&gt;
      &#9654; Watch&lt;/button&gt;
    &lt;template data-if="$$playing"&gt;
      &lt;iframe src="&hellip;/embed/${video}?start=${start}"&gt;
      &lt;/iframe&gt;
    &lt;/template&gt;`,
})</code></pre>
        <p>Then the server just writes a tag:</p>
        <pre><code>&lt;yt-clip video="2ECucq-mTGg" start="3174"&gt;
&lt;/yt-clip&gt;</code></pre>
      </div>
    </article>
    <article class="made-card" data-class:flipped="$_mcSt">
      <div class="mc-face mc-front">
        <button type="button" class="chip mc-flip" data-on:click="$_mcSt = !$_mcSt" title="See the code">&lt;/&gt;</button>
        <h3>Stellar CSS</h3>
        <p>One stylesheet, no build step, no utility classes. Stellar works in two halves.
        First, <em>classless base styles</em>: bare HTML &mdash; headings, inputs, quotes,
        buttons &mdash; comes out looking designed, via low-specificity <code>:where()</code>
        rules your own CSS always beats. Second, a vocabulary of <em>named CSS variables</em>
        (<code>--purple-6</code>, <code>--size-3</code>, <code>--radius-round</code>) for every
        color, size, and radius. Styles spend those names instead of inventing values, so
        changing one variable re-styles everything that uses it. Try it:</p>
        <div class="token-controls">
          <div class="tb-swatches" role="group" aria-label="Accent color">
            <button type="button" class="swatch" style="--sw: 305" aria-label="Accent hue 305" data-class:active="$hue == 305" data-on:click="$hue = 305"></button>
            <button type="button" class="swatch" style="--sw: 240" aria-label="Accent hue 240" data-class:active="$hue == 240" data-on:click="$hue = 240"></button>
            <button type="button" class="swatch" style="--sw: 190" aria-label="Accent hue 190" data-class:active="$hue == 190" data-on:click="$hue = 190"></button>
            <button type="button" class="swatch" style="--sw: 145" aria-label="Accent hue 145" data-class:active="$hue == 145" data-on:click="$hue = 145"></button>
            <button type="button" class="swatch" style="--sw: 90" aria-label="Accent hue 90" data-class:active="$hue == 90" data-on:click="$hue = 90"></button>
            <button type="button" class="swatch" style="--sw: 25" aria-label="Accent hue 25" data-class:active="$hue == 25" data-on:click="$hue = 25"></button>
          </div>
          <label>radius <input type="range" min="0" max="28" step="1" data-bind:round>
            <output data-text="$round + 'px'"></output></label>
          <label>frost <input type="range" min="0" max="28" step="1" data-bind:frost>
            <output data-text="$frost + 'px'"></output></label>
          <label>stars <input type="range" min="0" max="100" step="1" data-bind:density>
            <output data-text="$density + '%'"></output></label>
          <button type="button" class="chip" data-on:click="$hue = 305; $round = 14; $frost = 16; $density = 50">reset</button>
        </div>
      </div>
      <div class="mc-face mc-back">
        <button type="button" class="chip mc-flip" data-on:click="$_mcSt = !$_mcSt" title="Back">&#8617;</button>
        <h3>Stellar &mdash; code</h3>
        <p>The whole look is a handful of variables:</p>
        <pre><code>:root {
  --accent-hue: 305;
  --accent: oklch(0.58 0.17 var(--accent-hue));
  --glass-bg: rgb(255 255 255 / 0.08);
}
.mention {
  background: var(--glass-bg);
  border-radius: var(--radius-3);
}</code></pre>
        <p>And the sliders write them &mdash; zero JS:</p>
        <pre><code>&lt;input type="range" data-bind:hue&gt;
&lt;html data-attr:style=
  "'--accent-hue:' + $hue"&gt;</code></pre>
      </div>
    </article>
  </section>
  </div></div>
  <button type="button" class="hm-toggle" data-on:click="$_howOpen = !$_howOpen"
          data-attr:aria-expanded="$_howOpen ? 'true' : 'false'">
    How this site was made with Datastar, Rocket &amp; Stellar <span class="tb-chev">&#9652;</span>
  </button>
</section>
<div class="space-bg" aria-hidden="true">
<i class="stars s1"></i><i class="stars s2"></i><i class="stars s3"></i><i class="stars s4"></i><i class="stars s5"></i><i class="stars s6"></i><i class="stars s7"></i>
<svg viewBox="0 0 1600 1000" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
  <g class="fill">
    <circle cx="90" cy="330" r="1.6"/><circle cx="210" cy="520" r="1.3"/><circle cx="60" cy="700" r="2"/>
    <circle cx="330" cy="240" r="1.4"/><circle cx="420" cy="620" r="1.7"/><circle cx="290" cy="880" r="1.3"/>
    <circle cx="540" cy="120" r="1.5"/><circle cx="640" cy="420" r="1.2"/><circle cx="580" cy="760" r="1.8"/>
    <circle cx="760" cy="260" r="1.3"/><circle cx="860" cy="560" r="1.5"/><circle cx="810" cy="900" r="1.4"/>
    <circle cx="980" cy="150" r="1.7"/><circle cx="1060" cy="380" r="1.2"/><circle cx="1010" cy="690" r="1.6"/>
    <circle cx="1180" cy="90" r="1.4"/><circle cx="1240" cy="480" r="1.8"/><circle cx="1160" cy="820" r="1.3"/>
    <circle cx="1360" cy="330" r="1.5"/><circle cx="1470" cy="560" r="1.3"/><circle cx="1420" cy="700" r="1.7"/>
    <circle cx="1540" cy="180" r="1.4"/><circle cx="1560" cy="900" r="1.5"/><circle cx="120" cy="140" r="1.5"/>
    <circle cx="700" cy="80" r="1.3"/><circle cx="1300" cy="950" r="1.5"/><circle cx="460" cy="940" r="1.4"/>
  </g>
  <g class="line">
    <path d="M240,-8 h16 M248,-16 v16" transform="translate(120,420)"/>
    <path d="M-8,0 h16 M0,-8 v16" transform="translate(900,760)"/>
    <path d="M-8,0 h16 M0,-8 v16" transform="translate(1490,420)"/>
    <path d="M-8,0 h16 M0,-8 v16" transform="translate(620,200)"/>
  </g>
  <g class="fill">
    <path d="M0,-9 C1,-2 2,-1 9,0 C2,1 1,2 0,9 C-1,2 -2,1 -9,0 C-2,-1 -1,-2 0,-9 Z" transform="translate(380,150)"/>
    <path d="M0,-9 C1,-2 2,-1 9,0 C2,1 1,2 0,9 C-1,2 -2,1 -9,0 C-2,-1 -1,-2 0,-9 Z" transform="translate(1100,250) scale(0.8)"/>
    <path d="M0,-9 C1,-2 2,-1 9,0 C2,1 1,2 0,9 C-1,2 -2,1 -9,0 C-2,-1 -1,-2 0,-9 Z" transform="translate(240,640) scale(0.7)"/>
    <path d="M0,-9 C1,-2 2,-1 9,0 C2,1 1,2 0,9 C-1,2 -2,1 -9,0 C-2,-1 -1,-2 0,-9 Z" transform="translate(1480,120) scale(1.1)"/>
    <path d="M0,-9 C1,-2 2,-1 9,0 C2,1 1,2 0,9 C-1,2 -2,1 -9,0 C-2,-1 -1,-2 0,-9 Z" transform="translate(720,930) scale(0.9)"/>
  </g>
  <g class="line" transform="translate(770,95) rotate(18)">
    <circle r="5"/>
    <path d="M-8,-3 L-95,-14 M-8,3 L-88,16 M-9,0 L-70,2"/>
  </g>
</svg>
</div>
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
