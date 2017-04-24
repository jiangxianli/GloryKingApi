@extends('admin.layout.html')

@section('content')
    <section class="vbox">
        <section class="w-f-md" id="bjax-target">
            <section class="hbox stretch">
                <!-- side content -->
                <aside class="aside bg-light dk" id="sidebar">
                    <section class="vbox animated fadeInUp">
                        <section class="scrollable hover">
                            <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
                                <a href="{{ action('Admin\HeroController@getHeroList') }}" class="list-group-item {{ $hero_type_id == 0 ? 'active' : '' }}">
                                    所有英雄
                                </a>
                                @foreach($hero_type as $item)
                                <a href="{{ action('Admin\HeroController@getHeroList',['type_id'=>$item->id,'hero_type'=>$item->name]) }}" class="list-group-item {{ $hero_type_id == $item->id ? 'active' : '' }}">
                                    {{ $item->name }}
                                </a>
                                @endforeach
                                <a href="{{ action('Admin\HeroTypeController@getAdd') }}" class="btn btn-sm btn-default list-group-item">
                                    <i class="fa fa-plus text"></i>
                                    <span class="text">More</span>
                                </a>
                            </div>
                        </section>
                    </section>
                </aside>
                <!-- / side content -->
                <section>
                    <section class="vbox">
                        <section class="scrollable padder-lg">
                            <h2 class="font-thin m-b">
                                {{ array_get($_GET,'hero_type','所有英雄') }}
                                <a href="{{ action('Admin\HeroController@getAddHero') }}" class="btn btn-info pull-right">
                                    <i class="fa fa-css3"></i> 新增英雄
                                </a>
                            </h2>
                            <div class="row row-sm">
                                @foreach($hero as $item)
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="item">
                                        <div class="pos-rlt">
                                            <div class="item-overlay opacity r r-2x bg-black">
                                                <div class="center text-center m-t-n">
                                                    <a href="#"><i class="fa fa-play-circle i-2x"></i></a>
                                                </div>
                                            </div>
                                            <a href="track-detail.html"><img src="{{ $item->getImageSrc() }}" alt="" class="r r-2x img-full"></a>
                                        </div>
                                        <div class="padder-v">
                                            <a href="{{ action('Admin\HeroController@getEditHero',['id'=>$item->id])  }}" class="text-ellipsis">{{ $item->name }}</a>
                                            {{--<a href="track-detail.html" data-bjax data-target="#bjax-target" data-el="#bjax-el" data-replace="true" class="text-ellipsis text-xs text-muted">Miaow</a>--}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{ $hero->appends($_GET)->links() }}
                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
    {{--<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>--}}
@stop