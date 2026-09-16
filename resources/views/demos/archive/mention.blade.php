{{-- One result: the episode once, then every clip found inside it.

     <yt-clip> and <copy-link> go over the wire EMPTY. The server writes the tag
     and nothing else; Rocket upgrades them in the browser and renders the Watch
     button and the player. The id is the clip's identity, so a re-render that
     returns the same clip is recognised as the same element, and
     data-ignore-morph keeps the patcher out of what Rocket owns. --}}
<article class="mention">
  <header class="ep-head">
    <div class="ep-head-text">
      <a class="ep-name" href="{{ $epUrl }}" target="_blank" rel="noopener"
         title="Open full episode on YouTube">{{ $title }}</a>
      <small class="clip-count">{{ count($clips) }} clip{{ count($clips) === 1 ? '' : 's' }}</small>
    </div>
    <a class="thumb-link" href="{{ $epUrl }}" target="_blank" rel="noopener"
       title="Open full episode on YouTube">
      <img class="thumb" src="https://i.ytimg.com/vi/{{ $vid }}/mqdefault.jpg"
           alt="" loading="lazy" width="320" height="180">
    </a>
  </header>
  <div class="body">
    @foreach ($clips as $clip)
      <div class="quote">
        <div class="q-meta">
          <time>{{ $clip['ts'] }}</time>
          <span class="badge">{{ $clip['term'] }}</span>
          <span class="q-spacer"></span>
          <yt-clip id="clip-{{ $vid }}-{{ $clip['start'] }}"
                   video="{{ $vid }}" start="{{ $clip['start'] }}" data-ignore-morph></yt-clip>
          <copy-link id="copy-{{ $vid }}-{{ $clip['start'] }}"
                     url="{{ $clip['url'] }}" label="Copy" data-ignore-morph></copy-link>
        </div>
        <blockquote>
          <span class="context">&hellip;{{ $clip['before'] }} </span>{!! $clip['html'] !!}<span class="context"> {{ $clip['after'] }}&hellip;</span>
        </blockquote>
      </div>
    @endforeach
  </div>
</article>
