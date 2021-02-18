<?php

namespace App\DataPersister;

use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

/**
 *
 */

class ProfilDataPersister implements ContextAwareDataPersisterInterface
{
   
    public function __construct(EntityManagerInterface $entityManager){

        $this->_entityManager = $entityManager;
    }
    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profil;
    }

    /**
     * @param Profil $data
     */
    public function persist($data, array $context = [])
    {
        
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }


    /**
     * {@inheritdoc}
     */
    
    public function remove($data, array $context = [])
    {
        $data->setArchivage(1);
        $this->_entityManager->flush();
    }
}