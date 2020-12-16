            @if(request()->segment(1) != '')
            </div>
            @endif
            <div id="footer">
                @if(request()->segment(1) != 'search')
                <div class="page_search_outer">
                    <div class="inner">
                        <div class="search_box">
                            <form action="/search/page_search">
                                <select name="search_option" id="">
                                    {{-- <option value="">검색어구분</option> --}}
                                    <option value="subject">제목</option>
                                    <option value="contents">내용</option>
                                </select>
                                <input type="text" name="search_value" placeholder="검색어를 입력해주세요.">
                                <button type="submit">
                                    <img src="/img/search_ico.png" alt="">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                <div class="f_logo_outer">
                    <div class="inner">
                        <div class="logo_box">
                            <p>ㅣ주무부처ㅣ</p>
                            <img src="/img/f_logo01.png" alt="">
                        </div>
                        <div class="logo_box">
                            <p>ㅣ전문기관ㅣ</p>
                            <img src="/img/f_logo02.png" alt="">
                        </div>
                        <div class="logo_box">
                            <p>ㅣ총괄기관ㅣ</p>
                            <img src="/img/f_logo03.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="terms_outer mo_none">
                    <div class="inner">
                        <a href="#none">개인정보처리방침</a>
                        <a href="#none">이용약관</a>
                        <a href="#none">이메일무단수집거부</a>
                    </div>
                </div>
                <div class="f_info_outer mo_none">
                    <div class="inner">
                        <p>(18489)경기도 화성시 동탄순환대로 17길 24</p>
                        <p>개인정보책임자 : 홍길동 (abc@abc.com)ㅣE-mail :smartconstruction@ex.co.krㅣTEL : 031-8098-6407</p>
                        <p>COPYRIGHT (C) 스마트건설사업단, ALL RIGHTS RESERVED.</p>
                    </div>
                </div>
                <div class="f_info_all mo_block">
                    <div class="inner">
                        <div class="f_logo">
                            <img src="/img/m/f_logo.png" alt="">
                        </div>
                        <div class="terms_box">
                            <a href="#none">개인정보처리방침</a>
                            <a href="#none">이용약관</a>
                            <a href="#none">이메일무단수집거부</a>
                        </div>
                        <div class="f_info_inner">
                            <p>(18489)경기도 화성시 동탄순환대로 17길 24<br/>개인정보책임자 : 홍길동 (abc@abc.com)<br/>E-mail :smartconstruction@ex.co.kr TEL : 031-8098-6407</p>
                            <p>COPYRIGHT (C) 스마트건설사업단, ALL RIGHTS RESERVED.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form name="search_form" action="{{ $_SERVER['REQUEST_URI'] }}/" class="board_search_con">
        <input type="hidden" name="page" />
     </form>
    <script>
        function page(page){		
            var f = document.search_form;
            f.page.value = page;
            f.submit();
        }
    </script>
</body>