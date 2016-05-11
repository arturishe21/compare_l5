<?php  namespace Vis\Compare;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class Compare
{
    /**
     * add to compare
     *
     * @param  integer $idProduct
     * @param string $model
     *
     * @return bool
     */
    public function addCompare($idProduct, $model = "Product")
    {
        $compareArray = unserialize(Cookie::get("compare"));

        if (is_array($compareArray) && isset($compareArray[0])) {

            $firstElement = $compareArray[0];
            $firstElementObject = $model::find($firstElement);
            $newElementObject = $model::find($idProduct);

            if ($firstElementObject->id_category == $newElementObject->id_category) {
                array_unshift($compareArray, $idProduct);
            } else {
                return false;
            }

        } else {
            $compareArray[] = $idProduct;
        }

        $compareArray = array_unique($compareArray);
        Cookie::queue("compare", serialize($compareArray), 100000);

        return true;
    }

    /**
     * delete product
     *
     * @param $idProduct
     *
     * @return bool
     */
    public function doRemoveCompare($idProduct)
    {
        $compareArray = unserialize(Cookie::get("compare"));
        $keyProduct = array_search($idProduct, $compareArray);
        unset($compareArray[$keyProduct]);
        Cookie::queue("compare", serialize($compareArray), 100000);

        return true;
    }

    /**
     * check present product in compare
     *
     * @param $idProduct integer
     *
     * @return bool
     */
    public function hasCompare ($idProduct)
    {
        if (is_numeric($idProduct)) {
            $compareArray = unserialize(Cookie::get("compare"));
            if (!is_array($compareArray)) {
                return false;
            }
            return in_array($idProduct, $compareArray);
        } else {
            return false;
        }
    }

    /**
     * return count compare
     *
     * @return int
     */
    public function getCountCompare()
    {
        $compareArray = unserialize(Cookie::get("compare"));
        if (!is_array($compareArray)) {
            return 0;
        }

        return count($compareArray);
    }

    /**
     * return all products in compare
     *
     * @param string $model
     *
     * @return bool|list objects
     */
    public function getProducts($model = "Product")
    {
        $compareArray = unserialize(Cookie::get("compare"));
        if (!is_array($compareArray) || count($compareArray) == 0) {
            return false;
        }

        return $model::whereIn("id", $compareArray)->get();
    }

}