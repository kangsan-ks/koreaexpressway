<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Classes\CommonFunction;
use App\Classes\PagingFunction;
use App\Admin;
use App\User;
use Auth;
use DB;
use App\Classes\jsonRPCClient;

class Front extends Controller

{
    
    public function main(Request $request) {
		$week_before = date("Y-m-d", strtotime("-1 week"));
        $latest = DB::table('board') 
					->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
					->orWhere('board_type', 'event')
					->orWhere('board_type', 'article')
					->orWhere('board_type', 'report')
					->orderBy('idx', 'desc')
                    ->limit(3)
					->get();
		$latest2 = DB::table('board') 
					->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
					->orWhere('board_type', 'event')
					->orWhere('board_type', 'article')
					->orWhere('board_type', 'report')
					->orderBy('idx', 'desc')
                    ->limit(3)
					->get();

		$video_first = DB::table('board') 
					->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
					->where('board_type', 'video')
					->orderBy('idx', 'desc')
					->first();

		$video = DB::table('board') 
					->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
					->where('board_type', 'video')
					->where('idx', '!=', $video_first->idx)
					->orderBy('idx', 'desc')
                    ->limit(2)
					->get();

		

		$slide = DB::table('board') 
                    ->select(DB::raw('*'))
					->where('board_type', 'slide')
					->orderBy('idx', 'asc')
					->get();

		$press = DB::table('board') 
                    ->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
					->where('board_type', 'press')
					->where('reg_date', '>', $week_before)
					->orderBy('idx', 'desc')
					->get();
					
        // $gallery = DB::table('board')
        //             ->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name, (SELECT name FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_name, (SELECT name_en FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_name_en, (SELECT email FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_email'))
        //             ->where('board_type', 'gallery')
        //             ->get();


        $return_list["slide"] = $slide;
        $return_list["press"] = $press;
        $return_list['video'] = $video;
        $return_list['video_first'] = $video_first;
        $return_list['latest'] = $latest;
        $return_list['latest2'] = $latest2;
		
		return view('index', $return_list);

    }

    public function about(Request $request) {

        $return_list = array();

		return view('sub/about', $return_list);

	}
	
	public function organization(Request $request) {

        $return_list = array();

		return view('sub/organization', $return_list);

    }

    public function gallery(Request $request) {

        $list = DB::table('board')
                    ->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name, (SELECT name FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_name, (SELECT name_en FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_name_en, (SELECT email FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_email'))
                    ->where('board_type', 'gallery')
                    ->get();

        $return_list["data"] = $list;

		return view('sub/gallery', $return_list);

    }

    public function gallery_view(Request $request) {

        $list = DB::table('board')
                    ->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name, (SELECT name FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_name, (SELECT name_en FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_name_en, (SELECT email FROM admin_member WHERE idx = board.parent_idx LIMIT 1) AS member_email'))
                    ->where('idx', $request->idx)
                    ->first();

        $list2 = DB::table('file_list')
                    ->select(DB::raw('*'))
                    ->where('parent_idx', $request->idx)
                    ->get();

        if($request->img_idx != null){
            $list3 = DB::table('file_list')
                        ->select(DB::raw('*'))
                        ->where('parent_idx', $request->idx)
                        ->where('idx', $request->img_idx)
                        ->first();
            $return_list["data3"] = $list3;
            $flag = 1;
        }else{
            $flag = 0;
        }
        $return_list["data"] = $list;
        $return_list["data2"] = $list2;
        $return_list["flag"] = $flag;
        

		return view('sub/gallery_view', $return_list);

    }

    public function notice(Request $request) {

        $boardType = request()->segment(1);

		if($boardType == 'member'){
			$boardType = 'admin_member';
		}

		$paging_option = array(
			"pageSize" => 10,
			"blockSize" => 5
		);

		$thisPage = ($request->page) ? $request->page : 1 ;
		$paging = new PagingFunction($paging_option);


        $totalQuery = DB::table('board');	
        $totalQuery->where('board_type', $boardType);

        $totalCount = $totalQuery->get()->count();
        
        $paging_view = $paging->paging($totalCount, $thisPage, "page");
		

        $query = DB::table('board')
        ->select(DB::raw('*'))
        ->where('board_type', 'notice')
        ->orderBy('idx', 'desc');
        // $query->where(function($query_set2) {
        //         $query_set2->where('top_type', 'Y')
        //         ->orWhere('top_type', null);
        // });
		
		//$query->where('top_type', '<>', 'Y');
		//$query->orWhere('top_type', null);
		
		// if($request->category_type) {
		// 	$query->where('category', $request->category_type);
		// }

		// if(request()->segment(2) == "ey_data_room" && !$request->category_type) {
		// 	$query->where('category', 1);
		// }

		if($request->page != "" && $request->page > 1) {
			$query->skip(($request->page - 1) * $paging_option["pageSize"]);
		}

		$list = $query->take($paging_option["pageSize"])->get();
		
		// 게시판 출력 글 번호 계산
		$number = $totalCount-($paging_option["pageSize"]*($thisPage-1));

		$board_top_count = DB::table('board') 
					->select(DB::raw('*'))
					->where('board_type', $boardType)
					->where('top_type', 'Y')
					->get()->count();

		$board_top_list = DB::table('board') 
					->select(DB::raw('*, substr(reg_date, 1, 10) as reg_date_cut'))
					->where('board_type', $boardType)
					->where('top_type', 'Y')
					->get();

		$return_list = array();
		$return_list["board_top_count"] = $board_top_count;
		$return_list["board_top_list"] = $board_top_list;
		$return_list["data"] = $list;
		$return_list["data2"] = $list;
		$return_list["number"] = $number;
		$return_list["key"] = $request->key;
		$return_list["totalCount"] = $totalCount;
		$return_list["paging_view"] = $paging_view;
		$return_list["page"] = $thisPage;
		$return_list["key"] = $request->key;

		return view('sub/notice', $return_list);

	}
	
	public function project(Request $request) {

		$return_url = 'project_'.request()->segment(2);
		
        $return_list = array();

		return view('sub/'.$return_url, $return_list);

	}
	
	public function page_search(Request $request) {

		$list_press = DB::table('board')
				->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
				->where('board_type', 'press')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->get();
		$list_event = DB::table('board')
				->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
				->where('board_type', 'event')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->get();
		$list_start = DB::table('board')
				->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
				->where('board_type', 'start')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->get();
		$list_article = DB::table('board')
				->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
				->where('board_type', 'article')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->get();
		$list_report = DB::table('board')
				->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
				->where('board_type', 'report')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->get();
		$list_gallery = DB::table('board')
				->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
				->where('board_type', 'gallery')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->get();
		$list_press_cnt = DB::table('board')
				->select(DB::raw('*'))
				->where('board_type', 'press')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->count();
		$list_event_cnt = DB::table('board')
				->select(DB::raw('*'))
				->where('board_type', 'event')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->count();
		$list_start_cnt = DB::table('board')
				->select(DB::raw('*'))
				->where('board_type', 'start')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->count();
		$list_article_cnt = DB::table('board')
				->select(DB::raw('*'))
				->where('board_type', 'article')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->count();
		$list_report_cnt = DB::table('board')
				->select(DB::raw('*'))
				->where('board_type', 'report')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->count();
		$list_gallery_cnt = DB::table('board')
				->select(DB::raw('*'))
				->where('board_type', 'gallery')
				->where($request->search_option, 'like', '%'.$request->search_value.'%')
				->count();

		$return_list["list_press"] = $list_press;
		$return_list["list_event"] = $list_event;
		$return_list["list_start"] = $list_start;
		$return_list["list_article"] = $list_article;
		$return_list["list_report"] = $list_report;
		$return_list["list_gallery"] = $list_gallery;
		$return_list["list_press_cnt"] = $list_press_cnt;
		$return_list["list_event_cnt"] = $list_event_cnt;
		$return_list["list_start_cnt"] = $list_start_cnt;
		$return_list["list_article_cnt"] = $list_article_cnt;
		$return_list["list_report_cnt"] = $list_report_cnt;
		$return_list["list_gallery_cnt"] = $list_gallery_cnt;	

		return view('sub/search', $return_list);
	}

    public function view(Request $request) {

        $list = DB::table('board')
                    ->select(DB::raw('*'))
                    ->where('idx', $request->idx)
					->first();

		$list_next = DB::table('board')
					->select(DB::raw('*'))
					->where('board_type', 'segment(2)')
					->where('idx', '>', $request->idx)
					->orderBy('idx', 'asc')
					->first();

		$list_prev = DB::table('board')
					->select(DB::raw('*'))
					->where('board_type', 'segment(2)')
					->where('idx', '<', $request->idx)
					->orderBy('idx', 'desc')
					->first();

		$list_next_cnt = DB::table('board')
					->select(DB::raw('*'))
					->where('board_type', 'segment(2)')
					->where('idx', '>', $request->idx)
					->orderBy('idx', 'desc')
					->count();

		$list_prev_cnt = DB::table('board')
					->select(DB::raw('*'))
					->where('board_type', 'segment(2)')
					->where('idx', '<', $request->idx)
					->orderBy('idx', 'desc')
					->count();
					
		if($list_prev_cnt != ''){
			$prev_item_check = true;
		}else{
			$prev_item_check = false;
		}

		if($list_next_cnt != ''){
			$next_item_check = true;
		}else{
			$next_item_check = false;
		}

        $return_list["data"] = $list;
        $return_list["data_next"] = $list_next;
        $return_list["data_prev"] = $list_prev;
        $return_list["prev_item_check"] = $prev_item_check;
        $return_list["next_item_check"] = $next_item_check;

		return view('sub/view', $return_list);

    }

    public function list(Request $request) {

        $boardType = request()->segment(2);

		$paging_option = array(
			"pageSize" => 5,
			"blockSize" => 5
		);

		$thisPage = ($request->page) ? $request->page : 1 ;
		$paging = new PagingFunction($paging_option);


        $totalQuery = DB::table('board');	
        $totalQuery->where('board_type', $boardType);

        $totalCount = $totalQuery->get()->count();
        
        $paging_view = $paging->paging($totalCount, $thisPage, "page");
		

        $query = DB::table('board')
        ->select(DB::raw('*, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'))
        ->where('board_type', $boardType)
        ->orderBy('idx', 'desc');
        // $query->where(function($query_set2) {
        //         $query_set2->where('top_type', 'Y')
        //         ->orWhere('top_type', null);
        // });
		
		//$query->where('top_type', '<>', 'Y');
		//$query->orWhere('top_type', null);
		
		// if($request->category_type) {
		// 	$query->where('category', $request->category_type);
		// }

		// if(request()->segment(2) == "ey_data_room" && !$request->category_type) {
		// 	$query->where('category', 1);
		// }

		if($request->page != "" && $request->page > 1) {
			$query->skip(($request->page - 1) * $paging_option["pageSize"]);
		}

		$list = $query->take($paging_option["pageSize"])->get();
		
		// 게시판 출력 글 번호 계산
		$number = $totalCount-($paging_option["pageSize"]*($thisPage-1));

		$board_top_count = DB::table('board') 
					->select(DB::raw('*'))
					->where('board_type', $boardType)
					->where('top_type', 'Y')
					->get()->count();

		$board_top_list = DB::table('board') 
					->select(DB::raw('*, substr(reg_date, 1, 10) as reg_date_cut'))
					->where('board_type', $boardType)
					->where('top_type', 'Y')
					->get();

		$return_list = array();
		$return_list["board_top_count"] = $board_top_count;
		$return_list["board_top_list"] = $board_top_list;
		$return_list["data"] = $list;
		$return_list["data2"] = $list;
		$return_list["number"] = $number;
		$return_list["key"] = $request->key;
		$return_list["totalCount"] = $totalCount;
		$return_list["paging_view"] = $paging_view;
		$return_list["page"] = $thisPage;
		$return_list["key"] = $request->key;

		return view('sub/list', $return_list);

    }

    public function about_view(Request $request) {

        $list = DB::table('board')
                    ->select(DB::raw('*'))
                    ->where('idx', $request->idx)
                    ->first();

        $return_list["data"] = $list;

		return view('sub/view', $return_list);

    }

}
?>