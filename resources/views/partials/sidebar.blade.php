<div class="list-group">

    <h4>Archivados</h4>

    @foreach($archives as $stats)
        <a class="app-list-group-item list-group-item-action" href="{{ url("archives?month={$stats['month']}&year={$stats['year']}") }}">
            {{ $stats['month'] . ' ' . $stats['year'] }}
        </a>
    @endforeach

    <h4>Tags</h4>

    @foreach($tags as $index => $slug)
    <a class="app-list-group-item list-group-item-action" href="{{ url("tags/{$slug}") }}">
        {{ $index }}
    </a>
    @endforeach

</div>