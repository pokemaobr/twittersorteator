<?php

namespace TwitterSorteator;

use DG\Twitter\Twitter;

class TwitterSorteator {

    public $id;
    public $nomes = [];
    public $retweets = [];
    public $retweetsComComentario = [];

    public function __construct(public $link,private $config) {

         $this->geraIdLink();
         $this->geraDadosPost();
    }

    private function geraIdLink() {

        preg_match('/(?<=\/status\/)(?<id>\d+)/',$this->link,$matches);
        $this->id = $matches['id'];

    }

    private function geraDadosPost() {

        $twitter = new Twitter($this->config['consumerKey'], $this->config['consumerSecret'], $this->config['accessToken'], $this->config['accessTokenSecret']);

        $retweets = $twitter->request('statuses/retweets/'.$this->id, 'GET',['count' => 100]);
        $global = $twitter->request('search/tweets','GET',['q' => $this->id,'count' => 100])?->statuses;

        foreach ($retweets as $retweet) {

            if(!in_array($retweet?->user?->screen_name,$this->nomes))
                $this->nomes[] = $retweet?->user?->screen_name;

                $this->retweets[] = $retweet?->user?->screen_name;
        }

        foreach ($global as $retweet) {

            if (!empty($retweet?->quoted_status_id) && ($retweet?->quoted_status_id == $this->id)) {

                if(!in_array($retweet?->user?->screen_name,$this->nomes))
                    $this->nomes[] = $retweet?->user?->screen_name;

                $this->retweetsComComentario[] = $retweet?->user?->screen_name;
            }

        }

    }

    public function sorteia() {

        $chave = shuffle($this->nomes);

        return $this->nomes[$chave];

    }


}
