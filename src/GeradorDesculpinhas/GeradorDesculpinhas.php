<?php

namespace GeradorDesculpinhas;

class GeradorDesculpinhas
{

    public static function getDesculpinha(): array
    {
        $desculpinhas = [
            [
                'autoria' => 'Desconhecida',
                'texto' => 'Eu dei RT mas não tá aparecendo aí'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'Minha conta é fechada'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'Eu tava indo lá agora mesmo deixar o RT'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'Minha Internet caiu'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'null'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'null'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'Meu cachorro comeu meu twitter'
            ],
            [
                'autoria' => 'Desconhecida',
                'texto' => 'Eu tava dormindo'
            ],
        ];

        $key = array_rand($desculpinhas);

        return $desculpinhas[$key];
    }
}