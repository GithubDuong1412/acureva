@php($tabId = Arr::get($attributes ?? [], 'id', 'tabmenubar'))

<ul class="nav nav-tabs justify-content-center {{ Arr::get($attributes ?? [], 'class') }}" id="{{ $tabId }}" role="tablist" aria-label="Collections list">
    @foreach ($collections as $collection)
        <li class="nav-item" role="tab" aria-controls="{{ $collection->slug }}" aria-selected="true"
            id="{{ $collection->slug }}-tab"
            aria-labelledby="#{{ $tabId }}">
            <a @class([
                'nav-link',
                'active' => $collection->id == $collectionId,
            ])
            data-bs-toggle="tab"
            href="#{{ $collection->slug }}"
            @if ($collection->id == $collectionId) data-loaded @endif data-ref="{{ $collection->slug }}"
            data-url="{{ route('public.ajax.products', ['collection_id' => $collection->id, 'limit' => $limit]) }}"
            
            data-show-collection-button="{{ $shortcode->show_collection_button ?? 'no' }}"
            data-collection-button-text="{{ $shortcode->collection_button_text ?? '' }}"
            data-collection-link="{{ url($collection->slug . '-collection') }}">
                <span class="pc-collection-tab__content">
                    @if (($shortcode->add_image ?? 'no') === 'yes')
                        <span class="pc-collection-tab__img">
                            <img src="{{ RvMedia::getImageUrl($collection->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $collection->name }}" loading="lazy" />
                        </span>
                    @endif
                    <span class="pc-collection-tab__title">{{ $collection->name }}</span>
                </span>
            </a>
        </li>
    @endforeach
</ul>
