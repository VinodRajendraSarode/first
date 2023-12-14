<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $pincode
 * @property string $city
 * @property string $state
 * @property \Cake\I18n\FrozenDate $joining_date
 * @property \Cake\I18n\FrozenDate $leaving_date
 * @property int $modified_by
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\User $user
 */
class Team extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true
    ];
}
