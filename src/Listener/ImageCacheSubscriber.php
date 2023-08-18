<?php

namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManagerAwareInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use App\Entity\Voiture;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Doctrine\ORM\EntityManagerInterface;

class ImageCacheSubscriber implements EventSubscriber, CacheManagerAwareInterface {

    private EntityManagerInterface $entityManager; // test

  /**
   * @var CacheManager
   */
  private $cacheManager;

  /**
   * @var UploaderHelper
   */
  private $uploaderHelper;

  
    public function __construct(  //test
        CacheManager $cacheManager,
        UploaderHelper $uploaderHelper,
        EntityManagerInterface $entityManager
    ) {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
        $this->entityManager = $entityManager;
    } // fin test

  // public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
  // {
  //   $this->cacheManager = $cacheManager;
  //   $this->uploaderHelper = $uploaderHelper;
  // }

  public function getSubscribedEvents(): array
  {
    return [
      "preRemove",
      "preUpdate"
    ];
  }

  public function preRemove(LifecycleEventArgs $args)
  {
        $entity = $args->getObject();
    if (!$entity instanceof Voiture) {
        return;
    }
    $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageFile"));
  }
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();
        if (!$entity instanceof Voiture) {
            return;
        }

        $changeSet = $args->getEntityChangeSet();

        if (isset($changeSet['imageFile'])) {
            [$oldImageFile, $newImageFile] = $changeSet['imageFile'];
            if ($newImageFile instanceof UploadedFile && $newImageFile->getClientOriginalName() !== 'vide.jpg') {
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageFile"));
            }
        }
    }
  public function setCacheManager(CacheManager $cacheManager)
  {
    $this->cacheManager = $cacheManager;
  }
}
