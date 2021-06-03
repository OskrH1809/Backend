<?php

namespace App\Repository;

use App\Controller\ServicioController;
use App\Entity\Servicio;
use App\Entity\Tarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ServicioRepository;

/**
 * @method Tarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarea[]    findAll()
 * @method Tarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TareaRepository extends ServiceEntityRepository
{
    
    // /**
    //  * @return Tarea[] Returns an array of Tarea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tarea
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Tarea::class);
        $this->manager = $manager;
    }

    public function saveTarea($titulo, $servicio, $descripcion, $documento)
    {    
    
        
       
        $new_tarea = new Tarea();

        $new_tarea
            ->setServicio($servicio)
            ->setTitulo($titulo)       
            ->setDescripcion($descripcion)
            ->setDocumento($documento);
         

        $this->manager->persist($new_tarea);
        $this->manager->flush();
    }

    public function updatetarea(Tarea $tarea):Tarea
    {
        $this->manager->persist($tarea);
        $this->manager->flush();

        return $tarea;
    }

    public function removeTarea(Tarea $Tarea)
{
    $this->manager->remove($Tarea);
    $this->manager->flush();
}

}
