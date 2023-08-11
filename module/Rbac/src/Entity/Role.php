<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Entity
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Entity;

use Laminas\Permissions\Rbac\RoleInterface;

use function array_keys;
use function array_merge;
use function array_values;
use function sprintf;

/**
 * Role class
 *
 * @package Rbac\Entity
 */
class Role implements RoleInterface
{
    /**
     * @var integer|null Should contain a identifier
     */
    protected $id;

    /**
     * @var string Should contain a name
     */
    protected $name;
    
    /**
     * @var array<string, true>
     */
    protected $permissions = [];
    
    /** 
     * @var RoleInterface[]
     */
    protected $children = [];
    
    /**
     * @var RoleInterface[]
     */
    protected $parents = [];
    
    /**
     * Constructor
     * 
     * @param string $name
     * @param integer|null $id
     */
    public function __construct(string $name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addPermission(string $name): void
    {
        $this->permissions[$name] = true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasPermission(string $name): bool
    {
        if (isset($this->permissions[$name])) {
            return true;
        }

        foreach ($this->children as $child) {
            if ($child->hasPermission($name)) {
                return true;
            }
        }

        return false;
        
    }

    /**
     * Get the permissions of the role, included all the permissions
     * of the children if $hasChildren == true
     *
     * @param bool $hasChildren
     * @return array
     */
    public function getPermissions(bool $hasChildren = true): array
    {
        $permissions = array_keys($this->permissions);
        if ($children) {
            foreach ($this->children as $child) {
                $permissions = array_merge($permissions, $child->getPermissions());
            }
        }
        return $permissions;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addChild(RoleInterface $child): void
    {
        $childName = $child->getName();
        if ($this->hasAncestor($child)) {
            throw new Exception\CircularReferenceException(sprintf(
                'To prevent circular references, you cannot add role "%s" as child',
                $childName
            ));
        }

        if (! isset($this->children[$childName])) {
            $this->children[$childName] = $child;
            $child->addParent($this);
        }        
    }

    /**
     * Check if a role is an ancestor.
     *
     * @param RoleInterface $role
     * @return bool
     */
    protected function hasAncestor(RoleInterface $role): bool
    {
        if (isset($this->parents[$role->getName()])) {
            return true;
        }

        foreach ($this->parents as $parent) {
            if ($parent->hasAncestor($role)) {
                return true;
            }
        }

        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getChildren(): array
    {
        return array_values($this->children);
    }
    
    /**
     * {@inheritDoc}
     */
    public function addParent(RoleInterface $parent): void
    {
        $parentName = $parent->getName();
        if ($this->hasDescendant($parent)) {
            throw new Exception\CircularReferenceException(sprintf(
                'To prevent circular references, you cannot add role "%s" as parent',
                $parentName
            ));
        }

        if (! isset($this->parents[$parentName])) {
            $this->parents[$parentName] = $parent;
            $parent->addChild($this);
        }    
    }
    
    /**
     * Check if a role is a descendant.
     * 
     * @param RoleInterface $role
     * @return bool
     */
    protected function hasDescendant(RoleInterface $role): bool
    {
        if (isset($this->children[$role->getName()])) {
            return true;
        }

        foreach ($this->children as $child) {
            if ($child->hasDescendant($role)) {
                return true;
            }
        }

        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getParents(): array
    {
        return array_values($this->parents);
    }
}
