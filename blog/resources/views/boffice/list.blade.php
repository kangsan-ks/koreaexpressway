@include('inc/as_header')
{{-- PC슬라이더 --}}
<div class="con_main">
    <form action="">
        @if(request()->segment(2) == 'gallery')
        <table>
            <colgroup>
                <col width="100">
                <col width="75">
                <col width="750">
                <col width="100">
                <col width="180">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>이미지</th>
                    <th>제목</th>
                    <th>등록일</th>
                    <th>기능</th>
                </tr>
            </thead>
            <tbody>
                @if ($totalCount == 0)
                    <tr>
                        <td colspan="4">게시글이 없습니다.</td>
                    </tr>
                @else
                    @foreach ($data as $data)
                    <tr>
                        <td>{{ $number-- }}</td>
                        <td><img width="75" height="75" src="/storage/app/images/{{ $data->real_file_name }}" alt=""></td>
                        <td>{{ $data->subject }}</td>
                        <td>{{ substr($data->reg_date, 0, 10) }}</td>
                        <td class="delete_box"><a href="">삭제</a><a href="/as_admin/{{ request()->segment(2) }}/modify?idx={{ $data->idx }}" style="background-color: #08AEEA; border:1px solid #0faeea; color: #fff;">수정</a></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @elseif(request()->segment(2) == 'notice')
        <table>
            <colgroup>
                <col width="100">
                <col width="700">
                <col width="250">
                <col width="180">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>등록일</th>
                    <th>기능</th>
                </tr>
            </thead>
            <tbody>
                @if ($totalCount == 0)
                    <tr>
                        <td colspan="4">게시글이 없습니다.</td>
                    </tr>
                @else
                    @foreach ($data as $data)
                    <tr>
                        <td>{{ $number-- }}</td>
                        <td>{{ $data->subject }}</td>
                        <td>{{ substr($data->reg_date, 0, 10) }}</td>
                        <td class="delete_box"><a href="">삭제</a><a href="/as_admin/{{ request()->segment(2) }}/modify?idx={{ $data->idx }}" style="background-color: #08AEEA; border:1px solid #0faeea; color: #fff;">수정</a></td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @elseif(request()->segment(2) == 'member')
        <table>
            <colgroup>
                <col width="100">
                <col width="920">
                <col width="180">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>아이디</th>
                    <th>기능</th>
                </tr>
            </thead>
            <tbody>
                @if ($totalCount == 0)
                    <tr>
                        <td colspan="4">게시글이 없습니다.</td>
                    </tr>
                @else
                @foreach ($data as $data)
                <tr>
                    <td>{{ $number-- }}</td>
                    <td>{{ $data->user_id }}</td>
                    <td class="delete_box"><a href="">삭제</a><a href="/as_admin/{{ request()->segment(2) }}/modify?idx={{ $data->idx }}" style="background-color: #08AEEA; border:1px solid #0faeea; color: #fff;">수정</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @elseif(request()->segment(2) == 'slide')
        <table>
            <colgroup>
                <col width="100">
                <col width="75">
                <col width="600">
                <col width="200">
                <col width="180">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>이미지</th>
                    <th>제목</th>
                    <th>등록일</th>
                    <th>기능</th>
                </tr>
            </thead>
            <tbody>
                @if ($totalCount == 0)
                    <tr>
                        <td colspan="4">게시글이 없습니다.</td>
                    </tr>
                @else
                @foreach ($data as $data)
                <tr>
                    <td>{{$number--}}</td>
                    <td><img width="75" height="75" src="/storage/app/images/{{$data->real_file_name}}" alt=""></td>
                    <td>{{$data->subject}}</td>
                    <td>{{substr($data->reg_date, 0, 10)}}</td>
                    <td class="delete_box"><a href="">삭제</a><a href="/as_admin/{{ request()->segment(2) }}/modify?idx={{ $data->idx }}" style="background-color: #08AEEA; border:1px solid #0faeea; color: #fff;">수정</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @elseif(request()->segment(2) == 'popup')
        <table>
            <colgroup>
                <col width="100">
                <col width="75">
                <col width="750">
                <col width="100">
                <col width="180">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>이미지</th>
                    <th>등록일</th>
                    <th>사용여부</th>
                    <th>기능</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>5</td>
                    <td class="delete_box"><a href="">삭제</a><a href="/as_admin/{{ request()->segment(2) }}/modify" style="background-color: #08AEEA; border:1px solid #0faeea; color: #fff;">수정</a></td>
                </tr>
            </tbody>
        </table>
        @else
        <table>
            <colgroup>
                <col width="100">
                <col width="75">
                <col width="600">
                <col width="200">
                <col width="180">
            </colgroup>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>이미지</th>
                    <th>제목</th>
                    <th>등록일</th>
                    <th>기능</th>
                </tr>
            </thead>
            <tbody>
                @if ($totalCount == 0)
                    <tr>
                        <td colspan="4">게시글이 없습니다.</td>
                    </tr>
                @else
                @foreach ($data as $data)
                <tr>
                    <td>{{$number--}}</td>
                    <td><img width="75" height="75" src="/storage/app/images/{{$data->real_file_name}}" alt=""></td>
                    <td>{{$data->subject}}</td>
                    <td>{{substr($data->reg_date, 0, 10)}}</td>
                    <td class="delete_box"><a href="">삭제</a><a href="/as_admin/{{ request()->segment(2) }}/modify?idx={{ $data->idx }}" style="background-color: #08AEEA; border:1px solid #0faeea; color: #fff;">수정</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        @endif
        <div class="paging">
			{!! $paging_view !!}
        </div>
        @if (request()->segment(2) != 'member')
        <div class="create" style="padding-bottom:10px;">
			<a href="/as_admin/{{ request()->segment(2) }}/write">등록</a>
            <!-- <a href="/ey_write_gallery">등록</a> -->
        </div>
        @endif
        
    </form>
</div>
<form name="search_form" action="{{ $_SERVER['REQUEST_URI'] }}" class="board_search_con" onsubmit="return search();">
    <input type="hidden" name="page" />
    <button></button>
</form>