<?php Theme::set('pageName', $page->name) ?>

<div id="app">
    <?php if($page->template === 'homepage'): ?>
         <?php echo apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, Html::tag('div', BaseHelper::clean($page->content), ['class' => 
'ck-content'])->toHtml(), $page); ?>

    <?php else: ?>
        <div class="section">
            <div class="container">
                <?php echo apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, Html::tag('div', BaseHelper::clean($page->content), ['class' => 
'ck-content'])->toHtml(), $page); ?>

            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\acureva\platform\themes/shopwise/views/page.blade.php ENDPATH**/ ?>