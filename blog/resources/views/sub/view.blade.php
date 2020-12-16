@include('inc/head')
<div class="content_wrap inner">
    <div class="view_box">
        <div class="view_title_box">
            <div class="view_inner">
                <h3>{{ $data->subject }}</h3>
                <p>
                    <b>등록자 : </b>
                    {{ $data->writer }}
                    <b>날짜 : </b>
                    {{ $data->start_period }}
                </p>
            </div>
            @if($data->link_value != '')
            <div class="link_box">
                <p>
                    <a href="#none" class="view_inner"><img src="/img/link_ico.png" alt=""> {{$data->link_value}}</a>
                </p>
            </div>
            @endif
        </div>
        <div class="view_body_box view_inner">
            {!! $data->contents !!}
        </div>
        <div class="paging_board">
            <ul>
                @if($file_check == true)
                @foreach ($data_file_info as $data_file_info)
                    
                
                <li class="file_items">
                    <img src="/img/download_ico.png" alt="">
                    <a href="/storage/app/images/{{ $data_file_info->real_file_name }}" download="{{ $data_file_info->file_name }}" target="_blank">{{ $data_file_info->file_name }}</a>
                </li>
                @endforeach
                @endif
                @if($prev_item_check == true)
                <li class="view_inner">
                    <img src="/img/paging_board_up.png" alt=""><p>이전글</p><a href="/{{ request()->segment(1).'/'.request()->segment(2).'/view?idx='.$data_prev->idx }}">이전글입니다.</a>
                </li>
                @endif
                @if($next_item_check == true)
                <li class="view_inner">
                    <img src="/img/paging_board_down.png" alt=""><p>다음글</p><a href="/{{ request()->segment(1).'/'.request()->segment(2).'/view?idx='.$data_next->idx }}">다음글입니다.</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="go_back_btn">
            <a href="/{{ request()->segment(1).'/'.request()->segment(2).'/list' }}">목록</a>
        </div>
    </div>
</div>
@include('inc/footer')