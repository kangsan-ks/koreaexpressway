@include('inc/head')
{{-- <script src="/js/vue.min.js"></script> --}}
<?php include $_SERVER['DOCUMENT_ROOT']."/popup.php"; ?>
<script src="/js/jquery.rwdImageMaps.min.js"></script>
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
                <img src="/img/main_slide03.png" alt="">
                <div class="slide_inner">
                    <div class="txt color_navy">
                        <h3>
                            <b>“스마트 건설”</b>은 디지털 전환을 통해
                            <br/>건설사업의 미래를 열 돌파구입니다.
                        </h3>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="/img/main_slide01.png" alt="">
                <div class="slide_inner">
                    <div class="txt">
                        <h3>스마트 건설기술이란</h3>
                    </div>
                    <div class="txt">
                        <p>
                            스마트 건설기술을 접목 활용하고 데이터 기반의 엔지니어링을 구현하여 건설 생산성과 안전성을
                            획기적으로 향상시키며, 운영유지관리를 포함한 全생애주기 프로세스의 디지털 전환을 도모하는 건설 방식입니다.
                        </p>
                    </div>
                    <div class="link_box">
                        <a href="http://smartconstruction.kr/project/all" class="">PROJECT VIEW <img src="/img/link_go_ico.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="/img/main_slide02.png" alt="">
                <div class="slide_inner">
                    <div class="txt">
                        <img class="mo_none" src="/img/main_slide02_sub.png" alt="" usemap="#map1">
                        <img class="mo_block" src="/img/m_main_slide02_sub.png" alt="" usemap="#map2">
                    </div>
                </div>
                <map name="map1">
                    <area shape="rect" coords="0,235,125,325" href="http://smartconstruction.kr/project/sub01">
                    <area shape="rect" coords="145,235,280,325" href="http://smartconstruction.kr/project/sub02">
                    <area shape="rect" coords="290,235,415,325" href="http://smartconstruction.kr/project/sub03">
                    <area shape="rect" coords="435,235,560,325" href="http://smartconstruction.kr/project/sub04">
                </map>
                <map name="map2">
                    <area shape="rect" coords="0,535,225,695" href="http://smartconstruction.kr/project/sub01">
                    <area shape="rect" coords="270,535,500,695" href="http://smartconstruction.kr/project/sub02">
                    <area shape="rect" coords="0,720,225,875" href="http://smartconstruction.kr/project/sub03">
                    <area shape="rect" coords="270,720,500,875" href="http://smartconstruction.kr/project/sub04">
                </map>
            </div>
        </div>
        <div class="swiper-pagination inner"></div>
        <div class="swiper-button-next swiper-button-white"></div>
        <div class="swiper-button-prev swiper-button-white"></div>
    </div>
    <div class="greeting_box">
        <div class="inner flex_box">
            <div class="left">
                <img src="/img/main_greeting.png" alt="">
            </div>
            <div class="right">
                <div class="subject_box mo_block">
                    <h3>Greeting</h3>
                </div>
                <div class="top">
                    <p><b>한국도로공사</b>가 기업, 연구기관, 대학들과 함께, 스마트 건설기술의 개발과 실용화를 통해</p>
                    <h3>건설사업의 디지털 시대를 열겠습니다.</h3>
                </div>
                <div class="bot">
                    <p>
                        스마트 건설기술 개발 R&D사업의 총괄기관인 한국도로공사는 개발 기술의 실용화와 현장 적용에 집중하여 건설사업의 디지털 전환을 촉진하고,
                        우리 기업들이 축적된 디지털 역량을 바탕으로 그로벌 시장에 진출하도록 돕겠습니다.<br/>
                        기술새발 성과가 연구실의 문턱을 넘어 산업 현장에서 쓰일 수 있도록 고속도로 건설 프로젝트를 활용하는 ‘건설발주연계 R&D’를 추진하고,
                        기술의 범용화를 통해 도로기반기술을 활용하는 다른 SOC 부문으로도 그 성과가 확장되도록 하겠습니다.<br/>
                        또한, 포스트-코로나 시대를 대비하여 ‘SOC 디지털화’의 실현은 물론, 디지털 데이터와 플랫폼이 주도하는 새로운 건설 생태계 조성에도 기여하여,
                        스타트업과 벤처가 유니콘 건설 기업으로 성장하도록 노력하겠습니다.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="news_slide_outer">
        <div class="inner flex_box">
            <div class="subject">
                <h3>스마트건설 뉴스</h3>
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
            <div class="swiper-container latest_slider_top">
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
                            <div class="txt txt23">
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
            </div>
            <div class="swiper-container latest_slider">
                <div class="swiper-wrapper">
                    @foreach ($latest2 as $latest2)
                    <div class="swiper-slide">
                        <div class="img_box">
                            <img src="/storage/app/images/{{ $latest2->real_file_name }}" alt="">
                        </div>
                        <div class="txt">
                            <h3>{{ $latest2->subject }}</h3>
                        </div>
                        <div class="txt txt23">
                            <p>
								작성자 : {{ $latest2->writer }}<br/>{{ substr($latest2->reg_date, 0, 10) }}
								
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="latest_slider_nav">
                <div class="swiper-button-next swiper-button-black"></div>
                <div class="swiper-button-prev swiper-button-black"></div>
            </div>
            {{-- <div class="swiper-container latest_slider">
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
                            <div class="txt txt23">
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
            <div class="paging_box">
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
                </ul>
            </div> --}}
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
                        <iframe class="you_frame" src="{{ $video_first->link_value }}" frameborder="0" width="100%"></iframe>
                        {{-- <img class="" src="/storage/app/images/{{ $video_first->real_file_name }}" alt="" data-video-url="{{ $video_first->link_value }}"> --}}
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

    $(function(){
        $('img[usemap]').rwdImageMaps();
    });

    $('#main .swiper-slide .txt23').each(function(){
        $(this).children().each(function(){
            $('#main .swiper-slide .txt23').children().not('p').remove();
            var text = $.trim($(this).text());
            
            if(text.length == 0){
                $(this).remove();
            }
            // console.log(text);
            // console.log(text.length);
        });
    });

    $('.you_frame').each(function(){
        var src = $(this).attr('src');
        // console.log(src)
        // var src = $(a).find('iframe').attr('src');
        var cut_idx = src.indexOf('watch?v=');
        var src_new = src.substr(cut_idx+8,30);
        $(this).attr('src', 'https://www.youtube.com/embed/'+src_new);
        $(this).height($(this).width()*0.5623)
    });
    
    $('.video_view').each(function(){
        var src = $(this).attr('data-video-url');
        // console.log(src)
        // var src = $(a).find('iframe').attr('src');
            var cut_idx = src.indexOf('watch?v=');
            var src_new = src.substr(cut_idx+8,30);
            $(this).attr('src', '//img.youtube.com/vi/'+src_new+'/maxresdefault.jpg');
            
            // $(this).css({backgroundImage: 'url(//img.youtube.com/vi/'+src_new+'/mqdefault.jpg)'});
    });

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

    var galleryThumbs = new Swiper('.latest_slider', {
        spaceBetween: 10,
        slidesPerView: 4,
        breakpointsInverse: true,
        freeMode: true,
        loopedSlides: 5, //looped slides should be the same
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 2,
      spaceBetween: 20
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 30
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 40
    }
  }
    });

    var galleryTop = new Swiper('.latest_slider_top', {
        spaceBetween: 10,
        loopedSlides: 5, //looped slides should be the same
        navigation: {
            nextEl: '.latest_slider_nav .swiper-button-next',
            prevEl: '.latest_slider_nav .swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });
</script>
@include('inc/footer')