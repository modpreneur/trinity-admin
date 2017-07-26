<?php
declare(strict_types=1);

namespace Trinity\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TextViewType
 */
class TextViewType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr' => ['disabled' => 'true', 'class' => 'text-view'],
        ]);
    }


    /**
     * @return string
     */
    public function getParent(): string
    {
        return TextType::class;
    }
}
