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

    private EntityManagerInterface $entityManager;

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
    }

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
    $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageCarousel1"));
    $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageCarousel2"));
    $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageCarousel3"));
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
            if ($newImageFile instanceof UploadedFile && $oldImageFile !== $newImageFile) {
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageFile"));
            }
        }
        if (isset($changeSet['imageCarousel1'])) {
    [$oldImageCarousel1, $newImageCarousel1] = $changeSet['imageCarousel1'];
    if ($newImageCarousel1 instanceof UploadedFile && $oldImageCarousel1 !== $newImageCarousel1) {
        $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageCarousel1"));
    }
}

if (isset($changeSet['imageCarousel2'])) {
    [$oldImageCarousel2, $newImageCarousel2] = $changeSet['imageCarousel2'];
    if ($newImageCarousel2 instanceof UploadedFile && $oldImageCarousel2 !== $newImageCarousel2) {
        $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageCarousel2"));
    }
}

if (isset($changeSet['imageCarousel3'])) {
    [$oldImageCarousel3, $newImageCarousel3] = $changeSet['imageCarousel3'];
    if ($newImageCarousel3 instanceof UploadedFile && $oldImageCarousel3 !== $newImageCarousel3) {
        $this->cacheManager->remove($this->uploaderHelper->asset($entity, "imageCarousel3"));
    }
    }

  }
    
  public function setCacheManager(CacheManager $cacheManager)
  {
    $this->cacheManager = $cacheManager;
  }
}
