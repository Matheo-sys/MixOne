<?php
namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
public function index()
{
$studioCount = Studio::count();
$userCount = User::count();

return view('pages.about', compact('studioCount', 'userCount'));
}
}
