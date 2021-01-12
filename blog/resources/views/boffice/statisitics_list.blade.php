@include('inc/as_header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<head>
<!-- {{ $reg_date3 = date('Y-m', strtotime('-1 month', strtotime($reg_date3))) }} -->
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "접속통계"
	},
	subtitles: [{
		text: "접속통계"
	}], 
	axisX: {
		title: "접속통계"
	},
	axisY: {
		title: "접속통계",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		title: "접속통계",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [

		{
			type: "column",
			name: "",
			showInLegend: true,      
			yValueFormatString: "#,##0.# 회",
			dataPoints: [
				
				@foreach($pc_list as $key2 => $data5)
				{ label: "{{ $reg_date3 = date('Y-m', strtotime('+1 month', strtotime($reg_date3))) }}", y: {{ $data5[0]->cnt }} },
				@endforeach
				
				/*
				{ label: "서브1", y: 20015 },
				{ label: "보통", y: 25342 },
				{ label: "미흡",  y: 20088 },
				{ label: "매우미흡",  y: 28234 }
				*/
			]
		},

]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>
</head>

{{-- 페이지만족도조사 --}}
<div class="con_main">
    <form name="search_form" action="{{ $_SERVER['REQUEST_URI'] }}" onsubmit="javascript:search_period();" style="display: inline;">
		<input type="hidden" name="page" />
        {{ csrf_field() }}
            
			<input type="text" id="reg_date1" name="reg_date1" value="{{ $reg_date1 }}" /> ~ <input type="text" id="reg_date2" name="reg_date2" value="{{ $reg_date2 }}" />
			<input type="submit" name="search_button" value="조회" />
            
        </form>
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>
			<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    
    
</div>

<script type="text/javascript">
	$("#exceldown").click(function () {
		
		var form = document.search_form;
		
		form.method = "post";
		form.action = "/search_excel_down2";
		form.submit();

	});

	function search_period() {

		if($("#reg_date1").val() == "") {
			alert("시작날짜를 기입해주세요.");
			return false;
		}

		if($("#reg_date2").val() == "") {
			alert("마지막날짜를 기입해주세요.");
			return false;
		}


	}

	$( function() {
		 $("#reg_date1, #reg_date2").datepicker({
			  showOn: "both", // 버튼과 텍스트 필드 모두 캘린더를 보여준다.
			  changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
			  changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
			  minDate: '-100y', // 현재날짜로부터 100년이전까지 년을 표시한다.
			  nextText: '다음 달', // next 아이콘의 툴팁.
			  prevText: '이전 달', // prev 아이콘의 툴팁.
			  numberOfMonths: [1,1], // 한번에 얼마나 많은 월을 표시할것인가. [2,3] 일 경우, 2(행) x 3(열) = 6개의 월을 표시한다.
			  stepMonths: 3, // next, prev 버튼을 클릭했을때 얼마나 많은 월을 이동하여 표시하는가. 
			  yearRange: 'c-100:c+10', // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
			  showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다. 
			  currentText: '오늘 날짜' , // 오늘 날짜로 이동하는 버튼 패널
			  closeText: '닫기',  // 닫기 버튼 패널
			  dateFormat: "yy-mm", // 텍스트 필드에 입력되는 날짜 형식.
			  showAnim: "slide", //애니메이션을 적용한다.
			  showMonthAfterYear: true , // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다. 
			  dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'], // 요일의 한글 형식.
			  monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'] // 월의 한글 형식.
		 });
	} );
</script>
<script type="text/javascript">

	function notice_control(idx) {

		if(confirm("삭제하시겠습니까?")) {
			var formData = new FormData();
			formData.append("idx", idx);
			formData.append('_token', '{{ csrf_token() }}');

			$.ajax({
				type: 'post',
				url: '/ey_notice/ey_notice_control',
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

</script>

@include('inc/as_footer')