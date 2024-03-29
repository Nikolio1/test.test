<?php


namespace App\Form;

    use App\Entity\Product;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CollectionType;
    use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductType
 * @package App\Form
 */
class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('color', TextType::class)
            ->add('price', NumberType::class)
            ->add('createDat', DateType::class)
        ;

        $builder->add('suppliers', CollectionType::class, [
            'entry_type' => SupplierType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }

}



