<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Cache\Exception;
use Symfony\Component\Validator\Mapping\Cache\CacheInterface;
use Symfony\Component\Cache\Exception\CacheException;

class LuckyController
{
    /**
     * @Route("/")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}