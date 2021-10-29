<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Note::class);
        $this->manager = $manager;
    }

    public function addNote(string $title, \DateTime $createdAt, string $text): void
    {
        $note = new Note();

        $note->setTitle($title);
        $note->setCreatedTime($createdAt);
        $note->setText($text);

        $this->manager->persist($note);
        $this->manager->flush();
    }

    public function updateNote(Note $note): Note
    {
        $this->manager->persist($note);
        $this->manager->flush();

        return $note;
    }

    public function removeNote(Note $note): void
    {
        $this->manager->remove($note);
        $this->manager->flush();
    }

    /**
     * @return Note[] Returns an array of Note objects
     */
    public function findByCriteria(string $limit, string $sortBy, string $search)
    {
        if (empty($limit)) {
            return $this->createQueryBuilder('n')
                ->where('n.text LIKE :val')
                ->setParameter(':val', '%' . $search . '%')
                ->orderBy('n.created_time', $sortBy)
                ->getQuery()
                ->getResult();
        }

        return $this->createQueryBuilder('n')
            ->where('n.text LIKE :val')
            ->setParameter(':val', '%' . $search . '%')
            ->orderBy('n.created_time', $sortBy)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}