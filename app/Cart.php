<?php
/**
 * Created by PhpStorm.
 * User: Ricardo_2
 * Date: 10/03/2016
 * Time: 20:53
 */

namespace CodeCommerce;


class Cart
{

    public function __construct()
    {
        $this->items = [];
    }

    public function add($id, $name, $price)
    {
        $this->items += [
            $id => [
                'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
                'price' => $price,
                'name' => $name
            ]
        ];
        return $this->items;
    }

    public function remove($id)
    {
        unset($this->items[$id]);
    }

    public function all()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        foreach($this->items as $items) {
            $total += $items['qtd'] * $items['price'];
        }
        return $total;
    }

    public function clear()
    {
        $this->items = [];
    }

    public function novaQtd($id, $refresh)
    {
        if (isset($this->items[$id])) {
            if ($refresh == 1) {
                $this->items[$id]['qtd'] += 1;
            } elseif ($refresh == 0) {
                $this->items[$id]['qtd'] -= 1;
            }
        }
    }


}