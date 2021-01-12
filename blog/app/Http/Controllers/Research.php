<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\CommonFunction;
use App\Admin;
use App\User;
use Auth;
use DB;
use App\Classes\jsonRPCClient;



class Research extends Controller
{
    
    public function research_count(Request $request) {

		if(empty($request->reg_date1)) { 
			$reg_date1 = date ("Y-m", strtotime("-6 month", strtotime(date("Y-m"))));
			$request->reg_date1 = $reg_date1;
		} else {
			$reg_date1 = $request->reg_date1;
		}
		if(empty($request->reg_date2)) {
			$reg_date2 = date ("Y-m");
			$request->reg_date2 = $reg_date2;
		} else {
			$reg_date2 = $request->reg_date2;
		}
		

		$reg_date1 = date ("Y-m", strtotime("-1 month", strtotime($reg_date1)));

		$i = 0;
		while (strtotime($reg_date1) < strtotime($reg_date2)) {
		
			$reg_date1 = date ("Y-m", strtotime("+1 month", strtotime($reg_date1)));

			$statistics_pc_count = DB::table('statistics') 
					->select(DB::raw('count(*) as cnt'))
					->where('access_type', 'PC')
					->where('reg_date', 'like', '%'.$reg_date1.'%')
					->get();

			$statistics_mobile_count = DB::table('statistics') 
					->select(DB::raw('count(*) as cnt'))
					->where('access_type', 'MOBILE')
					->where('reg_date', 'like', '%'.$reg_date2.'%')
					->get();
		

			$return_list['pc_list'][$i] = $statistics_pc_count;
			$return_list['mobile_list'][$i] = $statistics_mobile_count;

			$i++;
		}

		//if(empty($request->reg_date1)) $reg_date1 = date ("Y-m-d", strtotime("-6 day", strtotime(date("Y-m-d"))));
		//else $reg_date1 = $request->reg_date1;
		//if(empty($request->reg_date2)) $reg_date2 = date ("Y-m-d");
		//else $reg_date2 = $request->reg_date2;
//echo $request->reg_date1;
//echo $request->reg_date2;
//exit;

		$return_list['reg_date3'] = $request->reg_date1;
		$return_list['reg_date1'] = $request->reg_date1;
		$return_list['reg_date2'] = $request->reg_date2;

		return view("/boffice/list", $return_list);
	}

}
