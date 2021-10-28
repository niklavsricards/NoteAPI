<?php

namespace App\Controller;

use App\Entity\Note;
use App\Repository\NoteRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    private NoteRepository $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }


    /**
     * @Route("/notes/add", name="add_note", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $title = $data['title'];
        $createdAt = new \DateTime();
        $text = $data['text'];


        if (empty($title) || empty($text)) {
            throw new NotFoundHttpException('All parameters should be filled');
        }

        $this->noteRepository->addNote($title, $createdAt, $text);

        return new JsonResponse(['status' => 'Note successfully created'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/notes/{id}", name="one_note", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $note = $this->noteRepository->findOneBy(['id' => $id]);

        $data = [
            "id" => $note->getId(),
            "title" => $note->getTitle(),
            "created_time" => $note->getCreatedTime(),
            "text" => $note->getText()
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/notes/{id}", name="update", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $note = $this->noteRepository->findOneBy(['id' => $id]);

        if (!$note) {
            throw $this->createNotFoundException(
                'No note found for id provided'
            );
        }

        $data = json_decode($request->getContent(), true);

        empty($data['title']) ? true : $note->setTitle($data['title']);
        empty($data['text']) ? true : $note->setText($data['text']);

        $newNote = $this->noteRepository->updateNote($note);

        return new JsonResponse($newNote->toArray(), Response::HTTP_OK);
    }

    #[Route('/note', name: 'note')]
    public function index(): Response
    {

        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }
}
