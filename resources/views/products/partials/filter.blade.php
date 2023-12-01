<div class="border rounded-lg flex flex-col p-3 gap-6">
@foreach ($tagGroups as $tagGroup)
    @if (count($tagGroup->tags) > 0)
        <div class="flex flex-col gap-2">
            <span class="text-sm font-semibold">{{ $tagGroup->name }}</span>
            @foreach ($tagGroup->tags as $tag)
                <a href="{{ request()->fullUrlWithQuery(['tag_id' => $tag->id, 'page' => 1]) }}">
                    <span class="bg-green-100 text-sm p-1 rounded-md whitespace-nowrap">{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>
    @endif
@endforeach
</div>
