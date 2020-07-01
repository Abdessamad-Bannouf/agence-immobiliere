<?php 
    namespace App\Entity;
    use Symfony\Component\Validator\Constraints as Assert;
    use Doctrine\Common\Collections\ArrayCollection;

    class PropertySearch
    {
        public function __construct()
        {
            $this->options = new ArrayCollection();
        }
        /**
         * @var int|null
         */
        private $maxPrice;

        /**
         * @var int|null
         * @Assert\Range(min=10, max=400)
         */
        private $minSurface;
        
        /**
         * @return int|null $maxPrice
         */
        public function getMaxPrice(): ?int
        {
            return $this->maxPrice;
        }

        /**
         * @var ArrayCollection
         */
        private $options;

        /**
         * @param int|null $maxPrice
         * @return PropertySearch
         */
        public function setMaxPrice(int $maxPrice): PropertySearch
        {
            $this->maxPrice = $maxPrice;
            return $this;
        }

        /**
         * @return int|null $minSurface
         */
        public function getMinSurface(): ?int
        {
            return $this->minSurface;
        }

        /**
         * @param int|null $minSurface
         * @return PropertySearch
         */
        public function setMinSurface(?int $minSurface): ?PropertySearch
        {
            $this->minSurface = $minSurface;
            return $this;
        }

        public function getOptions(): ArrayCollection
        {
            return $this->options;
        }

        public function setOptions(ArrayCollection $options): void
        {
            $this->options = $options;
        }
    }
?>