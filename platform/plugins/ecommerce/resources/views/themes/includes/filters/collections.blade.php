@if ($collections->isNotEmpty())
    <div class="bb-product-filter">
        <h4 class="bb-product-filter-title">{{ __('Collections') }}</h4>

        <div class="bb-product-filter-content">
            <ul class="bb-product-filter-items filter-checkbox">
                @php
                    $requestCollections = (array) EcommerceHelper::parseFilterParams(request(), 'collections');
                @endphp

                @foreach ($collections as $collection)
                    <li class="bb-product-filter-item">
                        <input id="attribute-collection-{{ $collection->id }}"
                               type="checkbox"
                               name="collections[]"
                               value="{{ $collection->id }}"
                               @checked(in_array($collection->id, $requestCollections))>
                        <label for="attribute-collection-{{ $collection->id }}">
                            {{ $collection->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
