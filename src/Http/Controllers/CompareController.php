<?php namespace Vis\Compare;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Vis\Compare\Facades\Compare;

class CompareController extends Controller
{
    public function doAddCompare()
    {
        $idProduct = Input::get("id");
        if (is_numeric($idProduct)) {
           return Compare::addCompare($idProduct, "Product");
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
