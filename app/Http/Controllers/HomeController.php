<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class HomeController extends Controller
{
public function index()
{


return view('home.userpage');
}
}