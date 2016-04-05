<?php
/**
 * Created by PhpStorm.
 * User: rockuo
 * Date: 5.4.16
 * Time: 15:35
 */

namespace Trinity\AdminBundle\Form\DateTime;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class DateTimeType extends \Symfony\Component\Form\Extension\Core\Type\DateTimeType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['widget'] = $options['widget'];


        if ($options['html5'] && 'single_text' === $options['widget'] && self::HTML5_FORMAT === $options['format']) {
            $view->vars['type'] = 'datetime-local';
        }
    }

}