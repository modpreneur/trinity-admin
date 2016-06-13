<?php
/**
 * Created by PhpStorm.
 * User: rockuo
 * Date: 31.3.16
 * Time: 10:40
 */

namespace Trinity\AdminBundle\Form\Color;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ColorType
 * @package Trinity\AdminBundle\Form\Color
 */
class ColorType extends AbstractType
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
        return 'color';
    }
}
