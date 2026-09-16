{{-- resources/views/mention.blade.php: one result --}}
{{-- The lesson's per-result partial: prototyped in the page, cut here,
     parameterized, and finally given the real design-system class.
     Production renders equivalent markup in renderMentionGroup(). --}}
  <article class="mention">
    <h3>{{ $m->episode }}</h3>
    <blockquote>{{ $m->quote }}</blockquote>
    <yt-clip video="{{ $m->video }}" start="{{ $m->start }}"></yt-clip>
  </article>
