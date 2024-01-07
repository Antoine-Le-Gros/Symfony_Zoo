<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Registration;
use App\Form\EventType;
use App\Form\RegistrationType;
use App\Repository\EnclosureRepository;
use App\Repository\EventRepository;
use App\Repository\RegistrationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EventController extends AbstractController
{
    #[Route('/event/{idEnclosure}', requirements: ['idEnclosure' => '\d+'])]
    public function index(int $idEnclosure, EnclosureRepository $enclosureRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('event/index.html.twig', [
            'events' => $enclosureRepository->getAllEvents($idEnclosure, $search),
            'enclosureName' => $enclosureRepository->find($idEnclosure)?->getName(),
            'enclosure' => true,
            'search' => $search,
        ]);
    }

    #[Route('/event/', name: 'app_event_showAll')]
    public function showAll(EventRepository $eventRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->getAll($search),
            'enclosure' => false,
            'search' => $search,
        ]);
    }

    #[Route('/event/{id}/show', name: 'app_event_show', requirements: ['id' => '\d+'])]
    public function show(
        ?Event $event,
        RegistrationRepository $registrationRepository
    ): Response {
        if (null === $event) {
            throw $this->createNotFoundException("L'évènement n'existe pas ");
        }
        $user = $this->getUser();
        $registration = null;
        if (null !== $user) {
            $registration = $registrationRepository->getRegistrationForEventAndUser($event->getId(), $user->getId());
            if (empty($registration)) {
                $registration = null;
            } else {
                $registration = $registration[0];
            }
        }
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'isRegister' => null !== $registration,
            'registration' => $registration,
        ]);
    }

    #[Route('/event/{id}/delete', requirements: ['id' => '\d+'])]
    public function delete(Event $event,
        EntityManagerInterface $entityManager,
        Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class)
            ->add('cancel', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->get('delete')->isClicked()) {
                $entityManager->remove($event);
                $entityManager->flush();

                return $this->redirectToRoute('app_event_showAll');
            }

            return $this->redirectToRoute('app_event_showAll', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('event/delete.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/event/{id}/update', requirements: ['id' => '\d+'])]
    public function update(Event $event, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animal');
        }

        return $this->render('event/update.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/event/create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_animal');
        }

        return $this->render('event/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/event/{id}/inscription/create', requirements: ['id' => '\d+'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function InscriptionCreate(
        Event $event,
        Request $request,
        EntityManagerInterface $entityManager,
        EventRepository $eventRepository): Response
    {
        $registration = new Registration();
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->add('hour', ChoiceType::class, [
            'mapped' => false,
            'choices' => $eventRepository->getHours($event->getName()),
            'choice_label' => function ($choice): string {
                return $choice;
            },
            'label' => 'Heure',
        ]);
        $form->add('minute', ChoiceType::class, [
            'mapped' => false,
            'choices' => $eventRepository->getMinutes($event->getName()),
            'choice_label' => function ($choice): string {
                return $choice;
            },
            'label' => 'Minute',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $registration = $form->getData();
            $registration->setEvent($event);
            $registration->setUser($this->getUser());
            $registration->getDate()->setTime($form->get('hour')->getData(), $form->get('minute')->getData());
            $entityManager->persist($registration);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_show', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('inscription/create.html.twig', [
            'form' => $form,
            'event' => $event,
        ]);
    }

    #[Route('/event/{id}/inscription/{idRegistration}/update', requirements: ['id' => '\d+', 'idRegistration' => '\d+'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function InscriptionUpdate(
        Event $event,
        int $idRegistration,
        Request $request,
        EntityManagerInterface $entityManager,
        EventRepository $eventRepository,
        RegistrationRepository $registrationRepository): Response
    {
        $registration = $registrationRepository->find($idRegistration);
        $user = $registration->getUser();
        if ($user !== $this->getUser()) {
            throw $this->createNotFoundException('Vous ne pouvez pas modifier une inscription ne vous appartenant pas');
        }
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->add('hour', ChoiceType::class, [
            'mapped' => false,
            'choices' => $eventRepository->getHours($event->getName()),
            'choice_label' => function ($choice): string {
                return $choice;
            },
            'label' => 'Heure',
        ]);
        $form->add('minute', ChoiceType::class, [
            'mapped' => false,
            'choices' => $eventRepository->getMinutes($event->getName()),
            'choice_label' => function ($choice): string {
                return $choice;
            },
            'label' => 'Minute',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $registration->getDate()->setTime($form->get('hour')->getData(), $form->get('minute')->getData());
            $entityManager->flush();

            return $this->redirectToRoute('app_event_show', [
                'id' => $event->getId(),
            ]);
        }

        return $this->render('inscription/update.html.twig', [
            'event' => $event,
            'registration' => $registration,
            'form' => $form,
        ]);
    }

    #[Route('/event/registration/{id}/delete', requirements: ['id' => '\d+'])]
    public function deleteregistrations(Registration $registration,
        Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class)
            ->add('cancel', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->getClickedButton() === $form->get('delete')) {
                $entityManager->remove($registration);
                $entityManager->flush();

                return $this->redirectToRoute('app_event_show');
            }

            return $this->redirectToRoute('app_event_show', ['id' => $registration->getId()]);
        }

        return $this->render('registration/delete.html.twig', [
            'register' => $registration,
            'form' => $form,
        ]);
    }
}
