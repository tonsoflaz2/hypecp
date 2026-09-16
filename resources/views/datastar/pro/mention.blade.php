{{-- One result. The <yt-clip> tag is all the server knows about the player.
     These are direct grid children so the quote and the player can span the
     card's full width — see .mention in app.css. --}}
<article class="mention">
  <header>
    <time>{{ $stamp }}</time>
    <h3>{{ $title }}</h3>
  </header>
  <img class="thumb" src="https://i.ytimg.com/vi/{{ $video }}/mqdefault.jpg"
       alt="" loading="lazy" width="320" height="180">
  <blockquote><span class="ctx">{{ $before }}</span> {!! $hit !!} <span class="ctx">{{ $after }}</span></blockquote>
  {{-- id  = the clip's identity. Datastar matches elements by id before it
             matches by position, so the same clip survives a re-render even if
             it moves, and a different clip replaces this element outright.
       data-ignore-morph = Rocket renders the button and the player INTO this
             element, but we send it empty -- without this the morph makes the
             live element match and deletes them. Both sides must declare it. --}}
  <yt-clip id="clip-{{ $video }}-{{ $start }}" video="{{ $video }}" start="{{ $start }}" data-ignore-morph></yt-clip>
</article>
