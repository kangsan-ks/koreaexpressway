@include('inc/head')
<div class="content_wrap inner contact">
    <form action="/contact_action" method="post">
        <input type="hidden" name="board_type" value="contact">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="f_inner">
            <div class="line_">
                <p>문의 제목</p>
                <input type="text" name="subject" required placeholder="문의 제목을 입력해주세요.">
            </div>
            <div class="line_">
                <p>회신받을 e-mail</p>
                <input type="text" name="email" required placeholder="회신받을 이메일을 입력해주세요.">
            </div>
            <div class="line_">
                <p class="content_title">내용</p>
                <textarea name="contents" required></textarea>
            </div>
        </div>
        <div class="submit_box">
            <button type="submit">글쓰기</button>
            <button type="button" onclick="history.go(-1);">취소</button>
        </div>
    </form>
</div>
@include('inc/footer')