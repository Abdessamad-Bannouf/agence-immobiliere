<?php 
    namespace App\Listener;

    use Doctrine\Common\EventSubscriber;
    use Liip\ImagineBundle\Imagine\Cache\CacheManager;
    use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
    use Doctrine\ORM\Event\PreFlushEventArgs;
    use Doctrine\ORM\Event\PreUpdateEventArgs;
    use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

    class ImageCacheSubscriber implements EventSubscriber
    {
        /**
         * @var CacheManager
         */
        private $cacheManager;

        /**
         * @var UploaderHelper
         */
        private $uploadHelper;

        public function __construct(CacheManager $cacheManager, UploaderHelper $uploadHelper)
        {
            $this->cacheManager = $cacheManager;
            $this->uploaderHelper = $uploadHelper;
        }

        public function getSubscribedEvents()
        {
            return [
                'preRemove',
                'preUpdate'
            ];
        }

        public function preRemove(LifecycleEventArgs $args)
        {
            $entity = $args->getEntity();
    
            if($args->getEntity() instanceof Property)
            {
                return;
            }
            $this->cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));
        }

        public function preUpdate(PreUpdateEventArgs $args)
        {
            $entity = $args->getEntity();
    
            if($args->getEntity() instanceof Property)
            {
                return;
            }
            if($args->getEntity()->getImageFile() instanceof UploadedFile)
            {
                $this->cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));
            }
        }
    }
?>