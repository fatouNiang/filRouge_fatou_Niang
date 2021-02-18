<?php

namespace App\Security\Voter;

use App\Entity\ProfilSortie;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class ProfilSortieVoter extends Voter
{

    private $security = null;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['GET', 'POST','DELETE','PUT'])
            && $subject instanceof ProfilSortie;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'GET':
               break;
            case 'POST':
            return $user->getRoles()[0]==="ROLE_ADMIN";
                break;
            case 'DELETE':
               return $user->getRoles()[0]==="ROLE_ADMIN";    
                break;
            case 'PUT':
            return $user->getRoles()[0]==="ROLE_ADMIN";
                
                break;
            default:
        }

        return false;
    }
}


