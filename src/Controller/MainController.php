<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 16.03.2019
 * Time: 22:54
 */

namespace App\Controller;

use App\Entity\Attestation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{

    /** @Route("/", name="main")*/
    public function number()
    {
        $number = random_int(0, 10);
        $attestation = new Attestation();
        $this->getDoctrine()->getManager()->persist($attestation);
        dump($attestation, $this->getUser());
        return $this->render('Main/main.html.twig', ['max'=>$number]);
    }

    /**
     * @Route("/adminka", name="adminka")
     * @Security("is_granted('ROLE_ADMIN')")

     */
    public function admin()
    {
        $number = random_int(0, 10);

        return $this->render('Main/main.html.twig', ['max'=>$number]);
    }
}