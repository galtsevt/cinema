<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Breadcrumbs;
use App\Facades\MetaData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(): \Inertia\Response
    {
        Breadcrumbs::add('Админ-панель');
        MetaData::setTitle('Админ-панель');
        return inertia('Admin/Index');
    }
}
