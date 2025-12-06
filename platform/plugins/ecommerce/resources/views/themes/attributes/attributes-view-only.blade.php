@if ($allAttributes->isNotEmpty())
    <div class="bb-product-attribute-list d-inline-block">
        @if (in_array($attributeSet->display_layout, ['text', 'dropdown']))
            <ul class="d-flex flex-wrap gap-2 list-unstyled mb-0">
                @foreach ($allAttributes as $attribute)
                    <li class="bg-body-tertiary border px-2 {{ in_array($attribute->id, $productAttributes) ? 'available' : 'unavailable' }}">
                        {{ $attribute->title }}
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="bb-product-attribute-swatch-list visual-swatch color-swatch attribute-swatch">
                @foreach ($allAttributes as $attribute)
                    <li class="bb-product-attribute-swatch-item attribute-swatch-item {{ in_array($attribute->id, $productAttributes) ? 'available' : 'unavailable' }}">
                        <label>
                            @if ($attribute->image)
                                {{ RvMedia::image($attribute->image, $attribute->title, attributes: ['class' => 'rounded-pill']) }}
                            @else
                                <span class="color-swatch-item" data-color="{{ $attribute->color }}" style="background-color: {{ $attribute->color }} !important;"></span>
                            @endif
                            <div class="bb-product-attribute-swatch-item-tooltip">{{ $attribute->title }}</div>
                        </label>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@else
    &mdash;
@endif

<style>
.color-swatch-item {
    border: none !important;
    transition: border 0.3s ease;
}

.color-swatch-item.has-border {
    border: 1px solid #333 !important;
}

/* Style for available attributes */
.bb-product-attribute-swatch-item.available {
    opacity: 1;
}

.bb-product-attribute-swatch-item.unavailable {
    opacity: 0.5;
}

/* Style for text attributes */
li.available {
    opacity: 1;
}

li.unavailable {
    opacity: 0.5;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to add borders to different colors in compare table
    function addBordersToDifferentColors() {
        const compareTable = document.querySelector('.compare-table, .table__compare');
        if (!compareTable) return;
        
        const rows = compareTable.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const colorSwatches = row.querySelectorAll('.color-swatch-item');
            if (colorSwatches.length <= 1) return; // Skip if only one or no color swatches
            
            const colors = Array.from(colorSwatches).map(swatch => {
                const color = swatch.getAttribute('data-color');
                return color ? color.toLowerCase().trim() : '';
            }).filter(color => color !== '');
            
            // Check if colors are different
            const uniqueColors = [...new Set(colors)];
            if (uniqueColors.length > 1) {
                // Add border to all color swatches in this row
                colorSwatches.forEach(swatch => {
                    swatch.classList.add('has-border');
                });
            }
        });
    }
    
    // Run the function
    addBordersToDifferentColors();
    
    // Re-run when content changes (for dynamic content)
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                addBordersToDifferentColors();
            }
        });
    });
    
    const compareContainer = document.querySelector('.compare-table, .table__compare, .compare_box');
    if (compareContainer) {
        observer.observe(compareContainer, { childList: true, subtree: true });
    }
});
</script>

