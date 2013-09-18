<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\Getters;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator;
use Symfony\Component\Form\FormView;

class Constraints {

    /**
     *
     * @var Validator
     */
    private $validator;

    /**
     * Constructor
     *
     * @param Validator $validator            
     */
    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    /**
     * Get constraints from an entity.
     *
     * @param mixed|string $entity
     *            The name of an entity (Name‌​space\YourBundle\Entity\YourEntity) or an object.
     * @param array $groups
     *            Validations groups. If not given, use Default as group.
     * @return array
     */
    public function getEntityConstraints($entity, 
        array $groups = array("Default")) {
        $list = array();
        
        $meta = $this->validator->getMetadataFactory()
            ->getMetadataFor($entity);
        
        $props = $meta->getConstrainedProperties();
        
        foreach ($props as $prop) {
            $metaProp = $meta->getPropertyMetadata($prop);
            
            $constraints = $metaProp[0]->constraints;
            
            $valids = array();
            foreach ($constraints as $constraint) {
                if (count(array_intersect($constraint->groups, $groups)) > 0)
                    $valids[] = $constraint;
            }
            
            if (count($valids) > 0)
                $list[$prop] = $valids;
        }
        
        return $list;
    }

    /**
     * Get all constraints for the form given.
     *
     * @param FormInterface $form            
     * @param string $name            
     * @return array
     */
    public function getFormConstraints(FormInterface $form, $name = null) {
        $groups = $form->getConfig()
            ->getOption('validation_groups');
        
        if (! $groups)
            $groups = array(
                "Default"
            );
        
        if (! $name)
            $name = $form->getName();
        
        $csts = array();
        
        $dataClass = $form->getConfig()
            ->getOption('data_class', null);
        
        if ($dataClass)
            $entityCst = $this->getEntityConstraints($dataClass, $groups);
        
        foreach ($form as $child) {
            $childName = $child->getName();
            $key = $name . '_' . $childName;
            
            if ($child->getConfig()
                ->getCompound())
                $csts = array_merge($csts, 
                    $this->getFormConstraints($child, $key));
            
            $fieldCsts = $child->getConfig()
                ->getOption('constraints', array());
            
            if (isset($entityCst[$childName]))
                $fieldCsts = array_merge($fieldCsts, $entityCst[$childName]);
            
            $csts[$key] = $fieldCsts;
        }
        
        return $csts;
    }
}

