<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function home(){
        $items = DB::select('select * from items');
        return view('home.index',['items'=>$items]);
    }
    public function sell(Request $request){
        return view('sell.home');
    }
    public function mylist(Request $request){
        return view('home.mylist');
    }
    public function index(Request $request){
        $user = Auth::user();
        return view('account.mypage',compact('user'));
    }
    public function post(Request $request){
        $items = DB::select('select * from users');
        return view('account.mypage',['items'=>$items]);
    }
    public function item(Request $request){
        return view('items.index');
    }
    public function add(Request $request){
        return view('sell.create');
    }
    public function create(Request $request){
        $dir = 'sample';
        $request->file('image')->store('public/' . $dir);
        $image = 'storage/' . $dir . '/' . $file_name;
        $item = [
            'id'=>$request->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'image'=>$image,
            'delivaryCharge'=>$request->delivaryCharge,
            'delivaryMethod'=>$request->delivaryMethod,
            'delivaryArea'=>$request->delivaryArea,
            'delivaryDays'=>$request->delivaryDays,
        ];
        DB::table('items')->insert($item);
        return redirect('main',['image',$image]);
    }
}
