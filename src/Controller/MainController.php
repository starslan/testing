<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 16.03.2019
 * Time: 22:54
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController
{

    /** @Route("/", name="main")*/
    public function number()
    {
        $number = random_int(0, 10);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}