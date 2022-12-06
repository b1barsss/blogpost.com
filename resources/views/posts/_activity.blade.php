<div class="container">
    <div class="row">
        <x-card>
            <x-slot name="title">
                Most Commented
            </x-slot>
            @slot('subtitle')
                What people are currently talking about
            @endslot
            @slot('items')
                @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                        @if ((auth()->user()->is_admin) ?? false)
                            <div class="text-muted font-italic" style="display: block;">
                                {{ $post->comments_count }} comments
                            </div>
                        @endif
                    </li>
                @endforeach
            @endslot
        </x-card>

    </div>
    <div class="row mt-3">
        @card(['title' => 'Most Active'])
        @slot('subtitle')
            People with most posts written
        @endslot
        @slot('items', collect($mostActive)->pluck('name'))
        @endcard
    </div>
    <div class="row mt-3">
        @card(['title' => 'Most Active Last Month'])
        @slot('subtitle')
            People with most posts written last month
        @endslot
        @slot('items', collect($mostActiveLastMonth)->pluck('name'))
        @endcard
    </div>
</div>
