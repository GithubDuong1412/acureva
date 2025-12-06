@php Theme::set('pageName', __('Blog')) @endphp

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-xl-9">
                <div class="single_post">
                    <h2 class="blog_title">{{ $post->name }}</h2>
                    <ul class="list_none blog_meta">
                        <li><i class="ti-calendar"></i> {{ Theme::formatDate($post->created_at) }}</li>
                        <li><i class="ti-pencil-alt"></i>
                            @if (!$post->categories->isEmpty())
                                @foreach($post->categories as $category)
                                    <a href="{{ $category->url }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                                @endforeach
                            @endif
                        </li>
                        <li><i class="ti-eye"></i> {{ number_format($post->views) }} {{ __('Views') }}</li>
                    </ul>
                    <div class="blog_img">
                        <img src="{{ RvMedia::getImageUrl($post->image, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}" loading="lazy" />
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                             <div class="ck-content">{!! BaseHelper::clean($post->content) !!}</div>
                            <div class="blog_post_footer">
                                <div class="tags">
                                    @if (!$post->tags->isEmpty())
                                        @foreach ($post->tags as $tag)
                                            <a href="{{ $tag->url }}">{{ $tag->name }}</a>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="product_share">
                                    <span>{{ __('Share') }}:</span>
                                    {!! Theme::renderSocialSharing($post->url, SeoHelper::getDescription(), $post->image) !!}
                                </div>
                            </div>
                            <br>
                            {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}
                        </div>
                    </div>
                </div>
                @php $relatedPosts = get_related_posts($post->id, 2); @endphp

                @if ($relatedPosts->count())
                    <br>
                    <div class="related_post">
                        <div class="content_title">
                            <h5>{{ __('Related posts') }}</h5>
                        </div>
                        <div class="row">
                            @foreach ($relatedPosts as $relatedItem)
                                <div class="col-md-6">
                                    <div class="blog_post blog_style2 box_shadow1">
                                        <div class="blog_img">
                                            <a href="{{ $relatedItem->url }}"><img src="{{ RvMedia::getImageUrl($relatedItem->image, 'small', false, RvMedia::getDefaultImage()) }}" alt="{{ $relatedItem->name }}" loading="lazy" /></a>
                                        </div>
                                        <div class="blog_content bg-white">
                                            <div class="blog_text">
                                                <h3 class="blog_title"><a href="{{ $relatedItem->url }}">{{ $relatedItem->name }}</a></h3>
                                                <ul class="list_none blog_meta">
                                                    <li><i class="ti-calendar"></i> {{ Theme::formatDate($relatedItem->created_at) }}</li>
                                                    <li><i class="ti-eye"></i> {{ number_format($relatedItem->views) }} {{ __('Views') }}</li>
                                                </ul>
                                                <p>{{ Str::limit($relatedItem->description, 110) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-xl-3 mt-4 pt-2 mt-xl-0 pt-xl-0">
                <div class="sidebar">
                    {!! dynamic_sidebar('primary_sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</div>
