@include('inc/head')
<div id="sub">
    <div class="sub_top">
        <div class="sub_title_box">
            <p>CAU FINE ART<span class="bar"></span></p>
            <h1>GALLERY</h1>
            <p>
                <a href="#none">2020</a>ㅣ
                <a href="#none">2021</a>ㅣ
                <a href="#none">2022</a>
            </p>
        </div>
    </div>
    <div class="sub_content_box">
        <h2 class="content_subject">전시소개</h2>
        <div class="contents">
            <ul class="gallery_box">
                @foreach ($data as $data)
                <li>
                    <a href="gallery_view?idx={{$data->idx}}">
                        <div class="img_box">
                            <img src="/storage/app/images/{{$data->real_file_name}}" alt="전시이미지">
                        </div>
                        <div class="text_box">
                            <p>{{$data->member_name}} ㅣ {{$data->member_name_en}}</p>
                            <span>{{$data->member_email}}</span>
                        </div>
                    </a>
                </li>
                @endforeach
                
            </ul>
        </div>
    </div>
</div>
@include('inc/footer')