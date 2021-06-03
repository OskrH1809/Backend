<?php

namespace App\Repository;

use App\Entity\Servicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Servicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Servicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Servicio[]    findAll()
 * @method Servicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicioRepository extends ServiceEntityRepository
{
    // public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    // {
    //     parent::__construct($registry, Servicio::class);
    //     $this->manager = $manager;
    // }

    public function saveServicios($nombre, $precio){
        $nuevoServicio = new Servicio();
        $nuevoServicio
            ->setNombre($nombre)
            ->setPrecio($precio);
        
        $this->manager->persist($nuevoServicio);
        $this->manager->flush();
    }

    // /**
    //  * @return Servicio[] Returns an array of Servicio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Servicio
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
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
        parent::__construct($registry, Servicio::class);
        $this->manager = $manager;
    }

    public function saveCustomer($nombre, $precio)
    {
        $newservicio = new Servicio();

        $newservicio
            ->setNombre($nombre)
            ->setPrecio($precio);
         

        $this->manager->persist($newservicio);
        $this->manager->flush();
    }

    public function updateservicio(Servicio $servicio):Servicio
    {
        $this->manager->persist($servicio);
        $this->manager->flush();

        return $servicio;
    }

public function removeServicio(Servicio $customer)
{
    $this->manager->remove($customer);
    $this->manager->flush();
}


    
}






