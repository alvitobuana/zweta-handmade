@props(['events' => []])
<div class="space-y-4">
    @foreach($events as $e)
        <div class="timeline-item">
            <div class="w-3.5 h-3.5 rounded-full bg-[--soft-beige] mt-1"></div>
            <div>
                <div class="font-medium">{{ $e['title'] ?? '' }}</div>
                <div class="text-sm text-muted">{{ $e['date'] ?? '' }}</div>
            </div>
        </div>
    @endforeach
</div>
