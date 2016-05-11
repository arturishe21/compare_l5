<?php namespace Vis\Compare;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\View;
use Vis\Compare\Facades\Compare;

class CompareController extends Controller
{
    public function doAddCompare()
    {
        $idProduct = Input::get("id");
        if (is_numeric($idProduct)) {
           return Compare::addCompare($idProduct, $model = "Product");
        }
    }

    public function doRemoveCompare()
    {
        $idProduct = Input::get("id");
        if (is_numeric($idProduct)) {
           return Compare::doRemoveCompare($idProduct);
        }
    }
}