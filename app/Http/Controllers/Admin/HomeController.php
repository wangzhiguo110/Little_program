<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    //后台首页
    public function home()
    {
//        dd(\App\Model\Permissions::getMenus());
        return view('admin.home');
    }
}