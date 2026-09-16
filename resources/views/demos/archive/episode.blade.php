{{-- One episode on the timeline, when nothing has been searched for yet. --}}
<a class="episode" href="{{ $url }}" target="_blank" rel="noopener">
  <img src="https://i.ytimg.com/vi/{{ $id }}/mqdefault.jpg"
       alt="" loading="lazy" width="320" height="180">
  <h3>{{ $title }}</h3>
  <p>{{ $minutes }} min &middot; {{ $mentions }} mention{{ $mentions === 1 ? '' : 's' }}</p>
</a>
