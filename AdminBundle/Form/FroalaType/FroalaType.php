<?php

namespace Trinity\AdminBundle\Form\FroalaType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FroalaType.
 */
class FroalaType extends AbstractType
{
    /** @var array */
    protected $froalaSettings;

    public function __construct(array $froalaSettings)
    {
        $this->froalaSettings = $froalaSettings;
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['froala_settings']);
        $resolver->setDefaults([
            'froala_settings' => $this->froalaSettings,
            'attr' => ['style' => 'display:none'],
        ]);
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['froala_settings'] = array_merge($this->froalaSettings, $options['froala_settings']);

        parent::buildView($view, $form, $options);
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return TextareaType::class;
    }
}
