<?php
/**
 * Created by PhpStorm.
 * User: iam
 * Date: 16.03.2019
 * Time: 22:54
 */

namespace App\Controller;

use App\Entity\Attestation;
use App\Entity\AttestationExecution;
use App\Entity\User;
use function dump;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{

    /** @Route("/", name="main")*/
    public function number(EventDispatcherInterface $eventDispatcher)
    {
        $attestations =  $this->getDoctrine()->getRepository(Attestation::class)->findAll();
        return $this->render('Main/main.html.twig', [ 'attestations'=>$attestations]);
    }

    /**
     * @Route("/test/{id}", name="test", )
     * @Security("is_granted('ROLE_ADMIN')")

     */
    public function test(Request $request, Attestation $attestation = null)
    {

        $attestationExecution = $this->getDoctrine()->getRepository(AttestationExecution::class)->findOneBy([
            'attestation'=>$attestation,
            'user'=>$this->getUser()
            ]);
        if(is_null($attestationExecution)){
           $attestationExecution = new AttestationExecution($attestation);
            $attestationExecution->setUser($this->getUser());
        }
        $form = $attestationExecution->getForm();
        /**@var  Form $form*/
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $attestationExecution->setStatus(AttestationExecution::STATUS_COMPLETE);
           $em = $this->getDoctrine()->getManager();
           $data = $form->getData();
           foreach ($data['answer'] as $item){
              $em->persist($item);
           }
           $em->flush();

           $this->addFlash('success', 'тестирование пройдено');
        }
        $formTemplate = $attestation->getStrategy()->getFormTemplate();
        $formView = $this->renderView($formTemplate, ['form'=>$form->createView()]);

        return $this->render('Main/main.html.twig', ['formView'=>$formView]);
    }

    /**
     * @Route("/result", name="result")
     */
    public function result(){
        $result = [];
        $attestationExecution = $this->getUser()->getAttestationExecution();
        $attestations = $this->getDoctrine()->getRepository(Attestation::class)->findAll();
        foreach ($attestations as $attestation){
            $oneResult['attestation'] = $attestation;
            $filterExecution = $attestationExecution->filter(function($el)use($attestation){
                return $el->getAttestation() === $attestation;
            })->first();
            if($filterExecution instanceof  AttestationExecution){
                $oneResult['attestationExecution'] = $filterExecution;
            }else{
                $oneResult = false;
            }
            $result[] = $oneResult;
        }
        $assign=[
          'result'=>$result,
          'user'=>$this->getUser()
        ];
        return $this->render('Main/result.html.twig', $assign);
    }
}