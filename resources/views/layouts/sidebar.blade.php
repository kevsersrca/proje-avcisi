<div class="sidebar">
    <div class="card">
        @if(!auth()->guest() && isset($feeds))
            <h3 class="card-title">Aktiviteler</h3>
            <ul>
                @foreach($feeds as $feed)
                    <li><a href="/kullanicilar/{{$feed->user->id}}">{{$feed->user->username}}</a> {{$feed->event}}: <a href="/projects/{{$feed->project->id}}">{{$feed->project->title}}</a></li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
