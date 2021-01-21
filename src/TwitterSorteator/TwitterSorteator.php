<?php

namespace TwitterSorteator;

use DG\Twitter\Twitter;

class TwitterSorteator
{

    public $id;
    public $nomes = [];
    public $retweets = [];
    public $retweetsComComentario = [];

    public function __construct(public $link, private $config)
    {

        $this->geraIdLink();
        $this->geraDadosPost();

    }

    private function geraIdLink()
    {

        preg_match('/(?<=\/status\/)(?<id>\d+)/', $this->link, $matches);
        if (!empty($matches))
            $this->id = $matches['id'];

    }

    private function geraDadosPost()
    {

        if (!empty($this->id)) {


            $twitter = new Twitter($this->config['consumerKey'], $this->config['consumerSecret'], $this->config['accessToken'], $this->config['accessTokenSecret']);

            try {
                $retweets = $twitter->request('statuses/retweets/' . $this->id, 'GET', ['count' => 100]);
            } catch (\Throwable $e) {

            }
            try {
                $global = $twitter->request('search/tweets', 'GET', ['q' => $this->id, 'count' => 100])?->statuses;
            } catch (\Throwable $e) {

            }

            if (!empty($retweets)) {
                foreach ($retweets as $retweet) {

                    if (!in_array($retweet?->user?->screen_name, $this->nomes))
                        $this->nomes[] = $retweet?->user?->screen_name;

                    $this->retweets[] = $retweet?->user?->screen_name;
                }

                foreach ($global as $retweet) {

                    if (!empty($retweet?->quoted_status_id) && ($retweet?->quoted_status_id == $this->id)) {

                        if (!in_array($retweet?->user?->screen_name, $this->nomes))
                            $this->nomes[] = $retweet?->user?->screen_name;

                        $this->retweetsComComentario[] = $retweet?->user?->screen_name;
                    }
                }

            }
        }

    }

    public function sorteia()
    {

        if (!empty($this->nomes)) {

            $chave = shuffle($this->nomes);

            return $this->nomes[$chave];

        }

        return false;

    }

    public function nomes()
    {

        return $this->nomes;

    }

}
