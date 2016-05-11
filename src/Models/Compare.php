<?php  namespace Vis\Compare;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class Compare
{
    public function addCompare($id, $model = "Product")
    {
        $compareArray = unserialize(Cookie::get("compare"));
        $model = \$model;

        if (is_array($compareArray) && isset($compareArray[0])) {

            $firstElement = $compareArray[0];
            $firstElementObject = $model::find($firstElement);
            $newElementObject = $model::find($id);

            if ($firstElementObject->id_category == $newElementObject->id_category) {
                array_unshift($compareArray, $idProduct);
            } else {
                return Response::json(
                    array('status' => 'error',
                          'message' => "Сравнивать можно товары с одной категории")
                );
            }

        } else {
            $compareArray[] = $id;
        }

        $compareArray = array_unique($compareArray);
        Cookie::queue("compare", serialize($compareArray), 100000);

        return Response::json(
            array('status' => 'success',
                'message' => "Товар успешно добавлен в сравнение")
        );
    }

    public function doRemoveCompare()
    {
        $idProduct = Input::get("id");
        if (is_numeric($idProduct)) {

            $compareArray = unserialize(Cookie::get("compare"));
            $keyProduct = array_search($idProduct, $compareArray);
            unset($compareArray[$keyProduct]);
            Cookie::queue("compare", serialize($compareArray), 100000);

            return Response::json(
                array('status' => 'success',
                    'message' => "Товар успешно удален из сравнения")
            );
        }
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
}