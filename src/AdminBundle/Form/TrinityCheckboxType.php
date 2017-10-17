<?php
/**
 * Created by PhpStorm.
 * User: fisa
 * Date: 10/17/17
 * Time: 10:25 AM
 */

namespace Trinity\AdminBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TrinityCheckboxType
 * @package Trinity\AdminBundle\Form
 */
class TrinityCheckboxType extends CheckboxType
{
    /**
     * Adds new properties 'isInline' and 'wrapper_attr'
     * {@inheritDoc}
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'is_inline' => false,
            'hide_widget_label' => false,
            'wrapper_attr' => []
        ]);
    }

    /**
     * Set new options into vars, so they can be accessed inside twig
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        parent::buildView($view, $form, $options);
        $view->vars['is_inline'] = $options['is_inline'];
        $view->vars['hide_widget_label'] = $options['hide_widget_label'];
        $view->vars['wrapper_attr'] = $options['wrapper_attr'];
    }
}