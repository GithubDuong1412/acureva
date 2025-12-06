<div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
    <div class="widget">
        <h3 class="widget_title">{{ $config['name'] }}</h3>
        {!!
            Menu::generateMenu(['slug' => $config['menu_id'], 'options' => ['class' => 'widget_links']])
        !!}
    </div>
</div>
