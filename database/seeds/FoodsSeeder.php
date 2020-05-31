<?php

use Illuminate\Database\Seeder;

class FoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comidas_bebidas=
        [
            array("plato"=>"Churrasco","precio"=>20000,"img"=>"assets/img/churrasco.jpg"),
            array("plato"=>"Pizza","precio"=>10000,"img"=>"assets/img/pizza.jpg"),
            array("plato"=>"Hamburguesa","precio"=>13000,"img"=>"assets/img/hamburguesa.jpg"),
            array("plato"=>"Bandeja Paisa","precio"=>17000,"img"=>"assets/img/bandeja.jpg")
        ];

        foreach ($comidas_bebidas as $key => $value)
        {
            DB::table('foods')->insert([
                'plato'   =>	$value['plato'],
                'precio'  =>	$value['precio'],
                'img'	  =>	$value['img']
            ]);
        }

    }
}
