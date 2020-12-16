@include('inc/head')
<div class="content_wrap inner search">
    <?php
        if(isset($_GET['search_value'])){
    ?>
    <div class="top_">
        <h2><span>‘<?=$_GET['search_value']?>’</span>에 대한 통합검색 결과입니다.</h2>
        <div class="search_box">
            <form action="/search/page_search">
                <select name="search_option" id="">
                    <option value="subject" <?=($_GET['search_option'] == 'subject') ? 'selected' : ''?>>제목</option>
                    <option value="contents" <?=($_GET['search_option'] == 'contents') ? 'selected' : ''?>>내용</option>
                </select>
                <input type="text" name="search_value" placeholder="검색어를 입력해주세요." value="<?=$_GET['search_value']?>">
                <button type="submit">
                    <img src="/img/search_ico.png" alt="">
                </button>
            </form>
        </div>
    </div>
    <div class="search_result_box">
        <div class="box">
            <h3>Press <span>({{ $list_press_cnt }}건)</span></h3>
            <ul>
                @foreach ($list_press as $list_press)
                <li>
                    <a href="/news/press/view?idx={{ $list_press->idx }}">
                        <h4>{{ $list_press->subject }}</h4>
                        {!! $list_press->contents !!}
                    </a>
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $list_press->real_file_name }}" alt="">
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="box">
            <h3>Event <span>({{ $list_event_cnt }}건)</span></h3>
            <ul>
                @foreach ($list_event as $list_event)
                <li>
                    <a href="/news/event/view?idx={{ $list_event->idx }}">
                        <h4>{{ $list_event->subject }}</h4>
                        {!! $list_event->contents !!}
                    </a>
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $list_event->real_file_name }}" alt="">
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="box">
            <h3>Start-up <span>{{ $list_start_cnt }}(건)</span></h3>
            <ul>
                @foreach ($list_start as $list_start)
                <li>
                    <a href="/news/startUp/view?idx={{ $list_start->idx }}">
                        <h4>{{ $list_start->subject }}</h4>
                        {!! $list_start->contents !!}
                    </a>
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $list_start->real_file_name }}" alt="">
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="box">
            <h3>Article <span>{{ $list_article_cnt }}(건)</span></h3>
            <ul>
                @foreach ($list_article as $list_article)
                <li>
                    <a href="/library/article/view?idx={{ $list_article->idx }}">
                        <h4>{{ $list_article->subject }}</h4>
                        {!! $list_article->contents !!}
                    </a>
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $list_article->real_file_name }}" alt="">
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="box">
            <h3>Report <span>{{ $list_report_cnt }}(건)</span></h3>
            <ul>
                @foreach ($list_report as $list_report)
                <li>
                    <a href="/library/report/view?idx={{ $list_report->idx }}">
                        <h4>{{ $list_report->subject }}</h4>
                        {!! $list_report->contents !!}
                    </a>
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $list_report->real_file_name }}" alt="">
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="box">
            <h3>Gallery <span>{{ $list_gallery_cnt }}(건)</span></h3>
            <ul>
                @foreach ($list_gallery as $list_gallery)
                <li>
                    <a href="/aboutUs/gallery/view?idx={{ $list_gallery->idx }}">
                        <h4>{{ $list_gallery->subject }}</h4>
                        {!! $list_gallery->contents !!}
                    </a>
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $list_gallery->real_file_name }}" alt="">
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <?php }else{ ?>
        <div class="top_">
            <h2>통합검색 페이지입니다.</h2>
            <div class="search_box">
                <form action="/search/page_search">
                    <select name="search_option" id="">
                        <option value="subject">제목</option>
                        <option value="contents">내용</option>
                    </select>
                    <input type="text" name="search_value" placeholder="검색어를 입력해주세요." value="">
                    <button type="submit">
                        <img src="/img/search_ico.png" alt="">
                    </button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
@include('inc/footer')