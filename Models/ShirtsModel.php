<?php
namespace Models;

class ShirtsModel
{
    public $shirts = [
        ['talla' => 'XS', 'color' => 'blanco', 'precio' => 2.00, 'img' => 'camisa4.png'],
        ['talla' => 'S', 'color' => 'blanco', 'precio' => 4.00, 'img' => 'camisa4.png'],
        ['talla' => 'M', 'color' => 'blanco', 'precio' => 5.00, 'img' => 'camisa4.png'],
        ['talla' => 'L', 'color' => 'blanco', 'precio' => 7.00, 'img' => 'camisa4.png'],
        ['talla' => 'XL', 'color' => 'blanco', 'precio' => 10.00, 'img' => 'camisa4.png'],
        ['talla' => 'XXL', 'color' => 'blanco', 'precio' => 12.00, 'img' => 'camisa4.png'],
        ['talla' => 'XS', 'color' => 'Rojo', 'precio' => 2.00, 'img' => 'camisa2.png'],
        ['talla' => 'S', 'color' => 'Rojo', 'precio' => 4.00, 'img' => 'camisa2.png'],
        ['talla' => 'M', 'color' => 'Rojo', 'precio' => 5.00, 'img' => 'camisa2.png'],
        ['talla' => 'L', 'color' => 'Rojo', 'precio' => 7.00, 'img' => 'camisa2.png'],
        ['talla' => 'XL', 'color' => 'Rojo', 'precio' => 10.00, 'img' => 'camisa2.png'],
        ['talla' => 'XXL', 'color' => 'Rojo', 'precio' => 12.00, 'img' => 'camisa2.png'],
        ['talla' => 'XS', 'color' => 'Negro', 'precio' => 2.00, 'img' => 'camisa3.png'],
        ['talla' => 'S', 'color' => 'Negro', 'precio' => 4.00, 'img' => 'camisa3.png'],
        ['talla' => 'M', 'color' => 'Negro', 'precio' => 5.00, 'img' => 'camisa3.png'],
        ['talla' => 'L', 'color' => 'Negro', 'precio' => 7.00, 'img' => 'camisa3.png'],
        ['talla' => 'XL', 'color' => 'Negro', 'precio' => 10.00, 'img' => 'camisa3.png'],
        ['talla' => 'XXL', 'color' => 'Negro', 'precio' => 12.00, 'img' => 'camisa3.png'],
        ['talla' => 'XS', 'color' => 'Verde', 'precio' => 2.00, 'img' => 'camisa6.png'],
        ['talla' => 'S', 'color' => 'Verde', 'precio' => 4.00, 'img' => 'camisa6.png'],
        ['talla' => 'M', 'color' => 'Verde', 'precio' => 5.00, 'img' => 'camisa6.png'],
        ['talla' => 'L', 'color' => 'Verde', 'precio' => 7.00, 'img' => 'camisa6.png'],
        ['talla' => 'XL', 'color' => 'Verde', 'precio' => 10.00, 'img' => 'camisa6.png'],
        ['talla' => 'XXL', 'color' => 'Verde', 'precio' => 12.00, 'img' => 'camisa6.png'],
        ['talla' => 'XS', 'color' => 'Azul', 'precio' => 2.00, 'img' => 'camisa5.png'],
        ['talla' => 'S', 'color' => 'Azul', 'precio' => 4.00, 'img' => 'camisa5.png'],
        ['talla' => 'M', 'color' => 'Azul', 'precio' => 5.00, 'img' => 'camisa5.png'],
        ['talla' => 'L', 'color' => 'Azul', 'precio' => 7.00, 'img' => 'camisa5.png'],
        ['talla' => 'XL', 'color' => 'Azul', 'precio' => 10.00, 'img' => 'camisa5.png'],
        ['talla' => 'XXL', 'color' => 'Azul', 'precio' => 12.00, 'img' => 'camisa5.png']
        
    ];
    public $userCart = [];

    public function getShirts()
    {
        return $this->shirts;
    }

    public function getShirtsRandom()
    {
        $keys = array_keys($this->shirts);
        shuffle($keys);
        $shuffle = [];

        foreach($keys as $key)
        {
            $shuffle[] = $this->shirts[$key];
        }

        return $shuffle;
    }

    public function getUserCart(int $units)
    {
        $shirts = $this->getShirtsRandom();
        
        for($i = 1; $i <= $units; $i++)
        {
            $this->userCart[] = $shirts[$i];
        }

        return $this->composeCart();
    }

    private function composeCart()
    {
        return ['items' => $this->getItems(), "total" => $this->getTotal()];
    }

    private function getTotal()
    {
        $subtotal = 0;
        $envio = 5;

        foreach($this->userCart as $item)
        {
            $subtotal += $item['precio'];
        }

        if($subtotal > 50)
        {
            $envio = 0;
        }

        return ['subtotal' => $subtotal, 'envio' => $envio];
    }

    private function getItems()
    {
        $tallas = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $ArrTemp = [];
        $Arr = [];

        foreach($this->userCart as $shirt)
        {
           foreach($tallas as $talla)
           {
               if($shirt['talla'] == $talla)
               {
                    $ArrTemp[$talla][] = $shirt;
               }
           }
        }

        foreach($tallas as $talla)
        {
            if(isset($ArrTemp[$talla]))
            {
                foreach($ArrTemp[$talla] as $temp)
                {

                    $Arr[] = $temp;
                }

            }
        }
        return $Arr;
    }

}