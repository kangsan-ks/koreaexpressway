<body>
    <script src="https://kit.fontawesome.com/7f5faa19ba.js" crossorigin="anonymous"></script>
    <div id="container">
        <div id="header">
            <div class="h_inner">
                <div class="logo">
                    <a href="/">
                        <img src="/img/logo.png" alt="logo.png">
                    </a>
                </div>
                <div class="nav_outer">
                    <div class="nav_list">
                        <a href="#none">News</a>
                    </div>
                    <div class="nav_list">
                        <a href="#none">Library</a>
                    </div>
                    <div class="nav_list">
                        <a href="#none">Project</a>
                    </div>
                    <div class="nav_list">
                        <a href="#none">About Us</a>
                    </div>
                    <div class="nav_list">
                        <a href="#none">Search</a>
                    </div>
                </div>
                <div class="lang_outer">
                    <ul>
                        <li>
                            <a href="">KR</a>
                        </li>
                        <li>
                            <a href="">EN</a>
                        </li>
                        <li>
                            <a href=""><img src="/img/send_ico.png" alt="">CONTACT US</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sub_nav_outer">
                <div class="sub_nav_box">
                    <ul>
                        <li>
                            <a href="/news/press/list">Press</a>
                        </li>
                        <li>
                            <a href="/news/event/list">Event</a>
                        </li>
                        <li>
                            <a href="/news/startUp/list">Start-up</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="/library/article/list">Article</a>
                        </li>
                        <li>
                            <a href="/library/report/list">Report</a>
                        </li>
                        <li>
                            <a href="/library/video/list">Video</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="/project/all">총괄</a>
                        </li>
                        <li>
                            <a href="/project/sub01">중점분야1</a>
                        </li>
                        <li>
                            <a href="/project/sub02">중점분야2</a>
                        </li>
                        <li>
                            <a href="/project/sub03">중점분야3</a>
                        </li>
                        <li>
                            <a href="/project/sub04">중점분야4</a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="/aboutUs/business">사업단 소개</a>
                        </li>
                        <li>
                            <a href="/aboutUs/organization">조직도</a>
                        </li>
                        <li>
                            <a href="/aboutUs/gallery/list">Gallery</a>
                        </li>
                    </ul>
                    <ul></ul>
                </div>
            </div>
            <script type="text/javascript">
                $('#header').hover(function(){
                    $('.sub_nav_outer').stop().slideDown(700);
                },function(){
                    $('.sub_nav_outer').stop().slideUp(700);
                });
            </script>
        </div>
        <div id="section">
            @if(request()->segment(1) != '')
            <div id="sub">
                <div class="sub_top_bg top_bg_{{ request()->segment(1) }}">
                    @if(request()->segment(1) == 'news')
                    <div class="text_box">
                        <h2>NEWS</h2>
                        <p>스마트 건설기술 관련 소식을 전해드립니다.</p>
                    </div>
                    @elseif(request()->segment(1) == 'library')
                    <div class="text_box">
                        <h2>LIBRARY</h2>
                        <p>스마트 건설사업단의 연구성과, 활동 내용을 알려드립니다.</p>
                    </div>
                    @elseif(request()->segment(1) == 'project')
                    <div class="text_box">
                        <h2>PROJECT</h2>
                        <p>스마트건설기술 개발사업 4개 중점분야, 12개 세부과제를 소개합니다.</p>
                    </div>
                    @elseif(request()->segment(1) == 'aboutUs')
                    <div class="text_box">
                        <h2>ABOUT US</h2>
                        <p>스마트건설 사업단 소개합니다.</p>
                    </div>
                    @elseif(request()->segment(1) == 'search')
                    <div class="text_box">
                        <h2>SEARCH</h2>
                        <p>스마트 건설기술 검색 내용입니다.</p>
                    </div>
                    @endif
                </div>
                <div class="inner sub_list">
                    @if(request()->segment(1) == 'news')
                    <ul class="list3">
                        <li class="@if(request()->segment(2) == 'press')on @endif">
                            <a href="/news/press/list">Press</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'event')on @endif">
                            <a href="/news/event/list">Event</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'startUp')on @endif">
                            <a href="/news/startUp/list">Start-up</a>
                        </li>
                    </ul>
                    @elseif(request()->segment(1) == 'library')
                    <ul class="list3">
                        <li class="@if(request()->segment(2) == 'article')on @endif">
                            <a href="/library/article/list">Article</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'report')on @endif">
                            <a href="/library/report/list">Report</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'video')on @endif">
                            <a href="/library/video/list">Video</a>
                        </li>
                    </ul>
                    @elseif(request()->segment(1) == 'project')
                    <ul class="list5">
                        <li class="@if(request()->segment(2) == 'all')on @endif">
                            <a href="/project/all">총괄</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'sub01')on @endif">
                            <a href="/project/sub01">중점분야1</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'sub02')on @endif">
                            <a href="/project/sub02">중점분야2</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'sub03')on @endif">
                            <a href="/project/sub03">중점분야3</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'sub04')on @endif">
                            <a href="/project/sub04">중점분야4</a>
                        </li>
                    </ul>
                    @elseif(request()->segment(1) == 'aboutUs')
                    <ul class="list3">
                        <li class="@if(request()->segment(2) == 'business')on @endif">
                            <a href="/aboutUs/business">사업단 소개</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'organization')on @endif">
                            <a href="/aboutUs/organization">조직도</a>
                        </li>
                        <span>ㅣ</span>
                        <li class="@if(request()->segment(2) == 'gallery')on @endif">
                            <a href="/aboutUs/gallery/list">Gallery</a>
                        </li>
                    </ul>
                    @endif
                </div>
                <div class="inner sub_inner">
                    @if(request()->segment(1) != 'search')
                    <div class="sub_page_title">
                        <ul>
                            <li><a href="/"><img src="/img/home_ico.png" alt=""></a></li>
                            <span>·</span>
                            <li class="color_gray"></li>
                            <span>·</span>
                            <li class="color_blue"></li>
                        </ul>
                        <h2 class="sub_page_subject">

                        </h2>
                        @if(request()->segment(1) == 'news' && request()->segment(2) != 'press' && request()->segment(3) == 'list')
                        <div class="list_style_tabs">
                            <a href="#none" class="on"><i class="fas fa-th-list"></i>LIST</a>
                            <a href="#none"><i class="fas fa-th-large"></i>CARD</a>
                        </div>
                        @endif
                        
                    </div>
                    @endif
                </div>
                <script type="text/javascript">
                    $(function(){
                        var sub_page_title01 = '{{ request()->segment(1) }}';
                        var sub_page_title02 = '{{ request()->segment(2) }}';

                        if(sub_page_title01 == 'aboutUs'){
                            sub_page_title01 = 'About us';
                        }
                        if(sub_page_title02 == 'all'){
                            sub_page_title02 = '총괄';
                        }
                        if(sub_page_title02 == 'sub01'){
                            sub_page_title02 = '중점분야1';
                        }
                        if(sub_page_title02 == 'sub02'){
                            sub_page_title02 = '중점분야2';
                        }
                        if(sub_page_title02 == 'sub03'){
                            sub_page_title02 = '중점분야3';
                        }
                        if(sub_page_title02 == 'sub04'){
                            sub_page_title02 = '중점분야4';
                        }
                        if(sub_page_title02 == 'organization'){
                            sub_page_title02 = '조직도';
                        }
                        $('.sub_page_title li').eq(1).text(sub_page_title01.toLowerCase())
                        $('.sub_page_title li').eq(2).text(sub_page_title02.toLowerCase())
                        $('.sub_page_subject').text(sub_page_title02.toLowerCase())
                    });
                </script>
            
            @endif