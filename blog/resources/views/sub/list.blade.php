@include('inc/head')
<div class="content_wrap inner">
    @if (request()->segment(2) == 'notice')
    <div class="list_style_01 list_style">
        <table>
            <thead>
                <tr>
                    <th class="table_no">No.</th>
                    <th class="table_title">Title</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="table_no">10</td>
                    <td class="table_title"><a href="#none">건설사 ‘데이터센터’ 잇단 도전장… 정부 ‘뒷짐’에 난항</a></td>
                    <td>2020-12-31</td>
                </tr>
                <tr>
                    <td class="table_no">10</td>
                    <td class="table_title"><a href="#none">건설사 ‘데이터센터’ 잇단 도전장… 정부 ‘뒷짐’에 난항</a></td>
                    <td>2020-12-31</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    @if(request()->segment(2) != 'press' && request()->segment(2) != 'article' && request()->segment(2) != 'report' && request()->segment(2) != 'video' && request()->segment(2) != 'gallery')
    <div class="list_style_02 list_style">
        <ul>
            @foreach ($data as $data)
            <li>
                <div class="left">
                    <a href="/{{ request()->segment(1).'/'.request()->segment(2).'/view?idx='.$data->idx }}">
                        <img src="/storage/app/images/{{ $data->real_file_name }}" alt="">
                    </a>
                </div>
                <div class="right">
                    <h4><a href="/{{ request()->segment(1).'/'.request()->segment(2).'/view?idx='.$data->idx }}">{{ $data->subject }}</a></h4>
                    @if(request()->segment(2) == 'event')
                    <span>일정 : {{ $data->start_period }} ~ {{ $data->end_period }}</span>
                    @else
                    <span>{{ $data->start_period }}</span>
                    @endif
                    {!! $data->contents !!}
                </div>
            </li>
            @endforeach
            
        </ul>
    </div>
    @endif
    @if(request()->segment(2) != 'press')
    <div class="list_style_03 list_style">
        <ul class="flex_box">
            @foreach ($data2 as $data2)
            <li>
                @if (request()->segment(2) == 'video')
                <a href="{{ $data2->link_value }}" target="blank">
                @else
                <a href="/{{ request()->segment(1).'/'.request()->segment(2).'/view?idx='.$data2->idx }}">
                @endif
                    <div class="img_box">
                        <img src="/storage/app/images/{{ $data2->real_file_name }}" alt="">
                    </div>
                    <div class="text_box">
                        <h4>{{ $data2->subject }}</h4>
                        @if($data2->end_period != '')
                        <span>{{ $data2->start_period }} ~ {{ $data2->end_period }}</span>
                        @else
                        <span>{{ $data2->start_period }}</span>
                        @endif
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (request()->segment(2) == 'press')
    <div class="list_style_04 list_style flex_box">
        <div class="date_line mo_none">
            <ul>
                @foreach ($data as $data)
                    <li>{{ $data->start_period }}</li>
                @endforeach
            </ul>
        </div>
        <div class="bar_line mo_none"></div>
        <div class="content_line mo_none">
            <ul>
                @foreach ($data2 as $data2)
                <li>
                    <h4><a href="{{ $data2->link_value }}" target="blank">{{ $data2->subject }}</a></h4>
                    <span><img src="/storage/app/images/{{ $data2->real_file_name }}" alt=""> ㅣ {{ $data2->start_period }}</span>
                    {!! $data2->contents !!}
                </li>
                @endforeach
                
                {{-- <li>
                    <h4><a href="#none">건설사 ‘데이터센터’ 잇단 도전장… 정부 ‘뒷짐’에 난항</a></h4>
                    <span><img src="/img/list_style_04_img01.png" alt=""> ㅣ 2020-10-28</span>
                    <p>
                        네이버가 세종시에 조성하는 제2 데이터센터 조감도.  IT 기업들이 주도하던 시장 GSㆍ현대ㆍSK건설ㆍ효성重 등 ‘개발ㆍ시공ㆍ운영’ 나섰지만 민원에 부지조성부터 ‘발목’ 사업추진 제도적 지원 미비 # 지난해 6월 네이버가 경기 용인시 기흥구에 조성하려던 ‘제2 데이터센터’ 사업이 무산됐다네이버가 세종시에 조성하는 제2 데이터센터 조감도.  IT 기업들이 주도하던 시장 GSㆍ현대ㆍSK건설ㆍ효성重 등 ‘개발ㆍ시공ㆍ운영’ 나섰지만 민원에 부지조성부터 ‘발목’ 사업추진 제도적 지원 미비 # 지난해 6월 네이버가 경기 용인시 기흥구에 조성하려던 ‘제2 데이터센터’ 사업이 무산됐다
                    </p>
                </li> --}}
            </ul>
        </div>
        <div class="mo_block">
            @foreach ($data3 as $data3)
            <div class="date_line">
                <p>{{ $data3->start_period }}</p>
            </div>
            <div class="content_line">
                <h4><a href="{{ $data3->link_value }}" target="blank">{{ $data3->subject }}</a></h4>
                <span><img src="/storage/app/images/{{ $data3->real_file_name }}" alt=""> ㅣ {{ $data3->start_period }}</span>
                {!! $data3->contents !!}
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <div class="paging">
        {!! $paging_view !!}
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#sub .list_style_04 .bar_line').height($('#sub .list_style_04').height());

        function list_tab(){
            if($('.list_style_tabs a').eq(0).hasClass('on') == true){
                $('.list_style_03').hide();
                $('.list_style_02').show();
            }else{
                $('.list_style_02').hide();
                $('.list_style_03').show();
            }
        }

        list_tab();

        $('.list_style_tabs a').click(function(){
            $('.list_style_tabs a').removeClass('on');
            $(this).addClass('on');
            list_tab();
        })
    });
</script>
@include('inc/footer')