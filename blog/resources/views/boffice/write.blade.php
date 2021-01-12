@include('inc/as_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
<div class="con_main">
    @if(request()->segment(3) == 'modify')
    <form action="/as_admin/{{ request()->segment(2) }}/write_action" name="board_write_form" method="post" enctype="multipart/form-data" @if(request()->segment(2) == 'member') onsubmit="return passcheck()" @endif>
        {{ csrf_field() }}
        <input type="hidden" name="board_idx" value="{{ request()->idx }}" />
		<input type="hidden" name="board_type" value="{{ request()->segment(2) }}" />
        <input type="hidden" name="write_type" value="{{ request()->segment(3) }}" />
        <input type="hidden" name="writer" value="{{ session('user_id') }}" />
        <input type="hidden" name="parent_idx" value="{{ session('user_idx') }}" />
        @if (request()->segment(2) == 'popup')
        <div class="write_box">
            <div class="write_line">
                <div class="all_line all_line_top">
                    <div class="line_title">
                        카테고리
                    </div>
                    <div class="line_content">
						<input type="text" name="category" value="popup" readonly style="border:none;" />
                    </div>
                </div>
			</div>
			<div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        제목
                    </div>
                    <div class="line_content">
                        <input type="text" name="subject" value="{{ $data->title }}" />
                    </div>
                </div>
            </div>
            <div class="write_line cate_file">
                <div class="all_line">
                    <div class="line_title">
                        팝업위치
                    </div>
                    <div class="line_content">
                        <label for="lefttop"><input type="radio" name="pop_position" id="lefttop" value="lefttop" @if ($data->pop_position == 'lefttop') checked @endif/>좌측상단</label>
                        <label for="righttop"><input type="radio" name="pop_position" id="righttop" value="righttop" @if ($data->pop_position == 'righttop') checked @endif/>우측상단</label>
                        <label for="leftbot"><input type="radio" name="pop_position" id="leftbot" value="leftbot" @if ($data->pop_position == 'leftbot') checked @endif/>좌측하단</label>
                        <label for="rightbot"><input type="radio" name="pop_position" id="rightbot" value="rightbot" @if ($data->pop_position == 'rightbot') checked @endif/>우측하단</label>
                    </div>
                </div>
            </div>
            <div class="write_line cate_file">
                <div class="all_line">
                    <div class="line_title">
                        팝업크기
                    </div>
                    <div class="line_content">
                        가로 : <input type="number" name="i_width" value="{{ $data->i_width }}" />
                        세로 : <input type="number" name="i_height" value="{{ $data->i_height }}" />
                    </div>
                </div>
            </div>
            <div class="write_line cate_file">
                <div class="all_line">
                    <div class="line_title">
                        팝업여백
                    </div>
                    <div class="line_content">
                        가로 : <input type="number" name="m_width" value="{{ $data->m_width }}" />
                        세로 : <input type="number" name="m_height" value="{{ $data->m_height }}" />
                    </div>
                </div>
            </div>
            <span id="append_target">
                <div class="write_line cate_file">
                    <div class="all_line">
                        <div class="line_title">
                            파일선택
                        </div>
                        <div class="line_content">
                            <input type="file" name="writer_file[]" /><a target="blank" href="">[파일미리보기]</a>
                        </div>
                    </div>
                </div>
            </span>

			<div class="write_line cate_file">
				<div class="all_line all_line_bottom">
					<div class="line_title">
						노출여부
					</div>
					<div class="line_content">
						<label for="see1"><input type="radio" id="see1" name="use_status" value="Y" @if ($data->see == 'Y') checked @endif> 사용</label>
						<label for="see2"><input type="radio" id="see2" name="use_status" value="N" @if ($data->see == 'N') checked @endif> 중지</label>
					</div>
				</div>
			</div>
            <div class="submit_box" style="text-align:center;margin-top:10px;">
                <input type="submit" value="등록">
                <input type="reset" value="취소">
            </div>
        </div>
        @else
        @if (request()->segment(2) != 'member')
        <div class="write_box">
            <div class="write_line">
                <div class="all_line all_line_top">
                    <div class="line_title">
                        제목
                    </div>
                    <div class="line_content">
                    <input type="text" name="subject" value="{{ $data->subject }}" />
                    </div>
                </div>
            </div>
            @if(request()->segment(2) != 'slide' && request()->segment(2) != 'video')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title" style="vertical-align: top;">
                        내용
                    </div>
                    <div class="line_content">
                    <textarea id="editor" name="contents" cols="60" rows="10" style="">{!! $data->contents !!}</textarea>
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) == 'slide')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        슬라이드 이미지 PC
                    </div>
                    <div class="line_content">
                        <input type="file" name="writer_file2[]" /> <span class="set">사이즈 : [1920x1080]</span> <span><a href="/storage/app/images/{{$data->real_file_name}}" target="_blank">[이미지 보기]</a></span>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        슬라이드 이미지 MOBILE
                    </div>
                    <div class="line_content">
                        <input type="file" name="writer_file_mobile2[]" /> <span class="set">사이즈 : [1080x1080]</span> <span><a href="/storage/app/images/{{$data->real_file_name2}}" target="_blank">[이미지 보기]</a></span>
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) != 'slide' && request()->segment(2) != 'contact')
            <span id="append_target">
                <div class="write_line">
                    <div class="all_line">
                        <div class="line_title">
                            이미지 선택
                        </div>
                        <div class="line_content">
                            <input type="file" name="writer_file2[]" /> <span class="set"></span>
                            {{-- <span style="cursor: pointer" class="add_file2">이미지 추가 +</span> --}}
                        </div>
                    </div>
                </div>
            </span>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title" style="vertical-align: top">
                        이미지 정보
                    </div>
                    <div class="line_content">
                        @foreach ($data_img_info as $data_img_info)
                        
                        <span class="img_info">- 이미지 {{$data_img_info_num++}} <a href="/storage/app/images/{{ $data_img_info->real_file_name }}" target="_blank">[이미지 보기]</a> <a href="javascript: control2({{$data_img_info->idx}})" style="color: #ff0000;">[삭제]</a></span>
                        <br/>
                        
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) != 'slide' && request()->segment(2) != 'popup' && request()->segment(2) != 'slide' && request()->segment(2) != 'press' && request()->segment(2) != 'video' && request()->segment(2) != 'gallery'  && request()->segment(2) != 'contact')
            <span id="append_target_file">
                <div class="write_line">
                    <div class="all_line">
                        <div class="line_title">
                            파일 선택
                        </div>
                        <div class="line_content">
                            <input type="file" name="writer_file3[]" />
                            {{-- <span class="set">사이즈 : [1:1 비율 ex) 500x500]</span> --}}
                            <span style="cursor: pointer" class="add_file2">파일 추가 +</span>
                        </div>
                    </div>
                </div>
            </span>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title" style="vertical-align: top">
                        파일 정보
                    </div>
                    <div class="line_content">
                        @foreach ($data_file_info as $data_file_info)
                        
                        <span class="img_info">- 파일 {{$data_file_info_num++}} <a href="/storage/app/images/{{ $data_file_info->real_file_name }}" download="{{ $data_file_info->file_name }}" target="_blank">[파일 다운로드]</a> <a href="javascript: control2({{$data_file_info->idx}})" style="color: #ff0000;">[삭제]</a></span>
                        <br/>
                        
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if (request()->segment(2) == 'contact')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title" style="vertical-align: top">
                        이메일
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ $data->email }}" name="email" />
                    </div>
                </div>
            </div>
            @endif
            {{-- @endif --}}
            @if (request()->segment(2) != 'contact')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        링크
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ $data->link_value }}" name="link_value" />
                    </div>
                </div>
            </div>
            @if(request()->segment(2) == 'video')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        해시태그
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ $data->hash_tag }}" name="hash_tag" />
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) == 'event')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        기간
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ $data->start_period }}" name="start_period" id="datepicker1" />
                        ~
                        <input type="text" value="{{ $data->end_period }}" name="end_period" id="datepicker2" />
                    </div>
                </div>
            </div>
            @else
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        작성일
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ $data->start_period }}" name="start_period" id="datepicker1" />
                    </div>
                </div>
            </div>
            @endif
            <div class="write_line">
                <div class="all_line all_line_bottom">
                    <div class="line_title">
                        작성자
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ $data->writer }}" name="writer" />
                    </div>
                </div>
            </div>
            @endif
            <div class="submit_box" style="text-align:center;margin-top:10px;">
                @if (request()->segment(2) != 'contact')
                <input type="submit" value="등록">
                @endif
                <input type="reset" value="취소" onclick="history.go(-1);">
            </div>
        </div>
        @else
        <div class="write_box">
            <div class="write_line">
                <div class="all_line all_line_top">
                    <div class="line_title">
                        아이디
                    </div>
                    <div class="line_content">
                        <input type="text" name="user_id" value="{{$data2->user_id}}" name=""/>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        새 패스워드
                    </div>
                    <div class="line_content">
                        <input type="password" name="passwd_new"/>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line all_line_bottom">
                    <div class="line_title">
                        새 패스워드 확인
                    </div>
                    <div class="line_content">
                        <input type="password" name="passwd_new2"/>
                    </div>
                </div>
            </div>
            <div class="submit_box" style="text-align:center;margin-top:10px;">
                @if (request()->segment(2) != 'contact')
                <input type="submit" value="등록">
                @endif
                <input type="reset" value="취소" onclick="history.go(-1);">
            </div>
            @endif
            @endif
    </form>
    <script type="text/javascript">
        function passcheck(){
            var obj = document.board_write_form;

            if(obj.passwd_new.value != obj.passwd_new2.value){
                alert('변경하려는 패스워드가 다릅니다.')
                return false;
            }

        }

    </script>
    @else
    <form action="/as_admin/{{ request()->segment(2) }}/write_action" name="board_write_form" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="board_idx" value="{{ request()->idx }}" />
		<input type="hidden" name="board_type" value="{{ request()->segment(2) }}" />
        <input type="hidden" name="write_type" value="{{ request()->segment(3) }}" />
        <input type="hidden" name="writer" value="{{ session('user_id') }}" />
        <input type="hidden" name="parent_idx" value="{{ session('user_idx') }}" />
        @if (request()->segment(2) == 'popup')
        <div class="write_box">
            <div class="write_line">
                <div class="all_line all_line_top">
                    <div class="line_title">
                        카테고리
                    </div>
                    <div class="line_content">
						<input type="text" name="category" value="popup" readonly style="border:none;" />
                    </div>
                </div>
			</div>
			<div class="write_line">
                <div class="all_line">
						<div class="line_title">
							제목
						</div>
						<div class="line_content">
							<input type="text" name="subject" value="" />
						</div>
                </div>
            </div>
            <div class="write_line cate_file">
                <div class="all_line">
                    <div class="line_title">
                        팝업위치
                    </div>
                    <div class="line_content">
                        <label for="lefttop"><input type="radio" name="pop_position" id="lefttop" value="lefttop" />좌측상단</label>
                        <label for="righttop"><input type="radio" name="pop_position" id="righttop" value="righttop" />우측상단</label>
                        <label for="leftbot"><input type="radio" name="pop_position" id="leftbot" value="leftbot" />좌측하단</label>
                        <label for="rightbot"><input type="radio" name="pop_position" id="rightbot" value="rightbot" />우측하단</label>
                    </div>
                </div>
            </div>
            <div class="write_line cate_file">
                <div class="all_line">
                    <div class="line_title">
                        팝업크기
                    </div>
                    <div class="line_content">
                        가로 : <input type="number" name="i_width" value="" />
                        세로 : <input type="number" name="i_height" value="" />
                    </div>
                </div>
            </div>
            <div class="write_line cate_file">
                <div class="all_line">
                    <div class="line_title">
                        팝업여백
                    </div>
                    <div class="line_content">
                        가로 : <input type="number" name="m_width" value="" />
                        세로 : <input type="number" name="m_height" value="" />
                    </div>
                </div>
            </div>
            <span id="append_target">
                <div class="write_line cate_file">
                    <div class="all_line">
                        <div class="line_title">
                            파일선택
                        </div>
                        <div class="line_content">
                            <input type="file" name="writer_file[]" /><a target="blank" href="">[파일미리보기]</a>
                        </div>
                    </div>
                </div>
            </span>

			<div class="write_line cate_file">
				<div class="all_line all_line_bottom">
					<div class="line_title">
						노출여부
					</div>
					<div class="line_content">
						<label for="see1"><input type="radio" id="see1" name="use_status" value="Y" > 사용</label>
						<label for="see2"><input type="radio" id="see2" name="use_status" value="N" > 중지</label>
					</div>
				</div>
			</div>
            <div class="submit_box" style="text-align:center;margin-top:10px;">
                <input type="submit" value="등록">
                <input type="reset" value="취소">
            </div>
        </div>
        @else
        @if (request()->segment(2) != 'member')
        <div class="write_box">
            <div class="write_line">
                <div class="all_line all_line_top">
                    <div class="line_title">
                        제목
                    </div>
                    <div class="line_content">
                    <input type="text" name="subject" value="" />
                    </div>
                </div>
            </div>
            @if(request()->segment(2) != 'slide' && request()->segment(2) != 'video')
            <div class="write_line">
                <div class="all_line ">
                    <div class="line_title" style="vertical-align: top;">
                        내용
                    </div>
                    <div class="line_content">
                    <textarea id="editor" name="contents" cols="60" rows="10" style=""></textarea>
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) == 'slide')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        이미지 PC
                    </div>
                    <div class="line_content">
                        <input type="file" name="writer_file2[]" /> <span class="set">사이즈 : [1920x1080]</span>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        이미지 MOBILE
                    </div>
                    <div class="line_content">
                        <input type="file" name="writer_file_mobile2[]" /> <span class="set">사이즈 : [1080x1080]</span>
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) != 'slide')
            <span id="append_target">
                <div class="write_line">
                    <div class="all_line">
                        <div class="line_title">
                            이미지 선택
                        </div>
                        <div class="line_content">
                            <input type="file" name="writer_file2[]" />
                            {{-- <span class="set">사이즈 : [1:1 비율 ex) 500x500]</span> --}}
                            {{-- <span style="cursor: pointer" class="add_file2">이미지 추가 +</span> --}}
                        </div>
                    </div>
                </div>
            </span>
            @endif
            @if(request()->segment(2) != 'slide' && request()->segment(2) != 'popup' && request()->segment(2) != 'slide' && request()->segment(2) != 'press' && request()->segment(2) != 'video' && request()->segment(2) != 'gallery')
            <span id="append_target_file">
                <div class="write_line">
                    <div class="all_line">
                        <div class="line_title">
                            파일 선택
                        </div>
                        <div class="line_content">
                            <input type="file" name="writer_file3[]" />
                            {{-- <span class="set">사이즈 : [1:1 비율 ex) 500x500]</span> --}}
                            <span style="cursor: pointer" class="add_file2">파일 추가 +</span>
                        </div>
                    </div>
                </div>
            </span>
            @endif
            {{-- @endif --}}
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        링크
                    </div>
                    <div class="line_content">
                        <input type="text" value="" name="link_value" />
                    </div>
                </div>
            </div>
            @if(request()->segment(2) == 'video')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        해시태그
                    </div>
                    <div class="line_content">
                        <input type="text" value="" name="hash_tag" />
                    </div>
                </div>
            </div>
            @endif
            @if(request()->segment(2) == 'event')
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        기간
                    </div>
                    <div class="line_content">
                        <input type="text" value="" name="start_period" id="datepicker1" />
                        ~
                        <input type="text" value="" name="end_period" id="datepicker2" />
                    </div>
                </div>
            </div>
            @else
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        작성일
                    </div>
                    <div class="line_content">
                        <input type="text" value="" name="start_period" id="datepicker1" />
                    </div>
                </div>
            </div>
            @endif
            <div class="write_line">
                <div class="all_line all_line_bottom">
                    <div class="line_title">
                        작성자
                    </div>
                    <div class="line_content">
                        <input type="text" value="{{ session('user_id') }}" name="writer" />
                    </div>
                </div>
            </div>
            <div class="submit_box" style="text-align:center;margin-top:10px;">
                <input type="submit" value="등록">
                <input type="reset" value="취소" onclick="history.go(-1);">
            </div>
        </div>
        @else
        <div class="write_box">
            <div class="write_line">
                <div class="all_line all_line_top">
                    <div class="line_title">
                        아이디
                    </div>
                    <div class="line_content">
                        <input type="text" name="user_id" value="{{$data->user_id}}" name=""/>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        이름
                    </div>
                    <div class="line_content">
                        <input type="text" name="name" value="{{$data->name}}"/>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        영문 이름
                    </div>
                    <div class="line_content">
                        <input type="text" name="name_en" value="{{$data->name_en}}"/>
                    </div>
                </div>
            </div>
            <div class="write_line">
                <div class="all_line">
                    <div class="line_title">
                        이메일
                    </div>
                    <div class="line_content">
                        <input type="text" name="email" value="{{$data->email}}"/>
                    </div>
                </div>
            </div>
            <div class="submit_box" style="text-align:center;margin-top:10px;">
                <input type="submit" value="등록">
                <input type="reset" value="취소" onclick="history.go(-1);">
            </div>
        @endif
        @endif
    </form>
    @endif
</div>
<script type="text/javascript">   

    function control(idx) {

        if(confirm("삭제하시겠습니까?")) {
            var formData = new FormData();
            formData.append("idx", idx);
            formData.append("table_type", "board");
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'post',
                url: '/as_admin/{{ request()->segment(2) }}/control',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    alert("삭제되었습니다.");
                    location.reload();
                },
                error: function(xhr, status, error) {
                    //$("#loading").hide();
                    return false;
                }
            });
        }
    }

    function control2(idx) {

        if(confirm("삭제하시겠습니까?")) {
            var formData = new FormData();
            formData.append("idx", idx);
            formData.append("table_type", "file_list");
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'post',
                url: '/as_admin/{{ request()->segment(2) }}/control',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    alert("삭제되었습니다.");
                    location.reload();
                },
                error: function(xhr, status, error) {
                    //$("#loading").hide();
                    return false;
                }
            });
        }
    }

    $(function(){
        CKEDITOR.replace('editor',{
            filebrowserUploadUrl: '/editor_image_upload_action.php?type=Files&CKEditorFuncNum=2',
            extraPlugins: 'image'
        });
        CKEDITOR.config.width = 1000;
        CKEDITOR.config.allowedContent = true;
    });

    var append_item = '<div class="write_line"><div class="all_line"><div class="line_title">파일 선택</div> <div class="line_content"> <input type="file" name="writer_file3[]" /></div></div></div>';
    $('.add_file2').click(function(){
        $(append_item).appendTo("#append_target_file")
    });

</script>
<script>
    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    });

    $(function() {
        $("#datepicker1, #datepicker2").datepicker();
    });

</script>
@include('inc/as_footer')