<?php

namespace AppBundle\Controller\API\v1;

use AppBundle\Controller\API\BaseApiController;
use AppBundle\Entity\Deck;
use AppBundle\Form\DeckType;
use AppBundle\Manager\DeckManager;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Description of DeckPublishController
 *
 * @author Alsciende <alsciende@icloud.com>
 */
class DeckPublishController extends BaseApiController
{
    /**
     * Create a public deck from an existing deck
     * 
     * @ApiDoc(
     *  resource=true,
     *  section="Decks (private)",
     * )
     * @Route("/private-decks/{deckId}/publish")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     * @ParamConverter("parent", class="AppBundle:Deck", options={"id" = "deckId"})
     */
    public function postAction (Request $request, Deck $parent)
    {
        if($parent->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        // publication
        $deck = $this->get('app.deck_manager')->createNewMajorVersion($parent);

        // update with provided name and description
        $form = $this->createForm(DeckType::class, $deck);
        $form->submit(json_decode($request->getContent(), true), false);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->success($deck);
        }

        return $this->failure('validation_error', $this->formatValidationErrors($form->getErrors()));
    }
}