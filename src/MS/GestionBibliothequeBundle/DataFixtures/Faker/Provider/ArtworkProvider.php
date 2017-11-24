<?php namespace MS\GestionBibliothequeBundle\DataFixtures\Faker\Provider;

use Faker\Factory;

class ArtworkProvider extends \Faker\Provider\Base
{
    public function title($nbWords = 5)
    {
        $sentence = $this->generator->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }
    
    public function ISBN()
    {
        return $this->generator->ean13();
    }
}
// $artworkProvider = new ArtworkProvider();
// Factory::create()