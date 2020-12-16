@include('inc/head')
{{-- <script src="/js/vue.min.js"></script> --}}
<?php include $_SERVER['DOCUMENT_ROOT']."/popup.php"; ?>
<div id="pop_bg">
    <div class="bg_inner">
        <div class="close_btn">x</div>
    <iframe id="" src="" frameborder="0"></iframe>
    </div>
    
</div>
<div id="main">
    <div class="swiper-container main_slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="/img/main_slide01.png" alt="">
                <div class="slide_inner">
                    <div class="txt">
                        <h3>스마트 건설기술이란</h3>
                    </div>
                    <div class="txt">
                        <p>
                            스마트 건설기술을 접·목활용하고 데이터 기반의 엔지니어링을 구현하여 건설 생산성과 안전성을
                            획기적으로 향상시키며, 운·영유지관리를 포함한 全생애주기 프로세스의 디지털 전환을 도모하는 건설 방식입니다.
                        </p>
                    </div>
                    <div class="link_box">
                        <a href="" class="">PROHECT VIEW <img src="/img/link_go_ico.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="/img/main_slide02.png" alt="">
            </div>
        </div>
        <div class="swiper-pagination inner"></div>
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
    <div class="news_slide_outer">
        <div class="inner flex_box">
            <div class="subject">
                <h3>News-press</h3>
            </div>
            <div class="news_slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($press as $press)
                    <div class="swiper-slide">
                        <p>{{ $press->subject }}</p>
                        <a href="/news/press/view?idx={{ $press->idx }}">more view</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="nav">
                <span class="slide-prev">
                    <img src="/img/news_slider_up.png" alt="">
                </span>
                <span class="slide-next">
                    <img src="/img/news_slider_down.png" alt="">
                </span>
            </div>
        </div>
    </div>
    <div class="latest_outer">
        <div class="inner">
            <div class="subject_box">
                <h3>Latest</h3>
            </div>
            <div class="swiper-container latest_slider">
                <div class="swiper-wrapper">
                    @foreach ($latest as $latest)
                    <div class="swiper-slide">
                        <div class="img_box">
                            <img src="/storage/app/images/{{ $latest->real_file_name }}" alt="">
                        </div>
                        <div class="slide_inner">
                            <div class="txt">
                                <h3>{{ $latest->subject }}</h3>
                            </div>
                            <div class="txt">
                                <p>
                                    {!! $latest->contents !!}
                                </p>
                            </div>
                            <div class="link_box">
                                @php
                                    if($latest->board_type == 'event'){
                                        $first_url = 'news';
                                    }else{
                                        $first_url = 'library';
                                    }
                                @endphp
                                <a href="/{{$first_url}}/{{ $latest->board_type }}/view?idx={{ $latest->idx }}" class="ft_mt">VIEW MORE +</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next swiper-button-black"></div>
                <div class="swiper-button-prev swiper-button-black"></div>
            </div>
            <ul class="flex_box">
                @foreach ($latest2 as $latest2)
                <li>
                    <a href="/news/press/view?idx={{ $latest2->idx }}">
                        <div class="img_box">
                            <img src="/storage/app/images/{{ $latest2->real_file_name }}" alt="">
                        </div>
                        <div class="text_box">
                            <p class="text_ec">{{ $latest2->subject }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
                {{-- <li>
                    <a href="#none">
                        <div class="img_box">
                            <img src="/img/latest_slider02.png" alt="">
                        </div>
                        <div class="text_box">
                            <p class="text_ec">ljhkafljkhfahjklfdhljkfajkhlafhjlk</p>
                        </div>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
    <div class="video_sec">
        <div class="inner">
            <div class="subject_box">
                <h3>Video <a href="/library/video/list" class="subject_more">VIEW MORE+</a></h3>
            </div>
            <div class="video_inner flex_box">
                <div class="left">
                    
                    <div class="img_box">
                        <img class="video_view" src="/storage/app/images/{{ $video_first->real_file_name }}" alt="" data-video-url="{{ $video_first->link_value }}">
                    </div>
                    <div class="text_box">
                        <p class="subject text_ec">
                            {{ $video_first->subject }}
                        </p>
                        <p class="hash_tag text_ec">
                            {{ $video_first->hash_tag }}
                        </p>
                    </div>
                </div>
                <div class="right m_flex_box">
                    @foreach ($video as $video)
                    <div class="">
                        <div class="img_box">
                            <img class="video_view" src="/storage/app/images/{{ $video->real_file_name }}" alt="" data-video-url="{{ $video->link_value }}">
                        </div>
                        <div class="text_box mb">
                            <p class="subject text_ec">
                                {{ $video->subject }}
                            </p>
                        </div>
                    </div>
                    @endforeach

                    {{-- <div class="img_box">
                        <img src="/img/video_img01.png" alt="">
                    </div>
                    <div class="text_box">
                        <p class="subject text_ec">
                            [건설통통TV] 건설산업을 진화시킨 최신 기술들(4차산업혁명을 ...[건설통통TV] 건설산업을 진화시킨 최신 기술들(4차산업혁명을 ...
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    // vue js
    

    $('.video_view').click(function(){
            var src = $(this).attr('data-video-url');
            var cut_idx = src.indexOf('watch?v=');
            var src_new = src.substr(cut_idx+8,30);
            $('#pop_bg iframe').attr('src', 'https://www.youtube.com/embed/'+src_new);
            $('#pop_bg').show();
            var iframe_width = $('#pop_bg iframe').width();
            $('#pop_bg iframe').css({height:iframe_width*0.6+'px'});
            // $(this).css('<img src="//img.youtube.com/vi/'+src_new+'/mqdefault.jpg" alt="사진"> "');
    });

    $('.close_btn').click(function(){
        $('#pop_bg iframe').attr('src','');
        $('#pop_bg').hide();
    });

    var mySwiper = new Swiper('.main_slider', {
        // Optional parameters
        effect: 'fade',
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        navigation: {
            nextEl: '.main_slider .swiper-button-next',
            prevEl: '.main_slider .swiper-button-prev',
        },
    });

    var swiper = new Swiper('.news_slider', {
        direction: 'vertical',
        loop: true,
        speed: 500,
        autoplay: {
            delay: 2000,
        },
        spaceBetween: 20,
        navigation: {
            nextEl: '.nav .slide-next',
            prevEl: '.nav .slide-prev',
        },
    });

    var swiper = new Swiper('.latest_slider', {
        effect: 'fade',
        loop: true,
        speed: 500,
        autoplay: {
            delay: 2000,
        },
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@include('inc/footer')