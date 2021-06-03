<?php

namespace App\Repository;

use App\Entity\DatosAdministrativos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method DatosAdministrativos|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosAdministrativos|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosAdministrativos[]    findAll()
 * @method DatosAdministrativos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosAdministrativosRepository extends ServiceEntityRepository
{
    // public function __construct(ManagerRegistry $registry)
    // {
    //     parent::__construct($registry, DatosAdministrativos::class);
    // }

    // /**
    //  * @return DatosAdministrativos[] Returns an array of DatosAdministrativos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DatosAdministrativos
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
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
        parent::__construct($registry, DatosAdministrativos::class);
        $this->manager = $manager;
    }

    public function save_datos_administrativos($cuenta_bancaria,$telefono,$direccion,$user_)
    {
        $nuevos_datos_administrativos = new DatosAdministrativos();

        $nuevos_datos_administrativos
            ->setCuentaBancaria($cuenta_bancaria)
            ->setTelefono($telefono)
            ->setDireccion($direccion)
            ->setUser($user_);
         

        $this->manager->persist($nuevos_datos_administrativos);
        $this->manager->flush();
    }

    public function update_datos_administrativos(DatosAdministrativos $DatosAdministrativos):DatosAdministrativos
    {
        $this->manager->persist($DatosAdministrativos);
        $this->manager->flush();

        return $DatosAdministrativos;
    }
    public function remove_datos_administrativos(DatosAdministrativos $DatosAdministrativos)
    {
        $this->manager->remove($DatosAdministrativos);
        $this->manager->flush();
    }
    
}
