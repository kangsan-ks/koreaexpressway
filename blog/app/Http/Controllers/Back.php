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

class Back extends Controller

{

	public function file_upload(Request $request) {

		if($request->upfiles) {
			$file = $request->upfiles->store('images');
			$file_array = explode("/", $file);
			copy("../storage/app/images/".$file_array[1], "./sample/editor/html/popular/".$file_array[1]);
		} else {
			$file_array[1] = null;
		}

		$response = new \StdClass;
		//$response->link = Director::absoluteBaseURL() . "" . $file->Filename;
		$response->link = "/sample/editor/html/popular/" . $file_array[1];
		echo stripslashes(json_encode($response));
	}

    public function as_login(Request $request) {

		return view('/boffice/as_login'); 

    }
    
    public function as_login_action(Request $request) {
		
		$member_infom_count = DB::table('admin_member') 
				->select(DB::raw('*'))
				->where('user_id', $request->id)
				->get()->count();
		
		if($member_infom_count > 0) {
			
			$member_infom = DB::table('admin_member') 
					->select(DB::raw('*'))
					->where('user_id', $request->id)
					->first();

			if (Hash::check($request->pw, $member_infom->passwd)) {

				session(['user_id' => $member_infom->user_id]);
				session(['user_idx' => $member_infom->idx]);

				echo "<script>alert('로그인되었습니다.');location.href='/as_admin/popup/list';</script>";

			} else {
				echo "<script>alert('비밀번호가 잘못되었습니다.');location.href='/as_admin/login';</script>";

			}
			
		} else {
			echo "<script>alert('등록되어 있지 않은 아이디입니다.');location.href='/as_admin/login';</script>";

		}
		
    }
    
    public function as_logout(Request $request) {
		$request->session()->flush();
		echo "<script>alert('로그아웃 되었습니다.');location.href='/as_admin/login';</script>";
		exit;
	}

	public function main_set(Request $request) {

		$main_data_inform = DB::table('main_data_control') 
                    ->select(DB::raw('*'))
                    ->where('lang', 'kr')
                    ->first();

        $return_list['data'] = $main_data_inform;
		return view("/boffice/main_set", $return_list);
    }

    public function change_main_set(Request $request) {

        DB::table('main_data_control')
        ->where('lang', 'kr')
        ->update(    
            [
                'video_link1' => $request->video_link1,
                'video_link2' => $request->video_link2,
                'video_link3' => $request->video_link3,
                'video_link4' => $request->video_link4,
                
            ]
        );

    	echo "<script>alert('수정됐습니다.');location.href='/as_admin/main_set';</script>";
    	exit;
	}

	public function delete_action(Request $request) {
		if($request->segment(2) == 'popup'){
			DB::table('poplayer')
			->where('idx', $request->idx)
			->delete();
			exit;
		}else{
			DB::table('board')
			->where('idx', $request->idx)
			->delete();
			DB::table('file_list')
			->where('parent_idx', $request->idx)
			->delete();
			exit;
		}
	}

	public function popup_list(Request $request) {

		$boardType = request()->segment(2);

		$user_id = session('user_id');

		if($boardType != 'member' && $boardType != 'g1allery'){
			if($user_id != 'admin'){
				echo "<script>alert('접근권한이 없습니다.');location.href='/as_admin/gallery/list';</script>";
				exit;
			}
		}

		if($boardType == 'member'){
			$boardType = 'admin_member';
		}

		$paging_option = array(
			"pageSize" => 10,
			"blockSize" => 5
		);

		$thisPage = ($request->page) ? $request->page : 1 ;
		$paging = new PagingFunction($paging_option);

		if($boardType == 'admin_member'){

			$totalQuery = DB::table('admin_member');

			if($request->category_type) {
				$totalQuery->where('category', $request->category_type);
			}

			if(request()->segment(2) == "ey_data_room" && !$request->category_type) {
				$totalQuery->where('category', 1);
			}
			if($user_id != "admin"){
				$totalQuery->where('user_id', session('user_id'));
			}
			$totalCount = $totalQuery->get()->count();
			
			$paging_view = $paging->paging($totalCount, $thisPage, "page");

		}else{

			$totalQuery = DB::table('poplayer');	

			$totalCount = $totalQuery->get()->count();
			
			$paging_view = $paging->paging($totalCount, $thisPage, "page");

		}
		
		$query = DB::table('poplayer')
			->select(DB::raw('*'))
			->orderBy('idx', 'desc');

		if($request->page != "" && $request->page > 1) {
			$query->skip(($request->page - 1) * $paging_option["pageSize"]);
		}

		$list = $query->take($paging_option["pageSize"])->get();
		
		// 게시판 출력 글 번호 계산
		$number = $totalCount-($paging_option["pageSize"]*($thisPage-1));

		$return_list = array();
		$return_list["data"] = $list;
		$return_list["data2"] = $list;
		$return_list["number"] = $number;
		$return_list["key"] = $request->key;
		$return_list["totalCount"] = $totalCount;
		$return_list["paging_view"] = $paging_view;
		$return_list["page"] = $thisPage;
		$return_list["key"] = $request->key;
		
		return view("/boffice/list", $return_list);
	}

	public function list(Request $request) {

		$boardType = request()->segment(2);

		$user_id = session('user_id');

		if($boardType != 'member' && $boardType != 'g1allery'){
			if($user_id != 'admin'){
				echo "<script>alert('접근권한이 없습니다.');location.href='/as_admin/gallery/list';</script>";
				exit;
			}
		}

		if($boardType == 'member'){
			$boardType = 'admin_member';
		}

		$paging_option = array(
			"pageSize" => 10,
			"blockSize" => 5
		);

		$thisPage = ($request->page) ? $request->page : 1 ;
		$paging = new PagingFunction($paging_option);

		if($boardType == 'admin_member'){

			$totalQuery = DB::table('admin_member');

			if($request->category_type) {
				$totalQuery->where('category', $request->category_type);
			}

			if(request()->segment(2) == "ey_data_room" && !$request->category_type) {
				$totalQuery->where('category', 1);
			}
			if($user_id != "admin"){
				$totalQuery->where('user_id', session('user_id'));
			}
			$totalCount = $totalQuery->get()->count();
			
			$paging_view = $paging->paging($totalCount, $thisPage, "page");

		}else{

			$totalQuery = DB::table('board');	
			$totalQuery->where('board_type', $boardType);
			$totalQuery->where(function($query_set) {
					$query_set->where('top_type', 'Y')
					->orWhere('top_type', null);
			});

			if($request->category_type) {
				$totalQuery->where('category', $request->category_type);
			}

			if(request()->segment(2) == "ey_data_room" && !$request->category_type) {
				$totalQuery->where('category', 1);
			}

			$totalCount = $totalQuery->get()->count();
			
			$paging_view = $paging->paging($totalCount, $thisPage, "page");

		}

		if($request->key != "") {
			$totalQuery->where(function($totalQuery) use($request){
				$totalQuery->where('subject', 'like', '%' . $request->key . '%')
				->orWhere('contents', 'like', '%' . $request->key . '%');
			});
		}

		if($boardType == 'admin_member'){

			$query = DB::table('admin_member')
				->select(DB::raw('*'));

			if($user_id != "admin"){
				$query->where('user_id', session('user_id'));
			}

			$query->orderBy('idx', 'desc');
		}elseif($boardType != 'g1allery'){

			$query = DB::table('board')
					->select(DB::raw('*, substr(reg_date, 1, 10) as reg_date_cut, (SELECT real_file_name FROM file_list WHERE parent_idx = board.idx LIMIT 1) AS real_file_name'));
			if($user_id != "admin"){
				$query->where('parent_idx', session('user_idx'));
			}
			$query->orderBy('idx', 'desc');

		}else{
			$query = DB::table('board')
				->select(DB::raw('*, substr(reg_date, 1, 10) as reg_date_cut'))
				->orderBy('idx', 'desc');
		}
				
		if($request->key != "") {
			$query->where(function($query) use($request){
				$query->where('subject', 'like', '%' . $request->key . '%')
				->orWhere('contents', 'like', '%' . $request->key . '%');
			});
		}
		if($boardType != 'admin_member'){
			$query->where('board_type', $boardType);
		}
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
		
		return view("/boffice/list", $return_list);
	}

	public function popup_write(Request $request) {

		if(request()->segment(3) == "modify") {

			$boardType = request()->segment(2);

			$list = DB::table('poplayer')
								->select(DB::raw('*'))
								->where('idx', $request->idx)
								->first();
			
			if(session('user_id') != 'admin'){
				if($list2->user_id != session('user_id')){
					echo "<script>alert('접근권한이 없습니다.');location.href='/as_admin/member/list'</script>";
					exit;
				}
			}

			$return_list["data"] = $list;

			return view("/boffice/write", $return_list);
		}else{
			return view("/boffice/write");
		}

		
	}

	public function write(Request $request) {

		if(request()->segment(3) == "modify") {

			$boardType = request()->segment(2);

			$list = DB::table('board')
								->select(DB::raw('*'))
								->where('board_type', $boardType)
								->where('idx', $request->idx)
								->first();
			
			$list2 = DB::table('admin_member')
						->select(DB::raw('*'))
						->where('idx', $request->idx)
						->first();
			
			if(session('user_id') != 'admin'){
				if($list2->user_id != session('user_id')){
					echo "<script>alert('접근권한이 없습니다.');location.href='/as_admin/member/list'</script>";
					exit;
				}
			}
			$data_img_info = DB::table('file_list')
							->select(DB::raw('*'))
							->where('parent_idx', $request->idx)
							->where('contents', 'images')
							->get();

			$data_img_info_num = 0;

			$data_file_info = DB::table('file_list')
							->select(DB::raw('*'))
							->where('parent_idx', $request->idx)
							->where('contents', 'files')
							->get();

			$data_file_info_num = 0;	

			$return_list["data_img_info_num"] = $data_img_info_num;
			$return_list["data_img_info"] = $data_img_info;
			$return_list["data_file_info_num"] = $data_file_info_num;
			$return_list["data_file_info"] = $data_file_info;
			$return_list["data"] = $list;
			$return_list["data2"] = $list2;

			return view("/boffice/write", $return_list);
		}else{
			return view("/boffice/write");
		}

		
	}

	public function popup_write_action(Request $request) {

		$boardType = $request->segment(2);
				$file = array();
				$i = 0;
				foreach($_FILES['writer_file']['name'] as $key => $value) {

					$file['name'] = $_FILES['writer_file']['name'][$key];
					$file['tmp_name'] = $_FILES['writer_file']['tmp_name'][$key];
					$file['size'] = $_FILES['writer_file']['size'][$key];

					$upload_directory = './storage/app/images/';


					$ext_str = "jpg,gif,png,pdf,ppt,pptx,hwp,ai,zip,xlsx,Jpg,JPG,GIF,PNG,PDF,PPT,PPTX,HWP,AI,Png,jpeg,JPEG";
					$allowed_extensions = explode(',', $ext_str);

					$max_file_size = 5242880000000000;
					$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext, $allowed_extensions) && $file['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file['size'] >= $max_file_size && $file['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$path = md5(microtime()) . '.' . $ext;
					if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {

						if($request->write_type == 'modify') {
							DB::table('poplayer')->where('idx', $request->board_idx)->update(
								[
									'title' => $request->subject,
									'pop_position' => $request->pop_position,
									'i_width' => $request->i_width,
									'i_height' => $request->i_height,
									'm_width' => $request->m_width,
									'm_height' => $request->m_height,
									'img' => $path,
									'see' => $request->use_status,
								]
							);
							echo '<script>alert("팝업 수정이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
							exit;
						}else{
							DB::table('poplayer')->insert(
								[
									'title' => $request->subject,
									'pop_position' => $request->pop_position,
									'i_width' => $request->i_width,
									'i_height' => $request->i_height,
									'm_width' => $request->m_width,
									'm_height' => $request->m_height,
									'img' => $path,
									'see' => $request->use_status,
									'wdate' => date("Y-m-d"),
									'wdatetime' => date("Y-m-d  H:i:s"),
								]
							);
							echo '<script>alert("팝업 등록이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
							exit;
						}

						$file_id = md5(uniqid(rand(), true));
						$name_orig = $file['name'];
						$name_save = $path;

					}else{
						if($request->write_type == 'modify') {
							DB::table('poplayer')->where('idx', $request->board_idx)->update(
								[
									'title' => $request->subject,
									'pop_position' => $request->pop_position,
									'i_width' => $request->i_width,
									'i_height' => $request->i_height,
									'm_width' => $request->m_width,
									'm_height' => $request->m_height,
									'see' => $request->use_status,
								]
							);
							echo '<script>alert("팝업 수정이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
							exit;
						}else{
							DB::table('poplayer')->insert(
								[
									'title' => $request->subject,
									'pop_position' => $request->pop_position,
									'i_width' => $request->i_width,
									'i_height' => $request->i_height,
									'm_width' => $request->m_width,
									'm_height' => $request->m_height,
									'see' => $request->use_status,
									'wdate' => date("Y-m-d"),
									'wdatetime' => date("Y-m-d  H:i:s"),
								]
							);
							echo '<script>alert("팝업 등록이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
							exit;
						}
					}

					$i++;

				}

		
		
	}

	public function write_action(Request $request) {

		if($request->write_type == 'modify') {

			$boardType = request()->segment(2);

			if($boardType == 'member'){

				if($request->passwd_new != ''){
					DB::table('admin_member')->where('idx', $request->board_idx)->update(
						[
							'passwd' => Hash::make($request->passwd_new),
						]
					);
				}else{
					DB::table('admin_member')->where('idx', $request->board_idx)->update(
						[

						]
					);
				}
				echo '<script>alert("계정 정보 수정이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
				exit;
			}else{

				DB::table('board')->where('idx', $request->board_idx)->update(
					[
						'subject' => $request->subject,
						'contents' => $request->contents,
						'top_type' => $request->top_type,
						'use_status' => $request->use_status,
						'hash_tag' => $request->hash_tag,
						'link_value' => $request->link_value,
						'start_period' => $request->start_period,
						'end_period' => $request->end_period,
						'writer' => $request->writer,
					]
				);
				
				$file = array();
				$i = 0;
				foreach($_FILES['writer_file2']['name'] as $key => $value) {

					$file['name'] = $_FILES['writer_file2']['name'][$key];
					$file['tmp_name'] = $_FILES['writer_file2']['tmp_name'][$key];
					$file['size'] = $_FILES['writer_file2']['size'][$key];

					$upload_directory = './storage/app/images/';


					$ext_str = "jpg,gif,png,pdf,ppt,pptx,hwp,ai,zip,xlsx,Jpg,JPG,GIF,PNG,PDF,PPT,PPTX,HWP,AI,Png,jpeg,JPEG";
					$allowed_extensions = explode(',', $ext_str);

					$max_file_size = 5242880000000000;
					$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext, $allowed_extensions) && $file['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file['size'] >= $max_file_size && $file['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$path = md5(microtime()) . '.' . $ext;
					if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {

						DB::table('file_list')->insert(
							[
								'file_name' => $file['name'],
								'real_file_name' => $path,
								'contents' => 'images',
								'parent_idx' => $request->board_idx,
							]
						);

						$file_id = md5(uniqid(rand(), true));
						$name_orig = $file['name'];
						$name_save = $path;

					}

					$i++;

				}

				$file = array();
				$i = 0;
				foreach($_FILES['writer_file3']['name'] as $key => $value) {

					$file['name'] = $_FILES['writer_file3']['name'][$key];
					$file['tmp_name'] = $_FILES['writer_file3']['tmp_name'][$key];
					$file['size'] = $_FILES['writer_file3']['size'][$key];

					$upload_directory = './storage/app/images/';


					$ext_str = "jpg,gif,png,pdf,ppt,pptx,hwp,ai,zip,xlsx,Jpg,JPG,GIF,PNG,PDF,PPT,PPTX,HWP,AI,Png,jpeg,JPEG";
					$allowed_extensions = explode(',', $ext_str);

					$max_file_size = 5242880000000000;
					$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext, $allowed_extensions) && $file['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file['size'] >= $max_file_size && $file['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$path = md5(microtime()) . '.' . $ext;
					if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {

						DB::table('file_list')->insert(
							[
								'file_name' => $file['name'],
								'real_file_name' => $path,
								'contents' => 'files',
								'parent_idx' => $request->board_idx,
							]
						);

						$file_id = md5(uniqid(rand(), true));
						$name_orig = $file['name'];
						$name_save = $path;

					}

					$i++;

				}

			}

			

			echo '<script>alert("게시글 수정이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
		}else{

			$boardType = request()->segment(2);



			

			if($boardType != 'g1allery'){

				$insert_id = DB::table('board')->insertGetId(
					[
						'subject' => $request->subject,
						'contents' => $request->subject2,
						'link_value' => $request->link_value,
						'hash_tag' => $request->hash_tag,
						'writer' => $request->writer,
						'ip_addr' => request()->ip(),
						'board_type' => $request->board_type,
						'parent_idx' => $request->parent_idx,
						'start_period' => $request->start_period,
						'end_period' => $request->end_period,
						'reg_date' => \Carbon\Carbon::now(),
					]
				);

				
				$file = array();
				$i = 0;
				foreach($_FILES['writer_file2']['name'] as $key => $value) {

					$file['name'] = $_FILES['writer_file2']['name'][$key];
					$file['tmp_name'] = $_FILES['writer_file2']['tmp_name'][$key];
					$file['size'] = $_FILES['writer_file2']['size'][$key];

					$upload_directory = './storage/app/images/';


					$ext_str = "jpg,gif,png,pdf,ppt,pptx,hwp,ai,zip,xlsx,Jpg,JPG,GIF,PNG,PDF,PPT,PPTX,HWP,AI,Png,jpeg,JPEG";
					$allowed_extensions = explode(',', $ext_str);

					$max_file_size = 5242880000000000;
					$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext, $allowed_extensions) && $file['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file['size'] >= $max_file_size && $file['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$path = md5(microtime()) . '.' . $ext;
					if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {

						DB::table('file_list')->insert(
							[
								'file_name' => $file['name'],
								'real_file_name' => $path,
								'contents' => 'images',
								'parent_idx' => $insert_id,
							]
						);

						$file_id = md5(uniqid(rand(), true));
						$name_orig = $file['name'];
						$name_save = $path;

					}

					$i++;

				}

				$file = array();
				$i = 0;
				foreach($_FILES['writer_file3']['name'] as $key => $value) {

					$file['name'] = $_FILES['writer_file3']['name'][$key];
					$file['tmp_name'] = $_FILES['writer_file3']['tmp_name'][$key];
					$file['size'] = $_FILES['writer_file3']['size'][$key];

					$upload_directory = './storage/app/images/';


					$ext_str = "jpg,gif,png,pdf,ppt,pptx,hwp,ai,zip,xlsx,Jpg,JPG,GIF,PNG,PDF,PPT,PPTX,HWP,AI,Png,jpeg,JPEG";
					$allowed_extensions = explode(',', $ext_str);

					$max_file_size = 5242880000000000;
					$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext, $allowed_extensions) && $file['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file['size'] >= $max_file_size && $file['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$path = md5(microtime()) . '.' . $ext;
					if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {

						DB::table('file_list')->insert(
							[
								'file_name' => $file['name'],
								'real_file_name' => $path,
								'contents' => 'files',
								'parent_idx' => $insert_id,
							]
						);

						$file_id = md5(uniqid(rand(), true));
						$name_orig = $file['name'];
						$name_save = $path;

					}

					$i++;

				}
				echo '<script>alert("게시글 작성이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
				exit;
			}elseif($boardType == 'slide'){
				$file = array();
				$i = 0;
				foreach($_FILES['writer_file2']['name'] as $key => $value) {

					$file['name'] = $_FILES['writer_file2']['name'][$key];
					$file['tmp_name'] = $_FILES['writer_file2']['tmp_name'][$key];
					$file['size'] = $_FILES['writer_file2']['size'][$key];

					$file2['name'] = $_FILES['writer_file_mobile2']['name'][$key];
					$file2['tmp_name'] = $_FILES['writer_file_mobile2']['tmp_name'][$key];
					$file2['size'] = $_FILES['writer_file_mobile2']['size'][$key];

					$upload_directory = './storage/app/images/';


					$ext_str = "jpg,gif,png,pdf,ppt,pptx,hwp,ai,zip,xlsx,Jpg,JPG,GIF,PNG,PDF,PPT,PPTX,HWP,AI,Png,jpeg,JPEG";
					$allowed_extensions = explode(',', $ext_str);

					$max_file_size = 5242880000000000;
					$ext = substr($file['name'], strrpos($file['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext, $allowed_extensions) && $file['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file['size'] >= $max_file_size && $file['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$ext2 = substr($file2['name'], strrpos($file2['name'], '.') + 1);

					// 확장자 체크
					if(!in_array($ext2, $allowed_extensions) && $file2['name'] != "") {
						echo "<script>alert('업로드할 수 없는 확장자 입니다.');history.go(-1);</script>";
						exit;
					}

					// 파일 크기 체크
					if($file2['size'] >= $max_file_size && $file2['name'] != "") {
						echo "<script>alert('5MB 까지만 업로드 가능합니다.');history.go(-1);</script>";
						exit;
					}

					$path = md5(microtime()) . '.' . $ext;
					$path2 = md5(microtime()) . '.' . $ext2;
					if(move_uploaded_file($file['tmp_name'], $upload_directory.$path) && move_uploaded_file($file2['tmp_name'], $upload_directory.$path2)) {

						$file_id = md5(uniqid(rand(), true));
						$name_orig = $file['name'];
						$name_save = $path;

					}

					$i++;

				}

				DB::table('board')
				->insert(
					[
						'board_type' => $boardType,
						'attach_file' => $file['name'],
						'attach_file2' => $file2['name'],
						'real_file_name' => $path,
						'real_file_name2' => $path2,
						'subject' => $request->subject,
						'contents' => $request->contents,
						'hash_tag' => $request->hash_tag,
						'top_type' => $request->top_type,
						'use_status' => $request->use_status,
						'link_value' => $request->link_value,
						'writer' => $request->writer,
						'start_period' => $request->start_period,
						'end_period' => $request->end_period,
						'reg_date' => \Carbon\Carbon::now(),
					]
				);

				echo '<script>alert("게시글 작성이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
				exit;
			}
			DB::table('board')
			->insert(
				[
					'board_type' => $boardType,
					'subject' => $request->subject,
					'contents' => $request->contents,
					'hash_tag' => $request->hash_tag,
					'top_type' => $request->top_type,
					'use_status' => $request->use_status,
					'link_value' => $request->link_value,
					'writer' => $request->writer,
					'start_period' => $request->start_period,
					'end_period' => $request->end_period,
					'reg_date' => \Carbon\Carbon::now(),
				]
			);
			echo '<script>alert("게시글 작성이 완료됐습니다.");location.href="/as_admin/'.$boardType.'/list";</script>';
		}

		// $return_list = array();

		// return view("/boffice/write", $return_list);
	}

}
?>