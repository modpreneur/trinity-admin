<?php
/**
 * Created by PhpStorm.
 * User: rockuo
 * Date: 5.5.16
 * Time: 13:04
 */

namespace Trinity\AdminBundle\Form\Image;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ImageType
 * @package Trinity\AdminBundle\Form\Image
 */
class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'image';
    }
}