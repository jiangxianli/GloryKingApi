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
        <footer class="footer bg-info dker">
            <div id="jp_container_N">
                <div class="jp-type-playlist">
                    <div id="jplayer_N" class="jp-jplayer hide"></div>
                    <div class="jp-gui">
                        <div class="jp-video-play hide">
                            <a class="jp-video-play-icon">play</a>
                        </div>
                        <div class="jp-interface">
                            <div class="jp-controls">
                                <div><a class="jp-previous"><i class="icon-control-rewind i-lg"></i></a></div>
                                <div>
                                    <a class="jp-play"><i class="icon-control-play i-2x"></i></a>
                                    <a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
                                </div>
                                <div><a class="jp-next"><i class="icon-control-forward i-lg"></i></a></div>
                                <div class="hide"><a class="jp-stop"><i class="fa fa-stop"></i></a></div>
                                <div><a class="" data-toggle="dropdown" data-target="#playlist"><i class="icon-list"></i></a></div>
                                <div class="jp-progress hidden-xs">
                                    <div class="jp-seek-bar dk">
                                        <div class="jp-play-bar bg-info">
                                        </div>
                                        <div class="jp-title text-lt">
                                            <ul>
                                                <li></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
                                <div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
                                <div class="hidden-xs hidden-sm">
                                    <a class="jp-mute" title="mute"><i class="icon-volume-2"></i></a>
                                    <a class="jp-unmute hid" title="unmute"><i class="icon-volume-off"></i></a>
                                </div>
                                <div class="hidden-xs hidden-sm jp-volume">
                                    <div class="jp-volume-bar dk">
                                        <div class="jp-volume-bar-value lter"></div>
                                    </div>
                                </div>
                                <div>
                                    <a class="jp-shuffle" title="shuffle"><i class="icon-shuffle text-muted"></i></a>
                                    <a class="jp-shuffle-off hid" title="shuffle off"><i class="icon-shuffle text-lt"></i></a>
                                </div>
                                <div>
                                    <a class="jp-repeat" title="repeat"><i class="icon-loop text-muted"></i></a>
                                    <a class="jp-repeat-off hid" title="repeat off"><i class="icon-loop text-lt"></i></a>
                                </div>
                                <div class="hide">
                                    <a class="jp-full-screen" title="full screen"><i class="fa fa-expand"></i></a>
                                    <a class="jp-restore-screen" title="restore screen"><i class="fa fa-compress text-lt"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-playlist dropup" id="playlist">
                        <ul class="dropdown-menu aside-xl dker">
                            <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                            <li class="list-group-item"></li>
                        </ul>
                    </div>
                    <div class="jp-no-solution hide">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
@stop